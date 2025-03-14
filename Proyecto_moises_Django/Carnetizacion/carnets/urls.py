from django.urls import path
from carnets import views
urlpatterns = [
    path('carnet/', views.carnet_view, name='view_carnet'),
    path('carnet_admin/', views.carnet_admin, name='carnet_admin'),
    path('carnet_index/', views.carnet_index, name='carnet_index'),
    path('exportar-carnets/', views.exportar_carnets_excel, name='exportar_carnets_excel'),
    path("estado_carnet/<int:id>/", views.estado_carnet, name="estado_carnet"),
]