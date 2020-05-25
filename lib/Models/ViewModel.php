<?php

namespace Models;

class ViewModel extends ResponseModel
{

    private $title = '';

    private $language = '';

    public function __construct()
    {
        $this->language = 'en';
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

}
