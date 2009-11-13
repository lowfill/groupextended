<?php
/**
 * Elgg groupextended plugin's networks list
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

$limit = get_input("limit", 7);
$offset = get_input("offset", 0);
$tag = get_input("tag");


// Get objects
$context = get_context();

set_context('search');
if ($tag != ""){
  $objects = list_entities_from_metadata('tags',$tag,'group',"","", $limit, false);
}else{
// @todo Hacer eso mas descente en un funcion
  $values = array("groupextended:type:network",
                  "groupextended:type:group");

  $where = array();
  $where2 = array();

  $mindex = 1;
  $join = "";
  $meta_name="group_type";
  $join .= " JOIN {$CONFIG->dbprefix}metadata m{$mindex} on e.guid = m{$mindex}.entity_guid ";
  $meta_n = get_metastring_id($meta_name);
  if ($meta_name!="")
  $where2[] = "m{$mindex}.name_id='$meta_n'";
  foreach($values as $meta_value) {
    $meta_v = get_metastring_id($meta_value);
    if ($meta_value!="")
    $where[] = "'$meta_v'";
  }
  $entity_type = sanitise_string("group");
  if ($order_by == "") $order_by = "e.time_created desc";
  $order_by = sanitise_string($order_by);
  $site_guid = (int) $site_guid;
  if ($site_guid == 0){
    $site_guid = $CONFIG->site_guid;
  }
  $where2[] = "e.type = '{$entity_type}'";
  $where2[] = "e.site_guid = {$site_guid}";
  $query = "SELECT distinct e.* ";
  $query .= " from {$CONFIG->dbprefix}entities e {$join} where";
  $query.=" m{$mindex}.value_id in (".implode(",",$where).") and ";
  foreach ($where2 as $w){
    $query .= " $w and ";
  }
  $query .= get_access_sql_suffix("e"); // Add access controls
  $query .= ' and ' . get_access_sql_suffix("e"); // Add access controls
  if ($count = get_data_row($query)) {
    $count = $count->total;
  }
  $query .= " order by $order_by limit $offset, $limit"; // Add order and limit
  /*return get_data($query, "entity_row_to_elggstar");*/
  $objects = get_data($query, "entity_row_to_elggstar");

  $objects=elgg_view_entity_list($objects, $count, $offset, $limit, false, true, true);
  //$objects = list_entities_from_metadata_multi($values,'group',"","", $limit, $offset);
}
set_context($context);

$title = sprintf(elgg_echo("networks:all"),page_owner_entity()->name);
$area2 = elgg_view_title($title);
$area2 .= $objects;
$body = elgg_view_layout('two_column_left_sidebar',$area1, $area2);

// Finally draw the page
page_draw($title, $body);



?>