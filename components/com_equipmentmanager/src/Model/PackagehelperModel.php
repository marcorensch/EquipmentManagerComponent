<?php

namespace NXD\Component\Equipmentmanager\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Factory;

class PackagehelperModel extends BaseDatabaseModel{

	protected $_packages = [];
	protected $_relatedItemCategories = [];
	protected $_relatedItemsByCategories = [];

	public function __construct($config = array(), MVCFactoryInterface $factory = null)
	{
		parent::__construct($config, $factory);
	}

	public function getPackages(){
		$app = Factory::getApplication();
		$categories_filter = $app->getParams()->get('categories_filter', []);
		$categories_filter = array_map('intval', $categories_filter);
		$categories_filter = $categories_filter ? implode(',', $categories_filter) : [];

		error_log(print_r($categories_filter, true));

		try{
			$db = $this->getDbo();
			$query = $db->getQuery(true);

			$query->select('*')
				->from($db->quoteName('#__equipmentmanager_packages', 'a'))
				->where('a.published = 1');

			if(!empty($categories_filter)){
				$query->where('a.catid IN (' .  $categories_filter . ')');
			}

			$query->order('a.ordering ASC');


			$db->setQuery($query);
			$this->_packages = $db->loadObjectList();

		} catch (\Exception $e){
			$this->setError($e);
			$this->_packages = false;
		}

		if($this->_packages){
			foreach($this->_packages as $package){
				$package->related_items = json_decode($package->related_items);

			}
		}

		return $this->_packages;
	}

	private function _getRelatedItems(){
		$relatedItemIds = [];

		if($this->_packages){
			foreach($this->_packages as $package){
				if($package->related_items){
					foreach($package->related_items as $relatedItem){
						$relatedItems[] = $relatedItem;
					}
				}
			}
		}

		return $relatedItems;
	}
}