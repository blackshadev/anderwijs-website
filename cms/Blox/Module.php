<?php

namespace Blox;
use Blox\BlockManager\BlockMangerInterface;
use Craft;

class Module extends \yii\base\Module
{
    /**
     * Initializes the module.
     */
    public function init()
    {
        // Set a @modules alias pointed to the modules/ directory
        Craft::setAlias('@Blox', __DIR__);
        $this->registerBundleDirectory(__DIR__ . '/Bundles/');

        parent::init();
    }

    private function registerBundleDirectory(string $dir): void
    {
        $files =  new \DirectoryIterator($dir);
        foreach($files as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isDir()) {
                $this->registerBundleDirectory($file->getPathname());
                continue;
            }

            if ($file->getExtension() === "php") {
                $this->registerBundle($file->getBasename('.php'), $file->getPathname());
            }
        }
    }

    private function registerBundle(string $name, string $file)
    {
        $blockManager = require $file;
        if (!$blockManager instanceof BlockMangerInterface) {
            throw new \UnexpectedValueException("Expected $file to return a " . BlockMangerInterface::class);
        }

        Craft::$container->set($name, function ($container, $params, $config) use ($blockManager) {
            return $blockManager;
        });
    }
}
