<?php


namespace Actions;


use Api\Action;
use Api\Response;

class Err404Action extends Action
{

    public function run(): void
    {
        $this->res
            ->setMessage('Not found!')
            ->setStatus(404);
    }
}
