<?php
/**
 * Elgg groups invite view. Overwrites groups/views/default/forms/invite.php
 *
 * Overwrites groups/views/default/forms/invite.php to add support people and groups invitations
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */

$group = $vars['entity'];
$owner = get_entity($vars['entity']->owner_guid);
$forward_url = $group->getURL();


?>
<div class="contentWrapper">
<h2><?php echo sprintf(elgg_echo('groups:inviteto'), $group->name); ?></h2>
<div id="groupextended-invite">
<ul>
	<li><a href="#invite-friends"><?php echo elgg_echo('groups:invite');?></a></li>

	<?php if(get_plugin_setting("invitegroups","groupextended")=="yes"){?>
	<li><a href="#invite-groups"><?php echo elgg_echo('groupextended:invite:groups');?></a></li>
	<?php }?>

	<!-- @todo Add support for this later -->
	<!-- <li><a href="#invite-external"><?php //echo elgg_echo('groupextended:invite:external');?></a></li>-->
</ul>
<div id="invite-friends"><?php echo elgg_view("forms/groups/invitefriends",array("entity"=>$group));?>
</div>

	<?php if(get_plugin_setting("invitegroups","groupextended")=="yes"){?>
<div id="invite-groups"><?php echo elgg_view("forms/groups/invitegroups",array("entity"=>$group));?>
</div>
	<?php }?> <!--
  <div id="invite-external">
  	<?php //echo elgg_view("forms/groups/inviteexternal",array("entity"=>$group));?>
  </div>
  --></div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery("#groupextended-invite > ul").tabs();
});

</script>
