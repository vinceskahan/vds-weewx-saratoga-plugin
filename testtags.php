<?php
// converted tagslist.txt to .\tagslist.php for php tags
// by gen-PHP-tagslist.pl - Version 1.00 - 07-Apr-2006
// Author: Ken True - webmaster-weather.org
// Edited: 20-Apr-2006 to trim unused tags
// Version 1.01 - 25-Jan-2008 -- added Windy-rain to icon list
// Version 1.02 - 24-Jun-2008 -- added variables to replace old trends-inc.html with trends-inc.php
// Version 1.03 - 27-Oct-2008 -- added Snow and WU almanac variables
// Version 1.04 - 03-Jun-2009 -- added moonrisedate/moonsetdate for wxastronomy.php
// Version 1.05 - 11-Jul-2009 -- added tags for printable flyer, alternative dashboard, high/low/avg plugins
//                               Thanks to Mike and Scott for their permission to add the above tags!
// Version 1.06 - 12-Jul-2009 -- added tags for V4.0 of alternative dashboard
// --------------------------------------------------------------------------
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
// Units
// -----
$uomtemp = 'F'; //  = 'C', 'F',  (or  '°C', '°F', or '&deg;C', '&deg;F' )
$uombaro = 'inHg'; //  = 'inHg', 'hPa', 'kPa', 'mb'
$uomwind = 'mph'; //  = 'kts','mph','kmh','km/h','m/s','Bft'
$uomrain = 'in'; //  = 'mm', 'in'
$datefmt = 'm/d/y%'; //  = 'd/m/y', 'm/d/y'
$uomdistance = 'mi'; // = 'mi','km'  (for windrun variables)
//
// General OR Non Weather Specific/SUN/MOON
// ========================================
$time =  '12:50 PM';	// current time
$date =  '01/27/11';	// current date
$sunrise =  '7:15 AM';	// sun rise time (make sure you have the correct lat/lon
// 		            in view/sun moon)
$time_minute =  '50';	// Current minute
$time_hour =  '12';	// Current hour
$date_day =  '27';	// Current day
$date_month =  '01';	// Current month
$date_year =  '2011';	// Current year
$monthname =  'January';	// Current month name
$dayname =  'Thursday';	// Current day name
$sunset =  '5:25 PM';	// sunset time
$moonrisedate =  '01/27/11';	// moon rise date
$moonrise =  '1:46 AM';	// moon rise time
$moonsetdate =  '01/27/11';	// moon set date
$moonset =  '11:47 AM';	// moon set time
$moonage =  'Moon age: 23 days,12 hours,37 minutes,36%';	// current age of the moon (days since new moon)
$moonphase =  '36%';	// Moon phase %
$moonphasename = 'Waning Crescent Moon'; // 10.36z addition
$marchequinox =  '23:21 UTC 20 March 2011';	// March equinox date
$junesolstice =  '17:17 UTC 21 June 2011';	// June solstice date
$sepequinox =  '09:05 UTC 23 September 2011';	// September equinox date
$decsolstice =  '05:31 UTC 22 December 2011';	// December solstice date
$moonperihel =  '02:56 UTC 4 January 2012';	// Next Moon perihel date
$moonaphel =  '11:49 UTC 5 July 2011';	// Next moon perihel date
$moonperigee =  '07:18 UTC 19 February 2011';	// Next moon perigee date
$moonapogee =  '23:13 UTC 6 February 2011';	// Next moon apogee date
$newmoon =  '09:03 UTC 4 January 2011';	// Date/time of the next/last new moon
$nextnewmoon =  '02:31 UTC 3 February 2011';	// Date/time of the next new moon for next month
$firstquarter =  '11:32 UTC 12 January 2011';	// Date/time of the next/last first quarter moon
$lastquarter =  '12:58 UTC 26 January 2011';	// Date/time of the next/last last quarter moon
$fullmoon =  '21:22 UTC 19 January 2011';	// Date/time of the next/last full moon
$fullmoondate =  ' 19 January 2011';	// Date of the next/last full moon (date only)
$suneclipse =  '21:17 UTC 1 June 2011 Eclipse Partial';	// Next sun eclipse
$mooneclipse =  '20:13 UTC 15 June 2011 Eclipse Total';	// Next moon eclipse date
$easterdate =  '24 April 2011';	// Next easter date
$chinesenewyear =  '3 February 2011 ()';	// Chinese new year
$hoursofpossibledaylight =  '10:10';	// Total hours/minutes of possible daylight for today
//
$weatherreport =  'mostly clear';	// current weather conditions from selected METAR
$stationaltitude =  '375';	// Station altitude, feet, as set in the units setup
// this under setup)
$stationlatitude =  '037:16:28';	// Latitude (from the sun moon rise/set setup)
$stationlongitude =  '0122:01:23';	// Longtitude (from the sun moon rise/set setup)
$windowsuptime = '4 Days 4 Hours 32 Minutes 0 Seconds'; // uptime for windows on weather pc
$freememory = ' 308.876 MB'; // amount of free memory on the pc
$Startimedate = '8:20:17 AM 1/23/2011'; // Time/date WD was started

$NOAAEvent = 'NO CURRENT ADVISORIES'; // NOAA Watch/Warning/Advisory
$noaawarningraw = '
There are no active watches, warnings or advisories'; // NOAA RAW watch/warning/advisory

// ADVISORIES)
// ADVISORIES)

$wdversion = '10.37Q' . '-(b' . '27' . ')';	// Weather Display version number you are running
$wdversiononly = '10.37Q';
$wdbuild   = '27';       // Weather Display build number you are running
// ---....What it says - for the weather warning....
// 
// this under setup)
$noaacityname =  'Saratoga';	// City name,from the noaa setup (in the av/ext setup)
// 
// level...enter this under setup)
// 
$timeofnextupdate =  '12:55 PM';	// Time of next Update/Upload of the weather data to your web page (based on the web table update 
// 
// time)
// 
// must be first selected),,,,repeat up to day 8
$heatcolourword =  'Comfortable';	// How hot/cold it feels at the moment, based on the humidex, used with the conditionscolour.jpg 
// 
// 
// Temperature/Humidity
// ====================
// Current:
// --------
$temperature =  '66.8°F';	// temperature
$tempnodp = '66'; // temperature, no decimal place
$humidity =  '47';	// humidity
$dewpt =  '45.9°F';	// dew point
$maxtemp =  '66.9°F';	// today's maximum temperature
$maxtempt =  '12:43 PM';	// time this occurred
$mintemp =  '40.3°F';	// today's minimum temperature
$mintempt =  '6:54 AM';	// time this occurred
// VP soil temperature)
$feelslike =  '67';	// Shows heat index or humidex or windchill (if less than 16oC)

$heati =  '66.8°F';	// current heat index
$heatinodp =  '67';	// current heat index,no decimal place
$windch =  '66.8°F';	// current wind-chill
$windchnodp =  '67°F';	// current wind-chill, no decimal place
$humidexfaren =  '67.3°F';	// Humidex value in oF
$humidexcelsius =  '19.6°C';	// Humidex value in oC

$apparenttemp =  '67.1';	// Apparent temperature
$apparentsolartemp =  '77.5';	// Apparent temperature in the sun (you need a solar sensor)
$apparenttempc =  '19.5';	// Apparent temperature, °C
$apparentsolartempc =  '25.3';	// Apparent temperature in the sun, °C (you need a solar sensor)
$apparenttempf =  '67.1';	// Apparent temperature, °F
$apparentsolartempf =  '77.5';	// Apparent temperature in the sun, °F (you need a solar sensor)
// 
$WUmaxtemp = '60.8';	// Todays average max temperature from the selected Wunderground almanac station
$WUmintemp = '42.8';	// Todays average min temperature from the selected Wunderground almanac station
// 
$WUmaxtempr = '75.2';	// Todays record max temperature from the selected Wunderground almanac station
$WUmintempr = '26.6';	// Todays record min temperature from the selected Wunderground almanac station
$WUmaxtempryr = '1988';	// Year that it occured
$WUmintempryr = '1902';	// year that it occured
// 
// 
// Yesterday:
// ----------
$tempchangehour =  '+2.4 °F/last hr';	// Temperature change in the last hour
$maxtempyest =  '70.9 °F';	// Yesterday's max temperature
$maxtempyestt =  '3:12 PM';	// Time of yesterday's max temperature
$mintempyest =  '44.1 °F';	// Yesterday's min temperature
$mintempyestt =  '6:58 AM';	// Time of yesterday's min temperature
// 
// 
// Trends:
// -------
$temp24hoursago =  '66.8';	// The temperature 24 hours ago
$humchangelasthour =  '-3';	// Humidity change last hour
$dewchangelasthour =  '+0.6';	// Dew point change last hour
$barochangelasthour =  '-0.033';	// Baro change last hour
// 
// Wind
// ====
// Current:
// --------
// 
$avgspd =  '0.0 mph';	// average wind speed (current)
$gstspd =  '0.0 mph';	// current/gust wind speed
$maxgst =  '0.0 mph';	// today's maximum wind speed
$maxgstt =  '11:50 AM';	// time this occurred
$maxgsthr =  '0.0 mph  N ';	// maximum gust last hour
$dirdeg =  '52 °';	// wind direction (degrees)
$dirlabel =  'NE';	// wind direction (NNE etc)
//$maxgustlastimediatehourtime =  '';	//   time that the max gust last prior 1 hour occured
$avwindlastimediate10 =  '-';	// Average wind for the last immediate 10 minute period
// $avdir10minute =  '39°';	// average ten minute wind direction (degrees)

$beaufortnum ='0'; //Beaufort wind force number
$currbftspeed = '0 bft'; //Current Beaufort wind speed

$bftspeedtext = 'Calm'; //Beaufort scale in text (i.e Fresh Breeze)
// 
// 
// Baromometer
// ===========
// Current:
// --------
$baro = '30.227 .in';  // current barometer
$baroinusa2dp =  '30.23 inches';	// Current barometer reading in inches, 2 decimal places only.
$trend =  '-0.033in./hr';	// amount of change in the last hour
$pressuretrendname =  'Falling slowly';	// pressure trend (i.e. 'falling'), last hour
$pressuretrendname3hour =  'Falling';	// pressure trend (i.e. 'falling'), last 3 hours

$vpforecasttext = 'Note: Data is Bogus.  Configure Weather-Display to upload testtags.php so your weather station data will show';
// 
// 
// Rain
// ====
// Current:
// --------
$dayrn =  '0.00 in.';	// today's rain
$monthrn =  '0.99 in.';	// rain so far this month
$yearrn =  '11.83 in.';	// rain so far this year
$dayswithnorain =  '9';	// Consecutative days with no rain
$dayswithrain =  '12';	// Days with rain for the month
$dayswithrainyear =  '12';	// Days with rain for the year
$currentrainratehr =  '0.00';	// Current rain rate, mm/hr (or in./hr)
$maxrainrate =  '0.000';	// Max rain rate,for the day, mm/min (or in./min)
$maxrainratehr =  '0.000';	// Max rain rate,for the day, mm/hr (or in.mm)
$maxrainratetime =  '00:00 AM';	// Time that occurred
// Yesterday:
// ----------
$yesterdayrain =  '0.00 in.';	// Yesterday rain
//
$vpstormrainstart = '0/0/0';  //Davis VP Storm rain start date
$vpstormrain = '0.00 .in';           //Davis VP Storm rain value
//
// 
// Sunshine/Solar/ET
// =================
$VPsolar =  '549';	//  Solar energy number (W/M2)
$VPuv =  '3.2';	// UV number 
$highsolar =  '560';	// Daily high solar (for Davis VP and Grow stations)
$highuv =  '3.3';	// Daily high UV (for Davis VP stations)
$currentsolarpercent =  '92 %';	// Current solar percent for stations with a temperature solar sensor (like the dallas 1 wire)
$highsolartime =  '12:12 PM';	// Time that the daily high solar occured
$lowsolartime =  '12:00 AM';	// Time that the daily low solar occured
$highuvtime =  '12:10 PM';	// Time that the daily high UV occured
$lowuvtime =  '12:00 AM';	// Time that the daily low UV occured
$highuvyest =  '3.3';	// Yesterday's high UV
$highuvyesttime =  '12:18 PM';	// Time of yesterday's high UV
$burntime =  '35';	// Time (minutes) to burn (normal skin) at the current UV rate, from the Davis VP with UV sensor
// 
// the solar setup.
// 
// 
// Number of resynchronizations, The largest number of packets in a row that were received., and the number of CRC errors 
// 
// detected. 
// 
// 
// Record Readings
// ===============
// 
// for current month to date:
// 
$mrecordwindgust =  '18.1';	// All time record high wind gust
$mrecordhighgustday =  '1';	// Day of record high wind gust
// 
// 
// Snow
// =====
// 
$snowseasonin = '0';	// Snow for season you have entered under input daily weather, inches
$snowmonthin = '0';	// Snow for month you have entered under input daily weather, inches
$snowtodayin = '0.00';	// Snow for today you have entered under input daily weather, inches
$snowseasoncm = '0';	// Snow for season you have entered under input daily weather, cm
$snowmonthcm = '0';	// Snow for month you have entered under input daily weather, cm
$snowtodaycm = '0.0';	// Snow for today you have entered under input daily weather, cm
$snowyesterday = '0';	// Yesterdays' snow
$snowheight = '421';	// Estimated height snow will fall at
$snowheightnew = '7795';	// Estimated height snow will fall at, new formula
// 
$snownowin = '0';	// Current snow depth, inches.
$snownowcm = '0';	// Current snow depth, cm.
// 
$snowrain = '0.00';	// Rain measure by a heated rain gauge when temp below freezing times 10 to give estimated snow fall
$snowdaysthismonth = '0';	// Days with snow this month
$snowdaysthisyear = '0';	// Days with snow this year
//
// tags needed for trends-inc.php
//
$temp0minuteago = '66.7';  // ****this one is needed for all the others to work
$wind0minuteago = '0.0';
$gust0minuteago = '0.0';
$dir0minuteago = ' NE';
$hum0minuteago = '47';
$dew0minuteago = '45.9';
$baro0minuteago = '30.227';
$rain0minuteago = '0.00';
$VPsolar0minuteago = '549';
$VPuv0minuteago = '3.2';

$temp5minuteago = '66.8';  
$wind5minuteago = '0.0';
$gust5minuteago = '0.0';
$dir5minuteago = ' NE';
$hum5minuteago = '45';
$dew5minuteago = '44.8';
$baro5minuteago = '30.229';
$rain5minuteago = '0.00';
$VPsolar5minuteago = '552';
$VPuv5minuteago = '3.2';

$temp10minuteago = '66.8';  
$wind10minuteago = '0.0';
$gust10minuteago = '0.0';
$dir10minuteago = ' NW';
$hum10minuteago = '47';
$dew10minuteago = '45.9';
$baro10minuteago = '30.233';
$rain10minuteago = '0.00';
$VPsolar10minuteago = '552';
$VPuv10minuteago = '3.2';

$temp15minuteago = '66.3';  
$wind15minuteago = '0.0';
$gust15minuteago = '0.0';
$dir15minuteago = ' NE';
$hum15minuteago = '47';
$dew15minuteago = '45.5';
$baro15minuteago = '30.238';
$rain15minuteago = '0.00';
$VPsolar15minuteago = '554';
$VPuv15minuteago = '3.2';

$temp20minuteago = '65.8';  
$wind20minuteago = '0.0';
$gust20minuteago = '0.0';
$dir20minuteago = 'NNW';
$hum20minuteago = '48';
$dew20minuteago = '45.6';
$baro20minuteago = '30.241';
$rain20minuteago = '0.00';
$VPsolar20minuteago = '558';
$VPuv20minuteago = '3.3';

$temp30minuteago = '65.6';  
$wind30minuteago = '0.0';
$gust30minuteago = '0.0';
$dir30minuteago = ' N ';
$hum30minuteago = '49';
$dew30minuteago = '45.9';
$baro30minuteago = '30.245';
$rain30minuteago = '0.00';
$VPsolar30minuteago = '558';
$VPuv30minuteago = '3.3';

$temp45minuteago = '65.0';  
$wind45minuteago = '0.0';
$gust45minuteago = '0.0';
$dir45minuteago = 'NNW';
$hum45minuteago = '49';
$dew45minuteago = '45.4';
$baro45minuteago = '30.257';
$rain45minuteago = '0.00';
$VPsolar45minuteago = '556';
$VPuv45minuteago = '3.2';

$temp60minuteago = '64.3';  
$wind60minuteago = '0.0';
$gust60minuteago = '0.0';
$dir60minuteago = ' N ';
$hum60minuteago = '50';
$dew60minuteago = '45.3';
$baro60minuteago = '30.260';
$rain60minuteago = '0.00';
$VPsolar60minuteago = '552';
$VPuv60minuteago = '3.2';

$temp75minuteago = '64.5';  
$wind75minuteago = '0.0';
$gust75minuteago = '0.0';
$dir75minuteago = 'NNW';
$hum75minuteago = '50';
$dew75minuteago = '45.4';
$baro75minuteago = '30.265';
$rain75minuteago = '0.00';
$VPsolar75minuteago = '542';
$VPuv75minuteago = '3.1';

$temp90minuteago = '64.2';  
$wind90minuteago = '0.0';
$gust90minuteago = '0.0';
$dir90minuteago = ' N ';
$hum90minuteago = '52';
$dew90minuteago = '46.2';
$baro90minuteago = '30.273';
$rain90minuteago = '0.00';
$VPsolar90minuteago = '533';
$VPuv90minuteago = '2.9';

$temp105minuteago = '61.8';  
$wind105minuteago = '0.0';
$gust105minuteago = '0.0';
$dir105minuteago = ' N ';
$hum105minuteago = '55';
$dew105minuteago = '45.4';
$baro105minuteago = '30.276';
$rain105minuteago = '0.00';
$VPsolar105minuteago = '516';
$VPuv105minuteago = '2.7';

$temp120minuteago = '61.0';  
$wind120minuteago = '0.0';
$gust120minuteago = '0.0';
$dir120minuteago = ' N ';
$hum120minuteago = '56';
$dew120minuteago = '45.2';
$baro120minuteago = '30.278';
$rain120minuteago = '0.00';
$VPsolar120minuteago = '493';
$VPuv120minuteago = '2.5';

$VPet = '0.03';
$VPetmonth = '1.44';
$dateoflastrainalways = '1/18/2011';
$highbaro = '30.290 in.';
$highbarot = '9:28 AM';
$highsolaryest = '561.0';
$highsolaryesttime = '12:19 PM';
$hourrn = '0.00';
$maxaverageyest = '2.1 mph ENE';
$maxaverageyestt = '1:36 PM';
$maxavgdirectionletter = 'ENE';
$maxavgspd = '0.0 mph';
$maxavgspdt = '1:36 PM';
$maxbaroyest = '30.213 in.';
$maxbaroyestt = '11:57 PM';
$maxgstdirectionletter = 'N';
$maxgustyest = '6.0 mph   N';
$maxgustyestt = '11:50 AM';
$mcoldestdayonrecord = '41.0&deg;F  on: Jan 07 2011';
$mcoldestnightonrecord = '34.5&deg;F  on: Jan 10 2011';
$minchillyest = '44.1 °F';
$minchillyestt = '6:58 AM';
$minwindch = '40.3 °F';
$minwindcht = '6:54 AM';
$mrecordhighavwindday = '19';
$mrecordhighavwindmonth = '1';
$mrecordhighavwindyear = '2011';
$mrecordhighbaro = '30.419';
$mrecordhighbaroday = '14';
$mrecordhighbaromonth = '1';
$mrecordhighbaroyear = '2011';
$mrecordhighgustmonth = '1';
$mrecordhighgustyear = '2011';
$mrecordhightemp = '72.5';
$mrecordhightempday = '15';
$mrecordhightempmonth = '1';
$mrecordhightempyear = '2011';
$mrecordlowchill = '30.9';
$mrecordlowchillday = '10';
$mrecordlowchillmonth = '1';
$mrecordlowchillyear = '2011';
$mrecordlowtemp = '30.9';
$mrecordlowtempday = '10';
$mrecordlowtempmonth = '1';
$mrecordlowtempyear = '2011';
$mrecordwindspeed = '12.0';
$mwarmestdayonrecord = '62.2&deg;F  on: Jan 23 2011';
$mwarmestnightonrecord = '55.4&deg;F  on: Jan 14 2011';
$raincurrentweek = '0.000';
$raintodatemonthago = '6.17';
$raintodateyearago = '8.57';
$timeoflastrainalways = ' 1:30 AM';
$windruntodatethismonth = '249.53 miles';
$windruntodatethisyear = '249.53 miles';
$windruntoday = '0.00';
$yesterdaydaviset = '0.088';
$yrecordhighavwindday = '19';
$yrecordhighavwindmonth = '1';
$yrecordhighavwindyear = '2011';
$yrecordhighbaro = '30.419';
$yrecordhighbaroday = '14';
$yrecordhighbaromonth = '1';
$yrecordhighbaroyear = '2011';
$yrecordhighgustday = '1';
$yrecordhighgustmonth = '1';
$yrecordhighgustyear = '2011';
$yrecordhightemp = '72.5';
$yrecordhightempday = '15';
$yrecordhightempmonth = '1';
$yrecordhightempyear = '2011';
$yrecordlowchill = '30.9';
$yrecordlowchillday = '10';
$yrecordlowchillmonth = '1';
$yrecordlowchillyear = '2011';
$yrecordlowtemp = '30.9';
$yrecordlowtempday = '10';
$yrecordlowtempmonth = '1';
$yrecordlowtempyear = '2011';
$yrecordwindgust = '18.1';
$yrecordwindspeed = '12.0';
$daysTmaxGT30C = '0';
$daysTmaxGT25C = '0';
$daysTminLT0C = '1';
$daysTminLTm15C = '0';

// end of trends-inc.php variables

//  
   // CURRENT CONDITIONS ICONS FOR clientraw.txt
   // create array for icons. There are 35 possible values in clientraw.txt
   // It would be simpler to do this with array() but to make it easier to 
   // modify each element is defined individually. Each index [#] corresponds
   // to the value provided in clientraw.txt
   $icon_array[0] =  'day_clear.gif';            // imagesunny.visible
   $icon_array[1] =  'night_clear.gif';          // imageclearnight.visible
   $icon_array[2] =  'day_partly_cloudy.gif';    // imagecloudy.visible
   $icon_array[3] =  'day_partly_cloudy.gif';    // imagecloudy2.visible
   $icon_array[4] =  'night_partly_cloudy.gif';  // imagecloudynight.visible
   $icon_array[5] =  'day_partly_cloudy.gif';            // imagedry.visible
   $icon_array[6] =  'fog.gif';                  // imagefog.visible
   $icon_array[7] =  'haze.gif';                 // imagehaze.visible
   $icon_array[8] =  'day_heavy_rain.gif';       // imageheavyrain.visible
   $icon_array[9] =  'day_mostly_sunny.gif';     // imagemainlyfine.visible
   $icon_array[10] =  'mist.gif';                // imagemist.visible
   $icon_array[11] =  'fog.gif';                 // imagenightfog.visible
   $icon_array[12] =  'night_heavy_rain.gif';    // imagenightheavyrain.visible
   $icon_array[13] =  'night_cloudy.gif';        // imagenightovercast.visible
   $icon_array[14] =  'night_rain.gif';          // imagenightrain.visible
   $icon_array[15] =  'night_light_rain.gif';    // imagenightshowers.visible
   $icon_array[16] =  'night_snow.gif';          // imagenightsnow.visible
   $icon_array[17] =  'night_tstorm.gif';        // imagenightthunder.visible
   $icon_array[18] =  'day_cloudy.gif';          // imageovercast.visible
   $icon_array[19] =  'day_partly_cloudy.gif';   // imagepartlycloudy.visible
   $icon_array[20] =  'day_rain.gif';            // imagerain.visible
   $icon_array[21] =  'day_rain.gif';            // imagerain2.visible
   $icon_array[22] =  'day_light_rain.gif';      // imageshowers2.visible
   $icon_array[23] =  'sleet.gif';               // imagesleet.visible
   $icon_array[24] =  'sleet.gif';               // imagesleetshowers.visible
   $icon_array[25] =  'snow.gif';                // imagesnow.visible
   $icon_array[26] =  'snow.gif';                // imagesnowmelt.visible
   $icon_array[27] =  'snow.gif';                // imagesnowshowers2.visible
   $icon_array[28] =  'day_clear.gif.gif';       // imagesunny.visible
   $icon_array[29] =  'day_tstorm.gif';          // imagethundershowers.visible
   $icon_array[30] =  'day_tstorm.gif';          // imagethundershowers2.visible
   $icon_array[31] =  'day_tstorm.gif';          // imagethunderstorms.visible
   $icon_array[32] =  'tornado.gif';             // imagetornado.visible
   $icon_array[33] =  'windy.gif';               // imagewindy.visible
   $icon_array[34] =  'day_partly_cloudy.gif';   // stopped raining
   $icon_array[35] =  'windyrain.gif';           // Wind+rain
   $iconnumber = '0';                // icon number

   $current_icon = $icon_array[32]; // name of our condition icon
// ----------------------------------------------------------------------------------
//   $current_summary = 'Dry' . '<br />' . 'Sunny/Dry ';
   $weathercond = 'Dry';
   $Currentsolardescription = 'testtags.php not uploading';
   $current_summary = $Currentsolardescription;
   $current_summary = preg_replace('|^/[^/]+/|','',$current_summary);
   $current_summary = preg_replace('|\\\\|',', ',$current_summary);
   $current_summary = preg_replace('|/|',', ',$current_summary);
//  
//  
$cloudheightfeet =  '4780';	// Estimated cloud base height, feet, (based on dew point, and you height above sea  level...enter
$cloudheightmeters =  '1457';	// Estimated cloud base height, metres, (based on dew point, and you height above sea

// end of stock testtags.txt

// ----------------------------------------------------------------------------------------------------

// begin mchallis tags added to testtags.txt for printable flyer
$maxgsthrtime = '';        // time that the max gust last prior 1 hour occured


$minbaroyest  = '30.087 in.';
$minbaroyestt = '12:43 AM';




$mrecordlowbaro = '29.902';
$mrecordlowbaroday = '2';
$mrecordlowbaromonth = '1';
$mrecordlowbaroyear = '2011';




$yrecordlowbaro = '29.902';
$yrecordlowbaroday = '2';
$yrecordlowbaromonth = '1';
$yrecordlowbaroyear = '2011';

// end mchallis tags added to testtags.txt for printable flyer

// ----------------------------------------------------------------------------------------------------

// begin Webster Weather Live alternative dashboard plugin tags
// Note: duplicated named tags commented out
// Modifications for Webster Weather LIVE's Dashboard Modifications
// NOTE: See instruction and comments for directions
// Add this code in right before the section called
// General OR Non Weather Specific/SUN/MOON in the file
// in your c:\wDisplay\webfiles directory
// ========================================================
$vpissstatus = 'Ok';      // VP ISS Status
$vpreception2 = '96%'; // VP Current reception %  *** NEW IN V1.01
$vpconsolebattery = '4.6'; // VP Console Battery Volts *** NEW IN V1.01
$firewi = '6.4'; // Fire Weather Index
$avtempweek = '53.6';    // Average Weekly Temp
$warmestdayonrecord = '100.8&deg;F  on: Jun 27 2009';  //Warmest Day on Record
$coldestdayonrecord = '39.9&deg;F  on: Dec 09 2009';  //coldest Day on Record
$warmestnightonrecord = '84.2&deg;F  on: Jul 23 2006';  //Warmest Night on Record
$coldestnightonrecord = '31.8&deg;F  on: Jan 14 2007';  //coldest Day on Record
$recordhightemp = '2007.0';   // Record high temp
$recordhightempmonth = '255';   // Record high temp month
$recordhightempday = '0';   // Record high temp day
$recordhightempyear = '2008';   // Record high temp year
$recordlowtemp = '25.2';   // Record low temp
$recordlowtempmonth = '1';   // Record low temp month
$recordlowtempday = '13';   // Record low temp day
$recordlowtempyear = '2007';   // Record low temp year
$recordlowchillmonth = '1';   // Record low temp month
$recordlowchillday = '13';   // Record low temp day
$recordlowchillyear = '2007';   // Record low temp year
$hddday = '11.1';        // Heating Degree for day
$hddmonth = '422.6';    // Heating Degree for month to date
$hddyear = '422.6';    // Heating Degree for year to date
$cddday = '0.0';        // Cooling Degree for day
$cddmonth = '0.0';    // Cooling Degree for month to date
$cddyear = '0.0';    // Cooling Degree for year to date
$minchillweek = '59.3';  // Minimum Wind Chill over past 7 days 
$maxheatweek = '77.5';  // Maximum Heat Index for the Week *** NEW IN V2.00
$recordlowchill = '25.2';  //record low windchill
$airdensity = '1.215';  //air density
$solarnoon = '12:13PM'; // Solar noon
$changeinday = '0:02';  // change in day length since yesterday
// You can comment out the next 6 WU tags if you don't use the Weather Underground Records option
// Snow tags for USA - Comment out if using CM
// Snow tags for Metric - unComment out if using CM
// End of snow tages to change
$etcurrentweek = '0.295'; // ET total for the last 7 days
// 
// NEW TAGS in Version 2.75
//
$sunshinehourstodateday = '04:46';
$sunshinehourstodatemonth = '138:00';
$maxsolarfortime = '597';
$wetbulb = '55.8°F';
//
// NEW TAGS in Version 2.80
// Not needed if not using Lightning display!
//
$lighteningcountlasthour = '0';
$lighteningcountlastminute = '0';
$lighteningcountlast5minutes = '0';
$lighteningcountlast12hour = '0';
$lighteningcountlast30minutes = '0';
$lighteningcountlasttime = '';
$lighteningcountmonth = '0';
$lighteningcountyear = '0';
//  End of Lightning tags
//
//  NEW TAGS IN VERSION 3.00
//
$chandler = '23.8';

//  New tags in Version 4.00
$maxdew = '46.8 °F';
$maxdewt = '11:22 AM';
$mindew = '36.4 °F';
$mindewt = '6:54 AM';
$maxdewyest = '47.3 °F';
$maxdewyestt = '6:11 PM';
$mindewyest = '36.2 °F';
$mindewyestt = '12:00 AM';
$mrecordhighdew = '57.0';
$mrecordhighdewmonth = '1';
$mrecordhighdewday = '13';
$mrecordlowdew = '26.1';
$mrecordlowdewmonth = '1';
$mrecordlowdewday = '10';
$yrecordhighdew = '57.0';
$yrecordhighdewmonth = '1';
$yrecordhighdewday = '13';
$yrecordlowdew = '26.1';
$yrecordlowdewmonth = '1';
$yrecordlowdewday = '10';
$recordhighdew = '119.3';
$recordhighdewyear = '2004';
$recordhighdewmonth = '5';
$recordhighdewday = '26';
$recordlowdew = '-36.8';
$recordlowdewyear = '2004';
$recordlowdewmonth = '2';
$recordlowdewday = '24';
$stationname = 'KCASARAT1';
$raindifffromav = '---';
$raindifffromavyear = '11.827';
$gddmonth = '169.2';
$gddyear = '169.2';

// end of WebsterWeatherLive Alternative Dashboard plugin tags

// ----------------------------------------------------------------------------------------------------

// begin WebsterWeatherLive High/Low/Average plugin page tags
// Note: duplicated tags have been removed
//
// Modifications for Webster Weather Live's Modifications
// NOTE: These are all using US measurements!!
// Add this code in right before the section called
// General OR Non Weather Specific/SUN/MOON in the file
// in your c:\wDisplay\webfiles directory
// Version 1.1 - 17-FEB-2009 Initial Release
// Version 1.2 - 10-MAR-2009 Fixed snow tags for CM measurements
// ========================================================
$recordhighheatindex = '125.6';
$recordhighheatindexmonth = '5';   // Record high heatindex month
$recordhighheatindexday = '26';   // Record high heatindex day
$recordhighheatindexyear = '2004';   // Record high heatindex year 
$recordhighbaromonth = '1';   // Record high baro month
$recordhighbaroday = '7';   // Record high baro day
$recordhighbaroyear = '2007';   // Record high baro year 
$recordlowbaromonth = '255';   // Record low baro month
$recordlowbaroday = '0';   // Record low baro day
$recordlowbaroyear = '2008';   // Record low baro year 
$recorddailyrainmonth = '10';   // Record daily rain month
$recorddailyrainday = '13';   // Record daily rain day
$recorddailyrainyear = '2009';   // Record daily rain year
$recorddailyrain = '5.25'; // Record Daily Rain 
$maxheat = '66.9 °F';
$maxheatt = '12:43 PM'; 
$maxheatyest = '77.5 °F';  
$mrecordhighheatindex = '77.5';
$yrecordhighheatindex = '77.5';
// You can comment out the next 6 lines if you do not use Weather Underground history
// Next 4 Lines are US snow measurements (Comment out if using CM)
// Next 4 lines are METRIC snow measurements (Uncomment to use these)
// End of snow tags to change
$yeartodateavtemp = '49.2'; 
$monthtodateavtemp = '49.2'; 
$maxchillyest = '70.9 °F'; 
$monthtodatemaxgust = '18.4'; 
$recordwindspeed = '27.0'; // All Time Record Avg Wind Speed
$recordwindgust = '62.0'; // All Time Record wind gust
$monthtodateavspeed = '0.3'; // MTD average wind speed
$monthtodateavgust = '0.8'; //MTD average wind gust
$yeartodateavwind = '0.4'; // YTD average wind speed
$yeartodategstwind = '0.9'; // YTD avg wind gust
$lowbaro = '30.211 in.';
$lowbarot = '12:00 AM';
$monthtodatemaxbaro = '30.418'; // MTD average wind speed
$monthtodateminbaro = '29.903'; //MTD average wind gust
$recordhighbaro = '30.567'; // All Time Record Avg Wind Speed
$recordlowbaro = '26.001'; // All Time Record wind gust
$recordhighavwindmonth = '1'; 
$recordhighavwindday = '20';
$recordhighavwindyear = '2010';
$recordhighgustmonth = '1';
$recordhighgustday = '20';
$recordhighgustyear = '2010';
$sunshinehourstodateyear = '138:00'; 
$sunshineyesterday = '07:53';
$mrecordhighsolar = '651.0';  
$yrecordhighsolar = '651.0';
$recordhighsolar = '1348.0'; 
$recordhighsolarmonth = '6'; 
$recordhighsolarday = '13';
$recordhighsolaryear = '2009';
$mrecordhighuv = '3.8';  
$yrecordhighuv = '3.8';
$recordhighuv = '15.2'; 
$recordhighuvmonth = '5'; 
$recordhighuvday = '6';
$recordhighuvyear = '2009';
$avtempsincemidnight = '48.0';
$yesterdayavtemp = '55.4';
$avgspeedsincereset = '0.0';
$maxheatyestt = '1:04 PM';
$recorddayswithrain = '8';
$recorddayswithrainmonth = '1';
$recorddayswithrainday = '29';
$recorddayswithrainyear = '2008';
$mrecorddailyrain = '0.66';
$yrecorddailyrain = '0.66';
$mrecordhighheatindexday = '18';
$mrecordhighheatindexmonth = '1';
$yrecordhighheatindexday = '18';
$yrecordhighheatindexmonth = '1';
$mrecordhighsolarday = '23';
$mrecordhighsolarmonth = '1';
$yrecordhighsolarday = '23';
$yrecordhighsolarmonth = '1';
$mrecordhighuvday = '24';
$mrecordhighuvmonth = '1';
$yrecordhighuvday = '24';
$yrecordhighuvmonth = '1';
$windrunyesterday = '0.15';
$recordhighwindrun = '153.1';
$recordhighwindrunday = '27';
$recordhighwindrunmth = '12';
$recordhighwindrunyr = '2006';
$currentwdet = '0.054';
$yesterdaywdet = '0.054';
$highhum = '90';
$highhumt = '8:17 AM';
$lowhum = '45';
$lowhumt = '12:44 PM';
$maxhumyest = '84';
$maxhumyestt = '8:07 AM';
$minhumyest = '38';
$minhumyestt = '2:56 PM';
$mrecordhighhum = '96';
$mrecordhighhummonth = '1';
$mrecordhighhumday = '3';
$mrecordlowhum = '25';
$mrecordlowhummonth = '1';
$mrecordlowhumday = '24';
$yrecordhighhum = '96';
$yrecordhighhummonth = '1';
$yrecordhighhumday = '3';
$yrecordlowhum = '25';
$yrecordlowhummonth = '1';
$yrecordlowhumday = '24';
$recordhighhum = '100';
$recordhighhumyear = '2004';
$recordhighhummonth = '2';
$recordhighhumday = '24';
$recordlowhum = ' 3';
$recordlowhumyear = '2004';
$recordlowhummonth = '2';
$recordlowhumday = '24';

// 
// Monthly High/low/avg Hometownzone Mod
// You can ship this section if you do not plan
// to use the Monthly.php script 
//
$recordhightempjan = '76.3';
$recordlowtempjan = '30.9';
$avtempjan = '48.1';
$avrainjan = '4.71';
$recordhightempfeb = '70.3';
$recordlowtempfeb = '38.3';
$avtempfeb = '53.4';
$avrainfeb = '4.76';
$recordhightempmar = '85.5';
$recordlowtempmar = '36.0';
$avtempmar = '54.3';
$avrainmar = '2.66';
$recordhightempapr = '84.4';
$recordlowtempapr = '38.3';
$avtempapr = '57.0';
$avrainapr = '1.65';
$recordhightempmay = '88.3';
$recordlowtempmay = '40.6';
$avtempmay = '62.0';
$avrainmay = '0.30';
$recordhightempjun = '95.9';
$recordlowtempjun = '45.7';
$avtempjun = '66.4';
$avrainjun = '0.03';
$recordhightempjul = '91.6';
$recordlowtempjul = '47.7';
$avtempjul = '68.3';
$avrainjul = '0.00';
$recordhightempaug = '104.5';
$recordlowtempaug = '48.4';
$avtempaug = '67.7';
$avrainaug = '0.01';
$recordhightempsep = '99.7';
$recordlowtempsep = '46.2';
$avtempsep = '66.5';
$avrainsep = '0.09';
$recordhightempoct = '93.2';
$recordlowtempoct = '40.3';
$avtempoct = '60.7';
$avrainoct = '1.56';
$recordhightempnov = '84.6';
$recordlowtempnov = '31.6';
$avtempnov = '53.7';
$avrainnov = '1.01';
$recordhightempdec = '67.5';
$recordlowtempdec = '31.3';
$avtempdec = '48.3';
$avraindec = '4.68';

// end of Webster Weather Live tags for High/Low/Average plugin
// ----------------------------------------------------------------------------------------------------
// New WebsterWeatherLive VER 4.10 tags
//----------------------------------------------
$lighteningbearing = '0';
$lighteningdistance = '0';
$lighteningcountlasthournextstorm = '0';
$lighteningcountlastminutenextstorm = '0';
$lighteningcountlast12hournextstorm = '0';
$lighteningcountlast30minutesnextstorm = '0';
$timeofdaygreeting = 'Afternoon';
$avwindlastimediate60 = '-'; // average wind speed
$avwindlastimediate120 = '-'; // average wind speed
$currentmonthaveragerain = '---'; // average rain for current month

// You may need to add the following tags if they are not already in your testtags.txt file
// especially the last few for version 5.00+ 

$avwindlastimediate15 = '-'; // average wind speed
$avwindlastimediate30 = '-'; // average wind speed
$todayhihumidex = '67.3'; //daily high humidex
$todaylohumidex = '37.6'; //Daily low Humidex
//Version 5.02
$dayornight = 'Day'; // Day or night flag

// Modifications for Webster Weather Live's Modifications
// NOTE: These are all using US measurements!!
// Add this code in right before the section called
// General OR Non Weather Specific/SUN/MOON in the file
// in your c:\wDisplay\webfiles directory
// Version 1.1 - 17-FEB-2009 Initial Release
// Version 1.2 - 10-MAR-2009 Fixed snow tags for CM measurements
// ========================================================
// You can comment out the next 6 lines if you do not use Weather Underground history
// Next 4 Lines are US snow measurements (Comment out if using CM)
//$snowseasonin = '0'; // Snow for the Season
//$snowmonthin = '0';  // Snow for the Month
//$snowtodayin = '0.00';  // Snow for Today
//$snownowin = '0';  // Snow Now in Inches
// Next 4 lines are METRIC snow measurements (Uncomment to use these)
// End of snow tags to change

// 
// Monthly High/low/avg Hometownzone Mod
// You can ship this section if you do not plan
// to use the Monthly.php script 
//
//
// Tags for records pages
//
$recordhighrainmth = '13.5';
$recordrainrate = '0.063';
$recorddaysnorain = '163';
$recordhighrainmthmth = '1';
$recordhighrainmthyr = '2008';
$recordrainratemonth = '3';
$recordrainrateday = '3';
$recordrainrateyear = '2009';
$recorddaysnorainmonth = '10';
$recorddaysnorainday = '3';
$recorddaysnorainyear = '2008';
$yrecordhighheatindexyear = '2011';
$ywarmestdayonrecord = '62.2&deg;F  on: Jan 23 2011';
$ywarmestnightonrecord = '55.4&deg;F  on: Jan 14 2011';
$ycoldestdayonrecord = '41.0&deg;F  on: Jan 07 2011';
$ycoldestnightonrecord = '34.5&deg;F  on: Jan 10 2011';
$yrecordhighwindrun = '52.1';
$yrecordhighwindrunmth = '1';
$yrecordhighwindrunday = '1';
$yrecordhighwindrunyr = '2011';
$yrecordhighrainmth = '1.0';
$yrecordrainrate = '0.012';
$yrecorddayswithrain = '1';
$yrecorddaysnorain = ' 9';
$yrecorddailyrainmonth = '1';
$yrecorddailyrainday = '2';
$yrecorddailyrainyear = '2011';
$yrecordhighrainmthmth = '1';
$yrecordhighrainmthyr = '2011';
$yrecordrainratemonth = '1';
$yrecordrainrateday = '2';
$yrecordrainrateyear = '2011';
$yrecorddayswithrainmonth = '1';
$yrecorddayswithrainday = '1';
$yrecorddaysnorainmonth = '1';
$yrecorddaysnorainday = '27';
$yrecordhighdewyear = '2011';
$yrecordlowdewyear = '2011';
$yrecordhighhumyear = '2011';
$yrecordlowhumyear = '2011';
$yrecordhighsolaryear = '2011';
$yrecordhighuvyear = '2011';
$mrecordhighuvyear = '2011';
$mrecordhighheatindexyear = '2011';
$mrecordhighwindrun = '52.1';
$mrecordhighwindrunmth = '1';
$mrecordhighwindrunday = '1';
$mrecordhighwindrunyr = '2011';
$mrecordhighrainmth = '1.0';
$mrecordrainrate = '0.012';
$mrecorddayswithrain = '1';
$mrecorddaysnorain = ' 9';
$mrecorddailyrainmonth = '1';
$mrecorddailyrainday = '2';
$mrecorddailyrainyear = '2011';
$mrecordhighrainmthmth = '1';
$mrecordhighrainmthyr = '2011';
$mrecordrainratemonth = '1';
$mrecordrainrateday = '2';
$mrecordrainrateyear = '2011';
$mrecorddayswithrainmonth = '1';
$mrecorddayswithrainday = '1';
$mrecorddaysnorainmonth = '1';
$mrecorddaysnorainday = '27';
$mrecordhighdewyear = '2011';
$mrecordlowdewyear = '2011';
$mrecordhighhumyear = '2011';
$mrecordlowhumyear = '2011';
$mrecordhighsolaryear = '2011';
// end of testtags.txt/testtags.php
?>
