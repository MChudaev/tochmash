<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%materials}}`.
 */
class m241101_203024_create_materials_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%materials}}', [
			'id' => $this->primaryKey(),
			'geometry' => $this->string()->notNull(),
			'material' => $this->string()->notNull(),
			'type' => $this->string()->notNull(),
			'comment' => $this->text(),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%materials}}');
	}
}
