<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;


class $className extends AbstractMigration
{
    /**
     *    http://docs.phinx.org/en/latest/migrations.html
     *
     *    createTable / renameTable / dropTable
     *    addColumn  /  renameColumn / removeColumn() / changeColumn
     *    addIndex / addForeignKey
     */
    public function change()
    {
        // Имя таблицы
        $table = $this->table('', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'integer', ['limit' => 11, 'signed' => false, 'identity' => true, 'comment' => 'ID'])
            ->addColumn('title', 'string', ['limit' => 255, 'comment' => 'Заголовок'])
            ->addColumn('content', 'text', ['comment' => 'Описание'])
            ->addColumn('body', 'text', ['limit' => MysqlAdapter::TEXT_MEDIUM, 'comment' => 'Основной текст'])
            ->addColumn('username', 'string', ['limit' => 255, 'after' => 'status', 'comment' => 'Имя пользователя'])
            ->addColumn('first_name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('last_name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('age', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => true, 'signed' => false])
            ->addColumn('ip', 'integer', ['signed' => false])
            ->addColumn('status', 'enum', ['values' => ['enabled', 'disabled']])
            ->addColumn('type', 'boolean')
            ->addColumn('date', 'datetime', ['after' => 'created'])
            ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addTimestamps(null, null)

            ->create();
    }

    public function up()
    {
        $users = $this->table('', ['id' => false, 'primary_key' => ['id']]);
        // Phinx automatically creates an auto-incrementing primary key column called id for every table.
        $users
            // проверить чтобы ID - был unsigned
            ->addColumn('id', 'integer', ['limit' => 11, 'signed' => false, 'identity' => true, 'comment' => 'ID'])
            ->addColumn('title', 'string', ['limit' => 255, 'comment' => 'Заголовок'])
            ->addColumn('content', 'text', ['comment' => 'Описание'])
            ->addColumn('body', 'text', ['limit' => MysqlAdapter::TEXT_MEDIUM, 'comment' => 'Основной текст'])
            ->addColumn('username', 'string', ['limit' => 255, 'after' => 'status', 'comment' => 'Имя пользователя'])
            ->addColumn('first_name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('last_name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('age', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => true, 'signed' => false])
            ->addColumn('ip', 'integer', ['signed' => false])
            ->addColumn('status', 'enum', ['values' => ['enabled', 'disabled']])
            ->addColumn('type', 'boolean')
            ->addColumn('date', 'datetime')
            ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addTimestamps(null, null)

            ->addIndex(['username', 'password'], ['unique' => true])
            ->save();
    }

    public Function down()
    {
        // Удалить таблицу
        $this->dropTable('');
        // Удалить столбец
        $table = $this->table('');
        $table->removeColumn('')
            ->save();
        // переименовать таблицу
        $table = $this->table('');
        $table->rename('');
        // переименовать столбец
        $table = $this->table('');
        $table->renameColumn('', '');
        // изменить столбец
        $users = $this->table('');
        $users->changeColumn('email', 'string', ['limit' => 255])
            ->save();
        // обновить столбцы
        $table = $this->table('');
        $table->addColumn('city', 'string', ['after' => 'email'])
            ->update();
    }
}
