@extends('layouts.app')

@section('title', 'Producten')

@section('content')
    <x-page-header
        title="Producten"
        subtitle="Alle spellen met hun categorie. Klik op een categorie om de andere spellen te zien."
        :meta="$products->count() . ' producten'"
    >
        <x-slot:actions>
            <button type="button" id="open-create-product" class="btn">+ Nieuwe product</button>
        </x-slot:actions>
    </x-page-header>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="surface overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-16">ID</th>
                    <th>Naam</th>
                    <th class="w-[35%]">Beschrijving</th>
                    <th>Categorie</th>
                    <th class="text-right">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="row-muted tabular-nums">{{ $product->id }}</td>
                    <td class="row-strong">{{ $product->name }}</td>
                    <td class="row-text">{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('categories.show', $product->category) }}" class="badge">{{ $product->category->name }}</a>
                    </td>
                    <td class="text-right">
                        @if ($product->canDelete())
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-delete-url="{{ route('products.delete', $product) }}"
                                data-delete-name="{{ $product->name }}"
                            >
                                Verwijderen
                            </button>
                        @else
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Niet te verwijderen: er staan nog prijzen, reviews of bestelregels aan dit product gekoppeld."
                            >
                                Verwijderen
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('products.partials.create')
    @include('products.partials.delete')
@endsection
