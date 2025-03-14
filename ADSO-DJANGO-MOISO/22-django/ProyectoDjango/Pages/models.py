from django.db import models
from ckeditor.fields import RichTextField

# Create your models here.
class Page(models.Model):
    #Definimos los campos del modelo y aplicamos verbose_name para traducir en el panel de admininistracion
    title= models.CharField(max_length=50, verbose_name="Titulo")
    content= RichTextField(verbose_name="Contenido")
    slug= models.CharField(unique=True, max_length=150, verbose_name="URL Amigable") #url que va a tener la pagina
    #unique para que sea unico
    visible = models.BooleanField(verbose_name="¿Visible?")
    order = models.IntegerField(default=0, verbose_name="Orden")
    #auto_now_add= True para que adicione la fecha de cuando se crea
    created_at= models.DateTimeField(auto_now_add=True, verbose_name="Creacion:")
    updated_at= models.DateTimeField(auto_now_add=True, verbose_name="Actualizacion: ")

    class Meta:
        verbose_name= "Pagina"
        verbose_name_plural= "Paginas"
    #Metodo str para que cuando se muestre el objeto imprima un string
    def __str__(self):
        return self.title
