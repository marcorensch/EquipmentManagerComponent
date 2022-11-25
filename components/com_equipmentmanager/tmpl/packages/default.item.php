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
            <div class="uk-width-2-3">
                <h2 class="uk-h2"><?php echo $package->title; ?></h2>
                <span class=""><?php echo $package->usage ? Text::sprintf('COM_EQUIPMENTMANAGER_PURPOSE_TXT', $package->usage) : ''; ?></span>
            </div>
            <div class="uk-width-expand">
                <div class="uk-card uk-card-default uk-card-body uk-card-small uk-text-center">
                    <?php echo Text::_('COM_EQUIPMENTMANAGER_PRICE_TEXT_ONLY'); ?>
                    <div class="uk-text-large uk-text-bold"><?php echo Text::sprintf('COM_EQUIPMENTMANAGER_PRICE_TEXT', $package->rental_price_first); ?>&nbsp;<?php echo Text::_('COM_EQUIPMENTMANAGER_PER_DAY'); ?></div>
                    <div class="uk-text-small"><?php echo Text::sprintf('COM_EQUIPMENTMANAGER_PRICE_TEXT_ADD_DAYS', $package->rental_price_follow); ?></div>
                </div>
            </div>
        </div>
        <div class="uk-margin">
            <?php echo $package->description; ?>
        </div>
        <div class="uk-margin">
            <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-grid-small" uk-grid>
	            <?php foreach($package->related_items_by_cat as $category): ?>
                <div>
                    <div class="uk-card uk-card-small">
                        <div class="uk-card-header">
                            <h3 class="uk-card-title uk-margin-remove-bottom"><?php echo $category->title; ?>
                            <?php if($category->description): ?>
                                <sup><span uk-icon="icon: info; ratio: 0.8" uk-tooltip="<?php echo $category->description; ?>"></span></sup>
                            </h3>
                            <div uk-drop="mode:click">
                                <div class="uk-card uk-card-secondary uk-border-rounded uk-overflow-hidden">
                                    <div class="uk-card-media-top">
                                        <img src="<?php echo $category->params->image; ?>" alt="">
                                    </div>
                                    <div class="uk-card-body">
                                        <p><?php echo $category->description; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php else:?>
                            </h3>
                            <?php endif; ?>
                        </div>
                        <div class="uk-card-body uk-padding-remove-vertical">
                            <ul class="uk-list uk-list-divider">
                                <?php foreach($category->items as $item): ?>
                                <li>
                                    <div class="uk-position-relative">
                                    <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                        <div>
	                                        <span class="uk-text-large"><?php echo Text::sprintf('COM_EQUIPMENTMANAGER_COUNT_X', $item->count); ?></span>
                                        </div>
                                        <div>
                                            <div><?php echo $item->title; ?></div>
                                            <div class="uk-text-small uk-text-meta"><?php echo $item->quickinfo; ?></div>
                                        </div>
                                    </div>
                                    <a href="<?php echo $item->link; ?>" target="_blank" class="uk-position-cover"></a>
                                        <?php if($item->image): ?>
                                        <div uk-drop="mode: hover">
                                            <div class="uk-width-small uk-height-small uk-border-rounded uk-overflow-hidden uk-cover-container uk-box-shadow-large">
                                                <img uk-cover src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>">
                                            </div>
                                        </div>
                                        <?php endif; ?>
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
        <div class="uk-margin-large-top">
            <div class="uk-tile uk-tile-secondary uk-padding-small uk-flex uk-flex-center">
                <a class="uk-width-1-1 uk-width-1-2@m" href="mailto:<?php echo $mailto;?>?subject=Anfrage%20für:%20<?php echo $package->title;?>%20Package">
                    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-flex uk-flex-middle uk-flex-center">
                        <span uk-icon="icon: mail; ratio: 1.5"></span>
                        <span><?php echo Text::_('COM_EQUIPMENTMANAGER_REQUEST_BTN_LBL'); ?></span>
                    </button>
                </a>
            </div>
        </div>
    </div>

</li>