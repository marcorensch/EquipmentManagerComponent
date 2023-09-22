<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\HTML\HTMLHelper;

$slideshowParamsObj = $params->get('slideshow-params', array());
$slideshowParams = '';
if($slideshowParamsObj) {
    foreach($slideshowParamsObj as $key => $value) {
	    $slideshowParams .= $key . ':' . $value . '; ';
    }
}
?>

<div class="uk-position-relative">
	<div id="product-slideshow" uk-slideshow="<?php echo $slideshowParams;?>">
		<ul class="uk-slideshow-items" uk-lightbox>
			<?php foreach ($this->item->galleryImages as $image) : ?>
				<li>
					<div class="uk-position-cover">
						<?php echo HTMLHelper::image($image, '', ['uk-cover' => true], false ); ?>
                        <a href="<?php echo $image; ?>" class="uk-position-cover"></a>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class="uk-position-relative uk-margin-small-top">
<div uk-slider="autoplay:true; autoplay-interval:5000">
	<ul class="nxd-productgallery-items uk-slider-items uk-child-width-1-4 uk-child-width-1-5@m uk-grid uk-grid-small">
		<?php foreach ($this->item->galleryImages as $key => $image) : ?>
			<li>
				<div class="uk-panel uk-height-1-1 uk-flex uk-flex-middle uk-position-relative">
					<img src="<?php echo $image; ?>" alt="">
					<a href="#" data-link="<?php echo $key;?>" class="nxd-gallery-selector uk-position-cover" data-caption="<?php echo $this->item->title; ?>"></a>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
	<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
	<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

	<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
</div>
</div>
<script>
    (function(){

        const selectors = document.querySelectorAll('.nxd-productgallery-items .nxd-gallery-selector');
        selectors.forEach(function(selector){
			selector.addEventListener('click', function(e){
				e.preventDefault();
				const index = selector.getAttribute('data-link');
				openSlide(index);
			});
		});

        function openSlide(index){
            UIkit.slideshow('#product-slideshow').show(index);
        }

    })();
</script>
