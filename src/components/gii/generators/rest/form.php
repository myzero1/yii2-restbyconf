<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

use kdn\yii2\JsonEditor;

$jsonStr = <<<'json'
{
    "swagger": "2.0",
    "info": {
        "description": "This is a sample server Petstore server.  You can find out more about Swagger at [http://swagger.io](http://swagger.io) or on [irc.freenode.net, #swagger](http://swagger.io/irc/).  For this sample, you can use the api key `special-key` to test the authorization filters.",
        "version": "1.0.0",
        "title": "Swagger Petstore",
        "termsOfService": "http://swagger.io/terms/",
        "contact": {
            "email": "apiteam@swagger.io"
        },
        "license": {
            "name": "Apache 2.0",
            "url": "http://www.apache.org/licenses/LICENSE-2.0.html"
        }
    },
    "host": "petstore.swagger.io",
    "basePath": "/v2",
    "externalDocs": {
        "description": "11Find out more about Swagger",
        "url": "http://swagger.io"
    },
    "schemes": ["https", "http"],
    "securityDefinitions": {
        "api_key": {
            "type": "apiKey",
            "name": "api_key",
            "in": "header"
        }
    },
    "tags": [
        {
        "name": "user",
        "description": "Operations about user",
        "externalDocs": 
            {
                "description": "Find out more about our store",
                "url": "http://swagger.io"
            }
        }
    ],
    "paths": {
        "/user": {
            "post": {
                "tags": ["user"],
                "summary": "Create user",
                "description": "This can only be done by the logged in user.",
                "operationId": "createUser",
                "produces": ["application/xml", "application/json"],
                "parameters": [{
                    "in": "body",
                    "name": "body",
                    "description": "Created user object",
                    "required": true,
                    "schema": {
                        "type": "object",
                        "properties": {
                            "username": {
                                "type": "string",
                                "example": "myzero1",
                                "description": "It will be used to login"
                            },
                            "firstName": {
                                "type": "string",
                                "example": "myzero1"
                            },
                            "lastName": {
                                "type": "string",
                                "example": "Qin"
                            },
                            "email": {
                                "type": "string",
                                "example": "myzero1@sina.com"
                            },
                            "password": {
                                "type": "string",
                                "example": "123456"
                            }
                        }
                    }
                }],
                "responses": {
                    "default": {
                        "description": "successful operation"
                    }
                },
                "security": [{
                    "api_key": []
                }]
            }
        }
    },
    "definitions": {
        "User": {
            "type": "object",
            "properties": {
                "id": {
                    "type": "integer",
                    "format": "int64"
                },
                "username": {
                    "type": "string"
                },
                "firstName": {
                    "type": "string"
                },
                "lastName": {
                    "type": "string"
                },
                "email": {
                    "type": "string"
                },
                "password": {
                    "type": "string"
                },
                "phone": {
                    "type": "string"
                },
                "userStatus": {
                    "type": "integer",
                    "format": "int32",
                    "description": "User Status"
                }
            },
            "xml": {
                "name": "User"
            }
        },
        "ApiResponse": {
            "type": "object",
            "properties": {
                "code": {
                    "type": "integer",
                    "format": "int32"
                },
                "type": {
                    "type": "string"
                },
                "message": {
                    "type": "string"
                }
            }
        }
    }
}
json;

$generator->conf = json_encode(json_decode($jsonStr));
//-------------------
$schemaStr = <<<'json'
{
    "title": "Api Schema",
    "type": "object",
    "properties": {
          "swagger": {
                "title": "First",
                "description": "The",
                "examples": [
                  "John"
                ],
                "type": "string"
          }
          "info": {
                "title": "First",
                "description": "The",
                "examples": [
                  "John"
                ],
                "type": "string"
          }
          "host": {
                "title": "First",
                "description": "The",
                "examples": [
                  "John"
                ],
                "type": "string"
          }
          "basePath": {
                "title": "First",
                "description": "The",
                "examples": [
                  "John"
                ],
                "type": "string"
          },
          "externalDocs": {
                "title": "First",
                "description": "The",
                "examples": [
                  "John"
                ],
                "type": "string"
          },
          "schemes": {
                "title": "First",
                "description": "The",
                "examples": [
                  "John"
                ],
                "type": "string"
          },
          "securityDefinitions": {
                "title": "First",
                "description": "The",
                "examples": [
                  "John"
                ],
                "type": "string"
          },
          "paths": {
                "title": "First",
                "description": "The",
                "examples": [
                  "John"
                ],
                "type": "string"
          },
    },
    "required": ["title", "info"]
  };
json;

//-------------------
//-------------------
//-------------------
//-------------------
$unEditable = [
    'swagger',
    'info',
    'host',
    'basePath',
    'externalDocs',
    'schemes',
    'securityDefinitions',
];
$json = json_decode($jsonStr, true);
$unEditablePath = [];
foreach ($json as $k => $v) {
    if (in_array($k, $unEditable)) {
        $unEditablePath[] = $k;
        if (is_array($v)) {
            foreach ($v as $k1 => $v1) {
                $unEditablePath[] = $k . '-' . $k1;
                if (is_array($v1)) {
                    foreach ($v1 as $k2 => $v2) {
                        $unEditablePath[] = $k . '-' . $k1 . '-' . $k2;
                    }
                }
            }
        }
    }
}
$unEditablePath[] = 'paths';
$unEditablePath = json_encode($unEditablePath);
//var_dump($unEditablePath);exit;

$onEditable = <<<js
function onEditable(node) {
    var unEditable = $unEditablePath;
    // console.log(unEditable);
    if (Array.isArray(node.path)) {
        var path = node.path.join('-');
        if (unEditable.indexOf(path) > -1) {
            return {
              field: false,
              value: true
            };
        } else {
            return true;
        }
    } else {
        return true;
    }
}
js;


//$generator->conf = json_encode([
//    'swagger' => '2.0',
//    'info' => 'info',
//    'host' => 'petstore.swagger.io',
//    'basePath' => '/v2',
//    'externalDocs' => [
//            'description' => 'Find out more about Swagger',
//            'url' => 'http://swagger.io',
//    ],
//    'schemes' => ['http', 'http'],
//    'securityDefinitions' => [
//        'api_key' => [
//                'type' => 'apiKey',
//                'name' => 'api_key',
//                'in' => 'header',
//        ],
//    ],
//    'paths' => 'paths',
//]);



?>
<div class="rest-form">
<?php
    echo $form->field($generator, 'conf')->label('Api配置')->widget(
        '\kdn\yii2\JsonEditor',
        [
            'clientOptions' => [
                'modes' => ['tree', 'view'],
                'onEditable' => $onEditable,
                'schema' => json_encode(json_decode($schemaStr)),
            ],
        ]
    );
?>
</div>
