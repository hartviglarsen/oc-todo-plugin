<?php namespace Hartviglarsen\Todo\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('hartviglarsen_todo_tasks', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('task');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hartviglarsen_todo_tasks');
    }
}
