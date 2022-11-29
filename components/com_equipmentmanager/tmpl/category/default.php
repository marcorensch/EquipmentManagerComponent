<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use NXD\Component\Equipmentmanager\Site\Helper\RouteHelper;

$params = Factory::getApplication()->getParams();
$active = Factory::getApplication()->getMenu()->getActive();

$wa = $this->document->getWebAssetManager();
if ($params->get('load_uikit', 1))
{
	$wa->useScript('com_equipmentmanager.uikit-js');
	$wa->useScript('com_equipmentmanager.uikit-icons');
	$wa->useStyle('com_equipmentmanager.uikit-css');
	$wa->useStyle('com_equipmentmanager.frontend-main-css');
}

?>
<div class="uk-section">
	<div class="uk-container uk-container-expand">
        <h1 class="uk-h1"><?php echo $active->title; ?></h1>
		<?php foreach ($this->categories as $category):?>
		    <?php include 'default_category.php' ?>
		<?php endforeach; ?>
	</div>
</div>
<?php
echo '<pre>' . var_export($this->categories, true) . '</pre>';