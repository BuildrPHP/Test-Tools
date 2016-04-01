<?php namespace BuildR\TestTools\Exception;


use BuildR\Foundation\Exception\Exception;

class XMLDataSetParsingException extends Exception {

    const MESSAGE_XPATH_NO_RESULT = 'This test group cannot be found in your definition file! Query: %s!';

    public static function noResult($nodeName) {
        return self::createByFormat(self::MESSAGE_XPATH_NO_RESULT, [$nodeName]);
    }

}
