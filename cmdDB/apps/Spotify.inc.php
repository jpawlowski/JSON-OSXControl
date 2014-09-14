<?php
/*****************************************************************************
*
*     spotify.inc.php
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
  'name' => "Spotify",
  'description' => "controls Spotify music application",
  'commands' => array(

    'getStatus' => array(
      'description' => "Gets overall status",
      'appleScript' => array(
        'if ((current track) is not "missing value") then',
        'properties & properties of current track',
        'else',
        'properties',
        'end if',
      ),
      'result' => "array",
    ),

    'getFrontmost' => array(
      'description' => "Frontmost/active application",
      'appleScript' => 'frontmost',
      'result' => "string",
    ),

    'getCurrentTrack' => array(
      'description' => "Gets current track information",
      'appleScript' => array(
        'if ((current track) is not "missing value") then',
        'properties of current track',
        'end if',
      ),
      'result' => "array",
    ),

    'getCurrentArtwork' => array(
      'description' => "Gets current track artwork information",
      'appleScript' => array(
        'if ((current track) is not "missing value") then',
        'artwork of current track',
        'end if',
      ),
      'result' => "array",
    ),

    "setPlayTrack" => array(
      'description' => "play a specific track",
      'appleScript' => "play track",
      'arguments' => array(
        '1' => array(
          'description' => "Track address",
          'type' => "string",
          'required' => true,
        ),
      ),
      'result' => "bool",
    ),

    "setPlayerPosition" => array(
      'description' => "jump to a specific time index of current song",
      'appleScript' => "set player position to",
      'arguments' => array(
        '1' => array(
          'description' => "time index",
          'type' => "integer",
          'required' => true,
        ),
      ),
      'result' => "bool",
    ),

    "setRepeating" => array(
      'description' => "control repeating",
      'appleScript' => "set repeating to",
      'arguments' => array(
        '1' => array(
          'description' => "turn repeating on or off",
          'type' => "bool",
          'required' => true,
        ),
      ),
      'result' => "bool",
    ),

    "setShuffling" => array(
      'description' => "control shuffling",
      'appleScript' => "set shuffling to",
      'arguments' => array(
        '1' => array(
          'description' => "turn repeating on or off",
          'type' => "bool",
          'required' => true,
        ),
      ),
      'result' => "bool",
    ),

    "nextTrack" => array(
      'description' => "advance to the next track in the current playlist",
      'appleScript' => "next track",
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

    "previousTrack" => array(
      'description' => "return to the previous track in the current playlist",
      'appleScript' => "previous track",
      'result' => "bool",
    ),

    "setVolume" => array(
      'description' => "Set volume tp specific level",
      'appleScript' => "set sound volume to %ARG1%",
      'arguments' => array(
        '1' => array(
          'description' => "Volume in percent",
          'type' => "string",
          'required' => true,
        ),
      ),
      'result' => "bool",
    ),

    "volumeUp" => array(
      'description' => "Turn volume up by 5%",
      'appleScript' => "set sound volume to sound volume + 5",
      'result' => "bool",
    ),

    "volumeDown" => array(
      'description' => "Turn volume down by 5%",
      'appleScript' => "set sound volume to sound volume - 5",
      'result' => "bool",
    ),

  ),
);
