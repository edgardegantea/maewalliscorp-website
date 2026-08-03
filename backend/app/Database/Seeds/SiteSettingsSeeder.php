<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            'hero_eyebrow'     => 'MAEWALLISCORP',
            'hero_title'       => 'Avanzamos en todas direcciones.',
            'hero_description' => 'Diseñamos, desarrollamos y damos soporte a plataformas de software para organizaciones que necesitan resolver procesos reales, no solo tener una app más.',
            'about_text'       => 'MAEWALLISCORP es un grupo de desarrollo y consultoría tecnológica. Construimos software propio y trabajamos junto a otras organizaciones para digitalizar sus procesos, combinando desarrollo a medida con acompañamiento estratégico en cada etapa del proyecto.',
            'contact_response_time' => 'Normalmente respondemos en 24–48 horas hábiles.',
            'contact_support_note'  => 'Clientes activos pueden usar el chat para abrir tickets de soporte.',
        ];

        foreach ($rows as $key => $value) {
            $this->db->table('site_settings')->insert([
                'setting_key'   => $key,
                'setting_value' => $value,
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
