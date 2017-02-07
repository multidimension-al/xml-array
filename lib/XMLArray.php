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

namespace Multidimensional\XmlArray;

class XMLArray {
        
    /**
     * @param string $xml
     * @return array
     */
    public function generateArray(string $string)
    {        
        $xml = simplexml_load_string($string);
        $json = json_encode($xml);

        return (array) json_decode($json, TRUE);        
    }    
}