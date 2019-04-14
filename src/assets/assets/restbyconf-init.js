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
    enableSort: false,
    enableTransform: false,
    templates: templates,
    // onValidate: onValidate,
    onEditable: onEditable,
    onCreateMenu: onCreateMenu,
    onNodeName: onNodeName,
    onClassName: onClassName,
    onChangeJSON: onChangeJSON,
    onEvent: onEvent

};

var container = document.getElementById('jsoneditor');
window.jsoneditorCanUpdateOldJson = true;
var editor = new JSONEditor(container, defaultOptions, window.jsoneditorOldJson);
editor.setSelection({path: ["controllers"]}); // order to set node id is ok.
// editor.setSelection({path: ["controllers","Demo"]}); // order to set node id is ok.
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
    .restbyconf-hide-add_item_click_before_icon{
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