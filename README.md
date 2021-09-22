# Authentication module for laminas web application

> this module is compatible with Laminas application only

## Configuration
You must create a dabatase and define the Laminas `db` configuration first. Eg mysqli, sqlite,...
```php
'db' => [
        'driver' => 'Pdo_Sqlite',
        'database' => realpath(__DIR__ . '/../../data/db/my_db')
    ]
```

## Before you start
Running the `bin/create-user-table` to initialise the stuff. You will be asked to create the very first user.

## Start
Access `/login` via your browser to test the result. You can use the created user from the step above to log in.

## Notes
Password is stored in `sha256` hashed value.

To override the view scripts, use the configures:
```php
'layout/login' => __DIR__ . '/../view/layout/login.phtml',
'tri-le/authentication/log-in/index' => __DIR__ . '/../view/log-in/index.phtml',
'tri-le/authentication/success/index' => __DIR__ . '/../view/success/index.phtml'
```

## Thank you
