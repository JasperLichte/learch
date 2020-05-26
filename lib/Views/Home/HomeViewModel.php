<?php

namespace Views\Home;

use Files\BasicFileModel;
use Models\ViewModel;

class HomeViewModel extends ViewModel
{

    /**
     * @var BasicFileModel[]
     */
    private $files = [];

    public function getFiles(): array
    {
        return $this->files;
    }

    public function setFiles(array $files): void
    {
        $this->files = $files;
    }

}
