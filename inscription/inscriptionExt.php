

<?php
/*
Plugin Name: Inscription
Description: Plugin pour enregistrer l'utilisateur
Author: Lou Lemarié
Version: 1.0

*/



class UsersManagerPlugin {

    public function __construct(){

        require_once(plugin_dir_path(__FILE__).'/inscription.php');
        add_action ('wp_loaded',array($this,'addNewUser'));
        add_action ('widgets_init',function(){
            register_widget('UsersManagerWidget');
        });

        add_shortcode('register_form', array($this, 'shortcodeAction'));
    }


    public function addNewUser(){

        $userdata = array(
            'first_name' =>  $_POST['name'],
            'last_name'   =>  $_POST['firstName'],
            'user_email'  =>  $_POST['email'],
            'user_login'  => $_POST['email'],
            'user_pass'   =>  $_POST['password'],

        );

        wp_insert_user($userdata);


    }


    public function shortcodeAction(){
        the_widget('memberManager-widget');
    }
}



register_activation_hook(__FILE__, array('UsersManagerPlugin','pluginActivation'));
register_uninstall_hook(__FILE__, array('UsersManagerPlugin','uninstall'));

add_action( 'plugins_loaded', function(){
    new UsersManagerPlugin();
} );
?>

