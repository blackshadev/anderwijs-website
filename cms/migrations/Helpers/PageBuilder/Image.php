<?php

namespace Migrations\Helpers\PageBuilder;

use craft\base\VolumeInterface;
use craft\elements\Asset;
use craft\records\VolumeFolder;
use Migrations\Helpers\MatrixBlock;
use Webmozart\Assert\Assert;

class Image extends MatrixBlock
{
    private ?string $title = null;
    private ?string $volume = null;
    private string $image;
    private int $assetId;

    public static function create(?string $path = null): self
    {
        $image = new self();
        if($path) {
            $image->image = $path;
        }
        return $image;
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
        $volume = $this->resolveVolume();
        $folder = VolumeFolder::findOne([
            'parentId' => null,
            'name' => $volume->name,
            'volumeId' => $volume->id,
        ]);
        Assert::notNull($folder);

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

    protected function resolveVolume(): VolumeInterface
    {
        if ($this->volume != null) {
            $volume = \Craft::$app->volumes->getVolumeByHandle($this->volume);
        } else {
            $volume = \Craft::$app->volumes->getAllVolumes()[0] ?? null;
        }

        Assert::notNull($volume);

        return $volume;

    }
}
