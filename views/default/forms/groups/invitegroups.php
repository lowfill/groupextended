<?php
/**
 * Invite groups form
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

//@todo Change this for a search approach for sites with too much groups available

?>
<form action="<?php echo $vars['url']; ?>action/groups/addtogroup-group" method="post">
	<?php
	if ($groups_ = get_entities("group","",0,"",null,0, false)) {
	  $groups = array();
	  foreach($groups_ as $group_){
	    if($group->getGUID() != $group_->getGUID() && !is_group_member($group->getGUID(), $group_->getGUID())){
	      $groups[] = $group_;
	    }
	  }
	  echo elgg_view('friends/picker',array('entities' => $groups, 'internalname' => 'user_guid','highlight' => 'all'));
	}

	?> 
	<input type="hidden" name="forward_url" value="<?php echo $forward_url; ?>" /> 
	<input type="hidden" name="group_guid" value="<?php echo $group->guid; ?>" /> 
	<input type="submit" value="<?php echo elgg_echo('invite'); ?>" />
</form>
