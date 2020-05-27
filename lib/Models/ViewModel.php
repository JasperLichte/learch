<?php

namespace Models;

use Config\EnvNotSetException;
use Util\Url;

class ViewModel extends ResponseModel
{

    private $title = '';
    private $language = '';
    private $path = '';
    /** @var Url[] */
    private $jsFiles = [];
    /** @var Url[] */
    private $cssFiles = [];

    public function __construct(string $path)
    {
        $this->language = 'en';
        $this->path = $path;
        try {
            $this->addJsFile(Url::to('/public/js/bundle.js'));
        } catch (EnvNotSetException $e) {
        }
    }

    public function setTitle(string $title): ViewModel
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function addJsFile(Url $jsFile): ViewModel
    {
        $this->jsFiles[] = $jsFile;
        return $this;
    }

    public function getJsFiles(): array
    {
        return $this->jsFiles;
    }

    public function getCssFiles(): array
    {
        return $this->cssFiles;
    }

    public function addCssFile(Url $cssFile): ViewModel
    {
        $this->cssFiles[] = $cssFile;
        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

}
