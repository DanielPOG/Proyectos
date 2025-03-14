from django import forms
from .models import Usuarios, Roles, Rh, TipoDoc
from fichas.models import FichasXAprendiz

class CreateUsers(forms.ModelForm):
    nombre = forms.CharField(
        widget=forms.TextInput(attrs={'class': 'form-control'})
    )
    apellido = forms.CharField(
        widget=forms.TextInput(attrs={'class': 'form-control'})
    )
    rh = forms.ModelChoiceField(
        queryset=Rh.objects.all(),
        widget=forms.Select(attrs={'class': 'form-select'}), required=False

    )
    tipo_doc = forms.ModelChoiceField(
        queryset=TipoDoc.objects.all(),
        widget=forms.Select(attrs={'class': 'form-select'})
    )
    num_doc = forms.IntegerField(
        widget=forms.NumberInput(attrs={'class': 'form-control'})
    )
    foto = forms.ImageField(
        widget=forms.ClearableFileInput(attrs={'class': 'form-control'}),
        required=False
    )

    rol = forms.ModelChoiceField(
        queryset=Roles.objects.all(),
        widget=forms.Select(attrs={'class': 'form-select'})
    )
    estado = forms.ChoiceField(
        choices=Usuarios.ESTADO_OPCIONES,
        widget=forms.Select(attrs={'class': 'form-select'})
    )

    class Meta:
        model = Usuarios
        fields = ['nombre', 'apellido', 'rh', 'tipo_doc', 'num_doc', 'foto', 'estado', 'rol']

    def __init__(self, *args, **kwargs):
        super(CreateUsers, self).__init__(*args, **kwargs)

        if self.instance and self.instance.pk:
            self.fields['num_doc'].widget.attrs['readonly'] = True  # Solo lectura
            self.fields['rh'].widget.attrs['disabled'] = True  

    def clean_rh(self):
        if self.instance and self.instance.pk:
            return self.instance.rh  # ⬅️ Se fuerza a mantener el valor original
        return self.cleaned_data.get('rh')



class InsertUser(forms.ModelForm):
    class Meta:
        model = FichasXAprendiz
        fields = ['ficha', 'aprendiz']



    

