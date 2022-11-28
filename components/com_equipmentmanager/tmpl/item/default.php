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
use NXD\Component\Equipmentmanager\Site\Helper\ItemHelper;

$params = Factory::getApplication()->getParams();
$wa     = $this->document->getWebAssetManager();
if ($params->get('load_uikit', 1))
{
	$wa->useScript('com_equipmentmanager.uikit-js');
	$wa->useScript('com_equipmentmanager.uikit-icons');
	$wa->useStyle('com_equipmentmanager.uikit-css');
	$wa->useStyle('com_equipmentmanager.frontend-main-css');
	$wa->addInlineStyle('#tm-main{position:relative;}');
}

$mailto = $params->get('mailto_address', '') ? $params->get('mailto_address', '') : 'info@' . $_SERVER['SERVER_NAME'];


?>
<?php echo JHtml::_('content.prepare', '{loadposition equipmentmanager-banner}'); ?>
<div>
    <div class="uk-padding-remove-top uk-height-medium">
        <div class="uk-position-top uk-height-medium uk-cover-container">
            <img src="<?php echo $this->item->image; ?>" alt="" uk-cover>
            <div class="uk-position-cover nxd-item-header-background-layer"></div>
            <div class="uk-position-center uk-light uk-text-center nxd-item-header-container">
                <div class="uk-margin-remove nxd-manufacturer-title"><?php echo $this->item->manufacturer; ?></div>
                <h1 class="uk-heading-large uk-margin-remove nxd-item-header-title"><?php echo $this->item->title; ?></h1>
            </div>
        </div>

    </div>

    <div class="uk-margin-top">
        <div class="uk-width-1-1 uk-position-relative">
            <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@m" uk-grid>
                <div class="uk-width-expand uk-flex-last@m">
                    <div class="equipment-information">
                        <div class="uk-h2 equipment-title"><?php echo $this->item->title; ?></div>
                        <div class="nxd-equipment-introtext">
							<?php echo $this->item->short_description; ?>
                        </div>
	                    <?php if ($this->item->features): ?>
                        <h2 class="uk-h4 equipment-details-title "><?php echo Text::_("COM_EQUIPMENTMANAGER_FEATURES_HEADER"); ?></h2>
                        <div>

                                <ul class="uk-list uk-margin-left">
									<?php foreach ($this->item->features as $feature) : ?>
                                        <li>
                                            <span class="uk-text-warning"
                                                  uk-icon="icon: chevron-right"></span>&nbsp;<?php echo $feature->feature; ?>
                                        </li>
									<?php endforeach; ?>
                                </ul>

                        </div>
	                    <?php endif; ?>
                        <div class="uk-margin-large-top">
                            <div class="uk-child-width-auto uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                <div>
									<?php if ($this->item->ip65): ?>
                                        <div class="nxd-icon-container">
                                            <img uk-tooltip="<?php echo Text::_('COM_EQUIPMENT_MANAGER_IP65_CERTIFIED'); ?>"
                                                 src="<?php echo JUri::base() . 'media/com_equipmentmanager/images/icons/ip65.png'; ?>"
                                                 width="50" alt="Waterproof Icon">
                                        </div>
									<?php endif; ?>
                                </div>
                                <div>
									<?php if ($this->item->battery): ?>
                                        <div class="nxd-icon-container">
                                            <img uk-tooltip="<?php echo Text::_('COM_EQUIPMENT_MANAGER_BATTERY_INCL'); ?>"
                                                 src="<?php echo JUri::base() . 'media/com_equipmentmanager/images/icons/battery.png'; ?>"
                                                 width="50" alt="Battery Icon">
                                        </div>
									<?php endif; ?>
                                </div>

                                <div class="uk-width-expand uk-flex uk-flex-right">
									<?php if ($this->item->rental_price): ?>
                                        <div class="uk-card nxd-card-pricing uk-padding-small">
                                            <div class="nxd-price"><span class="nxd-price-icon"
                                                                         uk-icon="icon: tag"></span>
                                                <span class="nxd-price-text"><?php echo Text::sprintf('COM_EQUIPMENT_MANGER_RENTAL_PRICE', $this->item->rental_price); ?></span>
                                            </div>
                                        </div>
									<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php if ($this->item->galleryImages) : ?>
                    <div>
                        <div class="nxd-gallery-container">
							<?php include 'default.gallery.php'; ?>
                        </div>
                    </div>

				<?php endif; ?>
            </div>
            <div class="uk-margin-top">
                <div class="nxd-equipment-description">
					<?php echo $this->item->description; ?>
                </div>
            </div>

			<?php if ($params->get('related_items_limit', 10) > 0 && $this->item->related_items_bycat) : ?>

                <div class="uk-margin-large-top uk-padding-small nxd-tile-items-slider-container uk-overflow-hidden">
                    <h3><?php echo Text::_('COM_EQUIPMENT_MANAGER_RELATED_ITEMS'); ?></h3>
                    <div class="uk-slider-container-offset" uk-slider>

                        <div class="uk-position-relative uk-visible-toggle" tabindex="-1">

                            <ul class="uk-slider-items uk-child-width-1-2@s uk-child-width-1-5@m uk-grid uk-grid-small uk-grid-match">
								<?php foreach ($this->item->related_items_bycat as $relatedItem) : ?>

                                    <li>
	                                    <?php echo ItemHelper::buildItemLayout($relatedItem) ?>
                                    </li>

								<?php endforeach; ?>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#"
                               uk-slidenav-previous uk-slider-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#"
                               uk-slidenav-next uk-slider-item="next"></a>

                        </div>

                        <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

                    </div>
                </div>
			<?php endif; ?>

        </div>
    </div>
    <div class="uk-margin-large-top">
        <div class="uk-tile uk-tile-secondary uk-padding-small uk-flex uk-flex-center">
            <a class="uk-width-1-1 uk-width-1-2@m"
               href="mailto:<?php echo $mailto; ?>?subject=Anfrage%20für:%20<?php echo $this->item->title; ?>">
                <button class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-flex uk-flex-middle uk-flex-center">
                    <span uk-icon="icon: mail; ratio: 1.5"></span>
                    <span><?php echo Text::_('COM_EQUIPMENTMANAGER_REQUEST_BTN_LBL'); ?></span>
                </button>
            </a>
        </div>
    </div>
</div>
<?php echo JHtml::_('content.prepare', '{loadposition equipmentmanager-footer}'); ?>


<?php

//echo '<pre>' . var_export($this->item, true) . '</pre>';

//if ($this->item->params->get('show_name')) {
//	if ($this->Params->get('show_equipmentmanager_name_label')) {
//		echo Text::_('COM_EQUIPMENT_MANAGER_NAME') . $this->item->name;
//	} else {
//		echo $this->item->name;
//	}
//}
//
//echo $this->item->event->afterDisplayTitle;
//echo $this->item->event->beforeDisplayContent;
//echo $this->item->event->afterDisplayContent;
