<?php
set_error_handler('handleErrors');
register_shutdown_function('handleFatalErrors');
function handleErrors($err_num, $err_msg, $err_file, $err_line) {
$today = new DateTime("now", new DateTimeZone('Europe/Kiev'));
$err_lvl = '';
switch ($err_num) {
  case 2: 
    $err_lvl = 'Warning';
    break;
  case 4: 
    $err_lvl = 'Parsing error';
    break;
  case 8: 
    $err_lvl = 'Notification';
    break;
  case 16: 
    $err_lvl = 'Core fatal error';
    break;
  case 32: 
    $err_lvl = 'Core warnigns';
    break;
  case 64: 
    $err_lvl = 'Compilation error';
    break;
  case 128: 
    $err_lvl = 'Compilation warning';
    break;
  default: 
    $err_lvl = 'Warning';
  }
  $error = $err_lvl . ': ' . $err_msg . ' in ' . $err_file . ' at line ' . $err_line . 
  ' Time: ' . $today->format('Y-m-d H:i:s') . " Stack trace: \n". 
  print_r(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 10), true) ."\n";
  error_log($error, 3, 'ErrorLog.log');
}
function handleFatalErrors() {
  $error = error_get_last();
  $err_lvl = '';
  $today = new DateTime("now", new DateTimeZone('Europe/Kiev'));
  switch ($error["type"]) {
    case 1:
      $err_lvl = 'Fatal error';
      break;
    case 4: 
      $err_lvl = 'Parsing error';
      break;
    case 16:
      $err_lvl = 'Core fatal error';
      break;
    case 64:
      $err_lvl = 'Compilation fatal error';
      break;
    default;
      return false;
  }
    $error = $err_lvl . ': ' . $error['message'] . ' in ' . $error['file'] . ' at line ' . $error['line'] . 
    ' Time: ' . $today->format('Y-m-d H:i:s') . " Stack trace: \n". 
    print_r(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 10), true) ."\n";
    error_log($error, 3, 'ErrorLog.log');
}
echo $e;

?>