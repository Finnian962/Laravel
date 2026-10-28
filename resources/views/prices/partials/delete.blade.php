<dialog id="delete-price-modal" class="modal">

    <div class="modal-content">

        <div class="modal-header">
            <h2>Prijs verwijderen</h2>

            <button
                type="button"
                id="close-delete-price"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <p class="modal-body">
            Weet je zeker dat je de prijs van <strong id="delete-price-name"></strong> wilt verwijderen?
            Dit kan niet ongedaan worden gemaakt.
        </p>

        <form
            method="POST"
            id="delete-price-form"
            action=""
        >
            @csrf
            @method('DELETE')

            <div class="form-actions">
                <button
                    type="button"
                    id="cancel-delete-price"
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
        const modal = document.getElementById('delete-price-modal');
        const form = document.getElementById('delete-price-form');
        const name = document.getElementById('delete-price-name');

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

        document.getElementById('close-delete-price')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-delete-price')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
