<?php
/**
 * Elgg members administration view
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
gatekeeper();

$group_guid = (int) get_input('group_guid');
$group = get_entity($group_guid);
set_page_owner($group_guid);

$title = elgg_echo("groupextended:members:admin");

$area2 = elgg_view_title($title);

if (($group) && ($group->canEdit())){
  $area2 .= elgg_view("forms/groups/membersadmin", array('entity' => $group));

} else {
  $area2 .= elgg_echo("groups:noaccess");
}

$body = elgg_view_layout('two_column_left_sidebar', $area1, $area2);

page_draw($title, $body);
?>