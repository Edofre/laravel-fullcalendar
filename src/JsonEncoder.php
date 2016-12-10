<?php

namespace Edofre\Fullcalendar;

/**
 * Class JsonEncoder
 * Modified from
 * https://github.com/yiisoft/yii2/blob/master/framework/helpers/BaseJson.php
 * @package Edofre\Fullcalendar
 */
class JsonEncoder
{
    /**
     * @param     $value
     * @param int $options
     * @return string
     */
    public static function encode($value, $options = 0)
    {
        $expressions = [];
        $value = static::processData($value, $expressions, uniqid('', true));
        $json = json_encode($value, $options);
        return $expressions === [] ? $json : strtr($json, $expressions);
    }

    /**
     * @param $data
     * @param $expressions
     * @param $expPrefix
     * @return array|\stdClass|string
     */
    protected static function processData($data, &$expressions, $expPrefix)
    {
        if (is_object($data)) {
            if ($data instanceof JsExpression) {
                $token = "!{[$expPrefix=" . count($expressions) . ']}!';
                $expressions['"' . $token . '"'] = $data->expression;
                return $token;
            } else {
                $result = [];
                foreach ($data as $name => $value) {
                    $result[$name] = $value;
                }
                $data = $result;
            }
            if ($data === []) {
                return new \stdClass();
            }
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value) || is_object($value)) {
                    $data[$key] = static::processData($value, $expressions, $expPrefix);
                }
            }
        }
        return $data;
    }
}