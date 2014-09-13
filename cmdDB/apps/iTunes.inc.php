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
  'name' => "iTunes",
  'description' => "controls iTunes application",
  'commands' => array(

    'status' => array(
      'description' => "Gets overall status",
      'appleScript' => array(
        'if (number of track > 0 and number of artwork of current track > 0) then',
        'properties & properties of current track & properties of artwork 1 of current track',
        'else if (number of track > 0) then',
        'properties & properties of current track',
        'else',
        'properties',
        'end if',
      ),
      'result' => "array",
    ),

    'currentTrack' => array(
      'description' => "Gets current track information",
      'appleScript' => array(
        'if (number of track > 0 ) then',
        'properties of current track',
        'end if',
      ),
      'result' => "array",
    ),

    'currentArtwork' => array(
      'description' => "Gets current track artwork information",
      'appleScript' => array(
        'if (number of track > 0 and number of artwork of current track > 0) then',
        'properties of artwork 1 of current track',
        'end if',
      ),
      'result' => "array",
    ),

    "backTrack" => array(
      'description' => "reposition to beginning of current track or go to previous track if already at start of current track",
      'appleScript' => "back track",
      'result' => "bool",
    ),

    "fastForward" => array(
      'description' => "skip forward in a playing track",
      'appleScript' => "fast forward",
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

    "resume" => array(
      'description' => "disable fast forward/rewind and resume playback, if playing.",
      'appleScript' => "resume",
      'result' => "bool",
    ),

    "rewind" => array(
      'description' => "skip backwards in a playing track",
      'appleScript' => "rewind",
      'result' => "bool",
    ),

    "stop" => array(
      'description' => "stop playback",
      'appleScript' => "stop",
      'result' => "bool",
    ),

    "updateAllPodcasts" => array(
      'description' => "update all subscribed podcast feeds",
      'appleScript' => "updateAllPodcasts",
      'result' => "bool",
    ),

    "volumeUp" => array(
      'description' => "Turn volume up by 5%",
      'appleScript' => "set sound volume to sound volume + 5",
      'result' => "array",
    ),

    "volumeDown" => array(
      'description' => "Turn volume down by 5%",
      'appleScript' => "set sound volume to sound volume - 5",
      'result' => "array",
    ),

    "mute" => array(
      'description' => "Mute audio",
      'appleScript' => "set mute to yes",
      'result' => "bool",
    ),

    "unmute" => array(
      'description' => "Unmute audio",
      'appleScript' => "set mute to no",
      'result' => "bool",
    ),

  ),
);
