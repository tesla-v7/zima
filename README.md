**Тестовое задание для ZimaBlue**.
Для работы приложения требутся приложения:
1. Интерпритатор языка PHP(7.2.5) [установка](https://www.php.net/manual/ru/install.php).
1. Пакетный менеджер composer [установка](https://getcomposer.org/download/).
1. Фреймворк Symfony(6.1) [установка](https://symfony.com/doc/current/setup.html).
1. База данных MySQl(5.5) [установка](https://dev.mysql.com/downloads/mysql/).
   
**Запусл проекта локально**
1. Получить проект: 
```
   git clone git@github.com:tesla-v7/zima.git
```

1. Установить зависимости:
```
    cd zima
    composer install
```
1. Задать кредиталы полключения к базе в .env
```
    nano .env
```
1. Создать базу данных в mysql.
```
   bin/console doctrine:database:create
```
1. Запустить миграции:
```
   bin/console doctrine:migrations:migrate
```
1. Заполнить базу тестовыми данными:
```
   bin/console doctrine:fixtures:load
```
1. Запустить приложение локально:
```
   symfony local:server:start
```
1. Перейти по адресу [http://127.0.0.1:8000/main/sales](http://127.0.0.1:8000/main/sales)
