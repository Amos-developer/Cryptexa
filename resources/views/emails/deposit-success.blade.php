<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Confirmed</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td style="background: linear-gradient(135deg, #22c55e, #16a34a); padding: 40px 30px; text-align: center;">
                            <div style="font-size: 48px; margin-bottom: 10px;">✓</div>
                            <h1 style="margin: 0; color: white; font-size: 28px; font-weight: 900;">Deposit Confirmed</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="margin: 0 0 20px 0; color: #6b7280; font-size: 15px; line-height: 1.6;">
                                Your deposit has been successfully confirmed and credited to your account.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background: #f9fafb; border-radius: 12px; padding: 20px; margin: 20px 0;">
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280; font-size: 14px;">Amount Credited:</td>
                                    <td align="right" style="padding: 8px 0; color: #22c55e; font-size: 18px; font-weight: 700;">+${{ number_format($deposit->pay_amount ?? $deposit->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280; font-size: 14px;">Currency:</td>
                                    <td align="right" style="padding: 8px 0; color: #1f2937; font-size: 14px; font-weight: 600;">{{ strtoupper($deposit->currency) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280; font-size: 14px;">New Balance:</td>
                                    <td align="right" style="padding: 8px 0; color: #1f2937; font-size: 16px; font-weight: 700;">${{ number_format($newBalance, 2) }}</td>
                                </tr>
                            </table>

                            <p style="margin: 20px 0 0 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                You can now use your funds to activate liquidity pools and start earning.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0 0 10px 0; color: #9ca3af; font-size: 12px;">
                                This is an automated message from Cryptexa.
                            </p>
                            <p style="margin: 0; color: #9ca3af; font-size: 12px;">
                                © {{ date('Y') }} Cryptexa. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
