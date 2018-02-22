<?php
use Illuminate\Database\Schema\Blueprint;

class EloquentConnectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     *
     */
    public function testIlluminateConnection()
    {

        $settings = require __DIR__ . '../../../bootstrap/settings.php';
        $capsule = new \Illuminate\Database\Capsule\Manager;

        $capsule->addConnection($settings['db']);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();

        $capsule->schema()->create('test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });
        $capsule->table('test')->insert(
            [
                'name' => 'Ivelina'
            ]
        );
        $test = $capsule->table('test')->first();
        $this->assertNotEmpty($test);
        $capsule->schema()->drop('test');
    }
}