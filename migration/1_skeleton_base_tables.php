<?php

/**
 * Create Skeleton base tables.
 *
 * Copyright 2012-2026 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @author  Your Name <you@example.com>
 * @category Horde
 * @package  Skeleton
 */
class SkeletonBaseTables extends Horde_Db_Migration_Base
{
    /**
     * Upgrade
     */
    public function up()
    {
        $t = $this->createTable('skeleton_items', ['autoincrementKey' => 'item_id']);
        $t->column('item_owner', 'string', ['limit' => 255, 'null' => false]);
        $t->column('item_data', 'string', ['limit' => 64, 'null' => false]);
        $t->end();

        $this->addIndex('skeleton_items', ['item_owner']);
    }

    /**
     * Downgrade
     */
    public function down()
    {
        $this->dropTable('skeleton_items');
    }
}
