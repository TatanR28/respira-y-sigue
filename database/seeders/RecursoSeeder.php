<?php

namespace Database\Seeders;

use App\Models\Recurso;
use Illuminate\Database\Seeder;

class RecursoSeeder extends Seeder
{
    public function run(): void
    {
        $recursos = [
            [
                'tipo' => 'articulo',
                'icono' => '🧠',
                'titulo' => '¿Qué es la ansiedad?',
                'descripcion' => 'Entiende qué es, sus causas y cómo puede afectarte.',
                'contenido' => "La ansiedad es una respuesta natural del cuerpo ante el estrés o el peligro. Se convierte en un problema cuando aparece con mucha frecuencia, intensidad, o sin una causa clara.\n\nAlgunos síntomas comunes incluyen preocupación excesiva, tensión muscular, dificultad para concentrarte, y alteraciones del sueño.\n\nSi sientes que la ansiedad está afectando tu día a día de forma constante, hablar con un profesional de la salud mental puede ayudarte a manejarla mejor.",
            ],
            [
                'tipo' => 'articulo',
                'icono' => '💗',
                'titulo' => 'Autoestima: ¿por qué es importante?',
                'descripcion' => 'Claves para mejorar tu relación contigo mismo.',
                'contenido' => "La autoestima es la valoración que haces de ti mismo. Una autoestima saludable te permite enfrentar los retos de la vida con más confianza y resiliencia.\n\nAlgunas formas de fortalecerla: reconoce tus logros por pequeños que sean, evita compararte constantemente con otros, y practica hablarte con la misma amabilidad con la que tratarías a un amigo.",
            ],
            [
                'tipo' => 'articulo',
                'icono' => '☁️',
                'titulo' => 'Hábitos saludables',
                'descripcion' => 'Pequeños cambios que mejoran tu bienestar diario.',
                'contenido' => "El bienestar emocional también depende de hábitos físicos: dormir lo suficiente, mantenerte hidratado, moverte un poco cada día, y limitar el tiempo frente a pantallas antes de dormir.\n\nNo necesitas cambiar todo de golpe — elige un hábito pequeño esta semana y constrúyelo poco a poco.",
            ],
            [
                'tipo' => 'lectura',
                'icono' => '📖',
                'titulo' => 'El poder de las pequeñas pausas',
                'descripcion' => 'Una reflexión corta sobre la importancia de detenerse.',
                'contenido' => "Vivimos acelerados, saltando de una tarea a otra sin darnos espacio para respirar. Pero el descanso no es pereza: es una parte necesaria de cualquier proceso sostenible.\n\nUna pausa de 5 minutos entre tareas puede ayudarte a regresar con más claridad y menos tensión acumulada. Inténtalo hoy: detente, respira profundo tres veces, y continúa.",
            ],
            [
                'tipo' => 'video',
                'icono' => '🎬',
                'titulo' => 'Introducción a la respiración consciente',
                'descripcion' => 'Un video corto explicando los beneficios de respirar con atención.',
                'url' => 'https://www.youtube.com/results?search_query=respiracion+consciente',
            ],
            [
                'tipo' => 'audio',
                'icono' => '🎧',
                'titulo' => 'Sonidos de lluvia para relajarte',
                'descripcion' => 'Un audio ambiental de 10 minutos para acompañar tu descanso.',
                'url' => 'https://www.youtube.com/results?search_query=sonidos+de+lluvia+relajante',
            ],
        ];

        foreach ($recursos as $recurso) {
            Recurso::create($recurso);
        }
    }
}