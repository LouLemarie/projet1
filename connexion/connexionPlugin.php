
<?php
/*
Plugin Name: Connexion
Description: Permet de se connecter
Author: Lou Lemarié
Version: 1.0

*/



class connexionPlugin
{

    public function __construct()
    {

        require_once(plugin_dir_path(__FILE__) . '/connexion.php');

        add_action('widgets_init', function () {
            register_widget('connexionWidget');
        });

    }


}



register_activation_hook(__FILE__, array('connexionPlugin','pluginActivation'));
register_uninstall_hook(__FILE__, array('connexionPlugin','uninstall'));

add_action( 'plugins_loaded', function(){
    new connexionPlugin();
} );
?>
