<?php

class Hello extends Model {

    public function __construct() {}

    public function sayHello() {
        $post = R::dispense( 'post' );
        $post->title = 'My holiday';
        $id = R::store( $post );

        return '<h1>Hola mundo</h1>';
    }
}