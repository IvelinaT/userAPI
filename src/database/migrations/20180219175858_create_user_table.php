<?php


use Illuminate\Database\Schema\Blueprint;
use User\database\BaseMigration;

class CreateUserTable extends BaseMigration
{
    public function up()
    {
        $this->schema->create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('forename',255);
            $table->string('surname',255);
            $table->string('email',255)->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

        });



    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('user');
    }
}
