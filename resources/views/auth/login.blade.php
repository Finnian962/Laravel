@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')
    <div class="mx-auto w-full max-w-md py-4">
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 sm:text-3xl">Inloggen</h1>
            <p class="mt-2 text-[15px] leading-relaxed text-slate-500">
                Log in om spellen, categorieën en bestellingen te beheren.
            </p>
        </div>

        <div class="surface p-6">
            <form
                method="POST"
                action="{{ route('login.attempt') }}"
                class="form"
            >
                @csrf

                <div class="form-group">
                    <label
                        for="email"
                        class="form-label"
                    >
                        E-mailadres
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >

                    @error('email')
                        <span class="form-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label
                        for="password"
                        class="form-label"
                    >
                        Wachtwoord
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        required
                    >

                    @error('password')
                        <span class="form-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button
                        type="submit"
                        class="btn w-full"
                    >
                        Inloggen
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
