<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<main class="container space-y-5 my-5 flex-1">
	<div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
		<article class="w-full lg:w-2/3 space-y-4">
			<h2 class="text-title lg:text-3xl text-xl font-bold font-heading"><?= $query->post_title ?></h2>
			<ul class="lg:space-x-5 flex flex-col lg:flex-row flex-wrap text-sm">
				<li><span class="fa fa-calendar mr-2 text-secondary"></span> <?=day_name(date('N', strtotime($query->created_at)))?>, <?=indo_date(substr($query->created_at, 0, 10))?></li>
				
				<li>
					<span class="fa fa-tag mr-2 text-secondary"></span>
					<?php if($tag = $query->post_tags) : ?>
						<?php $post_tags = explode(',', $tag); ?>
						<?php foreach($post_tags as $tag) : ?>
							<a href="<?= site_url('tag/'.url_title(strtolower(trim($tag)))) ?>" class="mr-2"><?= ucwords($tag) ?></a>
						<?php endforeach ?>
					<?php endif ?>
				</li>
				<li><span class="fa fa-user mr-2 text-secondary"></span> <?=$post_author?></li>
			</ul>

			<?php if($post_type == 'post' && is_file('./media_library/posts/large/'.$query->post_image)) : ?>
				<img src="<?=base_url('media_library/posts/large/'.$query->post_image)?>" alt="<?= $query->post_title ?>" class="max-w-full w-full h-auto">
			<?php endif ?>

			<?= $query->post_content ?>

			<span class="block font-bold">Bagikan artikel ini:</span>
			<div class="flex space-x-2">
					<a href="http://www.facebook.com/sharer.php?u=<?=site_url('read/'.$query->id.'/'.$query->post_slug)?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-facebook text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
						<i class="fa fa-facebook text-xl"></i>
					</a>
					<a href="http://twitter.com/share?url=<?=site_url('read/'.$query->id.'/'.$query->post_slug)?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-twitter text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
						<i class="fa fa-twitter text-xl"></i>
					</a>
					<a href="https://telegram.me/share/url?url=<?=site_url('read/'.$query->id.'/'.$query->post_slug)?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-telegram text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
						<i class="fa fa-telegram text-xl"></i>
					</a>
					<a href="https://api.whatsapp.com/send?text=<?=site_url('read/'.$query->id.'/'.$query->post_slug)?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-whatsapp text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
						<i class="fa fa-whatsapp text-xl"></i>
					</a>
			</div>

			<?php if((
						$query->post_comment_status == 'open' &&
						$this->session->comment_registration == 'true' &&
						$this->auth->hasLogin()
					) ||
					(
						$query->post_comment_status == 'open' &&
						$this->session->comment_registration == 'false'
					)) : ?>

				<div class="py-2">
					<div id="disqus_thread"></div>
				</div>
				
				<script>
					(function() { // DON'T EDIT BELOW THIS LINE
					var d = document, s = d.createElement('script');
					s.src = 'https://celebiz.disqus.com/embed.js';
					s.setAttribute('data-timestamp', +new Date());
					(d.head || d.body).appendChild(s);
					})();
				</script>
			<?php endif ?>

			<?php if($query->post_type == 'post') : ?>
				<?php $posts = get_related_posts($query->post_categories, $this->uri->segment(2), 5) ?>
				<?php if($posts->num_rows() > 0) : ?>
					<div class="py-5">
						<h3 class="font-heading text-lg lg:text-xl font-bold py-2">Artikel Terkait</h3>
						<div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
							<?php foreach($posts->result() as $post) : ?>
								<div class="space-y-2">
									<a href="<?=site_url('read/'.$post->id.'/'.$post->post_slug)?>" class="block h-48 max-w-full flex-shrink-0 bg-gray-300 flex items-center justify-center">
										<?php $post_image = 'media_library/posts/medium/'.$post->post_image; ?>
										<?php $poster = is_file('./'.$post_image) ? base_url($post_image) : base_url('media_library/images/'. $this->session->logo) ?>
										<?php $poster_class = is_file('./'.$post_image) ? 'w-full object-cover object-center h-inherit' : 'w-16' ?>
										<img src="<?= $poster ?>" alt="<?= $post->post_title ?>" class="<?= $poster_class ?>">
									</a>
									<a href="<?=site_url('read/'.$post->id.'/'.$post->post_slug)?>" class="block hover:text-secondary">
										<h4 class="lg:text-lg font-heading font-bold"><?= $post->post_title ?></h4>
										<p class="text-sm"><?=day_name(date('N', strtotime($post->created_at)))?>, <?=indo_date(date('Y-m-d', strtotime($post->created_at)))?></p>
									</a>
								</div>
							<?php endforeach ?>
						</div>
					</div>
				<?php endif ?>
			<?php endif ?>
		</article>
		<div class="w-full lg:w-1/3 space-y-5">
			<?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
		</div>
	</div>
</main>