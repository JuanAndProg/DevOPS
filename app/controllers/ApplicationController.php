<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */

// Not needed to require, autoloader set
class ApplicationController extends Controller 
{
    // Empty method to get the Index page  // TODO: Check the previous comment
    public function indexAction()
    {
    }
    public function taskFormAction()
    {
    }
    public function askFormAction()
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

        TaskModel::saveTask($task);
    }
   
    public function showListAction()
    {
        $taskModel = new TaskModel();
        $tasks = $taskModel->getAllTasks();

        // Pasamos los datos a la vista
        $this->view->tasks = $tasks;
        
    }

    public function viewTaskAction()
    {
    }
    
    public function editTaskAction()
    {
    }
    public function deletedTaskAction()
    {
    }
    public function updatedAction()
    {
    }
}
?>