<?php namespace Hartviglarsen\Todo\Models;

use Model;

/**
 * Task Model
 */
class Task extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'hartviglarsen_todo_tasks';

    /**
     * @var array Validation rules
     */
    public static $rules = [
        'task' => 'required|unique:hartviglarsen_todo_tasks'
    ];

    /**
     * @var array Validation error messages
     */
    public static $messages = [
        'required' => 'Write a task, will ya?',
        'unique' => 'You already have such a task'
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Hidden fields
     */
    protected $hidden = ['id','created_at', 'updated_at'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['task'];
}
