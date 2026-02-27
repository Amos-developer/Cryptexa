<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background: #ffffff; border-radius: 12px; overflow: hidden;">
                    <tr>
                        <td style="background: linear-gradient(135deg, #38bdf8 0%, #22d3ee 100%); padding: 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px;">🔐 Reset Your Password</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="color: #374151; font-size: 16px; margin: 0 0 20px 0;">Hello,</p>
                            <p style="color: #374151; font-size: 16px; margin: 0 0 20px 0;">We received a request to reset your password for your CRYPTEXA account. Click the button below to reset it:</p>
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $resetLink }}" style="display: inline-block; background: linear-gradient(135deg, #38bdf8 0%, #22d3ee 100%); color: #ffffff; text-decoration: none; padding: 14px 40px; border-radius: 8px; font-size: 16px; font-weight: 600;">Reset Password</a>
                                    </td>
                                </tr>
                            </table>
                            <p style="color: #6b7280; font-size: 14px; margin: 20px 0 0 0;">Or copy this link: {{ $resetLink }}</p>
                            <p style="color: #6b7280; font-size: 14px; margin: 20px 0 0 0;">This link expires in 1 hour. If you didn't request this, ignore this email.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background: #f9fafb; padding: 20px 30px; text-align: center;">
                            <p style="color: #9ca3af; font-size: 12px; margin: 0;">© 2024 CRYPTEXA. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
