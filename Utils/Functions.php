<?php

namespace Utils;

class Functions {
    public static function sortByAttribute(array $arr, string $methodName, ?string $reverse = null) : array
    {
        if (count($arr) == 1 ) {
            return $arr;
        }

        else {
            $result = [];
            foreach($arr as $item) {
                $result[$item->$methodName()] = $item;
            }

            if ($reverse == 'r' || $reverse) {
                rsort($result);
            }
            ksort($result);
            return $result;
        }
    } // sortByAttribute

    public static function sortByKeyValue(array $arr, string $key, ?string $reverse = null) : array
    {
        if (count($arr) == 1 ) {
            return $arr;
        }

        else {
            $result = [];
            foreach($arr as $tab) {
                array_push($result, $tab[$key]);
            }

            if ($reverse == 'r' || $reverse) {
                rsort($result);
            }
            ksort($result);
            return $result;
        }
    } // KeyValue
} // Functions