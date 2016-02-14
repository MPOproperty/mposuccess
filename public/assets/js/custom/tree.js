/**
 * Created by NotPrometey on 20.10.2015.
 */
$(function(){
    $("#tree_4").jstree({
        "core" : {
            "themes" : {
                "responsive": false
            },
            // so that create works
            "check_callback" : false,
            'data' : {
                'url' : function (node) {
                    return '/api/get/tree';
                },
                'data' : function (node) {
                    return { 'parent' : node.id };
                }
            }
        },
        "types" : {
            "default" : {
                "icon" : "fa fa-child icon-state-success icon-lg"
            }
        },
        "state" : { "key" : "demo3" },
        "plugins" : [ "dnd", "state", "types" ]
    });
});