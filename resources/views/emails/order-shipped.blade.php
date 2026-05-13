<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>¡Tu pedido va en camino! - Mr Sabor</title>
</head>
<body style="margin: 0; padding: 0; background-color: #0e0a06; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #F2E8D5;">
    
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #0e0a06; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="max-width: 600px; background-color: #1a1512; border: 1px solid #33271f; border-radius: 12px; margin: 0 auto;">
                    
                    <tr>
                        <td align="center" style="padding: 40px 0 20px 0;">
                            <div style="display: inline-block; text-align: center;">
                                <div style="font-size: 40px; margin-bottom: 10px;">🔥</div>
                                <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #E07820; letter-spacing: 2px;">MR. SABOR</h1>
                                <span style="font-size: 14px; font-style: italic; color: #8A7460;">Burgers</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 40px;">
                            <h2 style="margin-top: 0; font-size: 20px; color: #F2E8D5; text-align: center;">¡Prepara la mesa, {{ explode(' ', $order->user->name)[0] }}! 🛵</h2>
                            
                            <p style="font-size: 16px; line-height: 1.6; color: #d4c5b0; text-align: center; margin-bottom: 30px;">
                                Tu pedido <strong>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong> acaba de salir de nuestra cocina y ya va en camino hacia tu dirección.
                            </p>
                            
                            @if($order->order_type == 'delivery')
                                <div style="background-color: rgba(224,120,32,0.05); border: 1px solid rgba(224,120,32,0.2); padding: 15px; border-radius: 8px; margin-bottom: 25px;">
                                    <h3 style="margin: 0 0 10px 0; font-size: 14px; color: #E07820; text-transform: uppercase; letter-spacing: 1px;">Dirección de entrega:</h3>
                                    <p style="margin: 0; color: #F2E8D5; font-size: 15px;">{{ $order->delivery_address }}</p>
                                </div>
                            @endif

                            <p style="font-size: 15px; line-height: 1.6; color: #8A7460; text-align: center; margin-bottom: 0;">
                                El repartidor se comunicará contigo si tiene alguna duda para llegar.<br>¡Ya casi vas a disfrutar del verdadero sabor!
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px;">
                            <hr style="border: none; border-top: 1px solid #33271f; margin: 20px 0;">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 10px 40px 40px 40px; text-align: center;">
                            <p style="font-size: 13px; color: #8A7460; line-height: 1.5; margin: 0;">
                                © {{ date('Y') }} Mr. Sabor Burgers.<br>
                                Todos los derechos reservados. Hecho con ❤️ y 🔥
                            </p>
                        </td>
                    </tr>
                    
                </table>
                
            </td>
        </tr>
    </table>

</body>
</html>
