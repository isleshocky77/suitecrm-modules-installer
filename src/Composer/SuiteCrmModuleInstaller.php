<?php

namespace isleshocky77\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;

class SuiteCrmModuleInstaller extends LibraryInstaller
{
    protected static $installableAssets = [
        'custom',
        'modules',
    ];

    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::install($repo, $package);

        $this->installModule($package);
    }

    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        parent::update($repo, $initial, $target);

        $this->installModule($target);
    }

    public function installModule(PackageInterface $package)
    {
        $filesystem = new Filesystem();

        foreach (self::$installableAssets as $asset) {
            if (!$filesystem->exists($this->getVendorDirForAsset($package, $asset))) {
                continue;
            }

            $filesystem->mirror($this->getVendorDirForAsset($package, $asset), $this->getInstallationDirForAsset($asset));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'suitecrm-module' === $packageType;
    }

    protected function getInstallationDirForAsset($asset)
    {
        return realpath($asset);
    }

    protected function getVendorDirForAsset(PackageInterface $package, $asset)
    {
        return sprintf('%s/%s', $this->getInstallPath($package), $asset);
    }
}
