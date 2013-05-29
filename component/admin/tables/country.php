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
 * Country Table class
 *
 * @package     Jab.Admin
 * @subpackage  Tables
 * @since       1.0
 */
class JabTableCountry extends JabBaseTable
{
	/**
	 * Table name (without the prefix)
	 *
	 * @var  string
	 */
	protected $_tableName = 'jab_countries';
}
