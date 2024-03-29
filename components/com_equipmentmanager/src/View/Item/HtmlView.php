<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace NXD\Component\Equipmentmanager\Site\View\Item;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\Registry\Registry;

/**
 * HTML Equipment_managers View class for the Equipment_manager component
 *
 * @since  1.0.0
 */
class HtmlView extends BaseHtmlView
{

	public function display($tpl = null)
	{

		$this->item = $this->get('Item');

//		$item = $this->item = $this->get('Item');
//		$state = $this->State = $this->get('State');
//		$params = $this->Params = $state->get('params');
//		$itemparams = new Registry(json_decode($item->params));
//
//		$temp = clone $params;
//		$temp->merge($itemparams);
//		$item->params = $temp;
//
//		Factory::getApplication()->triggerEvent('onContentPrepare', array ('com_equipmentmanager.item', &$item));
//
//		// Store the events for later
//		$item->event = new \stdClass;
//		$results = Factory::getApplication()->triggerEvent('onContentAfterTitle', array('com_equipmentmanager.item', &$item, &$item->params));
//		$item->event->afterDisplayTitle = trim(implode("\n", $results));
//
//		$results = Factory::getApplication()->triggerEvent('onContentBeforeDisplay', array('com_equipmentmanager.item', &$item, &$item->params));
//		$item->event->beforeDisplayContent = trim(implode("\n", $results));
//
//		$results = Factory::getApplication()->triggerEvent('onContentAfterDisplay', array('com_equipmentmanager.item', &$item, &$item->params));
//		$item->event->afterDisplayContent = trim(implode("\n", $results));

		return parent::display($tpl);
	}
}
