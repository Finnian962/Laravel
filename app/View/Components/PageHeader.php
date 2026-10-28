<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public function __construct(
        public string $title,
        public ?string $subtitle = null,
        public ?string $meta = null,
        public ?string $backHref = null,
        public string $backLabel = 'Terug naar overzicht',
    ) {}

    public function render(): View
    {
        return view('components.page-header');
    }
}
