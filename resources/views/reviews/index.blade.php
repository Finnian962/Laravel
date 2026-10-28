@extends('layouts.app')

@section('title', 'Reviews')

@section('content')
    <x-page-header
        title="Reviews"
        subtitle="Wat gebruikers van de spellen vinden."
        :meta="$reviews->count() . ' reviews'"
    >
        <x-slot:actions>
            <button type="button" id="open-create-review" class="btn">+ Nieuwe review</button>
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
                    <th>Commentaar</th>
                    <th>Gebruiker</th>
                    <th>Product</th>
                    <th>Categorie</th>
                    <th class="text-right">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                <tr>
                    <td class="row-muted tabular-nums">{{ $review->id }}</td>
                    <td class="row-text">{{ $review->comment }}</td>
                    <td class="row-strong">{{ $review->user->name }}</td>
                    <td>{{ $review->product->name }}</td>
                    <td>
                        <a href="{{ route('categories.show', $review->product->category) }}" class="badge">{{ $review->product->category->name }}</a>
                    </td>
                    <td class="text-right">
                        @if ($review->canDelete())
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-delete-url="{{ route('reviews.delete', $review) }}"
                                data-delete-name="de review van {{ $review->user->name }} over {{ $review->product->name }}"
                            >
                                Verwijderen
                            </button>
                        @else
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Niet te verwijderen: er verwijzen geen records naar deze review."
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

    @include('reviews.partials.create')
    @include('reviews.partials.delete')
@endsection
