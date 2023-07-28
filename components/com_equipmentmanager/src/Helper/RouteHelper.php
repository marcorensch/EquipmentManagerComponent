<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace NXD\Component\Equipmentmanager\Site\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Categories\CategoryNode;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Factory;

/**
 * Equipment Manager Component Route Helper
 *
 * @static
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 * @since       1.5
 */
abstract class RouteHelper
{

	public static function getCategoryRoute($catid, $language = 0): string
	{
		if ($catid instanceof CategoryNode)
		{
			$id = $catid->id;
		}
		else
		{
			$id = (int) $catid;
		}

		if ($id < 1)
		{
			$link = '';
		}
		else
		{
			$input = Factory::getApplication()->input;
			$itemId = $input->get('Itemid', 0, 'INT');

			// Create the link
			$link = 'index.php?option=com_equipmentmanager&view=category&Itemid='.$itemId.'&id=' . $id;

			if ($language && $language !== '*' && Multilanguage::isEnabled())
			{
				$link .= '&lang=' . $language;
			}
		}

		return $link;
	}
	/**
	 * Get the URL route for a equipmentmanager from a item ID, equipmentmanager category ID and language
	 *
	 * @param   integer  $id        The id of the item
	 * @param   integer  $catid     The id of the item's category
	 * @param   mixed    $language  The id of the language being used.
	 *
	 * @return  string  The link to the equipmentmanager
	 *
	 * @since   1.5
	 */
	public static function getItemRoute($id, $catid, $language = 0)
	{
		$input = Factory::getApplication()->input;
		$itemId = $input->get('Itemid', 0, 'INT');

		// Create the link
		$link = 'index.php?option=com_equipmentmanager&view=item&id=' . $id . '&catid=' . $catid . '&Itemid=' . $itemId;

		if ($catid > 1)
		{
			$link .= '&catid=' . $catid;
		}

		if ($language && $language !== '*' && Multilanguage::isEnabled())
		{
			$link .= '&lang=' . $language;
		}

		return $link;
	}

	public static function getPackagesRoute($catid, $language = 0)
	{
		// Create the link
		$link = 'index.php?option=com_equipmentmanager&view=packages';

		if ($catid > 1)
		{
			$link .= '&catid=' . $catid;
		}

		if ($language && $language !== '*' && Multilanguage::isEnabled())
		{
			$link .= '&lang=' . $language;
		}

		return $link;
	}
}
