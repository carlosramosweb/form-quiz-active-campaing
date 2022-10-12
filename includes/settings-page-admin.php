<?php
/**
 * Author:         carlosramosweb
 * Author URI:     http://plugins.criacaocriativa.com
 * @package        form-quiz-active-campaing
 */

if ( ! defined( 'ABSPATH' ) ) {
   exit();
}

$success = false;
$error = false;

if( isset( $_POST['_wpnonce'] ) ) {
  if ( wp_verify_nonce( $_POST['_wpnonce'], 'form-quiz-active-campaing-update-settings' ) ) {
      $settings = array();
      $settings = get_option( 'form_quiz_active_campaing_settings' );
      if( isset( $_POST['step'] ) && $_POST['step'] == 'settings' ) {
         $settings['settings'] = '';
         $settings['settings'] = array(
            'sharing'            => (isset($_POST['sharing'])) ? $_POST['sharing'] : '',
            'sharing_text'       => (isset($get_settings['sharing_text'])) ? $get_settings['sharing_text'] : 'Olá! Tudo bem? Te recomendo esse link a seguir. Aproveite o máximo!',
            'title'              => (isset($_POST['title'])) ? $_POST['title'] : 'Descubra qual empréstimo é melhor para você',
            'question_1'         => (isset($_POST['question_1'])) ? $_POST['question_1'] : 'Qual tipo de empréstimo você precisa?',
            'question_2'         => (isset($_POST['question_2'])) ? $_POST['question_2'] : 'Qual prazo você quer pagar?',
            'question_3'         => (isset($_POST['question_3'])) ? $_POST['question_3'] : 'De quanto precisa?',
            'question_4'         => (isset($_POST['question_4'])) ? $_POST['question_4'] : 'Como você está na agência de crédito?',
            'question_5'         => (isset($_POST['question_5'])) ? $_POST['question_5'] : 'Seus dados',
            'form_position'      => (isset($_POST['form_position'])) ? $_POST['form_position'] : '1', 
            'autocomplete'       => (isset($_POST['autocomplete'])) ? $_POST['autocomplete'] : 'yes',
            'thank_you_text'          => (isset($_POST['thank_you_text'])) ? $_POST['thank_you_text'] : 'Obrigado!<br/> Em breve um de nossos representante comercial irá entrar em contato com você.',
            'sharing_thank_you_text'          => (isset($_POST['sharing_thank_you_text'])) ? $_POST['sharing_thank_you_text'] : 'Obrigado!<br/>Por favor, compartilhe nossa página com sua família, amigos e conhecidos.',
            'link_external'      => (isset($_POST['link_external'])) ? $_POST['link_external'] : '',           
         ); 
         update_option( 'form_quiz_active_campaing_settings', $settings );
         $success = true;
      }  

      if( isset( $_POST['step'] ) && $_POST['step'] == 'colors-fonts' ) {
         $settings['colors_fonts'] = '';
         $settings['colors_fonts'] = array(
            'progressbar'           => (isset($_POST['progressbar'])) ? $_POST['progressbar'] : '#253c7c',
            'color_button'          => (isset($_POST['color_button'])) ? $_POST['color_button'] : '#ffffff',
            'border_button'         => (isset($_POST['border_button'])) ? $_POST['border_button'] : '#253c7c',
            'color_button_hover'    => (isset($_POST['color_button_hover'])) ? $_POST['color_button_hover'] : '#38529b',
            'color_button_text'     => (isset($_POST['color_button_text'])) ? $_POST['color_button_text'] : '#38529b',
            'color_button_hover_text'=> (isset($_POST['color_button_hover_text'])) ? $_POST['color_button_hover_text'] : '#ffffff',
            'title_size'            => (isset($_POST['title_size'])) ? $_POST['title_size'] : '1.8',
            'title_size_quiz'       => (isset($_POST['title_size_quiz'])) ? $_POST['title_size_quiz'] : '1.4',
            'title_size_option'     => (isset($_POST['title_size_option'])) ? $_POST['title_size_option'] : '0.8',
            'icon_size_option'      => (isset($_POST['icon_size_option'])) ? $_POST['icon_size_option'] : '48',              
         ); 
         update_option( 'form_quiz_active_campaing_settings', $settings );
         $success = true;
      } 

      if( isset( $_POST['step'] ) && $_POST['step'] == 'api-integration' ) {
         $settings['integration'] = '';
         $settings['integration'] = array(
             'url_action'  => (isset($_POST['url_action'])) ? $_POST['url_action'] : 'https://leandrootedescoo.activehosted.com/proc.php',
             'token_api'   => (isset($_POST['token_api'])) ? $_POST['token_api'] : '26a089cba7b9fe79f5ac3f1297f5dc41',             
         ); 
         update_option( 'form_quiz_active_campaing_settings', $settings );
         $success = true;
      } 

      if (isset($_GET['action']) && $_GET['action']=='new-image' || 
         isset($_GET['action']) && $_GET['action']=='edit-image') {

         $get_image = '';
         if ($_GET['action']=='new-image' ) {  
            if (!empty($_FILES['image']['name'])) {
               $get_image = $_FILES['image']['name'];
            }
         }
         if ($_GET['action']=='edit-image' ) {         
            if (!empty($_POST['image_old'])) {
               $get_image = $_POST['image_old'];
            }
            if (!empty($_FILES['image']['name'])) {
               $get_image = $_FILES['image']['name'];
               $destiny = WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH . "uploads/" . $_POST['image_old'];
               if (file_exists($destiny)) {
                  unlink($destiny);
               }
            }
         }

         $step_images = array(
            'title' => (isset($_POST['title'])) ? $_POST['title'] : 'Item Opção',
            'image' => $get_image,
            'created_at' => date("d/m/Y H:i:s")
         );
         if (isset($_GET['type']) && $_GET['type'] == 'insert') {
            if (isset($settings['images'][$_GET['tab']][0])) {
               if (count($settings['images'][$_GET['tab']]) <= 0) {
                  $settings['images'][$_GET['tab']][1] = $step_images;
               } else {
                  $count = (count($settings['images'][$_GET['tab']]));
                  $settings['images'][$_GET['tab']][$count] = $step_images;
               }
            } else {
               $settings['images'][$_GET['tab']] = array(
                  $step_images
               );
            }
         }
         if (isset($_GET['type']) && $_GET['type'] == 'edit') {
            if (isset($settings['images'][$_GET['tab']][$_GET['item']])) {
               $settings['images'][$_GET['tab']][$_GET['item']] = $step_images;
            }
         }
         if(isset($_FILES['image']) && !empty($_FILES['image'])){
            if (isset($_FILES['image']['name']) && ! empty($_FILES['image']['name'])) {
               $directory = WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH . "uploads/";
               if(!is_dir($directory)){ 
                   mkdir($directory, 0777, true);
                   chmod($directory, 0777);
               }
               $file_name = $_FILES['image']['name'];
               $file_tmp = $_FILES['image']['tmp_name'];
               $file_type = $_FILES['image']['type'];
               $destiny = $directory . $file_name;
               if (!file_exists($destiny)) {
                  if(move_uploaded_file($file_tmp, $destiny)){
                     $success = true;
                  } else {
                     $error = true; 
                  }
               }
            }
         }
         update_option( 'form_quiz_active_campaing_settings', $settings );
         $success = true;
      }
   } else {
      $error = true;         
   }
}

if( isset( $_GET['_wpnonce'] ) ) {
  if ( wp_verify_nonce( $_GET['_wpnonce'], 'form-quiz-active-campaing-update-settings' ) ) {
      $settings = array();
      $settings = get_option( 'form_quiz_active_campaing_settings' );
      if (isset($_GET['action']) && $_GET['action']=='delete') {
         if (isset($_GET['image_old']) && !empty($_GET['image_old']) ) {
            $destiny = WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH . "uploads/" . $_GET['image_old'];
            if (file_exists($destiny)) {
               unlink($destiny);
            }
         }
         unset($settings['images'][$_GET['tab']][$_GET['item']]);
         update_option( 'form_quiz_active_campaing_settings', $settings );
         $success = true;
      }
      if (isset($_GET['subaction']) && $_GET['subaction']=='delete-image') {
         $destiny = WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH . "uploads/" . $_GET['image_old'];
         if (file_exists($destiny)) {
            unlink($destiny);
         }
         $settings['images'][$_GET['tab']][$_GET['item']]['image'] = '';
         update_option( 'form_quiz_active_campaing_settings', $settings );
         $success = true;
      }
   } else {
      $error = true;         
   }
}

$get_settings = get_option( 'form_quiz_active_campaing_settings' );
$settings = $get_settings['settings'];
$colors_fonts = $get_settings['colors_fonts'];
$integration = $get_settings['integration'];
$images = $get_settings['images'];

$tab_settings = (!isset($_GET['tab'])) ? 'nav-tab-active' : '';
$tab_integration = (isset($_GET['tab']) && $_GET['tab'] == 'api-integration') ? 'nav-tab-active' : '';
$tab_colors_fonts = (isset($_GET['tab']) && $_GET['tab'] == 'colors-fonts') ? 'nav-tab-active' : '';
$tab_step_1 = (isset($_GET['tab']) && $_GET['tab'] == 'step-1') ? 'nav-tab-active' : '';
$tab_step_2 = (isset($_GET['tab']) && $_GET['tab'] == 'step-2') ? 'nav-tab-active' : '';
$tab_step_3 = (isset($_GET['tab']) && $_GET['tab'] == 'step-3') ? 'nav-tab-active' : '';
$tab_step_4 = (isset($_GET['tab']) && $_GET['tab'] == 'step-4') ? 'nav-tab-active' : '';
$tab_help = (isset($_GET['tab']) && $_GET['tab'] == 'help') ? 'nav-tab-active' : '';

$item = '';
$step_item = '';
$step_title = '';
$step_image = '';
$step_created_at = date('d/m/Y H:i:s');

if(isset($_GET['action']) && $_GET['action'] == 'edit-image') {
   $item = $_GET['item'];
   $step_item = $images[$_GET['tab']][$item];
   $step_title = $step_item['title'];
   $step_image = $step_item['image'];
   $step_created_at = date('d/m/Y H:i:s');
}
?>

<div class="wrap">
   <h1 class="wp-heading-inline">
      Configurações Form Quiz
   </h1>
   <div style="width: 100%; max-width: 600px;">
      <p>Abaixo está disponibilizado os recursos de edição do plugin.<br/>
      Para começar, escolha a posição de entrada do formulário e em seguida os textos, cores, dados de integração para envio dos Leeds e títulos das opções de respostas e´seus respectivos ícones.</p>
   </div>

   <h2 class="nav-tab-wrapper wp-clearfix" style="margin-bottom: 30px;"> 
      <a href="admin.php?page=form-quiz-active-campaing-page" class="nav-tab <?php echo $tab_settings; ?>">
         Configurações
      </a> 
      <a href="admin.php?page=form-quiz-active-campaing-page&tab=colors-fonts" class="nav-tab <?php echo $tab_colors_fonts; ?>">
         Cores e Fontes
      </a>
      <a href="admin.php?page=form-quiz-active-campaing-page&tab=api-integration" class="nav-tab <?php echo $tab_integration; ?>">
         Integração
      </a> 
      <a href="admin.php?page=form-quiz-active-campaing-page&tab=step-1" class="nav-tab <?php echo $tab_step_1; ?>">
         1ª Etapa
      </a> 
      <a href="admin.php?page=form-quiz-active-campaing-page&tab=step-2" class="nav-tab <?php echo $tab_step_2; ?>">
         2ª Etapa
      </a> 
      <a href="admin.php?page=form-quiz-active-campaing-page&tab=step-3" class="nav-tab <?php echo $tab_step_3; ?>">
         3ª Etapa
      </a> 
      <a href="admin.php?page=form-quiz-active-campaing-page&tab=step-4" class="nav-tab <?php echo $tab_step_4; ?>">
         4ª Etapa
      </a>
      <a href="admin.php?page=form-quiz-active-campaing-page&tab=help" class="nav-tab <?php echo $tab_help; ?>">
         Ajuda
      </a> 
   </h2>

<?php if ($success) { ?>
<div class="updated inline notice notice-success" style="margin-top: 20px;">
   <p><strong>Sucesso!</strong> Atualizamos as alterações desse plugin.</p>
   <button type="button" class="notice-dismiss">
      <span class="screen-reader-text">
         Fechar Notificação.
      </span>
   </button>
</div>
<?php } ?>

<?php if ($error) { ?>
<div class="error inline notice notice-error" style="margin-top: 20px;">
   <p><strong>Erro!</strong> Erro ao tentar altera as configurações desse plugin.</p>
   <button type="button" class="notice-dismiss">
      <span class="screen-reader-text">
         Fechar Notificação.
      </span>
   </button>
</div>
<?php } ?>

<?php if (!isset($_GET['tab'])) { ?>
<div id="step-1" class="step-1">
   <form action="admin.php?page=form-quiz-active-campaing-page" method="post">
      <table class="form-table">
         <tbody>
            <tr valign="top">
               <td scope="row" style="width: 100px;">
                  <label for="shortcode">
                     Seu ShortCode<br/>
                     <strong>Copie e Cole</strong>
                  </label>
               </td>
               <td class="forminp forminp-text" style="width: 30%;">
                  [form_quiz_active_campaing_shortcode]
               </td>
               <td scope="row" style="width: 100px;">
                  <label for="title">
                     Título<br/>
                     <strong>Título Principal</strong>
                  </label>
               </td>
               <td class="forminp forminp-text" style="width: 30%;">
                  <input name="title" type="text" value="<?php echo $settings['title']; ?>" class="" placeholder="" style="width: 100%; max-width: 400px;">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="sharing">
                     WhatsApp<br/>
                     <strong>Link do Quiz</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <label for="sharing">
                     <input name="sharing" id="sharing" type="checkbox" class="" value="yes" <?php if($settings['sharing'] == 'yes') { echo 'checked'; } ?>>
                     Habilitar Compartilhamento
                  </label>
               </td>
               <td scope="row">
                  <label for="question_1">
                     1ª Pergunta<br/>
                     <strong>Texto da Pergunta</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="question_1" type="text" value="<?php echo $settings['question_1']; ?>" class="" placeholder="" style="width: 100%; max-width: 400px;">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row" valign="top">
                  <label for="sharing_text">
                     Enviar WhatsApp<br/>
                     <strong>Texto Compartilhado</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <textarea name="sharing_text" cols="5" rows="5" placeholder="" style="width: 100%; max-width: 400px;"><?php echo $settings['sharing_text']; ?></textarea>
               </td>
               <td scope="row">
                  <label for="question_2">
                     2ª Pergunta<br/>
                     <strong>Texto da Pergunta</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="question_2" type="text" value="<?php echo $settings['question_2']; ?>" class="" placeholder="" style="width: 100%; max-width: 400px;">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="question_5">
                     Formulário<br/>
                     <strong>Título Formulário</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="question_5" type="text" value="<?php echo $settings['question_5']; ?>" class="" placeholder="" style="width: 100%; max-width: 400px;">
               </td>
               <td scope="row">
                  <label for="question_3">
                     3ª Pergunta<br/>
                     <strong>Texto da Pergunta</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="question_3" type="text" value="<?php echo $settings['question_3']; ?>" class="" placeholder="" style="width: 100%; max-width: 400px;">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="form_position">
                     Posição do Formulário<br/>
                     <strong>Ordem de Exibição</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <select name="form_position" class="" style="min-width: 200px;" required>
                     <option value="0" <?php if($settings['form_position'] == '0') { echo 'selected'; } ?>>Em Primeiro Lugar</option>
                     <option value="1" <?php if($settings['form_position'] == '1') { echo 'selected'; } ?>>Em Último Lugar</option>
                  </select>
               </td>
               <td scope="row">
                  <label for="question_4">
                     4ª Pergunta<br/>
                     <strong>Texto da Pergunta</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="question_4" type="text" value="<?php echo $settings['question_4']; ?>" class="" placeholder="" style="width: 100%; max-width: 400px;">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="question_4">
                     E-mail Autocomplete<br/>
                     <strong>Recurso do Formulário</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <label for="autocomplete">
                     <input name="autocomplete" id="autocomplete" type="checkbox" class="" value="yes" checked="">
                     Habilitar E-mail Autocomplete
                  </label>
               </td>
               <td scope="row">
                  <label for="link_external">
                     Link Externo<br/>
                     <strong>Direcionamento Internauta</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="link_external" type="url" value="<?php echo $settings['link_external']; ?>" class="" placeholder="https://" style="width: 100%; max-width: 400px;">
                  <br/><i><strong>Obs:</strong> Deixe vazio para não direcionar o Internauta.</i>
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="thank_you_text">
                     Texto de Obrigado<br/>
                     <strong>Recurso Final do Formulário</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <label for="thank_you_text">
                  <textarea name="thank_you_text" cols="5" rows="5" placeholder="" style="width: 100%; max-width: 400px;"><?php echo $settings['thank_you_text']; ?></textarea>
                  </label>
               </td>
               <td scope="row">
                  <label for="link_external">
                     Texto de Compartilhamento<br/>
                     <strong>Recurso Final do Formulário</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <label for="sharing_thank_you_text">
                  <textarea name="sharing_thank_you_text" cols="5" rows="5" placeholder="" style="width: 100%; max-width: 400px;"><?php echo $settings['sharing_thank_you_text']; ?></textarea>
                  </label>
               </td>
            </tr>
         </tbody>
      </table>

      <p class="submit">
         <input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce('form-quiz-active-campaing-update-settings') ); ?>">
         <input type="hidden" name="step" value="settings">
         <input type="submit" name="submit" id="submit" class="button button-primary" value="Salvar Alterações">
      </p>
   </form>

</div>
<?php } ?>

<?php if (isset($_GET['tab']) && $_GET['tab']=='colors-fonts') { ?>
<div id="step-6" class="step-6">
   <form action="admin.php?page=form-quiz-active-campaing-page&tab=colors-fonts" method="post">
      <table class="form-table">
         <tbody>
            <tr valign="top">
               <td scope="row" style="width: 150px;">
                  <label for="progressbar">
                     Progresso<br/>
                     <strong>Cor da Barra</strong>
                  </label>
               </td>
               <td class="forminp forminp-text" style="width: 150px;">
                  <input name="progressbar" type="color" style="width: 30px; height: 30px; border: 0; padding: 0; margin: 0;" value="<?php echo $colors_fonts['progressbar']; ?>" class="" placeholder="">
               </td>
               <td scope="row" style="width: 150px;">
                  <label for="color_button">
                     Botões<br/>
                     <strong>Cor de fundo</strong>
                  </label>
               </td>
               <td class="forminp forminp-text" style="width: 150px;">
                  <input name="color_button" type="color" style="width: 30px; height: 30px; border: 0; padding: 0; margin: 0;" value="<?php echo $colors_fonts['color_button']; ?>" class="" placeholder="">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="border_button">
                     Botões<br/>
                     <strong>Cor de borda</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="border_button" type="color" style="width: 30px; height: 30px; border: 0; padding: 0; margin: 0;" value="<?php echo $colors_fonts['border_button']; ?>" class="" placeholder="">
               </td>
               <td scope="row">
                  <label for="color_button_hover">
                     Botões ao passar o Mouse<br/>
                     <strong>Cor de fundo</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="color_button_hover" type="color" style="width: 30px; height: 30px; border: 0; padding: 0; margin: 0;" value="<?php echo $colors_fonts['color_button_hover']; ?>" class="" placeholder="">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="color_button_text">
                     Botões Normal<br/>
                     <strong>Cor do texto</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="color_button_text" type="color" style="width: 30px; height: 30px; border: 0; padding: 0; margin: 0;" value="<?php echo $colors_fonts['color_button_text']; ?>" class="" placeholder="">
               </td>
               <td scope="row">
                  <label for="color_button_hover_text">
                     Botões ao passar o Mouse<br/>
                     <strong>Cor do texto</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="color_button_hover_text" type="color" style="width: 30px; height: 30px; border: 0; padding: 0; margin: 0;" value="<?php echo $colors_fonts['color_button_hover_text']; ?>" class="" placeholder="">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="title_size">
                     Título Principal<br/>
                     <strong>Tamanho da Fonte</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <select name="title_size" class="" required>
                     <option value="2.4" <?php if($colors_fonts['title_size']=='2.4') { echo 'selected'; }?>>2.4rem</option>
                     <option value="1.8" <?php if($colors_fonts['title_size']=='1.8') { echo 'selected'; }?>>1.8rem</option>
                     <option value="1.4" <?php if($colors_fonts['title_size']=='1.4') { echo 'selected'; }?>>1.4rem</option>
                  </select>
               </td>
               <td scope="row">
                  <label for="title_size_quiz">
                     Título da Pergunta<br/>
                     <strong>Tamanho da Fonte</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <select name="title_size_quiz" class="" required>
                     <option value="2.4" <?php if($colors_fonts['title_size_quiz']=='2.4') { echo 'selected'; }?>>2.4rem</option>
                     <option value="1.8" <?php if($colors_fonts['title_size_quiz']=='1.8') { echo 'selected'; }?>>1.8rem</option>
                     <option value="1.4" <?php if($colors_fonts['title_size_quiz']=='1.4') { echo 'selected'; }?>>1.4rem</option>
                  </select>
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="title_size_option">
                     Texto das Opções<br/>
                     <strong>Tamanho da Fonte</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <select name="title_size_option" class="" required>
                     <option value="2.4" <?php if($colors_fonts['title_size_option']=='2.4') { echo 'selected'; }?>>2.4rem</option>
                     <option value="1.8" <?php if($colors_fonts['title_size_option']=='1.8') { echo 'selected'; }?>>1.8rem</option>
                     <option value="1.1" <?php if($colors_fonts['title_size_option']=='1.1') { echo 'selected'; }?>>1.1rem</option>
                     <option value="1.0" <?php if($colors_fonts['title_size_option']=='1.0') { echo 'selected'; }?>>1.0rem</option>
                     <option value="0.8" <?php if($colors_fonts['title_size_option']=='0.8') { echo 'selected'; }?>>0.8rem</option>
                  </select>
               </td>
               <td scope="row">
                  <label for="icon_size_option">
                     Ícones das Opções<br/>
                     <strong>Tamanho da Imagem</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <select name="icon_size_option" class="" required>
                     <option value="32" <?php if($colors_fonts['icon_size_option']=='32') { echo 'selected'; }?>>32px</option>
                     <option value="48" <?php if($colors_fonts['icon_size_option']=='48') { echo 'selected'; }?>>48px</option>
                     <option value="60" <?php if($colors_fonts['icon_size_option']=='60') { echo 'selected'; }?>>60px</option>
                     <option value="72" <?php if($colors_fonts['icon_size_option']=='72') { echo 'selected'; }?>>72px</option>
                  </select>
               </td>
            </tr>
         </tbody>
      </table>

      <p class="submit">
         <input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce('form-quiz-active-campaing-update-settings') ); ?>">
         <input type="hidden" name="step" value="colors-fonts">
         <input type="submit" name="submit" id="submit" class="button button-primary" value="Salvar Alterações">
      </p>
   </form>

</div>
<?php } ?>

<?php if (isset($_GET['tab']) && $_GET['tab']=='api-integration') { ?>
<div id="step-5" class="step-5">

   <div class="error inline notice notice-error" style="margin-top: 20px;">
      <p>
         <strong style="font-weight: bold;">Alerta!</strong> 
         Preencha os campos abaixou para integrar a sua 
         lista de inscritos da <strong style="font-weight: bold;">ActiveCampaign</strong>.
      </p>
      <button type="button" class="notice-dismiss">
         <span class="screen-reader-text">
            Descartar essa notificação.
         </span>
      </button>
   </div>

   <form action="admin.php?page=form-quiz-active-campaing-page&tab=api-integration" method="post">
      <table class="form-table">
         <tbody>
            <tr valign="top">
               <td scope="row" style="width: 15%;">
                  <label for="url_action">
                     Url de Ação<br/>
                     <strong>Link do Formuário</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="url_action" type="url" style="width: 100%; max-width: 400px;" value="<?php echo $integration['url_action']; ?>" class="" placeholder="">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="token_api">
                     Chave de Integração<br/>
                     <strong>Token do Formuário</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <input name="token_api" type="text" style="width: 100%; max-width: 400px;" value="<?php echo $integration['token_api']; ?>" class="" placeholder="">
               </td>
            </tr>
            <tr valign="top">
               <td scope="row">
                  <label for="token_api">
                     Tutorial<br/>
                     <strong>Link de Ajuda</strong>
                  </label>
               </td>
               <td class="forminp forminp-text">
                  <div style="max-width: 400px;">
                     <a href="admin.php?page=form-quiz-active-campaing-page&tab=help" title="Tutorial de integração">Clique Aqui</a> para ver o passo a passo de como fazer a integrar de um Formulário da ActiveCampaing.
                  </div>
               </td>
            </tr>
         </tbody>
      </table>

      <p class="submit">
         <input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce('form-quiz-active-campaing-update-settings') ); ?>">
         <input type="hidden" name="step" value="api-integration">
         <input type="submit" name="submit" id="submit" class="button button-primary" value="Salvar Alterações">
      </p>
   </form>

</div>
<?php } ?>

<?php if (isset($_GET['form']) && $_GET['form']=='open' && !isset($_GET['type'])) { ?>
   <?php 
   if (isset($_GET['action']) && $_GET['action']=='new-image') {
      $action = 'new-image'; 
      $action_image = 'insert';
   } else { 
      $action = 'edit-image'; 
      $action_image = 'edit';
   }
   $item = '';
   if (isset($_GET['item'])) {
      $item = '&item=' . $_GET['item'];
   }
?>
<form action="admin.php?page=form-quiz-active-campaing-page&tab=<?php echo $_GET['tab']; ?>&form=open&action=<?php echo $action; ?><?php echo $item; ?>&type=<?php echo $action_image; ?>" method="post" style="background-color: #FFF; padding: 0px 20px 10px; border-radius: 10px; border: 5px solid #516c6c; margin-top: 20px;" enctype="multipart/form-data">
   <table class="form-table" cellspacing="0" cellpadding="0">
   <thead>
     <tr>
       <th colspan="2" style="padding: 8px;">
          <h3 style="margin: 10px 0;">Preencha os campos abaixo:</h3>
       </th>
     </tr>
   </thead>
   <tbody>
     <tr>
       <td style="padding: 8px;">
         <strong>Título:</strong>
      </td>
       <td class="forminp forminp-text" style="padding: 8px;">
         <input name="title" type="text" class="" style="width: 100%; max-width: 450px;" value="<?php echo $step_title; ?>" required placeholder="Digite aqui o termo para opção dessa Etapa...">
      </td>
     </tr>
      <?php if (!empty($step_image)) { ?>
     <tr>
       <td style="padding: 8px;">
         <strong>Imagem atual:</strong>
      </td>
       <td style="padding: 8px; vertical-align: middle;">
         <?php $create_nonce = esc_attr( wp_create_nonce('form-quiz-active-campaing-update-settings') ); ?>
          <img alt="" src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL . 'uploads/' . $step_image; ?>" style="display: inline-block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;">

            <a href="admin.php?page=form-quiz-active-campaing-page&tab=step-1&action=edit-image&subaction=delete-image&form=open&item=<?php echo $_GET['item']; ?>&_wpnonce=<?php echo $create_nonce; ?>&image_old=<?php echo $step_image; ?>" class="button btn btn-danger" style="display: inline-block; margin: 20px 10px 0;">
               Apagar Imagem?
            </a>
       </td>
     </tr>
     <?php } ?>
     <tr>
       <td style="padding: 8px;">
         <strong>Ícone:</strong>
      </td>
       <td style="padding: 8px;">
         <div class="ff_fileupload_dropzone_wrap" style="max-width: 450px;">
            <div id="box-upload-images" class="ff_fileupload_dropzone">
               <input type="file" name="image" accept=".png, .jpg, .jpeg, .gif, .webp" class="input-images" id="input-upload-images" value="<?php echo $step_image; ?>">
            </div>
         </div>
         <br/><i><strong style="color:red;">Importante: </strong>Edite antes sua imagem para as dimensões de uma quadrado.</i>
         <br/><i><strong>Obs: </strong>Envie imagens com as extensões: .png - .jpg - .jpeg - .gif - .webp</i>
      </td>
     </tr>
   </tbody>
   </table>
   <p class="submit">
      <input type="hidden" name="image_old" value="<?php echo $step_image; ?>">
      <input type="hidden" name="created_at" value="<?php echo $step_created_at; ?>">
      <input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce('form-quiz-active-campaing-update-settings') ); ?>">
      <input type="submit" name="submit" id="submit" class="button button-primary" value="Salvar Opcional">
   </p>
</form>

<style type="text/css">
.ff_fileupload_dropzone {
    display: block;
    width: 100%;
    height: 100px;
    min-height: 125px;
    box-sizing: border-box;
    border: 2px dashed #e9edf4;
    border-radius: 5px;
    padding: 0;
    background-color: #c0c0dd;
    background-image: url(<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/fancy_upload.png);
    background-repeat: no-repeat;
    background-position: center center;
    opacity: 0.85;
    cursor: pointer;
    outline: none;
}
.ff_fileupload_dropzone .input-images {
   width: 100%; 
   height: 100%; 
   opacity: 0;
}
</style>

<script type="text/javascript">  
jQuery("#input-upload-images").change(function() { 
    var image_value = jQuery("#input-upload-images").val();  
    if(image_value) {        
        jQuery('.ff_fileupload_dropzone').attr('style', 'background-image: none; background-color:#8ed5c0; background-image: url(<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/fancy_checked.png); border: 2px dashed #547a6f;');
        jQuery('.loading-project.upload-images').attr('style', 'display: block;');
    } 
});
</script>
<?php } ?>

<?php if (isset($_GET['tab'])) { ?>
   <?php if ($_GET['tab']=='step-1' || $_GET['tab']=='step-2' ||
      $_GET['tab']=='step-3' || $_GET['tab']=='step-4') { ?>
   <div id="wpbody" role="main">
      <div class="wrap">

         <a href="admin.php?page=form-quiz-active-campaing-page&tab=<?php echo $_GET['tab']; ?>&form=open&action=new-image" class="page-title-action button-large" style="margin-top:20px;">
            Adicionar Novo
         </a>
         <br/>

         <table class="wp-list-table widefat fixed striped posts" style="margin-top: 20px">
            <thead>
               <tr>
                  <th class="slug-id" style="text-align: center;width: 30px;">
                     <strong>ID</strong>
                  </th>
                  <th class="slug-post-type" style="text-align: center; width: 60px;">
                     <strong>Ícone</strong>
                  </th>
                  <th class="slug-languages">
                     <strong>Texto da Pergunta</strong>
                  </th>
                  <th class="slug-original" style="text-align: center; width: 130px;">
                     <strong>Publicado em</strong>
                  </th>
                  <th class="slug-action" style="text-align: center; width: 140px;">
                     <strong>Ação</strong>
                  </th>
               </tr>
            </thead>
            <tbody id="the-list">
               <?php
               $steps = $images[$_GET['tab']];
               if(isset($steps)) {
                  if (is_array($steps) && count($steps) > 0) {
                     $j = 1;
                  foreach ($steps as $key => $image) { ?>
               <tr class="inactive">
                  <td style="text-align: center; vertical-align: middle;">
                     <?php echo $j; ?>
                  </td>
                  <td style="text-align: center; vertical-align: middle;">
                     <span class="ac-image -cover">
                        <?php if (isset($image['image']) && ! empty($image['image'])) {
                           echo '<img style="height:60px" src="' . WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL . 'uploads/' . $image['image'] . '" alt="">';
                        } else {
                           echo '<img style="height:60px" src="' . WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL . 'assets/images/icon-option-image.jpg" alt="">';
                        }?>
                     </span>
                  </td>
                  <td style="vertical-align: middle;">
                     <?php echo $image['title']; ?>
                  </td>
                  <td style="text-align: center; vertical-align: middle;">
                     <?php echo $image['created_at']; ?>
                  </td>
                  <td style="text-align: center; vertical-align: middle;">
                     <?php $create_nonce = esc_attr( wp_create_nonce('form-quiz-active-campaing-update-settings') ); ?>
                     <a href="admin.php?page=form-quiz-active-campaing-page&tab=<?php echo $_GET['tab']; ?>&form=open&action=edit-image&item=<?php echo $key; ?>&_wpnonce=<?php echo $create_nonce; ?>" class="button button-primary">
                        Editar
                     </a>
                     <a href="admin.php?page=form-quiz-active-campaing-page&tab=<?php echo $_GET['tab']; ?>&action=delete&item=<?php echo $key; ?>&_wpnonce=<?php echo $create_nonce; ?>&image_old<?php echo $image['image']; ?>" class="button btn btn-danger">
                        Apagar
                     </a>
                  </td>
               </tr>
                     <?php $j++; } ?>
                  <?php } ?>
               <?php } else { ?>
               <tr>
                  <td style="vertical-align: middle; background-color: #c4c4c6;"  colspan="5">
                     Nenhum item cadastrado.
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>

         <br/>
         <a href="admin.php?page=form-quiz-active-campaing-page&tab=<?php echo $_GET['tab']; ?>&form=open&action=new-image" class="page-title-action button-large">
            Adicionar Novo
         </a>

      </div>
   </div>
   <?php } ?>
<?php } ?>

<?php if (isset($_GET['tab']) && $_GET['tab']=='help') { ?>
   <div id="wpbody" role="main">
      <div class="wrap">
         <h4><strong>Página de Ajuda</strong></h4>
         <div style="width: 100%; max-width: 400px; margin-bottom: 20px;">
            <p>Veja <strong>o passo a passo</strong> de como você poderá integrar o <strong>Form Quiz ActiveCampaing</strong> com a sua <strong>lista de Leeds na ActiveCampaing.</strong></p>
         </div>

         <div style="width: 100%; max-width: 600px; margin-bottom: 20px;">
            <p><strong>Primeiro Passo:</strong> Faça o login no sistema da <a href="https://activecampaign.com/login" target="_blank" title="Clique para fazer login na ActiveCampaing.">ActiveCampaing</a></p>
            <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/integration/screenshot-1.jpg" alt="Screenshot Help" title="Faça o login no sistema da ActiveCampaing" style="margin: 0; padding: 0; display:block;">
            <p>[Screenshot Help 1]</p>
            <hr/>
         </div>

         <div style="width: 100%; max-width: 600px; margin-bottom: 20px;">
            <p><strong>Segundo Passo:</strong> Após ter feito o login no sistema da ActiveCampaing, clique no <b>Menu Site</b>.</p>
            <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/integration/screenshot-2.jpg" alt="Screenshot Help" title="Faça o login no sistema da ActiveCampaing" style="margin: 0; padding: 0; display:block;">
            <p>[Screenshot Help 2]</p>
            <hr/>
         </div>

         <div style="width: 100%; max-width: 600px; margin-bottom: 20px;">
            <p><strong>Terceiro Passo:</strong> No submenu formulário escolha o que deseja integrar no plugin. Clique na seta do lado direito do menu Editar. Logo após, em Integre.</p>
            <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/integration/screenshot-3.jpg" alt="Screenshot Help" title="Faça o login no sistema da ActiveCampaing" style="margin: 0; padding: 0; display:block;">
            <p>[Screenshot Help 3]</p>
            <hr/>
         </div>

         <div style="width: 100%; max-width: 600px; margin-bottom: 20px;">
            <p><strong>Quarto Passo:</strong> Na Aba Incorporar, vá na barra de rolagem do campo Incorporação Completa.</p>
            <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/integration/screenshot-4.jpg" alt="Screenshot Help" title="Faça o login no sistema da ActiveCampaing" style="margin: 0; padding: 0; display:block;">
            <p>[Screenshot Help 4]</p>
            <hr/>
         </div>

         <div style="width: 100%; max-width: 600px; margin-bottom: 20px;">
            <p><strong>Quinto Passo:</strong> procure pela Tag HTML do formulário em <strong>Action</strong> copie o link e cole na <a href="admin.php?page=form-quiz-active-campaing-page&tab=api-integration" target="_blank"><strong> Aba Integrar do plugin</strong></a> no campo <strong>Url de Ação - Link do Formuário</strong>. Logo após procure um campo(input) invisivel(hidden) no HTML do formulário e copie o valor do campo nome <strong>or</strong>, e cole no campo <strong>Chave de Integração - Token do Formuário</strong>.</p>
            <p><strong>Pronto!</strong> Salve e teste e aproveite o plugin.</p>
            <img src="<?php echo WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL; ?>assets/images/integration/screenshot-5.jpg" alt="Screenshot Help" title="Faça o login no sistema da ActiveCampaing" style="margin: 0; padding: 0; display:block;">
            <p>[Screenshot Help 5]</p>
            <hr/>
         </div>

      </div>
   </div>
<?php } ?>

<style type="text/css">
.wp-core-ui .btn.btn-danger {
    color: #ffffff;
    border-color: #992c24;
    background: #f44336 !important;
    vertical-align: top;
}
strong {
    font-weight: bold;
}
</style>