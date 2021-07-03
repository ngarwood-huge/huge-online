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

namespace MaxMind\Db\Reader;

class Util
{
    public static function read($stream, $offset, $numberOfBytes)
    {
        if ($numberOfBytes === 0) {
            return '';
        }
        if (fseek($stream, $offset) === 0) {
            $value = fread($stream, $numberOfBytes);

            // We check that the number of bytes read is equal to the number
            // asked for. We use ftell as getting the length of $value is
            // much slower.
            if (ftell($stream) - $offset === $numberOfBytes) {
                return $value;
            }
        }
        throw new InvalidDatabaseException(
            'The MaxMind DB file contains bad data'
        );
    }
}
