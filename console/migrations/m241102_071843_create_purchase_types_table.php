<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purchase_types}}`.
 */
class m241102_071843_create_purchase_types_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%purchase_types}}', [
			'id' => $this->primaryKey(),
			'purchase' => $this->string()->notNull(),
			'customer_material' => $this->string()->notNull(),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%purchase_types}}');
	}
}
