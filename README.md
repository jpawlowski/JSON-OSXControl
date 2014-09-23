# JSON OSX Control

These php scripts provide JSON REST API to control any OSX application supporting AppleScript.


## Prerequisites

A local web server together with PHP running on the Mac is essential.
Using [MAMP](http://http://www.mamp.info) for this is recommended.


## Installation
Just put these files into the Mac's htdocs directory running Apache or Nginx with PHP.
For compatibility reasons, it is recommended to use the sub-folder /json.

Using MAMP, the installation is as simple as:

````
git clone https://github.com/jpawlowski/JSON-OSXControl.git /Applications/MAMP/htdocs/json
````

The web server service account needs to be allowed to run osascript via sudo. Add an entry via `sudo visudo` like this:

````
username ALL=NOPASSWD: /usr/bin/osascript
````


## Security

It is recommended to enable SSL/TLS encryption for the web server and only allow encrypted access to the JSON OSX Control scripts.
Please also edit users.inc.php for your individual access tokens and delete the example token. This file is out of scope for the Git pull update mechanism and will never be overwritten automatically.

If possible, configure your web server to run under a dedicated service user account `www` (in case of MAMP) or `_www` (in case of older OS X versions providing their own web server). Update your sudo configuration accordingly.


## Usage

You will need one of the authorized security tokens defined in users.inc.php to access the JSON API.
To test, you may point your web browser to `https://<IP address or name of OSX>/json/debug.html`.

The URL format in general is like:

	/json/<access token>/

You may add additional key/value variables either via GET or POST (in JSON format).
Beside the common GET format `?key=value`, you may also just add additional subfolders to the URI schema, e.g. `/app/<APP name>/command/<your command>`.


## About

[Julian Pawlowski aka @Loredo](http://twitter.com/Loredo)
