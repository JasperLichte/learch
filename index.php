<?php

require_once 'autoload.php';

use routes\Router;

echo (new Router())
    ->get('/test', \actions\TestAction::class)
    ->get('/page/([0-9]*)', \actions\ParamTestAction::class)
    ->view('/([0-9]*)', \views\HelloWorldView::class)
    ->run();
