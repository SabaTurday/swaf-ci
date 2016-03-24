<?php defined('BASEPATH') OR exit('No direct script access allowed');

global $_SWAF_Multisite;

$_site_config = $_SWAF_Multisite->get_config_file('user_agents');

include_once($_site_config);