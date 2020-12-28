<?php

namespace Migrations\Helpers\PageBuilder;

use craft\elements\Asset;
use craft\records\VolumeFolder;
use Migrations\Helpers\MatrixBlock;

class Image extends MatrixBlock
{
    private string $title;
    private string $image;
    private string $volume;
    private int $assetId;

    public static function create(): self
    {
        return new self();
    }

    public function type(): string
    {
        return 'image';
    }

    public function fields(): array
    {
        return [
            'image' => [$this->assetId]
        ];
    }

    public function setTitle(string $title): Image
    {
        $this->title = $title;
        return $this;
    }

    public function setImage(string $image): Image
    {
        $this->image = $image;
        return $this;
    }

    public function setVolume(string $volume): Image
    {
        $this->volume = $volume;
        return $this;
    }

    public function beforeLoad(): void
    {
        $volume = \Craft::$app->volumes->getVolumeByHandle($this->volume);
        $folder = VolumeFolder::findOne([
            'parentId' => null,
            'name' => $volume->name,
            'volumeId' => $volume->id,
        ]);

        $dest = \Craft::$app->getPath()->getStoragePath() . '/runtime/temp/' . $this->image;
        $src = __DIR__ . '/Images/' . $this->image;
        copy($src, $dest);

        $asset = new Asset();
        $asset->volumeId = $volume->id;
        $asset->folderId = $folder->id;
        $asset->filename = $this->image;
        $asset->title = $this->title;
        $asset->tempFilePath = $dest;


        \Craft::$app->elements->saveElement($asset);

        $this->assetId = $asset->id;
    }
}
