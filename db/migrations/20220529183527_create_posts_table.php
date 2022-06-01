<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

class CreatePostsTable extends AbstractMigration
{
    public function up()
    {
        $users = $this->table('posts');
        $users->addColumn('title', 'string', ['null' => true])
            ->addColumn('description', 'string', ['null' => true])
            ->addColumn('image_id', 'integer')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }

    public function down()
    {
        $this->table('posts')->drop()->save();
    }
}
