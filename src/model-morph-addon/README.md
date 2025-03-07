# model-morph-addon

[![Latest Stable Version](https://poser.pugx.org/friendsofhyperf/model-morph-addon/v/stable.svg)](https://packagist.org/packages/friendsofhyperf/model-morph-addon)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofhyperf/model-morph-addon)](https://packagist.org/packages/friendsofhyperf/model-morph-addon)
[![License](https://img.shields.io/packagist/l/friendsofhyperf/model-morph-addon)](https://github.com/friendsofhyperf/model-morph-addon)

The model morph addon for Hyperf.

## Installation

```shell
composer require friendsofhyperf/model-morph-addon
```

## Before

```php
<?php
namespace App\Model;

class Image extends Model
{
    public function imageable()
    {
        return $this->morphTo();
    }
}

class Book extends Model
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

class User extends Model
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

// Global
Relation::morphMap([
    'user' => App\Model\User::class,
    'book' => App\Model\Book::class,
]);
```

## After

```php
<?php
namespace App\Model;

class Image extends Model
{
    public function imageable()
    {
        return $this->morphTo();
    }

    // Privately-owned
    public static function getActualClassNameForMorph($class)
    {
        $morphMap = [
            'user' => User::class,
            'book' => Book::class,
        ];

        return Arr::get($morphMap, $class, $class);
    }
}

class Book extends Model
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getMorphClass()
    {
        return 'book';
    }
}

class User extends Model
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getMorphClass()
    {
        return 'user';
    }
}
```

## Donate

> If you like them, Buy me a cup of coffee. [Alipay](https://hdj.me/images/alipay-min.jpg) | [WeChat](https://hdj.me/images/wechat-pay-min.jpg)

## Contact

- [Twitter](https://twitter.com/huangdijia)
- [Gmail](mailto:huangdijia@gmail.com)

## License

[MIT](LICENSE)
