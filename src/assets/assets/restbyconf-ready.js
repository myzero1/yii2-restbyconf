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
    "controllers": {
        "controller": {
            "description": "userName",
            "actions": {
                "action": {
                    "description": "create",
                    "method": "post",
                    "inputs": {
                        "body_params": {
                            "in_str": {
                                "des": "user name",
                                "required": false,
                                "eg": "myzero1",
                                "rules": "^\\w{1,32}$",
                                "error_msg": "You should input a-z,A-Z,0-9"
                            }
                        },
                        "path_params": {
                            "in_str": {
                                "des": "user name",
                                "required": false,
                                "eg": "myzero1",
                                "rules": "^\\w{1,32}$",
                                "error_msg": "You should input a-z,A-Z,0-9"
                            }
                        },
                        "query_params": {
                            "in_str": {
                                "des": "user name",
                                "required": false,
                                "eg": "myzero1",
                                "rules": "^\\w{1,32}$",
                                "error_msg": "You should input a-z,A-Z,0-9"
                            }
                        }
                    },
                    "outputs": {
                        "code": 200,
                        "msg": "msg",
                        "data": {}
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
              "description": "controllerName",
              "actions": {
                  "action": {
                      "description": "The action's description",
                      "method": "post",
                      "inputs": {
                          "body_params": {
                              "in_str": {
                                  "des": "user name",
                                  "required": false,
                                  "eg": "myzero1",
                                  "rules": "^\\w{1,32}$",
                                  "error_msg": "You should input a-z,A-Z,0-9"
                              }
                          },
                          "path_params": {
                              "in_str": {
                                  "des": "user name",
                                  "required": false,
                                  "eg": "myzero1",
                                  "rules": "^\\w{1,32}$",
                                  "error_msg": "You should input a-z,A-Z,0-9"
                              }
                          },
                          "query_params": {
                              "in_str": {
                                  "des": "user name",
                                  "required": false,
                                  "eg": "myzero1",
                                  "rules": "^\\w{1,32}$",
                                  "error_msg": "You should input a-z,A-Z,0-9"
                              }
                          }
                      },
                      "outputs": {
                          "code": 200,
                          "msg": "msg",
                          "data": {}
                      }
                  }
              }
          }
      },
      {
          text: 'action',
          title: 'Insert a CreatePath Node',
          className: 'jsoneditor-append jsoneditor-default',
          field: '',
          value: {
              "description": "The action's description",
              "method": "post",
              "inputs": {
                  "body_params": {
                      "in_str": {
                          "des": "user name",
                          "required": false,
                          "eg": "myzero1",
                          "rules": "^\\w{1,32}$",
                          "error_msg": "You should input a-z,A-Z,0-9"
                      }
                  },
                  "path_params": {
                      "in_str": {
                          "des": "user name",
                          "required": false,
                          "eg": "myzero1",
                          "rules": "^\\w{1,32}$",
                          "error_msg": "You should input a-z,A-Z,0-9"
                      }
                  },
                  "query_params": {
                      "in_str": {
                          "des": "user name",
                          "required": false,
                          "eg": "myzero1",
                          "rules": "^\\w{1,32}$",
                          "error_msg": "You should input a-z,A-Z,0-9"
                      }
                  }
              },
              "outputs": {
                  "code": 200,
                  "msg": "msg",
                  "data": {}
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
              "error_msg": "You should input a-z,A-Z,0-9"
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
                "type": ["number","string"],
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
                        "type": ["number","string"],
                        "minLength": 1,
                        "maxLength": 512,
                        "examples": [
                            "This is a sample server Petstore server. You can find out more about Swagger at [http://swagger.io](http://swagger.io) or on [irc.freenode.net, #swagger](http://swagger.io/irc/).  For this sample, you can use the api key `special-key` to test the authorization filters."
                        ]
                    },
                    "version": {
                        "title": "The api version",
                        "type": ["number","string"],
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
                      "type": ["number","string"],
                      "minLength": 1,
                      "maxLength": 32,
                      "examples": [
                        "Create restfull api by conf.",
                        "Swagger Petstore"
                      ]
                    },
                    "termsOfService": {
                      "title": "The terms of service",
                      "type": ["number","string"],
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
                              "type": ["number","string"],
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
                              "type": ["number","string"],
                              "minLength": 1,
                              "maxLength": 32,
                              "examples": [
                                  "Apache 2.0"
                              ]
                          },
                          "url": {
                              "type": ["number","string"],
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
                "type": ["number","string"],
                "minLength": 1,
                "maxLength": 32,
                "format": "hostname",
                "examples": [
                  "petstore.swagger.io",
                  "github.com"
                ]
            },
            "basePath": {
                "type": ["number","string"],
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
                        "type": ["number","string"],
                        "minLength": 1,
                        "maxLength": 32,
                        "examples": [
                          "e about Swagger"
                        ]
                    },
                    "url": {
                        "type": ["number","string"],
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
                              "type": ["number","string"],
                              "minLength": 1,
                              "maxLength": 32,
                              "examples": [
                                "apiKey"
                              ]
                          },
                          "in": {
                              "type": ["number","string"],
                              "minLength": 1,
                              "maxLength": 32,
                                "examples": [
                                    "header"
                                ]
                          },
                          "name": {
                                "type": ["number","string"],
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
            }
        }
    },
    "controller": {
        "title": "restbyconf-obj-controller",
        "type": "object",
        "required": ["description", "actions"],
        "properties": {
            "description": {
                "type": ["number","string"],
                "minLength": 1,
                "maxLength": 32,
                "examples": [
                    "user",
                    "log"
                ],
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
            "action": {
                "$ref": "action"
            }
        }
    },
    "action": {
        "title": "restbyconf-obj-action",
        "type": "object",
        "required": [],
        "properties": {
            "description": {
                "type": ["number","string"],
                "minLength": 1,
                "maxLength": 32,
                "examples": [
                    "create",
                    "update"
                ],
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
        "required": ["body_params","path_params","query_params"],
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
            "in_str": {
                "$ref": "in_str"
            }
        }
    },
    "path_params": {
        "title": "restbyconf-obj-inputs-path",
        "type": "object",
        "required": [],
        "properties": {
            "in_str": {
                "$ref": "in_str"
            }
        }
    },
    "query_params": {
        "title": "restbyconf-obj-inputs-query",
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
        "required": ["des","required","eg","rules","error_msg"],
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
            "eg": {
                "type": ["string", "number"],
                "minLength": 1,
                "maxLength": 32,
                "examples": [
                    "myzero1"
                ],
            },
            "rules": {
                "type": ["number","string"],
                "minLength": 1,
                "maxLength": 32,
                "examples": [
                    "^\\w{1,32}$"
                ],
            },
            "error_msg": {
                "type": ["number","string"],
                "minLength": 1,
                "maxLength": 64,
                "examples": [
                    "You should input a-z,A-Z,0-9"
                ],
            }
        }
    },
    "outputs": {
        "title": "restbyconf-obj-outputs",
        "type": "object",
        "required": ["code","msg","data"],
        "properties": {
            "code": {
                "type": ["number","string"],
                "minLength": 1,
                "maxLength": 32,
                "examples": [
                    "200 success"
                ],
            },
            "msg": {
                "type": ["string"],
                "minLength": 1,
                "maxLength": 64,
                "examples": [
                    "myzero1"
                ],
            },
            "data": {
                "type": "object"
            }
        }
    }
};