<?php
/*****************************************************************************
*
*     system.inc.php
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

    'beep' => array(
      'description' => "Beeps one or more times.",
      'appleScript' => 'beep',
      'result' => "bool",
    ),

    'restart' => array(
      'description' => "Restart Mac",
      'appleScript' => "restart",
      'result' => "bool",
    ),

    'sleep' => array(
      'description' => "Set Mac to sleep",
      'appleScript' => "sleep",
      'result' => "bool",
    ),

    'shutdown' => array(
      'description' => "Shutdown Mac",
      'appleScript' => "shutdown",
      'result' => "bool",
    ),

    'getStatus' => array(
      'description' => "Gets overall system status",
      'appleScript' => "system info",
      'result' => "array",
    ),

    'displayDialog' => array(
      'description' => "Displays system dialog message",
      'appleScript' => "display dialog \"%ARG1%\"",
      'arguments' => array(
        '1' => array(
          'description' => "Message text",
          'type' => "string",
          'required' => true,
        ),
      ),
      'result' => "array",
    ),

    'displayNotification' => array(
      'description' => "Displays notification message",
      'appleScript' => "display notification",
      'arguments' => array(
        '1' => array(
          'description' => "Message text",
          'type' => "string",
          'required' => true,
          'appleScript' => " \"%ARG1%\"",
        ),
        '2' => array(
          'description' => "Title text",
          'type' => "string",
          'required' => false,
          'appleScript' => " with title \"%ARG2%\"",
        ),
        '3' => array(
          'description' => "Subtitle text",
          'type' => "string",
          'required' => false,
          'appleScript' => " subtitle \"%ARG3%\"",
        ),
        '4' => array(
          'description' => "Sound name",
          'type' => "string",
          'required' => false,
          'appleScript' => "with sound name \"%ARG4%\"",
        ),
      ),
      'result' => "array",
    ),

  ),
);
