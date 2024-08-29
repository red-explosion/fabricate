<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;

class ConfigureTestingDatabase
{
    public function __construct(
        protected readonly Filesystem $filesystem,
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $this->filesystem->move(
            base_path('phpunit.xml'),
            base_path('phpunit.xml.dist'),
        );

        $this->replaceInFile->handle(
            <<<EOT
                    <!-- <env name="DB_CONNECTION" value="sqlite"/> -->
                    <!-- <env name="DB_DATABASE" value=":memory:"/> -->
            EOT,
            <<<EOT
                    <env name="DB_DATABASE" value="testing"/>
            EOT,
            base_path('phpunit.xml.dist'),
        );

        return $next($data);
    }
}

