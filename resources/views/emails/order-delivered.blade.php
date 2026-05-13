<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>¡Pedido Entregado! - Mr Sabor</title>
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
                            <h2 style="margin-top: 0; font-size: 20px; color: #22c55e; text-align: center;">¡Buen provecho, {{ explode(' ', $order->user->name)[0] }}! 🍔</h2>
                            
                            <p style="font-size: 15px; line-height: 1.6; color: #d4c5b0; text-align: center; margin-bottom: 30px;">
                                Tu pedido ha sido marcado como entregado. Esperamos que disfrutes cada mordisco. Aquí tienes el resumen de tu cuenta:
                            </p>
                            
                            <!-- Receipt Box -->
                            <div style="background-color: #0e0a06; border: 1px solid #33271f; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
                                <h3 style="margin: 0 0 15px 0; font-size: 16px; color: #F2E8D5; border-bottom: 1px dashed #33271f; padding-bottom: 10px;">
                                    Factura de Pedido #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                </h3>
                                
                                <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 14px; color: #d4c5b0;">
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.05);">{{ $item->quantity }}x {{ $item->menuItem->name }}</td>
                                            <td style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.05); text-align: right;">${{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    @if($order->order_type == 'delivery' && $order->delivery_fee > 0)
                                        <tr>
                                            <td style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.05);">Domicilio</td>
                                            <td style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.05); text-align: right;">${{ number_format($order->delivery_fee, 0, ',', '.') }}</td>
                                        </tr>
                                    @endif
                                </table>
                                
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 15px;">
                                    <tr>
                                        <td style="font-size: 16px; font-weight: bold; color: #E07820;">TOTAL A PAGAR:</td>
                                        <td style="font-size: 18px; font-weight: bold; color: #E07820; text-align: right;">${{ number_format($order->total, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="font-size: 12px; color: #8A7460; text-align: right; padding-top: 5px;">
                                            Método: {{ $order->payment_method == 'transfer' ? 'Transferencia' : 'Efectivo' }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <p style="font-size: 15px; line-height: 1.6; color: #8A7460; text-align: center; margin-bottom: 0;">
                                ¡Gracias por elegir el verdadero sabor!<br>Esperamos verte pronto.
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
