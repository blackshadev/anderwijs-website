<?php

namespace Blox;
use Blox\BlockManager\BlockManagerInterface;
use Craft;

class Module extends \yii\base\Module
{
    /**
     * Initializes the module.
     */
    public function init()
    {
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
        if (!$blockManager instanceof BlockManagerInterface) {
            throw new \UnexpectedValueException("Expected $file to return a " . BlockManagerInterface::class);
        }

        Craft::$container->set($name, function ($container, $params, $config) use ($blockManager) {
            return $blockManager;
        });

        $this->set($name, function ($container, $params, $config) use ($blockManager) {
            return $blockManager;
        });
    }
}
