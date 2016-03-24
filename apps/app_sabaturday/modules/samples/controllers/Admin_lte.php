<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_lte extends MY_Controller {

	public function index()
	{
		$this->load->view('admin_lte/index');
	}
}
