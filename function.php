<?php

function session_start() {
    if ( !session_id() ) {
        session_start();
    }
}
add_action( 'init', 'session_start' );

function session_stop() {

    if ( isset( $_COOKIE[session_name()] ) ) {

        session_unset();   // détruit les variables de session

        session_destroy();

    }

}



add_action( 'wp_logout', 'session_stop' );
