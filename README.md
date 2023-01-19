<p align="center">
  <a href="https://github.com/thiiagoms/trouter">
    <img src="assets/router.png" alt="Logo" width="80" height="80">
  </a>
     <h3 align="center">Vanilla PHP Router :mage:</h3>
</p>

Vanilla Router for PHP8 (Just for studying), please, don't use this in production!!

- [Dependencies](#Dependencies)
- [Install](#Install)
- [Run](#Run)

#### Dependencies :package:
- Docker

### 
### Install :zap:
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

### Use :hammer:

05 - You cand add routes inside `public/index.php` like this way:
```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use TRouter\Http\Router;

$router = new Router();

# With CallBack
$router->get('/', function () {
    echo 'Hello World from callback';
});

# With static methods for controller
$router->get('/static-method', HelloWorldController::class, 'testStatic');

# With instace methods
$router->get('/instance-method', HelloWorldController::class, 'testInstance');

# Support Post methods (You can pass controller with static or instance methods)
$router->post('/', function () {
    echo 'Hello World from POST callback';
});

# Execute router
$router->run();
```