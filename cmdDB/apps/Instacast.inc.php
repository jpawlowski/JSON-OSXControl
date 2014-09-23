<?php
/*****************************************************************************
*
*     Instacast.inc.php
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
  'name' => "Instacast",
  'description' => "controls Instacast podcast application",
  'commands' => array(

    'getStatus' => array(
      'description' => "Gets overall status",
      'appleScript' => array(
        'properties',
      ),
      'result' => "array",
    ),

    'getCurrentTrack' => array(
      'description' => "Gets current podcast information",
      'appleScript' => array(
        'properties of current episode',
      ),
      'result' => "array",
    ),

    'getCurrentArtwork' => array(
      'description' => "Gets current track artwork information",
      'appleScript' => array(
        'artwork of current episode',
      ),
      'result' => "array",
    ),

    "skipForward" => array(
      'description' => "jump 30sec forward",
      'appleScript' => "skip forward",
      'result' => "bool",
    ),

    "pause" => array(
      'description' => "pause playback",
      'appleScript' => "pause",
      'result' => "bool",
    ),

    "play" => array(
      'description' => "play the current track or the specified track or file.",
      'appleScript' => "play",
      'result' => "bool",
    ),

    "playPause" => array(
      'description' => "toggle the playing/paused state of the current track",
      'appleScript' => "playpause",
      'result' => "bool",
    ),

    "skipBackward" => array(
      'description' => "jump 30sec backward",
      'appleScript' => "skip backward",
      'result' => "bool",
    ),

    "volumeUp" => array(
      'description' => "Turn volume up",
      'appleScript' => "volume up",
      'result' => "bool",
    ),

    "volumeDown" => array(
      'description' => "Turn volume down",
      'appleScript' => "volume down",
      'result' => "bool",
    ),

  ),
);
