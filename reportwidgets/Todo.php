<?php 
namespace Hartviglarsen\Todo\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Hartviglarsen\Todo\Models\Task;
use Exception;
use Flash;
use Validator;

class Todo extends ReportWidgetBase
{
    /**
     * @inheritDoc
     */
    public function render()
    {
        try {
            $tasks = $this->loadData();
            $this->vars['tasks'] = $tasks;
        }
        catch (Exception $e) {
            $this->vars['error'] = $e->getMessage();
        }

        return $this->makePartial('widget');
    }

    /**
     * @inheritDoc
     */
    protected function loadAssets()
    {
        $this->addCss('style.css');
    }

    /**
     * Returns an array of tasks from the databse
     * 
     * @return array 
     * @access protected
     */
    protected function loadData()
    {
        if (!$tasks = Task::all()->toArray()) {
            throw new Exception('Could not get tasks from database');
        }

        return $tasks;
    }

    /**
     * AJAX event handler for creating a new task
     * 
     * @return void
     * @access public
     */
    public function onAdd()
    {
        $tasks   = post('tasks', []);
        $newTask = post('task');

        if ($this->store($newTask)) {
            $tasks[]['task'] = $newTask;
        }

        $this->vars['tasks'] = $tasks;
    }

    /**
     * AJAX event handler for deleting a specific task
     * 
     * @return void
     * @access public
     */
    public function onDelete()
    {
        $task = post('task');

        if (!Task::where('task', $task)->delete()) {
            Flash::error(sprintf(
                'Couldn\'t delete task: %s ', $task
            ));
        }

        Flash::success(sprintf(
            'Successfully deleted task: %s ', $task
        ));
    }

    /**
     * Store a newly created task
     * 
     * @return bool
     * @param string $task Task to store
     * @access protected
     */
    protected function store($task)
    {
        $validator = Validator::make(
            ['task' => $task],
            Task::$rules,
            Task::$messages
        );

        if ($validator->fails()) {
            Flash::error($validator->messages()->first('task'));
            return;
        } 

        Task::create(['task' => $task]);
        return true;
    }
}
