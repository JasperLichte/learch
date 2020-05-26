<?php

namespace Models;

class ViewModel extends ResponseModel
{

    private $title = '';
    private $language = '';
    private $JsFiles = ['bundle.js'];
    private $path = '';

    public function __construct(string $path)
    {
        $this->language = 'en';
        $this->path = $path;
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

    public function setJsFiles(array $JsFiles): ViewModel
    {
        $this->JsFiles = $JsFiles;
        return $this;
    }

    public function getJsFiles(): array
    {
        return $this->JsFiles;
    }

    public function getPath(): string
    {
        return $this->path;
    }

}
