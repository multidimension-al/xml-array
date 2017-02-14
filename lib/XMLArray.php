<?php
/**    __  ___      ____  _     ___                           _                    __
 *    /  |/  /_  __/ / /_(_)___/ (_)___ ___  ___  ____  _____(_)___  ____   ____ _/ /
 *   / /|_/ / / / / / __/ / __  / / __ `__ \/ _ \/ __ \/ ___/ / __ \/ __ \ / __ `/ / 
 *  / /  / / /_/ / / /_/ / /_/ / / / / / / /  __/ / / (__  ) / /_/ / / / // /_/ / /  
 * /_/  /_/\__,_/_/\__/_/\__,_/_/_/ /_/ /_/\___/_/ /_/____/_/\____/_/ /_(_)__,_/_/   
 *                                                                                  
 * CONFIDENTIAL
 *
 * © 2017 Multidimension.al - All Rights Reserved
 * 
 * NOTICE:  All information contained herein is, and remains the property of
 * Multidimension.al and its suppliers, if any.  The intellectual and
 * technical concepts contained herein are proprietary to Multidimension.al
 * and its suppliers and may be covered by U.S. and Foreign Patents, patents in
 * process, and are protected by trade secret or copyright law. Dissemination
 * of this information or reproduction of this material is strictly forbidden
 * unless prior written permission is obtained.
 */

namespace Multidimensional\XmlArray;

class XMLArray {
        
    /**
     * @param string $xml
     * @return array
     */
    public function generateArray($string)
    {        
        $xml = simplexml_load_string($string);
        $json = json_encode($xml);
		$array = (array) json_decode($json, TRUE);
		$array = $this->convertAttributes($array);		
        return $array;
    }
	
	/**
	 * @param array $array
	 * @return array
	 */
	private function convertAttributes($array = [])
	{
		foreach ($array AS $key => $value) {
			if(isset($value['@attributes'])) {
				foreach ($value['@attributes'] AS $key2 => $value2) {
					$array[$key]['@'.$key2] = $value2;	
				}
				unset($array[$key]['@attributes']);	
			}
		}
		
		return $array;	
	}
}