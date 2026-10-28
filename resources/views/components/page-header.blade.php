<div class="mb-8">
    <a href="{{ $backHref ?? url('/') }}" class="text-sm font-medium text-slate-500 transition-colors hover:text-slate-900">
        &larr; {{ $backLabel }}
    </a>

    <div class="mt-4 flex flex-wrap items-end justify-between gap-x-6 gap-y-3">
        <div class="max-w-2xl">
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 sm:text-3xl">{{ $title }}</h1>
            @if ($subtitle)
                <p class="mt-2 text-[15px] leading-relaxed text-slate-500">{{ $subtitle }}</p>
            @endif
        </div>

        <div class="flex items-center gap-4">
            @if ($actions ?? null)
                {{ $actions }}
            @endif

            @if ($meta)
                <span class="text-sm tabular-nums text-slate-400">{{ $meta }}</span>
            @endif
        </div>
    </div>
</div>
