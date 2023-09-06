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

        // Create an array to represent a task

        $task = [
            'author' => $author,
            'name' => $name,
            'description' => $description,
            'status' => $status,
            'startDate' => date('Y-m-d'),
            'endDate' => null
        ];

        TaskModel::saveTask($task);
    }
    /**
     * Method to show the tasks using taskModel and the $view Controller property
     */
    public function showListAction(): void
    {
        $tasks = TaskModel::getAllTasks();

        $tasksPerPage = 4;
        $totalTasks = count($tasks);
        $totalPages = ceil($totalTasks / $tasksPerPage);

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($currentPage - 1) * $tasksPerPage;
        // $end = $start + $tasksPerPage;
        $pagedTasks = array_intersect_key($tasks, array_flip(array_slice(array_keys($tasks), $start, $tasksPerPage)));

        // Sending data to the view
        $this->view->pagedTasks = $pagedTasks;
        $this->view->totalTasks = $totalTasks;
        $this->view->totalPages = $totalPages;
        $this->view->currentPage = $currentPage;
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

                $this->view->task = $task; // Sending data to the view
                $this->view->taskId = $taskId; // Pass the taskId to the view

                if (isset($_POST['deleteConfirmed'])) {
                    // Remove the task from the array
                    TaskModel::deleteTask($taskId);
                    // Redirect to the deleted page
                    header("Location: " . $this->view->baseUrl() . '/deleted');
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
        // Check if taskId is in the URL
        if (isset($_GET['taskId'])) {
            // Get ID from the selected task
            $taskId = $_GET['taskId'];
            // Get the data of selected task from the tasks list
            $task = TaskModel::getTaskById($taskId);
            if ($task !== null) {

                $this->view->task = $task; // Sending data to the view
                $this->view->taskId = $taskId; // Pass the taskId to the view

                if (isset($_POST['updateTask'])) {
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
                    $updatedTaskData = [
                        'author' => $author,
                        'name' => $name,
                        'description' => $description,
                        'status' => $status,
                        'startDate' => $startDate,
                        'endDate' => $endDate
                    ];
                    TaskModel::updateTask($taskId, $updatedTaskData);

                    // Redirect to the updated page
                    header("Location: " . $this->view->baseUrl() . '/updated');
                    exit;
                }
            } else {
                echo '<p class="text-red-500">Task not found.</p>';
                exit;
            }
        } else {
            echo '<p class="text-red-500">No task selected.</p>';
        }
    }

    /**
     * Method to delete a task using taskModel
     */
    public function deletedTaskAction()
    {
        if (isset($_POST['deleteTaskId'])) {
            $taskIdToDelete = $_POST['deleteTaskId'];
            TaskModel::deleteTask($taskIdToDelete);

            // Redirect to the deletedTask page
            header("Location: " . $this->view->baseUrl() . '/deleted');
            exit;
        }
    }
    public function updatedAction()
    {
    }
}
