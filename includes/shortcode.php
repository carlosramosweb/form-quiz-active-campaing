<?php
/**
 * Author:         carlosramosweb
 * Author URI:     http://plugins.criacaocriativa.com
 * @package        form-quiz-active-campaing
 */

if ( ! defined( 'ABSPATH' ) ) {
   exit();
}

$get_settings = get_option( 'form_quiz_active_campaing_settings' );
$settings = $get_settings['settings'];
$colors_fonts = $get_settings['colors_fonts'];
$integration = $get_settings['integration'];
$images = $get_settings['images'];
?>

<div class="box-loading" style="display: none;">
   <div class="loading-gif">
      <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL;?>assets/images/loading.gif" alt="Carregando..." title="Por favor, aguarde.">
   </div>
</div>

<main class="container" style="max-width: 720px; margin: 0 auto;">
    <div class="text text-lg text-ln-1.4 mb-1 text-regular" id="header-questions">
      <div class="center text-center title-main">
        <span class="color-primary text-extrabold">
          <?php echo $settings['title'];?>
        </span>
      </div>
    </div>

   <div class="survey-progressbar-container" style="margin-top: 15px;">
      <div class="display-flex justify-content-space-between align-items-center text-center text-md">
          <div class="btn-arrow-left">
              <span class="box-arrow">
                <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/arrow-left.png" alt="Voltar pra pergunta anterior" class="cursor-pointer" style="">
              </span>
          </div>
          <div class="survey-progressbar">
            <div class="survey-progressbar-percentage" style="width: calc(20%);"></div>
          </div>
          <div class="btn-arrow-right">
            <span class="box-arrow">
               <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/arrow-right.png" alt="Ir pra próxima pergunta" style="">
            </span>
          </div>
      </div>
      <p class="text text-center text-gray text-progressbar" style="font-size: 1.4rem; margin-bottom:5px;"><span>1 </span>de 5</p>
   </div>

   <div class="questions" id="questions">

    <?php 
    $slide_one = '';
    $slide_form = '';
    if($settings['form_position'] == '0') {
      $slide_one = 'style="display:none;"';
      $slide_form = 'style="display:block;"';
      include_once( WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH . 'includes/form-active-campaign.php' );
    } ?>

      <div class="slide-1" <?php echo $slide_one; ?>>
         <h3 class="text text-md text-regular">
            <div class="text-center">
              <?php echo $settings['question_1'];?>
            </div>
         </h3>
        <div class="row">
          <div class="col-md-7 col-centered">
            <?php
            $steps = $images['step-1'];
            if(isset($steps)) {
              if (is_array($steps) && count($steps) > 0) {
                foreach ($steps as $key => $image) {
            ?>
            <div class="col-md-6 col-sm-6">
              <div class="wp-options">
                <?php if(isset($image['image']) && ! empty($image['image'])) { ?>
                <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>uploads/<?php echo $image['image']; ?>" alt="Ícone da Opção" title="<?php echo $image['title']; ?>" style="height: <?php echo $colors_fonts['icon_size_option']; ?>px; max-height: 72px;">
                <?php } ?>
                <h5><?php echo $image['title']; ?></h5>
              </div>
           </div>
           <?php 
                }
              }
            } ?>
          </div>
        </div>
      </div>
      <div class="slide-2" style="display:none;">
         <h3 class="text text-md text-regular">
            <div class="text-center">
              <?php echo $settings['question_2'];?>
            </div>
         </h3>
        <div class="row">
          <div class="col-md-7 col-centered">
            <?php
            $steps = $images['step-2'];
            if(isset($steps)) {
              if (is_array($steps) && count($steps) > 0) {
                foreach ($steps as $key => $image) {
            ?>
            <div class="col-md-6 col-sm-6">
              <div class="wp-options">
                <?php if(isset($image['image']) && ! empty($image['image'])) { ?>
                <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>uploads/<?php echo $image['image']; ?>" alt="Ícone da Opção" title="<?php echo $image['title']; ?>" style="height: <?php echo $colors_fonts['icon_size_option']; ?>px; max-height: 72px;">
                <?php } ?>
                <h5><?php echo $image['title']; ?></h5>
              </div>
           </div>
           <?php 
                }
              }
            } ?>

          </div>
        </div>
      </div>
      <div class="slide-3" style="display:none;">
         <h3 class="text text-md text-regular">
            <div class="text-center">
              <?php echo $settings['question_3'];?>
            </div>
         </h3>
        <div class="row">
          <div class="col-md-7 col-centered">
            <?php
            $steps = $images['step-3'];
            if(isset($steps)) {
              if (is_array($steps) && count($steps) > 0) {
                foreach ($steps as $key => $image) {
            ?>
            <div class="col-md-6 col-sm-6">
              <div class="wp-options">
                <?php if(isset($image['image']) && ! empty($image['image'])) { ?>
                <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>uploads/<?php echo $image['image']; ?>" alt="Ícone da Opção" title="<?php echo $image['title']; ?>" style="height: <?php echo $colors_fonts['icon_size_option']; ?>px; max-height: 72px;">
                <?php } ?>
                <h5><?php echo $image['title']; ?></h5>
              </div>
           </div>
           <?php 
                }
              }
            } ?>

          </div>
        </div>
      </div>
      <div class="slide-4" style="display:none;">
         <h3 class="text text-md text-regular">
            <div class="text-center">
              <?php echo $settings['question_4'];?>
            </div>
         </h3>
        <div class="row">
          <div class="col-md-7 col-centered">
            <?php
            $steps = $images['step-4'];
            if(isset($steps)) {
              if (is_array($steps) && count($steps) > 0) {
                foreach ($steps as $key => $image) {
            ?>
            <div class="col-md-6 col-sm-6">
              <div class="wp-options">
                <?php if(isset($image['image']) && ! empty($image['image'])) { ?>
                <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>uploads/<?php echo $image['image']; ?>" alt="Ícone da Opção" title="<?php echo $image['title']; ?>" style="height: <?php echo $colors_fonts['icon_size_option']; ?>px; max-height: 72px;">
                <?php } ?>
                <h5><?php echo $image['title']; ?></h5>
              </div>
           </div>
           <?php 
                }
              }
            } ?>

          </div>
        </div>
      </div>

    <?php 
    if($settings['form_position'] == '1') {
      $slide_form = 'style="display:none;"';
      include_once( WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH . 'includes/form-active-campaign.php' );
    } ?>

    <?php     
      $slide_sharing = 'style="display:none;"';
      include_once( WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH . 'includes/sharing.php' );
    ?>


    </div>
</main>

<input type="hidden" name="steps_number" class="steps_number" value="1">

<script type="text/javascript">

</script>

<style type="text/css">
.btn-arrow-left,
.btn-arrow-right {

}
.btn-arrow-left:hover,
.btn-arrow-right:hover {
  opacity: 0.5;
}
.survey-progressbar-percentage{
    height:100%;
    background-color:  <?php echo $colors_fonts['progressbar']; ?> !important;
    border-radius:1rem
}
#questions.questions h3 {
  margin: 0 auto;
  margin-bottom: 25px;
  font-size: <?php echo $colors_fonts['title_size_quiz']; ?>rem !important;
}
#questions.questions .wp-options h5 {
    font-family: "Roboto";
    font-weight: bold;
    font-size: <?php echo $colors_fonts['title_size_option']; ?>rem !important;
    color: <?php echo $colors_fonts['color_button_text']; ?> !important;
    margin: 5px 0 !important;
}
#questions.questions .wp-options {
    width: 100%;
    margin: 0 0 25px;
    padding: 15px 0px;
    text-transform: uppercase;
    color: <?php echo $colors_fonts['color_button_text']; ?> !important;
    text-align: center;
    border: solid 3px <?php echo $colors_fonts['border_button']; ?> !important;
    font-weight: bold !important;
    cursor: pointer;
    font-family: "Roboto";
    border-radius: 10px;
    vertical-align: middle;
    background-color: <?php echo $colors_fonts['color_button']; ?> !important;
}
#questions.questions .wp-options:hover,
#questions.questions .wp-options.active:hover,
#questions.questions .wp-options.active {
  background: <?php echo $colors_fonts['color_button_hover']; ?> !important;
  color: <?php echo $colors_fonts['color_button_hover_text']; ?> !important;
}
#header-questions .title-main {
  font-size: <?php echo $colors_fonts['title_size']; ?>rem !important;
}
#questions.questions .wp-options.active {
    background: <?php echo $colors_fonts['color_button_hover']; ?> !important;
    border: solid 3px <?php echo $colors_fonts['border_button']; ?> !important;
    color: <?php echo $colors_fonts['color_button_text']; ?> !important;
}
.box-loading {
   display: none; 
   position: fixed; 
   top:0; 
   left:0; 
   width:100%; 
   height:100%; 
   text-align:center; 
   vertical-align: middle;
   background-color: #ffffffb5;
   z-index: 2;
}
.box-loading .loading-gif{
  margin: 0 auto;
  margin-top: 30%;
  max-width: 100px;
  width: 100px;
  height: 100px;
  position: initial;
  text-align: center;
  z-index: 3;
}
#questions.questions input[type='text'] {
  border: 1px solid #b5b5b5 !important;
  border-bottom: 3px solid <?php echo $colors_fonts['border_button']; ?> !important;
  background-color: #f5f5f5 !important;
}
#questions.questions input::placeholder {
  color: #817575 !important;
  opacity: 1 !important;
  font-weight: bold;
}
#questions.questions .send {
   background-color: <?php echo $colors_fonts['color_button_hover']; ?> !important;
   /*color: <?php echo $colors_fonts['color_button_text']; ?> !important;*/
   color: #FFF !important;
   border: none;
   font-size: 14px;
   text-transform: uppercase;
   padding: 15px 25px;
   text-align: center;
   font-weight: bold;
   border-radius: 5px;
   border: 3px solid <?php echo $colors_fonts['border_button']; ?> !important;
}
#questions.questions .send:hover {
   opacity: 0.5;
}
.btn-arrow-left span,
.btn-arrow-right span {
  box-sizing: border-box; 
  display: inline-block; 
  overflow: hidden; 
  width: 14px; 
  height: 33px; 
  background: none; 
  opacity: 1; 
  border: 0px; 
  margin: 0px; 
  padding: 0px; 
  position: relative; 
  max-width: 100%; 
  cursor: pointer;
}
.btn-sharing {
  background-color: #52e516; 
  padding: 25px 50px; 
  font-size: 16px; 
  color: #1c3e0e;
}
.btn-sharing:hover {
  background-color: rgb(0 255 10);
  opacity: 0.5;
}

<?php if($settings['form_position'] == '0') { ?>
.btn-arrow-left,
.btn-arrow-right {
  display: none;
}
.survey-progressbar {
    width: 100%;
    max-width: 780px;
    margin: 0 auto;
}
<?php } ?>
</style>    
