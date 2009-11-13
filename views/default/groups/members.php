<?php
/**
 * Elgg groupextended members view
 *
 * Just make the default icon size bigger
 * 
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */
	 
	 //var_export($vars['entity']);
?>

<div id="group_members">
<h2><?php echo elgg_echo("groups:members"); ?></h2>

<?php

    if(get_plugin_setting("invitegroups","groupextended")=="yes"){
      $members = get_entities_from_relationship('member', $vars['entity']->getGUID(), true, '', '', 0, "", 100);
    }
    else{
      $members = $vars['entity']->getMembers(100);
    }

    foreach($members as $mem){
           
        echo "<div class=\"member_icon\">" . elgg_view("profile/icon",array('entity' => $mem, 'size' => 'tiny')) . "</div>";   
           
    }
    
?>
<br class="clearfloat" />
</div>