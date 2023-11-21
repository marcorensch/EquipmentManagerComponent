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

$gridItemColumns = 'uk-child-width-1-' . $params->get('equipment-item-columns', 1) . ' uk-child-width-1-' . $params->get('equipment-item-columns-s', 1) . '@s uk-child-width-1-' . $params->get('equipment-item-columns-m', 3) . '@m uk-child-width-1-' . $params->get('equipment-item-columns-l', 4) . '@l';

?>

<div class="<?php if($params->get("use-slider-small-screen" , 1)) echo 'uk-visible@m ';?>nxd-equipment-container@m">
    <div class="<?php echo $gridItemColumns;?> uk-grid-small uk-grid-match" uk-grid>
		<?php foreach ($category->equipment as $equipment_item): ?>
            <div>
				<?php include "default_equipment_item.php" ?>
            </div>
		<?php endforeach; ?>
    </div>
</div>

<?php if($params->get("use-slider-small-screen", 1)):?>
<div class="uk-hidden@m nxd-equipment-container">
    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true">

        <ul class="uk-slider-items uk-grid-small uk-grid-match" uk-grid>
			<?php foreach ($category->equipment as $equipment_item): ?>
                <li class="uk-width-3-4">
					<?php include "default_equipment_item.php" ?>
                </li>
			<?php endforeach; ?>
        </ul>
        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

    </div>

</div>
<?php endif;?>
