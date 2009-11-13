<?php
/**
 * Elgg groupextended plugin's group listing view.
 *
 * Overwrites groups/views/default/groups/grouplisting.php to show up the group type
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */

	$icon = elgg_view(
			"groups/icon", array(
									'entity' => $vars['entity'],
									'size' => 'small',
								  )
		);
		
	//get the membership type
	$membership = $vars['entity']->membership;
	if($membership == 2)
		$mem = elgg_echo("groups:open");
	else
		$mem = elgg_echo("groups:closed");
		
	//for admins display the feature or unfeature option
	if($vars['entity']->featured_group == "yes"){
		$url = $vars['url'] . "action/groups/featured?group_guid=" . $vars['entity']->guid . "&action=unfeature";
		$wording = elgg_echo("groups:makeunfeatured");
	}else{
		$url = $vars['url'] . "action/groups/featured?group_guid=" . $vars['entity']->guid . "&action=feature";
		$wording = elgg_echo("groups:makefeatured");
	}
		
	$info .= "<div class=\"groupdetails\"><p>" . $mem . " / <b>" . get_group_members($vars['entity']->guid, 10, 0, 0, true) ."</b> " . elgg_echo("groups:member") . "</p>";
	//if admin, show make featured option
	if(isadminloggedin())
		$info .= "<p><a href=\"{$url}\">{$wording}</a></p>";
	$info .= "</div>";
	$info .= "<p><b><a href=\"" . $vars['entity']->getUrl() . "\">" . $vars['entity']->name . "</a></b></p>";
error_log("Alog!!!".$vars['entity']->group_type);
	$info .= "<p class=\"owner_timestamp\">".elgg_view('output/tags', array('tags' => elgg_echo($vars['entity']->group_type),'object'=>'group'))."</p>";
	$info .= "<p class=\"owner_timestamp\">" . $vars['entity']->briefdescription . "</p>";

	// num users, last activity, owner etc

echo elgg_view_listing($icon, $info);

?>