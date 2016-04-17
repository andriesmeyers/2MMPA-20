<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    const MODEL = 'post';
    const TABLE = self::MODEL.'s';
    const PK = 'id';
    const FK = self::MODEL.'_'.self::PK;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            // Primary Key
            $table->increments(self::PK);

            // Foreign Keys
            $table->unsignedInteger(CreateCategoriesTable::FK);
            $table->foreign(CreateCategoriesTable::FK) // CreateCategoriesTable::FK = category_id
            ->references(CreateCategoriesTable::PK)
                ->on(CreateCategoriesTable::TABLE)
                ->onDelete('cascade'); //cascade -> deze rij wordt ook verwijderd.

            $table->unsignedInteger(CreateUsersTable::FK);
            $table->foreign(CreateUsersTable::FK)
                ->references(CreateUsersTable::PK)
                ->on(CreateUsersTable::TABLE)
                ->onDelete('cascade');

            // Data
            $table->string('title');
            $table->text('content');

            // Meta Data
            $table->timestamps(); // 'created_at', 'updated_at'
            $table->softDeletes(); // 'deleted_at'
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
