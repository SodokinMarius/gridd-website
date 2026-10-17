{!! $isNewAccount ? 'Bienvenue, '.$user->name : 'Votre mot de passe a été réinitialisé' !!}

@if ($isNewAccount)
Un compte {!! $roleLabel !!} vient d'être créé pour vous sur l'espace d'administration du site GRIDD.
@else
Un administrateur a défini un nouveau mot de passe provisoire pour votre compte.
@endif

Identifiant : {!! $user->email !!}
Mot de passe provisoire : {!! $temporaryPassword !!}

Lors de votre première connexion, vous devrez choisir votre propre mot de passe.

Se connecter : {!! $loginUrl !!}

Ne transférez pas cet email. Si vous n'attendiez pas ce message, contactez l'administrateur du site.
