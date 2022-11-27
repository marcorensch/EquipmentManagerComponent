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

$params = Factory::getApplication()->getParams();

$wa = $this->document->getWebAssetManager();
if ($params->get('load_uikit', 1))
{
	$wa->useScript('com_equipmentmanager.uikit-js');
	$wa->useScript('com_equipmentmanager.uikit-icons');
	$wa->useStyle('com_equipmentmanager.uikit-css');
	$wa->useStyle('com_equipmentmanager.frontend-main-css');
}

use Joomla\CMS\Language\Text;
?>
<div class="uk-grid uk-child-width-1-2 uk-child-width-1-4@m" uk-grid>
<?php foreach ($this->categories as $category): ?>
<div>
	<div class="uk-card uk-card-default uk-card-body uk-card-small uk-margin-bottom uk-position-relative">
		<div class="uk-height-small uk-cover-container">
            <?php if($category->params->image): ?>
                <img src="<?php echo $category->params->image; ?>" alt="<?php echo $category->params->alt; ?>" uk-cover>
			<?php endif; ?>
		</div>
		<h3 class="uk-card-title uk-margin-remove-bottom"><?php echo $category->title; ?></h3>
		<p class="uk-text-meta uk-margin-remove-top"><?php echo $category->description; ?></p>
        <a class="uk-position-cover" href="<?php echo $category->link; ?>"></a>
	</div>
</div>
<?php endforeach;;?>
</div>
<?php
echo '<pre>' . var_export($this->categories, true) . '</pre>';
echo 'hello items';
