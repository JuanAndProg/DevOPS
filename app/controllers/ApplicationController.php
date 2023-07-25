<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */

// Not needed to require, autoloader set
class ApplicationController extends Controller
{
    // Empty method to get the Index page
    public function indexAction(): void
    {
    }
    /**
     * Method to go to the form  create a data
     */
    public function taskFormAction(): void
    {
    }
    /**
     * Method to createTask from the form data
     */
    public function savedTaskAction(): void // TODO: Need validations if the form is filled or not
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
    /**
     * Method to show the tasks using taskModel and the $view Controller property
     */
    public function showListAction(): void
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
        $data = TaskModel::readJson(TaskModel::$filePath);
        if (isset($_POST['deleteTaskId'])) {
            $taskIdToDelete = $_POST['deleteTaskId'];
            if (isset($data[$taskIdToDelete])) {
                // Remove the task from the array
                unset($data[$taskIdToDelete]);
                // Update the JSON file
                TaskModel::writeJson($data);
                // Redirect to the deletedTask page
                header("Location: http://localhost/DevOPS/web/deleted");
                exit;
            }
        }
    }
    public function updatedAction()
    {
    }
}
