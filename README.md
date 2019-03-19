# About #

This is _suitecrm-modules-installer_. 
A [composer] plugin which allows you to include [SuiteCrm] modules as composer dependencies.
 
## Usage ##

### Add-On Module

```json
{
  "name": "my/add-on-module",
  "description": "Add-on module for doing something cool",

  "type": "suitecrm-module",

  "require": {
    "isleshocky77/suitecrm-modules-installer": "^1.0"
  }
}
```

### Project

You can now include your dependency in the SuiteCrm Project. 

This can currently be done through one of two ways, and soon to be one of three.

#### Command Line

`composer require my/add-on-module`

### Update composer.json

Add your package to `composer.json` manually

```json
{
  "name": "salesagility/suitecrm",
  "description": "SuiteCRM",
  [..]
  "require": {
    "php": ">=5.6.0",
    [..]
    "soundasleep/html2text": "~0.5",
    "consolidation/robo": "^1.4",
    "my/add-on-module": "^1.0"
  },
  [..]
}
```

### Add composer.ext.json (not yet available)

If, and after [composer-merge-plugin] is added to the project through [PR#6950], you can just add a file named `composer.ext.json` to your root path.

```json
{
  "require": {
    "my/add-on-module": "^1.0"
  }
}
```

then run 

`composer update --lock`

## License ##

    suitecrm-modules-installer is licensed under GPLv3.

    suitecrm-modules-installer is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    suitecrm-modules-installer is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with suitecrm-modules-installer.  If not, see <http://www.gnu.org/licenses/>.


[SuiteCrm]: https://suitecrm.com
[composer]: https://getcomposer.org
[composer-merge-plugin]:https://github.com/wikimedia/composer-merge-plugin
[PR#6950]:https://github.com/salesagility/SuiteCRM/pull/6976
