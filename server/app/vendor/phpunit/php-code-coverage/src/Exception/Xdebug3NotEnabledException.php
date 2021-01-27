<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-fpm-code-coverage.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeCoverage\Driver;

use RuntimeException;
use SebastianBergmann\CodeCoverage\Exception;

final class Xdebug3NotEnabledException extends RuntimeException implements Exception
{
    public function __construct()
    {
        parent::__construct('XDEBUG_MODE=coverage or xdebug.mode=coverage has to be set');
    }
}
