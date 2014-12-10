<?php

// This is a custom version by Mike Challis
// http://www.642weather.com/weather/scripts.php
// AvgExtract.php has been modified into this include-wxhistory.php - Mulitlingual Version

# mchallis Version 1.01 04/04/08 Fixed some display issues caused by new WD 10.37j-01 version
# mchallis Version 1.02 04/06/08 Fixed some display issues caused by new WD 10.37j-01 version
# mchallis Version 1.03 04/08/08 Added support for rain totals in mm
# mchallis Version 1.04 04/21/08 added 'Frost days' support
# ktrue    Version 1.05 30-Jun-2008 -- adapted for WD-World-ML template multilanguage use
# mchallis Version 1.06 10/27/09 added $wxh_graphs_path setting to enable custom graphs image directory
#            - fixed one issue on PHP 5.3
# ktrue    Version 1.07 11/24/10 added WD10.37Q support+ avg daily min/max monthly display
# mconnaroe Version 1.08 12/19/10 added support for Special Weather report in output
# ktrue     Version 1.09 11-Jul-2011 - fixed Notice error when no UV sensor

# mchallis modified for style compatibility with my css theme switcher and to be used
# inside of a wxhistory.php page in a Weather Display/PHP/AJAX Website Template set
# http://saratoga-weather.org/template/
# mchallis added if is_file check and toggle image feature for 24 hour chart images
# also added other minor formatting changes

############################################################################
# A Project of TNET Services, Inc. - TNET Weather
############################################################################
#
#   Project:    Sample code to extract Daily Ave/Ext WD HTML Page
#   Module:     AvgExtract.php
#   Authors:    Kevin W. Reed <kreed@tnet.com>
#               TNET Services, Inc.
#
#   Copyright:  (c) 1992-2007 Copyright TNET Services, Inc.
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
// allow viewing of generated source

if ( isset($_REQUEST['sce']) && strtolower($_REQUEST['sce']) == 'view' ) {
//--self downloader --
   $filenameReal = __FILE__;
   $download_size = filesize($filenameReal);
   header('Pragma: public');
   header('Cache-Control: private');
   header('Cache-Control: no-cache, must-revalidate');
   header('Content-type: text/plain');
   header('Accept-Ranges: bytes');
   header("Content-Length: $download_size");
   header('Connection: close');
   
   readfile($filenameReal);
   exit;
}


//# mchallis override $website setting to use setting from $webdir setting in wxhistory.php
$website = $webdir;

if ( !isset($wxh_graphs_path) ) {
   $wxh_graphs_path = $webdir;
}

# Unless you are going to change the language, you most likely won't need
# to change anything below this section
############################################################################

$parts = array();
$extracts = array();
$LEVEL = 0;
$DAY = 0;

$month = '';
$monthnum = 0;
$yearnum = 0;

// Arrays to Format Things with
$level1 = array(
            array('Average temperature',3),
            array('Average humidity',3),
            array('Average dewpoint',3),
            array('Average barometer',3),
            array('Average windspeed',3),
            array('Average gustspeed',3),
            array('Average direction',3),
            array('Rainfall for month',4),
            array('Rainfall for year',4),
            array('Maximum rain per minute',5),
            array('Maximum temperature',4), # mchallis 04/04/08 (WD 10.37j-01 fix) changed 3 to 4
            array('Minimum temperature',4), # mchallis 04/04/08 (WD 10.37j-01 fix) changed 3 to 4
            array('Minimum pressure',3),
            array('Maximum pressure',3),
            array('Maximum windspeed',3),
            array('Maximum gust speed',4),
            array('Maximum humidity',4), # mchallis 04/06/08 (WD 10.37j-01 fix) changed 3 to 4
            array('Minimum humidity',3),
            array('Maximum heat index',4),
            array('Growing degrees days',5),
			array('Avg daily min temp',5), # ktrue added 'Avg daily min temp' support 24-Nov-2010
			array('Avg daily max temp',5), # ktrue added 'Avg daily max temp' support 24-Nov-2010
            array('Frost days',3), # mchallis added 'Frost days' support 04/21/08
            );

$level2 = array(
            array(',ET', 2),
            array('Sunshine hours month to date',6),
            array('Sunshine hours year to date',6),
            array('in. on day',0),
            array('in.  on day',0), # mchallis added 04/04/08 (WD 10.37j-01 fix)
            array('mm on day',0),  # mchallis added 04/08/08 support for rain in mm
            array('mm  on day',0), # mchallis added 04/08/08 support for rain in mm (WD 10.37j + fix)
            );

function display_data($date_to_process){
    global $website, $wxh_graphs_path, $SITE;
    global $level1, $level2, $LEVEL, $DAY, $month, $monthnum, $yearnum;

    $mnthname = array('January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December');

    # mchallis added
    $mnthnameshort = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
/*	if (isset($SITE['langMonths'])) {
	   print "<!-- loaded short month names -->\n";
       $mnthname = $SITE['langMonths'];  // load array for current language
	   foreach ($mnthname as $i => $name) {
	     $mnthname[$i] = substr($mnthname[$i],0,3);
	   }

    } */
    if ( strlen($date_to_process) == 0 ) {
        # defaults to this year month
        $date_to_process = date('Y') . date('m');
    }
    $monthnum = substr($date_to_process,4,2);
    $yearnum = substr($date_to_process,0,4);

    $datafile = $website . $mnthname[$monthnum -1 ] . $yearnum . ".htm";

    $fd = fopen($datafile,'r');

    $LEVEL = 0;
    $DAY = 0;
    $RAIN = 0;
    $even_odd = 0;
    $ignore = 0;
    $special_msg = '';

    if ($fd ) {
        while ( !feof($fd) ){
            $gotraw = fgets($fd,8192);
            $value = trim($gotraw);

            if ( preg_match("|Any Special weather conditions for the day:|i",$gotraw)) {  // Ignore special weather conditions
                $ignore = 1;                                                              // entered by users  
                $value = $gotraw = $special_msg = '';
            } else {
                if (($ignore == 1) AND preg_match("|<FONT COLOR|i",$gotraw)){
                    $ignore = 0;
                    $special_class = array('class="column-light"','class="column-dark"');
                    $special_class = $special_class[$DAY % 2];
                    echo '<tr><td colspan="2" ',$special_class,'>'.$special_msg.'</td></tr>';
                } else {
                    if ($ignore == 1){
                        if (!preg_match("|<img |i",$gotraw)){ 
                        $special_msg = $special_msg.$gotraw;
                        }
                    $value = $gotraw = '';
                    }
                }
            }

            if ($LEVEL == 0 ) {

                if ( preg_match("|Daily report for |i",$value)) {

                    # mchallis page title consistancy fix ....
                    # January2007.htm page title was "Daily Report for the month of January 2007"
                    # and January2008.htm page title was "Daily Report for the month of 01 2007"
#                     preg_match("/Daily report for (.*)\</U",$value,$found);
                      #$month = $found[1];
                      $month = $mnthname[$monthnum -1 ] . " $yearnum";
                      echo "<h1>".langtransstr('Daily Report for the month of') ." " . 
					    langtransstr($mnthname[$monthnum-1]) . " $yearnum</h1>\n";
                      $LEVEL = 1;
                }
            }

            if ($LEVEL == 1 ) {

                // Check for Day String
                if ( strpos ($value,"Extremes for day :") !== false ) {

                    // Must already have been processing a day so close table
                    if ( $DAY != 0 ) {
                        echo "</table>\n";

                          $this_img = $yearnum . $monthnum . $DAY;
                        # mchallis added if is_file check and image toggle feature
                        if (is_file("$wxh_graphs_path$this_img.gif")){
                         echo '
<p onclick="toggleDisplay(\'img_\' + '.$this_img.');">
'. langtransstr('Click here to toggle the 24 Hour Graph of this day') . '</p>
<img src="'. $wxh_graphs_path . $this_img .'.gif" id="img_'.$this_img .'" style="display: none" onclick="toggleDisplay(\'img_\' + '.$this_img.');" alt="24 Hour Graph for Day '.$DAY.'" title="24 Hour Graph for Day '.$DAY.'" />' . "\n";
                        } else {
                            echo langtransstr("24 Hour Graph of this day is not available") . " ($this_img.gif)<br/> <br/>" . "\n";
                        }

                    }
                    preg_match("/Extremes for day :(\d{1,2})\</",$value,$found);
                    $DAY = $found[1];

                  echo '<br /><br />
                    <table width="600" cellpadding="3" cellspacing="0" border="0">
                    <tr class="table-top">
                    <td colspan="2">'. intval($DAY). ' ' . langtransstr($mnthname[$monthnum -1 ]).' '.  langtransstr('Average and Extremes') . '</td>
                    </tr>
                    ';

                }

                // Check for Month Recap

                if ( strpos ($value, "Extremes for the month of ") !== false ) {
                    echo "</table>\n";

                        $this_img = $yearnum . $monthnum . $DAY;
                        # mchallis added if is_file check
                        if (is_file("$wxh_graphs_path$this_img.gif")){
                         echo '
<p onclick="toggleDisplay(\'img_\' + '.$this_img.');">
'. langtransstr('Click here to toggle the 24 Hour Graph of this day') . '</p>
<img src="'. $wxh_graphs_path . $this_img .'.gif" id="img_'.$this_img .'" style="display: none" onclick="toggleDisplay(\'img_\' + '.$this_img.');" alt="24 Hour Graph for Day '.$DAY.'" title="24 Hour Graph for Day '.$DAY.'" />' . "\n";

                        } else {
                            echo langtransstr("24 Hour Graph of this day is not available") . " ($this_img.gif)<br/> <br/>" . "\n";
                        }


                    echo '<br /><br />
                    <table width="600" cellpadding="3" cellspacing="0" border="0">
                    <tr class="table-top">
                    <td colspan="2">' . langtransstr('Average and Extremes for Month of') . ' ' . 
					langtransstr($mnthname[$monthnum -1 ]) . " $yearnum " . langtransstr('up to day') . ' ' . intval($DAY) . '</td>
                    </tr>
                    ';
                }

                // Check for Sunshine Hours

                #if ( strpos ($value, "Sunshine hours " ) !== false ) {
                if ( strpos ($value, "Sunshine" ) !== false ) { # mchallis 04/04/08 (WD 10.37j-01 fix)
                    echo "</table>\n";
                    # mchallis added 04/04/08 (WD 10.37j-01 fix) modified Day, Sunshine Hours title
                    echo '<br /><br />
                    <table width="600" cellpadding="3" cellspacing="0" border="0">
                    <tr class="table-top">
                    <td colspan="4">' . langtransstr('Day, Sunshine Hours, ET, Max Solar, UV') .'</td>
                    </tr>
                    ';
                    $LEVEL = 2;
                }

                // Check for Daily Rain Totals (in case there was no Sunshine)

                if ( strpos ($value, "Daily rain totals" ) !== false ) {
                    echo "</table>\n";

                    echo '<br /><br />
                    <table width="600" cellpadding="3" cellspacing="0" border="0">
                    <tr class="table-top">
                    <td colspan="2">'. langtransstr('Daily Rain Totals') . '</td>
                    </tr>
                    ';
                    $LEVEL = 2;
                    $RAIN = 1;
                }

                // Check for data lines
				# ktrue added 'Avg daily min/max temp' support 24-Nov-2010
				if(preg_match('|Avg daily \S+ temp :|is',$value)) {
					$value = preg_replace('|\:|','  =',$value);
				}
                output_data($value, $LEVEL);

            }

            if ($LEVEL == 2 ) {
                // Check for Daily Rain Totals (in case there was no Sunshine)

                if ( strpos ($value, "Daily rain totals" ) !== false  && ! $RAIN ) {
                    echo "</table>\n";

                    echo '<br /><br />
                    <table width="600" cellpadding="3" cellspacing="0" border="0">
                    <tr class="table-top">
                    <td colspan="2">' . langtransstr('Daily Rain Totals') . '</td>
                    </tr>
                    ';
                }

                if ( strpos (strtolower($value), "</body>" ) !== false ) {
                    echo "</table>\n";
                    $LEVEL = 3;
                }

                // Check for data lines
                output_data($value, $LEVEL);
            }

        }
    }
}

function output_data($invalue, $LEVEL ) {
    global $website, $even_odd;
    global $level1, $level2, $LEVEL, $DAY, $month, $monthnum, $yearnum;

    $row_class = '';
    $even_class = 'class="column-light"';
    $odd_class = 'class="column-dark"';

    // Remove ALL html tag info...
        $newval = preg_replace("'<[/!]*?[^<>]*?>'si","",$invalue);

    if ($LEVEL == 1 ) {

        foreach ($level1 as $key => $kvalue ) {
            if ( strpos ( strtolower($newval), strtolower($kvalue[0]) ) !== false ) {
                list ($left, $right ) = getparts($newval,$kvalue[1]);
                $left = preg_replace('/=/','',$left); # mchallis added 04/21/08
                $right = preg_replace('/=/','',$right); # mchallis added 04/04/08 (WD 10.37j-01 fix)
                # mjc added for testing
#                  if (preg_match("/Maximum gust speed/i",$left)){
#                      $left = "<b>$left</b>";
#                      $right = "<b>$right</b>";
#                  }
                 # eof

               if ($even_odd % 2){
                     $row_class = $odd_class;
               }
               else {
                     $row_class = $even_class;
               }
			    $right = preg_replace('/°/Uis','&deg;',$right);
				$right = preg_replace('/from/is',langtransstr('from'),$right);
				$right = preg_replace('/on day/is',langtransstr('on'),$right);
				$right = preg_replace('/at time/is',langtransstr('at'),$right);
				$right = preg_replace('/\((.+)\)/e',"'('.langtransstr(trim('\\1')).')'",$right);

               echo '<tr '.$row_class.'>
                <td>'. langtransstr($left) .'</td><td>' .$right ."</td>
                </tr>\n";
//                echo "<!-- right='$right' -->\n";
                $even_odd++;
            }

        }
    }

    if ($LEVEL == 2 ) {

            // Strip out = sign from line
            if (strpos($newval,'Sunshine hours ') !== false) {
                    $newval = preg_replace('/=/','',$newval);
            }

        foreach ($level2 as $key => $kvalue ) {
            if ( strpos ( strtolower($newval), strtolower($kvalue[0]) ) !== false ) {

               if ($even_odd % 2){
                     $row_class = $odd_class;
               }
               else {
                     $row_class = $even_class;
               }
               if (strpos($newval,',ET') !== false) {
                $sunshine_vals = explode(',', $newval.',,,,');
                echo '<tr '.$row_class.'>
                <td>'.$sunshine_vals[0] .'</td>
                <td>'.$sunshine_vals[1] .'</td>
                <td>'.$sunshine_vals[2] .'</td>
                <td>'.$sunshine_vals[3] ."</td>
                </tr>\n";
               }else if(strpos($newval,'Sunshine hours ') !== false){
			    preg_match('/(.*) ([\d|\.]+) (\S+)/is',$newval,$matches); // split up so we can do langtransstr()
				// print "<!-- matches \n" . print_r($matches,true) . " -->\n";
                echo '<tr '.$row_class.'>
                <td colspan="4">'.langtransstr($matches[1]) . ' ' . $matches[2] . ' ' . langtransstr($matches[3])  ."</td>
                </tr>\n";
               }
               else{
			    $newval = preg_replace('/on day/is',langtransstr('on'),$newval);
                echo '<tr '.$row_class.'>
                <td>'.langtransstr($newval) ."</td>
                </tr>\n";
               }
                $even_odd++;
            }
        }
    }
}

function getparts($val, $number) {
    $retval = array();
    $collect = '';

    $splits = explode(" ", $val, $number);

    for ($i = 0 ; $i < ($number -1) ; $i++ ) {
        $collect .= $splits[$i] . ' ';
    }
    $retval[0] = trim($collect);
    $retval[1] = ltrim($splits[$i]);
    return($retval);
}
?>