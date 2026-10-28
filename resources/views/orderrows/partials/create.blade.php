<dialog id="create-orderrow-modal" class="modal" @if ($errors->any()) open @endif>

    <div class="modal-content">

        <div class="modal-header">
            <h2>Nieuwe bestelregel</h2>

            <button
                type="button"
                id="close-create-orderrow"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <form
            method="POST"
            action="{{ route('orderrows.create') }}"
            class="form"
        >
            @csrf

            <div class="form-group">
                <label
                    for="order_id"
                    class="form-label"
                >
                    Bestelling
                </label>

                <select
                    id="order_id"
                    name="order_id"
                    class="form-input"
                    required
                    autofocus
                >
                    <option
                        value=""
                        disabled
                        @if (! old('order_id')) selected @endif
                    >
                        Kies een bestelling
                    </option>

                    @foreach($orders as $order)
                        <option
                            value="{{ $order->id }}"
                            @if (old('order_id') == $order->id) selected @endif
                        >
                            #{{ $order->id }} — {{ $order->user->name }} ({{ $order->orderdate }})
                        </option>
                    @endforeach
                </select>

                @error('order_id')
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
                    id="cancel-create-orderrow"
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
        const modal = document.getElementById('create-orderrow-modal');

        if (!modal) {
            return;
        }

        document.getElementById('open-create-orderrow')?.addEventListener('click', () => modal.showModal());
        document.getElementById('close-create-orderrow')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-create-orderrow')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
