@extends('layouts.app')

@section('title', 'Spellen Webshop')

@section('content')
    <section class="max-w-2xl">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Categorie&euml;n</p>
        <h1 class="mt-3 text-4xl font-semibold leading-tight tracking-tight sm:text-5xl">Kies een categorie en bekijk de spellen.</h1>
        <p class="mt-5 text-[17px] leading-relaxed text-slate-500">Elke categorie heeft zijn eigen spellen met beschrijving en prijs. Klik op een kaart om erdoorheen te bladeren.</p>
    </section>

    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($categories as $category)
        <a href="{{ route('categories.show', $category) }}" class="surface group flex items-center justify-between gap-4 p-5 transition duration-200 hover:-translate-y-0.5 hover:border-slate-300">
            <span>
                <span class="block text-[15px] font-semibold tracking-tight text-slate-900 transition-colors group-hover:text-blue-600">{{ $category->name }}</span>
                <span class="mt-1 block text-sm tabular-nums text-slate-500">{{ $category->products_count }} spellen</span>
            </span>
            <span class="text-slate-300 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-slate-500" aria-hidden="true">&rarr;</span>
        </a>
        @endforeach
    </div>

    <h2 class="mt-12 mb-4 text-xs font-semibold uppercase tracking-wider text-slate-400">Beheer</h2>
    <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
        <a href="{{ route('categories.index') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 transition-colors hover:border-slate-300 hover:text-slate-900">Categorie&euml;n <span class="text-slate-300" aria-hidden="true">&rarr;</span></a>
        <a href="{{ route('products.index') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 transition-colors hover:border-slate-300 hover:text-slate-900">Producten <span class="text-slate-300" aria-hidden="true">&rarr;</span></a>
        <a href="{{ route('prices.index') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 transition-colors hover:border-slate-300 hover:text-slate-900">Prijzen <span class="text-slate-300" aria-hidden="true">&rarr;</span></a>
        <a href="{{ route('reviews.index') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 transition-colors hover:border-slate-300 hover:text-slate-900">Reviews <span class="text-slate-300" aria-hidden="true">&rarr;</span></a>
        <a href="{{ route('orders.index') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 transition-colors hover:border-slate-300 hover:text-slate-900">Bestellingen <span class="text-slate-300" aria-hidden="true">&rarr;</span></a>
        <a href="{{ route('orderrows.index') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 transition-colors hover:border-slate-300 hover:text-slate-900">Bestelregels <span class="text-slate-300" aria-hidden="true">&rarr;</span></a>
        <a href="{{ route('users.index') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 transition-colors hover:border-slate-300 hover:text-slate-900">Gebruikers <span class="text-slate-300" aria-hidden="true">&rarr;</span></a>
        <a href="{{ route('roles.index') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 transition-colors hover:border-slate-300 hover:text-slate-900">Rollen <span class="text-slate-300" aria-hidden="true">&rarr;</span></a>
    </div>
@endsection
