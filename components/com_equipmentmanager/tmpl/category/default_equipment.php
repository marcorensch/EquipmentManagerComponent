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
		<?php foreach ($category->equipment as $equipment_item): ?>
            <div>
				<?php include "default_equipment_item.php" ?>
            </div>
		<?php endforeach; ?>
    </div>
</div>

<div class="uk-hidden@m nxd-equipment-container@m">
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

