from django.db import models

# Create your models here.

class Rh(models.Model): #Definimos class de RH para un metodo choice 
    A_POSITIVE = 'A+'
    A_NEGATIVE = 'A-'
    B_POSITIVE = 'B+'
    B_NEGATIVE = 'B-'
    O_POSITIVE = 'O+'
    O_NEGATIVE = 'O-'
    AB_POSITIVE = 'AB+'
    AB_NEGATIVE = 'AB-'

    TIPO_SANGRE_OPCIONES = [
        (A_POSITIVE, 'A+'),
        (A_NEGATIVE, 'A-'),
        (B_POSITIVE, 'B+'),
        (B_NEGATIVE, 'B-'),
        (O_POSITIVE, 'O+'),
        (O_NEGATIVE, 'O-'),
        (AB_POSITIVE, 'AB+'),
        (AB_NEGATIVE, 'AB-'),
    ]
    tipo_sangre = models.CharField(max_length=3, choices=TIPO_SANGRE_OPCIONES)
    class Meta:
        verbose_name_plural = 'Rhs'
        verbose_name = 'Rh'
    def __str__(self):
        return self.tipo_sangre



    
class TipoDoc(models.Model):#Definimos class de TipoDoc para un metodo choice 
    REGISTRO_CIVIL = 'RC'
    TARJETA_DE_IDENTIDAD = 'TI'
    CEDULA_DE_CIUDADANIA = 'CC'
    TARJETA_DE_EXTRANJERIA = 'TE'
    CEDULA_DE_EXTRANJERIA = 'CE'
    NUMERO_DE_IDENTIFICACION_TRIBUTARIA = 'NIT'
    PASAPORTE = 'PP'
    PERMISO_ESPECIAL_DE_PERMANENCIA = 'PEP'
    DOCUMENTO_DE_IDENTIFICACION_EXTRANJERO = 'DIE'

    TIPO_DOCUMENTO_OPCIONES = [
        (REGISTRO_CIVIL, 'RC'),
        (TARJETA_DE_IDENTIDAD, 'TI'),
        (CEDULA_DE_CIUDADANIA, 'CC'),
        (TARJETA_DE_EXTRANJERIA, 'TE'),
        (CEDULA_DE_EXTRANJERIA, 'CE'),
        (NUMERO_DE_IDENTIFICACION_TRIBUTARIA, 'NIT'),
        (PASAPORTE, 'PP'),
        (PERMISO_ESPECIAL_DE_PERMANENCIA, 'PEP'),
        (DOCUMENTO_DE_IDENTIFICACION_EXTRANJERO, 'DIE'),
    ]
    tipo_documento = models.CharField(max_length=100, choices=TIPO_DOCUMENTO_OPCIONES)
    class Meta:
        verbose_name_plural = 'Documentos'
        verbose_name = 'Documento'
    def __str__(self):
        return self.tipo_documento 




    
class Roles(models.Model):
    INSTRUCTOR = 'Instructor'
    APRENDIZ = 'Aprendiz'
    ADMIN = 'Admin'

    TIPO_ROL = [
        (INSTRUCTOR, 'Instructor'),
        (APRENDIZ, 'Aprendiz'),
        (ADMIN, 'Admin'),
    ]

    tipo_rol = models.CharField(
        max_length=100,
        choices=TIPO_ROL,
        default=APRENDIZ  # Establece un valor por defecto, por ejemplo, 'Aprendiz'
    )
    class Meta:
        verbose_name_plural = 'Roles'
        verbose_name = 'Rol'
    def __str__(self):
        return self.tipo_rol
    

# models.py
from django.contrib.auth.models import AbstractBaseUser, BaseUserManager



# 1. Crear un Usuario Manager personalizado
class UsuariosManager(BaseUserManager):
    def create_user(self, num_doc, password=None, rol=None, **extra_fields):
        """
        Crea y guarda un usuario con el número de documento (num_doc) y la contraseña.
        Si el usuario es un aprendiz, la contraseña será el mismo número de documento.
        """
        if not num_doc:
            raise ValueError('El número de documento debe ser proporcionado')

        extra_fields.setdefault('is_active', True)

        user = self.model(num_doc=num_doc, rol=rol, **extra_fields)

        # Si no se proporciona una contraseña y el rol es 'aprendiz', usar el num_doc como contraseña
        if not password and rol and getattr(rol, "tipo_rol", None) == "Aprendiz":  
            password = str(num_doc)  # Asignamos el num_doc como contraseña

        if password:
            user.set_password(password)  # Encriptar la contraseña
        else:
            raise ValueError("El usuario debe tener una contraseña")  # Evitar superusuarios sin clave

        user.save(using=self._db)
        return user

    def create_superuser(self, num_doc, password=None, **extra_fields):
        """
        Crea y guarda un superusuario con el número de documento (num_doc) y la contraseña.
        """
        extra_fields.setdefault('is_staff', True)
        extra_fields.setdefault('is_superuser', True)

        if not password:
            raise ValueError("El superusuario debe tener una contraseña")

        return self.create_user(num_doc, password, **extra_fields)

# 2. Modificar el modelo Usuarios para que herede de AbstractBaseUser
from django.contrib.auth.models import AbstractBaseUser, BaseUserManager, PermissionsMixin

class Usuarios(AbstractBaseUser, PermissionsMixin):  # Agregar PermissionsMixin
    ACTIVO = 1
    INACTIVO = 0
    ESTADO_OPCIONES = [
        (INACTIVO, 'Inactivo'),
        (ACTIVO, 'Activo'),
    ]

    # Campos personalizados
    nombre = models.CharField(max_length=200)
    apellido = models.CharField(max_length=200)
    rh = models.ForeignKey('Rh', on_delete=models.SET_NULL, null=True, blank=True)
    tipo_doc = models.ForeignKey('TipoDoc', on_delete=models.SET_NULL, null=True, blank=True)
    num_doc = models.IntegerField(unique=True)  # Este es el campo único de autenticación
    foto = models.ImageField(upload_to='imagenes/', blank=True, null=True)
    estado = models.IntegerField(choices=ESTADO_OPCIONES, default=INACTIVO)
    rol = models.ForeignKey('Roles', on_delete=models.SET_NULL, null=True)

    # Campos estándar de AbstractBaseUser
    is_active = models.BooleanField(default=True)
    is_staff = models.BooleanField(default=False)
    is_superuser = models.BooleanField(default=False)
    last_login = models.DateTimeField(auto_now=True)

    USERNAME_FIELD = 'num_doc'
    REQUIRED_FIELDS = ['nombre', 'apellido']

    password = models.CharField(max_length=128, null=True, blank=True)

    objects = UsuariosManager()

    class Meta:
        verbose_name_plural = 'Usuarios'
        verbose_name = 'Usuario'

    def __str__(self):
        return f"{self.nombre} {self.apellido} - {self.rol}"

    def is_active_user(self):
        return self.estado == self.ACTIVO

    # Métodos necesarios para Django Admin y permisos
    def has_perm(self, perm, obj=None):
        """Define si el usuario tiene un permiso específico."""
        return True  # O modificarlo si hay una lógica más compleja

    def has_module_perms(self, app_label):
        """Define si el usuario tiene permisos para ver una app en el admin."""
        return True
