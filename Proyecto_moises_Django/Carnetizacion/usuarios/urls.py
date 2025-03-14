from django.urls import path
from usuarios import views
urlpatterns = [
    path('sdfsdf', views.index, name='index'),
    path('interfaz_index/', views.prueba, name='interfaz_index'),# PRUEBA DE PAGINA
    path('user/index_user/', views.index_user, name='index_user'),# INDEX USER PAGINA
    path('user/crear_user/', views.crear_user, name='crear_user'),# CREAR USER PAGINA
    path('user/editar_user/<int:id>', views.editar_user, name='editar_user'),# EDITAR USER PAGINA
    path('user/login_user/', views.login_user, name='login_user'), #ENTRADA DE APRENDICES
    path('', views.login_admin, name='login_admin'), #ENTRADA DE ADMIN /INSTRUCTORES
    path('logout/all', views.logout_all, name='logout_all'), #SALIDA DE TODOS
    path('validar_ficha/<int:ficha_numero>/', views.validar_ficha, name='validar_ficha'),
    path('eliminar_user/<int:id>/', views.eliminar_user, name='eliminar_user'),



    # path('rol/create_rol/', views.create_rol, name='create_rol'),
    # path('rol/roles/', views.view_rol, name='view_rol'),
    # path('rol/edit_rol/<str:id>', views.edit_rol, name='edit_rol'),
    # path('rol/delete_rol/<str:id>', views.delete_rol, name='delete_rol'),
    # path('user/view_user/', views.view_user, name='view_users'),
    # path('user/create_users/', views.create_user, name='create_users'),
    # path('user/edit_user/<int:id>', views.edit_user, name='edit_user'),
    # path('user/delete_user/<int:id>', views.delete_user, name='delete_user'),
    # path('user/insertar_users/', views.insertar_users, name='insertar_users'),  # Formulario para insertar usuarios
    # path('buscar-aprendiz/', views.buscar_aprendiz, name='buscar_aprendiz'),  # URL para la búsqueda AJAX
    # path('cargar_users/', views.cargar_users, name='cargar_users'),

]