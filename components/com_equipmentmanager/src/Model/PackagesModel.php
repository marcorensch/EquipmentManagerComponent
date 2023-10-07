<?php

namespace NXD\Component\Equipmentmanager\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Factory;
use NXD\Component\Equipmentmanager\Site\Helper\GalleryHelper;

class PackagesModel extends BaseDatabaseModel
{

	protected $_packages = [];

	public function __construct($config = array(), MVCFactoryInterface $factory = null)
	{
		parent::__construct($config, $factory);
	}

	public function getPackages()
	{
		$app               = Factory::getApplication();
		$categories_filter = $app->getParams()->get('categories_filter', []);
		$categories_filter = array_map('intval', $categories_filter);
		$categories_filter = $categories_filter ? implode(',', $categories_filter) : [];

		error_log(print_r($categories_filter, true));

		try
		{
			$db    = $this->getDatabase();
			$query = $db->getQuery(true);

			$query->select('*')
				->from($db->quoteName('#__equipmentmanager_packages', 'a'))
				->where('a.published = 1');

			if (!empty($categories_filter))
			{
				$query->where('a.catid IN (' . $categories_filter . ')');
			}

			$query->order('a.ordering ASC');


			$db->setQuery($query);
			$this->_packages = $db->loadObjectList();

		}
		catch (\Exception $e)
		{
			$this->setError($e);
			$this->_packages = false;
		}

		if ($this->_packages)
		{
			foreach ($this->_packages as $package)
			{
				$related_items                      = json_decode($package->related_items);
				$related_items_from_db              = $this->_getRelatedItems($related_items);
				$related_items_completed            = $this->_combineInformation($related_items, $related_items_from_db);
				$package->related_items_by_cat      = $this->_buildCategoriesList($related_items_completed);
				$package->gallery_images    	    = GalleryHelper::getGalleryImages('packages', $package->gallery_path);
			}
		}

		return $this->_packages;
	}

	private function _combineInformation($related_items, $related_items_from_db)
	{
		if ($related_items)
		{
			foreach ($related_items as $related_item)
			{
				$related_items_from_db[$related_item->equipment_item]->count     = $related_item->count;
				$related_items_from_db[$related_item->equipment_item]->quickinfo = $related_item->description;
				$related_items_from_db[$related_item->equipment_item]->link      = \JRoute::_('index.php?option=com_equipmentmanager&view=item&id=' . $related_item->equipment_item . ':' . $related_items_from_db[$related_item->equipment_item]->alias);
			}
		}

		return $related_items_from_db;
	}

	private function _getRelatedItemIds($related_items): array
	{
		$relatedItemIds = [];
		if ($related_items)
		{
			foreach ($related_items as $related_item)
			{
				$relatedItemIds[] = $related_item->equipment_item;
			}
		}

		return $relatedItemIds;
	}

	private function _getRelatedItems($related_items): array
	{
		$relatedItems = [];
		$ids          = $this->_getRelatedItemIds($related_items);
		$app		  = Factory::getApplication();
		$params		  = $app->getParams();
		if ($ids)
		{
			try
			{
				$db    = $this->getDatabase();
				$query = $db->getQuery(true);

				$query
					->select($db->quoteName(array('a.title', 'a.catid', 'a.id', 'a.alias', 'a.image', 'a.ordering')))
					->select($db->quoteName('c.title', 'category_title'))
					->select($db->quoteName('c.alias', 'category_alias'))
					->select($db->quoteName('c.id', 'grouping_id'))
					->select($db->quoteName('c.description', 'category_description'))
					->select($db->quoteName('c.params', 'category_params'))
					->select($db->quoteName('c.lft', 'category_ordering'))
					->from($db->quoteName('#__equipmentmanager_items', 'a'))
					->join('LEFT', $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid'));
				// Override Category Information if selected in Configuration
				if($params->get('category_grouping_lvl','parent') === 'above-parent'){
					$query->select($db->quoteName('c2.title', 'category_title'))
						->select($db->quoteName('c2.id', 'grouping_id'))
						->select($db->quoteName('c2.alias', 'category_alias'))
						->select($db->quoteName('c2.description', 'category_description'))
						->select($db->quoteName('c2.params', 'category_params'))
						->select($db->quoteName('c2.lft', 'category_ordering'))
						->join('LEFT', $db->quoteName('#__categories', 'c2') . ' ON ' . $db->quoteName('c2.id') . ' = ' . $db->quoteName('c.parent_id'));
				}
				$query->where('a.published = 1')
					->where('a.id IN (' . implode(',', $ids) . ')');
					if($params->get('category_grouping_lvl','parent') === 'above-parent')
					{
						$query->order('c2.lft ASC');
					}
					else
					{
						$query->order('c.lft ASC');
					}

				$query->order('a.ordering ASC');

				$db->setQuery($query);
				$relatedItems = $db->loadObjectList('id');
			}
			catch (\Exception $e)
			{
				$this->setError($e);
				Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}
		}

		return $relatedItems;
	}

	private function _buildCategoriesList($related_items)
	{
		$categories = [];
		if ($related_items)
		{
			foreach ($related_items as $related_item)
			{
				if (!isset($categories[$related_item->grouping_id]))
				{
					$categories[$related_item->grouping_id]           = new \stdClass();
					$categories[$related_item->grouping_id]->id       = $related_item->grouping_id;
					$categories[$related_item->grouping_id]->title    = $related_item->category_title;
					$categories[$related_item->grouping_id]->alias    = $related_item->category_alias;
					$categories[$related_item->grouping_id]->ordering = $related_item->category_ordering;
					$categories[$related_item->grouping_id]->description = $related_item->category_description;
					$categories[$related_item->grouping_id]->params   = json_decode($related_item->category_params);
					$categories[$related_item->grouping_id]->items    = [];
				}
				$categories[$related_item->grouping_id]->items[] = $this->_cleanUpRelatedItem($related_item);
			}
		}

		return $categories;
	}

	private function _cleanUpRelatedItem($item) :\stdClass{
		unset($item->category_title);
		unset($item->category_alias);
		unset($item->category_description);
		unset($item->category_params);
		unset($item->category_ordering);
		return $item;
	}

}