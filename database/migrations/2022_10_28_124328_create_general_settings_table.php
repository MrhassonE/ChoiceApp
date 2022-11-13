<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->longText('policy')->nullable();
            $table->longText('conditions')->nullable();
            $table->boolean('notification')->default(0);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('android_app')->nullable();
            $table->string('ios_app')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
