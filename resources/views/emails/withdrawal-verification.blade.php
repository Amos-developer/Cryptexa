<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal Verification Code</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td style="background: linear-gradient(135deg, #a855f7, #9333ea); padding: 40px 30px; text-align: center;">
                            <div style="font-size: 48px; margin-bottom: 10px;">🔐</div>
                            <h1 style="margin: 0; color: white; font-size: 28px; font-weight: 900;">Withdrawal Verification</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="margin: 0 0 20px 0; color: #6b7280; font-size: 15px; line-height: 1.6;">
                                You requested to withdraw funds from your Cryptexa account. Please use the verification code below to complete your withdrawal:
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background: #f9fafb; border-radius: 12px; padding: 20px; margin: 20px 0;">
                                <tr>
                                    <td align="center" style="padding: 20px 0;">
                                        <p style="margin: 0 0 10px 0; color: #6b7280; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Verification Code</p>
                                        <h1 style="margin: 0; color: #a855f7; font-size: 48px; font-weight: 900; letter-spacing: 8px;">{{ $code }}</h1>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 15px 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                <strong style="color: #1f2937;">Important:</strong>
                            </p>
                            <ul style="margin: 0 0 20px 0; padding-left: 20px; color: #6b7280; font-size: 14px; line-height: 1.8;">
                                <li>This code expires in <strong style="color: #ef4444;">10 minutes</strong></li>
                                <li>Do not share this code with anyone</li>
                                <li>If you didn't request this withdrawal, please secure your account immediately</li>
                            </ul>
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
