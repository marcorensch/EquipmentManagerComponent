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
use Joomla\CMS\Layout\LayoutHelper;
use NXD\Component\Equipmentmanager\Site\Helper\RouteHelper;

?>

<div class="uk-card uk-card-default uk-card-small uk-position-relative">
    <div class="uk-cover-container">
        <canvas width="4000" height="2500"></canvas>
		<?php
        echo LayoutHelper::render('joomla.html.image', ['src' => $equipment_item->image, 'alt' => $equipment_item->title, 'uk-cover' => 'true']); ?>
    </div>
    <div class="uk-card-body">
        <h3 class="uk-card-title"><?php echo $equipment_item->title; ?></h3>
        <p><?php echo $equipment_item->short_description; ?></p>
    </div>
    <a href="<?php echo RouteHelper::getItemRoute($equipment_item->id, $category->id); ?>"
       class="uk-position-cover"></a>
</div>
