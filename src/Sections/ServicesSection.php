<?php

namespace DF\LaravelInfo\Sections;

use DF\LaravelInfo\Contracts\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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
}
