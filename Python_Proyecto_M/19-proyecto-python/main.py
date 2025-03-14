"""
Proyecto Python y MySql por consola
- Abrir un asistente 
- Login o registro
- Si elegimos registro , creara un usuario en la BBDD
- Si elegimos login, identifica al usuario y nos pregunta
- Crear nota, mostrar notas, borrarlas 
"""
from usuarios import acciones
print("""

Acciones disponibles:
        - registro
        - login


""")

hazEl= acciones.Acciones() #Llama al modulo y a la clase 

accion = input("Que quiere hacer ?: ")
if accion == "registro": #Opcion de registro
    hazEl.registro()
elif accion == "login": #Opcion de registro
   hazEl.login()