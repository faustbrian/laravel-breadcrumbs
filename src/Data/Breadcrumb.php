<?php

declare(strict_types=1);

namespace BaseCodeOy\Breadcrumbs\Data;

final readonly class Breadcrumb
{
    public function __construct(
        private string $name,
        private ?string $link,
    ) {
        //
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'link' => $this->link,
        ];
    }
}
