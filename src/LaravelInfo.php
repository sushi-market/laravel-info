<?php

namespace DF\LaravelInfo;

use DF\LaravelInfo\Contracts\Section;

class LaravelInfo
{
    private array $sections = [];

    public function addSection(Section $section): static
    {
        $this->sections[] = $section;
        return $this;
    }

    public function sections(): array
    {
        $result = [];

        foreach ($this->sections as $section) {
            $data = array_filter($section->data(), fn($v) => $v !== null);
            if (!empty($data)) {
                $result[$section->title()] = $data;
            }
        }

        return $result;
    }
}
