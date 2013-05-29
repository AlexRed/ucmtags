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

require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/jab.php';

/**
 * Speakers View
 *
 * @package     Jab.Admin
 * @subpackage  Views
 *
 * @since       1.0
 */
class JabViewSpeakers extends JViewLegacy
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
		// Load the submenu.
		if ($this->getLayout() !== 'modal')
		{
			JabHelper::addSubmenu(JFactory::getApplication()->input->get('view', 'panel'));
		}

		// Get items
		$this->items = $this->get('Items');

		// Calls getState in parent class and populateState() in model
		$this->state      = $this->get('State');
		$this->pagination = $this->get('Pagination');

		// We don't need toolbar in the modal window.
		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();
		}

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
		$canDo = JabHelper::getActions($this->state->get('filter.category_id'));
		$user	= JFactory::getUser();

		if ($user->authorise('core.admin', 'com_jab.panel'))
		{
			// Page title
			JToolBarHelper::title(JText::_('COM_JAB_SPEAKER_LIST_TITLE'), 'article.png');

			// Back button
			JToolBarHelper::custom('speakers.topanel', 'back.png', 'back_f2.png', 'COM_JAB_CONTROL_PANEL_TITLE', false);
			JToolBarHelper::divider();

			// Add / edit
			if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_jab', 'core.create'))) > 0)
			{
				JToolBarHelper::addNew('speaker.add', 'JTOOLBAR_NEW');
			}
			if (($canDo->get('core.edit')))
			{
				JToolBarHelper::editList('speaker.edit', 'JTOOLBAR_EDIT');
			}

			// Publish / Unpublish
			if ($canDo->get('core.edit.state'))
			{
				JToolBarHelper::divider();
				JToolBarHelper::custom('speakers.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::custom('speakers.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}

			// Delete / Trash
			if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
			{
				JToolBarHelper::divider();
				JToolBarHelper::deleteList('', 'speakers.delete', 'JTOOLBAR_EMPTY_TRASH');
				JToolBarHelper::divider();
			}
			elseif ($canDo->get('core.edit.state'))
			{
				JToolBarHelper::divider();
				JToolBarHelper::trash('speakers.trash', 'JTOOLBAR_TRASH');
				JToolBarHelper::divider();
			}

			// Preferences
			if ($canDo->get('core.admin'))
			{
				JToolBarHelper::preferences('com_jab');
				JToolBarHelper::divider();
			}
		}
	}
}
