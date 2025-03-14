from django.urls import path
from . import views


urlpatterns = [
    path('', views.index, name='index'), #Configuracion de ruta vacia vinculada al index
    path('inicio/', views.index, name='inicio'), #Cuando encuentre la ruta inicio
    path('registro/', views.register_page, name='register'),
    path('login/', views.login_page, name='login'),
    path('logout/', views.logout_user, name='logout'),
]
