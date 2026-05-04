<?php

namespace DF\LaravelInfo\Contracts;

interface Section
{
    public function title(): string;

    public function data(): array;
}
