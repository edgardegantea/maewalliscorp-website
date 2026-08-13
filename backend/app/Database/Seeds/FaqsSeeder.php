<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FaqsSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            [
                'question' => '¿Qué tipo de proyectos aceptan?',
                'answer'   => 'Desarrollo de software a medida (web y móvil), consultoría tecnológica, y sistemas de gestión para organizaciones públicas y privadas. Si tu proyecto no encaja exactamente en estas categorías, escríbenos de todas formas — evaluamos caso por caso.',
                'position' => 1,
            ],
            [
                'question' => '¿Cuánto tiempo toma un proyecto?',
                'answer'   => 'Depende del alcance: un sitio institucional puede tomar unas semanas, mientras que una plataforma con backend a medida puede tomar varios meses. Durante el diagnóstico inicial te damos un estimado concreto antes de comenzar.',
                'position' => 2,
            ],
            [
                'question' => '¿Cómo se cotiza un proyecto?',
                'answer'   => 'Primero platicamos sobre tu problema y objetivos. Con eso preparamos una propuesta con alcance, tiempos y costo definidos, sin compromiso. Escríbenos por el formulario de contacto para agendar esa primera plática.',
                'position' => 3,
            ],
            [
                'question' => '¿Dan mantenimiento después de la entrega?',
                'answer'   => 'Sí. Ofrecemos soporte técnico continuo una vez que el sistema está en producción: monitoreo, resolución de incidencias y mejoras posteriores.',
                'position' => 4,
            ],
            [
                'question' => '¿Trabajan con clientes fuera de México?',
                'answer'   => 'Sí, trabajamos de forma remota con organizaciones dentro y fuera del país. La coordinación se hace por videollamada y herramientas colaborativas.',
                'position' => 5,
            ],
        ];

        foreach ($rows as $row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('faqs')->insert($row);
        }
    }
}
