<?php
/**
 * User: qbhy
 * Date: 2019/1/16
 * Time: 上午10:59
 */

namespace Qbhy\BaiduAIP\Kernel;


class AipSignOption
{
    const EXPIRATION_IN_SECONDS = 'expirationInSeconds';

    const HEADERS_TO_SIGN = 'headersToSign';

    const TIMESTAMP = 'timestamp';

    const DEFAULT_EXPIRATION_IN_SECONDS = 1800;

    const MIN_EXPIRATION_IN_SECONDS = 300;

    const MAX_EXPIRATION_IN_SECONDS = 129600;
}