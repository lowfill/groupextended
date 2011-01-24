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
global $CONFIG;
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
	<?php echo elgg_echo('groupextended:default_membership'); ?>
	<select name="params[membership]">
		<option value="<?php echo ACCESS_PRIVATE;?>" <?php if ($vars['entity']->membership == ACCESS_PRIVATE) echo " selected=\"yes\" "; ?>><?php echo elgg_echo('groups:access:private'); ?></option>
		<option value="<?php echo ACCESS_PUBLIC;?>" <?php if ($vars['entity']->membership== ACCESS_PUBLIC) echo " selected=\"yes\" "; ?>><?php echo elgg_echo('groups:access:public'); ?></option>
	</select>

</p>
<?php 
if (isset($CONFIG->group_tool_options)) {
	foreach($CONFIG->group_tool_options as $group_option) {
		$group_option_toggle_name = $group_option->name."_enable";
		if ($group_option->default_on) {
			$group_option_default_value = 'yes';
		} else {
			$group_option_default_value = 'no';
		}
?>
<p>
	<?php echo $group_option->label; ?>

	<select name="params[<?php echo $group_option_toggle_name;?>]">
		<option value="yes" <?php if ($vars['entity']->$group_option_toggle_name == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->$group_option_toggle_name != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>

</p>

<?php 
	}
}
?>