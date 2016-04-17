<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    const TABLE = CreatePostsTable::MODEL.'_'.CreateTagsTable::MODEL; // Laravel Eloquent ORM expects lowercase model name in alphabetical order!
    const PK1 = CreatePostsTable::FK;
    const PK2 = CreateTagsTable::FK;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            // Primary Key
            $table->unsignedInteger(self::PK1);
            $table->unsignedInteger(self::PK2);
            $table->primary([self::PK1, self::PK2]); // Composite Key.

            // Foreign Keys
            $table->foreign(CreatePostsTable::FK)
                ->references(CreatePostsTable::PK)
                ->on(CreatePostsTable::TABLE)
                ->onDelete('cascade');
            $table->foreign(CreateTagsTable::FK)
                ->references(CreateTagsTable::PK)
                ->on(CreateTagsTable::TABLE)
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(self::TABLE);
    }
}
