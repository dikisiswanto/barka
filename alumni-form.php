<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>
  $(document).ready(function () {
    $('[data-toggle="datepicker"]').datepicker({
      format: 'yyyy-mm-dd'
    });
  })
</script>
<main class="container space-y-5 my-5 flex-1">
  <h2 class="text-title text-2xl font-bold font-heading"><?= ucwords($page_title) ?></h2>
  <form class="space-y-3">
    <div class="flex flex-col lg:flex-row">
      <label for="full_name" class="lg:w-1/4 pt-1">Nama Lengkap <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="full_name" name="full_name">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="gender" class="lg:w-1/4 pt-1">Jenis Kelamin <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <?=form_dropdown('gender', ['' => 'Pilih :', 'M' => 'Laki-laki', 'F' => 'Perempuan'], '', 'class="form-select w-full" id="gender"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="birth_date" class="lg:w-1/4 pt-1">Tanggal Lahir <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <div class="relative">
          <input type="text" readonly class="form-input w-full date" id="birth_date" name="birth_date" data-toggle="datepicker">
          <div class="absolute top-1/2 right-0 mr-3 transform -translate-y-1/2">
            <span class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-calendar text-dark"></i></span>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="end_date" class="lg:w-1/4 pt-1">Tahun Lulus <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="end_date" name="end_date">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="identity_number" class="lg:w-1/4 pt-1"><?=__session('_identity_number')?></label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="identity_number" name="identity_number">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="street_address" class="lg:w-1/4 pt-1">Alamat <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <textarea rows="5" class="form-textarea w-full" id="street_address" name="street_address"></textarea>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="email" class="lg:w-1/4 pt-1">Email <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="email" name="email">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="phone" class="lg:w-1/4 pt-1">Telepon</label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="phone" name="phone">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="mobile_phone" class="lg:w-1/4 pt-1">Handphone</label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="mobile_phone" name="mobile_phone">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="file" class="lg:w-1/4 pt-1">Foto</label>
      <div class="lg:w-3/4">
        <input type="file" id="photo" name="photo">
        <small class="form-text text-muted">Foto harus JPG dan ukuran file maksimal 1 Mb</small>
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
      <button type="button" onclick="alumni_registration(); return false;" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5"><i class="fa fa-send"></i> Kirim</button>
    </div>
  </form>
</main>