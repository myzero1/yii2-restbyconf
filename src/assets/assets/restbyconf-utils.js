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
    if (path.length == 7 && path[0] == 'tags' && path[2] == 'paths' && path[4] == 'inputs') {
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

var isParamLay = function(path) {
    if (path.length == 6 && path[0] == 'tags' && path[2] == 'paths' && path[4] == 'inputs') {
        return true;
    } else {
        return false;
    }
}

var isInTag = function(path) {
    if (path.length > 0 && path[0] == 'tags') {
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
                                              console.log(6);
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

                                                    for(var i7 in json[i1][i2][i3][i4][i5][i6]) {//第七层带node_id的节点，要判断node_id
                                                        if (gettype.call(json[i1][i2][i3][i4][i5][i6][i7]) == '[object Object]') {
                                                            if ('node_id' in json[i1][i2][i3][i4][i5][i6][i7]) {
                                                                var nodeIdArray = json[i1][i2][i3][i4][i5][i6][i7]['node_id'].split('-');
                                                                if (nodeIdArray.length == 5) {
                                                                    var tmpNodeId = json[i1][i2][i3][i4][i5][i6]['node_id'] + nodeIdArray[3] + '-';
                                                                    if (tmpNodeId == json[i1][i2][i3][i4][i5][i6][i7]['node_id']) {
                                                                        
                                                                    } else {
                                                                        return true;
                                                                    }
                                                                } else {
                                                                    return true;
                                                                }
                                                            }

                                                            for(var i8 in json[i1][i2][i3][i4][i5][i6][i7]) {//第八层正常情况是不存在的
                                                                console.log(8);
                                                                var type = gettype.call(json[i1][i2][i3][i4][i5][i6][i7][i8])
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

var sleep = function(numberMillis) {
  var now = new Date();
  var exitTime = now.getTime() + numberMillis;
  while (true) {
      now = new Date();
      if (now.getTime() > exitTime)
          return true;
  }
}

var add_item_click_before_iconChildren = function(node) {
    //if(arr.indexOf(某元素) > -1){//则包含该元素}
    var path = node.path
    if (path.indexOf('add_item_click_before_icon') > -1) {
        if (node.field == 'add_item_click_before_icon') {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}