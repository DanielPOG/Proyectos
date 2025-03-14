from django.db import models
from usuarios.models import Usuarios
from django.utils import timezone  
# Create your models here.
class TipoPrograma(models.Model):
    TECNICO= 'Tecnico'
    TECNOLOGO= 'Tecnologo'
    TIPO_PROGRAMA= [
        (TECNICO, 'Tecnico'),
        (TECNOLOGO, 'Tecnologo'),
    ]
    
    tipo_programa= models.CharField(max_length=200, choices=TIPO_PROGRAMA)
    class Meta:
        verbose_name_plural = 'TipoProgramas'
        verbose_name= 'TipoPrograma'
    def __str__(self):
        return self.tipo_programa
    
class Fichas(models.Model): #Definimos class de Fichas para creacion de esta
    numero_ficha = models.IntegerField(unique=True)
    fecha_inicio= models.DateTimeField(default=timezone.now, null=True, blank=True)
    fecha_final= models.DateTimeField(null=True, blank=True)
    lider_ficha = models.ForeignKey(Usuarios, on_delete=models.SET_NULL, null=True)
    tipo_programa= models.ForeignKey(TipoPrograma, on_delete=models.SET_NULL, null=True, blank=True)
    class Meta:
        verbose_name_plural ='Fichas'
        verbose_name='Ficha'
    def __str__(self):
        return str(self.numero_ficha)
    
class FichasXAprendiz(models.Model):
    ficha= models.ForeignKey(Fichas, on_delete=models.CASCADE)
    aprendiz= models.ForeignKey(Usuarios, on_delete=models.CASCADE) 
    
    
# from usuarios.models import TipoDoc
# valores= ['RC','TI','CC','TE','CE','NIT','PP','PEP', 'DIE']
# for v in valores:
#     TipoDoc.objects.create(tipo_documento=v)
    
# from usuarios.models import Rh
# valores= ['A+','A-','B+','B-','O+','O-','AB+','AB-']
# for v in valores:
#     Rh.objects.create(tipo_sangre=v)

# from fichas.models import TipoPrograma
# valores= ['Tecnico','Tecnologo']
# for v in valores:
#     TipoPrograma.objects.create(tipo_programa=v)

# from usuarios.models import Roles
# valores= ['Instructor','Aprendiz', 'Admin']
# for v in valores:
#     Roles.objects.create(tipo_rol=v)