<?php
/**
 *      __  ___      ____  _     ___                           _                    __
 *     /  |/  /_  __/ / /_(_)___/ (_)___ ___  ___  ____  _____(_)___  ____   ____ _/ /
 *    / /|_/ / / / / / __/ / __  / / __ `__ \/ _ \/ __ \/ ___/ / __ \/ __ \ / __ `/ /
 *   / /  / / /_/ / / /_/ / /_/ / / / / / / /  __/ / / (__  ) / /_/ / / / // /_/ / /
 *  /_/  /_/\__,_/_/\__/_/\__,_/_/_/ /_/ /_/\___/_/ /_/____/_/\____/_/ /_(_)__,_/_/
 *
 *  @author Multidimension.al
 *  @copyright Copyright © 2016-2017 Multidimension.al - All Rights Reserved
 *  @license Proprietary and Confidential
 *
 *  NOTICE:  All information contained herein is, and remains the property of
 *  Multidimension.al and its suppliers, if any.  The intellectual and
 *  technical concepts contained herein are proprietary to Multidimension.al
 *  and its suppliers and may be covered by U.S. and Foreign Patents, patents in
 *  process, and are protected by trade secret or copyright law. Dissemination
 *  of this information or reproduction of this material is strictly forbidden
 *  unless prior written permission is obtained.
 */

namespace Multidimensional\XmlArray\Test;

use Multidimensional\XmlArray\XMLArray;
use PHPUnit\Framework\TestCase;

class XMLArrayTest extends TestCase
{
 
    public function testSimple()
    {
        $string = '<simple>true</simple>';
        $result = XMLArray::generateArray($string);
        $expected = [0 => 'true'];
        $this->assertEquals($expected, $result);
    }
 
    public function testComplex()
    {
        $string = '<person><firstname>Test</firstname><lastname>Man</lastname><address><street>123 Fake St</street><city>Springfield</city><state>USA</state></address></person>';
        $result = XMLArray::generateArray($string);
        $expected = ['firstname' => 'Test', 'lastname' => 'Man', 'address' => ['street' => '123 Fake St', 'city' => 'Springfield', 'state' => 'USA']];
        $this->assertEquals($expected, $result);
    }
    
    public function testAttributes()
    {
        $string = '<xml><person ID="1"><firstname>Test</firstname><lastname>Man</lastname><address><street>123 Fake St</street><city>Springfield</city><state>USA</state></address></person></xml>';
        $result = XMLArray::generateArray($string);
        $expected = ['person' => ['firstname' => 'Test', 'lastname' => 'Man', 'address' => ['street' => '123 Fake St', 'city' => 'Springfield', 'state' => 'USA'], '@ID' => '1']];
        $this->assertEquals($expected, $result);
    }

    public function testComplexWithAttributes()
    {
        $string = '<?xml version="1.0" encoding="UTF-8"?><xml><person ID="1"><name>John Smith</name></person><person ID="2"><name>Jane Smith</name></person></xml>';
        $result = XMLArray::generateArray($string);
        $expected = ['person' => [0 => ['@ID' => '1', 'name' => 'John Smith'], 1 => ['@ID' => '2', 'name' => 'Jane Smith']]];
        $this->assertEquals($expected, $result);
    }
    
    public function testFalse()
    {
        $string = '';
        $result = XMLArray::generateArray($string);
        $this->assertFalse($result);
    }
    
    public function testNull()
    {
        $string = null;
        $result = XMLArray::generateArray($string);
        $this->assertFalse($result);
    }
}
