<?php

declare(strict_types=1);

namespace BombenProdukt\Breadcrumbs;

use BombenProdukt\Breadcrumbs\Data\Breadcrumb;

final class Generator
{
    /**
     * @var array<int, Breadcrumb>
     */
    private array $breadcrumbs = [];

    /**
     * @var array<string, callable>
     */
    private array $callbacks = [];

    public function generate(array $callbacks, string $name, array $parameters): array
    {
        $this->breadcrumbs = [];
        $this->callbacks = $callbacks;

        $this->call($name, $parameters);

        return $this->breadcrumbs;
    }

    public function parent(string $name, array $parameters = []): void
    {
        $this->call($name, $parameters);
    }

    public function push(string $name, ?string $href = null): void
    {
        $this->breadcrumbs[] = new Breadcrumb($name, $href);
    }

    private function call(string $name, array $parameters): void
    {
        $this->callbacks[$name]($this, ...$parameters);
    }
}
