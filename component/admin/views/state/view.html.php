<?php
/**
 * @package     Jab.Admin
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

JLoader::import('joomla.application.component.view');

/**
 * State View
 *
 * @package     Jab.Admin
 * @subpackage  Views
 *
 * @since       1.0
 */
class JabViewState extends JViewLegacy
{
	/**
	 * Display method
	 *
	 * @param   string  $tpl  template name
	 *
	 * @return void
	 */
	function display($tpl = null)
	{
		// We don't need toolbar in the modal window.
		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();
		}

		$this->form	= $this->get('Form');
		$this->item	= $this->get('Item');

		// Display the template
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	2.5
	 *
	 * @return void
	 */
	protected function addToolbar()
	{
		// Hide the navigation bar
		$jinput = JFactory::getApplication()->input;
		$jinput->set('hidemainmenu', true);

		// Set Toolbar title
		JToolBarHelper::title(JText::_('COM_JAB_STATE_FORM_TITLE'), 'article.png');

		$user	= JFactory::getUser();

		if ($user->authorise('core.admin', 'com_jab.panel'))
		{
			JToolBarHelper::apply('state.apply');
			JToolBarHelper::save('state.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::custom('state.save2new', 'save.png', 'save_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		}
		if (empty($this->item->id))
		{
			JToolBarHelper::cancel('state.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			JToolBarHelper::cancel('state.cancel', 'JTOOLBAR_CLOSE');
		};
		JToolBarHelper::divider();
	}
}
