window.jsoneditorOldJson = {
    "swagger": "2.0",
    "info": {
        "description": "This is a sample server Petstore server.  You can find out more about Swagger at [http:\/\/swagger.io](http:\/\/swagger.io) or on [irc.freenode.net, #swagger](http:\/\/swagger.io\/irc\/).  For this sample, you can use the api key `special-key` to test the authorization filters.",
        "version": "v1",
        "title": "Swagger Petstore",
        "termsOfService": "http:\/\/swagger.io\/terms\/",
        "contact": {
            "email": "apiteam@swagger.io"
        },
        "license": {
            "name": "Apache 2.0",
            "url": "http:\/\/www.apache.org\/licenses\/LICENSE-2.0.html"
        }
    },
    "host": "restbyconf.test",
    "restModuleName": "v1",
    "restModuleAlias": "v1",
    "restModuleAliasPath": "@backend\/modules\/v1",
    "restModuleNamespace": "backend\\modules\\v1",
    "externalDocs": {
        "description": "11Find out more about Swagger",
        "url": "http:\/\/swagger.io"
    },
    "schemes": "http",
    "mySecurity": {
        "security": "httpBearerAuth",
        "exclude": [
            "post \/authenticator\/login",
            "post \/authenticator\/join"
        ]
    },
    "myGroup": {
        "currentUser": "admin",
        "member": {
            "userA": "controllerA1,controllerA2"
        }
    },
    "controllers": {
        "authenticator": {
            "description": "Insert a controller node",
            "actions": {
                "join": {
                    "summary": "get the api token",
                    "description": "The action's description",
                    "method": "post",
                    "uri": "\/{controller}\/join",
                    "inputs": {
                        "body_params": {
                            "username": {
                                "des": "User name",
                                "required": true,
                                "eg": "myzero1",
                                "rules": "^.\\w{1,32}$",
                                "error_msg": "invalid username"
                            },
                            "password": {
                                "des": "password",
                                "required": true,
                                "eg": "myzero1",
                                "rules": "^.{1,32}$",
                                "error_msg": "invalid password"
                            }
                        },
                        "path_params": {},
                        "query_params": {
                            "response_code": {
                                "des": "返回状态码",
                                "required": false,
                                "eg": 735401,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "username": "myzero1"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "login": {
                    "summary": "get the api token",
                    "description": "The action's description",
                    "method": "post",
                    "uri": "\/{controller}\/login",
                    "inputs": {
                        "body_params": {
                            "username": {
                                "des": "User name",
                                "required": true,
                                "eg": "myzero1",
                                "rules": "^.\\w{1,32}$",
                                "error_msg": "invalid username"
                            },
                            "password": {
                                "des": "password",
                                "required": true,
                                "eg": "myzero1",
                                "rules": "^.{1,32}$",
                                "error_msg": "invalid password"
                            }
                        },
                        "path_params": {},
                        "query_params": {
                            "response_code": {
                                "des": "返回状态码",
                                "required": false,
                                "eg": 735401,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "username": "myzero1",
                                "api_token": "123456dsfe5w"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                }
            }
        },
        "user": {
            "description": "Insert a controller node",
            "actions": {
                "create": {
                    "summary": "The create action's summary",
                    "description": "The action's description",
                    "method": "post",
                    "uri": "\/{controller}",
                    "inputs": {
                        "body_params": {
                            "username": {
                                "des": "username",
                                "required": true,
                                "eg": "myzero1",
                                "rules": "^\\w{1,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "password": {
                                "des": "password",
                                "required": true,
                                "eg": "myzero1",
                                "rules": "^.{1,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "status": {
                                "des": "status",
                                "required": true,
                                "eg": 1,
                                "rules": "^\\d{1,1}$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "path_params": {},
                        "query_params": {
                            "response_code": {
                                "des": "返回状态码",
                                "required": false,
                                "eg": 735401,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "username": "myzero1",
                                "status": 1,
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "update": {
                    "summary": "The create action's summary",
                    "description": "The action's description",
                    "method": "put",
                    "uri": "\/{controller}\/{id}",
                    "inputs": {
                        "body_params": {
                            "username": {
                                "des": "username",
                                "required": true,
                                "eg": "myzero1",
                                "rules": "^\\w{1,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "password": {
                                "des": "password",
                                "required": true,
                                "eg": "myzero1",
                                "rules": "^.{1,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "status": {
                                "des": "status",
                                "required": true,
                                "eg": 1,
                                "rules": "^\\d{1,1}$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "path_params": {
                            "id": {
                                "des": "id",
                                "required": true,
                                "eg": 1,
                                "rules": "^\\d+$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "query_params": {
                            "response_code": {
                                "des": "返回状态码",
                                "required": false,
                                "eg": 735401,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "username": "myzero1",
                                "status": 1,
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "view": {
                    "summary": "The view action's summary",
                    "description": "The action's description",
                    "method": "get",
                    "uri": "\/{controller}\/{id}",
                    "inputs": {
                        "body_params": {},
                        "path_params": {
                            "id": {
                                "des": "Id",
                                "required": true,
                                "eg": 1,
                                "rules": "^\\d+$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "query_params": {
                            "response_code": {
                                "des": "返回状态码",
                                "required": false,
                                "eg": 735401,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "username": "myzero1",
                                "status": 1,
                                "api_token": "eHiFYAsL5DMkAiwK-iUJZEon-u42qhpH_1557385911",
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "delete": {
                    "summary": "The delete action's summary",
                    "description": "The action's description",
                    "method": "delete",
                    "uri": "\/{controller}\/{id}",
                    "inputs": {
                        "body_params": {},
                        "path_params": {
                            "id": {
                                "des": "Id",
                                "required": true,
                                "eg": 1,
                                "rules": "^\\d+$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "query_params": {
                            "response_code": {
                                "des": "返回状态码",
                                "required": false,
                                "eg": 735401,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "id": 1
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "index": {
                    "summary": "The index action's summary",
                    "description": "The action's description",
                    "method": "get",
                    "uri": "\/{controller}",
                    "inputs": {
                        "body_params": {},
                        "path_params": {},
                        "query_params": {
                            "response_code": {
                                "des": "返回状态码",
                                "required": false,
                                "eg": 735401,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "username": {
                                "des": "username",
                                "required": false,
                                "eg": "n1",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "id": 1,
                                "username": "myzero1",
                                "status": 1,
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "export": {
                    "summary": "The export action's summary",
                    "description": "It require \"yii2tech\/spreadsheet\" Yii2 extension",
                    "method": "get",
                    "uri": "\/{controller}\/export",
                    "inputs": {
                        "body_params": {},
                        "path_params": {},
                        "query_params": {
                            "response_code": {
                                "des": "返回状态码",
                                "required": false,
                                "eg": 735401,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "username": {
                                "des": "username",
                                "required": false,
                                "eg": "myzero1",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "url": "\/export.xsl"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "status": {
                    "summary": "The custom action's summary",
                    "description": "The action's description",
                    "method": "patch",
                    "uri": "\/{controller}\/{id}\/status",
                    "inputs": {
                        "body_params": {
                            "status": {
                                "des": "status",
                                "required": false,
                                "eg": 2,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "path_params": {
                            "id": {
                                "des": "Id",
                                "required": true,
                                "eg": 1,
                                "rules": "^\\d+$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "query_params": {
                            "response_code": {
                                "des": "返回状态码",
                                "required": false,
                                "eg": 735401,
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "id": 1,
                                "username": "myzero1",
                                "status": 2,
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                }
            }
        }
    }
};

var templates = [
    {
        text: 'controller',
        title: 'Insert a controller Node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "description": "Insert a controller node",
            "actions": {
                "create": {
                    "summary": "The create action's summary",
                    "description": "The action's description",
                    "method": "post",
                    "uri": "/{controller}",
                    "inputs": {
                        "body_params": {
                            "name": {
                                "des": "Name",
                                "required": true,
                                "eg": "name",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "des": {
                                "des": "Description",
                                "required": false,
                                "eg": "description",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "path_params": {},
                        "query_params": {}
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "id": 1,
                                "name": "name",
                                "des": "description",
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "update": {
                    "summary": "The update action's summary",
                    "description": "The action's description",
                    "method": "put",
                    "uri": "/{controller}/{id}",
                    "inputs": {
                        "body_params": {
                            "name": {
                                "des": "Name",
                                "required": false,
                                "eg": "name",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "des": {
                                "des": "Description",
                                "required": false,
                                "eg": "description",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "path_params": {
                            "id": {
                                "des": "Id",
                                "required": true,
                                "eg": "name",
                                "rules": "^\\d+$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "query_params": {}
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "id": 1,
                                "name": "name",
                                "des": "description",
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "view": {
                    "summary": "The view action's summary",
                    "description": "The action's description",
                    "method": "get",
                    "uri": "/{controller}/{id}",
                    "inputs": {
                        "body_params": {},
                        "path_params": {
                            "id": {
                                "des": "Id",
                                "required": true,
                                "eg": "name",
                                "rules": "^\\d+$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "query_params": {}
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "id": 1,
                                "name": "name",
                                "des": "desdescription",
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "delete": {
                    "summary": "The delete action's summary",
                    "description": "The action's description",
                    "method": "delete",
                    "uri": "/{controller}/{id}",
                    "inputs": {
                        "body_params": {},
                        "path_params": {
                            "id": {
                                "des": "Id",
                                "required": true,
                                "eg": "name",
                                "rules": "^\\d+$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "query_params": {}
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "id": 1
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "index": {
                    "summary": "The index action's summary",
                    "description": "The action's description",
                    "method": "get",
                    "uri": "/{controller}",
                    "inputs": {
                        "body_params": {},
                        "path_params": {},
                        "query_params": {
                            "name": {
                                "des": "Name",
                                "required": false,
                                "eg": "n1",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "des": {
                                "des": "Description",
                                "required": false,
                                "eg": "description",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "total": 9,
                                "page": 1,
                                "page_size": 20,
                                "items": [{
                                    "id": 0,
                                    "name": "n0",
                                    "des": "d0",
                                    "created_at": "2019-04-28 11:11:11",
                                    "updated_at": "2019-04-28 11:11:11"
                                }]
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "export": {
                    "summary": "The export action's summary",
                    "description": "The action's description",
                    "method": "get",
                    "uri": "/{controller}/export",
                    "inputs": {
                        "body_params": {},
                        "path_params": {},
                        "query_params": {
                            "name": {
                                "des": "Name",
                                "required": false,
                                "eg": "n1",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            },
                            "des": {
                                "des": "Description",
                                "required": false,
                                "eg": "description",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        }
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "url": "/export.xsl"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                },
                "custom": {
                    "summary": "The custom action's summary",
                    "description": "The action's description",
                    "method": "patch",
                    "uri": "/{controller}/{id}/custom",
                    "inputs": {
                        "body_params": {
                            "name": {
                                "des": "Name",
                                "required": false,
                                "eg": "rename",
                                "rules": "^.{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "path_params": {
                            "id": {
                                "des": "Id",
                                "required": true,
                                "eg": 1,
                                "rules": "^\\d{0,32}$",
                                "error_msg": "Input parameter error"
                            }
                        },
                        "query_params": {}
                    },
                    "outputs": {
                        "735200": {
                            "code": 735200,
                            "msg": "Ok",
                            "data": {
                                "id": 1,
                                "name": "name",
                                "des": "desdescription",
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }
                        },
                        "735401": {
                            "code": 735401,
                            "msg": "Unauthorized",
                            "data": {
                                "msg": "Unauthorized"
                            }
                        }
                    }
                }
            }
        }
    },
    {
        text: 'param',
        title: 'Insert a param node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "des": "user name",
            "required": false,
            "eg": "myzero1",
            "rules": "^.{0,32}$",
            "error_msg": "Input parameter error"
        }
    },
    {
        text: 'output',
        title: 'Insert a output node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "code": "735200",
            "msg": "Ok",
            "data": {
                "msg": "Ok"
            }
        }
    },
    {
        text: 'create',
        title: 'Insert a action node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "summary": "The create action's summary",
            "description": "The create action's description",
            "method": "post",
            "uri": "/{controller}",
            "inputs": {
                "body_params": {
                    "name": {
                        "des": "Name",
                        "required": true,
                        "eg": "name",
                        "rules": "^.{0,32}$",
                        "error_msg": "Input parameter error"
                    },
                    "des": {
                        "des": "Description",
                        "required": false,
                        "eg": "description",
                        "rules": "^.{0,32}$",
                        "error_msg": "Input parameter error"
                    }
                },
                "path_params": {},
                "query_params": {}
            },
            "outputs": {
                "735200": {
                    "code": 735200,
                    "msg": "Ok",
                    "data": {
                        "id": 1,
                        "name": "name",
                        "des": "desdescription",
                        "created_at": "2019-04-28 11:11:11",
                        "updated_at": "2019-04-28 11:11:11"
                    }
                },
                "735401": {
                    "code": 735401,
                    "msg": "Unauthorized",
                    "data": {
                        "msg": "Unauthorized"
                    }
                }
            }
        }
    },
    {
        text: 'update',
        title: 'Insert a action node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "summary": "The update action's summary",
            "description": "The update action's description",
            "method": "put",
            "uri": "/{controller}/{id}",
            "inputs": {
                "body_params": {
                    "name": {
                        "des": "Name",
                        "required": false,
                        "eg": "name",
                        "rules": "^.{0,32}$",
                        "error_msg": "Input parameter error"
                    },
                    "des": {
                        "des": "Description",
                        "required": false,
                        "eg": "description",
                        "rules": "^.{0,32}$",
                        "error_msg": "Input parameter error"
                    }
                },
                "path_params": {
                    "id": {
                        "des": "Id",
                        "required": true,
                        "eg": 1,
                        "rules": "^\\d{0,32}$",
                        "error_msg": "Input parameter error"
                    }
                },
                "query_params": {}
            },
            "outputs": {
                "735200": {
                    "code": 735200,
                    "msg": "Ok",
                    "data": {
                        "id": 1,
                        "name": "name",
                        "des": "desdescription",
                        "created_at": "2019-04-28 11:11:11",
                        "updated_at": "2019-04-28 11:11:11"
                    }
                },
                "735401": {
                    "code": 735401,
                    "msg": "Unauthorized",
                    "data": {
                        "msg": "Unauthorized"
                    }
                }
            }
        }
    },
    {
        text: 'view',
        title: 'Insert a action node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "summary": "The view action's summary",
            "description": "The view action's description",
            "method": "get",
            "uri": "/{controller}/{id}",
            "inputs": {
                "body_params": {},
                "path_params": {
                    "id": {
                        "des": "Id",
                        "required": true,
                        "eg": 1,
                        "rules": "^\\d{0,32}$",
                        "error_msg": "Input parameter error"
                    }
                },
                "query_params": {}
            },
            "outputs": {
                "735200": {
                    "code": 735200,
                    "msg": "Ok",
                    "data": {
                        "id": 1,
                        "name": "name",
                        "des": "desdescription",
                        "created_at": "2019-04-28 11:11:11",
                        "updated_at": "2019-04-28 11:11:11"
                    }
                },
                "735401": {
                    "code": 735401,
                    "msg": "Unauthorized",
                    "data": {
                        "msg": "Unauthorized"
                    }
                }
            }
        }
    },
    {
        text: 'delete',
        title: 'Insert a action node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "summary": "The delete action's summary",
            "description": "The delete action's description",
            "method": "delete",
            "uri": "/{controller}/{id}",
            "inputs": {
                "body_params": {},
                "path_params": {
                    "id": {
                        "des": "Id",
                        "required": true,
                        "eg": 1,
                        "rules": "^\\d{0,32}$",
                        "error_msg": "Input parameter error"
                    }
                },
                "query_params": {}
            },
            "outputs": {
                "735200": {
                    "code": 735200,
                    "msg": "Ok",
                    "data": {
                        "id": 1
                    }
                },
                "735401": {
                    "code": 735401,
                    "msg": "Unauthorized",
                    "data": {
                        "msg": "Unauthorized"
                    }
                }
            }
        }
    },
    {
        text: 'index',
        title: 'Insert a action node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "summary": "The index action's summary",
            "description": "The index action's description",
            "method": "get",
            "uri": "/{controller}",
            "inputs": {
                "body_params": {},
                "path_params": {},
                "query_params": {
                    "name": {
                        "des": "Name",
                        "required": false,
                        "eg": "n1",
                        "rules": "^.{0,32}$",
                        "error_msg": "Input parameter error"
                    },
                    "des": {
                        "des": "Description",
                        "required": false,
                        "eg": "description",
                        "rules": "^.{0,32}$",
                        "error_msg": "Input parameter error"
                    }
                }
            },
            "outputs": {
                "735200": {
                    "code": 735200,
                    "msg": "Ok",
                    "data": {
                        "total": 9,
                        "page": 1,
                        "page_size": 20,
                        "items": [{
                            "id": 1,
                            "name": "n0",
                            "des": "d0",
                            "created_at": "2019-04-28 11:11:11",
                            "updated_at": "2019-04-28 11:11:11"
                        }]
                    }
                },
                "735401": {
                    "code": 735401,
                    "msg": "Unauthorized",
                    "data": {
                        "msg": "Unauthorized"
                    }
                }
            }
        }
    },
    {
        text: 'export',
        title: 'Insert a action node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "summary": "The export action's summary",
            "description": "The export action's description",
            "method": "get",
            "uri": "/{controller}/export",
            "inputs": {
                "body_params": {},
                "path_params": {},
                "query_params": {
                    "name": {
                        "des": "Name",
                        "required": false,
                        "eg": "n1",
                        "rules": "^.{0,32}$",
                        "error_msg": "Input parameter error"
                    },
                    "des": {
                        "des": "Description",
                        "required": false,
                        "eg": "description",
                        "rules": "^.{0,32}$",
                        "error_msg": "Input parameter error"
                    }
                }
            },
            "outputs": {
                "735200": {
                    "code": 735200,
                    "msg": "Ok",
                    "data": {
                        "url": "/export.xsl"
                    }
                },
                "735401": {
                    "code": 735401,
                    "msg": "Unauthorized",
                    "data": {
                        "msg": "Unauthorized"
                    }
                }
            }
        }
    },
    {
        text: 'custom',
        title: 'Insert a action node',
        className: 'jsoneditor-append jsoneditor-default',
        field: '',
        value: {
            "summary": "The custom action's summary",
            "description": "The custom action's description",
            "method": "patch",
            "uri": "/{controller}/{id}/custom",
            "inputs": {
                "body_params": {
                    "name": {
                        "des": "Name",
                        "required": false,
                        "eg": "rename",
                        "rules": "^.{0,32}$",
                        "error_msg": "Input parameter error"
                    }
                },
                "path_params": {
                    "id": {
                        "des": "Id",
                        "required": true,
                        "eg": 1,
                        "rules": "^\\d{0,32}$",
                        "error_msg": "Input parameter error"
                    }
                },
                "query_params": {}
          },
          "outputs": {
                "735200": {
                    "code": 735200,
                    "msg": "Ok",
                    "data": {
                        "id": 1,
                        "name": "name",
                        "des": "desdescription",
                        "created_at": "2019-04-28 11:11:11",
                        "updated_at": "2019-04-28 11:11:11"
                    }
                },
                "735401": {
                    "code": 735401,
                    "msg": "Unauthorized",
                    "data": {
                        "msg": "Unauthorized"
                    }
                }
            }
        }
    }
  ];

var schemas = {
    "schema": {
        "title": "Restfull api configuration",
        "type": "object",
        "required": [
            "swagger",
            "info"
        ],
        "properties": {
            "swagger": {
                "title": "swagger version",
                "description": "It can not edit.",
                "type": [
                    "number",
                    "string"
                ],
                "examples": [
                    "2.0"
                ]
            },
            "info": {
                "title": "Info description",
                "type": "object",
                "required": [
                    "description",
                    "version",
                    "title",
                    "termsOfService",
                    "contact",
                    "license"
                ],
                "properties": {
                    "description": {
                        "type": [
                            "number",
                            "string"
                        ],
                        "examples": [
                            "This is a sample server Petstore server. You can find out more about Swagger at [http:\/\/swagger.io](http:\/\/swagger.io) or on [irc.freenode.net, #swagger](http:\/\/swagger.io\/irc\/).  For this sample, you can use the api key `special-key` to test the authorization filters."
                        ]
                    },
                    "version": {
                        "title": "The api version",
                        "type": [
                            "number",
                            "string"
                        ],
                        "examples": [
                            "1.0.0",
                            "1.0.1",
                            "v1"
                        ]
                    },
                    "title": {
                        "title": "Api title",
                        "type": [
                            "number",
                            "string"
                        ],
                        "examples": [
                            "Create restfull api by conf.",
                            "Swagger Petstore"
                        ]
                    },
                    "termsOfService": {
                        "title": "The terms of service",
                        "type": [
                            "number",
                            "string"
                        ],
                        "examples": [
                            "https:\/\/github.com\/myzero1\/yii2-restbyconf",
                            "http:\/\/swagger.io\/terms\/"
                        ]
                    },
                    "contact": {
                        "title": "contact description",
                        "type": "object",
                        "required": [
                            "email"
                        ],
                        "properties": {
                            "email": {
                                "title": "email",
                                "description": "The contact email",
                                "type": [
                                    "number",
                                    "string"
                                ],
                                "format": "email",
                                "examples": [
                                    "myzero1@sina.com",
                                    "apiteam@swagger.io"
                                ]
                            }
                        }
                    },
                    "license": {
                        "title": "contact description",
                        "type": "object",
                        "required": [
                            "name",
                            "url"
                        ],
                        "properties": {
                            "name": {
                                "type": [
                                    "number",
                                    "string"
                                ],
                                "examples": [
                                    "Apache 2.0"
                                ]
                            },
                            "url": {
                                "type": [
                                    "number",
                                    "string"
                                ],
                                "pattern": "[a-zA-z]+:\/\/[^\\s]*",
                                "examples": [
                                    "http:\/\/www.apache.org\/licenses\/LICENSE-2.0.html"
                                ]
                            }
                        }
                    }
                }
            },
            "host": {
                "type": [
                    "number",
                    "string"
                ],
                "format": "hostname",
                "examples": [
                    "petstore.swagger.io",
                    "github.com"
                ]
            },
            "restModuleName": {
                "type": [
                    "string"
                ],
                "pattern": "^[a-zA-Z]\\w*$",
                "examples": [
                    "v1"
                ]
            },
            "restModuleNamespace": {
                "type": [
                    "string"
                ],
                "pattern": "^[a-zA-Z][\\w\\\\]*$",
                "examples": [
                    "backend\\modules\\v1"
                ]
            },
            "restModuleAliasPath": {
                "type": [
                    "string"
                ],
                "pattern": "^@[a-zA-Z][\\w\\\/-]*$",
                "examples": [
                    "@backend\/modules\/v1"
                ]
            },
            "restModuleAlias": {
                "type": [
                    "string"
                ],
                "pattern": "^[a-zA-Z]\\w*$",
                "examples": [
                    "v1"
                ]
            },
            "externalDocs": {
                "title": "externalDocs description",
                "type": "object",
                "required": [
                    "description",
                    "url"
                ],
                "properties": {
                    "description": {
                        "type": [
                            "number",
                            "string"
                        ],
                        "examples": [
                            "e about Swagger"
                        ]
                    },
                    "url": {
                        "type": [
                            "number",
                            "string"
                        ],
                        "pattern": "[a-zA-z]+:\/\/[^\\s]*",
                        "examples": [
                            "http:\/\/www.apache.org\/licenses\/LICENSE-2.0.html"
                        ]
                    }
                }
            },
            "schemes": {
                "title": "schemes",
                "enum": [
                    "https",
                    "http"
                ]
            },
            "mySecurity": {
                "title": "mySecurity description",
                "type": "object",
                "required": [
                    "security"
                ],
                "properties": {
                    "security": {
                        "title": "security",
                        "enum": [
                            "noAuthenticator",
                            "queryParamAuth",
                            "httpBasicAuth",
                            "httpBearerAuth"
                        ]
                    }
                }
            },
            "myGroup": {
                "title": "myGroup description",
                "type": "object",
                "required": [
                    "currentUser"
                ],
                "properties": {
                    "currentUser": {
                        "title": "currentUser",
                        "enum": [
                            "admin",
                            "userA"
                        ]
                    }
                }
            },
            "securityDefinitions": {
                "title": "securityDefinitions description",
                "type": "object",
                "required": [
                    "api_key"
                ],
                "properties": {
                    "api_key": {
                        "title": "api_key description",
                        "type": "object",
                        "required": [
                            "type",
                            "name"
                        ],
                        "properties": {
                            "type": {
                                "type": [
                                    "number",
                                    "string"
                                ],
                                "examples": [
                                    "apiKey"
                                ]
                            },
                            "in": {
                                "type": [
                                    "number",
                                    "string"
                                ],
                                "examples": [
                                    "header"
                                ]
                            },
                            "name": {
                                "type": [
                                    "number",
                                    "string"
                                ],
                                "examples": [
                                    "api_key"
                                ]
                            }
                        }
                    }
                }
            },
            "controllers": {
                "$ref": "controllers"
            }
        }
    },
    "controllers": {
        "title": "restbyconf-obj-controllers",
        "type": "object",
        "required": [],
        "properties": {
            "controller": {
                "$ref": "controller"
            },
            "demo": {
                "$ref": "controller"
            }
        }
    },
    "controller": {
        "title": "restbyconf-obj-controller",
        "type": "object",
        "required": [
            "description",
            "actions"
        ],
        "properties": {
            "description": {
                "type": [
                    "number",
                    "string"
                ],
                "examples": [
                    "user",
                    "log"
                ]
            },
            "actions": {
                "$ref": "actions"
            }
        }
    },
    "actions": {
        "title": "actions description",
        "type": "object",
        "required": [],
        "properties": {
            "index": {
                "$ref": "action"
            },
            "create": {
                "$ref": "action"
            },
            "update": {
                "$ref": "action"
            },
            "view": {
                "$ref": "action"
            },
            "delete": {
                "$ref": "action"
            },
            "export": {
                "$ref": "action"
            },
            "custom": {
                "$ref": "action"
            }
        }
    },
    "action": {
        "title": "restbyconf-obj-action",
        "type": "object",
        "required": [],
        "properties": {
            "summary": {
                "type": [
                    "number",
                    "string"
                ],
                "examples": [
                    "action's summary"
                ]
            },
            "description": {
                "type": [
                    "number",
                    "string"
                ],
                "examples": [
                    "description's summary"
                ]
            },
            "method": {
                "title": "method",
                "enum": [
                    "post",
                    "get",
                    "put",
                    "delete",
                    "patch",
                    "options"
                ]
            },
            "inputs": {
                "$ref": "inputs"
            },
            "outputs": {
                "$ref": "outputs"
            }
        }
    },
    "inputs": {
        "title": "restbyconf-obj-inputs",
        "type": "object",
        "required": [
            "body_params",
            "path_params",
            "query_params"
        ],
        "properties": {
            "query_params": {
                "$ref": "query_params"
            },
            "body_params": {
                "$ref": "body_params"
            },
            "path_params": {
                "$ref": "path_params"
            }
        }
    },
    "body_params": {
        "title": "restbyconf-obj-inputs-body",
        "type": "object",
        "required": [],
        "properties": {
            "param": {
                "$ref": "param"
            },
            "name": {
                "$ref": "param"
            },
            "des": {
                "$ref": "param"
            },
            "status": {
                "$ref": "param"
            }
        }
    },
    "path_params": {
        "title": "restbyconf-obj-inputs-path",
        "type": "object",
        "required": [],
        "properties": {
            "param": {
                "$ref": "param"
            },
            "id": {
                "$ref": "param"
            },
            "name": {
                "$ref": "param"
            }
        }
    },
    "query_params": {
        "title": "restbyconf-obj-inputs-query",
        "type": "object",
        "required": [],
        "properties": {
            "param": {
                "$ref": "param"
            },
            "name": {
                "$ref": "param"
            },
            "des": {
                "$ref": "param"
            },
            "": {
                "$ref": "param"
            },
            "created_at": {
                "$ref": "param"
            },
            "updated_at": {
                "$ref": "param"
            },
            "response_code": {
                "$ref": "param"
            }
        }
    },
    "param": {
        "title": "restbyconf-obj-input",
        "type": "object",
        "required": [
            "des",
            "required",
            "eg",
            "rules",
            "error_msg"
        ],
        "properties": {
            "des": {
                "type": [
                    "string",
                    "number"
                ],
                "examples": [
                    "user name"
                ]
            },
            "required": {
                "type": "boolean",
                "default": false
            },
            "eg": {
                "type": [
                    "string",
                    "number"
                ],
                "examples": [
                    "myzero1"
                ]
            },
            "rules": {
                "type": [
                    "number",
                    "string"
                ],
                "examples": [
                    "input `regular expression` will use `math` validator, eg:^\\w{1,32}$",
                    "input `safe` will use `safe` validator"
                ]
            },
            "error_msg": {
                "type": [
                    "number",
                    "string"
                ],
                "examples": [
                    "Input parameter error"
                ]
            }
        }
    },
    "outputs": {
        "title": "restbyconf-obj-outputs",
        "type": "object",
        "required": [],
        "properties": {
            "735200": {
                "$ref": "output"
            },
            "735401": {
                "$ref": "output"
            }
        }
    },
    "output": {
        "title": "restbyconf-obj-output",
        "type": "object",
        "required": [
            "code",
            "msg",
            "data"
        ],
        "properties": {
            "code": {
                "type": [
                    "number",
                    "string"
                ],
                "examples": [
                    "200 success"
                ]
            },
            "msg": {
                "type": [
                    "string"
                ],
                "examples": [
                    "myzero1"
                ]
            },
            "data": {
                "type": "object"
            }
        }
    }
};