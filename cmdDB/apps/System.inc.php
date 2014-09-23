<?php
/*****************************************************************************
*
*     System.inc.php
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

    "mute" => array(
      'description' => "Mute system audio",
      'appleScript' => "set volume with output muted",
      'result' => "bool",
    ),

    "unmute" => array(
      'description' => "Unmute system audio",
      'appleScript' => "set volume without output muted",
      'result' => "bool",
    ),

    "setVolume" => array(
      'description' => "Set volume to specific level",
      'appleScript' => "set volume output volume %ARG1% --100%",
      'arguments' => array(
        '1' => array(
          'description' => "Volume in percent",
          'type' => "integer",
          'required' => true,
        ),
      ),
      'result' => "bool",
    ),

    "volumeUp" => array(
      'description' => "Turn volume up by 5%",
      'appleScript' => "set volume output volume (output volume of (get volume settings) + 5) --100%",
      'result' => "bool",
    ),

    "volumeDown" => array(
      'description' => "Turn volume down by 5%",
      'appleScript' => "set volume output volume (output volume of (get volume settings) - 5) --100%",
      'result' => "bool",
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
          'appleScript' => " with sound name \"%ARG4%\"",
        ),
      ),
      'result' => "array",
    ),

    'say' => array(
      'description' => "Speak message",
      'appleScript' => "say",
      'arguments' => array(
        '1' => array(
          'description' => "Message text",
          'type' => "string",
          'required' => true,
          'appleScript' => " \"%ARG1%\"",
        ),
        '2' => array(
          'description' => "voice name",
          'type' => "string",
          'required' => false,
          'appleScript' => " using \"%ARG2%\"",
        ),
        '3' => array(
          'description' => "speaking rate",
          'type' => "integer",
          'required' => false,
          'appleScript' => " speaking rate \"%ARG3%\"",
        ),
        '4' => array(
          'description' => "pitch",
          'type' => "integer",
          'required' => false,
          'appleScript' => " pitch \"%ARG4%\"",
        ),
        '5' => array(
          'description' => "modulation",
          'type' => "integer",
          'required' => false,
          'appleScript' => " modulation \"%ARG5%\"",
        ),
        '6' => array(
          'description' => "volume",
          'type' => "integer",
          'required' => false,
          'appleScript' => " volume \"%ARG6%\"",
        ),
        '7' => array(
          'description' => "stopping current speech",
          'type' => "bool",
          'required' => false,
          'appleScript' => " with stopping current speech",
        ),
      ),
      'result' => "array",
    ),

  ),
);
