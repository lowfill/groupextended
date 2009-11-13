<?php
/**
 * Elgg groupextended latest forums view. Overwrites groups/forum_latest.php
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2008
 * @link http://www.somosmas.org
 */
if(get_plugin_setting("forum_enable","groupextended")=="yes" && $vars['entity']->forum_enable == 'yes'){

?>

<div class="contentWrapper">
<h2><?php echo elgg_echo('groups:latestdiscussion'); ?></h2>
<?php

    $forum = get_entities_from_annotations("object", "groupforumtopic", "group_topic_post", "", 0, $vars['entity']->guid, 4, 0, "desc", false);

    if($forum){
        foreach($forum as $f){

                $count_annotations = $f->countAnnotations("group_topic_post");

        	    echo "<div class=\"forum_latest\">";
        	    echo "<div class=\"topic_owner_icon\">" . elgg_view('profile/icon',array('entity' => $f->getOwnerEntity(), 'size' => 'tiny', 'override' => true)) . "</div>";
    	        echo "<div class=\"topic_title\"><p><a href=\"{$vars['url']}mod/groups/topicposts.php?topic={$f->guid}&group_guid={$vars['entity']->guid}\">" . $f->title . "</a></p> <p class=\"topic_replies\"><small>".elgg_echo('groups:posts').": " . $count_annotations . "</small></p></div>";

    	        echo "</div>";

        }
    } else {
		echo "<div class=\"forum_latest\">";
		echo elgg_echo("grouptopic:notcreated");
		echo "</div>";
    }
?>
<br class="clearfloat" />
</div>
<?php
	}//end of forum active check
?>