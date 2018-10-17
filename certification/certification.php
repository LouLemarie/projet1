<?php
/*
Plugin Name: Certification
Description: Plugin pour ajouter une certification
*/



class CertificationPlugin {

    public function __construct(){

        require_once(plugin_dir_path(__FILE__).'/certificationExt.php');
        add_action ('wp_loaded',array($this,'addNewCertification'));
        add_action ('widgets_init',function(){
            register_widget('CertificationWidget');
        });

        add_shortcode('register_form', array($this, 'shortcodeAction'));
    }


    public static function pluginActivation(){
        global $wpdb;

        $wpdb->query('CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'certification (id INT AUTO_INCREMENT PRIMARY KEY, titre VARCHAR(255),annee DATE,)');
    }


    public static function uninstall(){
        global $wpdb;
        $wpdb->query('DROP TABLE IF EXISTS '.$wpdb->prefix.'certification');
    }


    public function addNewCertification(){
        if(isset($_POST['titre'])) {
            global $wpdb;
            $wpdb->query($wpdb->prepare('INSERT INTO ' . $wpdb->prefix . 'certification(titre,annee) VALUES(%s,%s)', $_POST['titre'], $_POST['annee']));
            $this->displayMsg('Certification ajoutée');

            }
        }



    public function displayMsg($msg){

        add_action('wp_enqueue_scripts',function() use ($msg){
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    alert('<?php echo $msg; ?>');
                });
            </script>
            <?php
        });
    }

    public function shortcodeAction(){
        the_widget('memberManager-widget');
    }
}

