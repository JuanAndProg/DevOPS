<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */

// Not needed to require, autoloader set
require_once ROOT_PATH .'/app/models/CreateTaskModel.class.php';

class ApplicationController extends Controller 
{
    // Empty method to get the Index page  // TODO: Check the previous comment
    public function indexAction()
    {
    }
    public function taskFormAction()
    {
        
    }
    // Method to createTask

    // TODO: Need validations if the form is filled or not
    public function savedTaskAction(): void
    {
        // Get info from the taskForm by POST method
        $author      = $_POST["author"];
        $name        = $_POST["name"];
        $description = $_POST["description"];
        $status      = $_POST["status"];
        // Create a new instance of Task
        $task = new Task($author, $name, $description, $status);
        CreateTaskModel::saveTask($task);
    }
   // TODO: Redirect to a succes page or can be from the form page
   public function showListAction()
    {
    }
    public function viewTaskAction()
    {
    }
}
?>