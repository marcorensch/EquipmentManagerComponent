<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace NXD\Component\Equipmentmanager\Site\View\Items;

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
	protected $categories;

	public function display($tpl = null)
	{
		$this->categories = $this->get('ChildCategories');

		return parent::display($tpl);
	}
}
