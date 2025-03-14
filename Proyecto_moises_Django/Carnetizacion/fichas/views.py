from django.shortcuts import render, redirect, get_object_or_404

from django.contrib.auth.decorators import login_required
from .forms import CreateFicha , CargarUsers
from .models import Fichas, FichasXAprendiz
from usuarios.models import Usuarios , TipoDoc, Roles,Rh
from usuarios.forms import CreateUsers
from django.http import JsonResponse
from django.contrib.auth.hashers import make_password
# Create your views here.
import pandas as pd
@login_required
def index_ficha(request):
    fichas = Fichas.objects.exclude(numero_ficha__isnull=True)  # Excluir fichas sin número
    form = CargarUsers()
    context = {'fichas': fichas, 'form': form}
    return render(request, 'pages/ficha_index.html', context)

@login_required
def crear_ficha(request):
    if request.method == 'POST':
        form = CreateFicha(request.POST)

        if form.is_valid():
            numero_ficha = form.cleaned_data['numero_ficha']

            # Verificar si la ficha ya existe
            if Fichas.objects.filter(numero_ficha=numero_ficha).exists():
                context = {'form': form, 'error': 'Número de ficha existente'}
                return render(request, 'pages/crear_ficha.html', context)

            # Recuperar tipo_programa del formulario oculto
            tipo_programa_id = request.POST.get("tipo_programa")  
            if tipo_programa_id:
                form.instance.tipo_programa_id = tipo_programa_id  # Asigna manualmente el ID

            form.save()
            return redirect('index_ficha')

        else:
            context = {'form': form, 'error': 'Formulario no válido', 'form_error': form.errors}
            return render(request, 'pages/crear_ficha.html', context)

    else:
        form = CreateFicha()
        context = {'form': form}
        return render(request, 'pages/crear_ficha.html', context)

@login_required
def editar_ficha(request, id):
    ficha = get_object_or_404(Fichas, numero_ficha=id)
    
    if request.method == 'POST':
        form = CreateFicha(request.POST, instance=ficha)

        if form.is_valid():
            ficha = form.save(commit=False)  # No guarda aún
            ficha.fecha_inicio = ficha.fecha_inicio  # Mantiene la fecha de inicio
            ficha.tipo_programa = ficha.tipo_programa  # 🔹 Reasigna el tipo de programa para evitar cambios
            ficha.save()  # Ahora sí se guarda
            return redirect('index_ficha')
        else:
            context = {'ficha': ficha, 'form': form, 'error': 'Formulario inválido'}
            return render(request, 'pages/editar_ficha.html', context)
    
    # Si es GET, solo mostramos el formulario
    form = CreateFicha(instance=ficha)
    return render(request, 'pages/editar_ficha.html', {'form': form, 'ficha': ficha})

@login_required
def buscar_usuario(request): #EN EL INPUT DEL MODAL FICHAS CARGAR
    query = request.GET.get("query", "")
    if query:
        usuarios = Usuarios.objects.filter(num_doc__icontains=query).values("id", "nombre", "num_doc")
        return JsonResponse(list(usuarios), safe=False)
    return JsonResponse([], safe=False)

@login_required
def cargar_users(request, ficha_id):
    ficha = get_object_or_404(Fichas, id=ficha_id)
    fichas = Fichas.objects.all()
    form = CargarUsers()

    if request.method == "POST":
        aprendiz_id = request.POST.get("aprendiz_id")
        archivo_excel = request.FILES.get("archivo_excel")

        # Si no hay aprendiz seleccionado ni archivo subido, devolver error
        if not aprendiz_id and not archivo_excel:
            return render(request, 'pages/ficha_index.html', {
                'error': "⚠️ Debes seleccionar un aprendiz o subir un archivo Excel.",
                'form': form,
                'ficha': ficha,
                'fichas': fichas
            })

        # Si se seleccionó un aprendiz, asociarlo a la ficha
        if aprendiz_id:
            try:
                aprendiz = Usuarios.objects.get(id=int(aprendiz_id))
                FichasXAprendiz.objects.create(ficha=ficha, aprendiz=aprendiz)
            except (ValueError, Usuarios.DoesNotExist):
                return render(request, 'pages/ficha_index.html', {
                    'error': "Aprendiz no encontrado.",
                    'ficha': ficha,
                    'fichas': fichas,
                    'form': form
                })

        # Si se subió un archivo Excel, procesarlo
        if archivo_excel:
            try:
                df = pd.read_excel(archivo_excel, skiprows=9, engine='openpyxl')
                expected_columns = ['Tipo de Documento', 'Número de Documento', 'Nombre', 'Apellidos', 'Estado']

                if not all(col in df.columns for col in expected_columns):
                    return render(request, 'pages/ficha_index.html', {
                        'error': "El archivo Excel no tiene las columnas esperadas.",
                        'ficha': ficha,
                        'fichas': fichas,
                        'form': form
                    })

                rol = Roles.objects.get(id=2)  # Rol de aprendiz
                
                for _, row in df.iterrows():
                    tipo_doc_instance = TipoDoc.objects.filter(tipo_documento=row['Tipo de Documento']).first()
                    if not tipo_doc_instance:
                        return render(request, 'pages/ficha_index.html', {
                            'error': f"Tipo de documento '{row['Tipo de Documento']}' no encontrado.",
                            'ficha': ficha,
                            'fichas': fichas,
                            'form': form
                        })

                    estado = 1 if row['Estado'].strip().upper() == "EN FORMACION" else 0

                    # Crear o actualizar usuario
                    user, _ = Usuarios.objects.update_or_create(
                        num_doc=row['Número de Documento'],

                        defaults={
                            'tipo_doc': tipo_doc_instance,
                            'nombre': row['Nombre'],
                            'apellido': row['Apellidos'],
                            'estado': estado,
                            'rol': rol,
                            'password': make_password(str(row['Número de Documento']))

                        }
                    )

                    # Asociar usuario a la ficha
                    FichasXAprendiz.objects.create(ficha=ficha, aprendiz=user)

            except Exception as e:
                return render(request, 'pages/ficha_index.html', {
                    'error': f"Error al leer el archivo Excel: {str(e)}",
                    'ficha': ficha,
                    'fichas': fichas,
                    'form': form
                })

        # Redirigir después de una carga exitosa
        return redirect('index_ficha')

    # Si no es una solicitud POST, renderizar normalmente
    return render(request, 'pages/ficha_index.html', {
        'ficha': ficha,
        'fichas': fichas,
        'form': form
    })

@login_required
def ficha_users(request, id):
    ficha_aprendiz = FichasXAprendiz.objects.filter(ficha_id=id).select_related('ficha', 'aprendiz')
    rhs = Rh.objects.all()
    tipos_doc = TipoDoc.objects.all()
    roles = Roles.objects.all()
    context = {'ficha_aprendiz': ficha_aprendiz, 
               'id': id,
                'rhs': rhs,
                'tipos_doc': tipos_doc,
                'roles': roles,
                'ficha_aprendiz': ficha_aprendiz
               }
    return render(request, 'pages/ficha_users.html', context)


@login_required
def modal_edit_user(request, id):
    user = get_object_or_404(Usuarios, num_doc=id)
    form = CreateUsers(instance=user)

    if request.method == 'POST':
        form = CreateUsers(request.POST, request.FILES, instance=user)  # ✅ Se agrega request.FILES
        if form.is_valid():
            form.save()
            return JsonResponse({'success': True})
        else:
            return JsonResponse({'success': False, 'errors': form.errors})

    form_html = f"""
    <form id="editForm" method="POST" enctype="multipart/form-data">  <!-- ✅ enctype agregado -->
        <input type="hidden" name="csrfmiddlewaretoken" value="{request.COOKIES.get('csrftoken', '')}">
        {form.as_p()}
        <button type="submit" class="btn btn-primary mt-2">Guardar Cambios</button>
    </form>
    """

    return JsonResponse({'form': form_html})



def ficha_detail(request, id): #VER INDIVIDUAL Y EDITAR FICHA
    ficha = get_object_or_404(Fichas, numero_ficha= id) #INTEGRAR VALIDACION DE USUARIO
    form= CreateFicha(instance=ficha)
    if request.method == 'GET':
        form= CreateFicha(instance=ficha)
        context={'form': form, 'ficha': ficha}
        return render(request, 'ficha/ficha_detail.html', context)
    else:
        form = CreateFicha(request.POST, instance= ficha)
        try:
            form.save()
            return redirect ('fichas_index')
        except ValueError:
            form= CreateFicha(instance= ficha)
            context= { 'ficha': ficha, 'form': form, 'error': 'No se pudo actualizar la FICHA'}
            return render(request, 'ficha/ficha_detail.html', context)
        
def delete_ficha(request, id): #ELIMINAR TAREA 
    ficha = get_object_or_404(Fichas, numero_ficha= id) #INTEGRAR VALIDACION DE USUARIO
    if request.method == 'POST':
        ficha.delete()
        return redirect('fichas_index')





    