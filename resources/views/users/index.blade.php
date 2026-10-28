@extends('layouts.app')

@section('title', 'Gebruikers')

@section('content')
    <x-page-header
        title="Gebruikers"
        subtitle="Alle accounts en hun rol."
        :meta="$users->count() . ' gebruikers'"
    >
        <x-slot:actions>
            <button type="button" id="open-create-user" class="btn">+ Nieuwe gebruiker</button>
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
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="text-right">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="row-muted tabular-nums">{{ $user->id }}</td>
                    <td class="row-strong">{{ $user->name }}</td>
                    <td class="row-text">{{ $user->email }}</td>
                    <td><span class="badge">{{ $user->role->name }}</span></td>
                    <td class="text-right">
                        @if ($user->canDelete())
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-delete-url="{{ route('users.delete', $user) }}"
                                data-delete-name="{{ $user->name }}"
                            >
                                Verwijderen
                            </button>
                        @else
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Niet te verwijderen: er zijn nog reviews of bestellingen van deze gebruiker."
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

    @include('users.partials.create')
    @include('users.partials.delete')
@endsection
