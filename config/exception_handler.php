<?php

set_exception_handler('exceptionHandler');

function exceptionHandler($e) {
    echo $e->getMessage() . "\n";
}