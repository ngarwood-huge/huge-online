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

namespace GeoIp2\Record;

abstract class AbstractRecord implements \JsonSerializable
{
    private $record;

    /**
     * @ignore
     *
     * @param mixed $record
     */
    public function __construct($record)
    {
        $this->record = isset($record) ? $record : [];
    }

    /**
     * @ignore
     *
     * @param mixed $attr
     */
    public function __get($attr)
    {
        // XXX - kind of ugly but greatly reduces boilerplate code
        $key = $this->attributeToKey($attr);

        if ($this->__isset($attr)) {
            return $this->record[$key];
        } elseif ($this->validAttribute($attr)) {
            if (preg_match('/^is_/', $key)) {
                return false;
            }

            return null;
        }
        throw new \RuntimeException("Unknown attribute: $attr");
    }

    public function __isset($attr)
    {
        return $this->validAttribute($attr) &&
             isset($this->record[$this->attributeToKey($attr)]);
    }

    private function attributeToKey($attr)
    {
        return strtolower(preg_replace('/([A-Z])/', '_\1', $attr));
    }

    private function validAttribute($attr)
    {
        return in_array($attr, $this->validAttributes, true);
    }

    public function jsonSerialize()
    {
        return $this->record;
    }
}
