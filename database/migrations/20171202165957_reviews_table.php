<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;


class ReviewsTable extends AbstractMigration
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
        $table = $this->table('reviews', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'integer', ['limit' => 11, 'signed' => false, 'identity' => true, 'comment' => 'ID'])
            ->addColumn('first_name', 'string', ['limit' => 16, 'comment' => 'Имя пользователя'])
            ->addColumn('note', 'text', ['comment' => 'Текст записи'])
            ->addColumn('likes', 'integer', ['signed' => false, 'null' => true, 'comment' => 'Кол-во лайков'])
            ->addTimestamps(null, null)

            ->create();
    }

}
