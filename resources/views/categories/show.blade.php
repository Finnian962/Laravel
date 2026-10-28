@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <x-page-header
        :title="$category->name"
        subtitle="Alle spellen in deze categorie, met beschrijving en prijs."
        :back-href="route('categories.index')"
        back-label="Alle categorieën"
        :meta="$category->products->count() . ' spellen'"
    />

    <div class="mb-8 flex flex-wrap gap-2">
        @foreach($categories as $overviewCategory)
            @if($overviewCategory->is($category))
                <span class="rounded-full bg-slate-900 px-3.5 py-1.5 text-[13px] font-medium text-white">
                    {{ $overviewCategory->name }} <span class="text-white/50">({{ $overviewCategory->products_count }})</span>
                </span>
            @else
                <a href="{{ route('categories.show', $overviewCategory) }}" class="rounded-full border border-slate-200 bg-white px-3.5 py-1.5 text-[13px] font-medium text-slate-500 transition-colors hover:border-slate-300 hover:text-slate-900">
                    {{ $overviewCategory->name }} <span class="text-slate-400">({{ $overviewCategory->products_count }})</span>
                </a>
            @endif
        @endforeach
    </div>

    <h2 class="mb-3 text-sm font-semibold uppercase tracking-wider text-slate-400">Spellen ({{ $category->products->count() }})</h2>

    <div class="surface overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-16">ID</th>
                    <th>Naam</th>
                    <th class="w-[45%]">Beschrijving</th>
                    <th class="text-right">Prijs</th>
                </tr>
            </thead>
            <tbody>
                @forelse($category->products as $product)
                <tr>
                    <td class="row-muted tabular-nums">{{ $product->id }}</td>
                    <td class="row-strong">{{ $product->name }}</td>
                    <td class="row-text">{{ $product->description }}</td>
                    <td class="price text-right whitespace-nowrap">&euro;{{ $product->currentPrice()?->price }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-12 text-center text-slate-400">Geen spellen in deze categorie.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
