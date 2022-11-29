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
use NXD\Component\Equipmentmanager\Site\Model\ItemModel;
use Joomla\Registry\Registry;

/**
 * Foo model for the Joomla Foos component.
 *
 * @since  __BUMP_VERSION__
 */
class CategoryModel extends BaseDatabaseModel
{
	/**
	 * @var string item
	 */
	protected $_childCategories = null;

	public function getCategoryChilds()
	{
		$app = Factory::getApplication();
		$id = $app->input->getInt('id');

		try
		{
			$db    = $this->getDatabase();
			$query = $db->getQuery(true);

			$query->select(array('c.id','c.title','c.alias','c.params','c.language'))
				->from($db->quoteName('#__categories', 'c'))
				->where('c.published = 1')
				->where('c.parent_id = ' . $id)
				->order('c.lft ASC');

			$db->setQuery($query);
			$this->_childCategories = $db->loadObjectList();

			if($this->_childCategories)
			{
				$this->_childCategories = array_map(function($category) {
					$category->params = json_decode($category->params);
					return $category;
				}, $this->_childCategories);

				// Append Child Items (Equipment Items)
				$itemModel = new ItemModel();
				$this->_childCategories = array_map(fn ($category) => $itemModel->getItemsForOverview($category), $this->_childCategories);
			}

		}
		catch (\Exception $e)
		{
			$app = Factory::getApplication();
			$app->enqueueMessage($e->getMessage(), 'error');
			$categories = false;
		}

		return $this->_childCategories;
	}
}
