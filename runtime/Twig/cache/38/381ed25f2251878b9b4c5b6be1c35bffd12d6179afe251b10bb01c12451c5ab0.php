<?php

/* index.html */
class __TwigTemplate_ed94884dc4d31fff63085c1df0c3dc1e8a9f3cac2dc565243e0f2b34dfe4303d extends yii\twig\Template
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
        echo "<div class=\"search\">
    <span>
        <input class=\"easyui-textbox\" type=\"text\" name=\"keywords\" id=\"keywords\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table title=\"商品品牌\" id=\"listdata\" class=\"easyui-datagrid\"
       data-options=\"
                toolbar:'#tb-user',
                rownumbers:true,
                singleSelect:true,
                pagination:true,
                method:'get',
                url:'";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/brand/index"), "html", null, true);
        echo "',
                rownumbers: false,
                pageSize:20
            \">
    <thead>
    <tr>
        <th data-options=\"field:'name', align:'center'\" width=\"150\">品牌名称</th>
        <th data-options=\"field:'alias', align:'center'\" width=\"100\">品牌别名</th>
        <th data-options=\"field:'url', align:'center'\" width=\"220\">品牌网址</th>
        <th data-options=\"field:'create_name', align:'center'\" width=\"220\">创建人</th>
        <th data-options=\"field:'created_at'\" width=\"220\" formatter=\"formatTime\">创建时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"del()\">删除</a>
    </div>
</div>

<!--编辑品牌-->
<div id=\"dlg-edit\" title=\"编辑品牌\" class=\"easyui-dialog\" style=\"width:320px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 43
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>品牌名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Brand[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>品牌别名</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Brand[alias]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>品牌网址</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Brand[url]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>品牌介绍</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Brand[intro]\" data-options=\"required:true\"></td>
        </tr>
    </table>
    ";
        // line 62
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-edit\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('edit')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-edit').dialog('close')\">取消</a>
</div>
<!--编辑品牌-->

<!--新增品牌-->
<div id=\"dlg-add\" title=\"新增品牌\" class=\"easyui-dialog\" style=\"width:320px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 73
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>品牌名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Brand[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>品牌别名</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Brand[alias]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>品牌网址</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Brand[url]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>品牌介绍</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Brand[intro]\" data-options=\"required:true\"></td>
        </tr>
    </table>
    ";
        // line 92
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增品牌-->

";
    }

    // line 103
    public function block_js($context, array $blocks = array())
    {
        // line 104
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.keywords = \$('#keywords').val();
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
    }

    function add() {
        \$('#addForm').form('clear');
        \$('#dlg-add').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择商品品牌');
            return false;
        }

        \$('#editForm').form('clear');
        \$('#dlg-edit').form('load',{
            'Brand[name]' : selRow.name,
            'Brand[alias]' : selRow.alias,
            'Brand[url]' : selRow.url,
            'Brand[intro]' : selRow.intro
        });
        \$('#dlg-edit').window('open');
    }

    function del() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择商品品牌');
            return false;
        }

        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            \$.get(\"";
        // line 149
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("brand/del"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                if (data.error) {
                    \$.messager.alert('错误', data.message, 'error');
                } else {
                    \$.messager.alert('成功', data.message);
                    reloadgrid();
                }
            }, 'json');
        });
    }

    // 确认保存
    function save(flag){
        if (flag == 'edit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/brand/edit?id=' + selRow.id;
            var form = 'editForm';
        } else if (flag == 'add') {
            var url = '/brand/add';
            var form = 'addForm';
        }


        \$('#' + form).form({
            url: url,
            onSubmit:function(){
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    window.location.href = '/brand';
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
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
        return array (  198 => 149,  151 => 104,  148 => 103,  134 => 92,  112 => 73,  98 => 62,  76 => 43,  48 => 18,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>*/
/*         <input class="easyui-textbox" type="text" name="keywords" id="keywords">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table title="商品品牌" id="listdata" class="easyui-datagrid"*/
/*        data-options="*/
/*                 toolbar:'#tb-user',*/
/*                 rownumbers:true,*/
/*                 singleSelect:true,*/
/*                 pagination:true,*/
/*                 method:'get',*/
/*                 url:'{{ url('/brand/index') }}',*/
/*                 rownumbers: false,*/
/*                 pageSize:20*/
/*             ">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'name', align:'center'" width="150">品牌名称</th>*/
/*         <th data-options="field:'alias', align:'center'" width="100">品牌别名</th>*/
/*         <th data-options="field:'url', align:'center'" width="220">品牌网址</th>*/
/*         <th data-options="field:'create_name', align:'center'" width="220">创建人</th>*/
/*         <th data-options="field:'created_at'" width="220" formatter="formatTime">创建时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="del()">删除</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <!--编辑品牌-->*/
/* <div id="dlg-edit" title="编辑品牌" class="easyui-dialog" style="width:320px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>品牌名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Brand[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>品牌别名</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Brand[alias]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>品牌网址</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Brand[url]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>品牌介绍</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Brand[intro]" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-edit" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('edit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')">取消</a>*/
/* </div>*/
/* <!--编辑品牌-->*/
/* */
/* <!--新增品牌-->*/
/* <div id="dlg-add" title="新增品牌" class="easyui-dialog" style="width:320px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>品牌名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Brand[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>品牌别名</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Brand[alias]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>品牌网址</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Brand[url]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>品牌介绍</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Brand[intro]" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增品牌-->*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.keywords = $('#keywords').val();*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* */
/*     function add() {*/
/*         $('#addForm').form('clear');*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择商品品牌');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#editForm').form('clear');*/
/*         $('#dlg-edit').form('load',{*/
/*             'Brand[name]' : selRow.name,*/
/*             'Brand[alias]' : selRow.alias,*/
/*             'Brand[url]' : selRow.url,*/
/*             'Brand[intro]' : selRow.intro*/
/*         });*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择商品品牌');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             $.get("{{ url('brand/del') }}", {'id':selRow.id}, function(data) {*/
/*                 if (data.error) {*/
/*                     $.messager.alert('错误', data.message, 'error');*/
/*                 } else {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     reloadgrid();*/
/*                 }*/
/*             }, 'json');*/
/*         });*/
/*     }*/
/* */
/*     // 确认保存*/
/*     function save(flag){*/
/*         if (flag == 'edit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/brand/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*         } else if (flag == 'add') {*/
/*             var url = '/brand/add';*/
/*             var form = 'addForm';*/
/*         }*/
/* */
/* */
/*         $('#' + form).form({*/
/*             url: url,*/
/*             onSubmit:function(){*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     window.location.href = '/brand';*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
