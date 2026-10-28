<dialog id="create-user-modal" class="modal" @if ($errors->any()) open @endif>

    <div class="modal-content">

        <div class="modal-header">
            <h2>Nieuwe gebruiker</h2>

            <button
                type="button"
                id="close-create-user"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <form
            method="POST"
            action="{{ route('users.create') }}"
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

            <div class="form-group">
                <label
                    for="email"
                    class="form-label"
                >
                    E-mail
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input"
                    value="{{ old('email') }}"
                    maxlength="45"
                    required
                >

                @error('email')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label
                    for="password"
                    class="form-label"
                >
                    Wachtwoord
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    minlength="8"
                    required
                >

                @error('password')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label
                    for="role_id"
                    class="form-label"
                >
                    Rol
                </label>

                <select
                    id="role_id"
                    name="role_id"
                    class="form-input"
                    required
                >
                    <option
                        value=""
                        disabled
                        @if (old('role_id') === null || old('role_id') === '') selected @endif
                    >
                        Kies een rol
                    </option>

                    @foreach ($roles as $role)
                        <option
                            value="{{ $role->id }}"
                            @if (old('role_id') == $role->id) selected @endif
                        >
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>

                @error('role_id')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-actions">
                <button
                    type="button"
                    id="cancel-create-user"
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
        const modal = document.getElementById('create-user-modal');

        if (!modal) {
            return;
        }

        document.getElementById('open-create-user')?.addEventListener('click', () => modal.showModal());
        document.getElementById('close-create-user')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-create-user')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
