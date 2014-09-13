<?php
// START: Generic commands
$generic = array(

  'launch' => array(
    'description' => "Launches the Application",
    'appleScript' => 'launch',
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

  'beep' => array(
    'description' => "Beeps one or more times.",
    'appleScript' => 'beep',
    'result' => "bool",
  ),

  'properties' => array(
    'description' => "Gets properties of application",
    'appleScript' => 'properties',
    'result' => "array",
  ),

); // END: Generic commands
