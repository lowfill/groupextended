<?php
/**
 * Join a group action.
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */

// Load configuration
global $CONFIG;

gatekeeper();

$user_guid = get_input('user_guid');
$group_guid = get_input('group_guid');

$user = NULL;
if (!$user_guid) $user = $_SESSION['user'];
else
$user = get_entity($user_guid);

$group = get_entity($group_guid);

if (($user instanceof ElggGroup) && ($group instanceof ElggGroup)){
  if (check_entity_relationship($user->guid, 'membership_request', $group->guid) || $group->isPublicMembership()){
    if (join_group($group->getGUID(), $user->getGUID())){
      system_message(elgg_echo("groups:joined"));

      // Remove any invite or join request flags
      remove_metadata($user->guid, 'group_invite', $group->guid);
      remove_metadata($user->guid, 'group_join_request', $group->guid);

      forward($group->getURL());
      exit;
    }
    else{
      register_error(elgg_echo("groups:cantjoin"));
    }
  }
  else{
    // Closed group, request membership
    register_error(elgg_echo("groupextended:group:cantjoin"));
    forward($_SERVER['HTTP_REFERER']);
    exit;
  }
}
else{
  register_error(elgg_echo("groups:cantjoin"));
}
forward($_SERVER['HTTP_REFERER']);
exit;
?>