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

//echo '<pre>' . var_export($this->item->galleryImages, true) . '</pre>';

?>
<div class="uk-position-relative" uk-lightbox>
	<div uk-slideshow>
		<ul class="uk-slideshow-items">
			<?php foreach ($this->item->galleryImages as $image) : ?>
				<li>
					<div class="uk-panel ">
						<img src="<?php echo $image; ?>" alt="" uk-cover>
						<a href="<?php echo $image; ?>" class="uk-position-bottom-right uk-position-z-index">Zoom</a>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class="uk-position-relative">
<div uk-slider="autoplay:true; autoplay-interval:5000">
	<ul class="uk-slider-items uk-child-width-1-4 uk-child-width-1-5@m uk-grid uk-grid-small">
		<?php foreach ($this->item->galleryImages as $image) : ?>
			<li>
				<div class="uk-panel">
					<img src="<?php echo $image; ?>" alt="">
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
	<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
	<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

	<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
</div>
</div>
