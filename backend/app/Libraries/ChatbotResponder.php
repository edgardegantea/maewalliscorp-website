<?php

namespace App\Libraries;

/**
 * Rule-based responder used until a real AI provider (Claude, etc.) is
 * wired in. Keeping the intent-matching isolated here means swapping the
 * implementation later only touches this class, not the controller.
 */
class ChatbotResponder
{
    /** @var array<int, array{patterns: list<string>, intent: string, text: string, escalate: bool}> */
    private array $rules = [
        [
            'patterns' => ['hola', 'buenas', 'buenos dias', 'buenas tardes', 'buenas noches'],
            'intent'   => 'saludo',
            'text'     => '¡Hola! Soy el asistente virtual de MAEWALLISCORP. ¿En qué puedo ayudarte: información de nuestros servicios, cotizaciones, o soporte técnico?',
            'escalate' => false,
        ],
        [
            'patterns' => ['precio', 'costo', 'cotiza', 'cotizacion', 'presupuesto'],
            'intent'   => 'cotizacion',
            'text'     => 'Con gusto te preparamos una cotización. Cuéntame brevemente qué proyecto o servicio necesitas y déjanos tu correo o teléfono para que un asesor te contacte.',
            'escalate' => false,
        ],
        [
            'patterns' => ['soporte', 'ayuda', 'problema', 'error', 'falla', 'no funciona'],
            'intent'   => 'soporte',
            'text'     => 'Lamento el inconveniente. Puedo abrir un ticket de soporte técnico para ti — descríbeme el problema con el mayor detalle posible.',
            'escalate' => true,
        ],
        [
            'patterns' => ['humano', 'persona', 'asesor', 'agente', 'hablar con alguien'],
            'intent'   => 'escalar_humano',
            'text'     => 'Claro, te conecto con un miembro de nuestro equipo. Un asesor revisará esta conversación y te contactará en breve.',
            'escalate' => true,
        ],
        [
            'patterns' => ['gracias', 'muchas gracias', 'ok gracias'],
            'intent'   => 'despedida',
            'text'     => '¡Con gusto! Si necesitas algo más, aquí estaré.',
            'escalate' => false,
        ],
    ];

    /**
     * @return array{text: string, intent: string, escalate: bool}
     */
    public function reply(string $message): array
    {
        $normalized = $this->normalize($message);

        foreach ($this->rules as $rule) {
            foreach ($rule['patterns'] as $pattern) {
                if (str_contains($normalized, $pattern)) {
                    return [
                        'text'     => $rule['text'],
                        'intent'   => $rule['intent'],
                        'escalate' => $rule['escalate'],
                    ];
                }
            }
        }

        return [
            'text'     => 'Gracias por tu mensaje. Aún estoy aprendiendo, así que voy a pasar tu consulta a un asesor humano para darte una respuesta precisa.',
            'intent'   => 'desconocido',
            'escalate' => true,
        ];
    }

    private function normalize(string $text): string
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = strtr($text, [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
        ]);

        return $text;
    }
}
