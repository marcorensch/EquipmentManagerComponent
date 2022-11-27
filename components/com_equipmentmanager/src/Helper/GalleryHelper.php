<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace NXD\Component\Equipmentmanager\Site\Helper;

use Joomla\Filesystem\Folder;

abstract class GalleryHelper {
	public function getGalleryImages($type, $selectedFolder){
		$galleryImages = [];
		$folderToEquipmentImages = '/images/equipmentmanager/'.$type.'/';
		$imgsPath = JPATH_SITE . $folderToEquipmentImages . $selectedFolder;
		if (is_dir($imgsPath))
		{
			// Allowed filetypes
			$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
			// Also allow filetypes in uppercase
			$allowedExtensions = array_merge($allowedExtensions, array_map('strtoupper', $allowedExtensions));
			// Build the filter. Will return something like: "jpg|jpeg|png|JPG|JPEG|PNG|gif|GIF"
			$filter = implode('|', $allowedExtensions);
			$filter = "^.*\.(" . implode('|', $allowedExtensions) . ")$";
			// Get the files
			$galleryImages = Folder::files($imgsPath, $filter, false, false, $exclude = array('index.html'));
			// Prepend the folder path to the filenames
			$galleryImages = array_map(function($img) use ($folderToEquipmentImages, $selectedFolder) {
				return $folderToEquipmentImages . $selectedFolder . '/' . $img;
			}, $galleryImages);

		}
		return $galleryImages;
	}
}