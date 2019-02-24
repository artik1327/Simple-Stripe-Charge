<?php

/**
 * Class Controller
 */
class Controller
{

    /**
     * Renders templates created in "views" folder
     *
     * @param string $view
     * @param array $data
     */
    public function renderView(string $view, $data = [])
    {
        require_once '../app/views/'. $view . '.php';
    }
}