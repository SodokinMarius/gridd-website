<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact</title>
</head>
<body style="margin:0;padding:24px;background:#FAF8F4;font-family:Arial,Helvetica,sans-serif;color:#10201A;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:0 auto;background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid rgba(16,32,26,0.08);">
        <tr>
            <td style="background:#1B631C;padding:24px 32px;color:#ffffff;">
                <p style="margin:0;font-size:12px;letter-spacing:2px;text-transform:uppercase;opacity:.75;">Site GRIDD — Formulaire de contact</p>
                <h1 style="margin:8px 0 0;font-size:20px;">{{ $data['subject'] }}</h1>
            </td>
        </tr>
        <tr>
            <td style="padding:28px 32px;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;line-height:22px;">
                    <tr><td style="padding:4px 0;color:#6B766F;width:110px;">Nom</td><td style="padding:4px 0;font-weight:bold;">{{ $data['name'] }}</td></tr>
                    <tr><td style="padding:4px 0;color:#6B766F;">Email</td><td style="padding:4px 0;"><a href="mailto:{{ $data['email'] }}" style="color:#2E9D30;">{{ $data['email'] }}</a></td></tr>
                    <tr><td style="padding:4px 0;color:#6B766F;">Téléphone</td><td style="padding:4px 0;">{{ ($data['phone'] ?? null) ?: '—' }}</td></tr>
                </table>
                <div style="margin-top:24px;padding:20px;background:#FAF8F4;border-left:4px solid #2E9D30;border-radius:8px;font-size:14px;line-height:22px;white-space:pre-line;">{{ $data['message'] }}</div>
                <p style="margin:24px 0 0;font-size:12px;color:#6B766F;">Répondez directement à cet email pour écrire à {{ $data['name'] }}.</p>
            </td>
        </tr>
    </table>
</body>
</html>
