Laravel CloudFlare API
======================


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/GrahamCampbell/CloudFlare-API/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
[![Build Status](https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare-API.png?branch=master)](https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare-API)
[![Latest Version](https://poser.pugx.org/graham-campbell/cloudflare-api/v/stable.png)](https://packagist.org/packages/graham-campbell/cloudflare-api)
[![Total Downloads](https://poser.pugx.org/graham-campbell/cloudflare-api/downloads.png)](https://packagist.org/packages/graham-campbell/cloudflare-api)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-GitHub-API/badges/quality-score.png?s=d4e7a8b8f4ba73c1a64ffef1e8946dd9ecd0da4d)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-GitHub-API)
[![Still Maintained](http://stillmaintained.com/GrahamCampbell/Laravel-CloudFlare-API.png)](http://stillmaintained.com/GrahamCampbell/Laravel-CloudFlare-API)


Copyright © [Graham Campbell](https://github.com/GrahamCampbell) 2013  


## THIS ALPHA RELEASE IS FOR TESTING ONLY


## What Is Laravel CloudFlare API?

Laravel CloudFlare API is a [CloudFlare API](https://www.cloudflare.com/docs/client-api.html) client for [Laravel 4](http://laravel.com).  

* Laravel CloudFlare API was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).  
* Laravel CloudFlare API relies on my [Core API](https://github.com/GrahamCampbell/Laravel-Core-API) package.  
* Laravel CloudFlare API uses [Travis CI](https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare-API) to run tests to check if it's working as it should.  
* Laravel CloudFlare API uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare-API) to run additional tests and checks.  
* Laravel CloudFlare API uses [Composer](https://getcomposer.org) to load and manage dependencies.  
* Laravel CloudFlare API was not designed for user login, but for server use only.  
* Laravel CloudFlare API provides a [change log](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/releases), and a [wiki](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/wiki).  
* Laravel CloudFlare API is licensed under the MIT, available [here](https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md).  


## System Requirements

* PHP 5.3.3+, 5.4+ or PHP 5.5+ is required.
* You will need [Laravel 4](http://laravel.com) because this package is designed for it.  
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Laravel CloudFlare-API.  


## Installation

Please check the system requirements before installing Laravel CloudFlare API.  

To get the latest version of Laravel CloudFlare API, simply require it in your `composer.json` file.

`"graham-campbell/cloudflare-api": "dev-master"`

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel CloudFlare API is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

`'GrahamCampbell\CloudFlareAPI\CloudFlareAPIServiceProvider'`

You will also need to have registered the [Laravel Core API](https://github.com/GrahamCampbell/Laravel-Core-API) service provider.

`'GrahamCampbell\CoreAPI\CoreAPIServiceProvider'`

You can register the CloudFlareAPI facade in the `aliases` key of your `app/config/app.php` file if you like.

`'CloudFlareAPI' => 'GrahamCampbell\CloudFlareAPI\Facades\CloudFlareAPI'`


## Updating Your Fork

The latest and greatest source can be found on [GitHub](https://github.com/GrahamCampbell/Laravel-CloudFlare-API).  
Before submitting a pull request, you should ensure that your fork is up to date.  

You may fork Laravel CloudFlare API:  

    git remote add upstream git://github.com/GrahamCampbell/Laravel-CloudFlare-API.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).  

You can then update the branch:  

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.  


## License

The MIT License (MIT)

Copyright (c) 2013 Graham Campbell

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
