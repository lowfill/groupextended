<?php
/**
 * Give Admin Action
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Daniel Aristizabal Romero <daniel@somosmas.org>
 * @copyright Corporación Somos más - 2009
 * @link http://www.somosmas.org
 */

// Load configuration
global $CONFIG;

gatekeeper();

$forward_url = get_input('forward_url', $_SERVER['HTTP_REFERER']);
$user_guid = get_input('user_guid');
$group_guid = get_input('group_guid');

$group = get_entity($group_guid);
$user = get_entity($user_guid);

if ($group instanceof ElggGroup && $user instanceof ElggUser) {
    $former_owner = $group->getOwner();
    if ($group->getOwner() == $_SESSION['guid']) {
        $group->owner_guid = $user_guid;
        $group->container_guid = $user_guid;

        // Code for Copy image of Group
        // Call for default image
        groupextended_gen_images_for_group($former_owner, $user_guid, $group->getGUID());
        // Call for large image
        groupextended_gen_images_for_group($former_owner, $user_guid, $group->getGUID(), 'large');
        // Call for medium image
        groupextended_gen_images_for_group($former_owner, $user_guid, $group->getGUID(), 'medium');
        // Call for small image
        groupextended_gen_images_for_group($former_owner, $user_guid, $group->getGUID(), 'small');
        // Call for tiny image
        groupextended_gen_images_for_group($former_owner, $user_guid, $group->getGUID(), 'tiny');


        if ($group->save()) {
            system_message(sprintf(elgg_echo("groupextended:newadmin"), $user->get('name'), $group->name));
        } else {
            register_error(elgg_echo("groupextended:cantnewadmin"));
        }
    } else  {
        register_error(elgg_echo("groupextended:cantnewadmin"));
    }
} else {
    register_error(elgg_echo("groupextended:cantnewadmin"));
}

forward($forward_url);
?>
