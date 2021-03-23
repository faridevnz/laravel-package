<?php


namespace Faridevnz\Enums;


use JetBrains\PhpStorm\Pure;

class ErrorStrings
{
    private const _400 = 'Bad Request';
    private const _401 = 'Unauthorized';
    private const _402 = 'Payment Required';
    private const _403 = 'Forbidden';
    private const _404 = 'Not Found';
    private const _405 = 'Method Not Allowed';
    private const _406 = 'Not Acceptable';
    private const _407 = 'Proxy Authentication Required';
    private const _408 = 'Request Timeout';
    private const _409 = 'Conflict';
    private const _410 = 'Gone';
    private const _411 = 'Length Required';
    private const _412 = 'Precondition Failed';
    private const _413 = 'Request Entity Too Large';
    private const _414 = 'Request-URI Too Long';
    private const _415 = 'Unsupported Media Type';
    private const _416 = 'Requested Range Not Satisfiable';
    private const _417 = 'Expectation Failed';
    private const _418 = 'I\'m a teapot';
    private const _421 = 'Misdirected Request';
    private const _422 = 'Unprocessable Entity';
    private const _423 = 'Locked';
    private const _426 = 'Upgrade Required';
    private const _428 = 'Precondition Required';
    private const _431 = 'Request Header Fields Too Large';
    private const _425 = 'Unavailable For Legal Reasons';

    /**
     *  @param int|null $constantName
     *  @return string|null - constant value
     */
    #[Pure] public static function get(int|null $constantName): string|null
    {
        if ( !defined('self::_' . $constantName) ) return null;
        return constant('self::_' . $constantName);
    }
}
