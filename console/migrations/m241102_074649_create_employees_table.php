<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employees}}`.
 */
class m241102_074649_create_employees_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%employees}}', [
			'id' => $this->primaryKey(),
			'full_name' => $this->string()->notNull(),
			'email' => $this->string()->notNull(),
			'phone_number' => $this->string()->notNull(),
			'role' => $this->string(64)->notNull()->defaultValue('admin'), // По умолчанию роль "администратор"
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%employees}}');
	}
}
