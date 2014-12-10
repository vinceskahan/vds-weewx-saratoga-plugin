This directory contains the tag file to upload through Weather-Display.

Note: The name 'testtags.php' has been kept for historical reasons,
   even though the name rightly should be WDtags instead of testtags .. but a lot of WD folks using
   the existing WD/PHP/AJAX template sets are used to calling it testtags, so we'll keep it for now.


The testtags.txt file should be placed in the c:\wdisplay\webfiles directory and set to upload
every 5 minutes as testtags.php.  Fortunately, for recent versions of Weather-Display, Brian has
added an express setup to do this:

Weather-Display, Control Panel, Web Files/Web Page, Web Files Setup#1 TAB 

which has in the Web Table/HTML section an option to do this automatically:

Tick:  'Create and upload testtags.txt as testtags.php'

Press OK to save the settings.
Press OK to close the Control Panel.

 Then you can view the uploaded tags on your website as:

   testtags.php?sce=view  (see the raw source after processing by WD)

----------------------------------------------------------------------------------------
Old method using the Custom File upload if your WD doesn't have the option above


Use the Weather-Display Control Panel, 
Web Files/Web Page/Real Time FTP/WDL, 
Custom Web Page Setup TAB

In the 'Special file conversion' area

put:  testtags.txt       in Local File 1 (or 2 or 3)
      testtags.php       in Remote file name 1 (or 2 or 3 to match where testags.txt is placed)

Turn the switch to ON

Press Test

Press OK to save the settings.

You may also need to set an upload time schedule in 
Weather-Display, Control Panel, Internet File Creation & Uploads, Setup Page#2 TAB

file#29 (Special custom file conversion)

to make the uploads work.

 




