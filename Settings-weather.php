<?php
#
# modification note - modified for weewx-wd support using a WE type
#     vinceskahan@gmail.com
#
# (original header follows)
############################################################################
# A Project of TNET Services, Inc. and Saratoga-Weather.org (WD-World-ML template set)
############################################################################
#
#	Project:	Sample Included Website Design
#	Module:		Settings-weather.php
#	Purpose:	Provides the Site Settings Used Throughout the Site
# 	Authors:	Kevin W. Reed <kreed@tnet.com>
#				TNET Services, Inc.
#               Ken True <webmaster@saratoga-weather.org>
#               Saratoga-Weather.org
#
# 	Copyright:	(c) 1992-2007 Copyright TNET Services, Inc.
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
#	This document uses Tab 4 Settings
############################################################################
global $SITE;
#---------------------------------------------------------------------------
#  required settings for Weather-Display software
#---------------------------------------------------------------------------
$SITE['WXtags']			= 'testtags.php';  // for weather variables .. we're using the old name instead of WDtags.php
$SITE['ajaxScript']     = 'ajaxWDwx.js'; // for AJAX enabled display
$SITE['clientrawfile']  = 'clientraw.txt';  // directory and name of Weather-Display realtime.txt file
$SITE['graphImageDir']  = './';  // directory location for graph images with trailing /
# wxhistory.php settings
$SITE['HistoryStartYear'] = '2000';  // start year for station operation
$SITE['HistoryFilesDir']  = './';    // directory location for the [month][year].htm history files
$SITE['HistoryGraphsDir'] = './';    // directory location for the YYYYMMDD.gif graphic daily report files
# Weather Station sensors and options for dashboard
$SITE['DavisVP']		= true;  // set to false if not a Davis VP weather station
$SITE['UV']				= true;  // set to false if no UV sensor
$SITE['SOLAR']			= true;  // set to false if no Solar sensor
$SITE['showSnow']		= true;   // set to false if snow not recorded on WD
$SITE['showSnowTemp'] 	= 4;	  // show snow instead of rain if temp (C) is <= this amount
##########################################################################
# end of configurable settings
#
// do NOT change these
$SITE['WXsoftware']     = 'WE';
$SITE['WXsoftwareURL'] = 'http://www.weewx.com/';
$SITE['WXsoftwareLongName'] = 'Weewx';
$SITE['ajaxDashboard'] = './ajax-dashboard.php';
$SITE['trendsPage']     = 'WE-trends-inc.php'; // WE-specific trends page
$SITE['NOAAdir']     = $SITE['HistoryFilesDir']; // to permit reusing WV noaa scripts
?>
