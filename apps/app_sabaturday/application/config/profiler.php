<?php defined('BASEPATH') OR exit('No direct script access allowed');

global $_SWAF_Multisite;

$_site_config = $_SWAF_Multisite->get_config_file('profiler');

include_once($_site_config);