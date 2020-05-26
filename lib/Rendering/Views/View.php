<?php

namespace Rendering\Views;

use Request\AppContainer;

abstract class View extends AppContainer
{

    final public function __construct()
    {
        parent::__construct();
    }

    public function run(): void
    {
    }

    abstract function getTemplate(): string;

}
