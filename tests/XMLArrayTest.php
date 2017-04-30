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
        $expected = ['simple' => [0 => 'true']];
        $this->assertEquals($expected, $result);
    }
 
    public function testComplex()
    {
        $string = '<person><firstname>Test</firstname><lastname>Man</lastname><address><street>123 Fake St</street><city>Springfield</city><state>USA</state></address></person>';
        $result = XMLArray::generateArray($string);
        $expected = ['person' => ['firstname' => 'Test', 'lastname' => 'Man', 'address' => ['street' => '123 Fake St', 'city' => 'Springfield', 'state' => 'USA']]];
        $this->assertEquals($expected, $result);
    }

    public function testStandardAttributes()
    {
        $string = '<xml><person ID="1"><firstname>Test</firstname><lastname>Man</lastname><address><street>123 Fake St</street><city>Springfield</city><state>USA</state></address></person></xml>';
        $result = XMLArray::generateArray($string, false);
        $expected = ['xml' => ['person' => ['firstname' => 'Test', 'lastname' => 'Man', 'address' => ['street' => '123 Fake St', 'city' => 'Springfield', 'state' => 'USA'], '@attributes' => ['ID' => '1']]]];
        $this->assertEquals($expected, $result);
    }

    public function testAttributes()
    {
        $string = '<xml><person ID="1"><firstname>Test</firstname><lastname>Man</lastname><address><street>123 Fake St</street><city>Springfield</city><state>USA</state></address></person></xml>';
        $result = XMLArray::generateArray($string);
        $expected = ['xml' => ['person' => ['firstname' => 'Test', 'lastname' => 'Man', 'address' => ['street' => '123 Fake St', 'city' => 'Springfield', 'state' => 'USA'], '@ID' => '1']]];
        $this->assertEquals($expected, $result);
    }

    public function testComplexWithAttributes()
    {
        $string = '<?xml version="1.0" encoding="UTF-8"?><xml><person ID="1"><name>John Smith</name></person><person ID="2"><name>Jane Smith</name></person></xml>';
        $result = XMLArray::generateArray($string);
        $expected = ['xml' => ['person' => [0 => ['@ID' => '1', 'name' => 'John Smith'], 1 => ['@ID' => '2', 'name' => 'Jane Smith']]]];
        $this->assertEquals($expected, $result);
    }

    public function testMoreComplexAttributes()
    {
        $string = '<?xml version="1.0" encoding="UTF-8"?><RateV4Response><Package ID="123"><ZipOrigination>20500</ZipOrigination><ZipDestination>90210</ZipDestination><Pounds>0</Pounds><Ounces>32</Ounces><Size>REGULAR</Size><Machinable>TRUE</Machinable><Zone>8</Zone><Postage CLASSID="1"><MailService>Priority Mail 2-Day&lt;sup&gt;&#8482;&lt;/sup&gt;</MailService><Rate>12.75</Rate></Postage><Postage CLASSID="22"><MailService>Priority Mail 2-Day&lt;sup&gt;&#8482;&lt;/sup&gt; Large Flat Rate Box</MailService><Rate>18.85</Rate></Postage><Postage CLASSID="17"><MailService>Priority Mail 2-Day&lt;sup&gt;&#8482;&lt;/sup&gt; Medium Flat Rate Box</MailService><Rate>13.60</Rate></Postage><Postage CLASSID="28"><MailService>Priority Mail 2-Day&lt;sup&gt;&#8482;&lt;/sup&gt; Small Flat Rate Box</MailService><Rate>7.15</Rate></Postage></Package></RateV4Response>';
        $result = XMLArray::generateArray($string);
        $expected = ['RateV4Response' => ['Package' => ['@ID' => '123', 'ZipOrigination' => '20500', 'ZipDestination' => '90210', 'Pounds' => '0', 'Ounces' => '32', 'Size' => 'REGULAR', 'Machinable' => 'TRUE', 'Zone' => '8', 'Postage' => [0 => ['@CLASSID' => '1', 'MailService' => 'Priority Mail 2-Day<sup>™</sup>', 'Rate' => '12.75'], 1 => ['@CLASSID' => '22', 'MailService' => 'Priority Mail 2-Day<sup>™</sup> Large Flat Rate Box', 'Rate' => '18.85'], 2 => ['@CLASSID' => '17', 'MailService' => 'Priority Mail 2-Day<sup>™</sup> Medium Flat Rate Box', 'Rate' => '13.60'], 3 => ['@CLASSID' => '28', 'MailService' => 'Priority Mail 2-Day<sup>™</sup> Small Flat Rate Box', 'Rate' => '7.15']]]]];
        $this->assertEquals($expected, $result);
    }
    
    public function testFalse()
    {
        $string = '';
        $result = XMLArray::generateArray($string);
        $this->assertNull($result);
    }
    
    public function testNull()
    {
        $string = null;
        $result = XMLArray::generateArray($string);
        $this->assertNull($result);
    }
}
