<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace NXD\Component\Equipmentmanager\Site\Helper;

use Joomla\CMS\Image\Image;
use Joomla\Filesystem\Folder;

abstract class GalleryHelper {
	public static function getGalleryImages($type, $selectedFolder): array
	{
		$galleryImages = [];
		$folderToEquipmentImages = "images/equipmentmanager/$type/";
		if($type === 'packages'){
			$folderToEquipmentImages .= 'galleries/';
		}

		$imgsPath = JPATH_SITE . '/' . $folderToEquipmentImages . $selectedFolder;
		if (is_dir($imgsPath))
		{
			$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
			// see https://www.regular-expressions.info/modifiers.html and here is a sub-demonstration: https://3v4l.org/fKXcL
			$filter = "\.(?:(?i)" . implode('|', $allowedExtensions) . ")$";

			// Prepend the folder path to the filenames (enjoying PHP7.4's arrow function syntax)
			$galleryImages = array_map(
				fn($img) => \JUri::base() . $folderToEquipmentImages . $selectedFolder . '/' . $img,
				Folder::files($imgsPath, $filter, false, false, $exclude = ['index.html'])
			);
		}
		return $galleryImages;
	}
}