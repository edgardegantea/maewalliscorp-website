<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            [
                'category'    => 'Gestión municipal',
                'title'       => 'Plataformas de administración pública',
                'description' => 'Sistemas para digitalizar trámites y procesos internos de gobiernos locales.',
                'position'    => 1,
            ],
            [
                'category'    => 'Consultoría',
                'title'       => 'Portales de servicios profesionales',
                'description' => 'Plataformas de gestión para despachos y firmas de consultoría.',
                'position'    => 2,
            ],
            [
                'category'    => 'Gestión de proyectos',
                'title'       => 'Herramientas de seguimiento y control',
                'description' => 'Sistemas internos para planear, dar seguimiento y reportar avance de proyectos.',
                'position'    => 3,
            ],
            [
                'category'    => 'Bibliotecas',
                'title'       => 'Sistemas de gestión bibliotecaria',
                'description' => 'Catalogación, préstamos y consulta de acervos para instituciones educativas.',
                'position'    => 4,
            ],
        ];

        foreach ($rows as $row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('portfolio_items')->insert($row);
        }
    }
}
