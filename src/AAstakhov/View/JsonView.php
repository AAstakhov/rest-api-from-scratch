<?php

namespace AAstakhov\View;

use AAstakhov\Interfaces\ViewInterface;
use AAstakhov\View\Exceptions\ViewException;

class JsonView implements ViewInterface
{
    /**
     * @inheritdoc
     */
    public function render(array $parameters)
    {
        if (!isset($parameters['record'])) {
            throw new ViewException('Unable to render json. The parameter record is missing.');
        }

        return json_encode($parameters['record']);
    }
}