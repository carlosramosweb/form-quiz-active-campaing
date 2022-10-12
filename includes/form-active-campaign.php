<?php
/**
 * Author:         carlosramosweb
 * Author URI:     http://plugins.criacaocriativa.com
 * @package        form-quiz-active-campaing
 */

if ( ! defined( 'ABSPATH' ) ) {
   exit();
}
?>

<div class="slide-5" <?php echo $slide_form; ?>>
   <h3 class="text text-md text-regular">
      <div class="text-center">
        <?php echo $settings['question_5'];?>
      </div>
   </h3>
  <div class="slide-r-container">
    <div class="row">
      <div class="col-md-7 col-centered">
         <form method="POST" action="javascript:;" id="_form_1_" class="_form _form_1 _inline-form  _dark" novalidate>
          <input type="hidden" name="action" class="action" value="<?php echo $integration['url_action'];?>" />
          <input type="hidden" name="u" class="u" value="1" />
          <input type="hidden" name="f" class="f" value="1" />
          <input type="hidden" name="s" class="s" />
          <input type="hidden" name="c" class="c" value="0" />
          <input type="hidden" name="m" class="m" value="0" />
          <input type="hidden" name="act" class="act" value="sub" />
          <input type="hidden" name="v" class="v" value="2" />
          <input type="hidden" name="or" class="or" value="<?php echo $integration['token_api'];?>" />
          <div class="_form-content">
            <div class="_form_element _x75938182 _full_width " >
              <div class="_field-wrapper">
                <input type="text" class="fullname" name="fullname" placeholder="Nome" required style="margin: 0 0 30px; text-align: left; font-size: 16px;"/>
              </div>
            </div>
            <div class="_form_element _x33996837 _full_width " >
              <div class="_field-wrapper" style="width:100%;">
                <input type="text" class="email" name="email" placeholder="E-mail" required style="margin: 0 0 30px; text-align: left; font-size: 16px;"/>
              </div>
            </div>

            <div class="alert alert-warning form-error-email" style="display:none;"></div>

            <div class="_button-wrapper _full_width">
              <button id="_form_1_submit" class="_submit send" type="submit" style="display: inline-block; text-align: center; width: 100%;">
                Enviar
              </button>
            </div>
            <div class="_clear-element">
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<?php if ($settings['autocomplete'] == 'yes') { ?>
<script type='text/javascript' src='<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/js/email-autocomplete.js' id='form_quiz_active_campaing_plugin_autocomplete-js'></script>
<script type="text/javascript">
jQuery(".email").emailautocomplete({
    domains: [
        "rathorji.com",
        "gmail.com",
        "yahoo.com",
        "hotmail.com",
        "live.com", 
        "outlook.com",
        "gmx.com",
        "me.com",
        "laravel.com",
        "aol.com"
    ]
}); 
</script>
<?php } ?>
<script type="text/javascript">
jQuery("._submit.send").click(function() { 
    customer_name = jQuery('.fullname');
    customer_email = jQuery('.email');
    function sleep(time) {
      return new Promise(resolve => setTimeout(resolve, time));
    }         
    async function delay() {
        jQuery('.box-loading').attr('style', 'display: block;'); 
        customer_name.attr('style', 'margin: 0 0 30px; text-align: center; font-size: 16px;');
        customer_email.attr('style', 'margin: 0 0 30px; text-align: center; font-size: 16px;');
        await sleep(3000);
        customer_name.val(''); 
        customer_email.val('');  
        <?php if ($settings['sharing'] == '' && $settings['link_external'] != '') { ?>
        setTimeout(function() {
            location.href="<?php echo esc_url($settings['link_external']); ?>";
        }, 500);
        <?php } ?>
        <?php if ($settings['sharing'] == 'yes') { ?>
        jQuery('.slide-5').fadeOut();
        setTimeout(function() {
            jQuery('.btn-arrow-left').attr('style', 'display: none;');
            jQuery('.btn-arrow-right').attr('style', 'display: none;');
            jQuery('.slide-sharing').fadeIn();
            jQuery(".survey-progressbar-percentage").attr('style', 'width: calc(0%);');
            jQuery("p.text-progressbar").html('<span>1 </span>de 2');
            jQuery('.box-loading').attr('style', 'display: none;'); 
            jQuery('.steps_number').val()   
            jQuery('.steps_number').val('5');
        }, 500);
        <?php } ?>
        <?php if ($settings['sharing'] == '' && $settings['link_external'] == '') { ?>
        jQuery('.slide-5').fadeOut();
        setTimeout(function() {
            jQuery('.slide-sharing').fadeIn();
            jQuery(".survey-progressbar-container").attr('style', 'display:none;');
            jQuery('.box-loading').attr('style', 'display: none;'); 
        }, 500);
        <?php } ?>
    } 
    if (customer_name.val() == '') {
      customer_name.attr('style', 'border-bottom: 3px solid #e91e63 !important; background-color: #e3c7d0 !important;');
      customer_name.focus();
      jQuery('.box-loading').attr('style', 'display: none;');
      return false;
    }   
    if (customer_email.val() == '') {
      customer_name.attr('style', 'margin: 0 0 30px; text-align: center; font-size: 16px;');
      customer_email.focus();
      customer_email.attr('style', 'border-bottom: 3px solid #e91e63 !important; background-color: #e3c7d0 !important;');
      jQuery('.box-loading').attr('style', 'display: none;');
      return false;
    } 

    if (customer_email.val() != '') {
        if (!isEmail(customer_email.val())){
            customer_name.attr('style', 'margin: 0 0 30px; text-align: center; font-size: 16px;');
            customer_email.focus();
            customer_email.attr('style', 'border-bottom: 3px solid #e91e63 !important; background-color: #e3c7d0 !important;');
            jQuery('.form-error-email').attr('style', 'display:block;');
            jQuery('.form-error-email').html('E-mail incorreto!');
            jQuery('.box-loading').attr('style', 'display: none;');
            return false;
        }
    }

    if (customer_name.val() != '' && customer_email.val() != '') {
        delay();
        form_submit_active_campaing();
    } 
});
</script>
