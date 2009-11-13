<?php
/**
 * Elgg groupextended plugin configuration options
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */
?>

<p>
	<?php echo elgg_echo('groupextended:invitegroups'); ?>

	<select name="params[invitegroups]">
		<option value="yes" <?php if ($vars['entity']->invitegroups == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->invitegroups != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>

</p>
<p>
	<?php echo elgg_echo('groupextended:squareicon'); ?>

	<select name="params[squareicon]">
		<option value="yes" <?php if ($vars['entity']->squareicon == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->squareicon != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>

</p>
<p>
	<?php echo elgg_echo('groups:enableforum'); ?>

	<select name="params[forum_enable]">
		<option value="yes" <?php if ($vars['entity']->forum_enable == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->forum_enable != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>

</p>
<p>
	<?php echo elgg_echo('groups:enablefiles'); ?>

	<select name="params[files_enable]">
		<option value="yes" <?php if ($vars['entity']->files_enable == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->files_enable != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>

</p><p>
	<?php echo elgg_echo('groups:enablepages'); ?>

	<select name="params[pages_enable]">
		<option value="yes" <?php if ($vars['entity']->pages_enable == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->pages_enable != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>

</p>
