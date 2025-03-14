from django.contrib import admin
from .models import Fichas
# Register your models here.
class FichaAdmin(admin.ModelAdmin):
    readonly_fields= ('fecha_inicio',)
admin.site.register(Fichas, FichaAdmin)