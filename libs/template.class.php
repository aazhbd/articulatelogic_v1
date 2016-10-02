<?php

require_once(PATH . '/scripts/libs/Smarty.class.php');

class Template extends Smarty
{
    function Template()
    {
        $this->Smarty();
        $this->template_dir = PATH . '/interface/';
        $this->compile_dir = PATH . '/scripts/libs/compile/';
        $this->config_dir = PATH . '/scripts/libs/config/';
        $this->cache_dir = PATH . '/scripts/libs/cache/';
    }
}

?>
