<?php

namespace Rendering\Views;

use Request\AppContainer;

abstract class View extends AppContainer
{

    public function run(): void
    {
    }

    abstract function getTemplate(): string;

}
