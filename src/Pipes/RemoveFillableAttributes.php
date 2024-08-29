<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;

class RemoveFillableAttributes
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $this->replaceInFile->handle(
            <<<EOT

                /**
                 * The attributes that are mass assignable.
                 *
                 * @var array<int, string>
                 */
            EOT,
            '',
            app_path('Models/User.php'),
        );

        $contents = $this->filesystem->get(app_path('Models/User.php'));

        $contents = preg_replace('/protected \$fillable\s*=\s*\[[^\]]*\];\s*/m', '', $contents);

        $this->filesystem->put(app_path('Models/User.php'), $contents);

        return $next($data);
    }
}
