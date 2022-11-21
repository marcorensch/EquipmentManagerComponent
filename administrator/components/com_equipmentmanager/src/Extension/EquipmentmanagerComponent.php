<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace NXD\Component\Equipmentmanager\Administrator\Extension;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Association\AssociationServiceInterface;
use Joomla\CMS\Association\AssociationServiceTrait;
use Joomla\CMS\Categories\CategoryServiceInterface;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use NXD\Component\Equipmentmanager\Administrator\Service\HTML\AdministratorService;
use Psr\Container\ContainerInterface;

/**
 * Component class for com_equipmentmanager
 *
 * @since  1.0.0
 */
class EquipmentmanagerComponent extends MVCComponent
implements BootableExtensionInterface, CategoryServiceInterface, AssociationServiceInterface, RouterServiceInterface
{
	use CategoryServiceTrait;
	use AssociationServiceTrait;
	use HTMLRegistryAwareTrait;
    use RouterServiceTrait;

	/**
	 * Booting the extension. This is the function to set up the environment of the extension like
	 * registering new class loaders, etc.
	 *
	 * If required, some initial set up can be done from services of the container, eg.
	 * registering HTML services.
	 *
	 * @param   ContainerInterface  $container  The container
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function boot(ContainerInterface $container)
	{
		$this->getRegistry()->register('equipmentmanageradministrator', new AdministratorService);
	}

	public function countItems(array $items, string $section)
	{
		try{
			$config = (object) array(
				'related_tbl' => $this->getTableNameForSection($section),
				'state_col' => 'published',
				'group_col' => 'catid',
				'relation_type' => 'category_or_group',
			);
			ContentHelper::countRelations($items, $config);
		}
		catch (Exception $e){
			// do nothing
		}
	}

	/**
	 * Returns the table for the count items functions for the given section.
	 *
	 * @param   string  $section  The section
	 *
	 * @return  string|null
	 *
	 * @since   1.0.0
	 */
	protected function getTableNameForSection(string $section = null)
	{
		return ($section === 'category' ? 'categories' : 'equipmentmanager_items');

	}
}
