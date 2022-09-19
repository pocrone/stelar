<?php

use App\Models\OutboxMail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_corrections', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OutboxMail::class);
            $table->date('date');
            $table->tinyInteger('status_koreksi');
            $table->string('isi_koreksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_corrections');
    }
};
