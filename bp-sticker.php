<?php

/*
 * Plugin Name: Bp Stickers
 * Version: 1.0
 * Author: asghar hatampoor
 * Author URI: http://webcaffe.ir
 * Plugin URI: http://Webcaffe.ir
 * Description: Allow Users to add stickers in activity posts and message by clicking on icons
 */
if ( !defined( 'ABSPATH' ) ) exit;

if ( !defined( 'BPST_PLUGIN_VERSION' ) )
	define( 'BPST_PLUGIN_VERSION', '1.0.0' );

if ( !defined( 'BPST_PLUGIN_DIRNAME' ) )
	define( 'BPST_PLUGIN_DIRNAME', basename( dirname( __FILE__ ) ) );
	

if ( !defined( 'BPST_PLUGIN_DIR' ) )
	define( 'BPST_PLUGIN_DIR', trailingslashit( WP_PLUGIN_DIR . '/' . BPST_PLUGIN_DIRNAME ) );

if ( !defined( 'BPST_PLUGIN_URL' ) ) {
	$plugin_url = trailingslashit( plugins_url( BPST_PLUGIN_DIRNAME ) );
	define( 'BPST_PLUGIN_URL', $plugin_url );
}

class BpStickers{
    private static  $instance;
    private function __construct(){
      add_action('wp_enqueue_scripts',  array($this,'load_js'));
      add_action('wp_print_styles',  array($this,'load_css')); 	  
      add_action('bp_before_activity_post_form',array($this,'list_stickers'));  
      add_action('bp_activity_entry_comments',array($this,'list_stickers'));  
	  add_action('bp_after_messages_compose_content',array($this,'list_stickers')); 
      add_action('bp_after_message_reply_box',array($this,'list_stickers')); 	  
	 add_filter( 'bp_get_activity_latest_update',array($this, 'bp_st_translate_sticker')); 
	 add_filter( 'bp_get_activity_latest_update_excerpt',array($this, 'bp_st_translate_sticker')); 
	 add_filter( 'bp_get_activity_content_body',array($this, 'bp_st_translate_sticker'));
     add_filter( 'bp_get_activity_action',array($this, 'bp_st_translate_sticker')); 	 
	 add_filter( 'bp_get_activity_content',array($this, 'bp_st_translate_sticker')); 
	 add_filter( 'bp_get_activity_parent_content',array($this, 'bp_st_translate_sticker' )); 	
     add_filter( 'bp_get_the_thread_message_content',array($this, 'bp_st_translate_sticker' )); 
	 add_filter( 'bp_get_message_thread_excerpt',array($this, 'bp_st_translate_sticker' ));
	

    }
function load_js(){
      $url= BPST_PLUGIN_URL. 'js/bp-sticker.js';     
      wp_enqueue_script('bp-sticker-js',$url,array('jquery'));
    }
    
function load_css(){
	 $url= BPST_PLUGIN_URL. 'css/bp-sticker.css';
     wp_enqueue_style('bp-stiker-css',$url, array(),BPST_PLUGIN_VERSION,'all');
    }
public static function get_instance(){
        if(!isset (self::$instance))
                self::$instance=new self();
        return self::$instance;
    }
public static function list_stickers($message){
	global $bp;	
	  $html ="<span class='bp-smiley-button'>
	  <a class='buddypress-smiley-button' rel='nofollow'></a>
	  </span>
	  <div class='smiley-buttons'style='display: none;'>"; 
	 
	 foreach (self::replace_with_st() as $codes => $imgs) {     
		 $icon = BPST_PLUGIN_URL. 'images/sticons/'. $imgs.'';
		 $html.="<img src='$icon' data-code='$codes' class='smiley' /> ";
          }
	
	 $html .="</div>"; 
     echo apply_filters( 'list_stickers',$html);	
    }

function replace_with_st(){      
			if ( !isset( $icons ) ) {
        $icons = array(
            ':A:' => "st_1.png",
            ':B:' => "st_2.png",
            ':C:' => "st_3.png",
            ':D:' => "st_4.png",
            ':F:' => "st_5.png",
            ':G:' => "st_6.png",
            ':H:' => "st_7.png",
            ':I:' => "st_8.png",
            ':J:' => "st_9.png",
            ':K:' => "st_10.png",
            ':L:' => "st_11.png",
            ':M:' => "st_12.png",
            ':N:' => "st_13.png",
            ':O:' => "st_14.png",
            ':P:' => "st_15.png",
            ':Q:' => "st_16.png",
            ':R:' => "st_17.png",
			':S:' => "st_18.png",
			':T:' => "st_19.png",
			':U:' => "st_20.png",
			':V:' => "st_21.png",
			':W:' => "st_22.png",
			':X:' => "st_23.png",
			':Y:' => "st_24.png",
			':Z:' => "st_25.png",
			':AA:' => "st_26.png",
			':AB:' => "st_27.png",
			':AC:' => "st_28.png",
			':AD:' => "st_29.png",
			':AF:' => "st_30.png",
			':AG:' => "st_31.png",
			':AH:' => "st_32.png",
			':AI:' => "st_33.png",
			':AJ:' => "st_34.png",
			':AK:' => "st_35.png",
			':AL:' => "st_36.png",
			':AM:' => "st_37.png",
			':AN:' => "st_38.png",
			':AO:' => "st_39.png",
			':AP:' => "st_40.png",
			':AQ:' => "st_41.png",
			':CLAP:' => "st_42.png",
			':LIKE:' => "st_43.png",
			':UNLIKE:' => "st_44.png",
			':(V):' => "st_45.png",
			':QE:' => "st_46.png",
			':EX:' => "st_47.png",
			':ZZZ:' => "st_48.png",
			':POO:' => "st_49.png",
			':Cut1:' => "Cut-the-Rope1.png",
            ':Cut2:' => "Cut-the-Rope2.png",
            ':Cut3:' => "Cut-the-Rope3.png",
            ':Cut4:' => "Cut-the-Rope4.png",
            ':Cut5:' => "Cut-the-Rope5.png",
            ':Cut6:' => "Cut-the-Rope6.png",
            ':Cut7:' => "Cut-the-Rope7.png",
            ':Cut8:' => "Cut-the-Rope8.png",
            ':Cut9:' => "Cut-the-Rope9.png",
            ':Cut10:' => "Cut-the-Rope10.png",
            ':Cut11:' => "Cut-the-Rope11.png",
            ':Cut12:' => "Cut-the-Rope12.png",
            ':Cut13:' => "Cut-the-Rope13.png",
            ':Cut14:' => "Cut-the-Rope14.png",
            ':Cut15:' => "Cut-the-Rope15.png",
            ':Cut16:' => "Cut-the-Rope16.png",
            ':Cut17:' => "Cut-the-Rope17.png",
			':Cut18:' => "Cut-the-Rope18.png",
			':Cut19:' => "Cut-the-Rope19.png",
			':Cut20:' => "Cut-the-Rope20.png",
			':Cut21:' => "Cut-the-Rope21.png",
			':Cut22:' => "Cut-the-Rope22.png",
			':Cut23:' => "Cut-the-Rope23.png",
			':Cut24:' => "Cut-the-Rope24.png",
			

        );
		}
        return $icons;
   }


function bp_st_translate_sticker( $content) {
	global $bp;
      foreach( self::replace_with_st() as $codes => $imgs) {
	  $icon = BPST_PLUGIN_URL. 'images/sticons/'. $imgs.'';
           $code[] = $codes;
           $img[] = "<img src='$icon' class='smiley' /> ";					
        }
        $icons = str_replace($code, $img, $content);
        return $icons;
   }

}

 BpStickers::get_instance();
?>