<?php

namespace Rendering;

use Actions\Files\ShowFileAction;
use Files\Exceptions\FileNotFoundException;

class FileRenderer extends Renderer
{

    public function render(): string
    {
        if (!($this->middleware instanceof ShowFileAction)) {
            return '';
        }

        try {
            $file = $this->middleware->getFile();
        } catch (FileNotFoundException $e) {
            return '';
        }

        header('Content-type: ' . $file->getMime());
        return $file->getData();
    }
}
