<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function up()
    {
        $users = $this->table('users');
        $users->addColumn('first_name', 'string', ['null' => true])
            ->addColumn('last_name', 'string', ['null' => true])
            ->addColumn('password', 'string')
            ->addColumn('email', 'string')
            ->save();
    }

    public function down()
    {
        $this->table('users')->drop()->save();
    }
}
