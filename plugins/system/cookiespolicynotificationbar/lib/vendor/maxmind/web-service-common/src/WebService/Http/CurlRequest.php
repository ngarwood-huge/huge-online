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

namespace MaxMind\WebService\Http;

use MaxMind\Exception\HttpException;

/**
 * This class is for internal use only. Semantic versioning does not not apply.
 *
 * @internal
 */
class CurlRequest implements Request
{
    private $url;
    private $options;

    /**
     * @param $url
     * @param $options
     */
    public function __construct($url, $options)
    {
        $this->url = $url;
        $this->options = $options;
    }

    /**
     * @param $body
     *
     * @return array
     */
    public function post($body)
    {
        $curl = $this->createCurl();

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);

        return $this->execute($curl);
    }

    public function get()
    {
        $curl = $this->createCurl();

        curl_setopt($curl, CURLOPT_HTTPGET, true);

        return $this->execute($curl);
    }

    /**
     * @return resource
     */
    private function createCurl()
    {
        $curl = curl_init($this->url);

        if (!empty($this->options['caBundle'])) {
            $opts[CURLOPT_CAINFO] = $this->options['caBundle'];
        }
        $opts[CURLOPT_SSL_VERIFYHOST] = 2;
        $opts[CURLOPT_FOLLOWLOCATION] = false;
        $opts[CURLOPT_SSL_VERIFYPEER] = true;
        $opts[CURLOPT_RETURNTRANSFER] = true;

        $opts[CURLOPT_HTTPHEADER] = $this->options['headers'];
        $opts[CURLOPT_USERAGENT] = $this->options['userAgent'];
        $opts[CURLOPT_PROXY] = $this->options['proxy'];

        // The defined()s are here as the *_MS opts are not available on older
        // cURL versions
        $connectTimeout = $this->options['connectTimeout'];
        if (defined('CURLOPT_CONNECTTIMEOUT_MS')) {
            $opts[CURLOPT_CONNECTTIMEOUT_MS] = ceil($connectTimeout * 1000);
        } else {
            $opts[CURLOPT_CONNECTTIMEOUT] = ceil($connectTimeout);
        }

        $timeout = $this->options['timeout'];
        if (defined('CURLOPT_TIMEOUT_MS')) {
            $opts[CURLOPT_TIMEOUT_MS] = ceil($timeout * 1000);
        } else {
            $opts[CURLOPT_TIMEOUT] = ceil($timeout);
        }

        curl_setopt_array($curl, $opts);

        return $curl;
    }

    private function execute($curl)
    {
        $body = curl_exec($curl);
        if ($errno = curl_errno($curl)) {
            $errorMessage = curl_error($curl);

            throw new HttpException(
                "cURL error ({$errno}): {$errorMessage}",
                0,
                $this->url
            );
        }

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
        curl_close($curl);

        return [$statusCode, $contentType, $body];
    }
}
