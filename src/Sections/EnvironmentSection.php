<?php

namespace DF\LaravelInfo\Sections;

use DF\LaravelInfo\Contracts\Section;

class EnvironmentSection implements Section
{
    public function title(): string
    {
        return 'Environment';
    }

    public function data(): array
    {
        return [
            'Env'       => app()->environment(),
            'Server IP' => $_SERVER['SERVER_ADDR'] ?? gethostbyname(gethostname()),
            'Client IP' => request()->ip(),
        ];
    }
}
