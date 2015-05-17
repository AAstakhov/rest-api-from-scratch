<?php

namespace AAstakhov\View;

use AAstakhov\Interfaces\ViewInterface;

class JsonView implements ViewInterface
{
    public function render(array $parameters)
    {
        return json_encode($parameters['record']);
    }
}