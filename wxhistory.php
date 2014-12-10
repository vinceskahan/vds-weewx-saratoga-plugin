<?php
############################################################################
# A Project of TNET Services, Inc. and Saratoga-Weather.org (WD-Canada/World-ML template set)
############################################################################
#
#   Project:    Sample Included Website Design
#   Module:     sample.php
#   Purpose:    Sample Page
#   Authors:    Kevin W. Reed <kreed@tnet.com>
#               TNET Services, Inc.
#
#         Copyright:        (c) 1992-2007 Copyright TNET Services, Inc.
############################################################################
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA
############################################################################
#        This document uses Tab 4 Settings
############################################################################
require_once("Settings.php");
require_once("common.php");
############################################################################
$TITLE = langtransstr($SITE['organ']) . " - " .langtransstr('Daily / Monthly Weather History From This Station');
$showGizmo = true;  // set to false to exclude the gizmo
include("top.php");
############################################################################
?>
<!-- mchallis begin added for toggle 24 Hour Daily Chart images -->
<script type="text/javascript" language="JavaScript">
function toggleDisplay(imgID) {
   if(document.getElementById(imgID).style.display == "none" ) {
            document.getElementById(imgID).style.display = "";
   } else {
            document.getElementById(imgID).style.display = "none";
   }
}
</script>
<!-- mchallis end added for toggle 24 Hour Daily Chart images -->
</head>
<body>
<?php
############################################################################
include("header.php");
############################################################################
include("menubar.php");
############################################################################
?>
<!-- begin of javascript 'go to top' arrow -->

<div id="floatdiv" class="jsupoutline">
    <a href="#header" title="Goto Top of Page" class="jsuparrow">
    <img src="<?php echo $SITE['imagesDir']; ?>toparrow.gif" alt="^^" 
	style="border: 0px;" /></a>

</div>
<script src="floatTop.js" type="text/javascript"></script>

<!-- end of javascript 'go to top' arrow -->

<div id="main-copy">

<h3><?php langtrans('Daily / Monthly Weather History From This Station'); ?></h3>
<br />

<?php
/*

This is a custom version by Mike Challis
http://www.642weather.com/weather/scripts.php
it requires include-wxhistory.php that I slightly modified
it is based on AvgExtract.php by Kevin W. Reed
TNET Services, Inc.
Thanks to Kevin at TNET Weather for sharing the PHP Code used for displaying the reports.

This script will make a list and display the Weather Display Daily / Monthly Report files from a
directory on your web server.

It looks for and compiles a list of all the Weather Display Daily / Monthly Report files:
It also checks to be sure the files are really there, if one is missing, it will be skipped
October2007.htm
November2007.htm
December2007.htm

Note: make sure your Weather Display program is set to upload the Avg/Extremes files and time stamped daily graphs!

*/

// #######################
// # Begin settings
// #######################

# enter 4 digit year of your oldest report on your server - example: 2006
#$startyear = 2000;

# Location of where the data files are located.
# You may need to change this and it must end with a slash.
# ./ is used if the files are in the same folder as your page with the dropdown list
#$webdir = './';

# Location of where the graph files are located. 20061205.gif
# You may need to change this and it must end with a slash.
# ./ is used if the files are in the same folder as your whhistory.php page
#$wxh_graphs_path = './';

// #######################
// # End settings
// #######################

// overrides from Settings.php if available
global $SITE;
if (isset($SITE['HistoryStartYear']))   {$startyear = $SITE['HistoryStartYear'];}
if (isset($SITE['HistoryFilesDir'])) 	{$webdir = $SITE['HistoryFilesDir'];}
if (isset($SITE['HistoryGraphsDir'])) 	{$wxh_graphs_path = $SITE['HistoryGraphsDir'];}  
// end of overrides from Settings.php

if(!isset($startyear) or !isset($webdir) or !isset($wxh_graphs_path)) {
	print "<h2>This page is not currently configured, and is only available with Weather-Display.</h2>\n";
	
} else { // do the page


  require_once('include-wxhistory.php');
?>

<form action="" method="get">
        <fieldset>
                <legend><?php langtrans('Select a report and click submit'); ?>:</legend>
                <select name="date">
<?php
global $datefile;
global $SITE, $LANGLOOKUP;
$datefile = getmonthfiles();
?>
                </select>
                <input type="submit" value="<?php langtrans('submit'); ?>" />
        </fieldset>
</form>

<noscript>
<p>Javascript must be enabled to view the 24 Hour Graph images.</p>
</noscript>

<?php
// Call the scripts display_data with the datefile we want...
display_data($datefile);

} // end of do the page
?>


</div><!-- end main-copy -->

<?php
############################################################################
include("footer.php");
############################################################################
# End of Page
############################################################################

/*
Drop Down List Generator Plugin PHP Script by Mike Challis

This function will make a list of Monthly WD Report files from a
directory on your web server.

it looks for and compiles a list of all the monthly Monthly WD Report files:
it also checks to be sure the files are really there, if one is missing, it will be skipped
October2007.htm
November2007.htm
December2007.htm

It will output the drop down select html for the monthly files found on your server.
The output will be html code like this:

<option value="200712">December 2007</option>
<option value="200711">November 2007</option>
<option value="200710">October 2007</option>

################
# Suggested use:
# ##############

You need Monthly WD Report files from Weather Display Software,
and they must be located on your web server
http://www.weather-display.com/index.php

Live Demo:
http://www.642weather.com/weather/monthly-stats.php
http://www.642weather.com/weather/scripts-list-generator.php

*/

function getmonthfiles() {
 global $startyear, $webdir, $SITE, $LANGLOOKUP;

 # find out how many years do we need to list files for
 $thisyear  = date('Y');
 $yearcount = $thisyear - $startyear;

 # Saftey setting incase some goofy year is entered like 200 for $startyear setting
 # only allows 20 years in the past maximum.
 if($yearcount > 20) $yearcount = 20;

 $yearsarray = array();
 for ($num=0; $num <= $yearcount; $num++ ) {
      $yearsarray[]=$thisyear;
      $thisyear--;
 }

 $monthsarray = array('12' => 'December','11' => 'November','10' => 'October','09' => 'September','08' => 'August','07' => 'July',
 '06' => 'June','05' => 'May','04' => 'April','03' => 'March','02' => 'February','01' => 'January');

  if (isset($SITE['langMonths'])) {
	  foreach (array('January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December') as $i => $english) {
	    $LANGLOOKUP[$english] = $SITE['langMonths'][$i];
	  }
	  echo "<!-- loaded langMonths to LANGLOOKUP -->\n";
  }

 # $datestring is used to keep the dropdown properly selected
 # see if it is there and 6 digits only
 # make sure a month selected exists
 # input sanity (allow only 6 digits for date query, nothing else)
 $defaultdatefound=0;
 $datestring ='';
 $selected = '';
 if ( isset($_GET['date'] ) && preg_match("/^[0-9]{6}$/", $_GET['date']) ) {
    if (is_file($webdir.$monthsarray[substr($_GET['date'],4,2)].substr($_GET['date'],0,4).'.htm')) {
       $datestring = $_GET['date'];
       $defaultdatefound=1;
    }
 }

  # this part properly sorts the files for the dropdown
  # start with this year and work back
  $count = 1;
  foreach ($yearsarray as $yk => $yv) {
       # start with December and work towards January for each year we are working with
       foreach ($monthsarray as $mk => $mv) {
              # only files FOUND on the server are included
              if(is_file("$webdir$mv$yv.htm")){
                # make the default month, the first one we actually have found
                # prevents January of a new year not found on Jan 1 because the file was not uploaded
                if ($count ==1) $firstdatestring = "$yv$mk";
                if ($datestring == "$yv$mk")  $selected = ' selected="selected"';
                echo '<option value="'.$yv.$mk.'"'.$selected.'>'.langtransstr($mv).' '.$yv.'</option>'."\n";
                $selected = '';
                $count++;
              }
       }
  }
    # make the default month, the first one we actually have found
   if (!$defaultdatefound) $datestring = $firstdatestring;
   return $datestring;
}

?>