<?php
/**
 * @package     Jab.Admin
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

$action = JRoute::_('index.php?option=com_jab&view=country');

// HTML helpers
JHtml::_('behavior.multiselect');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');

if (version_compare(JVERSION, '3.0', 'ge'))
{
	JHtml::_('bootstrap.tooltip');
	JHtml::_('dropdown.init');
	JHtml::_('formbehavior.chosen', 'select');
}
else
{
	JHtml::_('behavior.tooltip');
}
?>
<form action="<?php echo $action; ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<ul>
		<li>
			<?php echo $this->form->getLabel('name'); ?>
			<?php echo $this->form->getInput('name'); ?>
		</li>
		<li>
			<?php echo $this->form->getLabel('language'); ?>
			<?php echo $this->form->getInput('language'); ?>
		</li>
		<li>
			<?php echo $this->form->getLabel('state'); ?>
			<?php echo $this->form->getInput('state'); ?>
		</li>
	</ul>
	<!-- hidden fields -->
  	<input type="hidden" name="option"	value="com_jab">
  	<input type="hidden" name="id"	value="<?php echo $this->item->id; ?>">
  	<input type="hidden" name="task" value="">
	<?php echo JHTML::_('form.token'); ?>
</form>
