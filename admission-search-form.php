<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>
  $(document).ready(function () {
    $('[data-toggle="datepicker"]').datepicker({
      format: 'yyyy-mm-dd'
    });
  })
</script>
<main class="container space-y-5 my-5 flex-1">
  <h2 class="text-title text-2xl font-bold font-heading"><?= $page_title ?></h2>
    
  <form action="" class="space-y-3">
    <div class="flex flex-col lg:flex-row">
      <label for="registration_number" class="lg:w-1/4 pt-1">Nomor Pendaftaran <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="registration_number" name="registration_number">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="birth_date" class="lg:w-1/4 pt-1">Tanggal Lahir <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <div class="relative">
          <input type="text" readonly class="form-input w-full" id="birth_date" name="birth_date" data-toggle="datepicker">
          <div class="absolute right-0 mr-3 top-1/2 transform -translate-y-1/2">
            <span class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-calendar text-dark"></i></span>
          </div>
        </div>
      </div>
    </div>
    <?php if (NULL !== __session('recaptcha_status') && __session('recaptcha_status') == 'enable') { ?>
      <div class="flex flex-col lg:flex-row">
        <label class="lg:w-1/4 pt-1"></label>
        <div class="lg:w-3/4">
          <div class="g-recaptcha" data-sitekey="<?=$recaptcha_site_key?>"></div>
        </div>
      </div>
    <?php } ?>
    <div class="flex flex-col lg:flex-row pt-3">
      <span class="lg:w-1/4"></span>
      <button type="button" onclick="<?=$onclick?>; return false;" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5"><i class="fa fa-send"></i> <?=$button?></button>
    </div>
  </form>
</main>