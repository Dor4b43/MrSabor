<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Restablecer Contraseña - Mr Sabor</title>
</head>
<body style="margin: 0; padding: 0; background-color: #0e0a06; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #F2E8D5;">
    
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #0e0a06; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <!-- Main Container -->
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="max-width: 600px; background-color: #1a1512; border: 1px solid #33271f; border-radius: 12px; margin: 0 auto;">
                    
                    <!-- Header with Logo -->
                    <tr>
                        <td align="center" style="padding: 40px 0 20px 0;">
                            <div style="display: inline-block; text-align: center;">
                                <div style="font-size: 40px; margin-bottom: 10px;">🔥</div>
                                <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #E07820; letter-spacing: 2px;">MR. SABOR</h1>
                                <span style="font-size: 14px; font-style: italic; color: #8A7460;">Burgers</span>
                            </div>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 20px 40px;">
                            <h2 style="margin-top: 0; font-size: 20px; color: #F2E8D5;">¡Hola, {{ explode(' ', $user->name)[0] }}!</h2>
                            
                            <p style="font-size: 16px; line-height: 1.6; color: #d4c5b0; margin-bottom: 24px;">
                                Estás recibiendo este correo porque solicitaste un restablecimiento de contraseña para tu cuenta en <strong>Mr. Sabor Burgers</strong>.
                            </p>
                            
                            <!-- CTA Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $url }}" style="display: inline-block; padding: 14px 30px; background-color: #E07820; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: bold; border-radius: 8px; text-transform: uppercase; letter-spacing: 1px;">
                                            Restablecer Contraseña
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 15px; line-height: 1.6; color: #d4c5b0; margin-bottom: 24px;">
                                Este enlace de recuperación expirará en 60 minutos.
                            </p>
                            
                            <p style="font-size: 15px; line-height: 1.6; color: #d4c5b0; margin-bottom: 0;">
                                Si no solicitaste este cambio, puedes ignorar este correo tranquilamente; tu cuenta sigue segura con nosotros.
                            </p>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding: 0 40px;">
                            <hr style="border: none; border-top: 1px solid #33271f; margin: 20px 0;">
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 10px 40px 40px 40px; text-align: center;">
                            <p style="font-size: 13px; color: #8A7460; line-height: 1.5; margin: 0;">
                                © {{ date('Y') }} Mr. Sabor Burgers.<br>
                                Todos los derechos reservados. Hecho con ❤️ y 🔥
                            </p>
                            
                            <!-- Fallback Link -->
                            <p style="font-size: 12px; color: #6b5a4a; line-height: 1.5; margin-top: 20px; word-break: break-all;">
                                Si tienes problemas haciendo clic en el botón, copia y pega esta URL en tu navegador:<br>
                                <a href="{{ $url }}" style="color: #E07820; text-decoration: underline;">{{ $url }}</a>
                            </p>
                        </td>
                    </tr>
                    
                </table>
                
            </td>
        </tr>
    </table>

</body>
</html>
