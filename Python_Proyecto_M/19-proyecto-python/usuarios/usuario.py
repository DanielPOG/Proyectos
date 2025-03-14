
import hashlib
import datetime 
import usuarios.conexion as conexion 

connect = conexion.conectar()
database = connect[0]
cursor = connect[1]

class Usuario:
    def __init__ (self, nombre, apellidos, email, password): #Metodo constructor 
        self.nombre= nombre
        self.apellidos = apellidos
        self.email = email
        self.password = password

    def registrar (self):
        fecha = datetime.datetime.now() #Dar la fecha

        #Cifrar contraseña
        cifrado = hashlib.sha256()
        cifrado.update(self.password.encode('utf8'))

        sql = "INSERT INTO usuarios VALUES (null , %s, %s,%s,%s, %s)" #Insertar esos valores a la tabla usuarios

        usuario= (self.nombre, self.apellidos, self.email, cifrado.hexdigest(), fecha )
        try: 
            cursor.execute(sql,usuario)
            database.commit()
            result= [cursor.rowcount, self]

        except:
            result = [0, self] #Por si hay un email repetido que de 0 para que no se cumpla el condicional de registro

        return result
    
    def identificar(self):
        #Consulta para comprobar si existe el usuario 
        sql = "SELECT * FROM usuarios WHERE email = %s AND password = %s"
        
        #Cifrar contraseña
        cifrado = hashlib.sha256()
        cifrado.update(self.password.encode('utf8'))

        #Datos a conocer 
        usuario = (self.email, cifrado.hexdigest())
       
        cursor.execute(sql,usuario)
        result = cursor.fetchone ()
        return result