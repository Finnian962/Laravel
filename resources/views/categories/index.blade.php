@extends('layouts.app')

@section('title', 'Categorieën')

@section('content')
    <x-page-header
        title="Categorieën"
        subtitle="Klik op een categorie om alle spellen daarvan te zien."
        :meta="$categories->count() . ' categorieën'"
    >
        <x-slot:actions>
            <button type="button" id="open-create-category" class="btn">+ Nieuwe categorie</button>
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
                    <th class="text-right">Aantal spellen</th>
                    <th class="text-right">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="row-muted tabular-nums">{{ $category->id }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category) }}" class="link">{{ $category->name }}</a>
                    </td>
                    <td class="text-right">
                        <span class="badge tabular-nums">{{ $category->products_count }}</span>
                    </td>
                    <td class="text-right">
                        @if ($category->canDelete())
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-delete-url="{{ route('categories.delete', $category) }}"
                                data-delete-name="{{ $category->name }}"
                            >
                                Verwijderen
                            </button>
                        @else
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Niet te verwijderen: er staan nog spellen in deze categorie."
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

    @include('categories.partials.create')
    @include('categories.partials.delete')
@endsection
