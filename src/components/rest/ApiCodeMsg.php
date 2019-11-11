<?php

namespace myzero1\restbyconf\components\rest;

class ApiCodeMsg
{
    const SUCCESS = 735200;
    const SUCCESS_MSG = 'Ok';
    const BAD_REQUEST = 735400;
    const BAD_REQUEST_MSG = 'Bad Request';
    const UNAUTHORIZED = 735401;
    const UNAUTHORIZED_MSG = 'Unauthorized';
    const FORBIDDEN = 735403;
    const FORBIDDEN_MSG = 'Forbidden';
    const NOT_FOUND = 735404;
    const NOT_FOUND_MSG = 'Not Found';
    const INTERNAL_SERVER = 735500;
    const INTERNAL_SERVER_MSG = 'Internal Server Error';
    const UNKNOWN_ERROR= 735735;
    const UNKNOWN_ERROR_MSG = 'Unknown';
    const DB_BAD_REQUEST= 735440;
    const DB_BAD_REQUEST_MSG = 'Database storage validation error';
}
