<?php

class TaskModel
{
    static array $tasks;
    
    // Path to json file using  global ROOT_PATH set in index.php
    static string $filePath = ROOT_PATH . '/app/models/data/tasks.json';

    // Check if json exists, if not create data/ and put tasks.json in
    static function checkAndCreateJson(): void
    {
        if (!file_exists(self::$filePath)) {
            // Create the data directory
            mkdir(ROOT_PATH . "/app/models/data/");
            // Create file and set an empty array inside
            file_put_contents(self::$filePath, []);
        }
    }
    /**
     * Method to read a given Json and return an array with the info in it
     * @param string $filePath The path to the JSON file.
     * @return array $data The associative array containing the data from the JSON file.
     */
    static function getAllTasks()
    {
        self::checkAndCreateJson();
        // Get the content from JSON file
        $jsonContent = file_get_contents(self::$filePath);
        // Convert Json content to an associative array
        $data = json_decode($jsonContent, true);
        // Return an empty array if decoding fails or the JSON is empty
        return $data ?: [];
    }
    /**
     * Method to Write back in Json file
     * @param array $tasks The associative array containing the data
     */
    static function writeJson($tasks): void
    {
        // Convert back to JSON
        $jsonData = json_encode($tasks, JSON_PRETTY_PRINT);
        // Save back to the JSON file
        file_put_contents(self::$filePath, $jsonData);
    }
    /**
     * Iterate $tasks looking for the task by its Id
     * @param int $taskId 
     * @return array|null returns an array with the task or null if ID is not found 
     */
    static function getTaskById($taskId): ?array
    {
        $tasks = self::getAllTasks();
        if (isset($tasks[$taskId])) {
            return $tasks[$taskId];
        }
        return null; // Return null if task with given ID is not found
    }
    /**
     * Save a Task in Json using the rest of the TaskModel methods
     * @param array $task
     */
    static function saveTask(array $task): void
    {
        // If Json doesn't exist, creates it
        TaskModel::checkAndCreateJson();
        // Get the content from JSON file
        $tasks = TaskModel::getAllTasks();
        // Add a new task into the array
        $tasks[] = $task;
        // Convert back to JSON
        TaskModel::writeJson($tasks);
    }
    /**
     * Updates a given Task
     * @param int $taskId | 
     * @param array $updatedData
     */
    static function updateTask(int $taskId, array $updatedData): void
    {
        $tasks = TaskModel::getAllTasks();

        if (isset($tasks[$taskId])) {
            // Merge updated data with existing task data
            $updatedTask = array_merge($tasks[$taskId], $updatedData);
            $tasks[$taskId] = $updatedTask;
            TaskModel::writeJson($tasks);
        }
    }
    /**
     * Deletes a given Task
     * @param int $taskId
     */
    static function deleteTask(int $taskId): void
    {
        $tasks = TaskModel::getAllTasks();
        unset($tasks[$taskId]);
        TaskModel::writeJson($tasks);
    }
}
