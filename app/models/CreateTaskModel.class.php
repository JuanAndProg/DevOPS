<?php 
// Not needed to require, autoloader set
require_once 'JsonManager.php';
require_once 'Task.php';

class CreateTaskModel extends JsonManager 
{
    // Method to SAVE a task in a Json file
    public function saveTask(Task $task): void
    {
        // If Json doesn't exist, create it
        JsonManager::checkAndCreateJson();
        // Get the content from JSON file
        JsonManager::readJson();
        // Add a new task into the array
        $tasks[] = $task;
        // Convert back to JSON
        JsonManager::writeJson($tasks);
    }
}
?>