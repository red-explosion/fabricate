<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Data;

class InstallData
{
    public function __construct(
        public readonly string $name,
        public readonly string $vendor,
        public readonly ?string $description,
    ) {
    }
}
