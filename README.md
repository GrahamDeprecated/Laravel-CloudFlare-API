Laravel CloudFlare API
======================


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/GrahamCampbell/Laravel-CloudFlare-API/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
[![Build Status](https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare-API.png?branch=develop)](https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare-API)
[![Coverage Status](https://coveralls.io/repos/GrahamCampbell/Laravel-CloudFlare-API/badge.png?branch=develop)](https://coveralls.io/r/GrahamCampbell/Laravel-CloudFlare-API)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare-API/badges/quality-score.png?s=0f3507596babc2503396aed5abceabeb6f703db9)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare-API)
[![Latest Version](https://poser.pugx.org/graham-campbell/cloudflare-api/v/stable.png)](https://packagist.org/packages/graham-campbell/cloudflare-api)
[![Still Maintained](http://stillmaintained.com/GrahamCampbell/Laravel-CloudFlare-API.png)](http://stillmaintained.com/GrahamCampbell/Laravel-CloudFlare-API)


## What Is Laravel CloudFlare API?

Laravel CloudFlare API is a [CloudFlare API](https://www.cloudflare.com/docs/client-api.html) client for [Laravel 4.1](http://laravel.com).  

* Laravel CloudFlare API was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).  
* Laravel CloudFlare API relies on my [Laravel Core API](https://github.com/GrahamCampbell/Laravel-Core-API) package.  
* Laravel CloudFlare API uses [Travis CI](https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare-API) to run tests to check if it's working as it should.  
* Laravel CloudFlare API uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare-API) and [Coveralls](https://coveralls.io/r/GrahamCampbell/Laravel-CloudFlare-API) to run additional tests and checks.  
* Laravel CloudFlare API uses [Composer](https://getcomposer.org) to load and manage dependencies.  
* Laravel CloudFlare API was not designed for user login, but for server use only.  
* Laravel CloudFlare API provides a [change log](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/develop/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/releases), and a [wiki](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/wiki).  
* Laravel CloudFlare API is licensed under the Apache License, available [here](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/develop/LICENSE.md).  


## System Requirements

* PHP 5.4.7+ or PHP 5.5+ is required.  
* You will need [Laravel 4.1](http://laravel.com) because this package is designed for it.  
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Laravel CloudFlare API.  


## Installation

Please check the system requirements before installing Laravel CloudFlare API.  

To get the latest version of Laravel CloudFlare API, simply require it in your `composer.json` file.  

`"graham-campbell/cloudflare-api": "dev-master"`  

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.  

You will need to register the [Laravel Core API](https://github.com/GrahamCampbell/Laravel-Core-API) service provider before you attempt to load the Laravel CloudFlare API service provider. Open up `app/config/app.php` and add the following to the `providers` key.  

`'GrahamCampbell\CoreAPI\CoreAPIServiceProvider'`  

Once Laravel CloudFlare API is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.  

`'GrahamCampbell\CloudFlareAPI\CloudFlareAPIServiceProvider'`  

You can register the CloudFlareAPI facade in the `aliases` key of your `app/config/app.php` file if you like.  

`'CloudFlareAPI' => 'GrahamCampbell\CloudFlareAPI\Facades\CloudFlareAPI'`  


## Usage

There is currently no usage documentation besides the [API Documentation](http://grahamcampbell.github.io/Laravel-CloudFlare-API
) for Laravel CloudFlare API.  

You may see an example of implementation in [CMS CloudFlare](https://github.com/GrahamCampbell/CMS-CloudFlare).  


## Updating Your Fork

The latest and greatest source can be found on [GitHub](https://github.com/GrahamCampbell/Laravel-CloudFlare-API).  
Before submitting a pull request, you should ensure that your fork is up to date.  

You may fork Laravel CloudFlare API:  

    git remote add upstream git://github.com/GrahamCampbell/Laravel-CloudFlare-API.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).  

You can then update the branch:  

    git pull --rebase upstream develop
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.  


## Pull Requests

Please submit pull requests against the develop branch.  

* Any pull requests made against the master branch will be closed immediately.  
* If you plan to fix a bug, please create a branch called `fix-`, followed by an appropriate name.  
* If you plan to add a feature, please create a branch called `feature-`, followed by an appropriate name.  
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).  


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
