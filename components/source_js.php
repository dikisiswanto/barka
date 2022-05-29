<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php if (NULL !== __session('recaptcha_status') && __session('recaptcha_status') == 'enable') : ?>
  <script src="https://www.google.com/recaptcha/api.js?hl=id" async defer></script>
<?php endif ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= base_url('views/'. THEME_PATH . 'assets/js/frontend.min.js') ?>"></script>
<script src="<?= base_url('views/'. THEME_PATH . 'assets/js/script.min.js?' . THEME_VERSION) ?>"></script>