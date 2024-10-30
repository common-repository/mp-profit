<?php
/*
 * Contact us section
 */

class MP_Profit_Plugin_Contact {

    public function __construct() {
        /* Enqueue Google reCAPTCHA scripts */
        add_action('wp_enqueue_scripts', array($this, 'recaptcha_scripts'));

        add_action('mp_profit_section_contact', array($this, 'get_html'));
    }

    /*
     * Contact us section
     */

    public function get_html() {
        if (isset($_POST['submitted'])) :
            /*
             * recaptcha
             */
            $mp_profit_contactus_sitekey = esc_html(get_theme_mod('mp_profit_contactus_sitekey'));
            $mp_profit_contactus_secretkey = esc_html(get_theme_mod('mp_profit_contactus_secretkey'));
            $mp_profit_contactus_recaptcha_show = esc_html(get_theme_mod('mp_profit_contactus_recaptcha_show'));
            if (isset($mp_profit_contactus_recaptcha_show) && $mp_profit_contactus_recaptcha_show != 1 && !empty($mp_profit_contactus_sitekey) && !empty($mp_profit_contactus_secretkey)) :
                $captcha;
                if (isset($_POST['g-recaptcha-response'])) {
                    $captcha = $_POST['g-recaptcha-response'];
                }
                if (!$captcha) {
                    $hasError = true;
                }
                $response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=" . $mp_profit_contactus_secretkey . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
                $responseObj = json_decode($response['body']);
                if (!is_null($responseObj)) {
                    if ($responseObj->success === false) {
                        $hasError = true;
                    }
                }
            endif;
            /*
             * name
             */
            if (trim($_POST['myname']) === ''):
                $nameError = __('* Please enter your name.', 'mp-profit');
                $hasError = true;
            else:
                $name = trim($_POST['myname']);
            endif;
            /*
             *  email
             */
            if (trim($_POST['myemail']) === ''):
                $emailError = __('* Please enter your email address.', 'mp-profit');
                $hasError = true;
            elseif (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['myemail']))) :
                $emailError = __('* You entered an invalid email address.', 'mp-profit');
                $hasError = true;
            else:
                $email = trim($_POST['myemail']);
            endif;
            /*
             *  subject
             */
            if (trim($_POST['mysubject']) === ''):
                $subjectError = __('* Please enter a subject.', 'mp-profit');
                $hasError = true;
            else:
                $subject = trim($_POST['mysubject']);
            endif;
            /*
             * message
             */
            if (trim($_POST['mymessage']) === ''):
                $messageError = __('* Please enter a message.', 'mp-profit');
                $hasError = true;
            else:
                $message = stripslashes(trim($_POST['mymessage']));
            endif;
            /*
             * send the email
             */
            if (!isset($hasError)):
                $mp_profit_contactus_email = esc_html(get_theme_mod('mp_profit_contactus_email'));
                if (empty($mp_profit_contactus_email)):
                    $emailTo = esc_html(get_theme_mod('mp_profit_email'));
                else:
                    $emailTo = $mp_profit_contactus_email;
                endif;

                if (isset($emailTo) && $emailTo != ""):
                    if (empty($subject)):
                        $subject = __('From ', 'mp-profit') . $name;
                    endif;
                    $body = __('Name: ', 'mp-profit') . $name . "\n\n" . __('Email: ', 'mp-profit') . $email . "\n\n" . __('Subject: ', 'mp-profit') . $subject . "\n\n" . __('Message: ', 'mp-profit') . $message;
                    $headers = __('From: ', 'mp-profit') . $name . ' <' . $emailTo . '>' . "\r\n" . __('Reply-To: ', 'mp-profit') . $email;
                    wp_mail($emailTo, $subject, $body, $headers);
                    $emailSent = true;
                else:
                    $emailSent = false;
                endif;
            endif;
        endif;
        $mp_profit_contactus_show = esc_html(get_theme_mod('mp_profit_contactus_show'));

        if (isset($mp_profit_contactus_show) && $mp_profit_contactus_show != 1):
            //window.scrollTo(0,'. intval($_POST['scrollPosition']).')
            ?>

            <section class="contact-section default-section" id="contact" >
                <div class="container">
                    <div class="section-content">
                        <?php
                        $mp_profit_contactus_title = esc_html(get_theme_mod('mp_profit_contactus_title'));
                        $mp_profit_contactus_subtitle = esc_html(get_theme_mod('mp_profit_contactus_subtitle'));
                        if (get_theme_mod('mp_profit_contactus_title', false) === false) :
                            ?>
                            <h2 class="section-title"><?php _e('Message form', 'mp-profit'); ?></h2>
                            <?php
                        else:
                            if (!empty($mp_profit_contactus_title)):
                                ?>
                                <h2 class="section-title"><?php echo $mp_profit_contactus_title; ?></h2>
                                <?php
                            endif;
                        endif;
                        if (get_theme_mod('mp_profit_contactus_subtitle', false) === false) :
                            ?>
                            <div class="section-subtitle"><?php _e('Get in touch', 'mp-profit'); ?></div>
                            <?php
                        else:
                            if (!empty($mp_profit_contactus_subtitle)):
                                ?>
                                <div class="section-subtitle"><?php echo $mp_profit_contactus_subtitle; ?></div>
                                <?php
                            endif;
                        endif;
                        ?>

                        <?php
                        if (isset($emailSent) && $emailSent == true) :
                            echo '<div class="notification success"><p>' . __('Thanks, your email was sent successfully!', 'mp-profit') . '</p></div>';
                        elseif (isset($_POST['submitted'])):
                            echo '<div class="notification error"><p>' . __('Sorry, an error occured.', 'mp-profit') . '</p></div>';
                        endif;
                        if (isset($nameError) && $nameError != '') :
                            echo '<div class="notification error"><p>' . esc_html($nameError) . '</p></div>';
                        endif;
                        if (isset($emailError) && $emailError != '') :
                            echo '<div class="notification error"><p>' . esc_html($emailError) . '</p></div>';
                        endif;
                        if (isset($subjectError) && $subjectError != '') :
                            echo '<div class="notification error"><p>' . esc_html($subjectError) . '</p></div>';
                        endif;
                        if (isset($messageError) && $messageError != '') :
                            echo '<div class="notification error"><p>' . esc_html($messageError) . '</p></div>';
                        endif;
                        ?>

                        <form  method="POST" action="" onSubmit="this.scrollPosition.value = (document.body.scrollTop || document.documentElement.scrollTop)" class="contact-form">
                            <input type="hidden" name="scrollPosition">
                            <input type="hidden" name="submitted" id="submitted" value="true" />
                            <div class="row">
                                <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-5 col-lg-offset-1">
                                    <div class="form-group">
                                        <input required="required" type="text" name="myname" placeholder="<?php _e('Your Name', 'mp-profit'); ?>" class="form-control input-box" value="<?php if (isset($_POST['myname'])) echo esc_attr($_POST['myname']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <input required="required" type="email" name="myemail" placeholder="<?php _e('Your Email', 'mp-profit'); ?>" class="form-control input-box" value="<?php if (isset($_POST['myemail'])) echo is_email($_POST['myemail']) ? $_POST['myemail'] : ""; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input required="required" type="text" name="mysubject" placeholder="<?php _e('Subject', 'mp-profit'); ?>" class="form-control input-box" value="<?php if (isset($_POST['mysubject'])) echo esc_attr($_POST['mysubject']); ?>">
                                    </div>
                                    <?php
                                    $mp_profit_contactus_sitekey = esc_html(get_theme_mod('mp_profit_contactus_sitekey'));
                                    $mp_profit_contactus_secretkey = esc_html(get_theme_mod('mp_profit_contactus_secretkey'));
                                    $mp_profit_contactus_recaptcha_show = esc_html(get_theme_mod('mp_profit_contactus_recaptcha_show'));
                                    if (isset($mp_profit_contactus_recaptcha_show) && $mp_profit_contactus_recaptcha_show != 1 && !empty($mp_profit_contactus_sitekey) && !empty($mp_profit_contactus_secretkey)) :
                                        echo '<div class="form-group ">';
                                        echo '<div class="g-recaptcha theme-g-recaptcha" data-sitekey="' . $mp_profit_contactus_sitekey . '"></div>';
                                        echo '</div>';
                                    endif;
                                    ?>
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-5">
                                    <textarea name="mymessage" class="form-control textarea-box" rows="9" placeholder="<?php _e('Your Message', 'mp-profit'); ?>"><?php
                                        if (isset($_POST['mymessage'])) {
                                            echo esc_html($_POST['mymessage']);
                                        }
                                        ?></textarea>
                                </div>

                            </div>
                            <?php
                            $mp_profit_contactus_button_label = esc_html(get_theme_mod('mp_profit_contactus_button_label', __('Send Message', 'mp-profit')));
                            if (!empty($mp_profit_contactus_button_label)):
                                echo '<div class="form-group section-buttons">';
                                echo '<button class="button btn-size-middle theme-contuct-submit" type="submit" >' . $mp_profit_contactus_button_label . '</button>';
                                echo '</div>';
                            endif;
                            ?>

                        </form>

                    </div>
                </div>
            </section>
            <?php
        endif;
    }

    function recaptcha_scripts() {
        if (is_page_template('template-front-page.php')) :
            $mp_profit_contactus_sitekey = esc_html(get_theme_mod('mp_profit_contactus_sitekey'));
            $mp_profit_contactus_secretkey = esc_html(get_theme_mod('mp_profit_contactus_secretkey'));
            $mp_profit_contactus_recaptcha_show = esc_html(get_theme_mod('mp_profit_contactus_recaptcha_show'));
            if (isset($mp_profit_contactus_recaptcha_show) && $mp_profit_contactus_recaptcha_show != 1 && !empty($mp_profit_contactus_sitekey) && !empty($mp_profit_contactus_secretkey)) :
                wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js');
            endif;
        endif;
    }

}
