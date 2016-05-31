<?php
    /*
    # ------------------------------------------------------------------------
    # Extensions for Joomla 3.x
    # ------------------------------------------------------------------------
    # Copyright (C) 2015 standardcompany.ru. All Rights Reserved.
    # @license - PHP files are GNU/GPL V2.
    # Author: standardcompany.ru
    # Websites:  http://standardcompany.ru
    # Date modified: 11/10/2015
    # ------------------------------------------------------------------------
    */

defined('_JEXEC') or die;

JHtml::_('jquery.framework');

JHtml::script(JURI::base() . 'modules/mod_call_me_back_form/assets/js/jquery.maskedinput.min.js');
JHtml::stylesheet(JURI::base() . 'modules/mod_call_me_back_form/assets/css/call-me-back-form.css');

$my_email = $params->get('my_email');
$subject_mail = $params->get('subject_mail');

$use_as = $params->get('use_as');
$id_module = $module->id;

$form_title = $params->get('form_title');
$form_description = $params->get('form_description');
$form_thanks = $params->get('form_thanks');

$input_name = $params->get('input_name');
$input_phone = $params->get('input_phone');
$phone_mask = $params->get('phone_mask');
$send_button = $params->get('send_button');
$send_button_after = $params->get('send_button_after');

$input_name_required = $params->get('input_name_required');
$input_phone_required = $params->get('input_phone_required');
?>


<?php
    if($_POST["cmbf-phone-".$id_module]) {

        $cmbf_phone = $_POST["cmbf-phone-".$id_module];
        $cmbf_name = $_POST["cmbf-name-".$id_module];

        $body = $input_name.': '.$cmbf_name.'<br>'.$input_phone.': '.$cmbf_phone.'<br><br><p style="font-size: 10px; color: #666;">IP: ' . $_SERVER['REMOTE_ADDR'] . '<br>' . $_SERVER['HTTP_USER_AGENT'] . '<br>'. $_SERVER['HTTP_REFERER'] . "\r\n\r\n";
        
        $config = JFactory::getConfig();
        $sender = array( 
            $config->get( 'mailfrom' ),
            $config->get( 'fromname' ) 
        );
        
        $mailer = JFactory::getMailer();
        
        $mailer->setSender($sender);
        $mailer->addRecipient($my_email);
        $mailer->setSubject($subject_mail);
        $mailer->setBody($body);
        $mailer->isHTML();
        $mailer->send();
    }
?>


<?php if ( $use_as != 'inline-form' ) : ?>
    <button id="cmbf-button-container-<?php echo $id_module; ?>" class="cmbf-button-container cmbf-<?php echo $use_as; ?>"><?php echo $params->get('button_name'); ?></button>
    <div class="cmbf-obfuscator" id="cmbf-obfuscator-<?php echo $id_module; ?>"></div>
<?php endif; ?>       



<div id="cmbf-form-container-<?php echo $id_module; ?>" class="<?php if ($use_as != 'inline-form') { echo 'cmbf-form-modal';} else { echo 'cmbf-form-inline'; }?>">

    <?php if ( $use_as != 'inline-form' ) : ?>
        <div class="cmbf-form-close" id="cmbf-form-close-<?php echo $id_module; ?>"></div>
    <?php endif; ?>


    <form id="cmbf-form-<?php echo $id_module; ?>" class="cmbf-form-class" method="post" action="">
        <fieldset>
            <legend><?php echo $form_title; ?><span> <?php echo $form_description; ?></span></legend>
        <div class="cmbf-field-container">
            <div class="cmbf-icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                    <path fill="none" stroke="#D5DDDF" stroke-width="1.5" stroke-miterlimit="10" d="M8.7,15L3,18.4c-0.6,0.4-1,1-1,1.7V23h20v-2.9  c0-0.7-0.4-1.4-1-1.7L15.3,15"/>
                    <path fill="none" stroke="#D5DDDF" stroke-width="1.5" stroke-linecap="square" stroke-miterlimit="10" d="M12,16L12,16  c-3.3,0-6-2.7-6-6V7c0-3.3,2.7-6,6-6l0,0c3.3,0,6,2.7,6,6v3C18,13.3,15.3,16,12,16z"/>
                </svg>
                <input type="text" name="cmbf-name-<?php echo $id_module; ?>" placeholder="<?php echo $input_name; ?>">
            </div>
            <div class="cmbf-error-name cmbf-error"><span><?php echo $input_name_required; ?></span></div>
        </div>
        <div class="cmbf-field-container">
            <div class="cmbf-icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 241.73 241.73" width="20px" height="24px" fill="#D5DDDF">
                    <path style="" d="M234.771,181.213l-34.938-34.953c-4.692-4.668-10.975-7.24-17.689-7.24   c-6.987,0-13.584,2.751-18.572,7.742l-13.6,13.597c-10.568-5.874-24.614-13.953-39.197-28.536   c-14.566-14.571-22.646-28.576-28.55-39.201l13.613-13.603c10.121-10.142,10.328-26.413,0.463-36.269L61.37,7.818   c-4.679-4.692-10.962-7.276-17.693-7.276c-6.831,0-13.293,2.63-18.252,7.417c-3,2.416-18.055,15.706-23.666,43.114   c-7.856,38.363,10.194,75.274,62.302,127.403c58.209,58.191,107.902,62.714,121.746,62.714c2.882,0,4.621-0.178,5.085-0.232   c27.147-3.182,36.867-15.238,43.964-24.041C244.052,205.508,244.02,190.496,234.771,181.213z M223.178,207.502   c-6.671,8.274-12.971,16.088-34.031,18.557c-0.011,0.001-1.163,0.13-3.34,0.13c-12.386,0-57.008-4.206-111.139-58.32   C26.615,119.796,9.749,86.829,16.454,54.081c4.894-23.906,17.887-34.067,18.392-34.453l0.448-0.331l0.393-0.394   c2.169-2.167,5.006-3.361,7.989-3.361c2.716,0,5.228,1.018,7.08,2.876l34.939,34.94c4.02,4.016,3.806,10.774-0.471,15.06   L69.829,83.8l-0.253,0.265c-4.012,4.419-3.54,10.391-1.33,14.28c6.377,11.508,15.112,27.269,31.92,44.082   c16.752,16.752,32.49,25.48,43.966,31.845c1.149,0.645,3.521,1.727,6.49,1.727c3.506,0,6.725-1.484,9.108-4.189l14.448-14.444   c2.157-2.158,4.985-3.347,7.964-3.347c2.722,0,5.247,1.021,7.095,2.859l34.915,34.93   C228.587,196.259,226.756,203.064,223.178,207.502z" fill=""></path>
                    <path style="" d="M146.447,37.293c12.887,1.483,28.061,9.289,38.657,19.886c10.695,10.695,18.52,26.023,19.933,39.05   c0.417,3.843,3.667,6.691,7.447,6.691c0.27,0,0.544-0.015,0.818-0.044c4.118-0.447,7.094-4.147,6.647-8.265   c-1.787-16.467-11.075-34.874-24.238-48.038c-13.04-13.041-31.259-22.306-47.549-24.181c-4.113-0.477-7.834,2.479-8.308,6.593   C139.38,33.099,142.331,36.819,146.447,37.293z" fill=""></path>
                    <path style="" d="M139.44,68.711c6.97,0.803,16.616,5.973,22.935,12.292c6.373,6.374,11.553,16.112,12.316,23.157   c0.417,3.844,3.667,6.692,7.447,6.692c0.27,0,0.543-0.015,0.817-0.044c4.118-0.447,7.095-4.147,6.648-8.265   c-1.304-12.028-9.289-24.813-16.623-32.147c-7.268-7.269-19.928-15.216-31.825-16.587c-4.119-0.479-7.835,2.478-8.309,6.592   C132.373,64.516,135.325,68.237,139.44,68.711z" fill=""></path>
                </svg>
                <input type="text" name="cmbf-phone-<?php echo $id_module; ?>" id="cmbf-phone-<?php echo $id_module; ?>" placeholder="<?php echo $input_phone; ?>">
            </div>
            <div class="cmbf-error-phone cmbf-error"><span><?php echo $input_phone_required; ?></span></div>
        </div>
        <div class="cmbf-field-container">
            <input class="button" type="submit" name="submit-<?php echo $id_module; ?>" value="<?php echo $send_button; ?>">
        </div>
        <div class="cmbf-success">
            <?php echo $form_thanks; ?>
        </div>
        </fieldset>
    </form>
</div>

<script>
    jQuery("#cmbf-phone-<?php echo $id_module; ?>").mask("<?php echo $phone_mask ?>");

    jQuery('document').ready(function() {
        jQuery('#cmbf-form-<?php echo $id_module; ?> input').focus( function() { 
                jQuery(this).parents().eq(1).removeClass("valid-error");
        });
        jQuery('#cmbf-form-<?php echo $id_module; ?>').on('submit', function (event) {
            var form = jQuery(this);
            var error = false;

            form.find('input[type="text"]').each(function() {
                if (!jQuery(this).val().length) {
                    jQuery(this).parents().eq(1).addClass("valid-error");
                    error = true;
                }
            });

            if (!error)
            {
                ajaxsendmessage();
            }

            function ajaxsendmessage() {
                jQuery.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    cache: false,
                    beforeSend: function() {
                        form.find('input[type="submit"]').attr('value', '<?php echo $send_button_after; ?>');
                        form.find('input[type="submit"]').attr('disabled', 'disabled');
                    },
                    success: function () {
                            form.find('.cmbf-field-container').slideUp('fast');
                            form.find('.cmbf-success').slideDown("fast");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        event.preventDefault();
        });

        jQuery('#cmbf-button-container-<?php echo $id_module; ?>').click(function() {
            jQuery('#cmbf-form-container-<?php echo $id_module; ?>, #cmbf-obfuscator-<?php echo $id_module; ?>').fadeIn('slow');
        });

        jQuery('#cmbf-obfuscator-<?php echo $id_module; ?>, #cmbf-form-close-<?php echo $id_module; ?>').click(function() {
            jQuery('#cmbf-form-container-<?php echo $id_module; ?>, #cmbf-obfuscator-<?php echo $id_module; ?>').fadeOut('slow');
        });
    }); 
</script>



