<?php
/*****************************************************************************
*
*     iTunes.inc.php
*     Apple Script definition file for OSXControl
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
* - 1.0.0 - 2014-09-14
* -- First release
*
*****************************************************************************/

$app = array(
  'name' => "System Events",
  'description' => "controls Mac OS X",
  'commands' => array(

    'restart' => array(
      'description' => "Restart Mac",
      'appleScript' => "restart",
      'result' => "array",
    ),

    'sleep' => array(
      'description' => "Set Mac to sleep",
      'appleScript' => "sleep",
      'result' => "array",
    ),

    'shutdown' => array(
      'description' => "Shutdown Mac",
      'appleScript' => "system info",
      'result' => "array",
    ),

    'status' => array(
      'description' => "Gets overall status",
      'appleScript' => "system info",
      'result' => "array",
    ),

    'displayDialog' => array(
      'description' => "Displays system dialog message",
      'appleScript' => "display dialog",
      'arguments' => array(
        '1' => array(
          'description' => "Message text",
          'type' => "string",
          'required' => true,
        ),
      ),
      'result' => "array",
    ),

  ),
);
