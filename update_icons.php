<?php
/**
 * Utility script for regenerate the icon files of groups
 *
 * @package ElggGroupExtended
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2009
 * @link http://www.somosmas.org
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

set_time_limit(0);
ini_set('memory_limit', '1024M');
$groups = get_entities("group","",0,"",null);
if(!empty($groups)){
  $squareicon = get_plugin_setting("squareicon","groupextended");
  foreach($groups as $group){
    $prefix = "groups/".$group->getGUID();


    $filehandler = new ElggFile();
    $filehandler->owner_guid = $group->owner_guid;
    $filehandler->setFilename($prefix . ".jpg");

    $squareicon = ($squareicon=="yes");

    echo "<br>Updating icons from ({$filehandler->getFilenameOnFilestore()})\n";

    $thumbtiny = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),25,25, $squareicon);
    $thumbsmall = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),40,40, $squareicon);
    $thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),100,100, $squareicon);

    if ($thumbtiny) {

      $thumb = new ElggFile();
      $thumb->owner_guid = $group->owner_guid;
      $thumb->setMimeType('image/jpeg');

      $thumb->setFilename($prefix."tiny.jpg");
      $thumb->open("write");
      $thumb->write($thumbtiny);
      $thumb->close();
      echo ".";

      $thumb->setFilename($prefix."small.jpg");
      $thumb->open("write");
      $thumb->write($thumbsmall);
      $thumb->close();
      echo ".";

      $thumb->setFilename($prefix."medium.jpg");
      $thumb->open("write");
      $thumb->write($thumbmedium);
      $thumb->close();
      echo ".";
    }
  }
}
?>
