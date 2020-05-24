<?php

namespace Rendering;

use Models\ResponseModel;

class ViewRenderer extends Renderer
{

    public function render(): string
    {
        return $this->middleware->getTemplate();
    }

}
