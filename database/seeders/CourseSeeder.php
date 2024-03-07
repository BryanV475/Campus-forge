<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seed the courses
        $courses = [
            ['name' => 'Calculo Diferencial e Integral', 'description' => 'Derivadas e integrales', 'image_url' => '', 'level' => 1, 'syllabus_url' => ''],
            ['name' => 'Quimica', 'description' => 'Elementos Quimicos', 'image_url' => '', 'level' => 1, 'syllabus_url' => ''],
            ['name' => 'Fundamentos de Programacion', 'description' => 'Programacion Basica Pseint', 'image_url' => '', 'level' => 1, 'syllabus_url' => ''],
            ['name' => 'Algebra Lineal', 'description' => 'Matrices, Gauss algebra basica', 'image_url' => '', 'level' => 1, 'syllabus_url' => ''],
            ['name' => 'Fundamentos de la Ingenieria de Software', 'description' => 'Elementos basicos del software y de que se compone', 'image_url' => '', 'level' => 1, 'syllabus_url' => ''],
            ['name' => 'Metodologia de la Investigacion', 'description' => 'Pasos basicos para como comenzar una investigacion', 'image_url' => '', 'level' => 1, 'syllabus_url' => ''],
            ['name' => 'Calculo Vectorial', 'description' => 'Origen y utilizacion de los vectores, operaciones con vectores', 'image_url' => '', 'level' => 2, 'syllabus_url' => ''],
            ['name' => 'Fisica 1', 'description' => 'Fundamentos de la fisica, leyes de la fisica', 'image_url' => '', 'level' => 2, 'syllabus_url' => ''],
            ['name' => 'Ecuaciones Diferenciales y Ordinarias', 'description' => 'Principio de las Ecuaciones diferenciales ordinarias, ejercicios, metodos', 'image_url' => '', 'level' => 2, 'syllabus_url' => ''],
            ['name' => 'Liderazgo', 'description' => 'Como ser un lider, fundamentos de liderar', 'image_url' => '', 'level' => 2, 'syllabus_url' => ''],
            ['name' => 'Programacion Orientada a Objetos', 'description' => 'Programacion sobre objetos, como funcionan, java', 'image_url' => '', 'level' => 2, 'syllabus_url' => ''],
            ['name' => 'Estructura de Datos', 'description' => 'Como estructurar datos, orden de las estructuras, tipos', 'image_url' => '', 'level' => 3, 'syllabus_url' => ''],
            ['name' => 'Modelos Discretos para Ingenieria', 'description' => 'Componentes de los modelos discretos utilizados en ingenieria', 'image_url' => '', 'level' => 3, 'syllabus_url' => ''],
            ['name' => 'Estadistica', 'description' => 'Como funciona la estadistica, fundamentos', 'image_url' => '', 'level' => 3, 'syllabus_url' => ''],
            ['name' => 'Metodos Numericos', 'description' => 'Resolucion de problemas matematicos, matlab', 'image_url' => '', 'level' => 3, 'syllabus_url' => ''],
            ['name' => 'Cultura Ambiental', 'description' => 'Fundamentos para una cultura con el medio ambiente', 'image_url' => '', 'level' => 3, 'syllabus_url' => ''],
            ['name' => 'Realidad Nacional y Geopolitica', 'description' => 'Geopolitica de nuestro pais y como vivimos actualmente', 'image_url' => '', 'level' => 3, 'syllabus_url' => ''],
            ['name' => 'Modelos de Procesos de Desarrollo de Software', 'description' => 'Todos los modelos que se presentan en el desarrollo de Software', 'image_url' => '', 'level' => 4, 'syllabus_url' => ''],
            ['name' => 'Ingenieria de Usabilidad', 'description' => 'Como hacer el software usable, y metodologias', 'image_url' => '', 'level' => 4, 'syllabus_url' => ''],
            ['name' => 'Computacion Digital', 'description' => 'Fundamentos de la computacion y como funciona', 'image_url' => '', 'level' => 4, 'syllabus_url' => ''],
            ['name' => 'Sistemas de Bases de Datos', 'description' => 'Como funcionan las bases de datos, comandos', 'image_url' => '', 'level' => 4, 'syllabus_url' => ''],
            ['name' => 'Programacion Web', 'description' => 'Inicios de la programacion web, html, css', 'image_url' => '', 'level' => 4, 'syllabus_url' => ''],
            ['name' => 'Computacion Paralela', 'description' => 'Como realizar varios procesos en un mismo proyecto', 'image_url' => '', 'level' => 4, 'syllabus_url' => ''],
            ['name' => 'Redes de Computadoras', 'description' => 'Como funciona la LAN, WAN, ethernet', 'image_url' => '', 'level' => 5, 'syllabus_url' => ''],
            ['name' => 'Investigacion en la Ingenieria de Software', 'description' => 'Como se realizan investigaciones en el campo de la ingenieria de software', 'image_url' => '', 'level' => 5, 'syllabus_url' => ''],
            ['name' => 'Ingenieria de Requisitos de Software', 'description' => 'Como elicitar correctamente requisitos para el desarrollo de software', 'image_url' => '', 'level' => 5, 'syllabus_url' => ''],
            ['name' => 'Computacion Grafica', 'description' => 'Fundamentos de la programacion grafica, motores graficos', 'image_url' => '', 'level' => 5, 'syllabus_url' => ''],
            ['name' => 'Sistemas Avanzados de Bases de Datos', 'description' => 'Sistemas de bases de datos mas avanzados, en la nube', 'image_url' => '', 'level' => 5, 'syllabus_url' => ''],
            ['name' => 'Desarrollo Web Avanzado', 'description' => 'Paginas web mas avanzadas en su desarrollo, uso de otras tecnologias, CRUD', 'image_url' => '', 'level' => 5, 'syllabus_url' => ''],
            ['name' => 'Sistemas Operativos', 'description' => 'Como funcionan los sistemas, fundamentos de sistemas operativos', 'image_url' => '', 'level' => 6, 'syllabus_url' => ''],
            ['name' => 'Aplicaciones Basadas en el Conocimiento', 'description' => 'Introduccion a la IA, como funciona', 'image_url' => '', 'level' => 6, 'syllabus_url' => ''],
            ['name' => 'Analisis y Diseño de Software', 'description' => 'Patrones de diseño de software', 'image_url' => '', 'level' => 6, 'syllabus_url' => ''],
            ['name' => 'Lectura y Escritura de Textos Academicos', 'description' => 'Como escribir textos academicos de forma correcta, formatos', 'image_url' => '', 'level' => 6, 'syllabus_url' => ''],
            ['name' => 'Desarrollo de Aplicaciones Moviles', 'description' => 'Introduccion a la programacion movil, flutter', 'image_url' => '', 'level' => 6, 'syllabus_url' => ''],
            ['name' => 'Pruebas de Software', 'description' => 'Como probar los softwares que se realizan, documentacion', 'image_url' => '', 'level' => 6, 'syllabus_url' => ''],
            ['name' => 'Desarrollo de Videojuegos', 'description' => 'Introduccion a Unity', 'image_url' => '', 'level' => 7, 'syllabus_url' => ''],
            ['name' => 'Ingenieria de la Seguridad del Software', 'description' => 'Como aplicar seguridad dentro del software', 'image_url' => '', 'level' => 7, 'syllabus_url' => ''],
            ['name' => 'Aseguramiento de la Calidad del Software', 'description' => 'Como realizar software de calidad', 'image_url' => '', 'level' => 7, 'syllabus_url' => ''],
            ['name' => 'Desarrollo de Software Seguro', 'description' => 'Como desarrollar software de forma seguro, procesos, metodologias', 'image_url' => '', 'level' => 7, 'syllabus_url' => ''],
            ['name' => 'Aplicaciones Distribuidas', 'description' => 'Como distribuir aplicaciones', 'image_url' => '', 'level' => 7, 'syllabus_url' => ''],
            ['name' => 'Arquitectura de Software', 'description' => 'Tipos de arquitectura para desarrollar software', 'image_url' => '', 'level' => 8, 'syllabus_url' => ''],
            ['name' => 'Gestion de Proyectos de Software', 'description' => 'Como gestionar proyectos de forma segura y correcta', 'image_url' => '', 'level' => 8, 'syllabus_url' => ''],
            ['name' => 'Desarrollo de Software Aplicado al Dominio de la Interculturalidad', 'description' => 'Como desarrollar software global', 'image_url' => '', 'level' => 8, 'syllabus_url' => ''],
            ['name' => 'Gestion y Emprendimiento', 'description' => 'Como realizar un emprendimiento de forma correcta', 'image_url' => '', 'level' => 8, 'syllabus_url' => ''],
            ['name' => 'Construccion y Evolucion del Software', 'description' => 'Como construir software y hacerlo evolucionar', 'image_url' => '', 'level' => 8, 'syllabus_url' => '']
        ];

        foreach ($courses as $course) {
           Course::create($course);
        }
    }
}
