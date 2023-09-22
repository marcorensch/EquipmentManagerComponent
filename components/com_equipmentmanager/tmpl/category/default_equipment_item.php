<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use NXD\Component\Equipmentmanager\Site\Helper\RouteHelper;

?>

<div class="uk-card uk-card-default uk-card-small uk-position-relative">
    <div class="uk-height-small uk-cover-container uk-position-relative">
		<?php echo HTMLHelper::image($equipment_item->image, $equipment_item->title, array('uk-cover' => true, 'class' => '')); ?>
        <div class="uk-position-bottom-right uk-padding-small">
            <div class="uk-flex uk-grid-small">
                <div>
					<?php if ($equipment_item->ip65): ?>
                        <div class="nxd-icon-container">
                            <img uk-tooltip="<?php echo Text::_('COM_EQUIPMENT_MANAGER_IP65_CERTIFIED'); ?>"
                                 src="<?php echo JUri::base() . 'media/com_equipmentmanager/images/icons/ip65.png'; ?>"
                                 width="30" alt="Waterproof Icon">
                        </div>
					<?php endif; ?>
                </div>
                <div>
					<?php if ($equipment_item->battery): ?>
                        <div class="nxd-icon-container">
                            <img uk-tooltip="<?php echo Text::_('COM_EQUIPMENT_MANAGER_BATTERY_INCL'); ?>"
                                 src="<?php echo JUri::base() . 'media/com_equipmentmanager/images/icons/battery.png'; ?>"
                                 width="30" alt="Battery Icon">
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-card-body">
        <h3 class="uk-card-title"><?php echo $equipment_item->title; ?></h3>
        <p><?php echo $equipment_item->short_description; ?></p>
    </div>
    <a href="<?php echo RouteHelper::getItemRoute($equipment_item->id, $category->id); ?>"
       class="uk-position-cover"></a>
</div>
