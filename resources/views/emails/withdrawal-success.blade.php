<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal Completed</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td style="background: linear-gradient(135deg, #22c55e, #16a34a); padding: 40px 30px; text-align: center;">
                            <div style="font-size: 48px; margin-bottom: 10px;">✓</div>
                            <h1 style="margin: 0; color: white; font-size: 28px; font-weight: 900;">Withdrawal Completed</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="margin: 0 0 20px 0; color: #6b7280; font-size: 15px; line-height: 1.6;">
                                Your withdrawal has been successfully processed and sent to your wallet.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background: #f9fafb; border-radius: 12px; padding: 20px; margin: 20px 0;">
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280; font-size: 14px;">Amount Withdrawn:</td>
                                    <td align="right" style="padding: 8px 0; color: #1f2937; font-size: 16px; font-weight: 700;">${{ number_format($withdrawal->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280; font-size: 14px;">Withdrawal Fee (8%):</td>
                                    <td align="right" style="padding: 8px 0; color: #ef4444; font-size: 14px; font-weight: 600;">-${{ number_format($withdrawal->amount * 0.08, 2) }}</td>
                                </tr>
                                <tr style="border-top: 2px solid #e5e7eb;">
                                    <td style="padding: 12px 0 8px 0; color: #22c55e; font-size: 15px; font-weight: 700;">Amount Received:</td>
                                    <td align="right" style="padding: 12px 0 8px 0; color: #22c55e; font-size: 18px; font-weight: 900;">${{ number_format($withdrawal->amount * 0.92, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280; font-size: 14px;">Network:</td>
                                    <td align="right" style="padding: 8px 0; color: #1f2937; font-size: 14px; font-weight: 600;">{{ $withdrawal->currency }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280; font-size: 14px;">Address:</td>
                                    <td align="right" style="padding: 8px 0; color: #1f2937; font-size: 12px; font-weight: 600; word-break: break-all;">{{ $withdrawal->address }}</td>
                                </tr>
                                @if($withdrawal->txid)
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280; font-size: 14px;">Transaction ID:</td>
                                    <td align="right" style="padding: 8px 0; color: #0ea5e9; font-size: 12px; font-weight: 600; word-break: break-all;">{{ $withdrawal->txid }}</td>
                                </tr>
                                @endif
                            </table>

                            <p style="margin: 20px 0 0 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                The funds should appear in your wallet shortly. Please allow a few minutes for blockchain confirmation.
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
