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
if($params->get('load_uikit', 1)) {
    $wa->useScript('com_equipmentmanager.uikit-js');
    $wa->useStyle('com_equipmentmanager.uikit-css');
}

echo '<h1>Packages</h1>';
echo '<pre>' . var_export($this->packages, true) . '</pre>';

?>

<div class="uk-section">
    <div class="uk-container uk-container-large">
        <div class="uk-grid-small" uk-grid uk-height-match>
			<?php foreach ($this->packages as $package) : ?>
                <div>
                    <div class="uk-card uk-card-default uk-card-body uk-margin-bottom">
                        <h3 class="uk-card-title"><?php echo $package->title; ?></h3>
                        <p><?php echo $package->description; ?></p>
                        <a href="<?php echo '/index.php?option=com_equipmentmanager&view=package&id=' . $package->id; ?>" class="uk-button uk-button-primary">View Package</a>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</div>
