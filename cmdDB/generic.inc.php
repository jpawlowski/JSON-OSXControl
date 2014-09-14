<?php
/*****************************************************************************
*
*     generic.inc.php
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

$generic = array(

  'getStatus' => array(
    'description' => "General status information",
    'type' => 'standalone',
    'appleScript' => array(
      'on ApplicationIsRunning(appName)',
      'tell application "System Events" to set appNameIsRunning to exists (processes where name is appName)',
      'return appNameIsRunning',
      'end ApplicationIsRunning',
      'if ApplicationIsRunning("%APP%") then',
      'return "running:true"',
      'else',
      'return "running:false"',
      'end if',
    ),
    'result' => "array",
  ),

  'launch' => array(
    'description' => "Launches the Application",
    'appleScript' => 'launch',
    'result' => "bool",
  ),

  'close' => array(
    'description' => "Closes every application window",
    'appleScript' => 'close every window',
    'result' => "bool",
  ),

  'quit' => array(
    'description' => "Quits the Application",
    'appleScript' => 'quit',
    'result' => "bool",
  ),

  'activate' => array(
    'description' => "Activates the Application",
    'appleScript' => 'activate',
    'result' => "bool",
  ),

  'keystroke' => array(
    'description' => "cause the target process to behave as if keystrokes were entered",
    'appleScript' => "keystroke %ARG1%",
    'arguments' => array(
      '1' => array(
        'description' => "The keystrokes to be sent.",
        'type' => "string",
        'required' => true,
      ),
    ),
    'result' => "bool",
  ),

  'perform' => array(
    'description' => "cause the target process to behave as if the action were applied to its UI element",
    'appleScript' => "perform %ARG1%",
    'arguments' => array(
      '1' => array(
        'description' => "The action to be performed.",
        'type' => "string",
        'required' => true,
      ),
    ),
    'result' => "bool",
  ),

  'select' => array(
    'description' => "set the selected property of the UI element",
    'appleScript' => "select %ARG1%",
    'arguments' => array(
      '1' => array(
        'description' => "The UI element to be selected.",
        'type' => "string",
        'required' => true,
      ),
    ),
    'result' => "bool",
  ),

  'getVersion' => array(
    'description' => "Gets version of application",
    'appleScript' => 'version',
    'result' => "string",
  ),

  'getProperties' => array(
    'description' => "Gets properties of application",
    'appleScript' => 'properties',
    'result' => "array",
  ),

);
