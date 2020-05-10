<?php

namespace views;

class HelloWorldView extends View
{

    public function render(): string
    {
        return '<h1>Hello World</h1>';
    }

}
