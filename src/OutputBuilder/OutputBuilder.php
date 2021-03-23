<?php

namespace Faridevnz\OutputBuilder;

use Faridevnz\Enums\InputType;
use Faridevnz\Enums\ErrorStrings;
use JetBrains\PhpStorm\NoReturn;

class OutputBuilder
{

    public static $code;
    public static $data;

    #[NoReturn] public static function build(array $dto = null, $InputType = InputType::LIST )
    {
        $data = OutputBuilder::_filter(OutputBuilder::$data, $dto, $InputType);
        ( OutputBuilder::$code >= 200 && OutputBuilder::$code < 300 )
            ? OutputBuilder::_buildSuccess($data)
            : OutputBuilder::_buildError();
    }

    public static function buildPaginated( array $dto = null, $InputType = InputType::LIST )
    {
        $data = OutputBuilder::$data;
        if ( !isset($data) ) return;
        $data['data'] = OutputBuilder::_filter($data['data'], $dto, $InputType);
        ( OutputBuilder::$code >= 200 && OutputBuilder::$code < 300 )
            ? OutputBuilder::_buildSuccess($data)
            : OutputBuilder::_buildError();
    }

    #[NoReturn] private static function _buildSuccess(array $data )
    {
        print_r(json_encode([
            'data' => $data,
            'code' => OutputBuilder::$code
        ]));
        die();
    }

    #[NoReturn] private static function _buildError()
    {
        $code = OutputBuilder::$code;
        $message = ['code' => $code, 'description' => ErrorStrings::get($code)];
        print_r(json_encode([
            'data' => $message,
            'code' => OutputBuilder::$code
        ]));
        die();
    }

    public static function _filter( array|null $data, array $dto = null, string $InputType = InputType::LIST )
    {
        if ( $InputType === InputType::ITEM ) $data = [ $data ];
        if ( !isset($dto) ) return $data;
        if ( !isset($data) ) return [];
        $result = [];
        foreach ($data as $item) {
            $result[] = OutputBuilder::_filterArray($dto, $item ?? []);
        }
        if ( $InputType === InputType::ITEM ) $result = $result[0];
        return $result;
    }

    private static function _filterArray( array $dto, array $data ): array
    {
        // if is an empty array then return all items
        if ( empty($dto) ) return $data;
        // else
        $array = array_intersect_key($data, $dto);
        foreach ( $array as $key => $value ) {
            // recursive call
            if ( is_array($value) ) $array[$key] = OutputBuilder::_filterArray($dto[$key], $value);
        }
        return $array;
    }

}
