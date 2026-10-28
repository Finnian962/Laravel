<dialog id="delete-order-modal" class="modal">

    <div class="modal-content">

        <div class="modal-header">
            <h2>Bestelling verwijderen</h2>

            <button
                type="button"
                id="close-delete-order"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <p class="modal-body">
            Weet je zeker dat je <strong id="delete-order-name"></strong> wilt verwijderen?
            Dit kan niet ongedaan worden gemaakt.
        </p>

        <form
            method="POST"
            id="delete-order-form"
            action=""
        >
            @csrf
            @method('DELETE')

            <div class="form-actions">
                <button
                    type="button"
                    id="cancel-delete-order"
                    class="btn btn-secondary"
                >
                    Annuleren
                </button>

                <button
                    type="submit"
                    class="btn btn-danger"
                >
                    Verwijderen
                </button>
            </div>
        </form>
    </div>

</dialog>

@pushOnce('scripts')
<script>
    (() => {
        const modal = document.getElementById('delete-order-modal');
        const form = document.getElementById('delete-order-form');
        const name = document.getElementById('delete-order-name');

        if (!modal || !form || !name) {
            return;
        }

        document.querySelectorAll('[data-delete-url]').forEach((button) => {
            button.addEventListener('click', () => {
                form.action = button.dataset.deleteUrl;
                name.textContent = button.dataset.deleteName;
                modal.showModal();
            });
        });

        document.getElementById('close-delete-order')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-delete-order')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
