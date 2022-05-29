<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php $quotes = get_quotes() ?>

<?php if($quotes->num_rows() > 0) : ?>
  <div class="flex bg-gray-200 overflow-hidden relative text-sm">
    <span class="flex-shrink-0 inline-flex items-center px-3 bg-secondary text-white text-xs lg:text-base z-10">
      <span class="hidden lg:block"><?= indo_date(date('Y-m-d')) ?></span>
      <span class="block lg:hidden"><span class="fa fa-bullhorn"></span></span>
    </span>
    <marquee class="w-full py-1 lg:py-2 inline-flex items-center divide-x-2 divide-solid divide-gray-700" onmouseover="this.stop();" onmouseout="this.start();">
      <?php foreach($quotes->result() as $quote) : ?>
        <span class="px-5"><?= $quote->quote ?></span>
      <?php endforeach ?>
    </marquee>
  </div>
<?php endif ?>
