<?php
/*
 * Class MP_Profit_Plugin_Slider_Section
 * add slider section
 */

class MP_Profit_Plugin_Slider_Section {

    public function __construct() {
        add_action('mp_profit_section_slider', array($this, 'get_html'));
    }

    /*
     * Get default sidebar 
     */

    public function get_default_slider() {
        ?>              
        <li id="slide-3">
            <div class="slide-wrapper slide-wrapper-right slide-wrapper-light">
                <div class="middle-wrapper">
                    <div class="middle-cell">
                        <div class="container">
                            <div class="row">
                                <div class="<?php echo apply_filters('mp_profit_slider_right_size', 'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1');?>">
                                    <h1 class="slide-title"><?php _e('Professional Guidance & Support', 'mp-profit'); ?></h1>
                                    <div class="slide-content">
                                        <?php _e('You will be always aware of all business and financial news and stay informed with investment tips, market predictions, business advice and guides.', 'mp-profit'); ?>
                                    </div>
                                    <div class="slide-buttons">  
                                        <a href="#" class="button btn-size-middle" title="<?php _e('Learn More', 'mp-profit'); ?>"><?php _e('Learn More', 'mp-profit'); ?></a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li id="slide-2">
            <div class="slide-wrapper slide-wrapper-left slide-wrapper-light">
                <div class="middle-wrapper">
                    <div class="middle-cell">
                        <div class="container">
                            <div class="row">
                                <div class="<?php echo apply_filters('mp_profit_slider_left_size', 'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-lg-offset-5 col-md-offset-5 col-sm-offset-5');?>">
                                    <h1 class="slide-title"><?php _e('We Provide Best Services', 'mp-profit'); ?></h1>
                                    <div class="slide-content">
                                        <?php _e('We provide you with a professional financial services with all necessary tools to bring new clients and make the existing ones back.', 'mp-profit'); ?>
                                    </div>
                                    <div class="slide-buttons">
                                        <a href="#" class="button btn-size-middle" title="<?php _e('Learn More', 'mp-profit'); ?>"><?php _e('Learn More', 'mp-profit'); ?></a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>  
        <?php
    }

    /*
     * Get slide 
     */

    public function get_slide($post) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), '');
        $url = $thumb['0'];
        $thumbM = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'mp-profit-thumb-slide-medium');
        $urlM = $thumbM['0'];
        $thumbS = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'mp-profit-thumb-slide-small');
        $urlS = $thumbS['0'];
        $content = get_post_meta(get_the_ID(), '_slide_text', true);
        $firstButtonTitle = get_post_meta(get_the_ID(), '_slide_first_button_title', true);
        $firstButtonUrl = get_post_meta(get_the_ID(), '_slide_first_button_url', true);
        $secondButtonTitle = get_post_meta(get_the_ID(), '_slide_second_button_title', true);
        $secondButtonUrl = get_post_meta(get_the_ID(), '_slide_second_button_url', true);
        $layout = get_post_meta(get_the_ID(), '_slide_layout', true);
        $repeat = get_post_meta(get_the_ID(), '_slide_repeat', true);
        $position = get_post_meta(get_the_ID(), '_slide_position', true);
        $bgsize = get_post_meta(get_the_ID(), '_slide_size', true);
        $slide_bg = get_post_meta(get_the_ID(), '_slide_bg', true);
        $beforeContainer = '<div class="row"><div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">';
        $afterContainer = '</div> </div>';
        if ($layout === 'slide-wrapper-right'):
            $beforeContainer = '<div class="row"><div class="' . apply_filters('mp_profit_slider_left_size', 'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-lg-offset-5 col-md-offset-5 col-sm-offset-5') . '">';
        endif;
        if ($layout === 'slide-wrapper-left'):
            $beforeContainer = '<div class="row"> <div class="' . apply_filters('mp_profit_slider_right_size', 'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1') . '">';
        endif;
        ?>
        <li id="<?php echo 'slide-' . $post->ID; ?>">
            <?php ?>
            <style  type="text/css" scoped>
                @media(min-width:1025px ){
                    <?php echo '#slide-' . $post->ID; ?> .slide-wrapper,
                    <?php echo '#slide-' . $post->ID; ?>_clone .slide-wrapper{
                        background-image : url('<?php echo $url; ?>');
                    }
                }
                @media(min-width:769px) and (max-width:1024px){
                    <?php echo '#slide-' . $post->ID; ?> .slide-wrapper,
                    <?php echo '#slide-' . $post->ID; ?>_clone .slide-wrapper{
                        background-image : url('<?php echo $urlM; ?>');
                    }
                }
                @media(max-width:768px ){
                    <?php echo '#slide-' . $post->ID; ?> .slide-wrapper,
                    <?php echo '#slide-' . $post->ID; ?>_clone .slide-wrapper{
                        background-image : url('<?php echo $urlS; ?>');
                    }
                }
            </style>
            <?php ?>

            <div class="slide-wrapper <?php echo $layout; ?> <?php echo $slide_bg; ?>" style="-webkit-background-size:<?php echo $bgsize; ?>; -moz-background-size:<?php echo $bgsize; ?>; -o-background-size:<?php echo $bgsize; ?>; background-size:<?php echo $bgsize; ?>; background-position-x: <?php echo $position; ?>; background-repeat: <?php echo $repeat; ?>; ">
                <div class="middle-wrapper <?php
                if ($slide_bg === 'slide-wrapper-white'): echo 'slide-white-bg';
                endif;
                ?>">
                    <div class="middle-cell">
                        <div class="container">
                            <?php echo $beforeContainer; ?>
                            <?php the_title('<h1 class="slide-title">', '</h1>', true); ?>
                            <?php if ($content != ''): ?>
                                <div class="slide-content">
                                    <?php echo $content; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (($firstButtonTitle != '' && $firstButtonUrl != '') || ($secondButtonUrl != '' && $secondButtonTitle != '')): ?>
                                <div class="slide-buttons">
                                    <?php if ($firstButtonTitle != '' && $firstButtonUrl != ''): ?>
                                        <a href="<?php echo $firstButtonUrl; ?>" class="button btn-size-middle" title="<?php echo $firstButtonTitle; ?>"><?php echo $firstButtonTitle; ?></a>   
                                    <?php endif; ?>                                               
                                    <?php if ($secondButtonUrl != '' && $secondButtonTitle != ''): ?>
                                        <a href="<?php echo $secondButtonUrl; ?>" class="button btn-grey btn-size-middle" title="<?php echo $secondButtonTitle; ?>"><?php echo $secondButtonTitle; ?></a> 
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php echo $afterContainer; ?>
                        </div>
                    </div>
                </div>
            </div>
        </li>                    
        <?php
    }

    public function get_html() {
     
        $mp_profit_slider_slideshow = esc_attr(get_theme_mod('mp_profit_slider_slideshow', 'false'));
        $mp_profit_slider_animation = esc_attr(get_theme_mod('mp_profit_slider_animation', 'fade'));
        $mp_profit_slider_speed = esc_attr(get_theme_mod('mp_profit_slider_speed', '7000'));
        ?>
        <section id="main-slider" class="main-slider-section visible-lg-block visible-md-block visible-sm-block <?php
        if (!(get_theme_mod('mp_profit_slider_show_mobile', false) || get_theme_mod('mp_profit_slider_show_mobile'))): echo 'visible-xs-block';
        endif;
        ?>">
                     <?php
                     $args = array(
                         'post_type' => 'slider',
                         'posts_per_page' => 10
                     );
                     $slider = new WP_Query($args);
                     ?>
            <div class="flex-main-slider flex-main-slider-default" data-animation="<?php echo $mp_profit_slider_animation; ?>" data-slideshow="<?php echo $mp_profit_slider_slideshow; ?>" data-slideshowSpeed="<?php echo $mp_profit_slider_speed; ?>">

                <ul class="slides">
                    <?php
                    if ($slider->have_posts()) {
                        ?>

                        <?php
                        while ($slider->have_posts()) {
                            $slider->the_post();
                            $this->get_slide($slider->post);
                        }
                        ?>

                        <?php
                    } else {
                        $this->get_default_slider();
                    }
                    ?>
                </ul>
            </div>
        </section>
        <?php
    }

}
