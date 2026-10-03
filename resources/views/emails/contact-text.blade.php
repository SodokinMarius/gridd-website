Nouveau message de contact

Nom : {!! $data['name'] !!}
Email : {!! $data['email'] !!}
Téléphone : {!! ($data['phone'] ?? null) ?: '-' !!}
Sujet : {!! $data['subject'] !!}

Message :
{!! $data['message'] !!}
