<?php

use App\Models\CompanyInfo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('satisfaction')->default(0);
            $table->integer('experience')->default(0);
            $table->integer('customers')->default(0);
            $table->integer('repaired')->default(0);

            $table->string('name');
            $table->string('email');
            $table->string('hotline');
            $table->string('whatsapp');
            $table->string('address');
            $table->string('shop_floor');
            $table->longText('map')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->longText('description');
            $table->string('logo')->default('default.jpg');
            $table->string('favicon')->default('default.jpg');
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
        Schema::dropIfExists('company_infos');
    }
}
