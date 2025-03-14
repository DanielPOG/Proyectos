from django.shortcuts import render, redirect, get_object_or_404
from django.http import JsonResponse
from .models import Usuarios , Roles,TipoDoc
from .forms import CreateUsers, InsertUser
from django.contrib import messages
from django.contrib.auth.decorators import login_required
from fichas.models import FichasXAprendiz, Fichas
from django.db import transaction  # Importar transacciones atomicas
#pip install pandas openpyxl /LIBRERIA PARA LEER EL EXCEL
import pandas as pd

from django.contrib.auth import authenticate, login, logout
# Create your views here.
def index(request):
    return render(request, 'index.html')

@login_required
def prueba(request): #VISTA INDEX PROYECTO
    user = request.user
    context={'user':user}
    return render(request, 'pages/interfaz_index.html',context)

@login_required
def index_user(request): #TODOS LOS USUARIOS
    users= Usuarios.objects.all()
    fichas_aprendiz=  FichasXAprendiz.objects.all()
    fichas_dict = {fa.aprendiz_id: fa.ficha_id for fa in fichas_aprendiz}
    usuarios_con_ficha = []
    for usuario in users:
        ficha_id = fichas_dict.get(usuario.id, None)
        ficha_numero = Fichas.objects.get(id=ficha_id).numero_ficha if ficha_id else "Sin ficha"
        usuarios_con_ficha.append({
            'nombre': usuario.nombre,
            'apellido': usuario.apellido,
            'rol':usuario.rol,
            'num_doc': usuario.num_doc,
            'ficha': ficha_numero,
            'estado':usuario.estado
        })
    context= {'users':usuarios_con_ficha}
    return render(request, 'pages_user/user_index.html', context)


@login_required
def crear_user(request):  
    context = {"form": CreateUsers()}  # Pasar contexto inicial

    if request.method == 'POST':
        form = CreateUsers(request.POST, request.FILES)  # ⬅️ Agregar request.FILES para imágenes
        context = {"form": form}  

        if form.is_valid():
            try:
                with transaction.atomic():  # Transacción atómica
                    if Usuarios.objects.filter(num_doc=form.cleaned_data['num_doc']).exists():
                        context["error"] = "Usuario ya existente"
                        return render(request, 'pages_user/crear_user.html', context)

                    tipo_rol_instance = Roles.objects.get(tipo_rol=form.cleaned_data['rol'])
                    new_user = form.save(commit=False)  
                    new_user.tipo_rol = tipo_rol_instance

                    # 🔹 Si el usuario es Admin, debe ingresar una contraseña obligatoria
                    if tipo_rol_instance.tipo_rol == 'Admin':
                        password_admin = request.POST.get("password_admin", "").strip()
                        if not password_admin:
                            context["error"] = "El administrador debe ingresar una contraseña obligatoria."
                            return render(request, 'pages_user/crear_user.html', context)
                        new_user.set_password(password_admin)  # Se usa la contraseña personalizada

                    else:
                        # 🔹 Si la clave es nula o vacía, se asigna el número de documento
                        if not new_user.password:
                            new_user.set_password(str(new_user.num_doc))

                    # 📌 Guardar imagen de perfil si se subió
                    if 'foto' in request.FILES:
                        new_user.foto = request.FILES['foto']

                    ficha_numero = request.POST.get('ficha_instructor' if tipo_rol_instance.tipo_rol == 'Instructor' else 'ficha_aprendiz', '').strip()

                    if ficha_numero:
                        try:
                            ficha = Fichas.objects.get(numero_ficha=int(ficha_numero))

                            if tipo_rol_instance.tipo_rol == 'Instructor':
                                if ficha.lider_ficha:
                                    confirmar_reemplazo = request.POST.get('confirmar_reemplazo') == "true"

                                    if not confirmar_reemplazo:
                                        context["error"] = f"La ficha {ficha.numero_ficha} ya tiene un líder asignado: {ficha.lider_ficha.nombre} {ficha.lider_ficha.apellido}. ¿Deseas reemplazarlo?"
                                        return render(request, 'pages_user/crear_user.html', context)

                                # ✅ Guardar usuario ANTES de asignarlo como líder
                                new_user.save()
                                ficha.lider_ficha = new_user
                                ficha.save()

                            elif tipo_rol_instance.tipo_rol == 'Aprendiz':
                                new_user.save()
                                FichasXAprendiz.objects.create(aprendiz=new_user, ficha=ficha)

                        except ValueError:
                            context["error"] = "Número de ficha inválido."
                            return render(request, 'pages_user/crear_user.html', context)

                        except Fichas.DoesNotExist:
                            context["error"] = "Ficha no encontrada."
                            return render(request, 'pages_user/crear_user.html', context)
                    else:
                        new_user.save()  # Si no hay ficha, guardar el usuario normalmente

                    return redirect('index_user')

            except ValueError as e:
                context["error"] = str(e)
                return render(request, 'pages_user/crear_user.html', context)

        context['errors'] = form.errors
        return render(request, 'pages_user/crear_user.html', context)

    return render(request, 'pages_user/crear_user.html', context)


def validar_ficha(request, ficha_numero):
    try:
        ficha = Fichas.objects.get(numero_ficha=ficha_numero)
        if ficha.lider_ficha:
            return JsonResponse({"error": f"La ficha {ficha.numero_ficha} ya tiene un líder asignado: {ficha.lider_ficha.nombre} {ficha.lider_ficha.apellido}."})
        return JsonResponse({"message": "Ficha disponible."})
    except Fichas.DoesNotExist:
        return JsonResponse({"error": "Ficha no encontrada."})

@login_required
def editar_user(request, id):  # EDITAR USUARIOS
    user = get_object_or_404(Usuarios, num_doc=id)

    if request.method == 'POST':
        form = CreateUsers(request.POST, request.FILES, instance=user)  # ✅ request.FILES agregado

        if form.is_valid():
            user = form.save(commit=False)

            # Si no se sube una nueva imagen, conservar la anterior
            if not request.FILES.get('foto'):
                user.foto = user.foto  # ✅ Mantener la foto actual

            user.save()  # Guardar cambios
            return redirect('index_user')
        else:
            context = {'user': user, 'form': form, 'error': 'Formulario no válido'}
            return render(request, 'pages_user/editar_user.html', context)

    form = CreateUsers(instance=user)
    return render(request, 'pages_user/editar_user.html', {'form': form})

def eliminar_user(request, id):
    user = get_object_or_404(Usuarios, num_doc=id)
    user.delete()
    return redirect('index_user')  

def login_user(request): #ENTRADA DE APRENDICES
    if request.method == 'POST':
        num_doc = request.POST['num_doc']  # Obtener el número de documento del formulario
        try:
            user = Usuarios.objects.get(num_doc=num_doc)  # Obtener el usuario por número de documento
        except Usuarios.DoesNotExist:
            messages.error(request, 'Número de documento no encontrado')
            return render(request, 'pages_user/login_user.html')  # Redirigir a la página de login

        # Si el usuario es un Admin o Instructor, proceder con la autenticación
        user = authenticate(request, num_doc=num_doc, password=num_doc)
        
        if user is not None:
            # Si el usuario es autenticado correctamente, iniciar sesión
            login(request, user)
            return redirect('view_carnet')  # Redirigir a la página principal después del login
        else:
            # Si la contraseña es incorrecta, mostrar un mensaje de error
            messages.error(request, 'Número de documento o contraseña incorrectos')

    return render(request, 'pages_user/login_user.html')  # Renderiza el formulario de login



def login_admin(request):  # ENTRADA DE ADMIN/INSTRUCTORES
    if request.method == 'POST':
        num_doc = request.POST['num_doc']  # Obtener el número de documento del formulario
        password = request.POST.get('clave')  # Obtener la contraseña del formulario

        try:
            user = Usuarios.objects.get(num_doc=num_doc)  # Obtener el usuario por número de documento
        except Usuarios.DoesNotExist:
            messages.error(request, '❌ Número de documento no encontrado')
            return render(request, 'pages_user/login_admin.html')

        # Si el usuario es un Aprendiz, no permitir el login
        if user.rol.tipo_rol == 'Aprendiz':
            messages.error(request, '⚠️ Usuario Aprendiz no válido para iniciar sesión')
            return render(request, 'pages_user/login_admin.html')

        # Si el usuario es un Admin o Instructor, proceder con la autenticación
        auth_user = authenticate(request, num_doc=num_doc, password=password)
        
        if auth_user is not None:
            login(request, auth_user)
            return redirect('interfaz_index')  # Redirigir a la página principal después del login
        else:
            # ⚠️ Aquí agregamos un mensaje más específico si la contraseña es incorrecta
            messages.error(request, '🔑 Contraseña incorrecta. Intenta de nuevo.')
            return render(request, 'pages_user/login_admin.html', {'num_doc': num_doc})  # Enviamos el documento al formulario

    return render(request, 'pages_user/login_admin.html')  # Renderiza el formulario de login
def logout_all(request):
    if request.user.is_authenticated:  # Verifica si hay un usuario autenticado
        user_role = request.user.rol.tipo_rol  # Obtiene el rol del usuario

        logout(request)  # Cierra sesión
        request.session.flush()  # Borra toda la sesión

        # Redirigir según el rol
        if user_role == 'Aprendiz':
            return redirect('login_user')  # Redirige al login de aprendices
        else:
            return redirect('login_admin')  # Redirige al login de admin/instructores
    
    return redirect('login_user')  # Si no hay usuario autenticado, ir al login por defecto


# def create_rol(request):
#     form = CreateRol()
#     context= {'form': form}
#     if request.method == 'POST':
#         form= CreateRol(request.POST)
#         if form.is_valid():
#             nombre = form.cleaned_data['nombre']
#             if Roles.objects.filter(nombre=nombre).exists():
#                 context= {'form': form, 'error': 'Rol ya existente'}
#                 return render(request, 'rol/create_rol.html', context)
#             else: 
#                 form.save()
#                 return redirect('view_rol') 
#         else:
#             context= {'form': form, 'error': 'Formulario no valido'}
#             return render(request, 'rol/create_rol.html', context) 
#     else:
#         form = CreateRol()
#         context= {'form': form}
#         return render(request, 'rol/create_rol.html', context) 
    
# def view_rol(request):
#     roles= Roles.objects.all()
#     context={'roles':roles}
#     return render(request, 'rol/roles.html', context)

# def edit_rol(request, id):
#     rol = get_object_or_404(Roles, nombre= id)
#     form= CreateRol(instance=rol)
#     context={'rol':rol, 'form': form}
#     if request.method == 'POST':
#         form= CreateRol(request.POST, instance=rol)
#         if form.is_valid():
#             form.save()
#             return redirect('view_rol')
#     else: 
#         context={'rol':rol, 'form': form, 'error':'Formulario no valido'}
#         return render(request, 'rol/rol_edit.html', context)
#     return render(request, 'rol/rol_edit.html', context)
    
# def delete_rol(request, id):
    # rol = get_object_or_404(Roles, nombre= id)
    # if request.method == 'POST':
    #     rol.delete()
    #     messages.success(request, 'Rol eliminado correctamente')
    #     return redirect('view_rol')
    # else:
    #     return redirect('view_rol')

# def view_user(request):
#     users = Usuarios.objects.all()
#     context= {'users': users}

#     return render(request, 'user/view_user.html', context)

# def create_user(request):
#     if request.method == 'POST':
#         form= CreateUsers(request.POST)

#         if form.is_valid():
#             new_user = form.save(commit=False)
#             tipo_sangre = form.cleaned_data['rh'] 
#             tipo_doc= form.cleaned_data['tipo_doc']
#             if Usuarios.objects.filter(num_doc=request.POST['num_doc']).exists():
#                 context= {'form': form, 'error': 'Usuario ya existente'}
#                 return render(request, 'user/create_users.html', context)
#             else: 
#                 try: 
#                     rh_instance = Rh.objects.get(tipo_sangre=tipo_sangre)
#                     tipo_doc_instance = TipoDoc.objects.get(tipo_documento=tipo_doc)
#                     new_user.rh = rh_instance
#                     new_user.tipo_doc = tipo_doc_instance
#                     new_user.save()
#                     return redirect('index') 
#                 except ValueError:
#                     context = {'form': form, 'error': 'Tipo de datos no encontrados'}
#                     return render(request, 'user/create_users.html', context)
#         else:
#             context= {'form': form, 'error': 'Formulario no valido'}
#             return render(request, 'user/create_users.html', context) 
#     else:
#         form = CreateUsers()
#         context= {'form': form}
#         return render(request, 'user/create_users.html', context) 
    
# def edit_user(request, id):
#     user = get_object_or_404(Usuarios,num_doc=id )
#     form = CreateUsers(instance=user)
#     context={'user':user, 'form':form}
#     if request.method == 'POST':
#         form = CreateUsers(request.POST, instance=user)
#         if form.is_valid():
#             form.save()
#             return redirect('view_users')
#     else: 
#         context={'user':user, 'form': form, 'error':'Formulario no valido'}
#         return render(request, 'user/edit_user.html', context)
#     return render(request, 'user/view_user.html', context)
    
# def delete_user(request, id):
    # user= get_object_or_404(Usuarios, num_doc= id)
    # if request.method == 'POST':
    #     user.delete()
    #     messages.success(request, 'Usuario eliminado correctamente')
    #     return redirect('view_users')
    # else:
    #     return redirect('view_users')
    

#SUBIDA DE EXCEL

# def cargar_users(request):
    try:
        if request.method == 'POST':
            #Se procesa el archivo excel atraves del request.FILES['nombre del campo]/nombre del campor que se espera en el formulario
            archivo_xlsx= request.FILES['archivo_xlsx'] #se toma el name
            #se verifica el nombre del archivo para ver si es '.xlsx'
            #si no es asi retornar error de que debe ser un archivo excel valido
            if archivo_xlsx.name.endswith('.xlsx'):
                #si el archivo es valido utilizamos a la libreria pandas para leerlo(pd)
                #todo lo leido guardarlo en una variable (dataframe = df)
                df = pd.read_excel(archivo_xlsx, header=0) #la header es de donde tiene que empezar a leer
                #se itera df para obtener los valores de la columna 
                #cedula , nombre , email
                for _, row in df.iterrows():
                    cedula = row['cedula']
                    nombre = row['nombre']
                    email = row['email']

                #ACCEDER AL MODELO DONDE SE VAN A CARGAR LOS DATSO
                #el metodo update_or_create en django se utiliza para hacer un registro en la tabla de bd y
                #si lo encuentra , lo actualiza con nuevos valores , si no se encuentra un registro con las condiciones
                #de busquedad especificadas , se crear un nuevop registro
                user, creado= Usuarios.objects.update_or_create(
                    num_doc= cedula, #CONDICIONAL PARA VER SI EXISTE
                    defaults={ #PASSAR DICCIONARIO CON TODOS LOS DATOS /datos a actualizar o a crear
                        'nombre': nombre,
                        'email': email
                    }
                )
                return JsonResponse({'status_server': 'success', 'message': 'Archivo subido correctamente'})
            else: 
                return  JsonResponse({'status_server': 'error', 'message': 'El archivo debe ser un excel valido'})
        else:
            return render(request, 'user/cargar_users')

    except Exception as e:
        print(f"Error al cargar el archivo: {str(e)}")
        return  JsonResponse({'status_server': 'error', 'message': 'Error interno del servidor'})

# def chat_gpt_cargar(request):
    try:
        if request.method == 'POST':
            archivo_xlsx = request.FILES.get('archivo_xlsx')

            if not archivo_xlsx:
                return JsonResponse({'status_server': 'error', 'message': 'No se recibió ningún archivo'}, status=400)

            if not archivo_xlsx.name.endswith('.xlsx'):
                return JsonResponse({'status_server': 'error', 'message': 'El archivo debe ser un Excel válido'}, status=400)

            # Leer el archivo Excel
            df = pd.read_excel(archivo_xlsx, header=0)

            # Iterar sobre el DataFrame para guardar los datos en la BD
            for _, row in df.iterrows():
                cedula = str(row.get('cedula', '')).strip()  # Convertir a str y limpiar espacios
                nombre = str(row.get('nombre', '')).strip()
                email = str(row.get('email', '')).strip()

                # Validación básica
                if not cedula or not nombre or not email:
                    continue  # Saltar filas con datos faltantes

                # Guardar en la base de datos
                user, creado = Usuarios.objects.update_or_create( 
                    num_doc=cedula,  # Condición de búsqueda
                    defaults={  # Datos a actualizar o crear
                        'nombre': nombre,
                        'email': email
                    }
                )

            return JsonResponse({'status_server': 'success', 'message': 'Archivo subido correctamente'})

        else:
            return render(request, 'index.html')

    except Exception as e:
        print(f"Error al cargar el archivo: {str(e)}")
        return JsonResponse({'status_server': 'error', 'message': 'Error interno del servidor'}, status=500)

