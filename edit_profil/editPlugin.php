

<?php
/*
Plugin Name: Edit Profil
Description: Outil d'édition de profil.
Author: Lou Lemarié
Version: 1.0
*/


class EditManagerPlugin {

    public function __construct(){

        require_once(plugin_dir_path(__FILE__).'/edit.php');
        add_action ('wp_loaded',array($this,'editProfil'));
        add_action ('widgets_init',function(){
            register_widget('EditManagerWidget');
        });



    }







    public function editProfil(){

        $current_user = wp_get_current_user();

        $userdata = array(
            'first_name' =>  $_POST['name'],
            'last_name'   =>  $_POST['firstName'],
            'user_pass'   =>  $_POST['password'],
            'ID'          =>  $current_user->ID,


        );
        wp_update_user ($userdata);
    }



}



register_activation_hook(__FILE__, array('EditManagerPlugin','pluginActivation'));
register_uninstall_hook(__FILE__, array('EditManagerPlugin','uninstall'));

add_action( 'plugins_loaded', function(){
    new EditManagerPlugin();
} );

