<?php

/* index.html */
class __TwigTemplate_422d2514caa7c4b9f5e658848cb579aa7582c296d3b3c9b1c2c3e81a46d9d8db extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "index.html", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@app/views/base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "<style>
    .datagrid-btable tr{height: 120px!important;}
</style>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"banner列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("banner/index"), "html", null, true);
        echo "',nowrap:false,rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:150, align:'center'\">编号</th>
        <th data-options=\"field:'from', width:150, align:'center'\" formatter=\"formatFrom\">来源</th>
        <th data-options=\"field:'name', width:180, align:'center'\">名称</th>
        <th data-options=\"field:'status', width:180, align:'center'\"  formatter=\"formatStatus\">是否开启</th>
        <th data-options=\"field:'picture',width:300, align:'center'\" formatter=\"formatPicture\">图片</th>
        <th data-options=\"field:'link', width:180, align:'center'\">链接地址</th>
        <th data-options=\"field:'source', width:100, align:'center'\">终端</th>
        <th data-options=\"field:'width', width:150, align:'center'\" formatter=\"formatSize\">长宽</th>
        <th data-options=\"field:'starttime', width:150, align:'center'\"  formatter=\"formatStart\">开始时间</th>
        <th data-options=\"field:'endtime', width:150, align:'center'\"  formatter=\"formatEnd\">结束时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 27
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 28
            echo "            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 30
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 31
            echo "            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">修改</a>
        ";
        }
        // line 33
        echo "        ";
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 34
            echo "            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 36
        echo "    </div>
</div>


<div id=\"dlg-add\" class=\"easyui-window\" title=\"新增banner\" style=\"width:460px;height:500px;padding:10px;overflow:hidden;\" data-options=\"width:440,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ \$(this).window('hcenter');}\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"add_iframe\">
    </iframe>
</div>

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"修改banner\" style=\"width:500px;height:600px;padding:10px;overflow:hidden;\" data-options=\"width:440,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ \$(this).window('hcenter');}\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
</div>
";
    }

    // line 51
    public function block_js($context, array $blocks = array())
    {
        // line 52
        echo "<script>
function del(){
    var selRow = \$('#listdata').datagrid('getSelected');
    if (!selRow) {
        \$.messager.alert('错误','请选择banner');
        return false;
    }
    \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
        \$.get(\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("banner/del"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
            if (data.error) {
                \$.messager.alert('错误', data.message, 'error');
            } else {
                \$.messager.alert('成功', data.message);
                window.location.reload();
            }
        }, 'json');
    });
}

function formatStatus(val, row){
    if(val == 1) return '开启';
    else return '关闭';
}

function edit(){
    var selRow = \$('#listdata').datagrid('getSelected');
    if (!selRow) {
        \$.messager.alert('错误','请选择banner');
        return false;
    }
    \$('#edit_iframe').prop('src', \"";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("banner/edit"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
    \$('#dlg-edit').window('open');
}

function add(){
    \$('#add_iframe').prop('src', \"";
        // line 87
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("banner/add"), "html", null, true);
        echo "\");
    \$('#dlg-add').window('open');
}

function formatFrom(val, row) {
    if (val==1) {
        return '伙购网';
    } else if (val==2) {
        return '滴滴夺宝';
    }
}

function formatPicture(val, row) {
    return '<a target=\"_blank\" href=\"#\"><img src=\"'+val+'\"></a>';
}

function formatSize(val, row){
    return row.width + '*' + row.height;
}

function formatStart(val, row){
    if(val != 0) return new Date(parseInt(val) * 1000).toLocaleString().substr(0,17);
    else return '永久';
}

function formatEnd(val, row){
    if(val != 0) return new Date(parseInt(val) * 1000).toLocaleString().substr(0,17);
    else return '永久';
}
</script>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 87,  135 => 82,  110 => 60,  100 => 52,  97 => 51,  80 => 36,  76 => 34,  73 => 33,  69 => 31,  66 => 30,  62 => 28,  60 => 27,  38 => 8,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style>*/
/*     .datagrid-btable tr{height: 120px!important;}*/
/* </style>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="banner列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('banner/index')}}',nowrap:false,rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:150, align:'center'">编号</th>*/
/*         <th data-options="field:'from', width:150, align:'center'" formatter="formatFrom">来源</th>*/
/*         <th data-options="field:'name', width:180, align:'center'">名称</th>*/
/*         <th data-options="field:'status', width:180, align:'center'"  formatter="formatStatus">是否开启</th>*/
/*         <th data-options="field:'picture',width:300, align:'center'" formatter="formatPicture">图片</th>*/
/*         <th data-options="field:'link', width:180, align:'center'">链接地址</th>*/
/*         <th data-options="field:'source', width:100, align:'center'">终端</th>*/
/*         <th data-options="field:'width', width:150, align:'center'" formatter="formatSize">长宽</th>*/
/*         <th data-options="field:'starttime', width:150, align:'center'"  formatter="formatStart">开始时间</th>*/
/*         <th data-options="field:'endtime', width:150, align:'center'"  formatter="formatEnd">结束时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if(add == 1) %}*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*         {% endif %}*/
/*         {% if(edit == 1) %}*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">修改</a>*/
/*         {% endif %}*/
/*         {% if(del == 1) %}*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* */
/* <div id="dlg-add" class="easyui-window" title="新增banner" style="width:460px;height:500px;padding:10px;overflow:hidden;" data-options="width:440,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ $(this).window('hcenter');}">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="add_iframe">*/
/*     </iframe>*/
/* </div>*/
/* */
/* <div id="dlg-edit" class="easyui-window" title="修改banner" style="width:500px;height:600px;padding:10px;overflow:hidden;" data-options="width:440,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ $(this).window('hcenter');}">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*     </iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/* function del(){*/
/*     var selRow = $('#listdata').datagrid('getSelected');*/
/*     if (!selRow) {*/
/*         $.messager.alert('错误','请选择banner');*/
/*         return false;*/
/*     }*/
/*     $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*         $.get("{{ url('banner/del') }}", {'id':selRow.id}, function(data) {*/
/*             if (data.error) {*/
/*                 $.messager.alert('错误', data.message, 'error');*/
/*             } else {*/
/*                 $.messager.alert('成功', data.message);*/
/*                 window.location.reload();*/
/*             }*/
/*         }, 'json');*/
/*     });*/
/* }*/
/* */
/* function formatStatus(val, row){*/
/*     if(val == 1) return '开启';*/
/*     else return '关闭';*/
/* }*/
/* */
/* function edit(){*/
/*     var selRow = $('#listdata').datagrid('getSelected');*/
/*     if (!selRow) {*/
/*         $.messager.alert('错误','请选择banner');*/
/*         return false;*/
/*     }*/
/*     $('#edit_iframe').prop('src', "{{ url('banner/edit') }}" + '?id=' + selRow.id);*/
/*     $('#dlg-edit').window('open');*/
/* }*/
/* */
/* function add(){*/
/*     $('#add_iframe').prop('src', "{{ url('banner/add') }}");*/
/*     $('#dlg-add').window('open');*/
/* }*/
/* */
/* function formatFrom(val, row) {*/
/*     if (val==1) {*/
/*         return '伙购网';*/
/*     } else if (val==2) {*/
/*         return '滴滴夺宝';*/
/*     }*/
/* }*/
/* */
/* function formatPicture(val, row) {*/
/*     return '<a target="_blank" href="#"><img src="'+val+'"></a>';*/
/* }*/
/* */
/* function formatSize(val, row){*/
/*     return row.width + '*' + row.height;*/
/* }*/
/* */
/* function formatStart(val, row){*/
/*     if(val != 0) return new Date(parseInt(val) * 1000).toLocaleString().substr(0,17);*/
/*     else return '永久';*/
/* }*/
/* */
/* function formatEnd(val, row){*/
/*     if(val != 0) return new Date(parseInt(val) * 1000).toLocaleString().substr(0,17);*/
/*     else return '永久';*/
/* }*/
/* </script>*/
/* {% endblock %}*/
