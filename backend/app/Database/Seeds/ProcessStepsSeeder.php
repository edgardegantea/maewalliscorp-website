<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProcessStepsSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            [
                'title'       => 'Diagnóstico',
                'description' => 'Entendemos el proceso real detrás del problema antes de proponer una sola línea de código.',
                'position'    => 1,
            ],
            [
                'title'       => 'Propuesta',
                'description' => 'Definimos alcance, arquitectura y tiempos claros, sin sorpresas a mitad del proyecto.',
                'position'    => 2,
            ],
            [
                'title'       => 'Desarrollo',
                'description' => 'Construimos en iteraciones cortas, con entregas visibles y retroalimentación constante.',
                'position'    => 3,
            ],
            [
                'title'       => 'Entrega',
                'description' => 'Ponemos el sistema en producción y capacitamos a tu equipo para operarlo con confianza.',
                'position'    => 4,
            ],
            [
                'title'       => 'Soporte',
                'description' => 'Damos seguimiento, monitoreo y mantenimiento una vez que el sistema ya está en uso real.',
                'position'    => 5,
            ],
        ];

        foreach ($rows as $row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('process_steps')->insert($row);
        }
    }
}
