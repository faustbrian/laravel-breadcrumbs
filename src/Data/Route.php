<?php

declare(strict_types=1);

namespace BaseCodeOy\Breadcrumbs\Data;

final readonly class Route
{
    public function __construct(
        private string $name,
        private array $parameters,
    ) {
        //
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'parameters' => $this->parameters,
        ];
    }
}
