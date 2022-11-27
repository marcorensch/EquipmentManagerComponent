<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>

<li>
	<?php if($package->gallery_images): ?>
        <div class="uk-margin">
            <h3><?php echo Text::_('COM_EQUIPMENT_MANAGER_PACKAGE_USE'); ?></h3>
            <div class="uk-grid-small uk-child-witdth-1-2 uk-child-width-1-4@m" uk-grid uk-lightbox>
                <?php foreach($package->gallery_images as $image): ?>
                    <div>
                        <div class="uk-position-relative uk-cover-container" tabindex="0" style="padding-bottom:100%;">
                            <img uk-cover src="<?php echo $image; ?>" alt="<?php echo $package->title; ?>">
                            <a href="<?php echo $image; ?>" data-caption="<?php echo $package->title; ?>" class="uk-position-cover"></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
	<?php endif; ?>
    <div class="uk-margin uk-padding-small nxd-tile-items-slider-container uk-overflow-hidden">
        <h3><?php echo Text::_('COM_EQUIPMENT_MANAGER_ITEMS_IN_PACKAGE'); ?></h3>
        <div class="uk-slider-container-offset" uk-slider>

            <div class="uk-position-relative uk-visible-toggle" tabindex="-1">

                <ul class="uk-slider-items uk-child-width-1-2@s uk-child-width-1-5@m uk-grid uk-grid-small uk-grid-match">
					<?php foreach ($package->related_items_by_cat as $category): ?>
						<?php foreach ($category->items as $item): ?>
                            <li>
                                <div class="uk-card uk-card-default uk-card-small">
                                    <div class="uk-height-small uk-cover-container">
                                        <img src="<?php echo $item->image; ?>" uk-cover>
                                    </div>
                                    <div class="uk-card-body">
                                        <span class="uk-text-bold"><?php echo $item->title; ?></span>
                                    </div>
                                    <a href="<?php echo $item->link; ?>" class="uk-position-cover"></a>
                                </div>
                            </li>
						<?php endforeach; ?>
					<?php endforeach; ?>
                </ul>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
                   uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
                   uk-slider-item="next"></a>

            </div>

            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

        </div>
    </div>
    <div class="uk-margin-large-top">
        <div class="uk-tile uk-tile-secondary uk-padding-small uk-flex uk-flex-center">
            <a class="uk-width-1-1 uk-width-1-2@m"
               href="mailto:<?php echo $mailto; ?>?subject=Anfrage%20für:%20<?php echo $package->title; ?>%20Package">
                <button class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-flex uk-flex-middle uk-flex-center">
                    <span uk-icon="icon: mail; ratio: 1.5"></span>
                    <span><?php echo Text::_('COM_EQUIPMENTMANAGER_REQUEST_BTN_LBL'); ?></span>
                </button>
            </a>
        </div>
    </div>
</li>