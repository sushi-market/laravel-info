<?php

namespace DF\LaravelInfo\Sections;

use DF\LaravelInfo\Contracts\Section;

class RuntimeSection implements Section
{
    public function title(): string
    {
        return 'Runtime';
    }

    public function data(): array
    {
        return [
            'Memory'  => $this->formatBytes(memory_get_usage(true)),
            'Peak'    => $this->formatBytes(memory_get_peak_usage(true)),
            'Request' => $this->getRequestTime(),
            'OPcache' => function_exists('opcache_get_status') && opcache_get_status() !== false ? 'true' : 'false',
        ];
    }

    private function getRequestTime(): string
    {
        $start = !request()->server('LARAVEL_OCTANE') && defined('LARAVEL_START')
            ? LARAVEL_START
            : request()->server('REQUEST_TIME_FLOAT', microtime(true));

        return round((microtime(true) - $start) * 1000, 2) . 'ms';
    }

    private function formatBytes(int $bytes): string
    {
        return round($bytes / 1024 / 1024, 1) . ' MB';
    }
}
