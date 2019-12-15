# ToDoPractice

Used MySQL, PHPMyAdmin, Apache 2.4, PHP 7.

SQL Tables are 'taskss' and 'users'.

The table users has fields: username(varchar), email(varchar), password(varchar), id(int)
Primary key is id and is autoincremented.

The table taskss has fields: taskNumber(int), id(int), task(varchar), finished(boolean)
Primary key is taskNumber and is autoincremented.
id is a foreign key, connecting user in user table with their tasks in taskss table.
