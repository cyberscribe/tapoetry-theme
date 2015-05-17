<?php
function taify($content) {
    $return_content = str_replace('Transatlantic Poetry','<span class="ta">TRANSATLANTIC <em>Poetry</em></span>',$content);
    return $return_content;
}
function ta_remove_kses() {
    foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter) {
       remove_filter($filter, 'wp_filter_kses');
    }
}

function tweakjp_custom_twitter_site( $og_tags ) {
        $og_tags['twitter:site'] = '#tapoetry';
            return $og_tags;
}
function ta_infinite_scroll_render() {
    get_template_part('archive','articles');
}
function footer_link() {
    echo '';
}
// custom admin login logo
function custom_login_logo() {
    echo '<style type="text/css">
         .login h1 a { background-size: 320px; width: 320px; height: 320px; background-image: url('.get_stylesheet_directory_uri().'/images/atlantic-square.jpg) !important; }
          </style>';
}
/* filters, actions, theme support */
add_filter( 'jetpack_open_graph_tags', 'tweakjp_custom_twitter_site', 11 );
add_filter( 'bloginfo', 'taify');
add_filter( 'the_title', 'taify');
add_theme_support( 'infinite-scroll', array(  
    'container' => 'articles',  
    'render'    => 'ta_infinite_scroll_render',  
));  
add_filter('infinite_scroll_credit','footer_link');
add_action('login_head', 'custom_login_logo');
add_action('wp_loaded', 'ta_remove_kses');
