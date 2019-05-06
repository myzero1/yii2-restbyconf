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
    "host": "restbyconf.test",
    "basePath": "/v1",
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
        "demo": {
            "description": "Insert a controller node",
            "defaultPathIdDes": "The setting of defaultPathId will replace the path_params of view,update,delete,options",
            "defaultPathIdKey": "id",
            "defaultPathIdVal": "1",
            "defaultPathIdRule": "\\d+",
            "defaultPathIdErrorMsg": "Id in path is wrong",
            "actions": {
                "create": {
                    "summary": "The create action's summary",
                    "description": "The create action's description",
                    "method": "post",
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
                        "code": 200,
                        "msg": "msg",
                        "data": {
                            "id": 1,
                            "name": "name",
                            "des": "description",
                            "created_at": "2019-04-28 11:11:11",
                            "updated_at": "2019-04-28 11:11:11"
                        }
                    }
                },
                "update": {
                    "summary": "The update action's summary",
                    "description": "The update action's description",
                    "method": "put",
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
                        "path_params": {},
                        "query_params": {}
                    },
                    "outputs": {
                        "code": 200,
                        "msg": "msg",
                        "data": {
                            "id": 1,
                            "name": "name",
                            "des": "description",
                            "created_at": "2019-04-28 11:11:11",
                            "updated_at": "2019-04-28 11:11:11"
                        }
                    }
                },
                "view": {
                    "summary": "The view action's summary",
                    "description": "The view action's description",
                    "method": "get",
                    "inputs": {
                        "body_params": {},
                        "path_params": {},
                        "query_params": {}
                    },
                    "outputs": {
                        "code": 200,
                        "msg": "msg",
                        "data": {
                            "id": 1,
                            "name": "name",
                            "des": "desdescription",
                            "created_at": "2019-04-28 11:11:11",
                            "updated_at": "2019-04-28 11:11:11"
                        }
                    }
                },
                "delete": {
                    "summary": "The delete action's summary",
                    "description": "The delete action's description",
                    "method": "delete",
                    "inputs": {
                        "body_params": {},
                        "path_params": {},
                        "query_params": {}
                    },
                    "outputs": {
                        "code": 200,
                        "msg": "msg",
                        "data": {
                            "id": 1
                        }
                    }
                },
                "index": {
                    "summary": "The index action's summary",
                    "description": "The index action's description",
                    "method": "get",
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
                        "code": 200,
                        "msg": "msg",
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
                            }, {
                                "id": 1,
                                "name": "n1",
                                "des": "d1",
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }, {
                                "id": 2,
                                "name": "n2",
                                "des": "d2",
                                "created_at": "2019-04-28 11:11:11",
                                "updated_at": "2019-04-28 11:11:11"
                            }]
                        }
                    }
                },
                "export": {
                    "summary": "The export action's summary",
                    "description": "The export action's description",
                    "method": "get",
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
                        "code": 200,
                        "msg": "msg",
                        "data": {
                            "url": "/export.xsl"
                        }
                    }
                },
                "custom": {
                    "summary": "The custom action's summary",
                    "description": "The custom action's description",
                    "method": "patch",
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
                        "code": 200,
                        "msg": "msg",
                        "data": {
                            "id": 1,
                            "name": "rename",
                            "des": "description",
                            "created_at": "2019-04-28 11:11:11",
                            "updated_at": "2019-04-28 11:11:11"
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
              "defaultPathIdDes": "The setting of defaultPathId will replace the path_params of view,update,delete,options",
              "defaultPathIdKey": "id",
              "defaultPathIdVal": "1",
              "defaultPathIdRule": "\\d+",
              "defaultPathIdErrorMsg": "Id in path is wrong",
              "actions": {
                  "create": {
                      "summary": "The create action's summary",
                      "description": "The action's description",
                      "method": "post",
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
                          "code": 200,
                          "msg": "msg",
                          "data": {
                              "id": 1,
                              "name": "name",
                              "des": "description",
                              "created_at": "2019-04-28 11:11:11",
                              "updated_at": "2019-04-28 11:11:11"
                          }
                      }
                  },
                  "update": {
                      "summary": "The update action's summary",
                      "description": "The action's description",
                      "method": "put",
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
                          "path_params": {},
                          "query_params": {}
                      },
                      "outputs": {
                          "code": 200,
                          "msg": "msg",
                          "data": {
                              "id": 1,
                              "name": "name",
                              "des": "description",
                              "created_at": "2019-04-28 11:11:11",
                              "updated_at": "2019-04-28 11:11:11"
                          }
                      }
                  },
                  "view": {
                      "summary": "The view action's summary",
                      "description": "The action's description",
                      "method": "get",
                      "inputs": {
                          "body_params": {},
                          "path_params": {},
                          "query_params": {}
                      },
                      "outputs": {
                          "code": 200,
                          "msg": "msg",
                          "data": {
                              "id": 1,
                              "name": "name",
                              "des": "desdescription",
                              "created_at": "2019-04-28 11:11:11",
                              "updated_at": "2019-04-28 11:11:11"
                          }
                      }
                  },
                  "delete": {
                      "summary": "The delete action's summary",
                      "description": "The action's description",
                      "method": "delete",
                      "inputs": {
                          "body_params": {},
                          "path_params": {},
                          "query_params": {}
                      },
                      "outputs": {
                          "code": 200,
                          "msg": "msg",
                          "data": {
                              "id": 1
                          }
                      }
                  },
                  "index": {
                      "summary": "The index action's summary",
                      "description": "The action's description",
                      "method": "get",
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
                          "code": 200,
                          "msg": "msg",
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
                              }, {
                                  "id": 1,
                                  "name": "n1",
                                  "des": "d1",
                                  "created_at": "2019-04-28 11:11:11",
                                  "updated_at": "2019-04-28 11:11:11"
                              }, {
                                  "id": 2,
                                  "name": "n2",
                                  "des": "d2",
                                  "created_at": "2019-04-28 11:11:11",
                                  "updated_at": "2019-04-28 11:11:11"
                              }]
                          }
                      }
                  },
                  "export": {
                      "summary": "The export action's summary",
                      "description": "The action's description",
                      "method": "get",
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
                          "code": 200,
                          "msg": "msg",
                          "data": {
                              "url": "/export.xsl"
                          }
                      }
                  },
                  "custom": {
                      "summary": "The custom action's summary",
                      "description": "The action's description",
                      "method": "patch",
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
                          "code": 200,
                          "msg": "msg",
                          "data": {
                              "id": 1,
                              "name": "rename",
                              "des": "description",
                              "created_at": "2019-04-28 11:11:11",
                              "updated_at": "2019-04-28 11:11:11"
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
          text: 'create',
          title: 'Insert a action node',
          className: 'jsoneditor-append jsoneditor-default',
          field: '',
          value: {
              "summary": "The create action's summary",
              "description": "The create action's description",
              "method": "post",
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
                  "code": 200,
                  "msg": "msg",
                  "data": {
                      "id": 1,
                      "name": "name",
                      "des": "description",
                      "created_at": "2019-04-28 11:11:11",
                      "updated_at": "2019-04-28 11:11:11"
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
                  "path_params": {},
                  "query_params": {}
              },
              "outputs": {
                  "code": 200,
                  "msg": "msg",
                  "data": {
                      "id": 1,
                      "name": "name",
                      "des": "description",
                      "created_at": "2019-04-28 11:11:11",
                      "updated_at": "2019-04-28 11:11:11"
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
              "inputs": {
                  "body_params": {},
                  "path_params": {},
                  "query_params": {}
              },
              "outputs": {
                  "code": 200,
                  "msg": "msg",
                  "data": {
                      "id": 1,
                      "name": "name",
                      "des": "desdescription",
                      "created_at": "2019-04-28 11:11:11",
                      "updated_at": "2019-04-28 11:11:11"
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
              "inputs": {
                  "body_params": {},
                  "path_params": {},
                  "query_params": {}
              },
              "outputs": {
                  "code": 200,
                  "msg": "msg",
                  "data": {
                      "id": 1
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
                  "code": 200,
                  "msg": "msg",
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
                      }, {
                          "id": 1,
                          "name": "n1",
                          "des": "d1",
                          "created_at": "2019-04-28 11:11:11",
                          "updated_at": "2019-04-28 11:11:11"
                      }, {
                          "id": 2,
                          "name": "n2",
                          "des": "d2",
                          "created_at": "2019-04-28 11:11:11",
                          "updated_at": "2019-04-28 11:11:11"
                      }]
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
                  "code": 200,
                  "msg": "msg",
                  "data": {
                      "url": "/export.xsl"
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
                  "code": 200,
                  "msg": "msg",
                  "data": {
                      "id": 1,
                      "name": "rename",
                      "des": "description",
                      "created_at": "2019-04-28 11:11:11",
                      "updated_at": "2019-04-28 11:11:11"
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
                "type": ["number", "string"],
                "examples": ["2.0"]
            },
            "info": {
                "title": "Info description",
                "type": "object",
                "required": ["description", "version", "title", "termsOfService", "contact", "license"],
                "properties": {
                    "description": {
                        "type": ["number", "string"],
                        "examples": ["This is a sample server Petstore server. You can find out more about Swagger at [http://swagger.io](http://swagger.io) or on [irc.freenode.net, #swagger](http://swagger.io/irc/).  For this sample, you can use the api key `special-key` to test the authorization filters."]
                    },
                    "version": {
                        "title": "The api version",
                        "type": ["number", "string"],
                        "pattern": "^[0-9][0-9.]{0,}[0-9]$",
                        "examples": ["1.0.0", "1.0.1"]
                    },
                    "title": {
                        "title": "Api title",
                        "type": ["number", "string"],
                        "examples": ["Create restfull api by conf.", "Swagger Petstore"]
                    },
                    "termsOfService": {
                        "title": "The terms of service",
                        "type": ["number", "string"],
                        "examples": ["https://github.com/myzero1/yii2-restbyconf", "http://swagger.io/terms/"]
                    },
                    "contact": {
                        "title": "contact description",
                        "type": "object",
                        "required": ["email"],
                        "properties": {
                            "email": {
                                "title": "email",
                                "description": "The contact email",
                                "type": ["number", "string"],
                                "format": "email",
                                "examples": ["myzero1@sina.com", "apiteam@swagger.io"]
                            }
                        }
                    },
                    "license": {
                        "title": "contact description",
                        "type": "object",
                        "required": ["name", "url"],
                        "properties": {
                            "name": {
                                "type": ["number", "string"],
                                "examples": ["Apache 2.0"]
                            },
                            "url": {
                                "type": ["number", "string"],
                                "pattern": "[a-zA-z]+://[^\\s]*",
                                "examples": ["http://www.apache.org/licenses/LICENSE-2.0.html"]
                            }
                        }
                    }
                }
            },
            "host": {
                "type": ["number", "string"],
                "format": "hostname",
                "examples": ["petstore.swagger.io", "github.com"]
            },
            "basePath": {
                "type": ["number", "string"],
                "pattern": "^/",
                "examples": ["/v1", "/v2"]
            },
            "externalDocs": {
                "title": "externalDocs description",
                "type": "object",
                "required": ["description", "url"],
                "properties": {
                    "description": {
                        "type": ["number", "string"],
                        "examples": ["e about Swagger"]
                    },
                    "url": {
                        "type": ["number", "string"],
                        "pattern": "[a-zA-z]+://[^\\s]*",
                        "examples": ["http://www.apache.org/licenses/LICENSE-2.0.html"]
                    }
                }
            },
            "schemes": {
                "title": "schemes",
                "enum": ["https", "http"]
            },
            "securityDefinitions": {
                "title": "securityDefinitions description",
                "type": "object",
                "required": ["api_key"],
                "properties": {
                    "api_key": {
                        "title": "api_key description",
                        "type": "object",
                        "required": ["type", "name"],
                        "properties": {
                            "type": {
                                "type": ["number", "string"],
                                "examples": ["apiKey"]
                            },
                            "in": {
                                "type": ["number", "string"],
                                "examples": ["header"]
                            },
                            "name": {
                                "type": ["number", "string"],
                                "examples": ["api_key"]
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
        "required": ["description", "actions"],
        "properties": {
            "description": {
                "type": ["number", "string"],
                "examples": ["user", "log"]
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
                "type": ["number", "string"],
                "examples": ["action's summary"]
            },
            "description": {
                "type": ["number", "string"],
                "examples": ["description's summary"]
            },
            "method": {
                "title": "method",
                "enum": ["post", "get", "put", "delete", "patch", "options"]
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
        "required": ["body_params", "path_params", "query_params"],
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
            }
        }
    },
    "param": {
        "title": "restbyconf-obj-input",
        "type": "object",
        "required": ["des", "required", "eg", "rules", "error_msg"],
        "properties": {
            "des": {
                "type": ["string", "number"],
                "examples": ["user name"]
            },
            "required": {
                "type": "boolean",
                "default": false
            },
            "eg": {
                "type": ["string", "number"],
                "examples": ["myzero1"]
            },
            "rules": {
                "type": ["number", "string"],
                "examples": ["^\\w{1,32}$"]
            },
            "error_msg": {
                "type": ["number", "string"],
                "examples": ["Input parameter error"]
            }
        }
    },
    "outputs": {
        "title": "restbyconf-obj-outputs",
        "type": "object",
        "required": ["code", "msg", "data"],
        "properties": {
            "code": {
                "type": ["number", "string"],
                "examples": ["200 success"]
            },
            "msg": {
                "type": ["string"],
                "examples": ["myzero1"]
            },
            "data": {
                "type": "object"
            }
        }
    }
};