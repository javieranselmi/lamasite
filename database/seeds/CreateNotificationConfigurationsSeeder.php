<?php

use Illuminate\Database\Seeder;

class CreateNotificationConfigurationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Configurations = [
            [
                "name" => "course",
                "display_name" => "Cursos",
                "value" => true
            ],
            [
                "name" => "product",
                "display_name" => "Productos",
                "value" => true
            ],
            [
                "name" => "product_category",
                "display_name" => "Categorias Producto",
                "value" => true
            ],
            [
                "name" => "post",
                "display_name" => "Articulo Biblioteca",
                "value" => true
            ],
            [
                "name" => "meetings",
                "display_name" => "Reuniones de Ciclo",
                "value" => true
            ]
        ];

        \App\NotificationConfiguration::insert($Configurations);
    }
}
