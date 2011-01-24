<?php
/**
 * Elgg groupextended plugin's edit form. Overwrites groups/views/default/forms/groups/edit.php
 *
 * Overwrites groups/views/default/forms/edit.php to add support for special input types
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */

$group_context = get_input("group_context","groups");
?>
<div class="contentWrapper">
<form action="<?php echo $vars['url']; ?>action/groups/edit" enctype="multipart/form-data" method="post">

	<?php echo elgg_view('input/securitytoken'); ?>

	<p>
		<label><?php echo elgg_echo("groups:icon"); ?><br />
		<?php

			echo elgg_view("input/file",array('internalname' => 'icon'));

		?>
		</label>
	</p>
<?php

	//var_export($vars['profile']);
	if (is_array($vars['config']->group) && sizeof($vars['config']->group) > 0)
		foreach($vars['config']->group as $shortname => $valtype) {
          $options = array();
          $field_context = "groups";
          if(is_array($valtype)){
            list($valtype,$options,$field_context) = $valtype;
            if($field_context!=$group_context) continue;
          }

          if($valtype=="hidden"){
            echo elgg_view("input/hidden",array("internalname"=>$shortname,"value"=>$options));
            continue;
          }
          $legend = elgg_echo("{$field_context}:{$shortname}:legend");
          if(strpos($legend,$field_context)===0){ 
          	$legend="";
          }
?>

	<p>
		<label>
			<?php echo elgg_echo("{$field_context}:{$shortname}") ?> <small><?php echo $legend;?></small><br />
			<?php
			if (is_plugin_enabled('gmaplocationfield') && $valtype=='gmap'){
			  echo elgg_view("input/{$valtype}",array('entity' => $vars['entity'],'internalname'=>$shortname));
			}
            else{
			  $value =  get_input($shortname,$vars['entity']->$shortname);

			  if(!is_array($options)){
			    $value=$options;
			  }

              echo elgg_view("input/{$valtype}",array(
															'internalname' => $shortname,
															'value' => $value,
                                                            // For radio and pulldown input types
															'options'=>$options,
                                                            // In the case the valtype is pulldown and you want's an assosiative array
                                                			'options_values'=>$options
			  ));
            }
			?>
		</label>
	</p>

<?php

		}

		$membership = get_plugin_setting('membership','groupextended');
		$membership = (empty($vars['entity']->membership)) ? $membership: $vars['entity']->membership;
?>
<fieldset>
	<p>
		<label>
			<?php echo elgg_echo('groups:membership'); ?><br />
			<?php echo elgg_view('input/access', array('internalname' => 'membership','value' => $membership, 'options' => array( ACCESS_PRIVATE => elgg_echo('groups:access:private'), ACCESS_PUBLIC => elgg_echo('groups:access:public')))); ?>
		</label>
	</p>
	<?php

	if (get_plugin_setting('hidden_groups', 'groups') == 'yes')
	{
?>

	<p>
		<label>
			<?php echo elgg_echo('groups:visibility'); ?><br />
			<?php

			$this_owner = $vars['entity']->owner_guid;
			if (!$this_owner) $this_owner = get_loggedin_userid();

			$access = array(ACCESS_FRIENDS => elgg_echo("access:friends:label"), 1 => elgg_echo("LOGGED_IN"), 2 => elgg_echo("PUBLIC"));
			$collections = get_user_access_collections($this_owner);
			if (is_array($collections))
			{
				foreach ($collections as $c)
					$access[$c->id] = $c->name;
			}

			echo elgg_view('input/access', array('internalname' => 'vis', 'value' =>  ($vars['entity']->access_id ? $vars['entity']->access_id : ACCESS_PUBLIC), 'options' => $access));


			?>
		</label>
	</p>

<?php
	}

	?>

    <?php
		if (isset($vars['config']->group_tool_options)) {
			foreach($vars['config']->group_tool_options as $group_option) {
				$group_option_toggle_name = $group_option->name."_enable";
				if ($group_option->default_on) {
					$group_option_default_value = 'yes';
				} else {
					$group_option_default_value = 'no';
				}
				if(get_plugin_setting($group_option_toggle_name,"groupextended")=="no") continue;
?>
    <p>
			<label>
				<?php echo $group_option->label; ?><br />
				<?php

					echo elgg_view("input/radio",array(
									"internalname" => $group_option_toggle_name,
									"value" => $vars['entity']->$group_option_toggle_name ? $vars['entity']->$group_option_toggle_name : $group_option_default_value,
									'options' => array(
														elgg_echo('groups:yes') => 'yes',
														elgg_echo('groups:no') => 'no',
													   ),
													));
				?>
			</label>
	</p>
	<?php
		}
	}
	?>
	<p>
		<?php
			if ($vars['entity'])
			{
			?><input type="hidden" name="group_guid" value="<?php echo $vars['entity']->getGUID(); ?>" /><?php
			}
		?>
		<input type="hidden" name="user_guid" value="<?php echo page_owner_entity()->guid; ?>" />
		<input type="submit" class="submit_button" value="<?php echo elgg_echo("save"); ?>" />
	</p>

</form>
</div>

<div class="contentWrapper">
<div id="delete_group_option">
	<form action="<?php echo $vars['url'] . "action/groups/delete"; ?>">
		<?php
			if ($vars['entity'])
			{
				$warning = elgg_echo("groups:deletewarning");
			?>
			<input type="hidden" name="group_guid" value="<?php echo $vars['entity']->getGUID(); ?>" />
			<input type="submit" name="delete" value="<?php echo elgg_echo('groups:delete'); ?>" onclick="javascript:return confirm('<?php echo $warning; ?>')"/><?php
			}
		?>
	</form>
</div><div class="clearfloat"></div>
</div>

