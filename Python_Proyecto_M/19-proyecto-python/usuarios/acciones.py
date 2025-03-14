import usuarios.usuario as modelo #Cambio de nombre a modelo
import notas.acciones


class Acciones :
    def registro(self):
        print("\n Ok!!! Vamos a registrarte en el sistema ")

        nombre = input("Cual es tu nombre ?: ")
        apellidos = input("Cuales son tus apellidos ?: ")
        email = input("Introduce tu email: ")
        password = input("Digita tu contraseña: ")

        usuario = modelo.Usuario(nombre,apellidos,email,password)
        registro = usuario.registrar( )

        if registro[0] >= 1:  # Para verificar si se ha registrado 
            print(f"\nPerfecto {registro[1].nombre} te has registrado con el email {registro[1].email}") #Concatena los valores del usuario
        else:
            print("\nNo te has registrado correctamente ")

    def login(self):
        print("vale!!! Identificate en el sistema ....")

        try: #Para ver si esta el emaiL

            email = input("Introduce tu email: ")
            password = input("Digita tu contraseña: ")

            usuario = modelo.Usuario ('','', email, password) #id,nombre,apellidos,email,password,fecha posiciones

            login = usuario.identificar()
            if email == login [3]: #Verifica si el email esta 
                print(f"\nBienvenid@ {login[1]}, ha ingresado correctamente  en el sistema el {login[5]}")
                self.proximasAcciones(login)
        
        except Exception as e :
            # print(type(e))
            # print(type(e).__name__) #Para que te diga cual es el tipo de error
            print(f"Login incorrecto!! Intentalo mas tarde")
    
    def proximasAcciones(self,usuario):
        print("""
        Acciones disponibles:
        - Crear nota (crear)
        - Mostrar tus notas (mostrar)
        - Eliminar nota (eliminar)
        - salir (salir)

        """)
        accion = input("Que quieres hacer?: ")
        hazEl = notas.acciones.Acciones()
        
        
        if accion == "crear":

            hazEl.crear(usuario)  

            self.proximasAcciones(usuario)
        elif accion == "mostrar":

            hazEl.mostrar(usuario)
            self.proximasAcciones(usuario)
        elif accion == "eliminar":
            print("Vamos a eliminar una nota!! ")
            self.proximasAcciones(usuario)
        elif accion == "salir":
            print(f"Ok {usuario[1]}, hasta pronto!!!.. ")
            exit()
        