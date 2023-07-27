<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
                  $table->integer('status')->after('sequence'); 
                $table->integer('createuserid')->nullable()->after('sequence');
                $table->integer('updateuserid')->nullable()->after('sequence');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
             $table->dropColum('status');
           $table->dropColum('createuserid');
           $table->dropColum('updateuserid');
        });
    }
};
