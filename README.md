Defer JS
========
This add-on **moves javascripts** in page output **to the bottom of the page**.
This has a noticeable impact on page-load times as pending HTTP requests
postpone rendering of a page, while scripts aren't run until everything is
loaded anyways.

-------------------------------------------------------------------------------

Usage
-----
1. Upload the add-on to your XenForo installation
2. Install the add-on XML via the Administration Control Panel

**If you have any scripts in IE conditionals, you must blacklist them!**

License
-------
For the full copyright and license information, please view the LICENSE file
that was distributed with this source code.
