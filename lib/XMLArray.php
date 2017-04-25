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

namespace Multidimensional\XmlArray;

class XMLArray
{
        
    /**
     * @param string $xml
     * @return array
     */
    public static function generateArray($string)
    {
        $xml = simplexml_load_string($string);
        $json = json_encode($xml);
        $array = json_decode($json, true);
        $array = self::convertAttributes($array);
        return $array;
    }
    
    /**
     * @param array $array
     * @return array
     */
    private static function convertAttributes($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (isset($value['@attributes'])) {
                    foreach ($value['@attributes'] as $key2 => $value2) {
                        $array[$key]['@'.$key2] = $value2;
                    }
                    unset($array[$key]['@attributes']);
                } elseif (is_array($value)) {
                    $array[$key] = self::convertAttributes($value);
                }
            }
        }
        
        return $array;
    }
}
