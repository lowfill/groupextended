<?php
/**
 * Invite friends form
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
<form action="<?php echo $vars['url']; ?>action/groups/addtogroup" method="post">
	<?php
	if ($friends_ = get_entities_from_relationship('friend',$_SESSION['guid'],false,'user','',0,'',9999)) {
	  $friends = array();
	  foreach($friends_ as $friend){
	    if(!$group->isMember($friend)){
	      $friends[]=$friend;
	    }
	  }
	  echo elgg_view('friends/picker',array('entities' => $friends, 'internalname' => 'user_guid','highlight' => 'all'));
	}
	?> 
	<input type="hidden" name="forward_url" value="<?php echo $forward_url; ?>" /> 
	<input type="hidden" name="group_guid" value="<?php echo $group->guid; ?>" /> 
	<input type="submit" value="<?php echo elgg_echo('invite'); ?>" />
</form>
