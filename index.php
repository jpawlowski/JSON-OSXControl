<?php

// Load general Apple Script commands
include_once(dirname(__FILE__).'/cmdDB/generic.inc.php');
$commandDatabase['commands'] = $generic;

# Load Application specific commands
$appConfs = glob(dirname(__FILE__).'/cmdDB/apps/*.inc.php', GLOB_BRACE);
foreach ($appConfs as $file) {
  include_once($file);
  $appShortName = preg_replace('/\\.inc.php$/', '', basename($file));
  $commandDatabase['apps'][$appShortName] = $app;
  $commandDatabase['apps'][$appShortName]['extensionFilename'] = basename($file);
}

foreach ($commandDatabase['apps'] as $key => $line) {
  $definedApps[$key]['name'] = $line['name'];
  $definedApps[$key]['description'] = $line['description'];
}

# default output data
$output = array(
    'app' => $_GET['app'],
    'command' => $_GET['command'],
    'result' => "FATAL_ERROR",
    'msg' => "INDEFINED_ERROR_HANDLING",
    'value' => false,
    'apps' => $definedApps,
  );

if (isset($_GET['app']) && !empty($_GET['app']) ) {

  if (is_array( $commandDatabase['apps'][ $_GET['app'] ] )) {
    $output = appControl();
  } else {
    $output['result'] = "NOT_IMPLEMENTED";
    $output['msg'] = "Control of application '".$_GET['app']."' is not implemented.";
  }
} else {
  $output['result'] = "MISSING_APPLICATION_NAME";
  $output['msg'] = "Please specify an application to control.";
}

if (isset($output)) {
  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));
  header('Content-type: application/json');

  if (isset($_GET['jsoncallback'])) {
    echo $_GET['jsoncallback'] . '('. json_encode($output) . ')';
  } else {
    echo json_encode($output);
  }
};
exit;

// app control
function appControl()
{
  if (isset($_GET['command']) && !empty($_GET['command']) ) {
    $app = $GLOBALS['commandDatabase']['apps'][ $_GET['app'] ];
    $command = $_GET['command'];

    foreach ($app['commands'] as $key => $line) {
      $definedCmds[$key]['description'] = $line['description'];
      $definedCmds[$key]['result'] = $line['result'];
    }
    foreach ($GLOBALS['commandDatabase']['commands'] as $key => $line) {
      $definedCmds[$key]['description'] = $line['description'];
      $definedCmds[$key]['result'] = $line['result'];
    }

    if (isset($app['commands'][$command])) {
      $cmd = $app['commands'][$command];
    } elseif (isset($GLOBALS['commandDatabase']['commands'][$command])) {
      $cmd = $GLOBALS['commandDatabase']['commands'][$command];
    } else {
      return array(
        'app' => $_GET['app'],
        'command' => $_GET['command'],
        'result' => "INVALID_COMMAND",
        'msg' => "This is an invalid command to control this application.",
        'value' => false,
        'commands' => $definedCmds,
      );

    }

    if (is_array($cmd['appleScript'])) {
      $osaCmd = "osascript -e 'tell app \"" . $app['name'] . "\"'";
      foreach ($cmd['appleScript'] as $key => $line) {
        $osaCmd .= " -e '$line'";
      }
      $osaCmd .= " -e 'end tell'";
    } else {
      $osaCmd = "osascript -e 'tell app \"" . $app['name'] . "\" to " . $cmd['appleScript'] . "'";
    }

    exec($osaCmd, $resultText, $resultCode);

    if ($resultCode > 0) {
      $result = "ERROR";
      $msg = $resultText;
      $value = false;
    } else {
      $result = "SUCCESS";
      $msg = null;

      if ($cmd['result'] == "array" OR $cmd['result'] == "string") {
        # special handling for date fields
        $resultText = preg_replace("/:(date\ )([A-Z]\w+)(,\ )([0-9]+\.\ )/", ":$2\\,,$4", $resultText[0]);

        # special handling for data fields
        $resultText = preg_replace("/(«data )(.*)(»)/", "$2", $resultText);

        if ($cmd['result'] == "array") {
          # create Array
          $resArray = explode(', ', $resultText);

          foreach ($resArray as $key => $line) {
            $lineKey = preg_replace("/(.*?):(.*)/", "$1", $line);
            $lineValue = preg_replace("/(.*?):(.*)/", "$2", $line);

            # correct date fields
            $lineValue = preg_replace("/(\\\,,)/", ", ", $lineValue);

            # handle missing values as being nil
            if ($lineValue == "missing value") {
              $lineValue = null;
            }

            if ($lineKey != "class") {
              $converted[$lineKey] = $lineValue;
            }
          }
        } else {
          $converted = $resultText;
        }

        $value = $converted;
      } else {
        $value = true;
      }
    };

    return array(
      'app' => $_GET['app'],
      'command' => $_GET['command'],
      'result' => $result,
      'msg' => $msg,
      'value' => $value,
    );

  } else {
      return array(
        'app' => $_GET['app'],
        'command' => $_GET['command'],
        'result' => "MISSING_COMMAND_NAME",
        'msg' => "Please specify a command.",
        'commands' => $definedCmds,
      );
  }

}
