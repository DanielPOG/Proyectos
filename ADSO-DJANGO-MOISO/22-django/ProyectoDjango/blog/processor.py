from blog.models import Category , Article
def get_categories(request):

    categories_in_use = Article.objects.filter(public= True).values_list('categories', flat=True)
    categories= Category.objects.filter(id__in= categories_in_use).values_list('id', 'name')
    # id__in Sub consultas en django 
    #Desarrollamos esa consulta para ver solo las categorias en uso en los articulos publicados
    return{
        'categories': categories,
        'ids': categories_in_use
    }