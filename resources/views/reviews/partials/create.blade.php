<dialog id="create-review-modal" class="modal" @if ($errors->any()) open @endif>

    <div class="modal-content">

        <div class="modal-header">
            <h2>Nieuwe review</h2>

            <button
                type="button"
                id="close-create-review"
                class="modal-close"
                aria-label="Sluiten"
            >
                &times;
            </button>
        </div>

        <form
            method="POST"
            action="{{ route('reviews.create') }}"
            class="form"
        >
            @csrf

            <div class="form-group">
                <label
                    for="comment"
                    class="form-label"
                >
                    Reactie
                </label>

                <textarea
                    id="comment"
                    name="comment"
                    class="form-input"
                    rows="4"
                    maxlength="1000"
                    required
                    autofocus
                >{{ old('comment') }}</textarea>

                @error('comment')
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
                    id="cancel-create-review"
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
        const modal = document.getElementById('create-review-modal');

        if (!modal) {
            return;
        }

        document.getElementById('open-create-review')?.addEventListener('click', () => modal.showModal());
        document.getElementById('close-create-review')?.addEventListener('click', () => modal.close());
        document.getElementById('cancel-create-review')?.addEventListener('click', () => modal.close());

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    })();
</script>
@endpushOnce
