<?php
/**
 * Author:         carlosramosweb
 * Author URI:     http://plugins.criacaocriativa.com
 * @package        form-quiz-active-campaing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class WP_FORM_QUIZ_ACTIVE_CAMPAING {

    public $get_icons;

    public function __construct() {
        if ( is_admin() ) {
            register_activation_hook( WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_FILE, array( $this, 'plugin_activate_plugin' )); 
            add_filter( 'plugin_action_links_' . WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_BASENAME, array( $this, 'plugin_action_links_settings' ) );
            add_action('admin_menu', array( $this, 'add_menu_page' ));
        }
        add_action( 'init', array( $this, 'plugin_language_load' ) );
        add_action( 'init', array( $this, 'form_quiz_active_campaing_shortcode_callback' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'plugin_enqueue_scripts' ), 1 );
    }

    public function plugin_activate_plugin() {          
        add_option( 'Activated_Plugin', 'form-quiz-active-campaing' );    
        if ( is_admin() ) {
            $get_settings = get_option( 'form_quiz_active_campaing_settings' );
            $settings = array();
            $settings['settings'] = array(
                'sharing'           => 'yes',
                'sharing_text'      => (isset($get_settings['sharing_text'])) ? $get_settings['sharing_text'] : 'Olá! Tudo bem? Te recomendo esse link a seguir. Aproveite o máximo!',
                'title'             => (isset($get_settings['title'])) ? $get_settings['title'] : 'Descubra qual empréstimo é melhor para você',
                'question_1'        => (isset($get_settingsT['question_1'])) ? $get_settings['question_1'] : 'Qual tipo de empréstimo você precisa?',
                'question_2'        => (isset($get_settings['question_2'])) ? $get_settings['question_2'] : 'Qual prazo você quer pagar?',
                'question_3'        => (isset($get_settings['question_3'])) ? $get_settings['question_3'] : 'De quanto precisa?',
                'question_4'        => (isset($get_settings['question_4'])) ? $get_settings['question_4'] : 'Como você está na agência de crédito?',
                'question_5'        => (isset($get_settings['question_5'])) ? $get_settings['question_5'] : 'Seus dados',
                'form_position'     => (isset($get_settings['form_position'])) ? $get_settings['form_position'] : '1',
                'autocomplete'      => (isset($get_settings['autocomplete'])) ? $get_settings['autocomplete'] : 'yes',
                'thank_you_text'          => (isset($_POST['thank_you_text'])) ? $_POST['thank_you_text'] : 'Obrigado!<br/> Em breve um de nossos representante comercial irá entrar em contato com você.',
                'sharing_thank_you_text'          => (isset($_POST['sharing_thank_you_text'])) ? $_POST['sharing_thank_you_text'] : 'Obrigado!<br/>Por favor, compartilhe nossa página com sua família, amigos e conhecidos.',
                'link_external'     => (isset($get_settings['link_external'])) ? $get_settings['link_external'] : ''            
            ); 

            $settings['colors_fonts'] = array(
                'progressbar'           => (isset($get_settings['progressbar'])) ? $get_settings['progressbar'] : '#253c7c',
                'color_button'          => (isset($get_settings['color_button'])) ? $get_settings['color_button'] : '#ffffff',
                'border_button'         => (isset($get_settings['border_button'])) ? $get_settings['border_button'] : '#253c7c',
                'color_button_hover'    => (isset($get_settings['color_button_hover'])) ? $get_settings['color_button_hover'] : '#38529b',
                'color_button_text'     => (isset($get_settings['color_button_text'])) ? $get_settings['color_button_text'] : '#38529b',
                'color_button_hover_text'=> (isset($get_settings['color_button_hover_text'])) ? $get_settings['color_button_hover_text'] : '#ffffff',
                'title_size'            => (isset($get_settings['title_size'])) ? $get_settings['title_size'] : '1.8',
                'title_size_quiz'       => (isset($get_settings['title_size_quiz'])) ? $get_settings['title_size_quiz'] : '1.4',
                'title_size_option'     => (isset($get_settings['title_size_option'])) ? $get_settings['title_size_option'] : '0.8',
                'icon_size_option'      => (isset($get_settings['icon_size_option'])) ? $get_settings['icon_size_option'] : '48'
            ); 

            $settings['integration'] = array(
                'url_action'        => (isset($get_settings['url_action'])) ? $get_settings['url_action'] : 'https://leandrootedescoo.activehosted.com/proc.php',
                'token_api'         => (isset($get_settings['token_api'])) ? $get_settings['token_api'] : '26a089cba7b9fe79f5ac3f1297f5dc41'          
            ); 

            $this->get_icons = 1;
            $settings['images'] = array();
            $settings['images'] = $this->get_option_icons();

            update_option( 'form_quiz_active_campaing_settings', $settings, 'yes' );
        }
    }

    public function get_option_icons() {
        if ($this->get_icons == 1) {
            $settings['images']['step-1'] = array(
                '0' => array( 
                    'title' => 'Pessoal',
                    'image' => 'icons-1/step-1/step-1-icon-1.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '1' => array( 
                    'title' => 'Comercial',
                    'image' => 'icons-1/step-1/step-1-icon-2.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '2' => array( 
                    'title' => 'Folha de Pagamento',
                    'image' => 'icons-1/step-1/step-1-icon-3.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '3' => array( 
                    'title' => 'Educação',
                    'image' => 'icons-1/step-1/step-1-icon-4.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '4' => array( 
                    'title' => 'Promessas',
                    'image' => 'icons-1/step-1/step-1-icon-5.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '5' => array( 
                    'title' => 'Hipoteca',
                    'image' => 'icons-1/step-1/step-1-icon-6.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '6' => array( 
                    'title' => 'Consumo',
                    'image' => 'icons-1/step-1/step-1-icon-7.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '7' => array( 
                    'title' => 'Microcréditos',
                    'image' => 'icons-1/step-1/step-1-icon-8.png',
                    'created_at' => '30/07/2022 22:00:00'
                )
            ); 
            $settings['images']['step-2'] = array(
                '0' => array( 
                    'title' => 'Entre 6 e 12 meses',
                    'image' => 'icons-1/step-2/step-2-icon-1.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '1' => array( 
                    'title' => 'Entre 12 e 18 meses',
                    'image' => 'icons-1/step-2/step-2-icon-2.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '2' => array( 
                    'title' => 'Entre 18 e 24 meses',
                    'image' => 'icons-1/step-2/step-2-icon-3.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '3' => array( 
                    'title' => 'Mais de 24 meses',
                    'image' => 'icons-1/step-2/step-2-icon-4.png',
                    'created_at' => '30/07/2022 22:00:00'
                )
            ); 
            $settings['images']['step-3'] = array(
                '0' => array( 
                    'title' => 'De R$ 1.000',
                    'image' => 'icons-1/step-3/step-3-icon-1.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '1' => array( 
                    'title' => 'Até R$ 5.000',
                    'image' => 'icons-1/step-3/step-3-icon-2.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '2' => array( 
                    'title' => 'Entre R$ 15.000 e R$ 30.000',
                    'image' => 'icons-1/step-3/step-3-icon-3.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '3' => array( 
                    'title' => 'Mais de R$ 30.000',
                    'image' => 'icons-1/step-3/step-3-icon-4.png',
                    'created_at' => '30/07/2022 22:00:00'
                )
            ); 
            $settings['images']['step-4'] = array(
                '0' => array( 
                    'title' => 'Boa Nota',
                    'image' => 'icons-1/step-4/step-4-icon-1.png',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '1' => array( 
                    'title' => 'Nota Ruim',
                    'image' => 'icons-1/step-4/step-4-icon-2.png',
                    'created_at' => '30/07/2022 22:00:00'
                )
            ); 
        }
        if ($this->get_icons == 2) {
            $settings['images']['step-1'] = array(
                '0' => array( 
                    'title' => 'Pessoal',
                    'image' => 'icons-2/step-1/step-1-icon-1.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '1' => array( 
                    'title' => 'Comercial',
                    'image' => 'icons-2/step-1/step-1-icon-2.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '2' => array( 
                    'title' => 'Folha de Pagamento',
                    'image' => 'icons-2/step-1/step-1-icon-3.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '3' => array( 
                    'title' => 'Educação',
                    'image' => 'icons-2/step-1/step-1-icon-4.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '4' => array( 
                    'title' => 'Promessas',
                    'image' => 'icons-2/step-1/step-1-icon-5.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '5' => array( 
                    'title' => 'Hipoteca',
                    'image' => 'icons-2/step-1/step-1-icon-6.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '6' => array( 
                    'title' => 'Consumo',
                    'image' => 'icons-2/step-1/step-1-icon-7.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '7' => array( 
                    'title' => 'Microcréditos',
                    'image' => 'icons-2/step-1/step-1-icon-8.webp',
                    'created_at' => '30/07/2022 22:00:00'
                )
            ); 
            $settings['images']['step-2'] = array(
                '0' => array( 
                    'title' => 'Entre 6 e 12 meses',
                    'image' => 'icons-2/step-2/step-2-icon-1.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '1' => array( 
                    'title' => 'Entre 12 e 18 meses',
                    'image' => 'icons-2/step-2/step-2-icon-2.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '2' => array( 
                    'title' => 'Entre 18 e 24 meses',
                    'image' => 'icons-2/step-2/step-2-icon-3.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '3' => array( 
                    'title' => 'Mais de 24 meses',
                    'image' => 'icons-2/step-2/step-2-icon-4.webp',
                    'created_at' => '30/07/2022 22:00:00'
                )
            ); 
            $settings['images']['step-3'] = array(
                '0' => array( 
                    'title' => 'De R$ 1.000',
                    'image' => 'icons-2/step-3/step-3-icon-1.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '1' => array( 
                    'title' => 'Até R$ 5.000',
                    'image' => 'icons-2/step-3/step-3-icon-2.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '2' => array( 
                    'title' => 'Entre R$ 15.000 e R$ 30.000',
                    'image' => 'icons-2/step-3/step-3-icon-3.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '3' => array( 
                    'title' => 'Mais de R$ 30.000',
                    'image' => 'icons-2/step-3/step-3-icon-4.webp',
                    'created_at' => '30/07/2022 22:00:00'
                )
            ); 
            $settings['images']['step-4'] = array(
                '0' => array( 
                    'title' => 'Boa Nota',
                    'image' => 'icons-2/step-4/step-4-icon-1.webp',
                    'created_at' => '30/07/2022 22:00:00'
                ),
                '1' => array( 
                    'title' => 'Nota Ruim',
                    'image' => 'icons-2/step-4/step-4-icon-2.webp',
                    'created_at' => '30/07/2022 22:00:00'
                )
            ); 
        }

        return $settings['images'];
    }

    public function plugin_language_load() {
        $plugin_dir = WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_BASENAME . '/languages/';
        load_plugin_textdomain( 'form-quiz-active-campaing', false, $plugin_dir );
    }

    public function plugin_enqueue_scripts() {
        wp_enqueue_style( 'form_quiz_active_campaing_plugin_styles', WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL . 'assets/css/styles.css', array(), WP_FORM_QUIZ_ACTIVE_CAMPAING_VERSION, 'all' );
        wp_enqueue_style( 'form_quiz_active_campaing_plugin_styles_quiz', WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL . 'assets/css/styles-quiz.css', array(), WP_FORM_QUIZ_ACTIVE_CAMPAING_VERSION, 'all' );
        wp_enqueue_script( 'form_quiz_active_campaing_plugin_scripts', WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL . 'assets/js/scripts.js', array( 'jquery' ), WP_FORM_QUIZ_ACTIVE_CAMPAING_VERSION, true );
    }

    public function plugin_action_links_settings( $links ) {
        $action_links = array(
            'settings' => '<a href="' . admin_url() . 'tools.php?page=form-quiz-active-campaing-page" title="' . __( 'Configurações', 'form-quiz-active-campaing' ) . '" class="error">' . __( 'Configurações', 'form-quiz-active-campaing' ) . '</a>',
        );
        return array_merge( $action_links, $links );
    }

    public function add_menu_page() {  
        add_menu_page(
            __( 'Settings', 'form-quiz-active-campaing' ),
            __( 'Form Quiz', 'form-quiz-active-campaing' ),
            'manage_options',
            'form-quiz-active-campaing-page',
            array( $this, 'form_quiz_active_campaing_page_callback' ),
            'dashicons-screenoptions',
            6
        );
    }

    public function form_quiz_active_campaing_page_callback() { 
        include_once( WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH . 'includes/settings-page-admin.php' ); 
    }

    public function form_quiz_active_campaing_shortcode_callback() {
        add_shortcode( 'form_quiz_active_campaing_shortcode', array( $this, 'form_quiz_active_campaing_shortcode' ) );
    }

    public function form_quiz_active_campaing_shortcode( $atts ) {
        include_once( WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH . 'includes/shortcode.php' ); 
        return;
    }

}

$wpFormQuiz = new WP_FORM_QUIZ_ACTIVE_CAMPAING();