<dialog id="create-order-modal" class="modal" @if ($errors->any()) open @endif>

    <div class="modal-content">

        <div class="modal-header">
            <h2>Nieuwe bestelling</h2>

            <button
                type="button"
                id="close-create-order"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <form
            method="POST"
            action="{{ route('orders.create') }}"
            class="form"
        >
            @csrf

            <div class="form-group">
                <label
                    for="orderdate"
                    class="form-label"
                >
                    Besteldatum
                </label>

                <input
                    type="date"
                    id="orderdate"
                    name="orderdate"
                    class="form-input"
                    value="{{ old('orderdate') }}"
                    required
                    autofocus
                >

                @error('orderdate')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label
                    for="user_id"
                    class="form-label"
                >
                    Gebruiker
                </label>

                <select
                    id="user_id"
                    name="user_id"
                    class="form-input"
                    required
                >
                    <option
                        value=""
                        disabled
                        @if (! old('user_id')) selected @endif
                    >
                        Kies een gebruiker
                    </option>

                    @foreach($users as $user)
                        <option
                            value="{{ $user->id }}"
                            @if (old('user_id') == $user->id) selected @endif
                        >
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                @error('user_id')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label
                    for="status"
                    class="form-label"
                >
                    Status
                </label>

                <input
                    type="text"
                    id="status"
                    name="status"
                    class="form-input"
                    value="{{ old('status') }}"
                    maxlength="45"
                    required
                >

                @error('status')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-actions">
                <button
                    type="button"
                    id="cancel-create-order"
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
        const modal = document.getElementById('create-order-modal');

        if (!modal) {
            return;
        }

        document.getElementById('open-create-order')?.addEventListener('click', () => modal.showModal());
        document.getElementById('close-create-order')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-create-order')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
