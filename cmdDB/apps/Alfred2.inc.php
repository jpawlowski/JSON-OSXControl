<?php
/*****************************************************************************
*
*     Alfred2.inc.php
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
  'name' => "Alfred 2",
  'description' => "controls Alfred 2",
  'commands' => array(

    'getStatus' => array(
      'description' => "Gets overall status",
      'appleScript' => 'properties',
      'result' => "array",
    ),

    'search' => array(
      'description' => "Show Alfred 2 with the given text",
      'appleScript' => 'search "%ARG1%"',
      'result' => "string",
      'arguments' => array(
        '1' => array(
          'description' => "The search string to populate Alfred with",
          'type' => "string",
          'required' => true,
        ),
      ),
    ),

    'run' => array(
      'description' => "Run Alfred 2 workflow trigger",
      'appleScript' => 'run trigger "%ARG1%" in workflow "%ARG2%"',
      'result' => "string",
      'arguments' => array(
        '1' => array(
          'description' => "trigger name",
          'type' => "string",
          'required' => true,
        ),
        '2' => array(
          'description' => "The workflow bundle identifer",
          'type' => "string",
          'required' => true,
        ),
        '3' => array(
          'description' => "An optional argument",
          'type' => "string",
          'required' => false,
          'appleScript' => ' "%ARG3%"',
        ),
      ),
    ),

  ),
);
