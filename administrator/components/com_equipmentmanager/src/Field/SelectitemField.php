<?php
/**
 * @package     Joomla.Administrator
 *              com_equipmentmanager
 *              administrator\components\com_equipmentmanager\src\Model\Fields\SelectitemField.php
 *
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       1.0
 * @version     1.0
 * @author      Marco Rensch | nx-designs.ch | NXD
 *              https://www.nx-designs.ch
 */

namespace NXD\Component\Equipmentmanager\Administrator\Field;

use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

class SelectitemField extends ListField {

	protected $type = 'selectitem';

	protected function getInput()
	{
		return parent::getInput();
	}

	protected function getOptions()
	{
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('id', 'title')));
		$query->from($db->quoteName('#__equipmentmanager_items'));
		$db->setQuery($query);
		$items = $db->loadObjectList();
		$options = array();
		$options[] = HTMLHelper::_('select.option', "", "Select Item");
		if ($items)
		{
			foreach($items as $item)
			{
				$options[] = HTMLHelper::_('select.option', $item->id, $item->title);
			}
		}
		return $options;
	}
}