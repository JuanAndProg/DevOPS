<?php

class TaskModel
{
    static array $tasks;

    // Method to create json file id doesn't exist
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
    // Read Json File and put it in an array
    static function getAllTasks()
    {
        self::checkAndCreateJson();
        $jsonContent = file_get_contents(self::$filePath);
        return json_decode($jsonContent, true);
    }
    /**
     * Method to read a given Json and return an array with the info in it
     * @param string $filePath The path to the JSON file.
     * @return array $data The associative array containing the data from the JSON file.
     */
    static function readJson(string $filePath): array
    {
        // Get the content from JSON file
        $jsonString = file_get_contents($filePath);
        // Convert Json content to an associative array
        $data = json_decode($jsonString, true);
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
     * @return Task|null returns an object Task or null if ID is not found 
     */
    static function getTaskById($taskId): ?Task
    {
        $tasks = self::readJson(self::$filePath);
        foreach ($tasks as $task) {
            if ($task['id'] == $taskId) {
                return $task;
            }
        }
        return null; // Return null if task with given ID is not found
    }
    /**
     * Save a Task in Json using the rest of the TaskModel methods
     * @param Task $task
     */
    static function saveTask(Task $task): void
    {
        // If Json doesn't exist, creates it
        TaskModel::checkAndCreateJson();
        // Get the content from JSON file
        $tasks = TaskModel::readJson(self::$filePath);
        // Add a new task into the array
        $tasks[] = $task;
        // Convert back to JSON
        TaskModel::writeJson($tasks);
    }
    /**
     * Deletes a given Task
     * @param int $taskId
     */
    public function deleteTask($taskId): void
    {
        $tasks = $this->getAllTasks();
        unset($tasks[$taskId]);
        $this->writeJson($tasks);
    }
}
?>