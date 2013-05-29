<?php
/**
 * @package     Jab.Admin
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

// HTML helpers
JHtml::_('behavior.multiselect');

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

$user	= JFactory::getUser();
$action = JRoute::_('index.php?option=com_jab&view=countries');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$saveOrder	= $listOrder == 'ordering';

if ($saveOrder && version_compare(JVERSION, '3.0', 'ge'))
{
	$saveOrderingUrl = 'index.php?option=com_jab&task=countries.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

?>
<form action="<?php echo $action; ?>" name="adminForm" class="adminForm" id="adminForm" method="post">
	<div class="">
		<!-- search filter -->
		<label for="filter_search">
			<?php echo JText::_('COM_JAB_FILTER_LABEL');?>
		</label>
		<input type="text" name="filter_search" value="<?php echo $this->state->get('filter.search'); ?>" id="search">
		<button onclick="this.form.submit();"><?php echo JText::_('COM_JAB_FILTER_BUTTON'); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_('COM_JAB_FILTER_RESET'); ?></button>

		<div class="filter-select fltrt">
			<!-- select for state -->
			<select name="filter_published" class="inputbox" onchange="this.form.submit()">
				<option value="">
					<?php echo JText::_('JOPTION_SELECT_PUBLISHED');?>
				</option><?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
			</select>
			<!-- select for language -->
			<select name="filter_language" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_LANGUAGE');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'));?>
			</select>
		</div>
		<table class="table table-striped table-bordered table-hover" id="articleList">
			<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
					</th>
					<?php if (version_compare(JVERSION, '3.0', 'ge')): ?>
						<th width="1%" class="hidden-phone">
							<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
						</th>
					<?php else: ?>
						<th width="1px">
							<input type="checkbox" name="check-toggle" onclick="checkAll(this);">
						</th>
					<?php endif; ?>
					<th class="name">
						<?php echo JHtml::_('grid.sort',  'COM_JAB_NAME_LABEL', 'c.name', $listDirn, $listOrder); ?>
					</th>
					<th width="5%">
						<?php echo JHtml::_('grid.sort',  'JPUBLISHED', 'c.state', $listDirn, $listOrder); ?>
					</th>
					<th width="10%" class="center">
						<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_LANGUAGE', 'language', $listDirn, $listOrder); ?>
					</th>
					<th width="1%" class="id">
						<?php echo JHtml::_('grid.sort',  'COM_JAB_ID', 'c.id', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<?php if ($this->items): ?>
				<tbody>
					<?php foreach ($this->items as $i => $item): ?>
						<?php
							$canChange = 1;
							$canEdit   = 1;
						?>
						<tr class="row&lt;?php echo $i%2; ?&gt;">
							<td class="order nowrap center hidden-phone">
							<?php if ($canChange) :
								$disableClassName = '';
								$disabledLabel	  = '';

								if (!$saveOrder)
								{
									$disabledLabel    = JText::_('JORDERINGDISABLED');
									$disableClassName = 'inactive tip-top';
								}
								?>
								<span class="sortable-handler hasTooltip <?php echo $disableClassName?>" title="<?php echo $disabledLabel?>">
									<i class="icon-menu"></i>
								</span>
								<input type="text" style="display:none" name="order[]" size="5"
									value="<?php echo $item->ordering;?>" class="width-20 text-area-order " />
							<?php else : ?>
								<span class="sortable-handler inactive" >
									<i class="icon-menu"></i>
								</span>
							<?php endif; ?>
							</td>
							<td>
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
							<td>
								<a href="<?php echo JRoute::_('index.php?option=com_jab&task=country.edit&id=' . $item->id);?>">
									<?php echo $this->escape($item->name); ?>
								</a>
							</td>
							<td class="center">
								<?php echo JHtml::_('jgrid.published', $item->state, $i, 'countries.', $canChange, 'cb'); ?>
							</td>
							<td class="center">
								<?php if ($item->language == '*') :?>
									<?php echo JText::alt('JALL', 'language'); ?>
								<?php else:?>
									<?php echo $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
								<?php endif;?>
							</td>
							<td>
								<?php echo $item->id; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			<?php endif; ?>
		</table>
	</div>

	<?php
	/**
	* @TODO: Load the batch processing form.
	* echo $this->loadTemplate('batch');
	**/
	?>
	<div>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>">
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>">
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>