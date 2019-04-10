//---------ready--------
    window.jsoneditorOldJson = {
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
        "schemes": "http",
        "securityDefinitions": {
            "api_key": {
                "type": "apiKey",
                "in": "header",
                "name": "api_key"
            }
        },
        "tags": {
            "TagTemplate": {
                "name": "userName",
                "paths": {
                    "create": {
                        "name": "create",
                        "inputs": {
                            "in_str": {
                                "des": "user name",
                                "required": false,
                                "type": "body",
                                "eg": "myzero1",
                                "rules": "^\w{1,32}$",
                                'error_msg': "You should input a-z,A-Z,0-9"
                            }
                        },
                        "outputs": {
                            "out_str": {
                                "des": "user name",
                                "eg": "myzero1"
                            }
                        }
                    }
                }
            }
        }
    };

    var templates = [
            {
                text: 'tag',
                title: 'Insert a Tag Node',
                className: 'jsoneditor-append jsoneditor-default',
                field: '',
                value: {
                    "name": "tagName",
                    "paths": {
                        "create": {
                            "name": "create",
                            "inputs": {
                                "in_str": {
                                    "des": "user name",
                                    "required": false,
                                    "type": "body",
                                    "eg": "myzero1",
                                    "rules": "^\w{1,32}$",
                                    'error_msg': "You should input a-z,A-Z,0-9"
                                }
                            },
                            "outputs": {
                                "out_str": {
                                    "des": "user name",
                                    "eg": "myzero1"
                                }
                            }
                        }
                    }
                }
            },
            {
                text: 'create',
                title: 'Insert a CreatePath Node',
                className: 'jsoneditor-append jsoneditor-default',
                field: 'create',
                value: {
                    "name": "create",
                    "inputs": {
                        "in_str": {
                            "des": "user name",
                            "required": false,
                            "type": "body",
                            "eg": "myzero1",
                            "rules": "^\w{1,32}$",
                            'error_msg': "You should input a-z,A-Z,0-9"
                        }
                    },
                    "outputs": {
                        "out_str": {
                            "des": "user name",
                            "eg": "myzero1"
                        }
                    }
                }
            },
            {
                text: 'in_str',
                title: 'Insert a CreatePath Node',
                className: 'jsoneditor-append jsoneditor-default',
                field: '',
                value: {
                    "des": "user name",
                    "required": false,
                    "type": "body",
                    "eg": "myzero1",
                    "rules": "^\w{1,32}$",
                    'error_msg': "You should input a-z,A-Z,0-9"
                }
            },
            {
                text: 'out_str',
                title: 'Insert a CreatePath Node',
                className: 'jsoneditor-append jsoneditor-default',
                field: '',
                value: {
                    "des": "user name",
                    "eg": "myzero1"
                }
            },
            {
                text: 'index',
                title: 'restbyconf-obj-path',
                className: 'jsoneditor-append jsoneditor-default',
                field: 'index',
                value: {
                    "name": "index",
                    "inputs": {
                        "in_str": {
                            "des": "user name",
                            "required": false,
                            "type": "body",
                            "eg": "myzero1",
                            "rules": "^\w{1,32}$",
                            'error_msg': "You should input a-z,A-Z,0-9"
                        }
                    },
                    "outputs": {
                        "out_str": {
                            "des": "user name",
                            "eg": "myzero1"
                        }
                    }
                }
            },
            {
                text: 'update',
                title: 'Insert a CreatePath Node',
                className: 'jsoneditor-append jsoneditor-default',
                field: 'update',
                value: {
                    "name": "update",
                    "inputs": {
                        "in_str": {
                            "des": "user name",
                            "required": false,
                            "type": "body",
                            "eg": "myzero1",
                            "rules": "^\w{1,32}$",
                            'error_msg': "You should input a-z,A-Z,0-9"
                        }
                    },
                    "outputs": {
                        "out_str": {
                            "des": "user name",
                            "eg": "myzero1"
                        }
                    }
                }
            },
            {
                text: 'view',
                title: 'Insert a CreatePath Node',
                className: 'jsoneditor-append jsoneditor-default',
                field: 'view',
                value: {
                    "name": "view",
                    "inputs": {
                        "in_str": {
                            "des": "user name",
                            "required": false,
                            "type": "body",
                            "eg": "myzero1",
                            "rules": "^\w{1,32}$",
                            'error_msg': "You should input a-z,A-Z,0-9"
                        }
                    },
                    "outputs": {
                        "out_str": {
                            "des": "user name",
                            "eg": "myzero1"
                        }
                    }
                }
            },
            {
                text: 'delete',
                title: 'Insert a CreatePath Node',
                className: 'jsoneditor-append jsoneditor-default',
                field: 'delete',
                value: {
                    "name": "delete",
                    "inputs": {
                        "in_str": {
                            "des": "user name",
                            "required": false,
                            "type": "body",
                            "eg": "myzero1",
                            "rules": "^\w{1,32}$",
                            'error_msg': "You should input a-z,A-Z,0-9"
                        }
                    },
                    "outputs": {
                        "out_str": {
                            "des": "user name",
                            "eg": "myzero1"
                        }
                    }
                }
            }
        ];

    var schemas = {
        "schema": {
            "title": "Restfull api configuration",
            "type": "object",
            "required": ["swagger", "info"],
            "properties": {
                "swagger": {
                    "title": "swagger version",
                    "description": "It can not edit.",
                    "type": "string",
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
                            "type": "string",
                            "minLength": 1,
                            "maxLength": 512,
                            "examples": [
                                "This is a sample server Petstore server. You can find out more about Swagger at [http://swagger.io](http://swagger.io) or on [irc.freenode.net, #swagger](http://swagger.io/irc/).  For this sample, you can use the api key `special-key` to test the authorization filters."
                            ]
                        },
                        "version": {
                            "title": "The api version",
                            "type": "string",
                            "minLength": 1,
                            "maxLength": 32,
                            "pattern": "^[0-9][0-9.]{0,}[0-9]$",
                            "examples": [
                                "1.0.0",
                                "1.0.1"
                            ]
                        },
                        "title": {
                          "title": "Api title",
                          "type": "string",
                          "minLength": 1,
                          "maxLength": 32,
                          "examples": [
                            "Create restfull api by conf.",
                            "Swagger Petstore"
                          ]
                        },
                        "termsOfService": {
                          "title": "The terms of service",
                          "type": "string",
                          "minLength": 1,
                          "maxLength": 128,
                          "examples": [
                            "https://github.com/myzero1/yii2-restbyconf",
                            "http://swagger.io/terms/"
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
                                  "type": "string",
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
                                  "type": "string",
                                  "minLength": 1,
                                  "maxLength": 32,
                                  "examples": [
                                      "Apache 2.0"
                                  ]
                              },
                              "url": {
                                  "type": "string",
                                  "minLength": 1,
                                  "maxLength": 64,
                                  "pattern": "[a-zA-z]+://[^\\s]*",
                                  "examples": [
                                      "http://www.apache.org/licenses/LICENSE-2.0.html"
                                  ]
                                }
                            }
                        }
                    }
                },
              "host": {
                  "type": "string",
                  "minLength": 1,
                  "maxLength": 32,
                  "format": "hostname",
                  "examples": [
                    "petstore.swagger.io",
                    "github.com"
                  ]
              },
              "basePath": {
                  "type": "string",
                  "minLength": 1,
                  "maxLength": 32,
                  "pattern": "^/",
                  "examples": [
                    "/v1",
                    "/v2"
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
                          "type": "string",
                          "minLength": 1,
                          "maxLength": 32,
                          "examples": [
                            "e about Swagger"
                          ]
                      },
                      "url": {
                          "type": "string",
                          "minLength": 1,
                          "maxLength": 64,
                          "pattern": "[a-zA-z]+://[^\\s]*",
                          "examples": [
                              "http://www.apache.org/licenses/LICENSE-2.0.html"
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
                                  "type": "string",
                                  "minLength": 1,
                                  "maxLength": 32,
                                  "examples": [
                                    "apiKey"
                                  ]
                              },
                              "in": {
                                  "type": "string",
                                  "minLength": 1,
                                  "maxLength": 32,
                                    "examples": [
                                        "header"
                                    ]
                              },
                              "name": {
                                    "type": "string",
                                    "minLength": 1,
                                    "maxLength": 32,
                                    "examples": [
                                    "api_key"
                                  ]
                              }
                          }
                      }
                  }
                },
                "tags": {
                    "$ref": "tags"
                }
            }
        },
        "tags": {
            "title": "restbyconf-obj-tags",
            "type": "object",
            "required": [],
            "properties": {
                "TagTemplate": {
                    "$ref": "tag"
                }
            }
        },
        "tag": {
            "title": "restbyconf-obj-tag",
            "type": "object",
            "required": ["name", "paths"],
            "properties": {
                "name": {
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 32,
                    "examples": [
                        "user",
                        "log"
                    ],
                },
                "paths": {
                    "$ref": "paths"
                }
            }
        },
        "paths": {
            "title": "Paths description",
            "type": "object",
            "required": [],
            "properties": {
                "create": {
                    "$ref": "create"
                }
            }
        },
        "create": {
            "title": "restbyconf-obj-path",
            "type": "object",
            "required": ["name"],
            "properties": {
                "name": {
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 32,
                    "examples": [
                        "create",
                        "update"
                    ],
                },
                "inputs": {
                    "$ref": "inputs"
                },
                "outputs": {
                    "$ref": "outputs"
                }
            }
        },
        "outputs": {
            "title": "restbyconf-obj-outputs",
            "type": "object",
            "required": [],
            "properties": {
                "out_str": {
                    "$ref": "out_str"
                }
            }
        },
        "out_str": {
            "title": "restbyconf-obj-output",
            "type": "object",
            "required": ["eg"],
            "properties": {
                "des": {
                    "type": ["string", "number"],
                    "maxLength": 32,
                    "examples": [
                        "user name"
                    ],
                },
                "eg": {
                    "type": ["string", "number"],
                    "minLength": 1,
                    "maxLength": 64,
                    "examples": [
                        "myzero1"
                    ],
                }
            }
        },
        "inputs": {
            "title": "restbyconf-obj-inputs",
            "type": "object",
            "required": [],
            "properties": {
                "in_str": {
                    "$ref": "in_str"
                }
            }
        },
        "in_str": {
            "title": "restbyconf-obj-input",
            "type": "object",
            "required": ["des"],
            "properties": {
                "des": {
                    "type": ["string", "number"],
                    "minLength": 1,
                    "maxLength": 32,
                    "examples": [
                        "user name"
                    ],
                },
                "required": {
                    "type": "boolean",
                    "default": false
                },
                "type": {
                    "enum": [
                        "path",
                        "query",
                        "body"
                    ],
                },
                "eg": {
                    "type": ["string", "number"],
                    "minLength": 1,
                    "maxLength": 32,
                    "examples": [
                        "myzero1"
                    ],
                },
                "rules": {
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 32,
                    "examples": [
                        "^w{1,32}$"
                    ],
                },
                "error_msg": {
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 64,
                    "examples": [
                        "You should input a-z,A-Z,0-9"
                    ],
                }
            }
        },
        "index": {
            "title": "restbyconf-obj-path",
            "type": "object",
            "required": ["name"],
            "properties": {
                "name": {
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 32,
                    "examples": [
                        "create",
                        "update"
                    ],
                },
                "inputs": {
                    "$ref": "inputs"
                }
            }
        },
        "update": {
            "title": "restbyconf-obj-path",
            "type": "object",
            "required": ["name"],
            "properties": {
                "name": {
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 32,
                    "examples": [
                        "create",
                        "update"
                    ],
                },
                "inputs": {
                    "$ref": "inputs"
                }
            }
        },
        "view": {
            "title": "restbyconf-obj-path",
            "type": "object",
            "required": ["name"],
            "properties": {
                "name": {
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 32,
                    "examples": [
                        "create",
                        "update"
                    ],
                },
                "inputs": {
                    "$ref": "inputs"
                }
            }
        },
        "delete": {
            "title": "restbyconf-obj-path",
            "type": "object",
            "required": ["name"],
            "properties": {
                "name": {
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 32,
                    "examples": [
                        "create",
                        "update"
                    ],
                },
                "inputs": {
                    "$ref": "inputs"
                }
            }
        }
    };

//----------utils----------- 
    var adjustBackground = function() {
        $('.jsoneditor-values').each(function() {
            var style = $(this).attr('style');
            if (style.indexOf('margin-left: 24px') > -1)  {
                $(this).css({'background':'rgba(245, 245, 245, 0.8)'});
            } else if(style.indexOf('margin-left: 48px') > -1){
                $(this).css({'background':'rgba(235, 235, 235, 0.8)'});
            } else if(style.indexOf('margin-left: 72px') > -1){
                 $(this).css({'background':'rgba(225, 225, 225, 0.8)'});
            } else if(style.indexOf('margin-left: 96px') > -1){
                 $(this).css({'background':'rgba(215, 215, 215, 0.8)'});
            } else if(style.indexOf('margin-left: 120px') > -1){
                $(this).css({'background':'rgba(205, 205, 205, 0.8)'});
            } else if(style.indexOf('margin-left: 144px') > -1){
                $(this).css({'background':'rgba(195, 195, 195, 0.8)'});
            } else if(style.indexOf('margin-left: 168px') > -1){
                $(this).css({'background':'rgba(185, 185, 185, 0.8)'});
            } else if(style.indexOf('margin-left: 192px') > -1){
                $(this).css({'background':'rgba(175, 175, 175, 0.8)'});
            } else if(style.indexOf('margin-left: 216px') > -1){
                $(this).css({'background':'rgba(165, 165, 165, 0.8)'});
            } else if(style.indexOf('margin-left: 240px') > -1){
                $(this).css({'background':'rgba(155, 155, 155, 0.8)'});
            } else if(style.indexOf('margin-left: 264px') > -1){
                $(this).css({'background':'rgba(145, 145, 145, 0.8)'});
            }
        });
    }

    var showContextmenu = function() {
        $(".jsoneditor-field[title=restbyconf-obj-tag]").each(function(){
            $(this).parents('.jsoneditor-expandable').find('.jsoneditor-contextmenu').show();
        });
        $(".jsoneditor-field[title=restbyconf-obj-path]").each(function(){
            $(this).parents('.jsoneditor-expandable').find('.jsoneditor-contextmenu').show();
        });
        $(".jsoneditor-field[title=restbyconf-obj-input]").each(function(){
            $(this).parents('.jsoneditor-expandable').find('.jsoneditor-contextmenu').show();
        });
        $(".jsoneditor-field[title=restbyconf-obj-output]").each(function(){
            $(this).parents('.jsoneditor-expandable').find('.jsoneditor-contextmenu').show();
        });
    }

    var isTagLay = function(path) {
        if (path.length == 2 && path[0] == 'tags') {
            return true;
        } else {
            return false;
        }
    }

    var isPathLay = function(path) {
        if (path.length == 4 && path[0] == 'tags' && path[2] == 'paths') {
            return true;
        } else {
            return false;
        }
    }

    var isInputLay = function(path) {
        if (path.length == 6 && path[0] == 'tags' && path[2] == 'paths' && path[4] == 'inputs') {
            return true;
        } else {
            return false;
        }
    }

    var isOutputLay = function(path) {
        if (path.length == 6 && path[0] == 'tags' && path[2] == 'paths' && path[4] == 'outputs') {
            return true;
        } else {
            return false;
        }
    }

    var isJumpLay = function(json) {
        // console.log(json);
        var gettype=Object.prototype.toString

        for(var i1 in json) {//第一层不会用带node_id的节点
            if (gettype.call(json[i1]) == '[object Object]') {
                if ('node_id' in json[i1]) {
                    return true;
                }

                for(var i2 in json[i1]) {//第二层只有tag会用带node_id的节点
                    if (gettype.call(json[i1][i2]) == '[object Object]') {
                        if ('node_id' in json[i1][i2]) {
                            if (i1!='tags') {
                                return true
                            }
                        }
                        
                        for(var i3 in json[i1][i2]) {//第三层不会用带node_id的节点
                            if (gettype.call(json[i1][i2][i3]) == '[object Object]') {
                                if ('node_id' in json[i1][i2][i3]) {
                                    return true
                                } else {
                                    
                                }

                                for(var i4 in json[i1][i2][i3]) {//第四层带node_id的节点，要判断node_id
                                    if (gettype.call(json[i1][i2][i3][i4]) == '[object Object]') {
                                        if ('node_id' in json[i1][i2][i3][i4]) {
                                            var nodeIdArray = json[i1][i2][i3][i4]['node_id'].split('-');
                                            if (nodeIdArray.length != 3) {
                                                return true;
                                            }
                                        }

                                        for(var i5 in json[i1][i2][i3][i4]) {//第五层不带node_id
                                            if (gettype.call(json[i1][i2][i3][i4][i5]) == '[object Object]') {
                                                if ('node_id' in json[i1][i2][i3][i4][i5]) {
                                                    return true;
                                                }

                                                for(var i6 in json[i1][i2][i3][i4][i5]) {//第六层带node_id的节点，要判断node_id
                                                    if (gettype.call(json[i1][i2][i3][i4][i5][i6]) == '[object Object]') {
                                                        if ('node_id' in json[i1][i2][i3][i4][i5][i6]) {
                                                            var nodeIdArray = json[i1][i2][i3][i4][i5][i6]['node_id'].split('-');
                                                            if (nodeIdArray.length == 4) {
                                                                var tmpNodeId = json[i1][i2][i3][i4]['node_id'] + nodeIdArray[2] + '-';
                                                                if (tmpNodeId == json[i1][i2][i3][i4][i5][i6]['node_id']) {
                                                                    
                                                                } else {
                                                                    return true;
                                                                }
                                                            } else {
                                                                return true;
                                                            }
                                                        }

                                                        for(var i7 in json[i1][i2][i3][i4][i5][i6]) {//第七层正常情况是不存在的
                                                            var type = gettype.call(json[i1][i2][i3][i4][i5][i6][i7])
                                                            if (type == '[object Object]' || type == '[object Array]') {
                                                                return true;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            }
        }
        return false;
    }

    var getChangeData = function(){
    	var json = editor.get();

        if (isJumpLay(json)) {
            editor.update(window.jsoneditorOldJson);
        } else {
            window.jsoneditorOldJson = json;

            var restbyconfData = {};
            restbyconfData.json = json;
            restbyconfData.schemaRefs = editor.options.schemaRefs;
            document.getElementById("generator-conf").value = JSON.stringify(restbyconfData);// the options
        }
    }

//------callback------

    var onChangeJSON = function onChangeJSON(json) {

        if (isJumpLay(json)) {
            editor.update(window.jsoneditorOldJson);
        } else {
            window.jsoneditorOldJson = json;

            // document.getElementById("generator-conf").value = JSON.stringify(json);
            var restbyconfschamas = {};
            restbyconfschamas.schema = this.schema;
            restbyconfschamas.schemaRefs = this.schemaRefs;
            // console.log(this);
            // console.log(restbyconfschamas);
            document.getElementById("generator-conf").value = JSON.stringify(restbyconfschamas);// the options
        }
    }

    var onEvent = function(node, event){
        if (event.type == 'blur') {
            // update the validation of tag
            if (isTagLay(node.path)) {
                var schemaRefs = this.schemaRefs;
                schemaRefs['tags']['properties'][node.field] = {
                  "$ref": "tag"
                };
                editor.setSchema(this.schema,schemaRefs);
            }
            // update the validation of input
            if (isInputLay(node.path)) {
                // console.log(0);
                var schemaRefs = this.schemaRefs;
                // console.log(schemaRefs);
                schemaRefs['inputs']['properties'][node.field] = {
                  "$ref": "in_str"
                };
                // console.log(schemaRefs);
                editor.setSchema(this.schema,schemaRefs);
            }
            // update the validation of output
            if (isOutputLay(node.path)) {
                // console.log(0);
                var schemaRefs = this.schemaRefs;
                // console.log(schemaRefs);
                schemaRefs['outputs']['properties'][node.field] = {
                  "$ref": "out_str"
                };
                // console.log(schemaRefs);
                editor.setSchema(this.schema,schemaRefs);
            }

            showContextmenu();
            adjustBackground();
            getChangeData();
        }
    };

    var onNodeName = function(node){
        showContextmenu();
        adjustBackground();

        if (editor!=null) {
            var path = node.path;
            var json = editor.get();

            if (isTagLay(node.path)) {
                // console.log(node);
                var json = editor.get();
                var path = node.path;
                if ('node_id' in json[path[0]][path[1]]) {

                } else {
                    json[path[0]][path[1]]['node_id'] = new Date().getTime()+'-';
                    editor.update(json);
                    window.jsoneditorOldJson = json;
                }
            }else if (isPathLay(node.path)) {
                // console.log(node);
                var json = editor.get();
                var path = node.path;
                if ('node_id' in json[path[0]][path[1]][path[2]][path[3]]) {

                } else {
                    var tagNodeId = json[path[0]][path[1]]['node_id'];
                    json[path[0]][path[1]][path[2]][path[3]]['node_id'] = tagNodeId + new Date().getTime()+'-';
                    editor.update(json);
                    window.jsoneditorOldJson = json;
                }
            }else if (isInputLay(node.path)) {
                // console.log(node);
                var json = editor.get();
                var path = node.path;
                if ('node_id' in json[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]]) {

                } else {
                    var pathNodeId = json[path[0]][path[1]][path[2]][path[3]]['node_id'];
                    json[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]]['node_id'] = pathNodeId +new Date().getTime()+'-';
                    editor.update(json);
                    window.jsoneditorOldJson = json;
                }
            }
        }
    }

    var onClassName = function(node){
        if (node.field == 'node_id') {
            return 'restbyconf-hide-node-id';
        }
    }

    var onCreateMenu = function onCreateMenu(items, node) {
        function inArray(value, array){
            for (var i = array.length - 1; i >= 0; i--) {
                if (array[i] == value) {
                    return true;
                }
            }

            return false;
        }

        if(isTagLay(node.path)){
            var itemsTmp  = new Array();

            for (var i = 0;  i < items.length; i++) {
                var text = items[i]['text'];
                if (text=='追加') {
                    // console.log(items[i]['submenu']);
                    for (var j = items[i]['submenu'].length - 1; j >= 0; j--) {
                        if (items[i]['submenu'][j]['text'] == 'tag') {
                            itemsTmp.push(items[i]['submenu'][j]);
                        }
                    }
                } else if (text=='复制') {
                    itemsTmp.push(items[i]);
                }
            }

            itemsTmp.push( {
                text : '删除', // the text for the menu item
                title : 'jsoneditor-remove', // the HTML title attribute
                className : 'jsoneditor-remove', // the css class name(s) for the menu item
                click : function(){
                    var jsonData = editor.get();
                    var path = node.path;
                    var tmp = jsonData[path[0]];
                    delete(tmp[path[1]]);
                    if (JSON.stringify(tmp) == "{}") {
                        alert('必须保留一个tag');
                    } else {
                        delete(jsonData[path[0]][path[1]]);
                        editor.update(jsonData);
                        editor.setSchema(editor.schema,editor.schemaRefs);
                    }
                } // the function to call when the menu item is clicked
            } );
            return itemsTmp;
        } else if(isPathLay(node.path)){
            var itemsTmp  = new Array();
            var actionList = new Array('index', 'create', 'update', 'view', 'delete');
            var jsonData = editor.get();
            var path = node.path;

            for (var i = 0;  i < items.length; i++) {
                var text = items[i]['text'];
                if (text=='追加') {
                    for (var j = items[i]['submenu'].length - 1; j >= 0; j--) {
                        if (inArray(items[i]['submenu'][j]['text'], actionList)) {
                            if (!(items[i]['submenu'][j]['text'] in jsonData[path[0]][path[1]][path[2]])) {
                                itemsTmp.push(items[i]['submenu'][j]);
                            }
                        }
                    }
                }
                
            }

            itemsTmp.push( {
                text : '删除', // the text for the menu item
                title : 'jsoneditor-remove', // the HTML title attribute
                className : 'jsoneditor-remove', // the css class name(s) for the menu item
                click : function(){
                    var jsonData = editor.get();
                    var path = node.path;
                    var tmp = jsonData[path[0]][path[1]][path[2]];
                    delete(tmp[path[3]]);
                    if (JSON.stringify(tmp) == "{}") {
                        alert('必须保留一个path');
                    } else {
                        delete(jsonData[path[0]][path[1]][path[2]][path[3]]);
                        editor.update(jsonData);
                        editor.setSchema(editor.schema,editor.schemaRefs);
                    }
                } // the function to call when the menu item is clicked
            } );


            return itemsTmp;
        } else if(isInputLay(node.path)){
            var itemsTmp  = new Array();
            var actionList = new Array('in_str');
            var jsonData = editor.get();
            var path = node.path;

            for (var i = 0;  i < items.length; i++) {
                var text = items[i]['text'];
                if (text=='追加') {
                    for (var j = items[i]['submenu'].length - 1; j >= 0; j--) {
                        if (inArray(items[i]['submenu'][j]['text'], actionList)) {
                            if (!(items[i]['submenu'][j]['text'] in jsonData[path[0]][path[1]][path[2]])) {
                                itemsTmp.push(items[i]['submenu'][j]);
                            }
                        }
                    }
                } else if (text=='复制') {
                    itemsTmp.push(items[i]);
                }
            }

            itemsTmp.push( {
                text : '删除', // the text for the menu item
                title : 'jsoneditor-remove', // the HTML title attribute
                className : 'jsoneditor-remove', // the css class name(s) for the menu item
                click : function(){
                    var jsonData = editor.get();
                    var path = node.path;
                    var tmp = jsonData[path[0]][path[1]][path[2]][path[3]][path[4]];
                    delete(tmp[path[5]]);
                    if (JSON.stringify(tmp) == "{}") {
                        alert('必须保留一个input');
                    } else {
                        delete(jsonData[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]]);
                        editor.update(jsonData);
                        editor.setSchema(editor.schema,editor.schemaRefs);
                    }
                } // the function to call when the menu item is clicked
            } );


            return itemsTmp;
        } else if(isOutputLay(node.path)){
            var itemsTmp  = new Array();
            var actionList = new Array('out_str');
            var jsonData = editor.get();
            var path = node.path;

            for (var i = 0;  i < items.length; i++) {
                var text = items[i]['text'];
                if (text=='追加') {
                    for (var j = items[i]['submenu'].length - 1; j >= 0; j--) {
                        if (inArray(items[i]['submenu'][j]['text'], actionList)) {
                            if (!(items[i]['submenu'][j]['text'] in jsonData[path[0]][path[1]][path[2]])) {
                                itemsTmp.push(items[i]['submenu'][j]);
                            }
                        }
                    }
                } else if (text=='复制') {
                    itemsTmp.push(items[i]);
                }
            }

            itemsTmp.push( {
                text : '删除', // the text for the menu item
                title : 'jsoneditor-remove', // the HTML title attribute
                className : 'jsoneditor-remove', // the css class name(s) for the menu item
                click : function(){
                    var jsonData = editor.get();
                    var path = node.path;
                    var tmp = jsonData[path[0]][path[1]][path[2]][path[3]][path[4]];
                    delete(tmp[path[5]]);
                    if (JSON.stringify(tmp) == "{}") {
                        alert('必须保留一个output');
                    } else {
                        delete(jsonData[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]]);
                        editor.update(jsonData);
                        editor.setSchema(editor.schema,editor.schemaRefs);
                    }
                } // the function to call when the menu item is clicked
            } );


            return itemsTmp;
        } else {
            return [];
        }
    }

    var onEditable = function(node) {
        // console.log(node);
        // update the validation of path
        if (Array.isArray(node.path)) {
            if (isPathLay(node.path)) {
                var schemaRefs = this.schemaRefs;
                schemaRefs['paths']['properties'][node.field] = {
                  "$ref": node.field
                };
                editor.setSchema(this.schema,schemaRefs);
            }
        }

        showContextmenu();
        adjustBackground();

        if (node.field == 'node_id') {
            return false;
        }

        // set editable
        var unEditable = [
            'swagger',
            'tags'
        ];

        if (Array.isArray(node.path)) {
            var path = node.path.join('-');
            if (unEditable.indexOf(path) > -1) {
                return false;
            } else {
                if(isTagLay(node.path)){
                    return true;
                } else if(isInputLay(node.path)){
                    return true;
                } else if(isOutputLay(node.path)){
                    return true;
                } else {
                    return {
                      field: false,
                      value: true
                    };
                }
            }
        } else {
            return true;
        }
    }

    var onModeChange = function(newMode, oldMode) {
        window.jsoneditorOldJson = editor.get();
        console.log(window.jsoneditorOldJson);
    }

//-----------editor init------------------

    var restbyconfOptionsStr = $("#restbyconfoptions").text();
    restbyconfOptionsStr = restbyconfOptionsStr.replace(/^\s\s*/, '').replace(/\s\s*$/, '');;

    if (restbyconfOptionsStr != '') {
    	restbyconfOptions = JSON.parse(restbyconfOptionsStr);
    	var schemaRefs = restbyconfOptions['schemaRefs'];
    	window.jsoneditorOldJson = restbyconfOptions['json'];
    } else {
    	var schemaRefs = schemas;
    }

    // create the editor
    var defaultOptions = {
        schema: schemas['schema'],
        schemaRefs: schemaRefs,
        mode: 'tree',
        modes: ['view', 'tree'],
        enableSort: true,
        enableTransform: false,
        templates: templates,
        onEditable: onEditable,
        onCreateMenu: onCreateMenu,
        onNodeName: onNodeName,
        onClassName: onClassName,
        // onChangeJSON: onChangeJSON,
        onEvent: onEvent

    };

    var container = document.getElementById('jsoneditor');
    window.jsoneditorCanUpdateOldJson = true;
    var editor = new JSONEditor(container, defaultOptions, window.jsoneditorOldJson);

    // for style
    var style = `
    <style>
        // .jsoneditor-dragarea{
        //     display:none;
        // }
        .jsoneditor-button.jsoneditor-contextmenu{
            display:none;
        }
        .restbyconf-hide-node-id{
            display:none;
        }
    </style>
    `;
    $("body").append(style);

    // for init 
    showContextmenu();
    adjustBackground();

    $(document).on("click",".jsoneditor-expand-all",function(){
        showContextmenu();
        adjustBackground();
    });
