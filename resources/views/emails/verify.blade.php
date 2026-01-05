<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>

<body style="
    margin:0;
    padding:0;
    background-color:#020617;
    font-family:Arial, Helvetica, sans-serif;
    color:#e5e7eb;
">

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center" style="padding:40px 12px;">

                <!-- CARD -->
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                    style="
                    max-width:480px;
                    background:linear-gradient(180deg,#020617,#0f172a);
                    border-radius:16px;
                    border:1px solid rgba(56,189,248,.25);
                    box-shadow:0 20px 40px rgba(56,189,248,.25);
                ">

                    <!-- HEADER -->
                    <tr>
                        <td style="padding:28px 24px 12px;text-align:center;">
                            <h2 style="
                            margin:0;
                            font-size:22px;
                            font-weight:600;
                            color:#ffffff;
                        ">
                                Email Verification
                            </h2>
                            <p style="
                            margin:8px 0 0;
                            font-size:14px;
                            color:#94a3b8;
                        ">
                                Secure access to your account
                            </p>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:24px;text-align:center;">

                            <p style="
                            margin:0 0 16px;
                            font-size:15px;
                            line-height:1.6;
                            color:#cbd5f5;
                        ">
                                Use the verification code below to confirm your email address.
                            </p>

                            <!-- CODE BOX -->
                            <div style="
                            display:inline-block;
                            padding:16px 28px;
                            background:#020617;
                            border-radius:12px;
                            border:1px solid rgba(56,189,248,.4);
                            margin:12px 0 20px;
                        ">
                                <span style="
                                font-size:28px;
                                font-weight:700;
                                letter-spacing:6px;
                                color:#38bdf8;
                            ">
                                    {{ $code }}
                                </span>
                            </div>

                            <p style="
                            margin:0;
                            font-size:13px;
                            color:#94a3b8;
                        ">
                                This code will expire in <strong>10 minutes</strong>.
                            </p>

                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="
                        padding:16px 24px 24px;
                        text-align:center;
                        border-top:1px solid rgba(56,189,248,.15);
                    ">
                            <p style="
                            margin:0;
                            font-size:12px;
                            color:#64748b;
                            line-height:1.6;
                        ">
                                If you did not request this verification, you can safely ignore this email.<br>
                                © {{ date('Y') }} Cryptexa. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- END CARD -->

            </td>
        </tr>
    </table>

</body>

</html>