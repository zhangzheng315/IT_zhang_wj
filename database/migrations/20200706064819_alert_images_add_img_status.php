<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AlertImagesAddImgStatus extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('images', array('engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci'));
        $table->addColumn('status', 'integer', array('limit' => 11, 'default' => '1', 'after' => 'img_id', 'comment' => '图片状态1是0否'))
            ->update();
    }
}
