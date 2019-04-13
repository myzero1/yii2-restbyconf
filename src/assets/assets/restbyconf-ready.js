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
        "add_item_click_before_icon": {
            "description": "userName",
            "paths": {
                "create": {
                    "description": "create",
                    "inputs": {
                        "body_params": {
                          "in_str": {
                              "des": "user name",
                              "required": false,
                              "eg": "myzero1",
                              "rules": "^\\w{1,32}$",
                              "error_msg": "You should input a-z,A-Z,0-9",
                              "enable": true,
                          }
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
                "description": "tagName",
                "paths": {
                    "create": {
                        "description": "create",
                        "item_id_in_path": {
                            "des": "This is the demo of id",
                            "required": true,
                            "type": "path",
                            "eg": "myzero1",
                            "rules": "\\w+"
                        },
                        "inputs": {
                            "body_params":{
                                "in_str": {
                                    "des": "user name",
                                    "required": false,
                                    "eg": "myzero1",
                                    "rules": "^\\w{1,32}$",
                                    "error_msg": "You should input a-z,A-Z,0-9",
                                    "enable": true,
                                }
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
                "description": "create",
                "inputs": {
                    "body_params":{
                        "in_str": {
                            "des": "user name",
                            "required": false,
                            "eg": "myzero1",
                            "rules": "^\\w{1,32}$",
                            "error_msg": "You should input a-z,A-Z,0-9",
                            "enable": true,
                        }
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
                "eg": "myzero1",
                "rules": "^\\w{1,32}$",
                "error_msg": "You should input a-z,A-Z,0-9",
                "enable": true,
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
                "description": "index",
                "inputs": {
                    "query_params":{
                        "in_str": {
                            "des": "user name",
                            "required": false,
                            "eg": "myzero1",
                            "rules": "^\\w{1,32}$",
                            "error_msg": "You should input a-z,A-Z,0-9",
                            "enable": true,
                        }
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
                "description": "update",
                "inputs": {
                    "body_params":{
                        "in_str": {
                            "des": "user name",
                            "required": false,
                            "eg": "myzero1",
                            "rules": "^\\w{1,32}$",
                            "error_msg": "You should input a-z,A-Z,0-9",
                            "enable": true,
                        }
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
                "description": "view",
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
                "description": "delete",
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
            "add_item_click_before_icon": {
                "$ref": "tag"
            }
        }
    },
    "tag": {
        "title": "restbyconf-obj-tag",
        "type": "object",
        "required": ["description", "paths"],
        "properties": {
            "description": {
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
        "required": ["description"],
        "properties": {
            "description": {
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
            "body_params": {
                "$ref": "body_params"
            }
        }
    },
    "body_params": {
        "title": "restbyconf-obj-inputs-body",
        "type": "object",
        "required": [],
        "properties": {
            "in_str": {
                "$ref": "in_str"
            }
        }
    },
    "input_id_in_path": {
        "title": "restbyconf-obj-in-id",
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
                "default": true
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
                    "myzero1",
                    "735735",
                ],
            },
            "rules": {
                "enum": [
                    "\\w+",
                    "\\d+"
                ],
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
                    "^\\w{1,32}$"
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
        "required": ["description"],
        "properties": {
            "description": {
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
        "required": ["description"],
        "properties": {
            "description": {
                "type": "string",
                "minLength": 1,
                "maxLength": 32,
                "examples": [
                    "create",
                    "update"
                ],
            },
            "item_id_in_path":{
                "$ref": "input_id_in_path"
            },
            "inputs": {
                "$ref": "inputs"
            }
        }
    },
    "view": {
        "title": "restbyconf-obj-path",
        "type": "object",
        "required": ["description"],
        "properties": {
            "description": {
                "type": "string",
                "minLength": 1,
                "maxLength": 32,
                "examples": [
                    "create",
                    "update"
                ],
            },
            "item_id_in_path":{
                "$ref": "input_id_in_path"
            },
            "inputs": {
                "$ref": "inputs"
            }
        }
    },
    "delete": {
        "title": "restbyconf-obj-path",
        "type": "object",
        "required": ["description"],
        "properties": {
            "description": {
                "type": "string",
                "minLength": 1,
                "maxLength": 32,
                "examples": [
                    "create",
                    "update"
                ],
            },
            "item_id_in_path":{
                "$ref": "input_id_in_path"
            },
            "inputs": {
                "$ref": "inputs"
            }
        }
    }
};