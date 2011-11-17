<?php
/**
 * Give Admin view
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Daniel Aristizabal Romero <daniel@somosmas.org>
 * @copyright Corporación Somos más - 2009
 * @link http://www.somosmas.org
 */

$group = $vars['entity'];
$forward_url = $group->getURL();

$members_ = $group->getMembers();

$members = array();

foreach($members_ as $member) {
    // Check not index de Owner
    if ($member->getGUID() != $group->owner_guid) {
        $members[$member->getGUID()] = $member->name;
    }
}


?>
<div class="contentWrapper">
<h2><?php echo sprintf(elgg_echo('groups:members'), $group->name); ?></h2>
<form action="<?php echo $vars['url']; ?>action/groups/giveadmin" method="post">
<?php echo elgg_view('input/securitytoken');?>
<p>
    <?php echo elgg_view('input/pulldown', array(
        'internalname' => 'user_guid',
        'options_values' => $members)); ?>
</p>

<input type="hidden" name="forward_url" value="<?php echo $forward_url; ?>" />
<input type="hidden" name="group_guid" value="<?php echo $group->guid; ?>" />
<input type="submit" onclick="javascript:return confirm('<?php echo elgg_echo('groupextended:confirgive'); ?>')" value="<?php echo elgg_echo('groupextended:giveadmin'); ?>" />
</form>
</div>
