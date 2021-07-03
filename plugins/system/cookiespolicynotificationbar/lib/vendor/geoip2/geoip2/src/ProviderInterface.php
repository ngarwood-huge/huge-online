<?php
/* ======================================================
 # Cookies Policy Notification Bar for Joomla! - v4.0.7 (pro version)
 # -------------------------------------------------------
 # For Joomla! CMS
 # Author: Web357 (Yiannis Christodoulou)
 # Copyright (©) 2014-2021 Web357. All rights reserved.
 # License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
 # Website: https:/www.web357.
 # Demo: https://demo.web357.com/joomla/browse/cookies-policy-notification-bar
 # Support: support@web357.com
 # Last modified: Monday 03 May 2021, 08:04:11 PM
 ========================================================= */

namespace GeoIp2;

interface ProviderInterface
{
    /**
     * @param string $ipAddress an IPv4 or IPv6 address to lookup
     *
     * @return \GeoIp2\Model\Country a Country model for the requested IP address
     */
    public function country($ipAddress);

    /**
     * @param string $ipAddress an IPv4 or IPv6 address to lookup
     *
     * @return \GeoIp2\Model\City a City model for the requested IP address
     */
    public function city($ipAddress);
}
