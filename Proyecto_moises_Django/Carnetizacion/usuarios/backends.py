# backends.py
from django.contrib.auth.backends import BaseBackend
from .models import Usuarios

class CustomAuthBackend(BaseBackend):
    def authenticate(self, request, num_doc=None, password=None):
        try:
            user = Usuarios.objects.get(num_doc=num_doc)  # Buscar el usuario por num_doc
            if user and user.password == password:  # Verificar que la contraseña coincida (aún si usas num_doc)
                return user
        except Usuarios.DoesNotExist:
            return None
