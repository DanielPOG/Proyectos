# Generated by Django 5.1.4 on 2025-02-28 09:24

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('usuarios', '0003_usuarios_is_active_usuarios_is_staff_and_more'),
    ]

    operations = [
        migrations.AlterField(
            model_name='usuarios',
            name='foto',
            field=models.ImageField(blank=True, null=True, upload_to='imagenes/'),
        ),
    ]
