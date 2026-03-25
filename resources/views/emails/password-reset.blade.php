<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="margin:0;padding:0;background:#06101d;font-family:Arial,sans-serif;color:#e8f0ff;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:linear-gradient(180deg,#06101d 0%,#07111f 48%,#0a1422 100%);padding:32px 16px;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:620px;background:#091221;border:1px solid rgba(106,227,255,0.16);border-radius:24px;overflow:hidden;box-shadow:0 18px 46px rgba(0,0,0,0.28);">
                    <tr>
                        <td style="padding:18px 24px;background:linear-gradient(135deg,rgba(56,189,248,0.18),rgba(14,165,233,0.12));border-bottom:1px solid rgba(106,227,255,0.14);text-align:center;">
                            <div style="display:inline-block;padding:6px 12px;border-radius:999px;background:rgba(106,227,255,0.10);border:1px solid rgba(106,227,255,0.16);color:#b7f4ff;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;">Cryptexa Security</div>
                            <h1 style="margin:14px 0 6px;color:#f8fbff;font-size:28px;font-weight:800;">Reset Your Password</h1>
                            <p style="margin:0;color:rgba(232,240,255,0.72);font-size:14px;line-height:1.6;">A secure link has been prepared for your account.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 24px;">
                            <div style="padding:18px;border-radius:18px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);margin-bottom:18px;color:rgba(232,240,255,0.72);font-size:14px;line-height:1.7;">
                                We received a request to reset the password for your Cryptexa account. Use the button below to choose a new password.
                            </div>

                            <table width="100%" cellpadding="0" cellspacing="0" style="margin:24px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $resetLink }}" style="display:inline-block;padding:14px 32px;border-radius:16px;background:linear-gradient(135deg,#38bdf8,#0ea5e9);color:#06101d;text-decoration:none;font-size:15px;font-weight:800;">Reset Password</a>
                                    </td>
                                </tr>
                            </table>

                            <div style="padding:16px 18px;border-radius:16px;background:rgba(106,227,255,0.06);border:1px solid rgba(106,227,255,0.14);margin-bottom:16px;">
                                <div style="color:rgba(232,240,255,0.62);font-size:12px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:8px;">Reset Link</div>
                                <div style="color:#6ae3ff;font-size:13px;line-height:1.7;word-break:break-all;">{{ $resetLink }}</div>
                            </div>

                            <div style="padding:16px 18px;border-radius:16px;background:rgba(251,191,36,0.06);border:1px solid rgba(251,191,36,0.16);color:rgba(232,240,255,0.72);font-size:13px;line-height:1.7;">
                                This reset link expires in 1 hour. If you did not request this change, you can safely ignore this email.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 24px;border-top:1px solid rgba(255,255,255,0.05);text-align:center;color:rgba(232,240,255,0.52);font-size:12px;line-height:1.7;">
                            This is an automated security message from Cryptexa.<br>
                            © {{ date('Y') }} Cryptexa. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
