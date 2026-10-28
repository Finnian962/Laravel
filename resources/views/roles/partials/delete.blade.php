<dialog id="delete-role-modal" class="modal">

    <div class="modal-content">

        <div class="modal-header">
            <h2>Rol verwijderen</h2>

            <button
                type="button"
                id="close-delete-role"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <p class="modal-body">
            Weet je zeker dat je <strong id="delete-role-name"></strong> wilt verwijderen?
            Dit kan niet ongedaan worden gemaakt.
        </p>

        <form
            method="POST"
            id="delete-role-form"
            action=""
        >
            @csrf
            @method('DELETE')

            <div class="form-actions">
                <button
                    type="button"
                    id="cancel-delete-role"
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
        const modal = document.getElementById('delete-role-modal');
        const form = document.getElementById('delete-role-form');
        const name = document.getElementById('delete-role-name');

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

        document.getElementById('close-delete-role')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-delete-role')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
