contao-timelinejs
=================

[![Build Status](http://img.shields.io/travis/netzmacht/contao-timelinejs/master.svg?style=flat-square)](https://travis-ci.org/netzmacht/contao-timelinejs)
[![Version](http://img.shields.io/packagist/v/netzmacht/contao-timelinejs.svg?style=flat-square)](http://packagist.com/packages/netzmacht/contao-timelinejs)
[![License](http://img.shields.io/packagist/l/netzmacht/contao-timelinejs.svg?style=flat-square)](http://packagist.com/packages/netzmacht/contao-timelinejs)
[![Downloads](http://img.shields.io/packagist/dt/netzmacht/contao-timelinejs.svg?style=flat-square)](http://packagist.com/packages/netzmacht/contao-timelinejs)
[![Contao Community Alliance coding standard](http://img.shields.io/badge/cca-coding_standard-red.svg?style=flat-square)](https://github.com/contao-community-alliance/coding-standard)

Extension for CMS Contao for create timelines based on [TimelineJS](http://timeline3.knightlab.com/).


Requirements
------------

This extension requires Contao 3.5.x and at least PHP 5.4. It is also based on 
[contao-toolkit 2.0](https://github.com/netzmacht/contao-toolkit) which means that extensions basing on v1 of this
dependency could not be used the same time.


Install
-------

This extension is provided using composer only. Search and install the extension via the package manager or install it
manually using:

```
$ php composer.phar require netzmacht/contao-timelinejs:~3.0
```


Features
--------

 * Create timelines with various elements.
 * No javascript knowledge needed. Everything is configured out of the box.
 * Cached timelines, so that performance is increased.
 
For developer
 * Event driven timeline building. Easy to customize the timeline definition.
 * Multiple data sources are supported. Feed free to create your own one.


Migrating
---------

Migrating form contao-timeline v1 to v3 is not supported.
