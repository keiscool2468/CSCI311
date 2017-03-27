<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views 
| when calling MY_Controller's render() function. 
| 
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'HongKong Scout',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => '',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),
	
	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'assets/dist/admin/adminlte.min.js',
			'assets/dist/admin/lib.min.js',
			'assets/dist/admin/app.min.js'
		),
		'foot'	=> array(
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/admin/adminlte.min.css',
			'assets/dist/admin/lib.min.css',
			'assets/dist/admin/app.min.css'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',
	
	// Multilingual settings
	'languages' => array(
	),

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
			'icon'		=> 'fa fa-home',
		),
		'panel' => array(
			'name'		=> 'Leader',
			'url'		=> 'panel',
			'icon'		=> 'fa fa-cog',
			'children'  => array(
				'Leader Managment'			=> 'panel/admin_user',
				'Create Members'			=> 'panel/admin_user_create',
				'Members Groups'			=> 'panel/admin_user_group',
			)
		),
		'panel2' => array(
			'name'		=> 'Scout',
			'url'		=> 'panel2',
			'icon'		=> 'fa fa-cog',
			'children'  => array(
				'Scouts Managment'			=> 'panel/scout_user',
				'Progressive Award'			=> 'award/scout_progressive',
				'My Progressive Award'		=> 'scout/my_award',
				'My Personal Particular'	=> 'scout/my_personal_particular',
				'My Proficiency Badges'		=> 'badge/my_badge',
			)
		),
		'logout' => array(
			'name'		=> 'Sign Out',
			'url'		=> 'panel/logout',
			'icon'		=> 'fa fa-sign-out',
		)
	),

	// Login page
	'login_url' => 'admin/login',

	// Restricted pages
	'page_auth' => array(
		'panel'								=> array('webmaster','Leader'),
		'panel/admin_user'					=> array('webmaster'),
		'panel/admin_user_create'			=> array('webmaster'),
		'panel/admin_user_group'			=> array('webmaster'),
		'award/scout_progressive'			=> array('webmaster','Leader'),
		'panel/scout_user'					=> array('webmaster','Leader'),
		'scout/my_award'					=> array('Scout','Sea Scout','Air Scout'),
		'scout/my_personal_particular'		=> array('Scout','Sea Scout','Air Scout'),
		'badge/my_badge'					=> array('Scout','Sea Scout','Air Scout'),
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'			=> 'skin-blue',
			'Leader'			=> 'skin-red',
			'Scout'				=> 'skin-green',
			'Sea Scout'			=> 'skin-green',
			'Air Scout'			=> 'skin-green',
		)
	),

	// Useful links to display at bottom of sidemenu
	'useful_links' => array(
		array(
			'auth'		=> array('webmaster', 'Leader','Scout','Sea Scout','Air Scout'),
			'name'		=> '童軍訓練綱要 (網上版)',
			'url'		=> 'http://prog.scouting.org.hk/scouts/ts/ts-web-c',
			'target'	=> '_blank',
			'color'		=> 'text-green'
		),
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_admin';