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
use Joomla\CMS\Factory;

?>

<li>
    <div>
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-1 uk-width-2-3@m">
                <h2 class="uk-h2"><?php echo $package->title; ?></h2>
                <span class=""><?php echo $package->usage ? Text::sprintf('COM_EQUIPMENTMANAGER_PURPOSE_TXT', $package->usage) : ''; ?></span>
            </div>
            <div class="uk-width-expand">
                <div class="uk-card uk-card-default uk-card-body uk-card-small uk-text-center">
					<?php echo Text::_('COM_EQUIPMENTMANAGER_PRICE_TEXT_ONLY'); ?>
                    <div class="uk-text-large uk-text-bold"><?php echo Text::sprintf('COM_EQUIPMENTMANAGER_PRICE_TEXT', $package->rental_price_first); ?>
                        &nbsp;<?php echo Text::_('COM_EQUIPMENTMANAGER_PER_DAY'); ?></div>
                    <div class="uk-text-small"><?php echo Text::sprintf('COM_EQUIPMENTMANAGER_PRICE_TEXT_ADD_DAYS', $package->rental_price_follow); ?></div>
                </div>
            </div>
        </div>
        <div class="uk-margin">
			<?php echo $package->description; ?>
        </div>
        <div class="uk-margin">
            <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-grid-small" uk-grid="masonry:true">
				<?php foreach ($package->related_items_by_cat as $category): ?>
                    <div class="">
                        <div class="uk-card">
                            <div class="uk-card-header uk-margin-remove uk-padding-remove-horizontal">
                                <h3 class="uk-card-title"><?php echo $category->title; ?>
                                </h3>
								<?php if ($params->get('show_category_description', 1) && $category->description): ?>
                                    <div uk-drop="mode:hover">
                                        <div class="uk-card uk-card-secondary uk-border-rounded uk-overflow-hidden uk-position-z-index">
                                            <div class="uk-card-media-top">
                                                <img src="<?php echo $category->params->image; ?>" alt="">
                                            </div>
                                            <div class="uk-card-body">
                                                <p><?php echo $category->description; ?></p>
                                            </div>
                                        </div>
                                    </div>
								<?php endif; ?>
                            </div>
                            <div class="uk-card-body uk-padding-remove">
                                <ul class="uk-list uk-list-divider uk-position-relative">
									<?php foreach ($category->items as $item): ?>
                                        <li class="uk-position-relative">
                                            <div uk-lightbox>
                                                <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                                    <div class="nxd-width-xsmall">
                                                        <span class="uk-text-large"><?php echo Text::sprintf('COM_EQUIPMENTMANAGER_COUNT_X', $item->count); ?></span>
                                                    </div>
                                                    <div class="uk-width-expand">
                                                        <div><?php echo $item->title; ?></div>
                                                        <div class="uk-text-small uk-text-meta"><?php echo $item->quickinfo; ?></div>
                                                    </div>
                                                </div>
                                                <a class="uk-position-cover" href="<?php echo $item->image; ?>" data-attrs="width: 800;" data-alt="<?php echo $item->title; ?>" data-caption="<?php echo $item->title; ?>"></a>
                                            </div>
                                        </li>
									<?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
    </div>

</li>