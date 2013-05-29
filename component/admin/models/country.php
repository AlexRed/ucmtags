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
 * Country Model
 *
 * @package     Jab.Admin
 * @subpackage  Models
 *
 * @since       1.0
 */
class JabModelCountry extends JabBaseModelAdmin
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
	protected $_tableType = 'country';

	/**
	 * Table Prefix
	 *
	 * @var  string
	 */
	protected $_tablePrefix = 'JabTable';
}
