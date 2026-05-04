<?php

namespace DF\LaravelInfo\Sections;

use DF\LaravelInfo\Contracts\Section;

class StackSection implements Section
{
    public function title(): string
    {
        return 'Stack';
    }

    public function data(): array
    {
        return [
            'Laravel' => app()->version(),
            'PHP'     => PHP_VERSION,
            'SAPI'    => php_sapi_name(),
            'Octane'  => isset($_SERVER['LARAVEL_OCTANE']) ? 'true' : 'false',
            'Vite'    => $this->getViteVersion(),
        ];
    }

    private function getViteVersion(): ?string
    {
        $path = app()->basePath('package-lock.json');
        if (!file_exists($path)) {
            return null;
        }

        $lock = json_decode(file_get_contents($path), true);
        return $lock['packages']['node_modules/vite']['version'] ?? null;
    }
}
