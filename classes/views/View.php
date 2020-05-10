<?php

namespace views;

use request\AppContainer;

abstract class View extends AppContainer
{

    abstract public function render(): string;

}
