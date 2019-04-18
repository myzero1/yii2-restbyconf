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
    var data = new Array();
    var del = new Array();
    var cp = new Array();

    for (var i = 0;  i < items.length; i++) {
        var text = items[i]['text'];
        if (text=='追加') {
            for (var j = items[i]['submenu'].length - 1; j >= 0; j--) {
                if (items[i]['submenu'][j]['text'] == 'controller') {
                    controller.push(items[i]['submenu'][j]);
                } else if (items[i]['submenu'][j]['text'] == 'action') {
                    action.push(items[i]['submenu'][j]);
                } else if (items[i]['submenu'][j]['text'] == 'in_str') {
                    in_str.push(items[i]['submenu'][j]);
                } else if (items[i]['submenu'][j]['text'] == '自动') {
                    data.push(items[i]['submenu'][j]);
                } else if (items[i]['submenu'][j]['text'] == '数组') {
                    data.push(items[i]['submenu'][j]);
                } else if (items[i]['submenu'][j]['text'] == '对象') {
                    data.push(items[i]['submenu'][j]);
                }
            }
        } else if (text=='移除') {
            del = items[i];
        } else if (text=='复制') {
            cp = items[i];
        }
    }

    // console.log($(".jsoneditor-expandable.jsoneditor-highlight").text());
    console.log(node.path);
    // console.log(node);
    // console.log(controller);
    // console.log(editor.getSelection());
    // controllers{0}
    // action{4}inputs{3}body_params{1}in_str{5}path_params{1}in_str{5}query_params{1}in_str{5}outputs{3}data{0}
    if (node.path === null) {
        var selected = $(".jsoneditor-expandable.jsoneditor-highlight").text();
        if (selected === 'controllers{0}') {
            return controller;
        } else if (selected === 'actions{0}') {
            return action;
        } else if (selected === 'body_params{0}') {
            return in_str;
        } else if (selected === 'path_params{0}') {
            return in_str;
        } else if (selected === 'query_params{0}') {
            return in_str;
        } else if (selected === 'data{0}') {
            return data;
        }
    } else {
        if(isControllers(node.path)){
            controller.push(del);
            controller.push(cp);
            return controller;
        } else if(isPathLay(node.path)){
            action.push(del);
            action.push(cp);
            return action;
        } else if(isInputLay(node.path)){
            in_str.push(del);
            in_str.push(cp);
            return in_str;
        } else {
            return items;
        }
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

var onSelectionChange = function(start, end) {
    // console.log(start);
    // console.log(end);
    // console.log(node.getSelection());
}