@extends('layouts.app')

@section('title', 'Rollen')

@section('content')
    <x-page-header
        title="Rollen"
        subtitle="De rollen die je aan gebruikers kunt geven."
        :meta="$roles->count() . ' rollen'"
    >
        <x-slot:actions>
            <button type="button" id="open-create-role" class="btn">+ Nieuwe rol</button>
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
                    <th class="text-right">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td class="row-muted tabular-nums">{{ $role->id }}</td>
                    <td><span class="badge">{{ $role->name }}</span></td>
                    <td class="text-right">
                        @if ($role->canDelete())
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-delete-url="{{ route('roles.delete', $role) }}"
                                data-delete-name="{{ $role->name }}"
                            >
                                Verwijderen
                            </button>
                        @else
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Niet te verwijderen: er zijn nog gebruikers met deze rol."
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

    @include('roles.partials.create')
    @include('roles.partials.delete')
@endsection
