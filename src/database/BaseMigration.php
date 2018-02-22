<?php
namespace User\database;

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;
/**
 * Class Migration
 *
 * @package User\database\migrations
 */
class BaseMigration extends AbstractMigration
{

    /**
     * @var \Illuminate\Database\Schema\MySqlBuilder
     */
    protected $schema;

    protected function init()
    {
        $this->schema = (new Capsule)->schema();
    }

}