<?php

class helloController extends Controller
{
    function index()
    {
        require( MODELPATH.'Hello.php' );

        $hello = new Hello();

        $d['hello'] = $hello->sayHello();
        $this->set($d);
        $this->render("hello");
    }

}