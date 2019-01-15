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

## Blade шаблонизация и компиляция активов

Мы можем определить основной шаблон, который будет наследоваться остальными, то есть остальные будут его расширять и использовать общие блоки, но с возможностью их переоределения.

*resources/views/layouts/app.blade.php*

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel APP') }}</title>
</head>
<body>

@yield('content')

</body>
</html>
```

В том месте где у нас встречается `@yield` мы можем определять контент, который нам нужно переоределить. Теперь нужно поправить остальные шаблоны и привести их к таком виду:

*resources/views/pages/index.blade.php*

```php
@extends('layouts.app')

@section('content')
<h1>Welcome to our site</h1>
@endsection
```

С помощью `@extend` мы говорим о том что данный шаблон наследует указанный, а конструкция `@section` определяет контент, который мы будем вставлять в том месте, где вызвали определённый `@yield`.

Давайте теперь передадим переменную в наш вид, который будет определять заголовок страницы.

*app/Http/Controllers/PagesController.php*

```php
class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to Laravel Application";
        return view('pages.index', compact('title'));
    }
    //..
```

Функция `compact()` служит для короткой записи переменной, которую нужно передать в вид.

Выводить переменную в шаблон следует таким образом:

*resources/views/pages/index.blade.php*

```php
@extends('layouts.app')

@section('content')
<h1>{{ $title }}</h1>
@endsection
```

Другой вариант передачи переменной в шаблон - это использование метода `with()`, на вход которого вы должны определить название переменной, которое вы хотите использовать в виде, а вторым параметром данные, которые должны находится в этой переменной. Метод `compact()` более короткий, который использует название переданной переменной в шаблоне, а в методе `with()` это можно переопределить, хотя в большинстве случаев этого не требуется.

*app/Http/Controllers/PagesController.php*

```php
    //..
    public function about(){
        $title = "Some info about Us";
        return view('pages.about')->with('title', $title);
    }
    //..
```

Кроме этого вы можете использовать и обычный вывод PHP вместо синтаксиса Laravel, например так:

*resources/views/pages/index.blade.php*

```php
@extends('layouts.app')

@section('content')
<h1><?php echo $title; ?></h1>
@endsection
```

Если вам нужно передать несколько значений в вид, то вы можете использовать для этих целей ассоциативный массив.

*app/Http/Controllers/PagesController.php*

```php
    //..
    public function services(){
        $data = array(
            'title' => 'Our services',
            'services' => ['Web Desing', 'HTML Coding', 'WordPress Theme Development', 'WordPress Plugin Development']
        );
        return view('pages.services')->with($data);
    }
    //..
```

В шаблоне мы используем условие `if` и цикл `foreach`:

*resources/views/pages/services.blade.php*

```php
@extends('layouts.app')

@section('content')
<h1>{{$title}}</h1>
@if(count($services) > 0)
    <ul>
        @foreach($services as $service)
            <li>{{$service}}</li>
        @endforeach
    </ul>
@endif
@endsection
```

По умолчанию Laravel использует Boostrap и скомпилированный файл CSS находится в папке *public/css/app.css* и для того чтобы подключить этот файл в шаблоне нужно использовать:

*resources/views/layouts/app.blade.php*

```php
<link rel="stylesheet" href="{{asset('css/app.css')}}">
```

В папке *assets/* содержатся исходники стилей и скриптов, которые компилируются в версию для продакшена. В файле *assets/sass/app.scss*, то мы увидим от куда у нас импортируются стили. В том числе импорт есть из папки `@import "~bootstrap-sass/assets/stylesheets/bootstrap"` - это путь к папке *node_modules*, которой у нас пока что нет, поэтому нам нужно запустить команду `npm install`, чтобы поставить все необходимые зависимости в проект.

И если мы посмотрим в файл *package.json* в корне приложения, то мы увидим список зависимостей, которые будут установленны вместе с Bootstrap, например `laravel-mix` будет делать компиляцию стилей и скриптов, а `vue` - это JS библиотека, которая используется для создания интерфейсов и одностраничных приложений.

Запускаем команду

```bash
npm install
```

Чтобы поставить все зависимости из файла *package.json*.

Теперь мы можем изменять исходники и компилировать стили, для этого можем поправить одну переменную:

*resources/assets/sass/_variables.scss*

```scss
$body-bg: red;
```

Запускаем `laravel-mix` командой

```bash
npm run dev
```

Чтобы скомпилировать исходные файлы активов.

Теперь нажимаем <kbd>Ctrl</kbd> + <kbd>F5</kbd> для того чтобы обновить страницу и почистить кэш.

Если вы не хотите запускать команду компиляции каждый раз при изменении исходников, вы можете использовать другую команду:

```bash
npm run watch
```

Которая будет ослеживать изменения в исходных файлах и автоматичести компилировать их.

Если вам нужно создать ваш собственный файл стилей, то вы можете создать файл:

*resources/assets/sass/_custom.scss*

```scss
body{
    background-color: blue !important;
}
```

Теперь нужно импортировать данный файл:

*resources/assets/sass/app.scss*

```scss
// Custom
@import "custom";
```

Теперь можем добавить меню, для этого будем использовать конструкцию `@include`

*resources/views/layouts/app.blade.php*

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{config('app.name', 'Laravel APP')}}</title>
</head>
<body>

@include('include.navbar')
//..
```

Теперь создадим необходимый файл и добавим разметку:

*resources/views/include/navbar.blade.php*

```php
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{config('app.name', 'Laravel APP')}}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="about">About</a></li>
                <li><a href="services">Services</a></li>
            </ul>
        </div>
    </div>
</nav>
```

Давайте также добавим блок в котором будут ссылки на авторизацию и регистрацию:

*resources/views/pages/index.blade.php*

```php
@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
    <div class="container">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="login" role="button">Login</a> <a class="btn btn-success btn-lg" href="register" role="button">Register</a></p>
    </div>
</div>
<h1>{{$title}}</h1>
@endsection
```