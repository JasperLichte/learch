<?php

namespace Rendering\Views;

use Api\Response;
use Models\ResponseModel;
use Models\ViewModel;
use Request\AppContainer;

abstract class View extends AppContainer
{

    public function run(): void
    {
    }

    abstract function getTemplate(): string;

}
