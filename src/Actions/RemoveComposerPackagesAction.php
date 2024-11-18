<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Actions;

use Symfony\Component\Process\Process;

class RemoveComposerPackagesAction
{
    /**
     * @param  array<int, string>  $packages
     */
    public function handle(array $packages, bool $asDev = false): bool
    {
        $command = array_merge(
            ['composer', 'remove'],
            $packages,
            $asDev ? ['--dev'] : [],
        );

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run() === 0;
    }
}
