@extends('layouts.app')

@section('title', 'Bestelregels')

@section('content')
    <x-page-header
        title="Bestelregels"
        subtitle="Welke spellen in welke bestelling zitten."
        :meta="$orderrows->count() . ' regels'"
    >
        <x-slot:actions>
            <button type="button" id="open-create-orderrow" class="btn">+ Nieuwe bestelregel</button>
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
                    <th class="w-32">Bestelling</th>
                    <th>Product</th>
                    <th>Categorie</th>
                    <th class="text-right">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderrows as $orderrow)
                <tr>
                    <td class="row-muted tabular-nums">{{ $orderrow->id }}</td>
                    <td class="row-text tabular-nums">#{{ $orderrow->order->id }}</td>
                    <td class="row-strong">{{ $orderrow->product->name }}</td>
                    <td>
                        <a href="{{ route('categories.show', $orderrow->product->category) }}" class="badge">{{ $orderrow->product->category->name }}</a>
                    </td>
                    <td class="text-right">
                        @if ($orderrow->canDelete())
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-delete-url="{{ route('orderrows.delete', $orderrow) }}"
                                data-delete-name="de bestelregel #{{ $orderrow->id }}"
                            >
                                Verwijderen
                            </button>
                        @else
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Niet te verwijderen: er verwijzen geen records naar deze bestelregel."
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

    @include('orderrows.partials.create')
    @include('orderrows.partials.delete')
@endsection
