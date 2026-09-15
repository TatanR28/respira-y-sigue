<?php

namespace Database\Seeders;

use App\Models\Ejercicio;
use Illuminate\Database\Seeder;

class EjercicioSeeder extends Seeder
{
    public function run(): void
    {
        $ejercicios = [
            [
                'categoria' => 'respiracion',
                'titulo' => 'Respiración 4-7-8',
                'descripcion' => 'Una técnica sencilla para calmar el sistema nervioso en pocos minutos.',
                'instrucciones' => "1. Siéntate en un lugar cómodo con la espalda recta.\n2. Inhala por la nariz contando hasta 4.\n3. Sostén la respiración contando hasta 7.\n4. Exhala lentamente por la boca contando hasta 8.\n5. Repite el ciclo 4 veces.",
                'duracion_minutos' => 5,
            ],
            [
                'categoria' => 'respiracion',
                'titulo' => 'Respiración diafragmática',
                'descripcion' => 'Respiración profunda desde el abdomen para reducir la tensión física.',
                'instrucciones' => "1. Acuéstate o siéntate cómodamente.\n2. Coloca una mano en el pecho y otra en el abdomen.\n3. Inhala profundamente por la nariz, sintiendo cómo se eleva el abdomen (no el pecho).\n4. Exhala lentamente por la boca, sintiendo cómo baja el abdomen.\n5. Repite durante 5 minutos, manteniendo un ritmo lento y constante.",
                'duracion_minutos' => 5,
            ],
            [
                'categoria' => 'relajacion',
                'titulo' => 'Relajación muscular progresiva',
                'descripcion' => 'Libera la tensión de tu cuerpo tensando y relajando cada grupo muscular.',
                'instrucciones' => "1. Siéntate o acuéstate en un lugar tranquilo.\n2. Comienza por los pies: tensa los músculos con fuerza durante 5 segundos y luego suelta.\n3. Sube a las pantorrillas, muslos, abdomen, manos, brazos, hombros, cuello y rostro, repitiendo el mismo proceso en cada zona.\n4. Nota la diferencia entre la tensión y la relajación en cada grupo muscular.\n5. Termina respirando profundamente unas cuantas veces.",
                'duracion_minutos' => 10,
            ],
            [
                'categoria' => 'relajacion',
                'titulo' => 'Liberación de tensión rápida',
                'descripcion' => 'Una versión corta para liberar tensión cuando tienes poco tiempo.',
                'instrucciones' => "1. Aprieta los puños con fuerza durante 5 segundos y suelta.\n2. Encoge los hombros hacia las orejas durante 5 segundos y suelta.\n3. Aprieta los ojos y la mandíbula durante 5 segundos y suelta.\n4. Respira profundo tres veces, notando cómo se relaja tu cuerpo.",
                'duracion_minutos' => 5,
            ],
            [
                'categoria' => 'mindfulness',
                'titulo' => 'Escaneo corporal',
                'descripcion' => 'Lleva tu atención a cada parte de tu cuerpo para conectar con el presente.',
                'instrucciones' => "1. Acuéstate boca arriba en un lugar cómodo.\n2. Cierra los ojos y respira con normalidad.\n3. Lleva tu atención lentamente desde los pies hasta la cabeza, notando cualquier sensación en cada zona sin juzgarla.\n4. Si tu mente se distrae, simplemente regresa la atención al cuerpo.\n5. Termina notando cómo se siente tu cuerpo en su totalidad.",
                'duracion_minutos' => 8,
            ],
            [
                'categoria' => 'mindfulness',
                'titulo' => 'Técnica 5-4-3-2-1',
                'descripcion' => 'Usa tus sentidos para anclarte al momento presente y reducir la ansiedad.',
                'instrucciones' => "1. Nombra 5 cosas que puedas ver a tu alrededor.\n2. Nombra 4 cosas que puedas tocar.\n3. Nombra 3 cosas que puedas escuchar.\n4. Nombra 2 cosas que puedas oler.\n5. Nombra 1 cosa que puedas saborear.\n6. Respira profundo al terminar.",
                'duracion_minutos' => 5,
            ],
            [
                'categoria' => 'meditacion',
                'titulo' => 'Meditación de atención en la respiración',
                'descripcion' => 'Una meditación clásica para calmar la mente enfocándote en tu respiración.',
                'instrucciones' => "1. Siéntate en una posición cómoda con la espalda recta.\n2. Cierra los ojos y lleva tu atención a tu respiración natural, sin forzarla.\n3. Cuando notes que tu mente se distrae, regresa suavemente la atención a la respiración.\n4. Continúa así durante 10 minutos.\n5. Abre los ojos lentamente al terminar.",
                'duracion_minutos' => 10,
            ],
            [
                'categoria' => 'meditacion',
                'titulo' => 'Meditación de bondad amorosa',
                'descripcion' => 'Cultiva sentimientos de calidez y compasión hacia ti mismo y los demás.',
                'instrucciones' => "1. Siéntate cómodamente y cierra los ojos.\n2. Repite mentalmente frases como: 'Que esté en paz, que esté bien, que esté libre de sufrimiento'.\n3. Dirige esos mismos deseos hacia alguien que quieres.\n4. Luego hacia una persona neutral, y finalmente hacia todos los seres.\n5. Termina notando cómo te sientes.",
                'duracion_minutos' => 10,
            ],
        ];

        foreach ($ejercicios as $ejercicio) {
            Ejercicio::create($ejercicio);
        }
    }
}