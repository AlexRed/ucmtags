<?php
/**
 * @package     Jab.Admin
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Backend front controller of redTEST.
 *
 * @package     Jab.Admin
 * @subpackage  Controllers
 * @since       1.0
 */
class JabController extends JControllerLegacy
{
	/**
	 * Typical view method for MVC based architecture
	 *
	 * This function is provide as a default implementation, in most cases
	 * you will need to override it in your own controllers.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JControllerLegacy  A JControllerLegacy object to support chaining.
	 */
	public function display($cachable = false, $urlparams = array())
	{
		$input = JFactory::getApplication()->input;

		$view = $input->get('view', 'panel');

		// Set default view if not set.
		$input->set('view', $view);
		$input->set('task', $input->get('task', 'display'));

		parent::display($cachable, $urlparams);
	}
}
