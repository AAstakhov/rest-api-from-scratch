<?php

namespace AAstakhov\Interfaces;

interface ViewInterface
{
    /**
     * Renders the view to the string
     *
     * @param array $parameters
     * @return string
     */
    public function render(array $parameters);
}