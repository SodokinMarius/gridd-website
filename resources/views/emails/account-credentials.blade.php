<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>{{ $isNewAccount ? 'Votre accès à l’espace d’administration' : 'Mot de passe réinitialisé' }}</title>
</head>
<body style="margin:0;padding:24px;background:#FAF8F4;font-family:Arial,Helvetica,sans-serif;color:#10201A;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:0 auto;background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid rgba(16,32,26,0.08);">
        <tr>
            <td style="background:#1B631C;padding:24px 32px;color:#ffffff;">
                <p style="margin:0;font-size:12px;letter-spacing:2px;text-transform:uppercase;opacity:.75;">GRIDD Consulting et Services — Administration</p>
                <h1 style="margin:8px 0 0;font-size:20px;">{{ $isNewAccount ? 'Bienvenue, '.$user->name : 'Votre mot de passe a été réinitialisé' }}</h1>
            </td>
        </tr>
        <tr>
            <td style="padding:28px 32px;font-size:14px;line-height:22px;">
                @if ($isNewAccount)
                    <p style="margin:0 0 16px;">Un compte <strong>{{ $roleLabel }}</strong> vient d’être créé pour vous sur l’espace d’administration du site GRIDD.</p>
                @else
                    <p style="margin:0 0 16px;">Un administrateur a défini un nouveau mot de passe provisoire pour votre compte.</p>
                @endif

                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#FAF8F4;border-left:4px solid #2E9D30;border-radius:8px;">
                    <tr><td style="padding:16px 20px 4px;color:#6B766F;width:150px;">Identifiant</td><td style="padding:16px 20px 4px;font-weight:bold;">{{ $user->email }}</td></tr>
                    <tr><td style="padding:4px 20px 16px;color:#6B766F;">Mot de passe provisoire</td><td style="padding:4px 20px 16px;font-weight:bold;font-family:Consolas,Menlo,monospace;font-size:15px;">{{ $temporaryPassword }}</td></tr>
                </table>

                <p style="margin:24px 0 8px;"><strong>Lors de votre première connexion, vous devrez choisir votre propre mot de passe.</strong> Le mot de passe provisoire ne fonctionnera plus ensuite.</p>

                <p style="margin:24px 0;">
                    <a href="{{ $loginUrl }}" style="display:inline-block;background:#2E9D30;color:#ffffff;text-decoration:none;font-weight:bold;padding:12px 24px;border-radius:999px;">Me connecter</a>
                </p>

                <p style="margin:0;font-size:12px;color:#6B766F;">Si le bouton ne fonctionne pas, copiez ce lien dans votre navigateur : <a href="{{ $loginUrl }}" style="color:#2E9D30;">{{ $loginUrl }}</a></p>
                <p style="margin:16px 0 0;font-size:12px;color:#6B766F;">Ne transférez pas cet email. Si vous n’attendiez pas ce message, contactez l’administrateur du site.</p>
            </td>
        </tr>
    </table>
</body>
</html>
