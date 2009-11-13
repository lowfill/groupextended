<?php
/**
 * Members administration view
 *
 * Currently only let you remove group members
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */

$group = $vars['entity'];
$forward_url = $group->getURL();
//@todo For groups with to many members provide a search function

?>
<div class="contentWrapper">
<h2><?php echo sprintf(elgg_echo('groups:members'), $group->name); ?></h2>
<form action="<?php echo $vars['url']; ?>action/groups/editmembers" method="post">
	<?php
	if(get_plugin_setting("invitegroups","groupextended")=="yes"){
	  $members_ = get_entities_from_relationship('member', $vars['entity']->getGUID(), true, '', '', 0, "", 100);
	}
	else{
	  $members_ = $vars['entity']->getMembers(100);
	}
	$members = array();
	foreach($members_ as $member){
	  if($member->getGUID() != $vars['entity']->owner_guid){
	    $members[]=$member;
	  }
	}

	if (!empty($members)){
	  echo elgg_view('friends/picker',array('entities' => $members, 'internalname' => 'user_guid','highlight' => 'all'));
	}

	?>
	<input type="hidden" name="forward_url" value="<?php echo $forward_url; ?>" />
	<input type="hidden" name="group_guid" value="<?php echo $group->guid; ?>" />
	<input type="submit" value="<?php echo elgg_echo('groupextended:remove'); ?>" />
</form>
</div>