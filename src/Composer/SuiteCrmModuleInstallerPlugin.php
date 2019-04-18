<?php

namespace dolpox\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class SuiteCrmModuleInstallerPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new SuiteCrmModuleInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}
