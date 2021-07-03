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

namespace MaxMind\Exception;

/**
 * Thrown when a MaxMind web service returns an error relating to the request.
 */
class InvalidRequestException extends HttpException
{
    /**
     * The code returned by the MaxMind web service.
     */
    private $error;

    /**
     * @param string     $message    the exception message
     * @param int        $error      the error code returned by the MaxMind web service
     * @param int        $httpStatus the HTTP status code of the response
     * @param string     $uri        the URI queries
     * @param \Exception $previous   the previous exception, if any
     */
    public function __construct(
        $message,
        $error,
        $httpStatus,
        $uri,
        \Exception $previous = null
    ) {
        $this->error = $error;
        parent::__construct($message, $httpStatus, $uri, $previous);
    }

    public function getErrorCode()
    {
        return $this->error;
    }
}
