<?php
// Not needed to require, autoloader set
require_once ROOT_PATH . '\app\models\JsonManager.class.php';
require_once 'Task.php';

class ViewTaskModel extends JsonManager
{
    // Method to get a task by its name
    public static function viewTask(string $name): array
    {
        // Get tasks from json
        $tasks = JsonManager::readJson();
        //Look in Json for that task name and give the task who has it
        foreach ($tasks as $task) {
            if ($task["name"] === $name) {
                return $task;
            }
        }
    }
    public static function getNames(array $tasks): array
    {
        foreach ($tasks as $task) {
            $taskNames[] = $task["name"];
            return $taskNames;
        }
    }
    public function getTaskName(array $taskNames): string
    {
        // Get tasks from json
        $tasks = JsonManager::readJson();
        // Keep task names in $taskNames
        $taskNames = $this->getNames($tasks);
        foreach ($tasks as $task) {
            return $task["name"];
        }
    }
}
