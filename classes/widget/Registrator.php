<?php

class MP_Profit_Plugin_Widget_Registrator {

    protected $widgets = array(
        '/widget/Items/About.php',
        '/widget/Items/Contact.php',
        '/widget/Items/Features.php',
        '/widget/Items/Records.php',
        '/widget/Items/Team.php',
        '/widget/Items/Plan.php',
        '/widget/Items/Testimonial.php',
        '/widget/Items/GoogleMap.php',
        '/widget/Items/Break.php',
        '/widget/Items/Button.php'
    );

    public function __construct() {

        // Allow child themes/plugins to add widgets to be loaded.
        $widgets = apply_filters('sp_widgets', $this->widgets);
        foreach ($widgets as $w) {
            include_once MP_PROFIT_PLUGIN_CLASS_PATH  . $w;
        }
    }

}