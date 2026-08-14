<!doctype html>
<html lang="es">
<body style="margin:0;background:#f4f6fb;font-family:system-ui,-apple-system,'Segoe UI',sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="400" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:14px;padding:32px;">
                    <tr>
                        <td style="font-size:18px;font-weight:700;color:#232b3b;padding-bottom:4px;">MAEWALLISCORP</td>
                    </tr>
                    <tr>
                        <td style="font-size:14px;color:#5a6376;padding-bottom:24px;">Recuperación de contraseña del panel de administración</td>
                    </tr>
                    <tr>
                        <td style="font-size:14px;color:#232b3b;padding-bottom:16px;">Usa el siguiente código para continuar. Es válido por 15 minutos.</td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:16px 0;">
                            <span style="display:inline-block;font-size:32px;font-weight:700;letter-spacing:8px;color:#4a5f83;background:#eef1f7;padding:14px 20px;border-radius:10px;">
                                <?= esc($code) ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:12.5px;color:#8a92a3;padding-top:20px;">Si no solicitaste este cambio, puedes ignorar este correo.</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
