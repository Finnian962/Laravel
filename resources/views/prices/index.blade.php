@extends('layouts.app')

@section('title', 'Prijzen')

@section('content')
    <x-page-header
        title="Prijzen"
        subtitle="De geldende prijs per spel, met de categorie erbij."
        :meta="$prices->count() . ' prijzen'"
    >
        <x-slot:actions>
            <button type="button" id="open-create-price" class="btn">+ Nieuwe prijs</button>
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
                    <th class="text-right">Prijs</th>
                    <th>Geldig vanaf</th>
                    <th>Product</th>
                    <th>Categorie</th>
                    <th class="text-right">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prices as $price)
                <tr>
                    <td class="row-muted tabular-nums">{{ $price->id }}</td>
                    <td class="price text-right whitespace-nowrap">&euro;{{ $price->price }}</td>
                    <td class="row-text tabular-nums">{{ $price->effdate }}</td>
                    <td class="row-strong">{{ $price->product->name }}</td>
                    <td>
                        <a href="{{ route('categories.show', $price->product->category) }}" class="badge">{{ $price->product->category->name }}</a>
                    </td>
                    <td class="text-right">
                        @if ($price->canDelete())
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-delete-url="{{ route('prices.delete', $price) }}"
                                data-delete-name="{{ $price->product->name }}"
                            >
                                Verwijderen
                            </button>
                        @else
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Niet te verwijderen."
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

    @include('prices.partials.create')
    @include('prices.partials.delete')
@endsection
