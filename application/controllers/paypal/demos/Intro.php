<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intro extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Helpers
		$this->load->helper('url');
	}

	/**
	 * Demo Intro
	 */
	function index()
	{
		// Load Intro Page
		$this->load->view('paypal/demos/intro');
	}

}
