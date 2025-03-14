from django.shortcuts import render, HttpResponse, redirect
from miapp.models import Article, Category
from django.db.models import Q
from miapp.forms import FormArticle #Importamos el formulario desde forms.py
from django.contrib import messages #libreria de mensajes
# Create your views here.
# MVC = Modelo Vista Controlador --> Acciones (metodos) 
# MVT = Modelo Template Vista --> Acciones (metodos) 

layout =""" 

        """


def index(request):
    html = """
            <h1>Inicio</h1>
            <p>Años hasta el 2050 </p>
            <ul>
            """
    year= 2024 
    while year <= 2050 :
        if year % 2 == 0 :
            html += f"<li>{str(year)}</li>"
        year +=1
        
    html+= "</ul>"
    nombre= "carlos gomez"
    lenguaje= ["JavaScript", "Python", "PHP", "#c"]


    return render(request,'index.html',{
        "title": "inicio 2",
        "mi_variable": "Soy un dato que esta en la vista",
        "nombre": nombre,
        "lenguajes": lenguaje,
    })

def hola_mundo(request):
    return render(request , 'hola_mundo.html')
    
def pagina(request, redirigir=0):
    
    if redirigir== 1:
        return redirect('/inicio/')
        
    return render(request, ('pagina.html'))
    
    
def contacto(request, nombre ="", apellidos=""):
    html=""

    if nombre and apellidos:
        html="<p>El nombre completo es:</p>"
        html += f"<h3>{nombre} {apellidos}</h3>"
    return HttpResponse(layout + f"<h2>Contacto</h2>" + html)


def crear_articulo(request ,title, content, public):
    articulo= Article(
        title= title,
        content= content,
        public= public
    )
    articulo.save()
    return HttpResponse(f"Articulo creado:<strong>{articulo.title}- {articulo.content} </strong>")


def articulo(request):
    try:
        articulo= Article.objects.get(title="Matrix",public=False)
        response= f"Articulo: <br/>{articulo.id}. {articulo.title} "
    except:
        response= "<h1>Articulo no encontrado</h1>"
    return HttpResponse(response)


def editar_articulo(request, id):
    articulo= Article.objects.get(pk=id)

    articulo.title = "Superman"
    articulo.content="Pelicula del 2010"
    articulo.public = True
    articulo.save()
    return HttpResponse(f"Articulo {articulo.id} Actualizado:<strong>{articulo.title}- {articulo.content} </strong>")


def articulos(request):
    #Consulta ORM
    articulos = Article.objects.all() #PARA VER TODOS LOS OBJETOS 
    # articulos = Article.objects.order_by('id')[0:4] #Para que organice como quiera [] es limit
    articulos= Article.objects.filter(title__exact="articulo") # lookupsfilter #Condiciones en las consultas # contains QUIEN CONTENGA LO QUE ESTA BUSCANDO #exact busca tal cual/ iexact los dos M m

    articulos= Article.objects.filter(title="Articulo").exclude(public=True)
    #Consulta SQL PURO
    articulos = Article.objects.raw("SELECT * FROM miapp_article WHERE title='Articulo' AND public=0 ")#PARA HACER CONSULTAS SQL
    
    #consulta con OR con ORM
    articulos = Article.objects.filter(
        Q(title__contains="Batman") |  Q(title__contains="Superman")
    )
    
    articulos= Article.objects.filter(public=False).order_by('-id')
    
    return render(request, 'articulos.html',{'articulos': articulos } )

def borrar_articulo(request, id):
    articulo = Article.objects.get(pk= id)
    articulo.delete()
    return redirect('articulos')


def crear_articulo(request, title, content, public):
    articulo = Article(
        title= title, #title(Nombre del modelo ) = title(nombre de la variable)
        content = content,
        public = public 
    )
    #Guardamos en bd
    articulo.save()
    return HttpResponse(f"Articulo creado: {articulo.title} - {articulo.content}")

def save_article(request): #No pasamos datos por url lo pasamos por formulario 
    if request.method == "POST":
        title = request.POST['title']
        if len(title) < 5:
            return HttpResponse(f"El titulo es muy pequeño")
        content = request.POST['content']
        public = request.POST['public']
        articulo = Article(
            title= title, #title(Nombre del modelo ) = title(nombre de la variable)
            content = content,
            public = public 
        )
        #Guardamos en bd
        articulo.save()
        return HttpResponse(f"Articulo creado: <strong> {articulo.title} - {articulo.content} </strong>")
    else: 
        return HttpResponse(f"<h2>No se ha podido crear el articulo  </h2>")
    
def create_article(request): #Soporte de plantilla para el formulario 
    return render(request, 'create_article.html')

def create_full_article(request):
    #Realizamos la comprobacion del metodo (POST-GET)
    if request.method == "POST":
        #si llega datos por POST se debe:
        #creamos una variable llamada formulario para instanciar el objeto 
        formulario = FormArticle(request.POST)
        #Aqui podemos validar el formulario con un metodo is_valid
        if formulario.is_valid():
            #generamos una variable para recoger los datos del formulario 
            data_form = formulario.cleaned_data #que son los datos limpios que nos llegan 
            title = data_form.get('title') #lo puede hacer si o 
            content = data_form['content'] # asi tambien se puede
            public = data_form['public']
            
            articulo= Article(
                title = title,
                content = content,
                public = public
            )
            articulo.save()
            
            messages.success(request, f'Ha creado correctamente el archivo {articulo.id}')
            #redireccionar a articulos despues de guardados 
            return redirect('articulos')
            # return HttpResponse(title + ' -- ' + content + ' -- ' + str(public))
            

    else:
        # si nos llegan datos por POST debemos generar un formulario vacio
        formulario= FormArticle()
        
    #se carga la vista en html 
    return render(request, 'create_full_article.html', {
        'form' : formulario
    } )
