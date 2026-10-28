<dialog id="create-product-modal" class="modal" @if ($errors->any()) open @endif>

    <div class="modal-content">

        <div class="modal-header">
            <h2>Nieuw product</h2>

            <button
                type="button"
                id="close-create-product"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <form
            method="POST"
            action="{{ route('products.create') }}"
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
                    for="description"
                    class="form-label"
                >
                    Omschrijving
                </label>

                <textarea
                    id="description"
                    name="description"
                    class="form-input"
                    rows="4"
                    required
                >{{ old('description') }}</textarea>

                @error('description')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label
                    for="category_id"
                    class="form-label"
                >
                    Categorie
                </label>

                <select
                    id="category_id"
                    name="category_id"
                    class="form-input"
                    required
                >
                    <option
                        value=""
                        disabled
                        @if (! old('category_id')) selected @endif
                    >
                        Kies een categorie
                    </option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @if (old('category_id') == $category->id) selected @endif
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-actions">
                <button
                    type="button"
                    id="cancel-create-product"
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
        const modal = document.getElementById('create-product-modal');

        if (!modal) {
            return;
        }

        document.getElementById('open-create-product')?.addEventListener('click', () => modal.showModal());
        document.getElementById('close-create-product')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-create-product')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
