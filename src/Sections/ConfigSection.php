<?php

namespace DF\LaravelInfo\Sections;

use DF\LaravelInfo\Contracts\Section;

class ConfigSection implements Section
{
    public function title(): string
    {
        return 'Config';
    }

    public function data(): array
    {
        return [
            'Cache'    => config('cache.default'),
            'Queue'    => config('queue.default'),
            'Session'  => config('session.driver'),
            'Mail'     => config('mail.default'),
            'Timezone' => config('app.timezone'),
            'Locale'   => app()->getLocale(),
            'Debug'    => config('app.debug') ? 'true' : 'false',
        ];
    }
}
