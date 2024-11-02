<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%details}}`.
 */
class m241102_000607_create_details_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%details}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'drawing_number' => $this->string()->notNull(),
			'drawing_file' => $this->string(),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%details}}');
	}
}
