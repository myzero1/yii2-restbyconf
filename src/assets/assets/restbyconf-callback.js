var onChangeJSON = function onChangeJSON(json) {
    restMove();
}
var onValidate = function onValidate(json) {
    if (editor!=null) {
        if (!('node_id' in json['controllers'])) {
            json['controllers']['node_id'] = new Date().getTime()+'-';
            editor.update(json);
            window.jsoneditorOldJson = json;
        }
    }
}

var onEvent = function(node, event){
    // console.log(node);
    // console.log(event.type);
    if (event.type == 'blur') {
        // update the validation of tag
        if (isTagLay(node.path)) {
            var schemaRefs = this.schemaRefs;
            schemaRefs['controllers']['properties'][node.field] = {
              "$ref": "controller"
            };
            editor.setSchema(this.schema,schemaRefs);
        }
        // update the validation of action
        if (isPathLay(node.path)) {
            var schemaRefs = this.schemaRefs;
            schemaRefs['actions']['properties'][node.field] = {
              "$ref": "action"
            };
            editor.setSchema(this.schema,schemaRefs);
        }
        // update the validation of input
        if (isInputLay(node.path)) {
            var schemaRefs = this.schemaRefs;
            schemaRefs[node.path[5]]['properties'][node.field] = {
              "$ref": "in_str"
            };
            editor.setSchema(this.schema,schemaRefs);
        }
        // update the validation of output
        // if (isOutputLay(node.path)) {
        //     var schemaRefs = this.schemaRefs;
        //     schemaRefs['outputs']['properties'][node.field] = {
        //       "$ref": "out_str"
        //     };
        //     editor.setSchema(this.schema,schemaRefs);
        // }

        showContextmenu();
        adjustBackground();
    }
};

var onNodeName = function(node){
    showContextmenu();
    adjustBackground();
}

var onError = function(error){
    console.log(error);
}

var onClassName = function(node){
    if (node.field == 'node_id') {
        return 'restbyconf-hide-node-id';
    }

    if(add_item_click_before_iconChildren(node)){
        return 'restbyconf-hide-add_item_click_before_icon';
    }
}

var onCreateMenu = function onCreateMenu(items, node) {
    var controller = new Array();
    var action = new Array();
    var in_str = new Array();
    var auto = new Array();
    var array = new Array();
    var obj = new Array();

    // console.log(node);
    // console.log(controller);

    for (var i = 0;  i < items.length; i++) {
        var text = items[i]['text'];
        if (text=='追加') {
            for (var j = items[i]['submenu'].length - 1; j >= 0; j--) {
                if (items[i]['submenu'][j]['text'] == 'controller') {
                    controller.push(items[i]['submenu'][j]);
                } else if (items[i]['submenu'][j]['text'] == 'action') {
                    action = items[i]['submenu'][j];
                } else if (items[i]['submenu'][j]['text'] == 'in_str') {
                    in_str = items[i]['submenu'][j];
                } else if (items[i]['submenu'][j]['text'] == '自动') {
                    auto = items[i]['submenu'][j];
                } else if (items[i]['submenu'][j]['text'] == '数组') {
                    array = items[i]['submenu'][j];
                } else if (items[i]['submenu'][j]['text'] == '对象') {
                    obj = items[i]['submenu'][j];
                }
            }
        }
    }

    if(isControllers(node.path)){
        console.log(controller);
        return items;
        return controller;
    } else {
        return items;
    }
}

var onEditable = function(node) {
  // console.log(node);
    // console.log(node);

    showContextmenu();
    adjustBackground();

    if (node.field == 'node_id' || node.field == 'add_item_click_before_icon') {
        return false;
    }

    // set editable
    var unEditable = [
        'swagger',
        'controllers'
    ];

    if (Array.isArray(node.path)) {
        var path = node.path.join('-');
        if (unEditable.indexOf(path) > -1) {
            return false;
        } else {
            if(isTagLay(node.path)){
                return true;
            } else if(isPathLay(node.path)){
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
    // console.log(window.jsoneditorOldJson);
}