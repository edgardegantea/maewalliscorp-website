<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PartnersSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            [
                'slug'      => 'edgar-degante-aguilar',
                'name'      => 'Edgar Degante Aguilar',
                'role'      => 'Socio fundador — Estratega tecnológico',
                'semblanza' => 'Investigador, arquitecto de software y servidor público con un perfil multidisciplinario en innovación tecnológica e inteligencia artificial. Candidato a Doctor en Ciencias de la Ingeniería, desarrolla su investigación en el Affective Computing and Educational Innovation Laboratory. En MAEWALLISCORP es el principal estratega tecnológico, a cargo de la arquitectura y el desarrollo de las plataformas propias del grupo.',
                'academico' => [
                    'Doctorado en Ciencias de la Ingeniería (candidato) — investigación en el Affective Computing and Educational Innovation Laboratory, en las líneas de aplicaciones de la inteligencia artificial y ciencia de datos.',
                    'Maestría en Sistemas Computacionales, especialidad en Ingeniería de Software y Sistemas Distribuidos (2021).',
                    'Ingeniería en Informática, especialidad en Sistemas de Información (2015).',
                ],
                'profesional' => [
                    'Director de Innovación Tecnológica del H. Ayuntamiento de Tlatlauquitepec, Puebla, para la administración 2024–2027 (nombramiento del 18 de octubre de 2024).',
                    'Arquitecto del sistema de gestión escolar del Instituto Tecnológico Superior de Martínez de la Torre.',
                    'Principal estratega tecnológico de MAEWALLISCORP: diseño y desarrollo de las plataformas Scriptoria, SciCita, SUMA y El Jale, con metodología Scrum y stack basado en Laravel, React, Tailwind CSS, Python y PostgreSQL.',
                    'Desarrollador FullStack e IoT: propiedad industrial e intelectual registrada en México, incluyendo un dispositivo inteligente medidor de consumo de agua, plataformas de intercambio cultural para el fortalecimiento de lenguas indígenas y sistemas de monitoreo climatológico agrícola con Machine Learning.',
                    'Stack técnico: desarrollo web con PHP, JavaScript y Python; desarrollo móvil con Kotlin y Dart, además de Laravel, React, Tailwind CSS y PostgreSQL.',
                    'Instructor certificado: cursos de programación y desarrollo (incluida certificación de Red Hat Academy).',
                    'Investigador en la intersección de inteligencia artificial, educación y salud mental, con línea de trabajo en sistemas tutores inteligentes y modelos computacionales multimodales.',
                ],
                'publicaciones' => [
                    '"Task automation and instructional planning support with large language models: a systematic review" — Frontiers in Education, 2026.',
                    '"Un corpus de oraciones para el análisis de emociones en estudiantes de inglés mediante algoritmos de inteligencia artificial" — Decires, UNAM, 2026.',
                    '"Artificial intelligence techniques applied to anxiety disorders recognition: a systematic review" — Frontiers in Digital Health, 2025.',
                    '"Identificación de estados emocionales en estudiantes de nivel básico mediante una agrupación de robots sociales sincronizados" — proyecto de servicio social, 2024.',
                    '"El mejor escenario como apoyo al modelo híbrido con el entorno Microsoft Teams" — Revista Electrónica ANFEI Digital, 2023.',
                    '"Importancia y diseño de un plan estratégico en la promoción de las carreras de Ingeniería" — Journal CIM, 2023.',
                    '"Desarrollo de competencias profesionales mediante el programa de dualidad y residencias en vinculación con empresas" — Journal CIM, 2023.',
                    '"Sistema tutor inteligente para reducir el índice de reprobación en estudiantes de ingeniería informática" — ICyTA: Ingeniería, Ciencia y Tecnología Aplicada, 2020.',
                ],
                'links' => [
                    ['label' => 'Google Scholar', 'url' => 'https://scholar.google.com/citations?user=xbRk8vQAAAAJ&hl=es'],
                    ['label' => 'ORCID', 'url' => 'https://orcid.org/0009-0001-2382-944X'],
                ],
                'pending_review' => 0,
                'position'       => 1,
            ],
            [
                'slug'      => 'juan-carlos-bautista-lucas',
                'name'      => 'Juan Carlos Bautista Lucas',
                'role'      => 'Socio fundador — CEO y Director',
                'semblanza' => 'Licenciado en Ciencia Política por la Universidad Autónoma Metropolitana (Unidad Iztapalapa), con más de una década de trayectoria docente en educación media superior y universitaria, y experiencia como director y emprendedor. Es CEO y Director de MAEWALLISCORP desde 2021.',
                'academico' => [
                    'Licenciatura en Ciencia Política, División de Ciencias Sociales y Humanidades — Universidad Autónoma Metropolitana, Unidad Iztapalapa (2007–2011).',
                    'Bachillerato Oficial "Ignacio Manuel Altamirano", especialización técnica en Contabilidad — Chignautla, Puebla (2003–2006).',
                    'Formación continua reciente en gestión empresarial e IA aplicada a negocios: "Modelo de Negocio Canvas" y "Aspectos legales y fiscales para MIPYMES" (Secretaría de Economía, 2025), "Prompting Responsable: Maximiza la IA en tu Negocio" (Santander Open Academy, 2025).',
                ],
                'profesional' => [
                    'CEO y Director de MAEWALLISCORP — Centro de Aplicaciones Tecnológicas, desde junio de 2021.',
                    'CEO y Director del Centro de Estudios Socioeconómicos de Integración Multidisciplinaria (CESIM), desde julio de 2019.',
                    'Docente universitario en AM University campus Teziutlán (Ciencias de la Comunicación, Derecho, Mercadotecnia y Pedagogía) desde 2013, y en la Universidad de América Latina campus Teziutlán (2019–2023).',
                    'Emprendedor: propietario de "Café con Pan" (dos sucursales en la región de Teziutlán) desde 2020.',
                    'Amplia trayectoria en investigación y divulgación de ciencias sociales y política pública: ponente y organizador en foros, coloquios y seminarios universitarios desde 2010.',
                ],
                'publicaciones'  => [],
                'links'          => [],
                'pending_review' => 0,
                'position'       => 2,
            ],
            [
                'slug'      => 'cristian-enrique-lopez-garduno',
                'name'      => 'Cristian Enrique López Garduño',
                'role'      => 'Socio fundador — Arquitecto, Gerencia de Proyectos y Supervisión de Obra',
                'semblanza' => 'Arquitecto y Maestro en Administración de la Construcción con más de 15 años dirigiendo proyectos de infraestructura crítica: aeroportuaria, hospitalaria, gubernamental y privada. Especialista en asegurar calidad, tiempo, costo y cumplimiento normativo en entornos de obra viva y alta exigencia operativa.',
                'academico' => [
                    'Maestría en Administración de la Construcción — Instituto Tecnológico de la Construcción.',
                    'Licenciatura en Arquitectura — Universidad Insurgentes.',
                    'Diplomado en Obras Públicas (2026) y Scrum Fundamentals Certificate (2026).',
                    'Certificación en Gerencia de Proyecto, Coordinación, Administración y Supervisión, y Certificación en MS Project — Grupo SACMAG (2024).',
                ],
                'profesional' => [
                    'Coordinador y Supervisor de Proyectos en Supervisores Técnicos, S.A. de C.V. — Grupo SACMAG: remodelación de las Bahías L1, L2, L3, Check-In y ampliación de Mezanine Dedo L en la Terminal 2 del AICM (Aeroméxico), en operación continua sin afectación.',
                    'Supervisión y cierre administrativo de infraestructura hospitalaria: Hospital General de Zona de 144 camas en Tuxtla Gutiérrez y Centro Médico Nacional 20 de Noviembre (CDMX).',
                    'Infraestructura logística y gubernamental: Plataforma Intermodal de Manzanillo (Colima), Edificio Sede INE Yucatán, Tribunales Laborales de Cuautitlán Izcalli y Programa de Mejoramiento Urbano de SEDATU.',
                    'Proyectos aeroportuarios adicionales: sistemas de energía de emergencia en Minatitlán y Veracruz, y análisis de costos de la Nueva Terminal 2 del Aeropuerto de Guadalajara.',
                    'Sector privado: supervisión del proyecto ejecutivo de ampliación de Antara Polanco y remodelación del Centro de Alto Rendimiento de FEMEXFUT.',
                    'Analista de Obra en el IMSS (Coordinación de Infraestructura Inmobiliaria): control de estructura metálica en la UMF de Celaya y supervisión de obra civil en el HGZ 144 Camas Sustentable de Aguascalientes.',
                    'Trayectoria previa (2010–2018) en Moprech & Seus, Dat-Ingeniería, Arqdycon, UAM y Cortés Arquitectos: residencia de obra en 77 escuelas de Iztacalco y proyectos ejecutivos con Autodesk Revit para Teletón Ecatepec, Liverpool León y planta industrial HYDAC.',
                    'Dominio de AutoCAD, Autodesk Revit y MS Project, y de la normatividad de obra pública (Reglamento de Construcciones CDMX y NTC, Ley de Obras Públicas).',
                ],
                'publicaciones'  => [],
                'links'          => [],
                'pending_review' => 0,
                'position'       => 3,
            ],
        ];

        foreach ($rows as $row) {
            $row['academico']     = json_encode($row['academico'], JSON_UNESCAPED_UNICODE);
            $row['profesional']   = json_encode($row['profesional'], JSON_UNESCAPED_UNICODE);
            $row['publicaciones'] = json_encode($row['publicaciones'], JSON_UNESCAPED_UNICODE);
            $row['links']         = json_encode($row['links'], JSON_UNESCAPED_UNICODE);
            $row['created_at']    = date('Y-m-d H:i:s');
            $this->db->table('partners')->insert($row);
        }
    }
}
