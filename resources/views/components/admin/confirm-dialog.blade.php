{{-- Fenêtre de confirmation utilisée par les formulaires portant l'attribut data-confirm. --}}
<dialog id="confirm-dialog" class="admin-confirm" aria-labelledby="confirm-dialog-title" aria-describedby="confirm-dialog-message">
    <div class="admin-confirm-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 6h18"/>
            <path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2"/>
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
        </svg>
    </div>
    <h2 id="confirm-dialog-title" class="admin-confirm-title">Confirmer la suppression</h2>
    <p id="confirm-dialog-message" class="admin-confirm-message"></p>
    <p class="admin-confirm-note">Cette action est définitive.</p>
    <div class="admin-confirm-actions">
        <button type="button" class="admin-confirm-cancel" data-confirm-cancel>Annuler</button>
        <button type="button" class="admin-confirm-ok" data-confirm-ok>Supprimer</button>
    </div>
</dialog>
