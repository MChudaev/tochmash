<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%delivery_types}}`.
 */
class m241101_233509_create_delivery_types_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%delivery_types}}', [
			'id' => $this->primaryKey(),
			'type' => $this->string()->notNull(),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%delivery_types}}');
	}
}
