@extends('layouts.app')

@section('title', 'Bestellingen')

@section('content')
    <x-page-header
        title="Bestellingen"
        subtitle="Alle bestellingen met gebruiker en status."
        :meta="$orders->count() . ' bestellingen'"
    >
        <x-slot:actions>
            <button type="button" id="open-create-order" class="btn">+ Nieuwe bestelling</button>
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
                    <th>Datum</th>
                    <th>Gebruiker</th>
                    <th>Status</th>
                    <th class="text-right">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="row-muted tabular-nums">{{ $order->id }}</td>
                    <td class="row-text tabular-nums">{{ $order->orderdate }}</td>
                    <td class="row-strong">{{ $order->user->name }}</td>
                    <td><span class="badge">{{ $order->status }}</span></td>
                    <td class="text-right">
                        @if ($order->canDelete())
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-delete-url="{{ route('orders.delete', $order) }}"
                                data-delete-name="de bestelling #{{ $order->id }} van {{ $order->user->name }}"
                            >
                                Verwijderen
                            </button>
                        @else
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Niet te verwijderen: er staan nog bestelregels aan deze bestelling gekoppeld."
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

    @include('orders.partials.create')
    @include('orders.partials.delete')
@endsection
