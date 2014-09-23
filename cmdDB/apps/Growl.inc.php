<?php
/*****************************************************************************
*
*     Growl.inc.php
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
* - 1.0.0 - 2014-09-23
* -- First release
*
*****************************************************************************/

$app = array(
  'name' => "Growl",
  'description' => "controls Growl application",
  'commands' => array(

    'getStatus' => array(
      'description' => "Gets overall status",
      'appleScript' => array(
        'properties',
      ),
      'result' => "array",
    ),

    'closeAll' => array(
      'description' => "close all on-screen notifications",
      'appleScript' => 'close all notifications',
      'result' => "bool",
    ),

    'pause' => array(
      'description' => "Stops display of incoming notifications",
      'appleScript' => 'pause',
      'result' => "bool",
    ),

    'resume' => array(
      'description' => "Starts display of subsequent incoming notifications",
      'appleScript' => 'resume',
      'result' => "bool",
    ),

    'disableNetwork' => array(
      'description' => "Disables incoming network notifications",
      'appleScript' => 'disable incoming network',
      'result' => "bool",
    ),

    'enableNetwork' => array(
      'description' => "Enables incoming network notifications",
      'appleScript' => 'enable incoming network',
      'result' => "bool",
    ),

    'showRollup' => array(
      'description' => "Shows the notification rollup",
      'appleScript' => 'show rollup',
      'result' => "bool",
    ),

    'hideRollup' => array(
      'description' => "Hides the notification rollup",
      'appleScript' => 'hide rollup',
      'result' => "bool",
    ),

    'notify' => array(
      'description' => "Post a notification to be displayed via Growl",
      'appleScript' => "notify",
      'arguments' => array(
        '1' => array(
          'description' => "name of the notification to display",
          'type' => "string",
          'required' => true,
          'appleScript' => " with name \"%ARG1%\"",
        ),
        '2' => array(
          'description' => "title of the notification to display",
          'type' => "string",
          'required' => true,
          'appleScript' => " title \"%ARG2%\"",
        ),
        '3' => array(
          'description' => "full text of the notification to display",
          'type' => "string",
          'required' => true,
          'appleScript' => " description \"%ARG3%\"",
        ),
        '4' => array(
          'description' => "name of the application posting the notification",
          'type' => "string",
          'required' => true,
          'appleScript' => " application name \"%ARG4%\"",
        ),
        '5' => array(
          'description' => "Location of the file whose icon should be used as the image for this notification. Accepts aliases, paths and file:/// URLs. e.g. 'file:///Applications'.",
          'type' => "string",
          'required' => false,
          'appleScript' => " icon of file \"%ARG5%\"",
        ),
        '6' => array(
          'description' => "Name of the application whose icon should be used for this notification. For example, 'Mail.app'.",
          'type' => "string",
          'required' => false,
          'appleScript' => " icon of application \"%ARG6%\"",
        ),
        '7' => array(
          'description' => "TIFF Image to be used for the notification.",
          'type' => "string",
          'required' => false,
          'appleScript' => " image \"%ARG7%\"",
        ),
        '8' => array(
          'description' => "whether or not the notification displayed should remain on screen until the user dispenses with it. Defaults to false.",
          'type' => "bool",
          'required' => false,
          'appleScript' => " sticky %ARG8%",
        ),
        '9' => array(
          'description' => "The priority of the notification, from -2 (low) to 0 (normal) to 2 (emergency).",
          'type' => "integer",
          'required' => false,
          'appleScript' => " priority %ARG9%",
        ),
        '10' => array(
          'description' => "The identifier of the notification for coalescing.",
          'type' => "string",
          'required' => false,
          'appleScript' => " identifier %ARG10%",
        ),
        '11' => array(
          'description' => "A URL to open when the notification is clicked.",
          'type' => "string",
          'required' => false,
          'appleScript' => " callback URL \"%ARG11%\"",
        ),
      ),
      'result' => "array",
    ),

  ),
);
