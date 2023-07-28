<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$wa     = $this->document->getWebAssetManager();
$wa->useScript('com_equipmentmanager.move-item-header-js');

?>


<div id="nxd-item-header" class="uk-padding-remove-top uk-height-medium uk-cover-container">
    <img src="<?php echo $this->item->image; ?>" alt="" uk-cover>
    <div class="uk-position-cover nxd-item-header-background-layer"></div>
    <div class="uk-position-center uk-light uk-text-center nxd-item-header-container">
        <div class="uk-margin-remove nxd-manufacturer-title"><?php echo $this->item->manufacturer; ?></div>
        <h1 class="uk-heading-large uk-margin-remove nxd-item-header-title"><?php echo $this->item->title; ?></h1>
    </div>
</div>