<?php
/*****************************************************************************
*
*     JSON OSX Control
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

// Handle URI as GET/REQUEST input
$URI = explode('/', substr( parse_url($_SERVER['REQUEST_URI'] )['path'], strlen(dirname($_SERVER['PHP_SELF'])) + 1));
if (!empty($URI[0])) {
  if (!in_array($URI[0], array("app", "command", "arg1", "arg2", "arg3",
      "arg4", "arg5", "arg6", "arg7", "arg8", "arg9", "arg10"))) {
    $auth_token = array_shift($URI);
  }

  foreach ($URI as $key => $item) {
    if ($key % 2 != 0)
      continue;

    if (isset($URI[$key]) AND isset($URI[$key+1]) AND !empty($URI[$key]) AND !empty($URI[$key+1])) {
      $_GET[$URI[$key]] = $URI[$key+1];
      $_REQUEST[$URI[$key]] = $URI[$key+1];
    }
  }
}

// Load user tokens
if(file_exists(dirname(__FILE__).'/users.inc.php')) {
  include_once(dirname(__FILE__).'/users.inc.php');
} else {
  $users = array("CreateFile-users.inc.php-BeforeUse");
}

// Security check
if (!isset($auth_token) OR !isset($users) OR !is_array($users) OR !in_array($auth_token, $users)) {
  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));
  header('Content-type: application/json');

  echo '[{"app":null,"command":null, "msg":"Authentication failed", "result":"UNAUTHORIZED"}]';
  exit;
}

// Handle POST[json] or JSON-POST as REQUEST input
if (isset($_POST['json']) AND !empty($_POST['json']) AND preg_match('/^{.*}$/', $_POST['json'])) {
  $_REQUEST = array_merge($_REQUEST, json_decode($_POST['json'], true));
} elseif (isset($GLOBALS['HTTP_RAW_POST_DATA']) AND !empty($GLOBALS['HTTP_RAW_POST_DATA']) AND preg_match('/^{.*}$/', $GLOBALS['HTTP_RAW_POST_DATA'])) {
  $_POST = json_decode($GLOBALS['HTTP_RAW_POST_DATA'], true);
  $_REQUEST = array_merge($_REQUEST, $_POST);
}

// Load general Apple Script commands
if (isset($_REQUEST['app']) AND $_REQUEST['app'] != "self") {
  include_once(dirname(__FILE__).'/cmdDB/generic.inc.php');
  $commandDatabase['commands'] = $generic;
}

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
    'app' => null,
    'command' => null,
    'result' => "FATAL_ERROR",
    'msg' => "UNDEFINED_ERROR_HANDLING",
    'value' => false,
    'apps' => $definedApps,
  );

if (isset($_REQUEST['app']) && !empty($_REQUEST['app']) ) {
  $output = appControl();
} else {
  $output['result'] = "MISSING_APPLICATION_NAME";
  $output['msg'] = "Please specify an application to control.";
  if (isset($_REQUEST['command'])) {
    $output['command'] = $_REQUEST['command'];
  }
}

if (isset($output)) {
  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));

  if (isset($_REQUEST['jsoncallback'])) {
    header('Content-type: application/javascript');
    echo $_REQUEST['jsoncallback'] . '(['. json_encode($output) . '])';
  } else {
    header('Content-type: application/json');
    echo "[".json_encode($output)."]";
  }
};
exit;

// app control
function appControl()
{
  if (isset($GLOBALS['commandDatabase']['apps'][ $_REQUEST['app'] ])) {
    $app = $GLOBALS['commandDatabase']['apps'][ $_REQUEST['app'] ];
  } else {
    $app['name'] = $_REQUEST['app'];
  }

  if (isset($app['commands'])) {
    foreach ($app['commands'] as $key => $line) {
      $definedCmds[$key]['description'] = $line['description'];
    }
  }
  foreach ($GLOBALS['commandDatabase']['commands'] as $key => $line) {
    $definedCmds[$key]['description'] = $line['description'];
  }

  if (isset($_REQUEST['command']) && !empty($_REQUEST['command']) ) {
    $command = $_REQUEST['command'];

    if (isset($app['commands'][$command])) {
      $cmd = $app['commands'][$command];
    } elseif (isset($GLOBALS['commandDatabase']['commands'][$command])) {
      $cmd = $GLOBALS['commandDatabase']['commands'][$command];
    } else {
      return array(
        'app' => $_REQUEST['app'],
        'command' => $_REQUEST['command'],
        'result' => "INVALID_COMMAND",
        'msg' => "This is an invalid command to control this application.",
        'value' => false,
        'commands' => $definedCmds,
      );

    }

    // Checking for required arguments
    if (isset($cmd['arguments']) AND is_array($cmd['arguments'])) {
      foreach ($cmd['arguments'] as $argNr => $arg) {
        if ($cmd['arguments'][$argNr]['required'] == true AND !isset($_REQUEST['arg'.$argNr])) {
          return array(
            'app' => $_REQUEST['app'],
            'command' => $_REQUEST['command'],
            'result' => "MISSING_ARGUMENT",
            'msg' => "Argument $argNr \"".$cmd['arguments'][$argNr]['description']."\" is required but was not provided.",
            'value' => false,
          );
        }
      }
    }

    // generate osascript command
    //

    if (isset($cmd['appleScript'])) {

      // add "tell app" as default if command does not handle it
      if (isset($cmd['type']) AND $cmd['type'] == "standalone") {
        $osaCmd = "sudo /usr/bin/osascript";
      } else {
        $osaCmd = "sudo /usr/bin/osascript -e 'tell app \"" . $app['name'] . "\"'";
      }

      // loop through the Apple Script lines if command uses array
      if (is_array($cmd['appleScript'])) {
        foreach ($cmd['appleScript'] as $key => $line) {
          $osaCmd .= " -e '" . $line . "'";
        }

      // add single line Apple Script command if command does not use array
      } else {
        $osaCmd .= " -e '" . $cmd['appleScript'];
      }

      // add Apple Script from arguments
      if (isset($cmd['arguments']) AND is_array($cmd['arguments'])) {
        foreach ($cmd['arguments'] as $argNr => $arg) {
          if (isset($_REQUEST['arg'.$argNr]) AND !empty($_REQUEST['arg'.$argNr])) {

            // loop through the Apple Script lines if command uses array
            if (isset($cmd['arguments'][$argNr]['appleScript']) AND is_array($cmd['arguments'][$argNr]['appleScript'])) {
              foreach ($cmd['arguments'][$argNr]['appleScript'] as $key => $line) {
                $osaCmd .= " -e '$line'";
              }

            // add single line Apple Script command if command does not use array
            } elseif(isset($cmd['arguments'][$argNr]['appleScript'])) {
              $osaCmd .= $cmd['arguments'][$argNr]['appleScript'];
            }

          }
        }
      }

      if (!is_array($cmd['appleScript'])) {
        $osaCmd .= "'";
      }

      // add "end tell" as default if command does not handle it
      if (!isset($cmd['type']) OR $cmd['type'] != "standalone") {
        $osaCmd .= " -e 'end tell'";
      }

      // replace placeholders
      $osaCmd = str_replace('%APP%', $app['name'], $osaCmd);
      if (isset($cmd['arguments']) && is_array($cmd['arguments'])) {
        foreach ($cmd['arguments'] as $argNr => $arg) {
          if (isset($_REQUEST['arg'.$argNr]) AND !empty($_REQUEST['arg'.$argNr])) {
            $osaCmd = str_replace('%ARG'.$argNr.'%', $_REQUEST['arg'.$argNr], $osaCmd);
          }
        }
      }

      // execute osascript
      //

      exec($osaCmd . " 2>&1", $resultText, $resultCode);

      if ($resultCode > 0) {
        $result = "OSASCRIPT_ERROR";
        $msg = $resultText[0] . " [" . $osaCmd . "]";
        $value = false;
      } else {
        $result = "SUCCESS";
        $msg = null;

        if ($cmd['result'] == "array" OR $cmd['result'] == "string") {
          # special handling for date fields
          if (!empty($resultText[0])) {
            $resultText = preg_replace("/:(date\ )([A-Z]\w+)(,\ )([0-9]+\.\ )/", ":$2\\,,$4", $resultText[0]);
          } else {
            $resultText = "";
          }

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

              if (!empty($lineKey) AND $lineKey != "class") {
                $converted[$lineKey] = $lineValue;
              }
            }
          } else {
            $converted = $resultText;
          }

          if (empty($converted)) {
            $value = true;
          } else {
            $value = $converted;
          }
        } else {
          $value = true;
        }
      };

      return array(
        'app' => $_REQUEST['app'],
        'command' => $_REQUEST['command'],
        'result' => $result,
        'msg' => $msg,
        'value' => $value,
      );
    }

    // generate shellscript command
    //

    elseif (isset($cmd['shellScript'])) {

      // loop through the script lines if command uses array
      if (is_array($cmd['shellScript'])) {
        foreach ($cmd['shellScript'] as $key => $line) {
          $shCmd .= " " . $line;
        }

      // add single line Apple Script command if command does not use array
      } else {
        $shCmd .= " " . $cmd['shellScript'];
      }

      // add Apple Script from arguments
      if (is_array($cmd['arguments'])) {
        foreach ($cmd['arguments'] as $argNr => $arg) {
          if (isset($_REQUEST['arg'.$argNr]) AND !empty($_REQUEST['arg'.$argNr])) {

            // loop through the Apple Script lines if command uses array
            if (is_array($cmd['arguments'][$argNr]['shellScript'])) {
              foreach ($cmd['arguments'][$argNr]['shellScript'] as $key => $line) {
                $shCmd .= " " . $line;
              }

            // add single line Apple Script command if command does not use array
            } else {
              $shCmd .= $cmd['arguments'][$argNr]['shellScript'];
            }

          }
        }
      }

      // replace placeholders
      $shCmd = str_replace('%APP%', $app['name'], $shCmd);
      if (is_array($cmd['arguments'])) {
        foreach ($cmd['arguments'] as $argNr => $arg) {
          if (isset($_REQUEST['arg'.$argNr]) AND !empty($_REQUEST['arg'.$argNr])) {
            $shCmd = str_replace('%ARG'.$argNr.'%', $_REQUEST['arg'.$argNr], $shCmd);
          }
        }
      }

      // execute shellscript
      //

      exec($shCmd . " 2>&1", $resultText, $resultCode);

      if ($resultCode > 0) {
        $result = "SHELLSCRIPT_ERROR";
        $msg = $resultText[0] . " [" . $shCmd . "]";
        $value = false;
      } else {
        $result = "SUCCESS";
        $msg = null;

        if ($cmd['result'] == "string") {

          if (empty($resultText)) {
            $value = true;
          } else {
            $value = $resultText;
          }

        } else {
          $value = true;
        }
      };

      return array(
        'app' => $_REQUEST['app'],
        'command' => $_REQUEST['command'],
        'result' => $result,
        'msg' => $msg,
        'value' => $value,
      );
    }

  } else {
      return array(
        'app' => $_REQUEST['app'],
        'command' => null,
        'result' => "MISSING_COMMAND_NAME",
        'msg' => "Please specify a command.",
        'commands' => $definedCmds,
      );
  }

}
