<div align="center">
    <a href="https://github.com/thiiagoms/trouter">
        <img src="assets/router.png" alt="Logo" width="80" height="80">
    </a>
    <h3 align="center">Vanilla PHP Router :mage:</h3>
    <p float="left">
        <img
            src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"
            alt="PHP"
        >
        <img
            src="https://img.shields.io/badge/Shell_Script-121011?style=for-the-badge&logo=gnu-bash&logoColor=white"
            alt="Shell Script"
        >
        <img
            src="https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white"
            alt="Docker"
        >
    </p>
</div>

TRouter is a lightweight and flexible routing library for PHP. It allows you to easily define and manage your application's routes in a clear and concise way, without requiring any external dependencies or complicated configuration.

With TRouter, you can quickly and easily define routes using a simple and intuitive syntax. You can specify the HTTP method, the path pattern, and a callback function that should be executed when the route is matched. You can also define optional parameters and regular expression constraints for your routes,
making it easy to handle dynamic and complex URLs

### Dependencies :memo:
- Docker or Composer (PHP8.1+)

### Install :package:

#### Composer
```bash
$ composer require thiiagoms/trouter
```
#### Docker

01 - Clone the repository:
```bash
$ git clone https://github.com/thiiagoms/trouter
```

02 - Switch to `trouter` directory:
```bash
$ cd trouter
trouter $
```

03 - Run `setup.sh`:
```bash
trouter $ chmod +x ./setup.sh
trouter $ ./setup.sh

████████╗██████╗  ██████╗ ██╗   ██╗████████╗███████╗██████╗ 
╚══██╔══╝██╔══██╗██╔═══██╗██║   ██║╚══██╔══╝██╔════╝██╔══██╗
   ██║   ██████╔╝██║   ██║██║   ██║   ██║   █████╗  ██████╔╝
   ██║   ██╔══██╗██║   ██║██║   ██║   ██║   ██╔══╝  ██╔══██╗
   ██║   ██║  ██║╚██████╔╝╚██████╔╝   ██║   ███████╗██║  ██║
   ╚═╝   ╚═╝  ╚═╝ ╚═════╝  ╚═════╝    ╚═╝   ╚══════╝╚═╝  ╚═╝

  [*] Author: Thiago Silva AKA thiiagoms
  [*] E-mail: thiagom.devsec@gmail.com
```

04 - Go to `http://localhost:8000`

### Usage :gear:

Here's a basic example of how to use TRouter to define and handle routes in your PHP application:
```php
<?php

require_once 'vendor/autoload.php';

use Trouter\Router;

$router = new Router();

$router->get('/', function () {
    echo 'Hello, world!';
});

$router->get('/posts', function () {
    echo 'List of posts';
});

$router->get('/posts/:id', function ($id) {
    echo "Showing post #$id";
});

$router->post('/posts', function () {
    echo 'Creating a new post';
});

$router->put('/posts/:id', function ($id) {
    echo "Updating post #$id";
});

$router->delete('/posts/:id', function ($id) {
    echo "Deleting post #$id";
});

$router->run();
```
