<?php

use Illuminate\Database\Seeder;

class CreateTextsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $TextTitlesToCreate = ['Cursos Introduccion','Cursos Mi Rendimiento','Productos Introduccion','Ciclos Introduccion','Biblioteca Multimedia Introduccion','Agenda','Footer','Menu Cursos','Menu Productos','Menu Biblioteca','Menu Ciclos','Contactanos', 'Acerca de Nutrisite', 'Terminos y Condiciones'];
        $TextNamesToCreate = ['cursos-introduccion','cursos-mi-rendimiento','productos-introduccion','ciclos-introduccion','biblioteca-multimedia-introduccion','agenda','footer','menu-cursos','menu-productos','menu-biblioteca','menu-ciclos','contactanos', 'acerca-de-nutrisite', 'terminos-condiciones'];
        $TextContent = 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambient';

        foreach($TextNamesToCreate as $index => $TextNameToCreate){
            \App\Text::create(['name' => $TextNameToCreate, 'title' => $TextTitlesToCreate[$index], 'content' => $TextContent]);
        }
    }
}
