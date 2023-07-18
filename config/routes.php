<?php 

/**
 * delete test 
 * start working on application
 */
$routes = array(
	// TODO: Make the landing page app/views/scripts/application/index.phtml
	'/'			=> 'application#index',
	'/taskForm'	=> 'application#taskForm',
	'/showList'	=> 'application#showList',
	'/created'	=> 'application#createdTask',
	'/view'		=> 'application#viewTask',
	'/edit'		=> 'application#editTask',
	'/delete'	=>'application#deleteTask'
	
);
