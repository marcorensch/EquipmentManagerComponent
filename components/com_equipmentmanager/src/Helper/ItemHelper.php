<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace NXD\Component\Equipmentmanager\Site\Helper;



abstract class ItemHelper {
	public static function buildItemLayout($item):String{

		$layout = '<div class="uk-card uk-card-default uk-card-small">';
		$layout .= '<div class="uk-height-small uk-cover-container">';
		$layout .= '<img src="'.$item->image.'" uk-cover>';
		$layout .= '</div>';
		$layout .= '<div class="uk-card-body">';
		$layout .= '<span class="uk-text-bold">'.$item->title.'</span>';
		$layout .= '</div>';
		$layout .= '<a href="'.$item->link.'" class="uk-position-cover"></a>';
		$layout .= '</div>';

		return $layout;
	}
}