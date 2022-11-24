<?php
namespace NXD\Component\Equipmentmanager\Site\View\Packages;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\Registry\Registry;

/**
 * HTML Packages View class for the Equipment_manager component
 *
 * @since  1.0.0
 */
class HtmlView extends BaseHtmlView
{

	protected $packages;

	public function display($tpl = null)
	{

		$this->packages = $this->get('Packages');

		return parent::display($tpl);
	}
}
