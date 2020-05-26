<?php

namespace Actions\Files;

use Api\Action;
use Files\Exceptions\FileNotFoundException;
use Files\File;

class ShowFileAction extends Action
{

    /** @var int */
    private $id;

    public function run(): void
    {
        $this->id = (int)$this->req->getQueryStringParams()[0] ?? 0;
    }

    /**
     * @return File
     * @throws FileNotFoundException
     */
    public function getFile(): File
    {
        $file = File::load($this->db, $this->id);

        if ($file === null) {
            throw new FileNotFoundException();
        }

        return $file;
    }

}
