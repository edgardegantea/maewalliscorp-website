<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LegalPagesSeeder extends Seeder
{
    public function run()
    {
        $privacy = <<<'MD'
MAEWALLISCORP ("nosotros") es responsable del tratamiento de los datos personales que nos proporcionas a través de este sitio web, conforme a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (LFPDPPP).

## Datos que recopilamos

A través del formulario de contacto de este sitio recopilamos únicamente tu nombre, correo electrónico, el contenido del mensaje que nos escribes, y tu dirección IP con fines de seguridad y para prevenir abuso del formulario.

El asistente virtual (chatbot) del sitio procesa el texto que escribes únicamente para generarte una respuesta en el momento; no almacenamos un historial permanente de esas conversaciones.

## Finalidad del tratamiento

Usamos estos datos exclusivamente para responder a tu solicitud de contacto o cotización, dar seguimiento y soporte a clientes activos, y prevenir el uso indebido de nuestros formularios. No usamos tus datos con fines de mercadotecnia no solicitada ni los vendemos.

## Cookies y almacenamiento local

Este sitio no utiliza cookies de rastreo publicitario ni analítica de terceros. Utilizamos almacenamiento local del navegador únicamente para recordar tu preferencia de tema visual (claro/oscuro) y para mantener la continuidad de una conversación con el chatbot durante tu sesión; ninguno de estos datos se comparte con terceros.

## Con quién compartimos tus datos

No compartimos, vendemos ni transferimos tus datos personales a terceros, salvo que una autoridad competente lo requiera conforme a la ley.

## Derechos ARCO

Tienes derecho a acceder, rectificar, cancelar u oponerte (derechos ARCO) al tratamiento de tus datos personales. Para ejercer cualquiera de estos derechos, escríbenos a través del [formulario de contacto](/#contacto) de este sitio, indicando claramente tu solicitud.

## Cambios a este aviso

Podemos actualizar este aviso de privacidad periódicamente. Cualquier cambio será publicado en esta misma página con su fecha de actualización correspondiente.
MD;

        $terms = <<<'MD'
Al usar este sitio web aceptas los siguientes términos. Si no estás de acuerdo, te pedimos no continuar usando el sitio.

## Uso del sitio

El contenido de este sitio (textos, logotipo, diseño e imágenes) es propiedad de MAEWALLISCORP, salvo que se indique lo contrario. Puedes navegar y compartir enlaces a este sitio libremente; no está permitido reproducir su contenido con fines comerciales sin autorización previa.

## Formulario de contacto y asistente virtual

La información que envíes a través del formulario de contacto o del chatbot se utiliza únicamente para darte seguimiento comercial o de soporte, conforme a nuestro [Aviso de Privacidad](/aviso-de-privacidad). El chatbot ofrece respuestas automatizadas basadas en reglas y puede no resolver todas las dudas — en ese caso, un miembro de nuestro equipo te contactará directamente.

## Disponibilidad del servicio

Hacemos un esfuerzo razonable por mantener este sitio disponible y funcionando correctamente, pero no garantizamos que esté libre de interrupciones o errores en todo momento.

## Enlaces a terceros

Este sitio puede incluir enlaces a perfiles o plataformas externas (por ejemplo, redes académicas o profesionales de nuestro equipo). No somos responsables del contenido ni de las políticas de privacidad de esos sitios de terceros.

## Limitación de responsabilidad

La información de este sitio se ofrece con fines informativos sobre nuestros servicios. Cualquier propuesta, alcance o compromiso de trabajo concreto se formaliza por separado, directamente con nuestro equipo.

## Cambios a estos términos

Podemos actualizar estos términos periódicamente. Los cambios entran en vigor desde su publicación en esta página.

## Contacto

Para dudas sobre estos términos, escríbenos a través del [formulario de contacto](/#contacto).
MD;

        $this->db->table('legal_pages')->insert([
            'page_key'   => 'privacy',
            'title'      => 'Aviso de privacidad',
            'content'    => $privacy,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('legal_pages')->insert([
            'page_key'   => 'terms',
            'title'      => 'Términos y condiciones',
            'content'    => $terms,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
