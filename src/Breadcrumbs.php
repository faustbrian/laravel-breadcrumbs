<?php

declare(strict_types=1);

namespace BombenProdukt\Breadcrumbs;

use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Router;

final class Breadcrumbs
{
    /**
     * @var array<string, callable>
     */
    private array $callbacks = [];

    public function __construct(
        private readonly Generator $generator,
        private readonly Router $router,
        private readonly Factory $viewFactory,
    ) {
        //
    }

    public function for(string $name, callable $callback): void
    {
        $this->callbacks[$name] = $callback;
    }

    public function render(?string $name = null, array $parameters = [], string $view = 'full-width-bar'): string
    {
        return $this->renderWithView($name, $parameters, 'breadcrumbs::'.$view);
    }

    public function renderWithView(string $name, array $parameters, string $view): string
    {
        return $this->viewFactory->make($view, [
            'breadcrumbs' => $this->generate($name, $parameters),
        ])->render();
    }

    public function generate(?string $name = null, array $parameters = []): array
    {
        [$actualName, $actualParameters] = $this->getCurrentRoute($name, $parameters);

        return $this->generator->generate($this->callbacks, $actualName, $actualParameters);
    }

    private function getCurrentRoute(?string $name = null, array $parameters = []): array
    {
        if (!empty($name) && !empty($parameters)) {
            return [$name, $parameters];
        }

        $route = $this->router->current();

        return [$route->getName(), $route->parameters()];
    }
}
