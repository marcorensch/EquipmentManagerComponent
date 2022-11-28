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
use Joomla\CMS\Filesystem\Folder;
use NXD\Component\Equipmentmanager\Site\Helper\GalleryHelper;

/**
 * Foo model for the Joomla Foos component.
 *
 * @since  __BUMP_VERSION__
 */
class ItemModel extends BaseDatabaseModel
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
	public function getItem($pk = null)
	{
		$app = Factory::getApplication();
		$pk = $app->input->getInt('id');

		if ($this->_item === null) {
			$this->_item = [];
		}

		if (!isset($this->_item[$pk])) {
			try {
				$db = $this->getDatabase();
				$query = $db->getQuery(true);

				$query->select('*')
					->from($db->quoteName('#__equipmentmanager_items', 'a'))
					->where('a.id = ' . (int) $pk);

				$db->setQuery($query);
				$data = $db->loadObject();

				if (empty($data)) {
					throw new \Exception(Text::_('COM_EQUIPMENT_MANAGER_ERROR_ITEM_NOT_FOUND'), 404);
				}

				$this->_item[$pk] = $data;
			} catch (\Exception $e) {
				$this->setError($e);
				$this->_item[$pk] = false;
			}
		}

		if($this->_item[$pk]) {
			if($this->_item[$pk]->features){
				$this->_item[$pk]->features = json_decode($this->_item[$pk]->features);
			}

			$this->_item[$pk]->related_items_bycat = $this->_getRelatedItems($this->_item[$pk]->catid, $pk);

		}

		$this->_item[$pk]->galleryImages = GalleryHelper::getGalleryImages('equipment', $this->_item[$pk]->gallery_path);

		return $this->_item[$pk];
	}

	private function _getRelatedItems($catid, $itemId){
		$params = Factory::getApplication()->getParams();
		$related_items_limit = $params->get('related_items_limit', 10);
		$db = $this->getDatabase();
		$query = $db->getQuery(true);
		try
		{
			$query->select($db->quoteName(array('a.title', 'a.catid', 'a.id', 'a.alias', 'a.image')))
				->from($db->quoteName('#__equipmentmanager_items', 'a'))
				->where('a.catid = ' . (int) $catid)
				->where('a.id != ' . (int) $itemId)
				->where('a.published = 1')
				->order('a.ordering ASC');
			if($related_items_limit){
				$query->setLimit($related_items_limit);
			}

			$db->setQuery($query);
			$data = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			$this->setError($e->getMessage());
			return false;
		}

		if($data){
			foreach($data as $key => $item){
				$data[$key]->link = \JRoute::_('index.php?option=com_equipmentmanager&view=item&id=' . $item->id . ':' . $item->alias);
			}
		}

		return $data;
	}


}
