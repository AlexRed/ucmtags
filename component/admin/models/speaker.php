<?php
/**
 * @package     Jab.Admin
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

JLoader::import('jab.base.model.admin');

/**
 * Speaker Model
 *
 * @package     Jab.Admin
 * @subpackage  Models
 *
 * @since       1.0
 */
class JabModelSpeaker extends JabBaseModelAdmin
{
	/**
	 * Component name
	 *
	 * @var  string
	 */
	protected $_component = 'com_jab';

	/**
	 * Table Name
	 *
	 * @var  string
	 */
	protected $_tableType = 'speaker';

	/**
	 * Table Prefix
	 *
	 * @var  string
	 */
	protected $_tablePrefix = 'JabTable';

	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed  Object on success, false on failure.
	 *
	 * @since   1.0
	 */
	public function getItem($pk = null)
	{
		$item = parent::getItem($pk);

		// Load item tags
		if (!empty($item->id))
		{
			// Convert the metadata field to an array.
			$registry = new JRegistry($item->metadata);
			$item->metadata = $registry->toArray();

			$item->tags = new JHelperTags;
			$item->tags->getTagIds($item->id, 'com_jab.speaker');
			$item->metadata['tags'] = $item->tags;
		}

		return $item;
	}
}
