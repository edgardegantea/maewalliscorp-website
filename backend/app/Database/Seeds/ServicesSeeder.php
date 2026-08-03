<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            [
                'icon'        => '⚙️',
                'title'       => 'Desarrollo de software a medida',
                'description' => 'Sistemas web y plataformas propias diseñadas alrededor de los procesos reales de cada organización.',
                'position'    => 1,
            ],
            [
                'icon'        => '🧭',
                'title'       => 'Consultoría tecnológica',
                'description' => 'Diagnóstico y acompañamiento para elegir la arquitectura, herramientas y proveedores correctos antes de construir.',
                'position'    => 2,
            ],
            [
                'icon'        => '📋',
                'title'       => 'Gestión de proyectos digitales',
                'description' => 'Coordinación end-to-end de proyectos de software: planeación, seguimiento y entrega, sin sorpresas.',
                'position'    => 3,
            ],
            [
                'icon'        => '🛠️',
                'title'       => 'Soporte técnico continuo',
                'description' => 'Mantenimiento, monitoreo y resolución de incidencias una vez que el sistema ya está en producción.',
                'position'    => 4,
            ],
        ];

        foreach ($rows as $row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('services')->insert($row);
        }
    }
}
