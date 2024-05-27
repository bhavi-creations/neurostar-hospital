<?php

/**
 * FieldElement
 *
 * PHP version 5
 *
 * @category  File
 * @package   ASN1
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2016 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */
namespace ElementskitVendor\phpseclib3\File\ASN1\Maps;

use ElementskitVendor\phpseclib3\File\ASN1;
/**
 * FieldElement
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class FieldElement
{
    const MAP = ['type' => ASN1::TYPE_OCTET_STRING];
}
