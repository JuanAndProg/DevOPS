<?php 

/**
 * delete test 
 * start working on application
 */
$routes = array(
	// TODO: Make the landing page app/views/scripts/application/index.phtml
	'/'			=> 'application#index',
	'/home' 	=> 'application#showList',
	'/create'	=> 'application#createTask',
	'/view'		=> 'application#viewTask',
	'/edit'		=> 'application#editTask',
	'/delete'	=>'application#deleteTask'
	
);
