<?php
/**
 * Plugin Name:       WoPo Sound Recorder
 * Plugin URI:        https://wopoweb.com/contact-us/
 * Description:       Microsoft Sound Recorder clone for your website
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            WoPo Web
 * Author URI:        https://wopoweb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wopo-sound-recorder
 * Domain Path:       /languages
 */

function woposr_get_app_url(){
    return plugins_url('html/app/index.html',__FILE__);
}

add_action('wp_enqueue_scripts', 'woposr_enqueue_scripts');

function woposr_enqueue_scripts(){
    global $post;
    $is_shortcode = intval(has_shortcode( $post->post_content, 'wopo-sound-recorder'));
    if ((function_exists('wopopp_add_drawing_button') && is_singular()) || $is_shortcode){
        wp_enqueue_style('XP',plugins_url( '/assets/css/XP.css', __FILE__ ));
        wp_enqueue_style('wopo-sound-recorder',plugins_url( '/assets/css/main.css', __FILE__ ));
        wp_enqueue_script('wopo-sound-recorder', plugins_url( '/assets/js/main.js', __FILE__ ),array('jquery'));
        wp_localize_script( 'wopo-sound-recorder', 'wopoSolitaire', array(
            'app_url' => woposr_get_app_url(),
            'is_shortcode' => $is_shortcode,
        ) ); 
        do_action('wopo_sound_recorder_enqueue_scripts');
    }
}

add_shortcode('wopo-sound-recorder', 'wopo_sound_recorder_shortcode');
function wopo_sound_recorder_shortcode( $atts = [], $content = null) {
    ob_start();?>
    <div id="wopo_sound_recorder_window" class="window">
        <div class="title-bar">
            <div class="title-bar-text"><?php echo __('WoPo Sound Recorder','wopo-sound-recorder') ?></div>
            <div class="title-bar-controls">
            <button class="btn-minimize" aria-label="Minimize"></button>
            <button class="btn-maximize" aria-label="Maximize"></button>
            <button class="btn-close" aria-label="Close"></button>
            </div>
        </div>
        <div class="window-body">
            <iframe id="wopo_sound_recorder"></iframe>
        </div>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}