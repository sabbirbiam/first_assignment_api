<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewCloumnStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            //
            $table->integer('blocked')->after('story');
            $table->string('storycaption')->nullable()->after('story');
            $table->string('storyimage')->nullable()->after('story');
            $table->string('section')->nullable()->after('story');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            //
            $table->dropColumn('blocked');
            $table->dropColumn('storycaption');
            $table->dropColumn('storyimage');
            $table->dropColumn('section');

        });
    }
}
