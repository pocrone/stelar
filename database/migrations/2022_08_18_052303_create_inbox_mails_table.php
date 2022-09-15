<?php

use App\Models\Group;
use App\Models\Classroom;
use App\Models\Classification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbox_mails', function (Blueprint $table) {
            $table->id();
            $table->string('mail_number');
            $table->date('date');
            $table->time('time');
            $table->string('sender');
            $table->string('mail_attribute');
            $table->text('mail_about');
            $table->text('mail_summary');
            $table->smallInteger('status');
            $table->string('mail_location')->nullable();
            $table->foreignIdFor(Classification::class)->nullable();
            $table->string('file')->nullable();
            $table->smallInteger('retention_status')->nullable();
            $table->integer('active_year')->nullable();
            $table->integer('inactive_year')->nullable();
            $table->foreignIdFor(Classroom::class);
            $table->foreignIdFor(Group::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inbox_mails');
    }
};
