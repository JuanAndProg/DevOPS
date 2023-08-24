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
     * Method to go to the form to create a data
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

        // Sending data to the view
        $this->view->tasks = $tasks;
    }
    /**
     * Method to show the task using taskModel and the $view Controller property
     */
    public function viewTaskAction()
    {
        if (isset($_GET['taskId'])) {
            $taskId = $_GET['taskId'];
            $task = TaskModel::getTaskById($taskId);
            if ($task !== null) {

                // Sending data to the view
                $this->view->task = $task;

                if (isset($_POST['deleteConfirmed'])) {
                    // Remove the task from the array
                    TaskModel::deleteTask($taskId);

                    // Redirect to the deleted page
                    header("Location: http://localhost/DevOPS/web/deleted");
                    exit;
                }
            } else {
                echo '<p class="text-red-500">Task not found.</p>';
            }
        } else {
            echo '<p class="text-red-500">No task selected.</p>';
        }
    }
    /**
     * Method to edit a task using taskModel
     */
    public function editTaskAction()
    {
        $data = TaskModel::readJson(TaskModel::$filePath);
        // Check if taskId is in the URL
        if (isset($_GET['taskId'])) {
            // Get ID from the selected task
            $taskId = $_GET['taskId'];
            // Get the data of selected task from the tasks list
            $task = isset($data[$taskId]) ? $data[$taskId] : null;

            // Sending data to the view
            $this->view->task = $task;
        }
        if ($task) {

            // Check if the edition forms has been sent
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get info from the form
                $author = $_POST['author'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $status = $_POST['status'];

                // Get start date if present
                $startDate = isset($task['startDate']) ? $task['startDate'] : null;

                // Check if status changed to "finished" and update finish date
                if ($task && $task['status'] !== $status) {
                    if ($status === 'Finished') {
                        $endDate = date('Y-m-d'); // Current date
                    } else {
                        $endDate = null;
                    }
                } else {
                    $endDate = isset($task['endDate']) ? $task['endDate'] : null;
                }

                // Update info in selected task
                if ($task) {
                    $data[$taskId] = [
                        'author' => $author,
                        'name' => $name,
                        'description' => $description,
                        'status' => $status,
                        'startDate' => $startDate,
                        'endDate' => $endDate
                    ];
                    // Save changes in Json file
                    TaskModel::writeJson($data);
                    // Redirection to show list page trough updated page
                    header("Location: http://localhost/DevOPS/web/updated");
                    exit;
                }
            }
        } else {
            echo '<p class="text-red-500">No task found.</p>';
            exit;
        }
    }
    /**
     * Method to edit a task using taskModel
     */
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