<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td style="background: linear-gradient(135deg, #38bdf8, #0ea5e9); padding: 40px 30px; text-align: center;">
                            <div style="font-size: 48px; margin-bottom: 10px;">📧</div>
                            <h1 style="margin: 0; color: white; font-size: 28px; font-weight: 900;">Email Verification</h1>
                            <p style="margin: 10px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Secure access to your account</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="margin: 0 0 20px 0; color: #6b7280; font-size: 15px; line-height: 1.6;">
                                Use the verification code below to confirm your email address.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background: #f9fafb; border-radius: 12px; padding: 20px; margin: 20px 0;">
                                <tr>
                                    <td align="center" style="padding: 20px 0;">
                                        <p style="margin: 0 0 10px 0; color: #6b7280; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Verification Code</p>
                                        <h1 style="margin: 0; color: #38bdf8; font-size: 48px; font-weight: 900; letter-spacing: 8px;">{{ $code }}</h1>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                This code will expire in <strong style="color: #ef4444;">10 minutes</strong>.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0 0 10px 0; color: #9ca3af; font-size: 12px;">
                                If you did not request this verification, you can safely ignore this email.
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