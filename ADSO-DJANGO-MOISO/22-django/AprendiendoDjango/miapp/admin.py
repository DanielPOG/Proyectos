from django.contrib import admin
from .models import Article , Category
# Register your models here.
class ArticleAdmin(admin.ModelAdmin):
    #Mostrar campos solo de lectura
    readonly_fields=('create_at', 'update_at')
    
admin.site.register(Article,ArticleAdmin)
admin.site.register(Category)

#configurar el titulo del panel 
admin.site.site_header= "Django ADSO - SENA"
admin.site.site_title= "Django ADSO - SENA"
admin.site.index_title= "Panel de Gestion"