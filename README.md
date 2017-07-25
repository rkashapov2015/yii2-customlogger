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


Usage
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