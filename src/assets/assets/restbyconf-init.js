var restbyconfOptionsStr = $("#restbyconfoptions").text();
var restbyconfpositionStr = $("#restbyconfposition").text();
restbyconfOptionsStr = restbyconfOptionsStr.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
var restbyconfpositionStr = restbyconfpositionStr.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
var restbyconfposition = JSON.parse(restbyconfpositionStr);
var restbyconfpositionOld = JSON.parse(restbyconfpositionStr);

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
    enableSort: false,
    enableTransform: false,
    templates: templates,
    // onValidate: onValidate,
    onEditable: onEditable,
    onCreateMenu: onCreateMenu,
    // onNodeName: onNodeName,
    // onClassName: onClassName,
    onChangeJSON: onChangeJSON,
    onError: onError,
    onSelectionChange: onSelectionChange,
    onEvent: onEvent

};

var container = document.getElementById('jsoneditor');
window.jsoneditorCanUpdateOldJson = true;
var editor = new JSONEditor(container, defaultOptions, window.jsoneditorOldJson);

// for set position
while(restbyconfposition.length > 0){
    if (editor.node.findNodeByPath(restbyconfposition) != undefined) {
        editor.node.findNodeByPath(restbyconfposition).expand(false);
    }
    restbyconfposition.pop();
}
editor.setSelection({path: restbyconfpositionOld});

// for style
var style = `
<style>
    .jsoneditor-dragarea{
        display:none;
    }
    // .jsoneditor-button.jsoneditor-contextmenu{
    //     display:none;
    // }
    // .restbyconf-hide-node-id{
    //     display:none;
    // }
    // .restbyconf-hide-add_item_click_before_icon{
    //     display:none;
    // }
    // .jsoneditor-collapse-all, .jsoneditor-expand-all{
    //     display:none;
    // }
</style>
`;
$("body").append(style);

// for init 
// showContextmenu();
// adjustBackground();


$(document).on("click",".jsoneditor-expand-all",function(){
    showContextmenu();
    adjustBackground();
    $(".restbyconf-hide-add_item_click_before_icon").parents('tr').hide();
});



$(document).on("click","#jsoneditor",function(){
    var treepath = $('.jsoneditor-treepath').text();
    treepath = treepath.split('►');
    treepath.shift();
    var last = treepath[treepath.length-1];
    if (last == "") {
        treepath.pop();
    }

    document.getElementById("generator-position").value = JSON.stringify(treepath);
});