<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
