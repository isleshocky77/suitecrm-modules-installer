<?php

namespace dolpox\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;

class SuiteCrmModuleInstaller extends LibraryInstaller
{
    protected static $installableAssets = [
        'custom',
        'modules',
        'Api',
        'lib',
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

            $assetInVendor = $this->getVendorDirForAsset($package, $asset);
            $assetInInstallation = $this->getInstallationDirForAsset($asset);

            if (!$filesystem->exists($assetInVendor)) {
                continue;
            }

            $this->io->write(sprintf('Mirroring from "%s" to "%s"', $assetInVendor, $assetInInstallation));
            $filesystem->mirror($assetInVendor, $assetInInstallation);
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
