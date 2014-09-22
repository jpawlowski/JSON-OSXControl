# JSON OSX Control

These php scripts provide JSON REST API to control any OSX application supporting AppleScript.


## Installation
Just put these files into the Mac's htdocs directory running Apache or Nginx with PHP.
The web server service account needs to be allowed to run osascript via sudo. Add an entry via 'sudo visudo' like this:

````
username ALL=NOPASSWD: /usr/bin/osascript
````


## Prerequisites

A local web server together with PHP running on the Mac is essential.
Using [MAMP](http://http://www.mamp.info) for this is recommended.


## About

[Julian Pawlowski aka @Loredo](http://twitter.com/Loredo)
