<?php 
// Not needed to require, autoloader set
require_once 'Task.php';
abstract class JsonManager
{
    static array $tasks;
    
    // Method to create json file id doesn't exist
    // Path to json file using  global ROOT_PATH set in index.php

    /* Forma usando ROOT_PATH
    protected string $filePath = ROOT_PATH . '/app/data/tasks.json'; 
    Parche para poder seguir:*/
    static string $filePath = 
    "C:/Users/User/OneDrive/Escritorio/FS-PHP/DevOPS/app/models/data/tasks.json";


    
    
    static function checkAndCreateJson(): void
    {
        if (!file_exists(self::$filePath)) {   
            // Create file and set an empty array inside
            file_put_contents(self::$filePath,[]);
        }
    }
    // Read Json File and put it in an array
    
    static function readJson() : array {
        // Get the content from JSON file
        $jsonString = file_get_contents(self::$filePath);
        // Convert Json content to an associative array
        $data = json_decode($jsonString, true);
        // Return an empty array if decoding fails or the JSON is empty
        return $data ? : [];
    }
    // Write back in Json file

    static function writeJson($tasks) : void {
        // Convert back to JSON
        $jsonData = json_encode($tasks, JSON_PRETTY_PRINT);
        // Save back to the JSON file
        file_put_contents(self::$filePath, $jsonData);
    }
    // Iterate $tasks looking for the task by its Id
    static function getTaskById($taskId) : Task {
        $tasks = self::readJson();
        foreach ($tasks as $task) {
            if ($task->getId() == $taskId) {
                // Update task info
                return $task;
            }
        }
    }
}
?>