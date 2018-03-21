<?php

/**
 * Class AdminController
 * Controller edit the website
 * @author staubrein <me@staubrein.com>
 */
class AdminController extends Controller
{
    /**
     *  Index Page for route: /page/
     * @todo Maybe Table od Contents?
     */
    function index()
	{
		$this->set("content", "Status OK");
	}

    /**
     *  Generates an Imprint Page
     *  uses address data stored in a json db
     */
    function imprint() {

    	$this->cache = TRUE;
    	$this->_cache = new Cache($this->_controller . '_' . $this->_action, ['page']); 	 

		$storage = new JSONStorage();
		$page_data = $storage->select("page", ["title" => "Imprint"]);

		$this->set("name", $page_data["name"]);
		$this->set("street", $page_data["street"]);
		$this->set("postalcode", $page_data["postalcode"]);
		$this->set("city", $page_data["city"]);
	}
}