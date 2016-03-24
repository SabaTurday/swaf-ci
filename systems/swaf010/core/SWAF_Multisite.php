<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SWAF_Multisite {

	var $_domain = null;
	var $_multisite_prefix = array();

	function __construct(){
		$this->get_http_host();
	}

	function set_site_prefix($values = array()){
		$this->_multisite_prefix = array($this->get_http_host());
		if (count($values) >0) {
			$this->_multisite_prefix = $values;
		}

		//if (!defined('MULTISITE_SITE_PREFIX')){
        //	define('MULTISITE_SITE_PREFIX', $this->_multisite_prefix);
		//}
	}

	function set_multisite_path($value){
		$_multisite_path = $value;
		if (!is_dir($_multisite_path)){
			die('SWAF_ERROR:: Invalid Multisite Path');
		}

		if (!defined('MULTISITE_PATH')){
        	define('MULTISITE_PATH', $_multisite_path);
		}
	}

	function get_http_host(){
		$_http_host = $_SERVER['HTTP_HOST'];
		if (strpos($_http_host, ':')) {
	        $_tmp = explode(':', $_http_host);
	        $_http_host = $_tmp[0];
	    }

	    $this->_domain = $_http_host;

	    if (!defined('MULTISITE_DOMAIN')) {
	        define('MULTISITE_DOMAIN', $this->_domain);
	    }

	    return $this->_domain;
	}

	function get_config_file($config) {
	    
	    $_domain = $this->_domain;

	    $_tmp = explode('.', $_domain);
	    $_site = $_tmp[0];
	    if (in_array($_site, $this->_multisite_prefix, true)) {
	        $_site = 'default';
	    }
	    $_main_domain = str_replace($_site . '.', '', $_domain);
	    
	    if (!defined('MULTISITE_MAIN_DOMAIN')) {
	        define('MULTISITE_MAIN_DOMAIN', $_main_domain);
	    }
	    if (!defined('MULTISITE_SITE_DOMAIN')) {
	        define('MULTISITE_SITE_DOMAIN', $_site);
	    }

	    $_config_file = MULTISITE_PATH . $_main_domain . '/' . $_site . '/config/' . $config . '.php';

	    if (!file_exists($_config_file) and ($config != 'config')) {
	        $_config_file = MULTISITE_PATH . 'all/config/' . $config . '.php';
	    }
	    
	    if (!file_exists($_config_file) and ($config == 'config')){
	        die ("SWAF_ERROR:: Unknown domain/site: ".$_domain);
	    }

	    return $_config_file;
	}

}