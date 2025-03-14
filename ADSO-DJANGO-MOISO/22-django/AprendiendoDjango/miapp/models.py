from django.db import models

# Create your models here.


#primer paso python manage.py makemigrations
#segundo paso python manage.py sqlmigrate miapp 0001 #crea tabla
#tercer paso python manage.py migrate 


#si quiere mas atributos paso 1 y paso 2 y paso 3

class Article(models.Model):
    #Propiedades *** Documentar cada tipo de dato
    title = models.CharField(max_length=150, verbose_name="Titulo") #Charfield = varchar
    content = models.TextField(verbose_name="Contenido") #Textfield para text-areas
    image= models.ImageField(default="null",verbose_name="Imagen", upload_to="articles")
    public= models.BooleanField(verbose_name="¿Publicado?")
    create_at = models.DateTimeField(auto_now_add=True, verbose_name="Creado")
    update_at=  models.DateTimeField(auto_now=True, verbose_name="Actualizado")
    class Meta:
        #Poner nombre en sigular
        verbose_name="Articulo" 
        verbose_name_plural="Articulos"
    def __strl__(self):
        if self.public:
            public= "(publicado)"
        else:
            public="(privado)"
        return f"{self.title} {public}"
class Category(models.Model):
    name= models.CharField(max_length=110)
    description= models.CharField(max_length=250)
    create_at=models.DateField() 
    class Meta:
        #Poner nombre en sigular
        verbose_name="Categoria"
        verbose_name_plural="Categorias"
