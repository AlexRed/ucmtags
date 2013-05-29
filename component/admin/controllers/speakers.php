<?php
/**
 * @package     Jab.Admin
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

JLoader::import('joomla.application.component.controlleradmin');

/**
 * Speaker List Controller
 *
 * @package     Jab.Admin
 * @subpackage  Controllers
 *
 * @since       1.0
 */
class JabControllerSpeakers extends JControllerAdmin
{
	/**
     * Get the associated model
     *
     * @param   string  $name    Name of the model
     * @param   string  $prefix  prefix of the model
     * @param   array   $config  Custom config
     *
     * @return  object  The model
     */
	public function getModel($name = 'Speaker', $prefix = 'JabModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

	/**
	 * Return to control panel
	 *
	 * @return void
	 */
	public function toPanel()
	{
		$this->setRedirect(JRoute::_('index.php?option=com_jab', false));
	}

	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 *
	 * @return	void
	 *
	 * @since   3.0
	 */
	public function saveOrderAjax()
	{
		// Get the input
		$pks   = $this->input->post->get('cid', array(), 'array');
		$order = $this->input->post->get('order', array(), 'array');

		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// Close the application
		JFactory::getApplication()->close();
	}
}
