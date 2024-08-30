<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Actions;

use Symfony\Component\Process\Process;

class RequireComposerPackagesAction
{
    /**
     * @param  array<int, string>  $packages
     */
    public function handle(array $packages, bool $asDev = false): bool
    {
        $command = array_merge(
            ['composer', 'require'],
            $packages,
            $asDev ? ['--dev'] : [],
        );

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run() === 0; // TODO: log the output
    }
}
