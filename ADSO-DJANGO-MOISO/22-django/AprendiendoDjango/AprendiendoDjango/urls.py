"""
URL configuration for AprendiendoDjango project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/5.0/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path
from django.conf import settings

# Importar App con mis vistas
from miapp import views
# import miapp.views Otra forma mas concreta para manejar las Apss
# path('',miapp.views.index, name='index'), Sintaxis de la ruta 
urlpatterns = [
    path('admin/', admin.site.urls),
    
    path('',views.index, name='index'),
    path('inicio/', views.index, name='inicio'),
    path('hola-mundo/', views.hola_mundo , name='hola_mundo' ),
    path('pagina-pruebas/', views.pagina, name='pagina'),
        path('pagina-pruebas/<int:redirigir>', views.pagina, name='pagina'),
    path('contacto/', views.contacto , name='contacto'),
    path('contacto/<str:nombre>/', views.contacto , name='contacto'),
    path('contacto/<str:nombre>/<str:apellidos>', views.contacto , name='contacto'),
    path('crear_articulo/<str:title>/<str:content>/<str:public>', views.crear_articulo , name='crear_articulo'),
    path('articulo/', views.articulo, name='articulo'),
    path('editar_articulo/<int:id>/', views.editar_articulo, name='editar_articulo'),
    path('articulos/', views.articulos, name='articulos'),
    path('borrar_articulo/<int:id>/', views.borrar_articulo, name='borrar'),
    path('save_article/', views.save_article , name='save'),
    path('create_article/', views.create_article , name='create'),
    path('create-full-article/', views.create_full_article , name='create_full'),
]

#Configurar para cambiar imagenes
if settings.DEBUG:
    #Podemos tener accesible la funcion static que permite cargar de una url a un fichero estatico 
    #que pueda leer el framework
    from django.conf.urls.static import static
    urlpatterns += static(settings.MEDIA_URL, document_root= settings.MEDIA_ROOT)
