import datetime
from django import forms
from django.utils import timezone
from .models import Fichas, Usuarios, TipoPrograma, FichasXAprendiz
from usuarios.models import Roles

class CreateFicha(forms.ModelForm):
    fecha_inicio = forms.DateField(
        widget=forms.DateInput(attrs={'class': 'form-control', 'type': 'date'}),
        initial=timezone.now().date(),  
        required=False
    )
    fecha_final = forms.DateField(
        widget=forms.DateInput(attrs={'class': 'form-control', 'type': 'date'}),
        required=False
    )
    numero_ficha = forms.CharField(
        widget=forms.TextInput(attrs={'class': 'form-control'})
    )
    lider_ficha = forms.ModelChoiceField(
        queryset=Usuarios.objects.none(),
        widget=forms.Select(attrs={'class': 'form-select'}),
        required=False
    )
    tipo_programa = forms.ModelChoiceField(
        queryset=TipoPrograma.objects.all(),
        widget=forms.Select(attrs={'class': 'form-select'}),
        required=True
    )

    class Meta: 
        model = Fichas
        fields = ['numero_ficha', 'lider_ficha', 'tipo_programa', 'fecha_inicio', 'fecha_final']

    def __init__(self, *args, **kwargs):
        super(CreateFicha, self).__init__(*args, **kwargs)

        # Si la instancia ya tiene una fecha de inicio, mostrarla, si no, usar la fecha actual
        if self.instance and self.instance.pk and self.instance.fecha_inicio:
            self.initial['fecha_inicio'] = self.instance.fecha_inicio
        else:
            self.initial['fecha_inicio'] = timezone.now().date()
            
        # Si la ficha ya existe (es decir, se está editando), hacer que número de ficha sea de solo lectura
        if self.instance and self.instance.pk:  
            self.fields['numero_ficha'].widget.attrs['readonly'] = True  # 🔹 Solo lectura al editar
            self.fields['tipo_programa'].widget.attrs['disabled'] = True  
   

        # Filtrar solo los instructores en el campo 'lider_ficha' 
        try:
            instructor_role = Roles.objects.get(tipo_rol=Roles.INSTRUCTOR)
            self.fields['lider_ficha'].queryset = Usuarios.objects.filter(rol=instructor_role)
        except Roles.DoesNotExist:
            self.fields['lider_ficha'].queryset = Usuarios.objects.none()



    def clean_fecha_final(self):
        fecha_final = self.cleaned_data.get("fecha_final")
        if fecha_final:
            fecha_final = datetime.datetime.combine(fecha_final, datetime.time.min)
            return timezone.make_aware(fecha_final, timezone.get_current_timezone())
        return fecha_final
    
class CargarUsers(forms.ModelForm):
    ficha = forms.ModelChoiceField(
        queryset=Fichas.objects.all(),
        widget=forms.Select(attrs={'class': 'form-select', 'id': 'id_ficha'}),
        to_field_name="id",  # Esto asegura que Django use el ID internamente
        required=False
    )
    aprendiz = forms.ModelChoiceField(
        queryset=Usuarios.objects.all(),
        widget=forms.Select(attrs={'class': 'form-select'}),
        required=False
    )

    class Meta:
        model = FichasXAprendiz
        fields = ['ficha', 'aprendiz']

    def __init__(self, *args, **kwargs):
        super(CargarUsers, self).__init__(*args, **kwargs)
        # Deshabilitar el campo ficha manualmente siempre
        self.fields['ficha'].widget.attrs['disabled'] = True
