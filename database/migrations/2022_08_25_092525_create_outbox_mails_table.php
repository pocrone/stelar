<?php

use App\Models\Group;
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
        Schema::create('outbox_mails', function (Blueprint $table) {
            $table->id();
            $table->string('outboxmail_number');
            $table->string('file');
            $table->text('header');
            $table->string('attachment');
            $table->date('mail_date');
            $table->text('mail_about');
            $table->text('mail_destination');
            $table->text('greet_word');
            $table->text('preambule');
            $table->text('mail_detail');
            $table->text('closing_sentence');
            $table->text('mail_officer');
            $table->text('officer');
            $table->text('notation');
            $table->date('date_create');
            $table->tinyInteger('autograph_status');
            $table->integer('class_id');
            $table->string('save_location');
            $table->smallInteger('retention_status')->nullable();
            $table->integer('active_year')->nullable();
            $table->integer('inactive_year')->nullable();
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
        Schema::dropIfExists('outbox_mails');
    }
};
