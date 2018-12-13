<?php

declare(strict_types = 1);

namespace App\Exceptions;

use Exception;

/**
 * Class ApiDataException
 * @package App\Exceptions
 */
class ApiDataException extends Exception
{
    /**
     *
     */
    const CODE_NO_DATA = 1001;

    /**
     * @return ApiDataException
     */
    public static function noData(): ApiDataException
    {
        return new self('No data found', self::CODE_NO_DATA);
    }
}
