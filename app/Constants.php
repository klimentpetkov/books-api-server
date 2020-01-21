<?php
namespace App;

class Constants {
    const SUCCESS = 'success';
    const ERROR = 'error';
    const VALIDATION_ERROR = 'Validation error';
    const RESOURCE_SAVED = 'Resource saved';
    const RESOURCE_NOT_SAVED = 'Resource not saved';
    const RESOURCE_NOT_FOUND = 'The resource does not exist';
    const RESOURCE_DELETED = 'Resource deleted successfully';
    const USER_LOGGED_OUT = 'User logged out';
    const UNATHENTICATED = 'Unauthenticated';
    const UNAUTHORIZED = 'Unauthorized';
    const LOCATION_NOT_FOUND = 'No such location';
    const TOKEN_INVALID = 'Token is invalid';
    const TOKEN_EXPIRED = 'Token is expired';
    const TOKEN_PROBLEM = 'Token has some problem';
    const ACCESS_DENIED = 'ACCESS DENIED';

    const STATUS_OK = 200;
    const STATUS_OBJECT_CREATED = 201;
    const STATUS_NO_CONTENT = 204;          //Action executed properly but no content to return
    const STATUS_PARTIAL_CONTENT = 206;     // Paginated lists
    const STATUS_BAD_REQUEST = 400;         // Validation failed
    const STATUS_UNAUTHORIZED = 401;        // User need to be authenticated;
    const STATUS_FORBIDDEN = 403;           // Authenticated, but does not have permission to perform the action
    const STATUS_NOT_FOUND = 404;           // Resource is not found
    const STATUS_SERVER_ERROR = 500;        // Server error. If something unexpectedly breaks
    const STATUS_SERVICE_UNAVAILABLE = 503; //
}
