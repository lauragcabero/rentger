<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Picture
{
    public function __construct(
        private int $id,
        private String $url,
        private String $quality,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getQuality(): string
    {
        return $this->quality;
    }
}
