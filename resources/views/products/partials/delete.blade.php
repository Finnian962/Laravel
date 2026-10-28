<dialog id="delete-product-modal" class="modal">

    <div class="modal-content">

        <div class="modal-header">
            <h2>Product verwijderen</h2>

            <button
                type="button"
                id="close-delete-product"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <p class="modal-body">
            Weet je zeker dat je <strong id="delete-product-name"></strong> wilt verwijderen?
            Dit kan niet ongedaan worden gemaakt.
        </p>

        <form
            method="POST"
            id="delete-product-form"
            action=""
        >
            @csrf
            @method('DELETE')

            <div class="form-actions">
                <button
                    type="button"
                    id="cancel-delete-product"
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
        const modal = document.getElementById('delete-product-modal');
        const form = document.getElementById('delete-product-form');
        const name = document.getElementById('delete-product-name');

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

        document.getElementById('close-delete-product')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-delete-product')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
