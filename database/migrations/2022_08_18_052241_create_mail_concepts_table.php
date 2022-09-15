<?php

use App\Models\User;
use App\Models\Classroom;
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
        Schema::create('mail_concepts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->text('mail_concept');
            $table->date('date');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('mail_concepts');
    }
};
