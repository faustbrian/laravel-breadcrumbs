<?php

declare(strict_types=1);

namespace BombenProdukt\Breadcrumbs;

final class Breadcrumbs
{
    /**
     * @var array<string, callable>
     */
    private array $callbacks = [];

    public function __construct(
        private readonly Generator $generator,
    ) {
        //
    }

    public function for(string $name, callable $callback): void
    {
        $this->callbacks[$name] = $callback;
    }

    public function render(string $name, array $parameters = [], string $view = 'full-width-bar')
    {
        return $this->renderWithView($name, $parameters, 'breadcrumbs::'.$view);
    }

    public function renderWithView(string $name, array $parameters, string $view)
    {
        return view($view, [
            'breadcrumbs' => $this->generate($name, $parameters),
        ])->render();
    }

    public function generate(string $name, array $parameters = [])
    {
        return $this->generator->generate($this->callbacks, $name, $parameters);
    }
}
