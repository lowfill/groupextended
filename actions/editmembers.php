<?php
/**
 * Group members management
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

$forward_url = get_input('forward_url', $_SERVER['HTTP_REFERER']);
$user_guid = get_input('user_guid');
if (!is_array($user_guid)){
  $user_guid = array($user_guid);
}
$group_guid = get_input('group_guid');

if (sizeof($user_guid)){
  $group = get_entity($group_guid);
  foreach ($user_guid as $u_id){
    $requested = false;
    $user = get_entity($u_id);
    if ($group instanceof ElggGroup){
      if ($group->getOwner() == $_SESSION['guid']) {
        if (leave_group($group->getGUID(),$user->getGUID())){
          system_message(sprintf(elgg_echo("groupextended:left"),$user->get("name"),$group->name));
        }
        else{
          register_error(sprintf(elgg_echo("groupextended:cantleave"),$user->name,$group->name));
        }
      } else {
        register_error(elgg_echo("groups:cantleave"));
      }
    }
    else{
      register_error(elgg_echo("groups:cantleave"));
    }
  }
}

forward($forward_url);
?>