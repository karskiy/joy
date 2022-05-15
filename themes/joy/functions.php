<?php
function my_login_logo()
{ ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url("https://buy-like.ru/wp-content/uploads/2022/03/logo-joy.svg");
            height: auto;
            width: 320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
            padding-bottom: 42px;
        }
    </style>
<?php }

add_action('login_enqueue_scripts', 'my_login_logo');


function my_login_logo_url()
{
    return home_url();
}

add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title()
{
    return 'Your Site Name and Info';
}

add_filter('login_headertext', 'my_login_logo_url_title');


add_action('woocommerce_single_product_summary', function () {
    $link_w = get_field('wildberries');
    $link_o = get_field('ozon');
    ?>
    <?php if( $link_o ): ?>
    <a href="<?php echo esc_url( $link_o ); ?>" target="_blank" class="button is-outline is-large" style="border-radius:99px;">
        <img src="/wp-content/uploads/2022/04/ozon.png" width="180" alt="Логотип Озон">
    </a>
    <?php endif; ?>
    <?php if( $link_w ): ?>
    <a href="<?php echo esc_url( $link_w ); ?>" target="_blank" class="button is-outline is-large" style="border-radius:99px;">
        <img src="/wp-content/uploads/2022/04/wildberries.png" width="180" alt="Логотип Валдберрис">
    </a>
    <?php endif; ?>
    <?php
}, 60);



add_filter( 'gettext', 'theme_change_comment_field_names', 20, 3 );
/**
 * Change comment form default field names.
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function theme_change_comment_field_names( $translated_text, $text, $domain ) {

    if ( is_admin() ) {

        switch ( $translated_text ) {

            case 'Contact Form 7' :

                $translated_text = 'Формы связи';
                break;

            case 'UX Blocks' :

                $translated_text = 'Блоки';
                break;
	
            case 'WooCommerce' :

                $translated_text = 'Магазин';
                break;		
				
            case 'Flatsome' :

                $translated_text = 'Шаблон сайта';
                break;					
				
            case 'WP Mail SMTP' :

                $translated_text = 'Почта SMTP';
                break;					
        }

    }

    return $translated_text;
}


/* Add a download button only to Page Price. */
function my_added_page_content ( $content ) {
    if ( is_page(266) ) {
        $file = get_field('fajl');
        if( $file ):

            // Extract variables.
            $url = $file['url'];
        return $content . '<p><a href="' . esc_attr($url) .'" class="button primary is-outline" target="_blank"><span>Скачать прайс</span></a></p>';
        endif;
    }

    return $content;
}
add_filter( 'the_content', 'my_added_page_content');