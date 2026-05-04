<?php

namespace DF\LaravelInfo\Sections;

use DF\LaravelInfo\Contracts\Section;

class CacheSection implements Section
{
    public function title(): string
    {
        return 'Cache';
    }

    public function data(): array
    {
        return [
            'Packages' => is_file(app()->getCachedPackagesPath()) ? 'true' : 'false',
            'Services' => is_file(app()->getCachedServicesPath()) ? 'true' : 'false',
            'Config'   => is_file(app()->getCachedConfigPath()) ? 'true' : 'false',
            'Events'   => is_file(app()->getCachedEventsPath()) ? 'true' : 'false',
            'Routes'   => is_file(app()->getCachedRoutesPath()) ? 'true' : 'false',
        ];
    }
}
