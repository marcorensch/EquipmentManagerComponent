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
use NXD\Component\Equipmentmanager\Site\Helper\RouteHelper;
?>
<div class="uk-visible@m nxd-equipment-container@m">
    <div class="uk-child-width-1-3 uk-grid-small uk-grid-match" uk-grid>
    <?php foreach($category->equipment as $equipment_item):?>
        <div>
            <div class="uk-card uk-card-default uk-card-small uk-position-relative">
                <div class="uk-height-small uk-cover-container">
                    <?php echo HTMLHelper::image($equipment_item->image, $equipment_item->title, array('uk-cover' => true, 'class' => ''));?>
                </div>
                <div class="uk-card-body">
                    <h3 class="uk-card-title"><?php echo $equipment_item->title;?></h3>
                    <p><?php echo $equipment_item->short_description;?></p>
                </div>
                <a href="<?php echo RouteHelper::getItemRoute($equipment_item->id, $category->id);?>" class="uk-position-cover"></a>
            </div>
        </div>
    <?php endforeach;?>
    </div>
</div>

<div class="uk-hidden@m nxd-equipment-container@m">
	<?php foreach($category->equipment as $equipment_item):?>

	<?php endforeach;?>
</div>

