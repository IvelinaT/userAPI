<?php

use User\database\BaseSeeder;
use User\Model\User;

class DataSeeder extends BaseSeeder
{
    protected $usersCount = 52;

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $this->factory->of(User::class)->times($this->usersCount)->create();
    }
}