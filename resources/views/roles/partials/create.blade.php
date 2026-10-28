<dialog id="create-role-modal" class="modal" @if ($errors->any()) open @endif>

    <div class="modal-content">

        <div class="modal-header">
            <h2>Nieuwe rol</h2>

            <button
                type="button"
                id="close-create-role"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <form
            method="POST"
            action="{{ route('roles.create') }}"
            class="form"
        >
            @csrf

            <div class="form-group">
                <label
                    for="name"
                    class="form-label"
                >
                    Naam
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-input"
                    value="{{ old('name') }}"
                    maxlength="45"
                    required
                    autofocus
                >

                @error('name')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-actions">
                <button
                    type="button"
                    id="cancel-create-role"
                    class="btn btn-secondary"
                >
                    Annuleren
                </button>

                <button
                    type="submit"
                    class="btn"
                >
                    Opslaan
                </button>
            </div>
        </form>
    </div>

</dialog>

@pushOnce('scripts')
<script>
    (() => {
        const modal = document.getElementById('create-role-modal');

        if (!modal) {
            return;
        }

        document.getElementById('open-create-role')?.addEventListener('click', () => modal.showModal());
        document.getElementById('close-create-role')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-create-role')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
