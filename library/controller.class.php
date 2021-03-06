<?php

/**
 * Class Controller
 * Abstract controller class with main functionality for all controllers.
 */
class Controller
{

    protected $controller;
    protected $action;
    protected $model;
    protected $view;
    protected $cache;

    /**
     * @var bool Specifies if the view should be rendered without header (std. false)
     */
    public $doNotRenderHeader;

    /**
     * @var bool Specifies if the view should be rendered. (std. true)
     */
    public $render;

    public $caching;

    /**
     * Controller constructor.
     * Generates the Controller
     * doNotRenderHeader FALSE,
     * render TRUE
     * @param $controller
     * @param $action
     */
    function __construct($controller, $action)
	{
		$this->controller = $controller;
		$this->action = $action;
		
		$this->doNotRenderHeader = FALSE;
		$this->render = TRUE;
		
		$this->view = new View($controller, $action);
	}

    /**
     * Export variables to the view
     * @example set('content', $some_text); generates a Variable named $content accessible in the view
     * @param string $name of the variable
     * @param mixed $value of the variable
     */
    function set($name, $value) {
		
		$this->view->set($name, $value);
	}

    /**
     * Destructor renders the view automatically
     */
    function __destruct() {
		
		if($this->render) {

            if($this->caching) {

               if(!$this->cache->render()) {

                    $content = $this->view->render($this->doNotRenderHeader, true);
                    $this->cache->generate($content);
                }
                return;
            }
            $this->view->render($this->doNotRenderHeader);
        }
	}
}
