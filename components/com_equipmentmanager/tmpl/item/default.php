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
$wa     = $this->document->getWebAssetManager();
if ($params->get('load_uikit', 1))
{
	$wa->useScript('com_equipmentmanager.uikit-js');
	$wa->useScript('com_equipmentmanager.uikit-icons');
	$wa->useScript('com_equipmentmanager.mailme-js');
	$wa->useStyle('com_equipmentmanager.uikit-css');
}

?>
<?php echo JHtml::_('content.prepare', '{loadposition equipmentmanager-banner}'); ?>
    <div class="uk-section uk-padding-remove-top">
        <div>
            <h1 class="uk-heading-large"><?php echo $this->item->title; ?></h1>
            <div class="uk-h3"><?php echo $this->item->manufacturer; ?></div>
        </div>
    </div>

    <div class="uk-section uk-padding-remove-top">

        <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@m" uk-grid>
            <div class="uk-width-expand uk-flex-last@m">
                <div class="equipment-information">
                    <div class="uk-h2 equipment-title"><?php echo $this->item->title; ?></div>
                    <h2 class="uk-h4 uk-margin-remove equipment-details-title "><?php echo Text::_("COM_EQUIPMENTMANAGER_DETAILS_HEADER"); ?></h2>
                </div>
            </div>
			<?php if ($this->item->galleryImages) : ?>
                <div>
					<?php include 'default.gallery.php'; ?>
                </div>
			<?php endif; ?>
        </div>
    </div>

<?php echo JHtml::_('content.prepare', '{loadposition equipmentmanager-footer}'); ?>


<?php

echo '<pre>' . var_export($this->item, true) . '</pre>';

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
