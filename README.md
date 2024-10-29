TodoList App
=============

1. retrieve project : [TodoList Project](https://github.com/damizkrli/todolist.git)
2. install composer \
```composer install```
3. copy/paste .env in order to create .env.local. In this one, choose your 
favorite database
4. create connection and use Symfony command to create this one \
```php bin/console doctrine:database:create```
5. create migration \
```php bin/console make:migration```
6. execute migrations \
```php bin/console doctrine:migrations:migrate```

At this point, you should have an operational database, and you can add tasks. 
Enjoy 🖖
