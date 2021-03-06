Laravel CloudFlare API
======================

Laravel CloudFlare API was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a CloudFlare API client for [Laravel 5](http://laravel.com). It utilises [Guzzle 5](https://github.com/guzzle/guzzle), and my [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/releases), [license](LICENSE), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).

## WARNING

#### This package is no longer maintained.

![Laravel CloudFlare API](https://cloud.githubusercontent.com/assets/2829600/4432316/c173a328-468c-11e4-99c1-b49f78b738bb.PNG)

<p align="center">
<a href="https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare-API"><img src="https://img.shields.io/travis/GrahamCampbell/Laravel-CloudFlare-API/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare-API/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-CloudFlare-API.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare-API"><img src="https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-CloudFlare-API.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/GrahamCampbell/Laravel-CloudFlare-API/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Laravel-CloudFlare-API.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.4+ or [HHVM](http://hhvm.com) 3.3+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel CloudFlare API, simply add the following line to the require block of your `composer.json` file:

```
"graham-campbell/cloudflare-api": "0.7.*"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel CloudFlare API is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\CloudFlareAPI\CloudFlareAPIServiceProvider'`

You can register the CloudFlareAPI facade in the `aliases` key of your `config/app.php` file if you like.

* `'CloudFlareAPI' => 'GrahamCampbell\CloudFlareAPI\Facades\CloudFlareAPI'`


## Configuration

Laravel CloudFlare API requires connection configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/cloudflareapi.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are two config options:

##### Default Connection Name

This option (`'default'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'main'`.

##### CloudFlare Connections

This option (`'connections'`) is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.


## Usage

There is currently no usage documentation besides the [API Documentation](http://docs.grahamjcampbell.co.uk) for Laravel CloudFlare API.


## License

Laravel CloudFlare API is licensed under [The MIT License (MIT)](LICENSE).
