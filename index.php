<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php defined('THEME_PATH') or define('THEME_PATH', 'themes/barka/') ?>
<?php defined('THEME_VERSION') or define('THEME_VERSION', 'v1.4.1') ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <?php $this->load->view(THEME_PATH . 'components/meta') ?>
  <?php $this->load->view(THEME_PATH . 'components/source_css') ?>
  
  <script type="text/javascript">
  const _BASE_URL = '<?=base_url();?>';
  const _CURRENT_URL = '<?=current_url();?>';
  const _SCHOOL_LEVEL = '<?=__session('school_level');?>';
  const _ACADEMIC_YEAR = '<?=__session('_academic_year');?>';
  const _STUDENT = '<?=__session('_student');?>';
  const _IDENTITY_NUMBER = '<?=__session('_identity_number');?>';
  const _EMPLOYEE = '<?=__session('_employee');?>';
  const _HEADMASTER = '<?=__session('_headmaster');?>';
  const _MAJOR = '<?=__session('_major');?>';
  const _SUBJECT = '<?=__session('_subject');?>';
  const _RECAPTCHA_STATUS = '<?=(NULL !== __session('recaptcha_status') && __session('recaptcha_status') == 'enable') ? 'true': 'false';?>'=='true';
  </script>

  <?php $this->load->view(THEME_PATH . 'components/source_js') ?>
  <noscript>You need to enable javaScript to run this app.</noscript>
</head>
<body class="flex flex-col min-h-screen">
  <?php $this->load->view(THEME_PATH . 'components/header') ?>

  <?php $this->load->view($content)?>

  <!-- COPYRIGHT - DO NOT MODIFY!-->
    <?php $this->load->view(THEME_PATH . 'components/footer') ?>
  <!-- END COPYRIGHT -->

</body>
</html>
