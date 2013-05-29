<?php
/**
 * @package     Jab.Admin
 * @subpackage  Tables
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

JLoader::import('jab.base.table');

/**
 * Speaker table for JAB
 *
 * @package     Jab.Admin
 * @subpackage  Tables
 * @since       1.0
 */
class JabTableSpeaker extends JabBaseTable
{
	/**
	 * Table name (without the prefix)
	 *
	 * @var  string
	 */
	protected $_tableName = 'jab_speakers';

	/**
	 * Indicator that the tags have been changed
	 *
	 * @var    JHelperTags
	 * @since  3.1
	 */
	protected $tagsHelper = null;

	/**
	 * Object constructor to set table and key fields.  In most cases this will
	 * be overridden by child classes to explicitly set the table and key fields
	 * for a particular database table.
	 *
	 * @param   JDatabaseDriver  $db  JDatabaseDriver object.
	 *
	 * @since   11.1
	 */
	public function __construct($db)
	{
		parent::__construct($db);

		$this->tagsHelper = new JHelperTags;
		$this->tagsHelper->typeAlias = 'com_jab.speaker';
	}

	/**
	 * Overloaded bind function
	 *
	 * @param   array  $array   Named array to bind
	 * @param   mixed  $ignore  An optional array or space separated list of properties to ignore while binding.
	 *
	 * @return  mixed  Null if operation was satisfactory, otherwise returns an error
	 * @since   1.6
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['params']);
			$array['params'] = (string) $registry;
		}

		if (isset($array['metadata']) && is_array($array['metadata']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string) $registry;
		}

		return parent::bind($array, $ignore);
	}

	public function store($updateNulls = false)
	{
		$this->tagsHelper->preStoreProcess($this);

		$result = parent::store($updateNulls);

		return $result && $this->tagsHelper->postStoreProcess($this);
	}
}
