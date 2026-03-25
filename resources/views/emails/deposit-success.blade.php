<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Confirmed</title>
</head>
<body style="margin:0;padding:0;background:#06101d;font-family:Arial,sans-serif;color:#e8f0ff;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:linear-gradient(180deg,#06101d 0%,#07111f 48%,#0a1422 100%);padding:32px 16px;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:620px;background:#091221;border:1px solid rgba(106,227,255,0.16);border-radius:24px;overflow:hidden;box-shadow:0 18px 46px rgba(0,0,0,0.28);">
                    <tr>
                        <td style="padding:18px 24px;background:linear-gradient(135deg,rgba(56,189,248,0.18),rgba(34,197,94,0.10));border-bottom:1px solid rgba(106,227,255,0.14);text-align:center;">
                            <div style="display:inline-block;padding:6px 12px;border-radius:999px;background:rgba(106,227,255,0.10);border:1px solid rgba(106,227,255,0.16);color:#b7f4ff;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;">Cryptexa</div>
                            <h1 style="margin:14px 0 6px;color:#f8fbff;font-size:28px;font-weight:800;">Deposit Confirmed</h1>
                            <p style="margin:0;color:rgba(232,240,255,0.72);font-size:14px;line-height:1.6;">Your funds have been credited to your account.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 24px;">
                            <div style="padding:18px;border-radius:18px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);margin-bottom:18px;">
                                <p style="margin:0;color:rgba(232,240,255,0.72);font-size:14px;line-height:1.7;">
                                    Your deposit has been successfully confirmed and is now available in your Cryptexa balance.
                                </p>
                            </div>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:separate;border-spacing:0 10px;">
                                <tr>
                                    <td style="padding:14px 16px;border-radius:16px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.18);color:rgba(232,240,255,0.72);font-size:13px;">Amount Credited</td>
                                    <td align="right" style="padding:14px 16px;border-radius:16px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.18);color:#86efac;font-size:20px;font-weight:800;">+${{ number_format($deposit->pay_amount ?? $deposit->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 16px;border-radius:16px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);color:rgba(232,240,255,0.72);font-size:13px;">Currency</td>
                                    <td align="right" style="padding:14px 16px;border-radius:16px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);color:#f8fbff;font-size:15px;font-weight:700;">{{ strtoupper($deposit->currency) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 16px;border-radius:16px;background:rgba(56,189,248,0.08);border:1px solid rgba(56,189,248,0.18);color:rgba(232,240,255,0.72);font-size:13px;">New Balance</td>
                                    <td align="right" style="padding:14px 16px;border-radius:16px;background:rgba(56,189,248,0.08);border:1px solid rgba(56,189,248,0.18);color:#6ae3ff;font-size:18px;font-weight:800;">${{ number_format($newBalance, 2) }}</td>
                                </tr>
                            </table>

                            <div style="margin-top:18px;padding:16px 18px;border-radius:16px;background:rgba(106,227,255,0.06);border:1px solid rgba(106,227,255,0.14);color:rgba(232,240,255,0.72);font-size:13px;line-height:1.7;">
                                You can now activate vaults and start earning from your updated balance.
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
