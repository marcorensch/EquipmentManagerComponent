<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace NXD\Component\Equipmentmanager\Site\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

/**
 * Foo model for the Joomla Foos component.
 *
 * @since  __BUMP_VERSION__
 */
class ItemsModel extends BaseDatabaseModel
{
	/**
	 * @var string item
	 */
	protected $_item = null;

	/**
	 * Gets a foo
	 *
	 * @param   integer  $pk  Id for the foo
	 *
	 * @return  mixed Object or null
	 *
	 * @since   __BUMP_VERSION__
	 */
	public function getChildCategories()
	{
		$app = Factory::getApplication();
		$catId = $app->input->getInt('root_category');
		$subCatId = $app->input->getInt('sub_category');
		$isDetailed = false;

		if($subCatId) {
			$catId = $subCatId;
			$isDetailed = true;
		}
		try
		{
			$db    = $this->getDatabase();
			$query = $db->getQuery(true);

			$query->select('*')
				->from($db->quoteName('#__categories', 'c'))
				->where('c.published = 1')
				->where('c.parent_id = ' . $catId);

			$query->order('c.lft ASC');

			$db->setQuery($query);
			$categories = $db->loadObjectList();

		}
		catch (\Exception $e)
		{
			$app = Factory::getApplication();
			$app->enqueueMessage($e->getMessage(), 'error');
			$categories = false;
		}

		if($categories && !$isDetailed)
		{
			$categories = array_map(function($category) use ($catId) {
				$category->link = 'index.php?option=com_equipmentmanager&view=items&layout=categoryitems&category=' . $category->id;
				$category->params = json_decode($category->params);
				return $category;
			}, $categories);
		}

		if($categories && $isDetailed)
		{
			foreach($categories as $category)
			{
				$category->params = json_decode($category->params);
				$category->items = $this->_getItemsByCategory($category->id);
			}
		}

		return $categories;
	}

	private function _getItemsByCategory($catId){
		try
		{
			$db    = $this->getDatabase();
			$query = $db->getQuery(true);

			$query->select('*')
				->from($db->quoteName('#__equipmentmanager_items', 'a'))
				->where('a.published = 1')
				->where('c.catid = ' . $catId);

			$query->order('a.ordering ASC');

			$db->setQuery($query);
			$items = $db->loadObjectList();

		}
		catch (\Exception $e)
		{
			$app = Factory::getApplication();
			$app->enqueueMessage($e->getMessage(), 'error');
			$items = array();
		}

		return $items;
	}
}
