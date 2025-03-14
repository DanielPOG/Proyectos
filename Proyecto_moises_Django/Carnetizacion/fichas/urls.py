from django.urls import path
from fichas import views
urlpatterns = [

    path('ficha/index_ficha/', views.index_ficha, name='index_ficha'),
    path('buscar-usuario/', views.buscar_usuario, name='buscar_usuario'),
    path('ficha/editar_ficha/', views.editar_ficha, name='editar_ficha'),
    path('ficha/crear_ficha/', views.crear_ficha, name='crear_ficha'),
    path('ficha/editar_ficha/<int:id>', views.editar_ficha, name='editar_ficha'),
    path('cargar_users/<int:ficha_id>/', views.cargar_users, name='cargar_users'),
    path('ficha_users/<int:id>/', views.ficha_users, name='ficha_users'),
    path('editar_modal_user/<int:id>/', views.modal_edit_user, name='editar_modal_user'),


    path('ficha/ficha_detail/<int:id>', views.ficha_detail, name='ficha_detail'),
    path('ficha/delete_ficha/<int:id>', views.delete_ficha, name='delete_ficha'),
]