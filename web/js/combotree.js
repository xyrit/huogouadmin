/**
 * Created by chenyi on 2015/12/29.
 */
/**
 * combobox和combotree模糊查询
 */
(function(){
    //combobox可编辑，自定义模糊查询
    $.fn.combobox.defaults.editable = true;
    $.fn.combobox.defaults.filter = function(q, row){
        var opts = $(this).combobox('options');
        return row[opts.textField].indexOf(q) >= 0;
    };
    //combotree可编辑，自定义模糊查询
    $.fn.combotree.defaults.editable = true;
    $.extend($.fn.combotree.defaults.keyHandler,{
        up:function(){
            console.log('up');
        },
        down:function(){
            console.log('down');
        },
        enter:function(){
            console.log('enter');
        },
        query:function(q){
            var t = $(this).combotree('tree');
            var nodes = t.tree('getChildren');
            for(var i=0; i<nodes.length; i++){
                var node = nodes[i];
                if (node.text.indexOf(q) >= 0){
                    $(node.target).show();
                } else {
                    $(node.target).hide();
                }
            }
            var opts = $(this).combotree('options');
            if (!opts.hasSetEvents){
                opts.hasSetEvents = true;
                var onShowPanel = opts.onShowPanel;
                opts.onShowPanel = function(){
                    var nodes = t.tree('getChildren');
                    for(var i=0; i<nodes.length; i++){
                        $(nodes[i].target).show();
                    }
                    onShowPanel.call(this);
                };
                $(this).combo('options').onShowPanel = opts.onShowPanel;
            }
        }
    });
})(jQuery);

var myCascadeCheck = function(obj, node, checked) {
    if ($(node.target).hasClass('tree-node-hover')) {
        var t = obj.combotree("tree");
        if (checked) {
            tempNode = node;
            //循环遍历父节点
            while (tempNode) {
                var parentNode = t.tree('getParent', tempNode.target);//父节点
                tempNode = parentNode;
                if (tempNode) {
                    t.tree('check', tempNode.target);
                }

            }

            var childNode = t.tree('getChildren', node.target);
            if (childNode != null) {
                $.each(childNode, function(i, v) {
                    obj.combotree('tree').tree('check', v.target);
                })
            }
        } else {
            var childNode = t.tree('getChildren', node.target);
            if (childNode != null) {
                $.each(childNode, function(i, v) {
                    obj.combotree('tree').tree('uncheck', v.target);
                })
            }
        }
    }
}
