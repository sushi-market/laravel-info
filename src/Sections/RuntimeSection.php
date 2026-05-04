<?php

namespace DF\LaravelInfo\Sections;

use DF\LaravelInfo\Contracts\Section;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;

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
            'Horizon' => $this->getHorizonStatus(),
        ];
    }

    private function getHorizonStatus(): ?string
    {
        if (!interface_exists(MasterSupervisorRepository::class)) {
            return null;
        }

        try {
            $masters = app(MasterSupervisorRepository::class)->all();
            return count($masters) > 0 ? 'running' : 'inactive';
        } catch (\Throwable) {
            return 'inactive';
        }
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
