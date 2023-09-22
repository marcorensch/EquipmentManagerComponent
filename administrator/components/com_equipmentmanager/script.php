<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Installer\InstallerScript;

/**
 * Script file of Equipmentmanager Component
 *
 * @since  1.0.0
 */
class Com_EquipmentmanagerInstallerScript extends InstallerScript
{
	/**
	 * Minimum Joomla version to check
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	private $minimumJoomlaVersion = '4.0';

	/**
	 * Minimum PHP version to check
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	private $minimumPHPVersion = JOOMLA_MINIMUM_PHP;

	/**
	 * Method to install the extension
	 *
	 * @param   InstallerAdapter  $parent  The class calling this method
	 *
	 * @return  boolean  True on success
	 *
	 * @since  1.0.0
	 */
	public function install($parent): bool
	{
		echo Text::_('COM_EQUIPMENT_MANAGER_INSTALLERSCRIPT_INSTALL');

		$alias   = ApplicationHelper::stringURLSafe('Uncategorised');

		// Initialize a new category.
		$category = Table::getInstance('Category');

		$data = [
			'extension' => 'com_equipmentmanager',
			'title' => 'Uncategorised',
			'alias' => $alias,
			'description' => '',
			'published' => 1,
			'access' => 1,
			'params' => '{"target":"","image":""}',
			'metadesc' => '',
			'metakey' => '',
			'metadata' => '{"page_title":"","author":"","robots":""}',
			'created_time' => Factory::getDate()->toSql(),
			'created_user_id' => (int) $this->getAdminId(),
			'language' => '*',
			'rules' => [],
			'parent_id' => 1,
		];

		$category->setLocation(1, 'last-child');

		// Bind the data to the table
		if (!$category->bind($data)) {
			return false;
		}

		// Check to make sure our data is valid.
		if (!$category->check()) {
			return false;
		}

		// Store the category.
		if (!$category->store(true))
		{
			return false;
		}

		// Add Dashboard
		$this->addDashboardMenu('equipmentmanager','equipmentmanager');

		return true;

	}

	/**
	 * Retrieve the admin user id.
	 *
	 * @return  integer|boolean  One Administrator ID.
	 *
	 * @since   __BUMP_VERSION__
	 */
	private function getAdminId()
	{
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);

		// Select the admin user ID
		$query
			->clear()
			->select($db->quoteName('u') . '.' . $db->quoteName('id'))
			->from($db->quoteName('#__users', 'u'))
			->join(
				'LEFT',
				$db->quoteName('#__user_usergroup_map', 'map')
				. ' ON ' . $db->quoteName('map') . '.' . $db->quoteName('user_id')
				. ' = ' . $db->quoteName('u') . '.' . $db->quoteName('id')
			)
			->join(
				'LEFT',
				$db->quoteName('#__usergroups', 'g')
				. ' ON ' . $db->quoteName('map') . '.' . $db->quoteName('group_id')
				. ' = ' . $db->quoteName('g') . '.' . $db->quoteName('id')
			)
			->where(
				$db->quoteName('g') . '.' . $db->quoteName('title')
				. ' = ' . $db->quote('Super Users')
			);

		$db->setQuery($query);
		$id = $db->loadResult();

		if (!$id || $id instanceof \Exception) {
			return false;
		}

		return $id;
	}

	/**
	 * Method to uninstall the extension
	 *
	 * @param   InstallerAdapter  $parent  The class calling this method
	 *
	 * @return  boolean  True on success
	 *
	 * @since  1.0.0
	 */
	public function uninstall($parent): bool
	{
		echo Text::_('COM_EQUIPMENT_MANAGER_INSTALLERSCRIPT_UNINSTALL');

		return true;
	}

	/**
	 * Method to update the extension
	 *
	 * @param   InstallerAdapter  $parent  The class calling this method
	 *
	 * @return  boolean  True on success
	 *
	 * @throws Exception
	 * @since  1.0.0
	 *
	 */
	public function update($parent): bool
	{
		echo Text::_('COM_EQUIPMENT_MANAGER_INSTALLERSCRIPT_UPDATE');

		// Add Dashboard
		if(!$this->checkIfDashboardMenuExists('equipmentmanager','equipmentmanager'))
		{
			$this->addDashboardMenu('equipmentmanager','equipmentmanager');
		}

		return true;
	}

	private function checkIfDashboardMenuExists($dashboard,$preset){
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);

		$query
			->select($db->quoteName('id'))
			->from($db->quoteName('#__modules'))
			->where($db->quoteName('module') . ' = ' . $db->quote('mod_submenu'))
			->where($db->quoteName('title') . ' = ' . $db->quote('Equipmentmanager Dashboard'));

		$db->setQuery($query);

		return $db->loadResult();
	}

	private function removeDashboardMenu(){
			// TODO: Remove Dashboard Method otherwise it will may be duplicated
	}

	/**
	 * Function called before extension installation/update/removal procedure commences
	 *
	 * @param   string            $type    The type of change (install, update or discover_install, not uninstall)
	 * @param   InstallerAdapter  $parent  The class calling this method
	 *
	 * @return  boolean  True on success
	 *
	 * @since  1.0.0
	 *
	 * @throws Exception
	 */
	public function preflight($type, $parent): bool
	{
		if ($type !== 'uninstall')
		{
			// Check for the minimum PHP version before continuing
			if (!empty($this->minimumPHPVersion) && version_compare(PHP_VERSION, $this->minimumPHPVersion, '<'))
			{
				Log::add(
					Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPHPVersion),
					Log::WARNING,
					'jerror'
				);

				return false;
			}

			// Check for the minimum Joomla version before continuing
			if (!empty($this->minimumJoomlaVersion) && version_compare(JVERSION, $this->minimumJoomlaVersion, '<'))
			{
				Log::add(
					Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomlaVersion),
					Log::WARNING,
					'jerror'
				);

				return false;
			}

			Folder::create(JPATH_ROOT . '/images/equipmentmanager/packages/galleries');
			Folder::create(JPATH_ROOT . '/images/equipmentmanager/equipment');
			Folder::create(JPATH_ROOT . '/images/equipmentmanager/categories');
		}

		echo Text::_('COM_EQUIPMENT_MANAGER_INSTALLERSCRIPT_PREFLIGHT');


		return true;
	}

	/**
	 * Function called after extension installation/update/removal procedure commences
	 *
	 * @param   string            $type    The type of change (install, update or discover_install, not uninstall)
	 * @param   InstallerAdapter  $parent  The class calling this method
	 *
	 * @return  boolean  True on success
	 *
	 * @since  1.0.0
	 *
	 */
	public function postflight($type, $parent)
	{
		echo Text::_('COM_EQUIPMENT_MANAGER_INSTALLERSCRIPT_POSTFLIGHT');

		return true;
	}
}
