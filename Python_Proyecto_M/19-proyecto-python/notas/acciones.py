import notas.nota as modelo

class Acciones:

    def crear (self, usuario):
        print(f"\n Ok {usuario[1]} !! Vamos a crear una nota. . . ")
        titulo = input("Introduce el titulo de la nota: ")
        descripcion = input("Digite el contenido de la nota: ")
        nota = modelo.Nota(usuario[0], titulo, descripcion)
        guardar= nota.guardar()

        if guardar[0] >= 1:
            print(f"\nPerfecto has guardado la nota: {nota.titulo}")
        else:
            print(f"\nNo se ha guardado la nota, lo siento {usuario[1]}") 
    
    def mostrar(self, usuario):
        print(f"\n Vale el {usuario[1]}!! Aqui tienes tus notas: ")
    
        nota = modelo.Nota(usuario[0])
        notas = nota.listar()

        print(notas)
