<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>
  $(document).ready(function () {
    $('[data-toggle="datepicker"]').datepicker({
      format: 'yyyy-mm-dd'
    });
  })
</script>
<main class="container space-y-5 my-5">
  <h2 class="text-title text-2xl font-bold font-heading"><?= $page_title ?></h2>
    
  <form action="" class="space-y-3">
    <h6 class="lg:text-xl text-lg font-bold font-heading mb-3">Registrasi <?=__session('_student')?></h6>
    <div class="flex flex-col lg:flex-row">
      <label for="is_transfer" class="lg:w-1/4 pt-1">Jenis Pendaftaran <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <?=form_dropdown('is_transfer', ['' => 'Pilih :', 'false' => 'Baru', 'true' => 'Pindahan'], set_value('is_transfer'), 'class="form-select w-full" id="is_transfer"')?>
      </div>
    </div>

    <div class="flex flex-col lg:flex-row">
      <label for="admission_type_id" class="lg:w-1/4 pt-1">Jalur Pendaftaran <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <?=form_dropdown('admission_type_id', $admission_types, set_value('admission_type_id'), 'class="form-select w-full" id="admission_type_id"')?>
      </div>
    </div>

    <!-- Khusus SMA/SMK/PT -->
    <?php if (__session('major_count') > 0) { ?>
      <div class="flex flex-col lg:flex-row">
        <label for="first_choice_id" class="lg:w-1/4 pt-1">Pilihan I (Satu) <span style="color: red">*</span></label>
        <div class="lg:w-3/4">
          <?=form_dropdown('first_choice_id', $majors, set_value('first_choice_id'), 'class="form-select w-full" id="first_choice_id" onchange="check_options(1)" onblur="check_options(1)" onmouseup="check_options(1)"')?>
        </div>
      </div>
      <div class="flex flex-col lg:flex-row">
        <label for="second_choice_id" class="lg:w-1/4 pt-1">Pilihan II (Dua) <span style="color: red">*</span></label>
        <div class="lg:w-3/4">
          <?=form_dropdown('second_choice_id', $majors, set_value('second_choice_id'), 'class="form-select w-full" id="second_choice_id" onchange="check_options(2)" onblur="check_options(2)" onmouseup="check_options(2)"')?>
        </div>
      </div>
    <?php } ?>

    <!-- Khusus SMP/Sederajat dan SMA/Sederajat -->
    <?php if (__session('school_level') == 2 || __session('school_level') == 3 || __session('school_level') == 4) { ?>
      <div class="flex flex-col lg:flex-row">
        <label for="prev_school_name" class="lg:w-1/4 pt-1">Nama Sekolah Asal</label>
        <div class="lg:w-3/4">
          <input type="text" value="<?php echo set_value('prev_school_name')?>" class="form-input w-full" id="prev_school_name" name="prev_school_name">
        </div>
      </div>
      <div class="flex flex-col lg:flex-row">
        <label for="prev_school_address" class="lg:w-1/4 pt-1">Alamat Sekolah Asal</label>
        <div class="lg:w-3/4">
          <input type="text" value="<?php echo set_value('prev_school_address')?>" class="form-input w-full" id="prev_school_address" name="prev_school_address">
        </div>
      </div>
      <div class="flex flex-col lg:flex-row">
        <label for="prev_exam_number" class="lg:w-1/4 pt-1">Nomor Peserta Ujian Nasional Sebelumnya</label>
        <div class="lg:w-3/4">
          <input type="text" value="<?php echo set_value('prev_exam_number')?>" class="form-input w-full" id="prev_exam_number" name="prev_exam_number">
        </div>
      </div>
      <div class="flex flex-col lg:flex-row">
        <label for="paud" class="lg:w-1/4 pt-1">Apakah Pernah PAUD</label>
        <div class="lg:w-3/4">
          <?=form_dropdown('paud', ['' => 'Pilih :', 'false' => 'Tidak', 'true' => 'Ya'], set_value('paud'), 'class="form-select w-full" id="paud"')?>
        </div>
      </div>
      <div class="flex flex-col lg:flex-row">
        <label for="tk" class="lg:w-1/4 pt-1">Apakah Pernah TK</label>
        <div class="lg:w-3/4">
          <?=form_dropdown('tk', ['' => 'Pilih :', 'false' => 'Tidak', 'true' => 'Ya'], set_value('tk'), 'class="form-select w-full" id="tk"')?>
        </div>
      </div>
      <div class="flex flex-col lg:flex-row">
        <label for="skhun" class="lg:w-1/4 pt-1">Nomor Seri SKHUN Sebelumnya</label>
        <div class="lg:w-3/4">
          <input type="text" value="<?php echo set_value('skhun')?>" class="form-input w-full" id="skhun" name="skhun" placeholder="Nomor Surat Keterangan Hasil Ujian Nasional">
        </div>
      </div>
      <div class="flex flex-col lg:flex-row">
        <label for="prev_diploma_number" class="lg:w-1/4 pt-1">Nomor Seri Ijazah Sebelumnya</label>
        <div class="lg:w-3/4">
          <input type="text" value="<?php echo set_value('prev_diploma_number')?>" class="form-input w-full" id="prev_diploma_number" name="prev_diploma_number" placeholder="Nomor Seri Ijazah Sebelumnya">
        </div>
      </div>
    <?php } ?>
    <div class="flex flex-col lg:flex-row">
      <label for="hobby" class="lg:w-1/4 pt-1">Hobi</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('hobby')?>" class="form-input w-full" id="hobby" name="hobby">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="ambition" class="lg:w-1/4 pt-1">Cita-Cita</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('ambition')?>" class="form-input w-full" id="ambition" name="ambition">
      </div>
    </div>

    <!-- Biodata -->
    <h6 class="lg:text-xl text-lg font-bold font-heading mb-3">Data Pribadi</h6>
    <div class="flex flex-col lg:flex-row">
      <label for="full_name" class="lg:w-1/4 pt-1">Nama Lengkap <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('full_name')?>" class="form-input w-full" id="full_name" name="full_name">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="gender" class="lg:w-1/4 pt-1">Jenis Kelamin <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <?=form_dropdown('gender', ['' => 'Pilih :', 'M' => 'Laki-laki', 'F' => 'Perempuan'], '', 'class="form-select w-full" id="gender"')?>
      </div>
    </div>

    <!-- Khusus SMP/Sederajat, SMA/Sederajat -->
    <?php if (__session('school_level') == 2 || __session('school_level') == 3 || __session('school_level') == 4) { ?>
      <div class="flex flex-col lg:flex-row">
        <label for="nisn" class="lg:w-1/4 pt-1">NISN</label>
        <div class="lg:w-3/4">
          <input type="text" value="<?php echo set_value('nisn')?>" class="form-input w-full" id="nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional">
        </div>
      </div>
    <?php } ?>

    <!-- Khusus Selain SD -->
    <?php if (__session('school_level') != 1) { ?>
      <div class="flex flex-col lg:flex-row">
        <label for="nik" class="lg:w-1/4 pt-1">NIK <span style="color: red">*</span></label>
        <div class="lg:w-3/4">
          <input type="text" value="<?php echo set_value('nik')?>" class="form-input w-full" id="nik" name="nik" placeholder="Nomor Induk Kependudukan">
        </div>
      </div>
    <?php } ?>

    <div class="flex flex-col lg:flex-row">
      <label for="birth_place" class="lg:w-1/4 pt-1">Tempat Lahir <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('birth_place')?>" class="form-input w-full" id="birth_place" name="birth_place">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="birth_date" class="lg:w-1/4 pt-1">Tanggal Lahir <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <div class="relative">
          <input type="text" readonly class="form-input w-full date" id="birth_date" name="birth_date" data-toggle="datepicker">
          <div class="absolute right-0 mr-3 top-1/2 transform -translate-y-1/2">
            <span class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-calendar text-dark"></i></span>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="religion_id" class="lg:w-1/4 pt-1">Agama <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <?=form_dropdown('religion_id', $religions, set_value('religion_id'), 'class="form-select w-full" id="religion_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="special_need_id" class="lg:w-1/4 pt-1">Kebutuhan Khusus</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('special_need_id', $special_needs, set_value('special_need_id'), 'class="form-select w-full" id="special_need_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="street_address" class="lg:w-1/4 pt-1">Alamat Jalan <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <textarea rows="4" name="street_address" id="street_address" class="form-textarea pt-1 w-full"><?php echo set_value('street_address')?></textarea>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="rt" class="lg:w-1/4 pt-1">RT</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('rt')?>" class="form-input w-full" id="rt" name="rt" placeholder="Rukun Tetangga">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="rw" class="lg:w-1/4 pt-1">RW</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('rw')?>" class="form-input w-full" id="rw" name="rw" placeholder="Rukun Warga">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="sub_village" class="lg:w-1/4 pt-1">Nama Dusun</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('sub_village')?>" class="form-input w-full" id="sub_village" name="sub_village">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="village" class="lg:w-1/4 pt-1">Nama Kelurahan/Desa</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('village')?>" class="form-input w-full" id="village" name="village">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="sub_district" class="lg:w-1/4 pt-1">Kecamatan</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('sub_district')?>" class="form-input w-full" id="sub_district" name="sub_district">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="district" class="lg:w-1/4 pt-1">Kota/Kabupaten <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('district')?>" class="form-input w-full" id="district" name="district">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="postal_code" class="lg:w-1/4 pt-1">Kode Pos</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('postal_code')?>" class="form-input w-full" id="postal_code" name="postal_code">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="residence_id" class="lg:w-1/4 pt-1">Tempat Tinggal</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('residence_id', $residences, set_value('residence_id'), 'class="form-input w-full" id="residence_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="transportation_id" class="lg:w-1/4 pt-1">Moda Transportasi</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('transportation_id', $transportations, set_value('transportation_id'), 'class="form-select w-full" id="transportation_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="mobile_phone" class="lg:w-1/4 pt-1">Nomor HP <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('mobile_phone')?>" class="form-input w-full" id="mobile_phone" name="mobile_phone">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="phone" class="lg:w-1/4 pt-1">Nomor Telepon</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('phone')?>" class="form-input w-full" id="phone" name="phone">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="email" class="lg:w-1/4 pt-1">E-mail Pribadi</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('email')?>" class="form-input w-full" id="email" name="email">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="sktm" class="lg:w-1/4 pt-1">No. Surat Keterangan Tidak Mampu (SKTM)</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('sktm')?>" class="form-input w-full" id="sktm" name="sktm">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="kks" class="lg:w-1/4 pt-1">No. Kartu Keluarga Sejahtera (KKS)</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('kks')?>" class="form-input w-full" id="kks" name="kks">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="kps" class="lg:w-1/4 pt-1">No. Kartu Pra Sejahtera (KPS)</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('kps')?>" class="form-input w-full" id="kps" name="kps">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="kip" class="lg:w-1/4 pt-1">No. Kartu Indonesia Pintar (KIP)</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('kip')?>" class="form-input w-full" id="kip" name="kip">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="kis" class="lg:w-1/4 pt-1">No. Kartu Indonesia Sehat (KIS)</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('kis')?>" class="form-input w-full" id="kis" name="kis">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="citizenship" class="lg:w-1/4 pt-1">Kewarganegaraan <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <select name="citizenship" id="citizenship" class="form-select w-full" onchange="change_country_field()" onblur="change_country_field()" onmouseup="change_country_field()">
          <option value="">Pilih :</option>
          <option value="WNI">Warga Negara Indonesia (WNI)</option>
          <option value="WNA">Warga Negara Asing (WNA)</option>
        </select>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row country">
      <label for="country" class="lg:w-1/4 pt-1">Nama Negara</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('country')?>" class="form-input w-full" id="country" name="country" placeholder="Diisi jika warga negara asing">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="country" class="lg:w-1/4 pt-1">Photo</label>
      <div class="lg:w-3/4">
        <input type="file" id="photo" name="photo">
        <small class="form-text text-muted">Foto harus JPG dan ukuran file maksimal 1 Mb</small>
      </div>
    </div>

    <!-- Ayah -->
    <h6 class="lg:text-xl text-lg font-bold font-heading mb-3">Data Ayah Kandung</h6>
    <div class="flex flex-col lg:flex-row">
      <label for="father_name" class="lg:w-1/4 pt-1">Nama Ayah Kandung <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('father_name')?>" class="form-input w-full" id="father_name" name="father_name">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="father_birth_year" class="lg:w-1/4 pt-1">Tahun Lahir <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('father_birth_year')?>" class="form-input w-full" id="father_birth_year" name="father_birth_year" placeholder="Tahun Lahir Ayah Kandung. contoh : 1965">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="father_education_id" class="lg:w-1/4 pt-1">Pendidikan</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('father_education_id', $educations, set_value('father_education_id'), 'class="form-select w-full" id="father_education_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="father_employment_id" class="lg:w-1/4 pt-1">Pekerjaan</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('father_employment_id', $employments, set_value('father_employment_id'), 'class="form-select w-full" id="father_employment_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="father_monthly_income_id" class="lg:w-1/4 pt-1">Penghasilan Bulanan</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('father_monthly_income_id', $monthly_incomes, set_value('father_monthly_income_id'), 'class="form-select w-full" id="father_monthly_income_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="father_special_need_id" class="lg:w-1/4 pt-1">Kebutuhan Khusus</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('father_special_need_id', $special_needs, set_value('father_special_need_id'), 'class="form-select w-full" id="father_special_need_id"')?>
      </div>
    </div>

    <!-- Ibu -->
    <h6 class="lg:text-xl text-lg font-bold font-heading mb-3">Data Ibu Kandung</h6>
    <div class="flex flex-col lg:flex-row">
      <label for="mother_name" class="lg:w-1/4 pt-1">Nama Ibu Kandung <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('mother_name')?>" class="form-input w-full" id="mother_name" name="mother_name">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="mother_birth_year" class="lg:w-1/4 pt-1">Tahun Lahir</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('mother_birth_year')?>" class="form-input w-full" id="mother_birth_year" name="mother_birth_year" placeholder="Tahun Lahir Ibu Kandung. contoh : 1965">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="mother_education_id" class="lg:w-1/4 pt-1">Pendidikan</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('mother_education_id', $educations, set_value('mother_education_id'), 'class="form-select w-full" id="mother_education_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="mother_employment_id" class="lg:w-1/4 pt-1">Pekerjaan</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('mother_employment_id', $employments, set_value('mother_employment_id'), 'class="form-select w-full" id="mother_employment_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="mother_monthly_income_id" class="lg:w-1/4 pt-1">Penghasilan Bulanan</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('mother_monthly_income_id', $monthly_incomes, set_value('mother_monthly_income_id'), 'class="form-select w-full" id="mother_monthly_income_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="mother_special_need_id" class="lg:w-1/4 pt-1">Kebutuhan Khusus</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('mother_special_need_id', $special_needs, set_value('mother_special_need_id'), 'class="form-select w-full" id="mother_special_need_id"')?>
      </div>
    </div>

    <!-- Wali -->
    <h6 class="lg:text-xl text-lg font-bold font-heading mb-3">Data Wali</h6>
    <div class="flex flex-col lg:flex-row">
      <label for="guardian_name" class="lg:w-1/4 pt-1">Nama Wali</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('guardian_name')?>" class="form-input w-full" id="guardian_name" name="guardian_name">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="guardian_birth_year" class="lg:w-1/4 pt-1">Tahun Lahir</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('guardian_birth_year')?>" class="form-input w-full" id="guardian_birth_year" name="guardian_birth_year" placeholder="Tahun Lahir Wali. contoh : 1965">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="guardian_education_id" class="lg:w-1/4 pt-1">Pendidikan</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('guardian_education_id', $educations, set_value('guardian_education_id'), 'class="form-select w-full" id="guardian_education_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="guardian_employment_id" class="lg:w-1/4 pt-1">Pekerjaan</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('guardian_employment_id', $employments, set_value('guardian_employment_id'), 'class="form-select w-full" id="guardian_employment_id"')?>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="guardian_monthly_income_id" class="lg:w-1/4 pt-1">Penghasilan Bulanan</label>
      <div class="lg:w-3/4">
        <?=form_dropdown('guardian_monthly_income_id', $monthly_incomes, set_value('guardian_monthly_income_id'), 'class="form-select w-full" id="guardian_monthly_income_id"')?>
      </div>
    </div>

    <!-- Data Periodik -->
    <h6 class="lg:text-xl text-lg font-bold font-heading mb-3">Data Periodik</h6>
    <div class="flex flex-col lg:flex-row">
      <label for="height" class="lg:w-1/4 pt-1">Tinggi Badan (Cm)</label>
      <div class="lg:w-3/4">
        <input type="number" value="<?php echo set_value('height')?>" class="form-input w-full" id="height" name="height">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="weight" class="lg:w-1/4 pt-1">Berat Badan (Kg)</label>
      <div class="lg:w-3/4">
        <input type="number" value="<?php echo set_value('weight')?>" class="form-input w-full" id="weight" name="weight">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="mileage" class="lg:w-1/4 pt-1">Jarak Tempat Tinggal ke Sekolah (Km)</label>
      <div class="lg:w-3/4">
        <input type="text" value="<?php echo set_value('mileage')?>" class="form-input w-full" id="mileage" name="mileage">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="traveling_time" class="lg:w-1/4 pt-1">Waktu Tempuh ke Sekolah (Menit)</label>
      <div class="lg:w-3/4">
        <input type="number" value="<?php echo set_value('traveling_time')?>" class="form-input w-full" id="traveling_time" name="traveling_time">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="sibling_number" class="lg:w-1/4 pt-1">Jumlah Saudara Kandung</label>
      <div class="lg:w-3/4">
        <input type="number" value="<?php echo set_value('sibling_number')?>" class="form-input w-full" id="sibling_number" name="sibling_number">
      </div>
    </div>

    <h6 class="lg:text-xl text-lg font-bold font-heading mb-3">Pernyataan dan Keamanan</h6>
    <div class="flex flex-col lg:flex-row">
      <label for="declaration" class="lg:w-1/4 pt-1">Pernyataan <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <div class="form-check">
          <input class="mr-2" type="checkbox" name="declaration" id="declaration">
          <label class="form-check-label" for="declaration">
            Saya menyatakan dengan sesungguhnya bahwa isian data dalam formulir ini adalah benar. Apabila ternyata data tersebut tidak benar / palsu, maka saya bersedia menerima sanksi sesuai ketentuan yang berlaku di <?=__session('school_name')?>
          </label>
        </div>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label class="lg:w-1/4 pt-1"></label>
      <div class="lg:w-3/4">
        <div class="g-recaptcha" data-sitekey="<?=$recaptcha_site_key?>"></div>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row pt-3">
      <span class="lg:w-1/4"></span>
      <button type="button" onclick="student_registration(); return false;" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5"><i class="fa fa-send mr-2"></i> Simpan Formulir Pendaftaran</button>
    </div>
  </form>
</main>