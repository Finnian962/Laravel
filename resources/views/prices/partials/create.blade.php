<dialog id="create-price-modal" class="modal" @if ($errors->any()) open @endif>

    <div class="modal-content">

        <div class="modal-header">
            <h2>Nieuwe prijs</h2>

            <button
                type="button"
                id="close-create-price"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <form
            method="POST"
            action="{{ route('prices.create') }}"
            class="form"
        >
            @csrf

            <div class="form-group">
                <label
                    for="price"
                    class="form-label"
                >
                    Prijs
                </label>

                <input
                    type="number"
                    id="price"
                    name="price"
                    class="form-input"
                    value="{{ old('price') }}"
                    step="0.01"
                    min="0"
                    required
                    autofocus
                >

                @error('price')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label
                    for="effdate"
                    class="form-label"
                >
                    Geldig vanaf
                </label>

                <input
                    type="date"
                    id="effdate"
                    name="effdate"
                    class="form-input"
                    value="{{ old('effdate') }}"
                    required
                >

                @error('effdate')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label
                    for="product_id"
                    class="form-label"
                >
                    Product
                </label>

                <select
                    id="product_id"
                    name="product_id"
                    class="form-input"
                    required
                >
                    <option
                        value=""
                        disabled
                        @if (! old('product_id')) selected @endif
                    >
                        Kies een product
                    </option>

                    @foreach($products as $product)
                        <option
                            value="{{ $product->id }}"
                            @if (old('product_id') == $product->id) selected @endif
                        >
                            {{ $product->name }} ({{ $product->category->name }})
                        </option>
                    @endforeach
                </select>

                @error('product_id')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-actions">
                <button
                    type="button"
                    id="cancel-create-price"
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
        const modal = document.getElementById('create-price-modal');

        if (!modal) {
            return;
        }

        document.getElementById('open-create-price')?.addEventListener('click', () => modal.showModal());
        document.getElementById('close-create-price')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-create-price')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
