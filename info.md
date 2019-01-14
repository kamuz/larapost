# CMS на базе Laravel

## Настройка окружения и установка Laravel

Нужно установить XAMPP с поддержкой PHP 7, Git, Composer. Если не ставиться Composer качаем *.phar* архив и пользуемся через консольный PHP.

Переходим в папку *htdocs* XAMPP, запускаем терминал и устанавливаем Laravel с помощью Composer:

```php
composer create-project laravel/laravel sitename.loc
```

Вам нужно только изменить название папки, в моём же случае название папки совпадает с названием желаемого хоста или локального доменного имени.

Чтобы запустить приложения нам нужно ввести в адресную строку примерно такой адрес:

```
http://localhost/sitename.loc/public/
```

Чтобы поправить это, нужно изменить файл хостов Apache, который в случае с XAMPP находится *apache/conf/extra/httpd-vhosts.conf* - нам нужно указать путь к файлам сайта и название домена:

*apache/conf/extra/httpd-vhosts.conf*

```
<VirtualHost *:80>
    DocumentRoot "D:/Sandbox/htdocs/sitename.loc/public"
    ServerName sitename.loc
</VirtualHost>
```

Также нужно поправить файл хостов:

*c:/Windows/System32/drivers/etc/hosts*

```
127.0.0.1  sitename.loc
```

Чтобы сохранить этот файл нужно открывать его с правами администратора.

Перезапускаем Apache и обращаеся к сайту уже по более короткому адресу:

```
sitename.loc
```

Посмотрим на файловую структуру:

* *app/* - содержит модели, по умолчанию мы имеет только одну модель *Users.php*. Если у вас планируется много моделей, то можно создать подпапку *Models*
* *app/Http/Controllers/* - контроллеры приложения. По умолчанию у нас есть дефолтный котроллер и папка *Auth*, которая содержит контроллеры, которые отвечают за авторизацию и регистрацию пользователей.
* *resources/views/* - содержит все виды приложения. Как правило используется шаблонизатор Blade
* *routes/web.php* - файл с роутами
* *.env* - файл конфигурации, например название проекта, параметры подключения к БД и т. д.

## Основы роутинга и контроллеры

Мы можем использовать разные запросы GET, POST, DELETE и это позволяет очень просто создавать RESTful API. Роутинг по синтаксису похож на то что мы имеем в Express/Node.js, то есть мы указываем тип запроса, потом указываем URL или правило роутинга, после чего используем функцию обратного вызова, чтобы указать что именно должно проиходить.

*routes/web.php*

```php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "<h1>Hello, world!</h1>";
});
```

Вы можете создавать вложенные шаблоны, поэтому давайте создадим:

*resources/views/pages/about.blade.php*

```php
<h1>About page</h1>

<?php

echo "Hello, man";
```

Теперь создадим роут:

*routes/web.php*

```php
Route::get('/about', function () {
    return view('pages.about');
});
```

Можно использовать точку для обращения к файлу в директории, а можно более привычный слэш.

Мы можем передавать динамические данные, взятые с сегмента URL

*routes/web.php*

```php
Route::get('/users/{id}', function ($id) {
    return "Hi, $id";
});
```

Чтобы передать больше переменных нужно использовать такой синтаксис:

*routes/web.php*

```php
Route::get('/users/{id}/{name}', function ($id, $name) {
    return "This is user $name with an ID of $id";
});
```

В большинстве случаев роут не вызывает вид на прямую - как правило это делает контроллер. Чтобы создать контроллер мы будем использовать консольную утилиту Artisan, для этого переходим в корень приложения и в консоли пишем:

```bash
php artisan make:controller PagesController
```

Имя контроллера принято называть с большой буквы и каждое следующее слово также должно быть с большой буквы без пробелов. Можно создавать имена в множественном числе, а можно в единичном - как вам будет удобней.

Теперь если мы посмотрим в папку *app/Http/Controllers/* мы увидим наш файл с таким содержимым:

*app/Http/Controllers/PagesController.php*

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
}
```

Создадим метод *index()*  и просто будем возвращать строку:

*app/Http/Controllers/PagesController.php*

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return "INDEX CONTROLLER";
    }
}
```

Теперь нам больше не нужна функция обратного вызова, а обращения к контроллеру и его методу выполняется таким образом:

*routes/web.php*

```php
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
```

В большинстве случаев нужно рендерить шаблон, поэтому мы создадим новый шаблон *pages/index.blade.php* и передадим его в метод `view()` в контроллере.

*app/Http/Controllers/PagesController.php*

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        return view('pages.services');
    }
}
```

Теперь осталось создать необходимые виды, например:

*resources/views/pages/index.blade.php*

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel APP') }}</title>
</head>
<body>

<h1>Welcome to our site</h1>

</body>
</html>
```

В `title` мы выводим информацию поля `name` из файла `.env`, а если там ничего нет, тогда установим значение по умолчанию.