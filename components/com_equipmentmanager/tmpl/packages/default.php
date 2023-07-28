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
	$wa->useScript('com_equipmentmanager.uikit-icons');
	$wa->useStyle('com_equipmentmanager.uikit-css');
	$wa->useStyle('com_equipmentmanager.frontend-main-css');
}
$mailto = $params->get('mailto_address', '') ? $params->get('mailto_address', '') : 'info@' . $_SERVER['SERVER_NAME'];

?>

<?php echo JHtml::_('content.prepare', '{loadposition equipmentmanager-banner}'); ?>

    <div class="uk-section uk-padding-remove-top">

		<?php echo JHtml::_('content.prepare', '{loadposition equipmentmanager-before-packages}'); ?>

        <h1 class="uk-h1">All in One Packages</h1>

		<?php echo JHtml::_('content.prepare', '{loadposition packages-after-title}'); ?>



        <div class="uk-grid-small" uk-grid>
            <div class="uk-hidden@m uk-width-1-1">
                <button class="uk-button uk-button-large uk-button-primary uk-width-1-1" type="button" uk-toggle="target: #offcanvas-overlay">
                    <span uk-icon="icon: menu; ratio: 1.5"></span>
                    <span class="uk-margin-small-left"><?php echo Text::_('COM_EQUIPMENT_MANAGER_SELECT_PACKAGE');?></span>
                </button>
                <div id="offcanvas-overlay" uk-offcanvas="overlay: true">
                    <div class="uk-offcanvas-bar">
                        <button class="uk-offcanvas-close" type="button" uk-close></button>
                        <h3><?php echo Text::_('COM_EQUIPMENT_MANAGER_SELECT_PACKAGE');?></h3>
                        <ul class="uk-nav uk-nav-default" uk-switcher="connect: .packages-nav; animation: uk-animation-fade">
		                    <?php foreach ($this->packages as $package) : ?>
                                <li>
                                    <a href="#" class="uk-offcanvas-close uk-position-relative uk-text-bold package-selector-mobile"><?php echo $package->title; ?></a>
                                </li>
		                    <?php endforeach; ?>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="uk-visible@m" style="min-width:200px;">
                <ul class="uk-tab-left nxd-tab-container" uk-tab
                    uk-switcher="connect: .packages-nav; animation: uk-animation-fade">
			        <?php foreach ($this->packages as $package) : ?>
                        <li class="package-item-selector uk-width-1-1">
                            <a href="#" class="uk-text-bold package-selector"><?php echo $package->title; ?></a>
                        </li>
			        <?php endforeach; ?>
                </ul>
            </div>
            <div class="uk-width-expand">
                <div class="uk-margin-small-top ">
                    <ul id="packages-content" class="uk-switcher packages-nav">
						<?php foreach ($this->packages as $package) : ?>
							<?php include 'default.item.php'; ?>
						<?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="uk-margin">
            <ul id="packages-footer" class="uk-switcher packages-nav">
				<?php foreach ($this->packages as $package) : ?>
					<?php include 'default.item.footer.php'; ?>
				<?php endforeach; ?>
            </ul>
        </div>

		<?php echo JHtml::_('content.prepare', '{loadposition equipmentmanager-after-packages}'); ?>
    </div>

<?php echo JHtml::_('content.prepare', '{loadposition equipmentmanager-footer}'); ?>