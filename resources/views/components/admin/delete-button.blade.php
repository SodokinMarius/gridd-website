{{--
    Bouton de suppression (icône) avec confirmation dans une fenêtre modale.
    - Avec `action` : génère son propre formulaire DELETE.
    - Avec `form` : cible un formulaire existant par son id (utile à l'intérieur d'un autre formulaire,
      le formulaire DELETE étant alors poussé dans la pile `admin-forms`).
--}}
@props(['action' => null, 'form' => null, 'message' => 'Confirmer la suppression ?', 'label' => 'Supprimer'])

@php
    $formId = $form ?? 'delete-'.md5($action);
@endphp

<button type="submit" form="{{ $formId }}" {{ $attributes->merge(['class' => 'admin-icon-btn admin-icon-btn-delete']) }} title="{{ $label }}" aria-label="{{ $label }}">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M3 6h18"/>
        <path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2"/>
        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
        <path d="M10 11v6M14 11v6"/>
    </svg>
</button>

@if ($action)
    @push('admin-forms')
        <form id="{{ $formId }}" method="POST" action="{{ $action }}" data-confirm="{{ $message }}" hidden>
            @csrf
            @method('DELETE')
        </form>
    @endpush
@endif
