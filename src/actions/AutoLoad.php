<?php

class AutoLoad
{
    private $files;

    public function __construct()
    {
        spl_autoload_register([$this, 'folders']);
    }

    private function folders($file) 
    {
        $this->files = [
            'actions/'.$file.'.php',
            'entities/'.$file.'.php',
            'interfaces/'.$file.'.php',
        ];

        foreach($this->files as $file):

            if(file_exists($file)):

                require_once $file;

            endif;

        endforeach;
    }
}

new AutoLoad;