# Generated by Django 3.0.5 on 2020-05-25 12:13

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('app', '0013_auto_20200525_1716'),
    ]

    operations = [
        migrations.AlterField(
            model_name='patient',
            name='gender',
            field=models.PositiveSmallIntegerField(
                choices=[(1, 'Female'), (2, 'Male'), (3, 'Others')], default=3
            ),
        ),
    ]