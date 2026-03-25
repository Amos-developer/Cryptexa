<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body style="margin:0;padding:0;background:#06101d;font-family:Arial,sans-serif;color:#e8f0ff;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:linear-gradient(180deg,#06101d 0%,#07111f 48%,#0a1422 100%);padding:32px 16px;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:620px;background:#091221;border:1px solid rgba(106,227,255,0.16);border-radius:24px;overflow:hidden;box-shadow:0 18px 46px rgba(0,0,0,0.28);">
                    <tr>
                        <td style="padding:18px 24px;background:linear-gradient(135deg,rgba(56,189,248,0.18),rgba(14,165,233,0.12));border-bottom:1px solid rgba(106,227,255,0.14);text-align:center;">
                            <div style="display:inline-block;padding:6px 12px;border-radius:999px;background:rgba(106,227,255,0.10);border:1px solid rgba(106,227,255,0.16);color:#b7f4ff;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;">Cryptexa Access</div>
                            <h1 style="margin:14px 0 6px;color:#f8fbff;font-size:28px;font-weight:800;">Email Verification</h1>
                            <p style="margin:0;color:rgba(232,240,255,0.72);font-size:14px;line-height:1.6;">Confirm your email to secure your account access.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 24px;">
                            <div style="padding:18px;border-radius:18px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);margin-bottom:18px;color:rgba(232,240,255,0.72);font-size:14px;line-height:1.7;">
                                Use the verification code below to confirm your email address.
                            </div>

                            <div style="padding:24px 18px;border-radius:20px;background:rgba(56,189,248,0.08);border:1px solid rgba(56,189,248,0.18);text-align:center;margin-bottom:18px;">
                                <div style="color:rgba(232,240,255,0.62);font-size:12px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;margin-bottom:10px;">Verification Code</div>
                                <div style="color:#6ae3ff;font-size:42px;font-weight:900;letter-spacing:8px;">{{ $code }}</div>
                            </div>

                            <div style="padding:16px 18px;border-radius:16px;background:rgba(251,113,133,0.06);border:1px solid rgba(251,113,133,0.16);color:rgba(232,240,255,0.72);font-size:13px;line-height:1.7;">
                                This code expires in <strong style="color:#fecdd3;">10 minutes</strong>. If you did not request this verification, you can safely ignore this email.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 24px;border-top:1px solid rgba(255,255,255,0.05);text-align:center;color:rgba(232,240,255,0.52);font-size:12px;line-height:1.7;">
                            This is an automated message from Cryptexa.<br>
                            © {{ date('Y') }} Cryptexa. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
