AkumaCoenFileBundle
=================


Installation
------------

First you need to add `akuma/coen-uploader-bundle ` to `composer.json`:

```sh
composer require akuma/coen-uploader-bundle 
```

You also have to add `AkumaCoenFileBundle` to your `AppKernel.php`:

```php
// app/AppKernel.php
//...
class AppKernel extends Kernel
{
    //...
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Akuma\Bundle\CoenFileBundle\AkumaCoenFileBundle()
        );
        //...

        return $bundles;
    }
    //...
}
```
Configuration
-------------

You also may customize some config options:
```yml
akuma_coen_file:
    target_dir: ~ #default sys_get_tmp_dir
    max_uploads: ~ #default 3
```

Changelog
---------

### Version 1.0.0

- First release


License
-------

- The bundle is licensed under the [WTFPL License](http://www.wtfpl.net/)
