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
				$db = $this->getDbo();
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
		}

		return $this->_item[$pk];
	}
}
