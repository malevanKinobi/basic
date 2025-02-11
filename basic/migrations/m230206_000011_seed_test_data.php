<?php
use yii\db\Migration;

/**
 * Миграция для заполнения базы тестовыми данными.
 */
class m230206_000011_seed_test_data extends Migration
{
    public function safeUp()
    {
        // Удаляем старые тестовые данные, если они уже есть.
        $this->delete('{{%homework}}', ['id' => [1, 2, 3]]);
        $this->delete('{{%schedule}}', ['id' => [1, 2, 3]]);
        $this->delete('{{%users}}', ['id' => [1, 3, 4]]);
        $this->delete('{{%subjects}}', ['id' => [1, 2, 3]]);
        $this->delete('{{%classes}}', ['id' => [1, 2]]);

        // 1. Заполнение таблицы классов (classes)
        $this->insert('{{%classes}}', [
            'id'    => 1,
            'name'  => '9-A',
            'grade' => 9,
        ]);
        $this->insert('{{%classes}}', [
            'id'    => 2,
            'name'  => '10-B',
            'grade' => 10,
        ]);

        // 2. Заполнение таблицы предметов (subjects)
        $this->insert('{{%subjects}}', [
            'id'          => 1,
            'name'        => 'Mathematics',
            'description' => 'Описание предмета математики',
        ]);
        $this->insert('{{%subjects}}', [
            'id'          => 2,
            'name'        => 'Physics',
            'description' => 'Описание предмета физики',
        ]);
        $this->insert('{{%subjects}}', [
            'id'          => 3,
            'name'        => 'History',
            'description' => 'Описание предмета истории',
        ]);

        // 3. Заполнение таблицы пользователей (users)
        // Здесь для теста все пароли "123456" с заранее сгенерированным хэшом,
        // а authKey задан произвольно.
        $passwordHash = '$2y$13$wJODGign7O9Tm4qkNWKsLOEOlyizb7qOSAfS1WB4tIpP0RIzK4dQ2';
        $authKey = '12345678901234567890123456789012';

        // Учитель
        $this->insert('{{%users}}', [
            'id'            => 1,
            'username'      => 'teacher1',
            'password_hash' => $passwordHash,
            'email'         => 'teacher1@example.com',
            'role'          => 'teacher',
            'class_id'      => null,
            'authKey'       => $authKey,
            'created_at'    => new \yii\db\Expression('NOW()'),
            'updated_at'    => new \yii\db\Expression('NOW()'),
        ]);
        // Студенты
        $this->insert('{{%users}}', [
            'id'            => 3,
            'username'      => 'student1',
            'password_hash' => $passwordHash,
            'email'         => 'student1@example.com',
            'role'          => 'student',
            'class_id'      => 1,
            'authKey'       => $authKey,
            'created_at'    => new \yii\db\Expression('NOW()'),
            'updated_at'    => new \yii\db\Expression('NOW()'),
        ]);
        $this->insert('{{%users}}', [
            'id'            => 4,
            'username'      => 'student2',
            'password_hash' => $passwordHash,
            'email'         => 'student2@example.com',
            'role'          => 'student',
            'class_id'      => 2,
            'authKey'       => $authKey,
            'created_at'    => new \yii\db\Expression('NOW()'),
            'updated_at'    => new \yii\db\Expression('NOW()'),
        ]);

        // 4. Заполнение таблицы расписания (schedule)
        $this->insert('{{%schedule}}', [
            'id'         => 1,
            'class_id'   => 1,
            'subject_id' => 1,
            'teacher_id' => 1,
            'date'       => '2025-02-06',
            'start_time' => '09:00:00',
            'end_time'   => '09:45:00',
            'room'       => '101',
        ]);
        $this->insert('{{%schedule}}', [
            'id'         => 2,
            'class_id'   => 1,
            'subject_id' => 2,
            'teacher_id' => 1,
            'date'       => '2025-02-06',
            'start_time' => '10:00:00',
            'end_time'   => '10:45:00',
            'room'       => '102',
        ]);
        $this->insert('{{%schedule}}', [
            'id'         => 3,
            'class_id'   => 2,
            'subject_id' => 3,
            'teacher_id' => 1,
            'date'       => '2025-02-06',
            'start_time' => '11:00:00',
            'end_time'   => '11:45:00',
            'room'       => '201',
        ]);

        // 5. Заполнение таблицы домашних заданий (homework)
        $this->insert('{{%homework}}', [
            'id'          => 1,
            'schedule_id' => 1,
            'description' => 'Решить задания 1-10 из учебника.',
            'due_date'    => '2025-02-07',
            'created_at'  => new \yii\db\Expression('NOW()'),
        ]);
        $this->insert('{{%homework}}', [
            'id'          => 2,
            'schedule_id' => 2,
            'description' => 'Подготовить презентацию по законам Ньютона.',
            'due_date'    => '2025-02-07',
            'created_at'  => new \yii\db\Expression('NOW()'),
        ]);
        $this->insert('{{%homework}}', [
            'id'          => 3,
            'schedule_id' => 3,
            'description' => 'Прочитать 5-ю главу по истории.',
            'due_date'    => '2025-02-07',
            'created_at'  => new \yii\db\Expression('NOW()'),
        ]);
    }

    public function safeDown()
    {
        // Удаляем тестовые данные (используем id для идентификации)
        $this->delete('{{%homework}}', ['id' => [1, 2, 3]]);
        $this->delete('{{%schedule}}', ['id' => [1, 2, 3]]);
        $this->delete('{{%users}}', ['id' => [1, 3, 4]]);
        $this->delete('{{%subjects}}', ['id' => [1, 2, 3]]);
        $this->delete('{{%classes}}', ['id' => [1, 2]]);
    }
}
