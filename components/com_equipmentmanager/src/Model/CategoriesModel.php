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
use Joomla\Registry\Registry;

/**
 * Categories model class for the Equipment Manager Component
 *
 * @since  __BUMP_VERSION__
 */
class CategoriesModel extends BaseDatabaseModel
{
	/**
	 * @var string item
	 */
	protected $_item = null;

	public function getCategories()
	{
		$app = Factory::getApplication();
		$catId = $app->input->getInt('id');

		try
		{
			$db    = $this->getDatabase();
			$query = $db->getQuery(true);

			$query->select(array('c.id','c.title','c.alias','c.description','c.params','c.language'))
				->from($db->quoteName('#__categories', 'c'))
				->where('c.published = 1')
				->where('c.parent_id = ' . $catId)
				->order('c.lft ASC');

			$db->setQuery($query);
			$categories = $db->loadObjectList();

			if($categories)
			{
				$categories = array_map(function($category) {
					$category->params = json_decode($category->params);
					return $category;
				}, $categories);
			}

		}
		catch (\Exception $e)
		{
			$app = Factory::getApplication();
			$app->enqueueMessage($e->getMessage(), 'error');
			$categories = false;
		}

		return $categories;
	}
}
