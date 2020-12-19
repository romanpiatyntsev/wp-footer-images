<?php

/**
 * Footer Photo Album images template
 * 
 * This template can be overridden by copying it to fpa/fpa-footer-template.php of the active theme.
 */
?>

<div class="fpa-footer-wrapper">
	<ul class="fpa-footer-list fpa-list">
		<?php foreach ($fpa_images as $image) : ?>
			<li class="fpa-image image-id=<?php echo $image->id; ?>">
				<a href="<?php echo $image->url; ?>" target="_new">
					<img src="<?php echo $image->thumbnailUrl; ?>" title="<?php echo $image->title; ?>" alt="<?php echo $image->title; ?>">
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>