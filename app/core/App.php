<?php

/**
 * Class App
 */
class App
{
    /**
     * Default controller
     *
     * @var string
     */
    protected $controller = 'Payment';

    /**
     * Default Controller Action
     *
     * @var string
     */
    protected $method = 'index';

    /**
     * Parameters that are passed in Actions
     *
     * @var array
     */
    protected $params = [];

    /**
     * App constructor.
     */
    public function __construct()
    {
        $url = $this->parseUrl();

        // Checks if Controller exists
        if (file_exists('../app/controllers/'. ucfirst($url[0]) . '.php'))
        {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        // Requires existing controller or Default
        require_once '../app/controllers/' . ucfirst($this->controller) . '.php';
        // Creates Controller
        $this->controller = new $this->controller;

        // Checks if the method exists in controller opothervise calls Default one
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Checks if any params were passed
        $this->params = $url ? array_values($url) : [];

        // calls current route action
        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    /**
     * Created array from current path
     *
     * @return array
     */
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            return explode('/',filter_var($url, FILTER_SANITIZE_URL));
        }
    }
}