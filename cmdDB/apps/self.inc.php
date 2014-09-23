<?php
/*****************************************************************************
*
*     self.inc.php
*     OSXControl self control file
*
*     Copyright by Julian Pawlowski
*     e-mail: julian.pawlowski at gmail.com
*
*     This file is part of JSON-OSXControl.
*
*     JSON-OSXControl is free software: you can redistribute it and/or modify
*     it under the terms of the GNU General Public License as published by
*     the Free Software Foundation, either version 2 of the License, or
*     (at your option) any later version.
*
*     This file is distributed in the hope that it will be useful,
*     but WITHOUT ANY WARRANTY; without even the implied warranty of
*     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*     GNU General Public License for more details.
*
*     You should have received a copy of the GNU General Public License
*     along with JSON-OSXControl.  If not, see <http://www.gnu.org/licenses/>.
*
*
* Version: 1.0.0
*
* Major Version History:
* - 1.0.0 - 2014-09-23
* -- First release
*
*****************************************************************************/

$app = array(
  'name' => "self",
  'description' => "controls JSON-OSXControl",
  'commands' => array(

    'update' => array(
      'description' => "Updates JSON-OSXControl from it's Git source",
      'shellScript' => '/usr/bin/git -C ' . dirname(__FILE__) . ' pull',
      'result' => "string",
    ),

  ),
);
