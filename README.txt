Groups extended plugin
=======================

This plugin provides the following features:
  - Extra type
  - Members management
  - Groups as members (aka subgroups)
  - Global feature enable/disable (forums, pages, files)
  - Handle group icon with the proportional resize against square icons.

Install
-------

Just drop it on your mod directory and then go to the admin panel and activate it. 

Take on mind that this plugins overwrites some groups plugins behaviors so it need 
to be loaded after it.


How to extend modify it?
------------------------

If you want to change the defaul group types provided here you only need to modify it
inside the 'groupextended_fields' function.

For add the proper listing pages you only needs to add a proper page handler.
Take a look of 'organizations.php' and 'networks.php' for examples.

How to regenerate non square icons from existing ones?
------------------------------------------------------
Login with an user with administration privileges an then run the script
  http://yourhost/mod/groupextended/update_icons.php

