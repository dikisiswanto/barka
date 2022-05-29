<?php $image_sliders = get_image_sliders() ?>
<?php if($image_sliders->num_rows() > 0) : ?>
  <section class="owl-carousel o-slider w-full max-h-full max-w-slider mx-auto">
    <?php foreach($image_sliders->result() as $slider) : ?>
      <figure class="lg:h-slider h-48 w-full">
        <img src="<?= base_url('media_library/image_sliders/'.$slider->image) ?>" alt="foto slider" class="lg:h-slider h-48 w-full object-cover object-center">
      </figure>
    <?php endforeach ?>
  </section>
<?php endif ?>

