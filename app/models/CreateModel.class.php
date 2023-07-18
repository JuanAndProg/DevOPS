<?php 
// Not needed to require, autoloader set
require_once ROOT_PATH .'\app\models\JsonManager.class.php';
require_once 'Task.php';

class CreateTaskModel extends JsonManager 
{
    // Method to SAVE a task in a Json file
    public static function saveTask(Task $task): void
    {
        // If Json doesn't exist, create it
        JsonManager::checkAndCreateJson();
        // Get the content from JSON file
        $tasks = JsonManager::readJson(); // Added $tasks before the =
        // Add a new task into the array
        $tasks[] = $task;
        // Convert back to JSON
        JsonManager::writeJson($tasks);
    }
}
?>