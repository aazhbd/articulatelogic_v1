<?php

class Errors{
    
    function Errors() {
    }
    
    static function report($msg) {
        $tp = new Template();
        $tp->assign('errmsg', $msg);
        $tp->display('error.tpl');
    }
}


?>
