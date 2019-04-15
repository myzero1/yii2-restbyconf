<?php

namespace myzero1\restbyconf\components\rest;

class CodeMsg
{
    const SUCCESS = 200;
    const SUCCESS_MSG = '成功';
    const CLIENT_ERROR = 450;
    const CLIENT_ERROR_MSG = '客户端参数错误';
    const SERVER_ERROR = 550;
    const SERVER_ERROR_MSG = '服务器端错误';
    const UNKNOWN_ERROR= 735;
    const UNKNOWN_ERROR_MSG = '未知错误';

    const CREATE_SUCCESS = 200;
    const CREATE_SUCCESS_MSG = '添加成功';
    const CREATE_CLIENT_ERROR = 451;
    const CREATE_CLIENT_ERROR_MSG = '创建时参数错误';
    const CREATE_SERVER_ERROR = 551;
    const CREATE_SERVER_ERROR_MSG = '创建时服务器端错误';

    const UPDATE_SUCCESS = 201;
    const UPDATE_SUCCESS_MSG = '更新成功';
    const UPDATE_CLIENT_ERROR = 452;
    const UPDATE_CLIENT_ERROR_MSG = '更新时参数错误';
    const UPDATE_SERVER_ERROR = 552;
    const UPDATE_SERVER_ERROR_MSG = '更新时服务器端错误';

    const VIEW_SUCCESS = 200;
    const VIEW_SUCCESS_MSG = '更新成功';
    const VIEW_CLIENT_ERROR = 453;
    const VIEW_CLIENT_ERROR_MSG = '查看时参数错误';
    const VIEW_SERVER_ERROR = 553;
    const VIEW_SERVER_ERROR_MSG = '查看时服务器端错误';

    const DEL_SUCCESS = 200;
    const DEL_SUCCESS_MSG = '删除成功';
    const DEL_CLIENT_ERROR = 454;
    const DEL_CLIENT_ERROR_MSG = '删除时参数错误';
    const DEL_SERVER_ERROR = 554;
    const DEL_SERVER_ERROR_MSG = '删除时服务器端错误';

    const INDEX_SUCCESS = 200;
    const INDEX_SUCCESS_MSG = '搜索成功';
    const INDEX_CLIENT_ERROR = 454;
    const INDEX_CLIENT_ERROR_MSG = '搜索时参数错误';
    const INDEX_SERVER_ERROR = 554;
    const INDEX_SERVER_ERROR_MSG = '搜索时服务器端错误';
}
