<?php

use App\Models\Classification;
use App\Models\Group;
use App\Models\MailConcept;
use App\Models\User;
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
            $table->string('main_institution');
            $table->string('name_institution');
            $table->string('phone_institution');
            $table->string('email_institution');
            $table->string('address_institution');
            $table->string('file');
            $table->string('logo')->nullable();

            $table->string('outboxmail_number');
            $table->string('attachment');
            $table->date('mail_date');
            $table->text('mail_about');

            $table->text('mail_recevier');
            $table->text('mail_destination');
            $table->text('city_destination');


            $table->text('preambule');
            $table->text('mail_detail');
            $table->text('closing_sentence');

            $table->text('mail_officer');
            $table->text('officer');
            $table->text('identity_number')->nullable();
            $table->text('notation');

            $table->date('date_create');
            $table->tinyInteger('autograph_status');
            $table->integer('class_id');
            $table->string('save_location')->nullable();
            $table->smallInteger('retention_status')->nullable();
            $table->integer('active_year')->nullable();
            $table->integer('inactive_year')->nullable();

            $table->foreignIdFor(Group::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(MailConcept::class);
            $table->foreignIdFor(Classification::class)->nullable();
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
