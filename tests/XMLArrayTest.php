<?php
/**
 * CONFIDENTIAL
 *
 * © 2017 Multidimension.al - All Rights Reserved
 * 
 * NOTICE:  All information contained herein is, and remains
 * the property of Multidimension.al and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Multidimension.al and its suppliers
 * and may be covered by U.S. and Foreign Patents, patents in
 * process, and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained.
 */

namespace Multidimensional\XmlArray\Test;

use Multidimensional\XmlArray;
use PHPUnit_Framework_TestCase;

class XMLArrayTest extends TestCase
{
 
    public function testSimple()
    {
        $string = '<simple>true</simple>';
        $result = (new XMLArray)->generateArray($string);
        $expected = array (0 => 'true',);
        $this->assertEquals($result, $expected);
    }
 
    public function testComplex()
    {
        $string = '<person><firstname>Test</firstname><lastname>Man</lastname><address><street>123 Fake St</street><city>Springfield</city><state>USA</state></address></person>'; 
        $result = (new XMLArray)->generateArray($string);
        $expected = array ('firstname' => 'Test', 'lastname' => 'Man', 'address' => array ('street' => '123 Fake St', 'city' => 'Springfield', 'state' => 'USA',),);
        $this->assertEquals($result, $expected);
    }
    
    public function testFalse()
    {
        $string = ''; 
        $result = (new XMLArray)->generateArray($string);
        $this->assertFalse($result);
    }
    
    public function testNull()
    {
        $string = null; 
        $result = (new XMLArray)->generateArray($string);
        $this->assertFalse($result);    
    }
}