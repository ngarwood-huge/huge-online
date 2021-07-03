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

namespace GeoIp2\Model;

/**
 * This class provides the GeoLite2 ASN model.
 *
 * @property-read int|null $autonomousSystemNumber The autonomous system number
 *     associated with the IP address.
 * @property-read string|null $autonomousSystemOrganization The organization
 *     associated with the registered autonomous system number for the IP
 *     address.
 * @property-read string $ipAddress The IP address that the data in the model is
 *     for.
 */
class Asn extends AbstractModel
{
    protected $autonomousSystemNumber;
    protected $autonomousSystemOrganization;
    protected $ipAddress;

    /**
     * @ignore
     *
     * @param mixed $raw
     */
    public function __construct($raw)
    {
        parent::__construct($raw);
        $this->autonomousSystemNumber = $this->get('autonomous_system_number');
        $this->autonomousSystemOrganization =
            $this->get('autonomous_system_organization');
        $this->ipAddress = $this->get('ip_address');
    }
}
