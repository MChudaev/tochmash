<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%requests}}`.
 */
class m241102_091311_create_requests_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%requests}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'description' => $this->text(),
			'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
			'employee_id' => $this->integer()->notNull(),
			'customer_id' => $this->integer()->notNull(),
		]);

		// Добавление индексов для полей employee_id, request_type_id и customer_id
		$this->createIndex(
			'idx-requests-employee_id',
			'{{%requests}}',
			'employee_id'
		);

		$this->createIndex(
			'idx-requests-customer_id',
			'{{%requests}}',
			'customer_id'
		);

		// Добавление внешних ключей для полей employee_id, request_type_id и customer_id
		$this->addForeignKey(
			'fk-requests-employee_id',
			'{{%requests}}',
			'employee_id',
			'{{%employees}}',
			'id',
			'CASCADE'
		);

		$this->addForeignKey(
			'fk-requests-customer_id',
			'{{%requests}}',
			'customer_id',
			'{{%customers}}',
			'id',
			'CASCADE'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		// Удаление внешних ключей
		$this->dropForeignKey(
			'fk-requests-employee_id',
			'{{%requests}}'
		);

		$this->dropForeignKey(
			'fk-requests-customer_id',
			'{{%requests}}'
		);

		// Удаление индексов
		$this->dropIndex(
			'idx-requests-employee_id',
			'{{%requests}}'
		);

		$this->dropIndex(
			'idx-requests-customer_id',
			'{{%requests}}'
		);

		$this->dropTable('{{%requests}}');
	}
}
