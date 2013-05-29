<?php
/**
 * @package     Jab.Admin
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

JLoader::import('joomla.application.component.controllerform');

/**
 * Country Form Controller
 *
 * @package     Jab.Admin
 * @subpackage  Controllers
 *
 * @since       1.0
 */
class JabControllerCountry extends JControllerForm
{
	/**
	 * @var    string  The prefix to use with controller messages.
	 * @since  2.5
	 */
	protected $text_prefix = 'COM_JAB_COUNTRY';

	/**
	 * Display method
	 *
	 * @param   boolean  $cachable   Cache display
	 * @param   array    $urlparams  urlparams
	 *
	 * @return void
	 */
	function display($cachable = false, $urlparams = array())
	{
		parent::display();
	}

	/**
	 * Get the associated model
	 *
	 * @param   string  $name    Name of the model
	 * @param   string  $prefix  prefix of the model
     * @param   array   $config  Custom config
	 *
	 * @return  object  The model
	 */
	public function getModel($name = 'Country', $prefix = 'JabModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}
}
