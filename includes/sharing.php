<?php
/**
 * Author:         carlosramosweb
 * Author URI:     http://plugins.criacaocriativa.com
 * @package        form-quiz-active-campaing
 */

if ( ! defined( 'ABSPATH' ) ) {
   exit();
}

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 
$sharing_link = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$sharing_text = $settings['sharing_text'];

?>

<div class="slide-sharing" <?php echo $slide_sharing; ?>>
   <h3 class="text text-md text-regular">
      <div class="text-center">
         <i class="bi bi-check2-circle"></i>
         <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/fancy_checked.png" alt="Ícone de Sucesso." title="Sucesso!" style=""><br/>
         <?php if ($settings['sharing'] == '' && $settings['link_external'] == '') { 
            echo $settings['thank_you_text'];
         } else {
            echo $settings['sharing_thank_you_text'];
         } ?>
      </div>
   </h3>

   <div class="slide-r-container">
    <div class="row">
      <div class="col-md-7 col-centered">
         <?php if ($settings['sharing'] == '' && $settings['link_external'] != '') { ?>
            <p><strong>Por favor, aguarde...</strong></p>
         <?php } else { ?>
            <?php if ($settings['sharing'] == 'yes') { ?>
               <div class="box-sharing-whatsapp">
                  <a href="https://api.whatsapp.com/send?text=<?php echo $sharing_text; ?>" title="Compartilhar no WhatsApp" class="btn btn-success btn-sharing" target="_blank">
                     <span>Compartilhar no WhatsApp</span>
                  </a>
               </div>
               <?php if($settings['link_external'] != '') { ?>
               <div class="box-link-external" style="display:none;">
                  <a href="<?php echo esc_url($settings['link_external']); ?>" title="Novo Link" class="btn btn-success btn-link-external" target="_blank">
                     <span>Acesse o link agora</span>
                  </a>
               </div>
               <?php } ?>
            <?php } ?>
            <?php if($settings['sharing'] == '' && $settings['link_external'] != '') { ?>
            <a href="<?php echo esc_url($settings['link_external']); ?>" title="Novo Link" class="btn btn-success btn-link-external" target="_blank" style="padding: 20px 40px; font-size: 1.1em;">
               <span>Acesse o link externo agora</span>
            </a>
            <?php } ?>
         <?php } ?>
      </div>
   </div>

</div>

<script type="text/javascript">
(function () {
  var count = 0;
  jQuery('.btn-sharing').click(function () {
      count += 1;
      if (count >= 1) {
         if (count >= 2) {
            count = 2;
         }
         var percentage = (50 * parseInt(count));
         jQuery(".survey-progressbar-percentage").attr('style', 'width: calc(' + percentage + '%);');
         jQuery("p.text-progressbar").html('<span>' + count + ' </span>de 2');
      }
      <?php if ($settings['link_external'] != '') { ?>
      if (count >= 2) {
         setTimeout(function() {
            //set_link_external();
        }, 500);
      }
      <?php } ?>
      <?php if ($settings['sharing'] == 'yes' && $settings['link_external'] != '') { ?>
      if (count >= 2) {
         setTimeout(function() {
            jQuery('.box-sharing-whatsapp').attr('style', 'display: none;'); 
            jQuery('.box-link-external').attr('style', 'display: block;');
         }, 800);
      }
      <?php } ?>
  });
})();

function show_link_external() {
   jQuery('.box-loading').attr('style', 'display: block;');
   setTimeout(function() {
      jQuery('.box-sharing-whatsapp').attr('style', 'display: none;'); 
      jQuery('.box-link-external').attr('style', 'display: block;'); 
   }, 500);
}

<?php if ($settings['link_external'] != '') { ?>
function set_link_external() {
   jQuery('.box-loading').attr('style', 'display: block;'); 
   location.href="<?php echo $settings['link_external']; ?>";
}
<?php } ?>
</script>
