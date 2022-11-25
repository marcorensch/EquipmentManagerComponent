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

$params = Factory::getApplication()->getParams();

$wa = $this->document->getWebAssetManager();
if ($params->get('load_uikit', 1))
{
	$wa->useScript('com_equipmentmanager.uikit-js');
	$wa->useStyle('com_equipmentmanager.uikit-css');
}
?>

<div class="uk-section">
    <h1 class="uk-h1">All in One Packages</h1>

    <div class="uk-flex">
        <div class="uk-width-auto" style="min-width: 200px">
            <ul class="uk-tab-left " uk-tab uk-switcher="connect: #packages-nav; animation: uk-animation-fade">
				<?php foreach ($this->packages as $package) : ?>
                    <li class=""><a href="#"><?php echo $package->title; ?></a></li>
				<?php endforeach; ?>
            </ul>
        </div>
        <div class="uk-width-expand">
            <div class="uk-padding uk-padding-remove-vertical">
                <ul id="packages-nav" class="uk-switcher">
					<?php foreach ($this->packages as $package) : ?>
                    <?php include 'default.item.php'; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>