<?php
/**
 * Add a user to a group
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
if (!is_array($user_guid)){
  $user_guid = array($user_guid);
}
$group_guid = get_input('group_guid');

if (sizeof($user_guid)){
  foreach ($user_guid as $u_id){
    $user = get_entity($u_id);
    $group = get_entity($group_guid);
     
    if ( $user && $group) {
      if (get_loggedin_userid() == $group->owner_guid){
        // If the group is open or the user has requested membership
        if ((check_entity_relationship($user->guid, 'membership_request', $group->guid)) || ($group->isPublicMembership())){
            // Remove relationships
            remove_entity_relationship($group->guid, 'invited', $user->guid);
            remove_entity_relationship($user->guid, 'membership_request', $group->guid);

            add_entity_relationship($user->guid, 'member', $group->guid);
             
            // send welcome email
            notify_user($user->getGUID(), $group->owner_guid,
            sprintf(elgg_echo('groups:welcome:subject'), $group->name),
            sprintf(elgg_echo('groups:welcome:body'), $user->name, $group->name, $group->getURL()),
            NULL);

            system_message(elgg_echo('groups:addedtogroup'));
        }
        else{
            // Create relationship
            add_entity_relationship($group->guid, 'invited', $user->guid);
            add_entity_relationship($user->guid, 'membership_request', $group->guid);
            // Send email
          $group_invite_owner_name = $user->getOwnerEntity()->name;
          $group_invited_name = $user->name;
            if (notify_user($user->getOwnerEntity()->getGUID(), $group->owner_guid,
            sprintf(elgg_echo('groupextended:invite:subject'), $user->name, $group->name),
            sprintf(elgg_echo('groupextended:invite:body'), $group_invite_owner_name ,$group_invited_name, $group->name, "{$CONFIG->url}action/groups/joingroup?user_guid={$user->guid}&group_guid={$group->guid}"),
            NULL)){
              system_message(elgg_echo("groups:userinvited"));
            }
            else{
              register_error(elgg_echo("groups:usernotinvited"));
            }
        }
      }
      else{
        register_error(elgg_echo("groups:notowner"));
      }
    }
  }
}

forward($_SERVER['HTTP_REFERER']);
?>