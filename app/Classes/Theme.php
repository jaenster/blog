<?php


namespace App\Classes;


class Theme
{
    public $name,$path,$navbar;
    public function __construct($name)
    {
        $this->name = $name;
        $this->navbar = 'themes.'.$name.'.navbar';
        $this->layout = 'themes.'.$name.'.app';



    }
}