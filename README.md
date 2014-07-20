Laravel CloudFlare API
======================


[![Build Status](https://img.shields.io/travis/GrahamCampbell/Laravel-CloudFlare-API/master.svg?style=flat)](https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare-API)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-CloudFlare-API.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare-API/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-CloudFlare-API.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare-API)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg?style=flat)](LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/GrahamCampbell/Laravel-CloudFlare-API.svg?style=flat)](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/releases)


## Introduction

Laravel CloudFlare API was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and provides some core API client functions for [Laravel 4.1+](http://laravel.com). It utilises [Guzzle 4](https://github.com/guzzle/guzzle), and my [Laravel Core API](https://github.com/GrahamCampbell/Laravel-Core-API) and [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) packages. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/releases), [license](LICENSE.md), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).


## Installation

[PHP](https://php.net) 5.4+ or [HHVM](http://hhvm.com) 3.2+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel CloudFlare API, simply require `"graham-campbell/cloudflare-api": "~0.5"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel CloudFlare API is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\CloudFlareAPI\CloudFlareAPIServiceProvider'`

You can register the CloudFlareAPI facade in the `aliases` key of your `app/config/app.php` file if you like.

* `'CloudFlareAPI' => 'GrahamCampbell\CloudFlareAPI\Facades\CloudFlareAPI'`


## Configuration

Laravel CloudFlare API requires configuration.

To get started, first publish the package config file:

    php artisan config:publish graham-campbell/cloudflare-api

There are two config options:

##### Default Connection Name

This option (`'default'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'main'`.

##### CloudFlare Connections

This option (`'connections'`) is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.


## Usage

There is currently no usage documentation besides the [API Documentation](http://docs.grahamjcampbell.co.uk) for Laravel CloudFlare API.


## License

Apache License

Copyright 2013-2014 Graham Campbell

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
