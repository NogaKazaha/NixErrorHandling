<?php
class ExceptionHandler extends Exception {
  public function errorMessage() {
    $today = new DateTime("now", new DateTimeZone('Europe/Kiev'));
    $errorMsg = 'Code: ' . $this->getCode() . ' on line '.$this->getLine().' in file '. $this->getFile()
    .' Message: '.$this->getMessage() . ' Time: ' . $today->format('Y-m-d H:i:s') ." Stack trace: \n". 
    print_r(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 10), true) ."\n";;
    error_log($errorMsg, 3, './ErrorLog.log');
  }
}
$err = 1;
try {
  if($err != 2) {
    throw new ExceptionHandler();
  }
} catch (ExceptionHandler $e) {
  echo $e->errorMessage();
}
?>