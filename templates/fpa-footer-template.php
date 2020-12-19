<?php

/**
 * Footer Photo Album template
 * 
 * This template can be overridden by copying it to fpa/fpa-footer-template.php of the active theme.
 */
?>

<div class="fpa-wrapper fpa-wrapper__footer">
	<ul class="fpa-list fpa-list__footer">
		<?php foreach ($fpa_images as $image) : ?>
			<li id="fpa-<?php echo $image->id; ?>" class="fpa-image__item">
				<a href="<?php echo $image->url; ?>" target="_new">
					<?php printf('<img src="%1$s" class="fpa-image" loading="lazy" title="%2$s" alt="%2$s">', $image->thumbnailUrl, $image->title ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>