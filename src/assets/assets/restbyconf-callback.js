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
var onValidate = function onValidate(json) {
    if (editor!=null) {
        if (!('node_id' in json['tags'])) {
            json['tags']['node_id'] = new Date().getTime()+'-';
            editor.update(json);
            window.jsoneditorOldJson = json;
        }
    }
    
}

var onEvent = function(node, event){
  // console.log(node);
    if (event.type == 'blur') {
        // update the validation of tag
        if (isTagLay(node.path)) {
            var schemaRefs = this.schemaRefs;
            schemaRefs['tags']['properties'][node.field] = {
              "$ref": "tag"
            };
            editor.setSchema(this.schema,schemaRefs);
        }
        // update the validation of action
        if (isPathLay(node.path)) {
            var schemaRefs = this.schemaRefs;
            schemaRefs['paths']['properties'][node.field] = {
              "$ref": "action"
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
        // getChangeData();
    }
};

var onNodeName = function(node){
    showContextmenu();
    adjustBackground();

    if (editor!=null) {
        var path = node.path;
        var json = editor.get();
        var path = node.path;
        var length = path.length;
        
        if (isInTag(path)) {
            var json = editor.get();
            var path = node.path;
            if (length == 1) {
                if (!('node_id' in json[path[0]])) {
                    json[path[0]]['node_id'] = new Date().getTime()+'-';
                    editor.update(json);
                    window.jsoneditorOldJson = json;
                }
            } else if (node.size >= 1) {
                if (length == 2) {
                    if ('node_id' in json[path[0]]) {
                        if (!('node_id' in json[path[0]][path[1]])) {
                            var tagNodeId = json[path[0]]['node_id'] + new Date().getTime()+'-';
                            json[path[0]][path[1]]['node_id'] = tagNodeId;
                            editor.update(json);
                            window.jsoneditorOldJson = json;
                        }
                    }
                } else if (length == 3) {
                    if ('node_id' in json[path[0]][path[1]]) {
                        if (!('node_id' in json[path[0]][path[1]][path[2]])) {
                            var tagNodeId = json[path[0]][path[1]]['node_id'] + new Date().getTime()+'-';
                            json[path[0]][path[1]][path[2]]['node_id'] = tagNodeId;
                            editor.update(json);
                            window.jsoneditorOldJson = json;
                        }
                    }
                } else if (length == 4) {
                    if ('node_id' in json[path[0]][path[1]][path[2]]) {
                        if (!('node_id' in json[path[0]][path[1]][path[2]][path[3]])) {
                            var tagNodeId = json[path[0]][path[1]][path[2]]['node_id'] + new Date().getTime()+'-';
                            json[path[0]][path[1]][path[2]][path[3]]['node_id'] = tagNodeId;
                            editor.update(json);
                            window.jsoneditorOldJson = json;
                        }
                    }
                } else if (length == 5) {
                    if ('node_id' in json[path[0]][path[1]][path[2]][path[3]]) {
                        if (!('node_id' in json[path[0]][path[1]][path[2]][path[3]][path[4]])) {
                            var tagNodeId = json[path[0]][path[1]][path[2]][path[3]]['node_id'] + new Date().getTime()+'-';
                            json[path[0]][path[1]][path[2]][path[3]][path[4]]['node_id'] = tagNodeId;
                            editor.update(json);
                            window.jsoneditorOldJson = json;
                        }
                    }
                } else if (length == 6) {
                    if ('node_id' in json[path[0]][path[1]][path[2]][path[3]][path[4]]) {
                        if (!('node_id' in json[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]])) {
                            var tagNodeId = json[path[0]][path[1]]['node_id'] + new Date().getTime()+'-';
                            json[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]]['node_id'] = tagNodeId;
                            editor.update(json);
                            window.jsoneditorOldJson = json;
                        }
                    }
                } else if (length == 7) {
                    if ('node_id' in json[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]]) {
                        if (!('node_id' in json[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]][path[6]])) {
                            var tagNodeId = json[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]]['node_id'] + new Date().getTime()+'-';
                            json[path[0]][path[1]][path[2]][path[3]][path[4]][path[5]][path[6]]['node_id'] = tagNodeId;
                            editor.update(json);
                            window.jsoneditorOldJson = json;
                        }
                    }
                }
            }
        }
    }
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
    function inArray(value, array){
        for (var i = array.length - 1; i >= 0; i--) {
            if (array[i] == value) {
                return true;
            }
        }

        return false;
    }

    var length = node.path.length;
    var field = node.path[length-1];

    if(isTagLay(node.path)){
        var itemsTmp  = new Array();
        for (var i = 0;  i < items.length; i++) {
            var text = items[i]['text'];
            if (text=='插入' && field=='add_item_click_before_icon') {
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
                if (field=='add_item_click_before_icon') {
                    alert('add_item_click_before_icon不能被删除');
                } else {
                    delete(jsonData[path[0]][path[1]]);
                    editor.update(jsonData);
                }
            }
        } );
        return itemsTmp;
    } else if(isPathLay(node.path)){
        var itemsTmp  = new Array();
        for (var i = 0;  i < items.length; i++) {
            var text = items[i]['text'];
            if (text=='插入' && field=='add_item_click_before_icon') {
                // console.log(items[i]['submenu']);
                for (var j = items[i]['submenu'].length - 1; j >= 0; j--) {
                    if (items[i]['submenu'][j]['text'] == 'action') {
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
                var tmp = jsonData[path[0]][path[1]][path[2]];
                delete(tmp[path[3]]);
                if (JSON.stringify(tmp) == "{}") {
                    alert('必须保留一个path');
                } else {
                    delete(jsonData[path[0]][path[1]][path[2]][path[3]]);
                    editor.update(jsonData);
                }
            }
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
                }
            }
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
                }
            }
        } );


        return itemsTmp;
    } else {
        return [];
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
        'tags'
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