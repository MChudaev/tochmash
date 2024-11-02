<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customers}}`.
 */
class m241102_073117_create_customers_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%customers}}', [
			'id' => $this->primaryKey(),
			'address' => $this->string()->notNull(),
			'contact_persons' => $this->string()->notNull(),
			'position' => $this->string()->notNull(),
			'contacts' => $this->string()->notNull(),
			'description' => $this->text(),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%customers}}');
	}
}
