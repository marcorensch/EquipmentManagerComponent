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

$wa = $this->document->getWebAssetManager();
if ($params->get('load_uikit', 1))
{
	$wa->useScript('com_equipmentmanager.uikit-js');
	$wa->useScript('com_equipmentmanager.uikit-icons');
	$wa->useStyle('com_equipmentmanager.uikit-css');
	$wa->useStyle('com_equipmentmanager.frontend-main-css');
}

use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

?>
    <div class="uk-section">
        <div class="uk-container uk-container-expand">
			<?php foreach ($this->categories as $category): ?>
                <h3><?php echo $category->title; ?></h3>
                <hr>
				<?php if ($category->items): ?>
                    <div class="uk-visible@m">
                        <div class="uk-child-width-1-3 uk-grid-small" uk-grid>
							<?php foreach ($category->items as $item): ?>
                                <div>
                                    <div class="uk-card uk-card-default uk-card-small uk-position-relative">
                                        <div class="uk-height-small uk-cover-container">
                                            <img src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>"
                                                 uk-cover>
                                        </div>
                                        <div class="uk-card-body">
                                            <h3 class="uk-card-title"><?php echo $item->title; ?></h3>
                                            <p><?php echo $item->short_description; ?></p>
                                        </div>
                                        <a href="<?php echo $item->link; ?>" class="uk-position-cover"></a>
                                    </div>
                                </div>
							<?php endforeach; ?>
                        </div>
                    </div>
                    <div class="uk-hidden@m">
                        <div class="uk-position-relative uk-visible-toggle" tabindex="-1">
                            <div uk-slider>
                                <ul class="uk-slider-items uk-child-width-1-2 uk-grid uk-grid-small">
									<?php foreach ($category->items as $item): ?>
                                        <li>
                                            <div class="uk-card uk-card-default uk-card-small uk-position-relative">
                                                <div class="uk-height-small uk-cover-container">
                                                    <?php
                                                    $imgclass   = '';
                                                    $layoutAttr = [
	                                                    'src' => $item->image,
	                                                    'alt' => empty($item->title) ? false : $item->title,
                                                        'uk-cover' => true
                                                    ];
                                                    ?>
                                                    <figure class="<?php echo $this->escape($imgclass); ?> item-image">
	                                                <?php echo LayoutHelper::render('joomla.html.image', array_merge($layoutAttr, ['itemprop' => 'thumbnail'])); ?>
                                                    </figure>
                                                </div>
                                                <div class="uk-card-body">
                                                    <span class="uk-text-bold uk-text-small"><?php echo $item->title; ?></span>
                                                </div>
                                                <a href="<?php echo Route::_(RouteHelper::getItemRoute($item->slug, $item->catid, $item->language))?>" class="uk-position-cover"></a>
                                            </div>
                                        </li>
									<?php endforeach; ?>
                                </ul>
                                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#"
                                   uk-slidenav-previous
                                   uk-slider-item="previous"></a>
                                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#"
                                   uk-slidenav-next
                                   uk-slider-item="next"></a>
                            </div>
                        </div>
                    </div>
				<?php else: ?>
                    <div class="uk-padding uk-text-center">
                        <p class="uk-text-large uk-text-meta"><?php echo Text::_('COM_EQUIPMENT_MANAGER_NO_ITEMS'); ?></p>
                    </div>
				<?php endif; ?>
			<?php endforeach; ?>
        </div>
    </div>

<?php
