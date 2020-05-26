<?php

namespace Rendering;

use Api\Action;
use Api\Response;

class ActionRenderer extends Renderer
{

    public function render(): string
    {
        if (!($this->middleware instanceof Action)) {
            return '';
        }
        $this->middleware->redirectIfExpected();

        $model = $this->middleware->getModel();
        if (!($model instanceof Response)) {
            return '';
        }

        $retVals = [
            'status' => $model->getStatus(),
        ];
        if (!empty($model->getMessage())) {
            $retVals['message'] = $model->getMessage();
        }
        if (!empty($model->getData())) {
            $retVals['data'] = $model->getData();
        }

        header('Content-Type: application/json');
        http_response_code($model->getStatus());
        return json_encode($retVals);
    }

}
