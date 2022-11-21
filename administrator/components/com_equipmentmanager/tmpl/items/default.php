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
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use NXD\Component\Equipmentmanager\Administrator\View\Item\HtmlView;

/** @var HtmlView $this */

$user      = Factory::getApplication()->getIdentity();
$userId    = $user->get('id');
$assoc     = Associations::isEnabled();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder === 'a.ordering';

if ($saveOrder && !empty($this->items))
{
	$saveOrderingUrl = 'index.php?option=com_equipmentmanager&task=item.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
	HTMLHelper::_('draggablelist.draggable');
}
?>
<form action="<?php echo Route::_('index.php?option=com_equipmentmanager'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row">
		<div class="col-md-12">
			<div id="j-main-container" class="j-main-container">
				<?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>

					<table class="table itemList" id="equipmentmanagerList">
						<caption class="visually-hidden">
							<?php echo Text::_('COM_EQUIPMENT_MANAGER_TABLE_CAPTION'); ?>,
							<span id="orderedBy"><?php echo Text::_('JGLOBAL_SORTED_BY'); ?> </span>,
							<span id="filteredBy"><?php echo Text::_('JGLOBAL_FILTERED_BY'); ?></span>
						</caption>
						<thead>
							<tr>
								<td class="w-1 text-center">
									<?php echo HTMLHelper::_('grid.checkall'); ?>
								</td>
								<th scope="col" class="w-1 text-center d-none d-md-table-cell">
									<?php echo HTMLHelper::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
								</th>
								<th scope="col" class="w-1 text-center">
									<?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
								</th>
								<th scope="col" style="min-width:100px">
									<?php echo HTMLHelper::_('searchtools.sort', 'COM_EQUIPMENT_MANAGER_TABLE_TABLEHEAD_NAME', 'a.name', $listDirn, $listOrder); ?>
								</th>
								<th scope="col" class="w-10 d-none d-md-table-cell">
									<?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'access_level', $listDirn, $listOrder); ?>
								</th>
								<?php if ($assoc) : ?>
									<th scope="col" class="w-5 d-none d-md-table-cell">
										<?php echo HTMLHelper::_('searchtools.sort', 'COM_EQUIPMENT_MANAGER_HEADING_ASSOCIATION', 'association', $listDirn, $listOrder); ?>
									</th>
								<?php endif; ?>
								<?php if (Multilanguage::isEnabled()) : ?>
									<th scope="col" class="w-10 d-none d-md-table-cell">
										<?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'language_title', $listDirn, $listOrder); ?>
									</th>
								<?php endif; ?>
								<th scope="col" class="w-3 d-none d-lg-table-cell">
									<?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
								</th>
                                <th scope="col" class="w-3 d-none d-lg-table-cell">
									<?php echo HTMLHelper::_('searchtools.sort', 'JGRID_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>
                                </th>
							</tr>
						</thead>
						<tbody<?php if ($saveOrder) : ?> class="js-draggable" data-url="<?php echo $saveOrderingUrl; ?>" data-direction="<?php echo strtolower($listDirn); ?>" data-nested="true"<?php endif; ?>>
						<?php
						foreach ($this->items as $i => $item) :
							$canEdit          = $user->authorise('core.edit',       'com_equipmentmanager.item.' . $item->id);
							$canCheckin       = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || is_null($item->checked_out);
//							$canEditOwn       = $user->authorise('core.edit.own',   'com_equipmentmanager.item.' . $item->id) && $item->created_by == $userId;
							$canChange        = $user->authorise('core.edit.state', 'com_equipmentmanager.item.' . $item->id) && $canCheckin;
							?>
							<tr class="row<?php echo $i % 2; ?>" data-draggable-group="<?php echo $item->catid; ?>">
								<td class="text-center">
									<?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
								</td>
								<td class="order text-center d-none d-md-table-cell">
									<?php
									$iconClass = '';
									if (!$canChange)
									{
										$iconClass = ' inactive';
									}
									elseif (!$saveOrder)
									{
										$iconClass = ' inactive tip-top hasTooltip" title="' . HTMLHelper::_('tooltipText', 'JORDERINGDISABLED');
									}
									?>
									<span class="sortable-handler<?php echo $iconClass; ?>">
										<span class="icon-menu" aria-hidden="true"></span>
									</span>
									<?php if ($canChange && $saveOrder) : ?>
										<input type="text" style="display:none" name="order[]" size="5"
											value="<?php echo $item->ordering; ?>" class="width-20 text-area-order">
									<?php endif; ?>
								</td>
								<td class="text-center object-status">
									<div class="btn-group">
										<?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'equipmentmanager.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
									</div>
								</td>
								<th scope="row" class="has-context">
									<?php if ($item->checked_out) : ?>
										<?php echo HTMLHelper::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'equipmentmanager.', true); ?>
									<?php endif; ?>
									<?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
									<a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_equipmentmanager&task=item.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->title)); ?>">
										<?php echo $editIcon; ?><?php echo $this->escape($item->title); ?></a>
									<div class="small">
                                        <?php echo Text::_('JALIAS'); ?>: <?php echo $this->escape($item->alias); ?>
                                    </div>
                                    <div class="small">
										<?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
									</div>

								</th>
								<td class="small d-none d-md-table-cell">
									<?php echo $item->access_level; ?>
								</td>
								<?php if ($assoc) : ?>
								<td class="d-none d-md-table-cell">
									<?php if ($item->association) : ?>
										<?php
										echo HTMLHelper::_('equipmentmanageradministrator.association', $item->id);
										?>
									<?php endif; ?>
								</td>
								<?php endif; ?>
								<?php if (Multilanguage::isEnabled()) : ?>
									<td class="small d-none d-md-table-cell">
										<?php echo LayoutHelper::render('joomla.content.language', $item); ?>
									</td>
								<?php endif; ?>
								<td class="d-none d-md-table-cell">
									<?php echo $item->id; ?>
								</td>
                                <td class="d-none d-md-table-cell">
									<?php echo $item->ordering; ?>
                                </td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

					<?php echo $this->pagination->getListFooter(); ?>




				<input type="hidden" name="task" value="">
				<input type="hidden" name="boxchecked" value="0">
				<?php echo HTMLHelper::_('form.token'); ?>
			</div>
		</div>
	</div>
</form>
