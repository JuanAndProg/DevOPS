<?php 

/**
 * delete test 
 * start working on application
 */
$routes = array(
	'/home' => 'application#showList',
	'/create'=> 'application#createTask',
	'/view'=> 'application#viewTask',
	'/edit'=> 'application#editTask',
	'/delete'=>'application#deleteTask'
	
);
