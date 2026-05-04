<?php

namespace DF\LaravelInfo\Sections;

use DF\LaravelInfo\Contracts\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;

class ServicesSection implements Section
{
    public function title(): string
    {
        return 'Services';
    }

    public function data(): array
    {
        return [
            'Database' => $this->checkDb() ? 'true' : 'false',
            'Redis'    => $this->checkRedis() ? 'true' : 'false',
            'Horizon' => $this->getHorizonStatus(),
        ];
    }

    private function checkDb(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Throwable) {
            return false;
        }
    }

    private function checkRedis(): bool
    {
        try {
            return Redis::ping() !== false;
        } catch (\Throwable) {
            return false;
        }
    }

    private function getHorizonStatus(): ?string
    {
        if (!interface_exists(MasterSupervisorRepository::class)) {
            return null;
        }

        try {
            $masters = app(MasterSupervisorRepository::class)->all();
            return count($masters) > 0 ? 'true' : 'false';
        } catch (\Throwable) {
            return 'false';
        }
    }
}
