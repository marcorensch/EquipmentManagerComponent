<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\WebAsset\WebAssetManager;
use NXD\Component\Equipmentmanager\Administrator\View\Item\HtmlView;

/** @var HtmlView $this */

/** @var WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');

HTMLHelper::_('script', 'com_equipmentmanager/admin-equipmentmanager-letter.js', array('version' => 'auto', 'relative' => true));

$app                    = Factory::getApplication();
$input                  = $app->input;
$assoc                  = Associations::isEnabled();
$this->ignore_fieldsets = ['item_associations'];
$this->useCoreUI        = true;

// In case of modal
$isModal = $input->get('layout') == 'modal' ? true : false;
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '') === 'component' ? '&tmpl=component' : '';


?>



<form action="<?php echo Route::_('index.php?option=com_equipmentmanager&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="equipmentmanager-form" class="form-validate">

    <div>
        <div class="row form-vertical mb-3">
            <div class="col-12 col-md-4">
	            <?php echo $this->getForm()->renderField('title'); ?>
            </div>
            <div class="col-12 col-md-4">
	            <?php echo $this->getForm()->renderField('catid'); ?>
            </div>
            <div class="col-12 col-md-4">
		        <?php echo $this->getForm()->renderField('alias'); ?>
            </div>
        </div>
    </div>

	<div>
		<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('COM_EQUIPMENT_MANAGER_DETAILS_LABEL')); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
                    <div class="col-md-7">
						<?php echo $this->getForm()->renderField('short_description'); ?>
						<?php echo $this->getForm()->renderField('description'); ?>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4 form-vertical">
	                    <?php echo $this->getForm()->renderField('rental_price'); ?>
	                    <?php echo $this->getForm()->renderField('features'); ?>
                    </div>
				</div>
			</div>
		</div>
		<?php echo HTMLHelper::_('uitab.endTab'); ?>
		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'images', Text::_('COM_EQUIPMENT_MANAGER_IMAGES_LABEL')); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7">
                        <?php echo $this->getForm()->renderField('image'); ?>
                        <?php echo $this->getForm()->renderField('gallery_path'); ?>
                    </div>
                </div>
            </div>
        </div>
		<?php echo HTMLHelper::_('uitab.endTab'); ?>
		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('COM_EQUIPMENT_MANAGER_PUBLISHING_LABEL')); ?>
        <div class="row">
            <div class="col-md-6">
	            <?php echo $this->getForm()->renderField('access'); ?>
	            <?php echo $this->getForm()->renderField('language'); ?>
                <hr>
	            <?php echo $this->getForm()->renderField('created'); ?>
	            <?php echo $this->getForm()->renderField('created_by'); ?>
            </div>
            <div class="col-md-6">

	            <?php echo $this->getForm()->renderField('published'); ?>
	            <?php echo $this->getForm()->renderField('publish_up'); ?>
	            <?php echo $this->getForm()->renderField('publish_down'); ?>
            </div>
        </div>
		<?php echo HTMLHelper::_('uitab.endTab'); ?>

		<?php if ( !$isModal && $assoc) : ?>
			<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'associations', Text::_('JGLOBAL_FIELDSET_ASSOCIATIONS')); ?>
			<?php echo $this->loadTemplate('associations'); ?>
			<?php echo HTMLHelper::_('uitab.endTab'); ?>
		<?php elseif ($isModal && $assoc) : ?>
			<div class="hidden"><?php echo $this->loadTemplate('associations'); ?></div>
		<?php endif; ?>

		<?php echo LayoutHelper::render('joomla.edit.params', $this); ?>

		<?php echo HTMLHelper::_('uitab.endTabSet'); ?>
	</div>

	<input type="hidden" name="task" value="">
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
