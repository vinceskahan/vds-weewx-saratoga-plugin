<?php
//
// this is the WD plugin file, simply renamed for weewx-wd
//
//--------------------------------------------------------
//
// this is the working section of the wxtrends.php page from the
// Carterlake/AJAX/PHP templates from http://saratoga-weather.org/template/
// Version 1.00 - Initial PHP version release
// Version 1.01 - minor fixes
// Version 1.02 - fixed formatRecord for records without &deg; in record string
// Version 1.03 - fixed adjustDate to handle 2 and 4 digit dates
// Version 1.04 - 25-Jun-2008 - now uses testtags.php for data + translation features added
// Version 1.05 - 03-Jun-2010 - replaced deprecated split() with explode()
// Version 1.06 - 18-Feb-2012 - replaced Baro Highs with Baro Lows display
//
print "<!-- begin trends-inc.php V1.06 -->\n";
/* --------------------------------------------------------
Note: this trends-inc.php REPLACES the need for WD to upload trends-inc.txt -> trends-inc.html
Make sure you have testtags.txt -> testtags.php at version 1.02 or higher.

Make sure you have these in Settings.php:

$SITE['uomDistance'] = ' miles';  // or ' km' -- used for Wind Run display
$SITE['WDdateMDY'] = true; // for WD date format of month/day/year.  =false for day/month/year
$SITE['dateOnlyFormat'] = 'd-M-Y'; // for 31-Mar-2008 or 'j/n/Y' for Euro format

otherwise the defaults below will be used.
------------------------------------------------------------ */
// --- default settings -----------(will be overriden by Settings.php)---------------
$uomTemp = '&deg;F';
$uomBaro = ' inHg';
$uomWind = ' mph';
$uomRain = ' in';
$uomPerHour = '/hr';
$uomDistance = ' miles';
$timeFormat = 'd-M-Y g:ia';  // 31-Mar-2006 6:35pm
//$timeFormat = 'd-M-Y H:i';   // 31-Mar-2006 18:35
$timeOnlyFormat = 'g:ia';    // h:mm[am|pm];
//$timeOnlyFormat = 'H:i';     // hh:mm
$dateOnlyFormat = 'd-M-Y';   // d-Mon-YYYY
$WDdateMDY = true;     // true=dates by WD are 'month/day/year'
//                     // false=dates by WD are 'day/month/year'
$ourTZ = "PST8PDT";  //NOTE: this *MUST* be set correctly to
// translate UTC times to your LOCAL time for the displays.
//
$haveUV   = true;        // set to false if no UV sensor
$haveSolar = true;       // set to false if no Solar sensor
$graphImageDir = './'; 
// allow viewing of generated source

if ( isset($_REQUEST['sce']) && strtolower($_REQUEST['sce']) == 'view' ) {
//--self downloader --
   $filenameReal = __FILE__;
   $download_size = filesize($filenameReal);
   header('Pragma: public');
   header('Cache-Control: private');
   header('Cache-Control: no-cache, must-revalidate');
   header("Content-type: text/plain");
   header("Accept-Ranges: bytes");
   header("Content-Length: $download_size");
   header('Connection: close');
   
   readfile($filenameReal);
   exit;
}


// overrides from Settings.php if available

include_once("Settings.php");
include_once("common.php");
if (isset($SITE['WXtags'])) {
  include_once($SITE['WXtags']);
}

global $SITE;
if (isset($SITE['uomTemp'])) 	{$uomTemp = $SITE['uomTemp'];}
if (isset($SITE['uomBaro'])) 	{$uomBaro = $SITE['uomBaro'];}
if (isset($SITE['uomWind'])) 	{$uomWind = $SITE['uomWind'];}
if (isset($SITE['uomRain'])) 	{$uomRain = $SITE['uomRain'];}
if (isset($SITE['uomPerHour'])) {$uomPerHour = $SITE['uomPerHour'];}
if (isset($SITE['uomDistance'])) {$uomDistance = $SITE['uomDistance'];}
if (isset($SITE['timeFormat'])) {$timeFormat = $SITE['timeFormat'];}
if (isset($SITE['timeOnlyFormat'])) {$timeOnlyFormat = $SITE['timeOnlyFormat'];}
if (isset($SITE['dateOnlyFormat'])) {$dateOnlyFormat = $SITE['dateOnlyFormat'];}
if (isset($SITE['WDdateMDY']))  {$WDdateMDY = $SITE['WDdateMDY'];}
if (isset($SITE['tz'])) 		{$ourTZ = $SITE['tz'];}
if (isset($SITE['UV'])) 		{$haveUV = $SITE['UV'];}
if (isset($SITE['SOLAR'])) 		{$haveSolar = $SITE['SOLAR'];}

if(isset($SITE['graphImageDir'])) {$graphImageDir = $SITE['graphImageDir']; }
// end of overrides from Settings.php
// testing parameters
$DebugMode = false;
if (isset($_REQUEST['debug'])) {$DebugMode = strtolower($_REQUEST['debug']) == 'y'; }
if (isset($_REQUEST['UV'])) {$haveUV = $_REQUEST['UV'] <> '0';}
if (isset($_REQUEST['solar'])) {$haveSolar = $_REQUEST['solar'] <> '0';}
?>
<h2><?php echo langtrans('Trends as of'); ?> <span class="ajax" id="ajaxdate"><?php echo adjustWDdate($date); ?></span> 
<span class="ajax" id="ajaxindicator"><?php langtrans('at'); ?></span> 
<span class="ajax" id="ajaxtime"><?php echo adjustWDtime($time); ?></span> </h2>
<p>&nbsp;</p>

<table width="99%" cellpadding="0" cellspacing="0" border="0">

<tr class="table-top" style="text-align: center">
<td><?php echo langtrans('TIME'); ?></td>
<td><?php echo langtrans('TEMP'); ?><br/> <?php echo $uomTemp; ?></td>
<td><?php echo langtrans('WIND SPEED'); ?><br/> <?php echo $uomWind; ?></td>
<td><?php echo langtrans('WIND GUST'); ?><br/> <?php echo $uomWind; ?></td>
<td><?php echo langtrans('WIND DIR'); ?><br/> &nbsp;</td>
<td><?php echo langtrans('HUMIDITY'); ?><br/> %</td>
<td><?php echo langtrans('PRESSURE'); ?><br/> <?php echo $uomBaro; ?></td>
<td><?php echo langtrans('RAIN'); ?><br/> <?php echo $uomRain; ?></td>
</tr>

<tr class="column-light" style="text-align: center">
<td><?php echo langtrans('Current'); ?></td>
<td><span class="ajax" id="ajaxtempNoU"><?php echo $temp0minuteago; ?></span></td>
<td><span class="ajax" id="ajaxwindNoU"><?php echo $wind0minuteago; ?></span></td>
<td><span class="ajax" id="ajaxgustNoU"><?php echo $gust0minuteago; ?></span></td>
<td><span class="ajax" id="ajaxwinddir"><?php langtrans(trim($dir0minuteago)); ?></span></td>
<td><span class="ajax" id="ajaxhumidity"><?php echo $hum0minuteago; ?></span></td>
<td><span class="ajax" id="ajaxbaroNoU"><?php echo $baro0minuteago; ?></span></td>
<td><span class="ajax" id="ajaxrainNoU"><?php echo $rain0minuteago; ?></span></td>
</tr>

<tr class="column-dark" style="text-align: center">
<td><?php echo langtrans('5 minutes ago'); ?></td>
<td><?php echo $temp5minuteago; ?></td>
<td><?php echo $wind5minuteago; ?></td>
<td><?php echo $gust5minuteago; ?></td>
<td><?php langtrans(trim($dir5minuteago)); ?></td>
<td><?php echo $hum5minuteago; ?></td>
<td><?php echo $baro5minuteago; ?></td>
<td><?php echo $rain5minuteago; ?></td>

</tr>

<tr class="column-light" style="text-align: center">
<td><?php echo langtrans('10 minutes ago'); ?></td>
<td><?php echo $temp10minuteago; ?></td>
<td><?php echo $wind10minuteago; ?></td>
<td><?php echo $gust10minuteago; ?></td>
<td><?php langtrans(trim($dir10minuteago)); ?></td>
<td><?php echo $hum10minuteago; ?></td>
<td><?php echo $baro10minuteago; ?></td>
<td><?php echo $rain10minuteago; ?></td>
</tr>

<tr class="column-dark" style="text-align: center">
<td><?php echo langtrans('15 minutes ago'); ?></td>
<td><?php echo $temp15minuteago; ?></td>
<td><?php echo $wind15minuteago; ?></td>
<td><?php echo $gust15minuteago; ?></td>
<td><?php langtrans(trim($dir15minuteago)); ?></td>
<td><?php echo $hum15minuteago; ?></td>
<td><?php echo $baro15minuteago; ?></td>
<td><?php echo $rain15minuteago; ?></td>
</tr>

<tr class="column-light" style="text-align: center">
<td><?php echo langtrans('20 minutes ago'); ?></td>
<td><?php echo $temp20minuteago; ?></td>
<td><?php echo $wind20minuteago; ?></td>
<td><?php echo $gust20minuteago; ?></td>
<td><?php langtrans(trim($dir20minuteago)); ?></td>
<td><?php echo $hum20minuteago; ?></td>
<td><?php echo $baro20minuteago; ?></td>
<td><?php echo $rain20minuteago; ?></td>
</tr>

<tr class="column-dark" style="text-align: center">
<td><?php echo langtrans('30 minutes ago'); ?></td>
<td><?php echo $temp30minuteago; ?></td>
<td><?php echo $wind30minuteago; ?></td>
<td><?php echo $gust30minuteago; ?></td>
<td><?php langtrans(trim($dir30minuteago)); ?></td>
<td><?php echo $hum30minuteago; ?></td>
<td><?php echo $baro30minuteago; ?></td>
<td><?php echo $rain30minuteago; ?></td>
</tr>

<tr class="column-light" style="text-align: center">
<td><?php echo langtrans('45 minutes ago'); ?></td>
<td><?php echo $temp45minuteago; ?></td>
<td><?php echo $wind45minuteago; ?></td>
<td><?php echo $gust45minuteago; ?></td>
<td><?php langtrans(trim($dir45minuteago)); ?></td>
<td><?php echo $hum45minuteago; ?></td>
<td><?php echo $baro45minuteago; ?></td>
<td><?php echo $rain45minuteago; ?></td>
</tr>

<tr class="column-dark" style="text-align: center">
<td><?php echo langtrans('60 minutes ago'); ?></td>
<td><?php echo $temp60minuteago; ?></td>
<td><?php echo $wind60minuteago; ?></td>
<td><?php echo $gust60minuteago; ?></td>
<td><?php langtrans(trim($dir60minuteago)); ?></td>
<td><?php echo $hum60minuteago; ?></td>
<td><?php echo $baro60minuteago; ?></td>
<td><?php echo $rain60minuteago; ?></td>
</tr>

<tr class="column-light" style="text-align: center">
<td><?php echo langtrans('75 minutes ago'); ?></td>
<td><?php echo $temp75minuteago; ?></td>
<td><?php echo $wind75minuteago; ?></td>
<td><?php echo $gust75minuteago; ?></td>
<td><?php langtrans(trim($dir75minuteago)); ?></td>
<td><?php echo $hum75minuteago; ?></td>
<td><?php echo $baro75minuteago; ?></td>
<td><?php echo $rain75minuteago; ?></td>
</tr>

<tr class="column-dark" style="text-align: center">
<td><?php echo langtrans('90 minutes ago'); ?></td>
<td><?php echo $temp90minuteago; ?></td>
<td><?php echo $wind90minuteago; ?></td>
<td><?php echo $gust90minuteago; ?></td>
<td><?php langtrans(trim($dir90minuteago)); ?></td>
<td><?php echo $hum90minuteago; ?></td>
<td><?php echo $baro90minuteago; ?></td>
<td><?php echo $rain90minuteago; ?></td>

</tr>

<tr class="column-light" style="text-align: center">
<td><?php echo langtrans('105 minutes ago'); ?></td>
<td><?php echo $temp105minuteago; ?></td>
<td><?php echo $wind105minuteago; ?></td>
<td><?php echo $gust105minuteago; ?></td>
<td><?php langtrans(trim($dir105minuteago)); ?></td>
<td><?php echo $hum105minuteago; ?></td>
<td><?php echo $baro105minuteago; ?></td>

<td><?php echo $rain105minuteago; ?></td>
</tr>

<tr class="column-dark" style="text-align: center">
<td><?php echo langtrans('120 minutes ago'); ?></td>
<td><?php echo $temp120minuteago; ?></td>
<td><?php echo $wind120minuteago; ?></td>
<td><?php echo $gust120minuteago; ?></td>
<td><?php langtrans(trim($dir120minuteago)); ?></td>
<td><?php echo $hum120minuteago; ?></td>
<td><?php echo $baro120minuteago; ?></td>
<td><?php echo $rain120minuteago; ?></td>
</tr>
</table>

	  <h1 style="margin: 10px 0;"><?php langtrans('Records and Stats'); ?></h1> 

<table width="99%" cellpadding="0" cellspacing="0" border="0">

<tr class="table-top">
<td colspan="2"><?php echo langtrans('RAIN'); ?></td>
<td colspan="2"><?php echo langtrans('RAIN HISTORY'); ?></td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo unUnit($dayrn) . $uomRain; ?> 
(<?php echo unUnit($hourrn) . $uomRain; ?> <?php langtrans('last hour'); ?>) </td>
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo $dayswithnorain . ' '; 
$dayswithnorain!=1?langtrans('days since last rain on'):langtrans('day since last rain on'); ?> 
<?php echo adjustWDdate($dateoflastrainalways) . ' ' . adjustWDtime($timeoflastrainalways); ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo unUnit($yesterdayrain) . $uomRain; ?></td>
<td><?php echo langtrans('Week'); ?></td>
<td><?php echo unUnit($raincurrentweek) . $uomRain; ?> <?php langtrans('over last 7 days'); ?>.</td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Month'); ?></td>
<td><?php echo unUnit($monthrn) . $uomRain; ?> (<?php echo $dayswithrain . ' '; 
$dayswithrain!=1?langtrans('rain days this month'):langtrans('rain day this month'); ?>)</td>
<td><?php echo langtrans('Month'); ?></td>
<td><?php echo unUnit($raintodatemonthago) . $uomRain; ?> <?php langtrans('last month'); ?>. </td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Year'); ?></td>
<td><?php echo unUnit($yearrn) . $uomRain; ?> (
<?php echo $dayswithrainyear . ' '; 
$dayswithrainyear!=1?langtrans('rain days this year'):langtrans('rain day this year'); ?>)</td>
<td><?php echo langtrans('Year'); ?></td>
<td><?php echo unUnit($raintodateyearago) . $uomRain; ?> <?php langtrans('total last year at this time'); ?>.</td>
</tr>

<tr class="table-top">
<td colspan="2"><?php echo langtrans('TEMPERATURE HIGHS'); ?></td>
<td colspan="2"><?php echo langtrans('HOT DAYS THIS MONTH'); ?></td>

</tr>

<tr class="column-light">
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo unUnit($maxtemp).' '.$uomTemp; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($maxtempt); ?></td>
<td><?php echo langtrans('Max'); ?> &gt; <?php echo preg_match('|F|i',$uomTemp)?'86':'30'; ?> <?php echo $uomTemp; ?></td>
<td><?php echo $daysTmaxGT30C . ' '; 
$daysTmaxGT30C!=1?langtrans('days'):langtrans('day'); ?></td>
</tr>

<tr class="column-dark">

<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo unUnit($maxtempyest).' '.$uomTemp; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($maxtempyestt); ?></td>
<td><?php echo langtrans('Max'); ?> &gt; <?php echo preg_match('|F|i',$uomTemp)?'77':'25'; ?> <?php echo $uomTemp; ?></td>
<td><?php echo $daysTmaxGT25C . ' '; 
$daysTmaxGT25C!=1?langtrans('days'):langtrans('day'); ?></td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Month'); ?></td>
<td><?php echo unUnit($mrecordhightemp).' '.$uomTemp; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($mrecordhightempyear,$mrecordhightempmonth,$mrecordhightempday); ?></td>

<td><span style="font-size: 10px;"><?php echo langtrans('Warmest day'); ?></span></td>
<td><?php echo reformatRecord($mwarmestdayonrecord); ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Year'); ?></td>
<td><?php echo unUnit($yrecordhightemp).' '.$uomTemp; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($yrecordhightempyear,$yrecordhightempmonth,$yrecordhightempday); ?>
</td>
<td><span style="font-size: 10px;"><?php echo langtrans('Warmest night'); ?></span></td>
<td><?php echo reformatRecord($mwarmestnightonrecord); ?></td>
</tr>


<tr class="table-top">
<td colspan="2"><?php echo langtrans('TEMPERATURE LOWS'); ?></td>
<td colspan="2"><?php echo langtrans('COLD DAYS THIS MONTH'); ?></td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo unUnit($mintemp). " $uomTemp"; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($mintempt); ?></td>
<td><?php echo langtrans('Min'); ?> &lt; <?php echo preg_match('|F|i',$uomTemp)?'32':'0'; ?> <?php echo $uomTemp; ?></td>

<td><?php echo $daysTminLT0C . ' '; 
$daysTminLT0C!=1?langtrans('days'):langtrans('day'); ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo unUnit($mintempyest). " $uomTemp"; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($mintempyestt); ?></td>
<td><?php echo langtrans('Min'); ?> &lt; <?php echo preg_match('|F|i',$uomTemp)?'5':'-15'; ?> <?php echo $uomTemp; ?></td>
<td><?php echo $daysTminLTm15C . ' '; 
$daysTminLTm15C!=1?langtrans('days'):langtrans('day'); ?></td>

</tr>

<tr class="column-light">
<td><?php echo langtrans('Month'); ?></td>
<td><?php echo unUnit($mrecordlowtemp). " $uomTemp"; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($mrecordlowtempyear,$mrecordlowtempmonth,$mrecordlowtempday); ?></td>
<td><span style="font-size: 10px;"><?php echo langtrans('Coldest day'); ?></span></td>
<td><?php echo reformatRecord($mcoldestdayonrecord); ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Year'); ?></td>

<td><?php echo unUnit($yrecordlowtemp). " $uomTemp"; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($yrecordlowtempyear,$yrecordlowtempmonth,$yrecordlowtempday); ?>
</td>
<td><span style="font-size: 10px;"><?php echo langtrans('Coldest night'); ?></span></td>
<td><?php echo reformatRecord($mcoldestnightonrecord); ?></td>
</tr>

<tr class="table-top">
<td colspan="2"><?php echo langtrans('BAROMETER LOWS'); ?></td>
<td colspan="2"><?php echo langtrans('WIND CHILL LOWS'); ?></td>
</tr>

<tr class="column-light">

<td><?php echo langtrans('Today'); ?></td>
<td><?php echo unUnit($lowbaro). $uomBaro; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($lowbarot); ?></td>
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo unUnit($minwindch). " $uomTemp"; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($minwindcht); ?></td>
</tr>
<?php if(isset($minbaroyest) and isset($minchillyest)) { ?>
<tr class="column-dark">
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo unUnit($minbaroyest). $uomBaro; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($minbaroyestt); ?></td>
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo unUnit($minchillyest). " $uomTemp"; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($minchillyestt); ?></td>
</tr>
<?php } // end both minbaro and minwindchill for yesterday exist ?>

<tr class="column-light">
<td><?php echo langtrans('Month'); ?>&nbsp;</td>
<td><?php echo unUnit($mrecordlowbaro). $uomBaro; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($mrecordlowbaroyear,$mrecordlowbaromonth,$mrecordlowbaroday); ?></td>
<td><?php echo langtrans('Month'); ?>&nbsp;</td>
<td><?php echo unUnit($mrecordlowchill). " $uomTemp"; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($mrecordlowchillyear,$mrecordlowchillmonth,$mrecordlowchillday); ?></td>
</tr>

<tr class="column-dark">

<td><?php echo langtrans('Year'); ?></td>
<td><?php echo unUnit($yrecordlowbaro). $uomBaro; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($yrecordlowbaroyear,$yrecordlowbaromonth,$yrecordlowbaroday); ?></td>
<td><?php echo langtrans('Year'); ?></td>
<td><?php echo unUnit($yrecordlowchill). " $uomTemp"; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($yrecordlowchillyear,$yrecordlowchillmonth,$yrecordlowchillday); ?>
</td>
</tr>

<?php if($haveSolar) { 
####################################
# Following section only valid if station has Solar sensor
?>
<tr class="table-top">
<td colspan="2"><?php echo langtrans('EVAPOTRANSPIRATION'); ?></td>
<td colspan="2"><?php echo langtrans('RAIN'); ?></td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo unUnit($VPet) . $uomRain; ?></td>
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo unUnit($dayrn) . $uomRain; ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo unUnit($yesterdaydaviset) . $uomRain; ?></td>
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo unUnit($yesterdayrain) . $uomRain; ?></td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Month'); ?></td>
<td><?php echo unUnit($VPetmonth) . $uomRain; ?></td>
<td><?php echo langtrans('Month'); ?></td>
<td><?php echo unUnit($monthrn) . $uomRain; ?></td>
</tr>
<?php } // end if haveSolar 
#############################
?>
<?php
####################### solar and UV depending on $haveSolar and $haveUV settings
if ($haveSolar or $haveUV) {
?>
<tr class="table-top">
<?php if ($haveSolar) { ?>
<td colspan="2"><?php echo langtrans('SOLAR HIGHS'); ?></td>
<?php }
    if ($haveUV) { ?>
<td colspan="2"><?php echo langtrans('UV HIGHS'); ?></td>
<?php } ?>
</tr>

<tr class="column-light">
<?php if ($haveSolar) { ?>
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo $highsolar; ?> W/m<sup>2</sup> <?php langtrans('at'); ?> <?php echo adjustWDtime($highsolartime); ?></td>
<?php }
    if ($haveUV) { ?>
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo $highuv; ?> index <?php langtrans('at'); ?> <?php echo adjustWDtime($highuvtime); ?></td>
<?php } ?>
</tr>

<tr class="column-dark">
<?php if ($haveSolar) { ?>
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo $highsolaryest; ?> W/m<sup>2</sup> <?php langtrans('at'); ?> <?php echo adjustWDtime($highsolaryesttime); ?></td>
<?php }
    if ($haveUV) { ?>
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo $highuvyest; ?> index <?php langtrans('at'); ?> <?php echo adjustWDtime($highuvyesttime); ?></td>
<?php } ?>
</tr>
<?php
} // end $haveSolar or $haveUV
#################### end conditional Solar and/or UV display
?>
</table>

	  <h1 style="margin: 10px 0;"><?php langtrans('Wind Data'); ?></h1> 


<table width="99%" cellpadding="0" cellspacing="0" border="0">

<tr class="table-top">
<td colspan="2"><?php echo langtrans('CURRENT'); ?></td>
<td rowspan="18" align="center">
  <img src="<?php echo $graphImageDir; ?>dirplot.gif" width="381" height="361" alt="Wind direction plot"/>
</td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Now'); ?></td>
<td><?php echo unUnit($avgspd).$uomWind; ?> <?php langtrans($dirlabel); ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Gust'); ?></td>

<td><?php echo unUnit($gstspd).$uomWind; ?> <?php langtrans($dirlabel); ?></td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Gust/hr'); ?></td>
<td><?php echo unUnit($maxgsthr).$uomWind; ?></td>
</tr>

<tr class="table-top">
<td colspan="2"><?php echo langtrans('WIND GUST HIGHS'); ?></td>
</tr>

<tr class="column-light">

<td><?php echo langtrans('Today'); ?></td>
<td><?php echo unUnit($maxgst) . $uomWind; ?> <?php langtrans($maxgstdirectionletter); ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($maxgstt); ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo unUnit($maxgustyest) . $uomWind; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($maxgustyestt); ?></td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Month'); ?></td>
<td><?php echo unUnit($mrecordwindgust) . $uomWind; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($mrecordhighgustyear,$mrecordhighgustmonth,$mrecordhighgustday); ?>
</td>

</tr>

<tr class="column-dark">
<td><?php echo langtrans('Year'); ?></td>
<td><?php echo unUnit($yrecordwindgust) . $uomWind; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($yrecordhighgustyear,$yrecordhighgustmonth,$yrecordhighgustday); ?>
</td>
</tr>

<tr class="table-top">
<td colspan="2"><?php echo langtrans('WIND GUST AVERAGE HIGHS'); ?></td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Today'); ?></td>

<td><?php echo unUnit($maxavgspd) . $uomWind; ?> <?php langtrans($maxavgdirectionletter); ?> <?php langtrans('at'); ?> 
<?php echo adjustWDtime($maxavgspdt); ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Yest.'); ?></td>
<td><?php echo unUnit($maxaverageyest) . $uomWind; ?> <?php langtrans('at'); ?> <?php echo adjustWDtime($maxaverageyestt); ?></td>
</tr>

<tr class="column-light">
<td><?php echo langtrans('Month'); ?></td>
<td><?php echo unUnit($mrecordwindspeed) . $uomWind; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($mrecordhighavwindyear,$mrecordhighavwindmonth,$mrecordhighavwindday); ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Year'); ?></td>
<td><?php echo unUnit($yrecordwindspeed) . $uomWind; ?> <?php langtrans('on'); ?> 
<?php echo formatDateYMD($yrecordhighavwindyear,$yrecordhighavwindmonth,$yrecordhighavwindday); ?>
</td>
</tr>

<tr class="table-top">
<td colspan="2"><?php echo langtrans('WIND RUN'); ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Today'); ?></td>
<td><?php echo unUnit($windruntoday) . $uomDistance; ?></td>

</tr>

<tr class="column-light">
<td><?php echo langtrans('Month'); ?></td>
<td><?php echo unUnit($windruntodatethismonth) . $uomDistance; ?></td>
</tr>

<tr class="column-dark">
<td><?php echo langtrans('Year'); ?></td>
<td><?php echo unUnit($windruntodatethisyear) . $uomDistance; ?></td>
</tr>

</table>
<!-- end of trends-inc.php -->
<?php 
//=========================================================================
// change the hh:mm AM/PM to h:mmam/pm format or format spec by $timeOnlyFormat
function adjustWDtime ( $WDtime ) {
  global $timeOnlyFormat,$DebugMode;
  if ($WDtime == "00:00: AM") { return ''; }
  $t = explode(':',$WDtime);
  if(!isset($t[1])) { return( $WDtime ); }
  if (preg_match('/pm/i',$WDtime)) { $t[0] = $t[0] + 12; }
  if ($t[0] > 23) {$t[0] = 12; }
  if (preg_match('/^12.*am/i',$WDtime)) { $t[0] = 0; }
  $t2 = join(':',$t); // put time back to gether;
  $t2 = preg_replace('/[^\d\:]/is','',$t2); // strip out the am/pm if any
  $r = date($timeOnlyFormat , strtotime($t2));
  if ($DebugMode) {
    $r = "<!-- adjustWDtime WDtime='$WDtime' t2='$t2' -->" . $r;
    $r = '<span style="color: green;">' . $r . '</span>'; 
  }
  return ($r);
}

//=========================================================================
// strip trailing units from a measurement
// i.e. '30.01 in. Hg' becomes '30.01'
function unUnit ($data) {
  global $DebugMode;
  preg_match('/([\d\.\,\+\-]+)/',$data,$t);
   $r = $t[1];
  if ($DebugMode) {
    $r = "<!-- unUnit data='$data' -->" . $r;
    $r = '<span style="color: green;">' . $r . '</span>'; 
  }
  return ($r);
}
//=========================================================================
// adjust WD date to desired format
//
function adjustWDdate ($WDdate) {
  global $timeFormat,$timeOnlyFormat,$dateOnlyFormat,$WDdateMDY,$DebugMode;
  $d = explode('/',$WDdate);
  if(!isset($d[2])) { return($WDdate); }
  if ($d[2] > 70 and $d[2] <= 99) {$d[2] += 1900;} // 2 digit dates 70-99 are 1970-1999
  if ($d[2] < 99) {$d[2] += 2000; } // 2 digit dates (left) are assumed 20xx dates.
  if ($WDdateMDY) {
    $new = sprintf('%04d-%02d-%02d',$d[2],$d[0],$d[1]); //  M/D/YYYY -> YYYY-MM-DD
  } else {
    $new = sprintf('%04d-%02d-%02d',$d[2],$d[1],$d[0]); // D/M/YYYY -> YYYY-MM-DD
  }
  
  $r = date($dateOnlyFormat,strtotime($new));
  if ($DebugMode) {
    $r = "<!-- adjustDate WDdate='$WDdate', WDdateUSA='$WDdateMDY' new='$new' -->" . $r;
    $r = '<span style="color: green;">' . $r . '</span>'; 
  }
  return ($r);
}
//=========================================================================
// formatDate from Y, M, D
//
function formatDateYMD ( $Y, $M, $D) {
  global $timeFormat,$timeOnlyFormat,$dateOnlyFormat,$WDdateMDY,$DebugMode;
  
  $t = mktime(0,0,0,$M,$D,$Y);
  
  $r = date($dateOnlyFormat,$t);
  if ($DebugMode) {
    $r = "<!-- formatDateYMD Y='$Y', M='$M', D='$D' -->" . $r;
    $r = '<span style="color: green;">' . $r . '</span>'; 
  }
  return ($r);

}
//=========================================================================
// format weather record like:
//   '56.1&deg;F  on: Mar 01 2008'
//   '22.5&deg;C  on: 01 Mar 2008'
//   to using the uom values and date format
//
function reformatRecord ( $record ) {
  global $uomTemp,$timeFormat,$timeOnlyFormat,$dateOnlyFormat,$WDdateMDY,$DebugMode;
// old:  preg_match('|(.*?)\&deg;(.*)\s+on\:\s+(\S+) (\S+) (\S+)|is',$record,$vals);
  preg_match('|([\d\,\.\-]+)[\&deg;]*(.*)\s+on\:\s+(\S+) (\S+) (\S+)|is',$record,$vals);
/*
    [0] => 62.3&deg;F  on: Mar 03 2008
    [1] => 62.3
    [2] => F 
    [3] => Mar
    [4] => 03
    [5] => 2008
*/
  $t = '';
  if ($DebugMode) {
    $t = "<!-- reformatRecord in='$record' vals\n" . print_r($vals,true) . " -->\n";
  }
  $d = $vals[3] . ' ' . $vals[4] . ' ' . $vals[5];
  $d = date($dateOnlyFormat,strtotime($d));
  
  $r = $t . $vals[1] . ' ' . $uomTemp . ' ' . langtransstr('on') . ' ' . $d;
  if ($DebugMode) {
    $r = '<span style="color: green;">' . $r . '</span>'; 
  }
  return ($r);
  
}
?>
