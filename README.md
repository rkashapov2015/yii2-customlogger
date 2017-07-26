Custom Logger
=============
Custom Logger

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist rkashapov2015/yii2-customlogger "*"
```

or add

```
"rkashapov2015/yii2-customlogger": "*"
```

to the require section of your `composer.json` file.


Configuration
-----

Once the extension is installed, simply use it in your code by  :

```php
'components' = > [
    'custom-logger' => [
        'class' => 'rkashapov2015\customlogger\CustomLogger',
        'type' => '{1|2}' //1 = DB; 2 = CURL,
        'url' => '{for CURL}'
        'excludeRoutes' => [
            '/debug/'
        ]
    ]
]
```

for working with database (type = 1), exec this command in the root project: 
```
php yii migrate --migrationPath=@rkashapov2015/customlogger/migrations
```
