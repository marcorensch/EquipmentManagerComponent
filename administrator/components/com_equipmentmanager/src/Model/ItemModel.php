<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace NXD\Component\Equipmentmanager\Administrator\Model;

defined('_JEXEC') or die;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\MVC\Model\AdminModel;

/**
 * Item Model for a Equipment_manager.
 *
 * @since  1.0.0
 */
class ItemModel extends AdminModel
{
	/**
	 * The type alias for this content type.
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	public $typeAlias = 'com_equipmentmanager.item';

	/**
	 * The context used for the associations table
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $associationsContext = 'com_equipmentmanager.item';

	/**
	 * Batch copy/move command. If set to false, the batch copy/move command is not supported
	 *
	 * @var  string
	 */
	protected $batch_copymove = 'category_id';

	/**
	 * Allowed batch commands
	 *
	 * @var array
	 */
	protected $batch_commands = [
			'assetgroup_id' => 'batchAccess',
			'language_id'   => 'batchLanguage',
			'user_id'       => 'batchUser',
		];

	/**
	 * Method to get the row form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  Form|boolean  A \JForm object on success, false on failure
	 *
	 * @since   1.0.0
	 * @throws  Exception
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_equipmentmanager.item',
			'equipment', ['control' => 'jform', 'load_data' => $loadData]);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.0.0
	 * @throws  Exception
	 */
	protected function loadFormData()
	{
		$app = Factory::getApplication();

		$data = $app->getUserState('com_equipmentmanager.edit.item.data', array());


		if(empty($data))
		{
			$data = $this->getItem();
			if($this->getState('item.id') == 0)
			{
				$data->set('catid', $app->getInput()->getInt('catid', $app->getUserState('com_equipmentmanager.items.filter.category_id')));
			}
		}

		$this->preprocessData('com_equipmentmanager.item', $data);

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed  Object on success, false on failure.
	 *
	 * @since   1.0.0
	 * @throws  Exception
	 */
	public function getItem($pk = null)
	{
		$item = parent::getItem($pk);

		// Load associated equipmentmanager items
		$assoc = Associations::isEnabled();

		if ($assoc)
		{
			$item->associations = [];

			if ($item->id != null)
			{
				$associations = Associations::getAssociations('com_equipmentmanager',
					'#__equipmentmanager_items', 'com_equipmentmanager.item', $item->id, 'id',
					null);

				foreach ($associations as $tag => $association)
				{
					$item->associations[$tag] = $association->id;
				}
			}
		}

		return $item;
	}

	/**
	 * Preprocess the form.
	 *
	 * @param   Form    $form   Form object.
	 * @param   object  $data   Data object.
	 * @param   string  $group  Group name.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 * @throws  Exception
	 */
	protected function preprocessForm(\JForm $form, $data, $group = 'content')
	{
		if (Associations::isEnabled())
		{
			$languages = LanguageHelper::getContentLanguages(false, true, null, 'ordering', 'asc');

			if (count($languages) > 1)
			{
				$addform = new \SimpleXMLElement('<form />');
				$fields  = $addform->addChild('fields');
				$fields->addAttribute('name', 'associations');
				$fieldset = $fields->addChild('fieldset');
				$fieldset->addAttribute('name', 'item_associations');

				foreach ($languages as $language)
				{
					$field = $fieldset->addChild('field');
					$field->addAttribute('name', $language->lang_code);
					$field->addAttribute('type', 'modal_equipmentmanager');
					$field->addAttribute('language', $language->lang_code);
					$field->addAttribute('label', $language->title);
					$field->addAttribute('translate_label', 'false');
					$field->addAttribute('select', 'true');
					$field->addAttribute('new', 'true');
					$field->addAttribute('edit', 'true');
					$field->addAttribute('clear', 'true');
				}

				$form->load($addform, false);
			}
		}

		parent::preprocessForm($form, $data, $group);
	}

	/**
	 * @throws Exception
	 */
	public function save($data): bool
	{
		$input = Factory::getApplication()->input;

		if($input->get('task') == 'save2copy')
		{
			$origTable = $this->getTable();
			$origTable->load($input->getInt('id'));
			if($origTable->title == $data['title'])
			{
				list($title, $alias) = $this->generateNewTitle($data['catid'], $data['alias'], $data['title']);
				$data['title'] = $title;
				$data['alias'] = $alias;
			}
		}

		// handle params field
		if (isset($data['params']) ){
			$data['params'] = json_encode($data['params']);
		}else{
			$data['params'] = '';
		}

		return parent::save($data);
	}
}
