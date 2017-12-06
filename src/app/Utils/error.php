<?php
/**
 * Error Class.
 * User: pushkar
 * Date: 12/7/17
 * Time: 1:13 AM
 */

namespace App\Utils;

use App\Exceptions\InternalServerException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class error
{
    // Keys of errors
    const USER_EXISTS = "userExists";
    const ERROR_WHILE_ERROR = "errorWhileError";
    const USER_NOT_FOUND = "userNotFound";
    const VALIDATION_FAILED = "validationFailed";
    const ALREADY_LOGGED_IN = "alreadyLoggedIn";
    const FORBIDDEN = "forbidden";
    const CSRF_TOKEN_MISMATCH = "csrfTokenMismatch";
    const SESSION_EXPIRED = "sessionExpired";

    /**
     * Contains all error code and description for each key.
     * @var array
     */
    private static $error = array(
        // User errors
        self::USER_EXISTS           => array("code" => 1000, "message" => "User already registered"),
        self::USER_NOT_FOUND        => array("code" => 1001, "message" => "User not found"),
        self::ALREADY_LOGGED_IN     => array("code" => 1004, "message" => "This action cannot be performed by logged in user"),

        // General errors
        self::VALIDATION_FAILED     => array("code" => 1100, "message" => "Validation Failed. Please check request."),
        self::FORBIDDEN             => array("code" => 1101, "message" => "User not authorized to make this call"),
        self::CSRF_TOKEN_MISMATCH   => array("code" => 1102, "message" => "Invalid CSRF Token"),
        self::SESSION_EXPIRED       => array("code" => 1103, "message" => "Session Expired. Login again."),

        // These errors should never happen!
        // Its over 9000! :P
        self::ERROR_WHILE_ERROR     => array("code" => 9000, "message" => "Error occurred while reporting error")
    );
    /**
     * Returns code for error key
     *
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public static function getErrorCode($key) {
        if (array_has(self::$error, $key)) {
            return self::$error[$key]["code"];
        } else {
            throw new \Exception(self::$error[self::ERROR_WHILE_ERROR]["message"], array(), self::$error[self::ERROR_WHILE_ERROR]["code"]);
        }
    }

    /**
     * Returns error message for key.
     *
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public static function getErrorMessage($key) {
        if (array_has(self::$error, $key)) {
            return self::$error[$key]["message"];
        } else {
            throw new \Exception(self::$error[self::ERROR_WHILE_ERROR]["message"], array(), self::$error[self::ERROR_WHILE_ERROR]["code"]);
        }
    }

    /**
     * Creates a bad request exception for given error key.
     *
     * @param $key
     * @return BadRequestHttpException
     * @throws \Exception
     */
    public static function getBadRequestException($key) {
        if (array_has(self::$error, $key)) {
            return new BadRequestHttpException(self::$error[$key]["message"], null, self::$error[$key]["code"]);
        } else {
            throw new \Exception(self::$error[self::ERROR_WHILE_ERROR]["message"], array(), self::$error[self::ERROR_WHILE_ERROR]["code"]);
        }
    }

    /**
     * Creates 404 not found error for given error key.
     *
     * @param $key
     * @return NotFoundHttpException
     * @throws \Exception
     */
    public static function getNotFountException($key) {
        if (array_has(self::$error, $key)) {
            return new NotFoundHttpException(self::$error[$key]["message"], null, self::$error[$key]["code"]);
        } else {
            throw new \Exception(self::$error[self::ERROR_WHILE_ERROR]["message"], array(), self::$error[self::ERROR_WHILE_ERROR]["code"]);
        }
    }

    /**
     * Creates 500 internal server error for given error key.
     *
     * @param $key
     * @return InternalServerException
     * @throws \Exception
     */
    public static function getInternalServerException($key) {
        if (array_has(self::$error, $key)) {
            return new InternalServerException(self::$error[$key]["message"], self::$error[$key]["code"]);
        } else {
            throw new \Exception(self::$error[self::ERROR_WHILE_ERROR]["message"], array(), self::$error[self::ERROR_WHILE_ERROR]["code"]);
        }
    }

    /**
     * Creates 401 authorization error for given error key.
     *
     * @param $key
     * @return AuthorizationException
     * @throws \Exception
     */
    public static function getAuthorizationException($key) {
        if (array_has(self::$error, $key)) {
            return new AuthorizationException(self::$error[$key]["message"], self::$error[$key]["code"]);
        } else {
            throw new \Exception(self::$error[self::ERROR_WHILE_ERROR]["message"], array(), self::$error[self::ERROR_WHILE_ERROR]["code"]);
        }
    }
}