<?php

/* index.html */
class __TwigTemplate_5017ecbae0400aafe2b50d5e54026c45cbbcecf31e623a724d55db0b670425f7 extends yii\twig\Template
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
        echo "<!--<div class=\"search\">-->
    <!--<span>-->
        <!--<input class=\"easyui-textbox\" type=\"text\" name=\"keywords\" id=\"keywords\">-->
    <!--</span>-->
    <!--<a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>-->
<!--</div>-->

<table title=\"角色列表\" id=\"listdata\" class=\"easyui-datagrid\"
       data-options=\"
                toolbar:'#tb-user',
                rownumbers:true,
                singleSelect:true,
                pagination:true,
                method:'get',
                url:'";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/role/index"), "html", null, true);
        echo "',
                rownumbers: false
            \">
    <thead>
    <tr>
        <th data-options=\"field:'name', align:'center'\" width=\"150\">角色</th>
        <th data-options=\"field:'created_at', align:'center'\" width=\"220\" formatter=\"formatTime\">创建时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 31
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 32
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 34
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 35
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">权限设置</a>
        ";
        }
        // line 37
        echo "        ";
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 38
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 40
        echo "    </div>
</div>

<!--新增角色-->
<div id=\"dlg-add\" title=\"新增角色\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 45
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>角色名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Role[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>权限设置</td>
            <td><select name=\"Role[privilege][]\" class=\"easyui-combotree\" id=\"add_privilege\" multiple style=\"width:200px;\"></select></td>
        </tr>
    </table>
    ";
        // line 56
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增角色-->

<!--编辑角色-->
<div id=\"dlg-edit\" title=\"编辑角色\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 67
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>角色名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Role[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>权限设置</td>
            <td><select name=\"Role[privilege][]\" class=\"easyui-combotree\" id=\"edit_privilege\" multiple style=\"width:200px;\"></select></td>
        </tr>
    </table>
    ";
        // line 78
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-edit\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('edit')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-edit').dialog('close')\">取消</a>
</div>
<!--编辑角色-->

";
    }

    // line 89
    public function block_js($context, array $blocks = array())
    {
        // line 90
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
        \$('#add_privilege').combotree({
            url: \"";
        // line 108
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/menu-list"), "html", null, true);
        echo "\",
            method: 'get',
            cascadeCheck: false,
            onCheck: function (node, checked) {
                myCascadeCheck(\$('#add_privilege'), node, checked);
            }
        });
        \$('#dlg-add').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择角色');
            return false;
        }

        \$('#editForm').form('clear');
        \$('#edit_privilege').combotree({
            url: \"";
        // line 127
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/menu-list"), "html", null, true);
        echo "\",
            method: 'get',
            cascadeCheck: false,
            onCheck: function (node, checked) {
                myCascadeCheck(\$('#edit_privilege'), node, checked);
            }
        });
        \$('#dlg-edit').form('load',{
            'Role[name]' : selRow.name
        });
        \$('#edit_privilege').combotree('setValues', selRow.privilege.split(\",\"));

        \$('#dlg-edit').window('open');
    }

    function del() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择角色');
            return false;
        }

        \$.messager.confirm('Confirm', '您确定删除该角色？删除后该角色下的账号需重新分配角色', function(r) {
            if (r) {
                \$.get(\"";
        // line 151
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("role/del"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                    if (data.error) {
                        \$.messager.alert('错误', data.message, 'error');
                    } else {
                        \$.messager.alert('成功', data.message);
                        reloadgrid();
                    }
                }, 'json');
            }
        });
    }

    // 确认保存
    function save(flag){
        if (flag == 'edit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/role/edit?id=' + selRow.id;
            var form = 'editForm';
        } else if (flag == 'add') {
            var url = '/role/add';
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
                    window.location.href = '/role';
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
        return array (  219 => 151,  192 => 127,  170 => 108,  150 => 90,  147 => 89,  133 => 78,  119 => 67,  105 => 56,  91 => 45,  84 => 40,  80 => 38,  77 => 37,  73 => 35,  70 => 34,  66 => 32,  64 => 31,  48 => 18,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <!--<div class="search">-->*/
/*     <!--<span>-->*/
/*         <!--<input class="easyui-textbox" type="text" name="keywords" id="keywords">-->*/
/*     <!--</span>-->*/
/*     <!--<a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>-->*/
/* <!--</div>-->*/
/* */
/* <table title="角色列表" id="listdata" class="easyui-datagrid"*/
/*        data-options="*/
/*                 toolbar:'#tb-user',*/
/*                 rownumbers:true,*/
/*                 singleSelect:true,*/
/*                 pagination:true,*/
/*                 method:'get',*/
/*                 url:'{{ url('/role/index') }}',*/
/*                 rownumbers: false*/
/*             ">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'name', align:'center'" width="150">角色</th>*/
/*         <th data-options="field:'created_at', align:'center'" width="220" formatter="formatTime">创建时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if add == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*         {% endif %}*/
/*         {% if edit == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">权限设置</a>*/
/*         {% endif %}*/
/*         {% if del == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增角色-->*/
/* <div id="dlg-add" title="新增角色" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>角色名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Role[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>权限设置</td>*/
/*             <td><select name="Role[privilege][]" class="easyui-combotree" id="add_privilege" multiple style="width:200px;"></select></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增角色-->*/
/* */
/* <!--编辑角色-->*/
/* <div id="dlg-edit" title="编辑角色" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>角色名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Role[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>权限设置</td>*/
/*             <td><select name="Role[privilege][]" class="easyui-combotree" id="edit_privilege" multiple style="width:200px;"></select></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-edit" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('edit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')">取消</a>*/
/* </div>*/
/* <!--编辑角色-->*/
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
/*         $('#add_privilege').combotree({*/
/*             url: "{{ url('auth/menu-list') }}",*/
/*             method: 'get',*/
/*             cascadeCheck: false,*/
/*             onCheck: function (node, checked) {*/
/*                 myCascadeCheck($('#add_privilege'), node, checked);*/
/*             }*/
/*         });*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择角色');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#editForm').form('clear');*/
/*         $('#edit_privilege').combotree({*/
/*             url: "{{ url('auth/menu-list') }}",*/
/*             method: 'get',*/
/*             cascadeCheck: false,*/
/*             onCheck: function (node, checked) {*/
/*                 myCascadeCheck($('#edit_privilege'), node, checked);*/
/*             }*/
/*         });*/
/*         $('#dlg-edit').form('load',{*/
/*             'Role[name]' : selRow.name*/
/*         });*/
/*         $('#edit_privilege').combotree('setValues', selRow.privilege.split(","));*/
/* */
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择角色');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '您确定删除该角色？删除后该角色下的账号需重新分配角色', function(r) {*/
/*             if (r) {*/
/*                 $.get("{{ url('role/del') }}", {'id':selRow.id}, function(data) {*/
/*                     if (data.error) {*/
/*                         $.messager.alert('错误', data.message, 'error');*/
/*                     } else {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         reloadgrid();*/
/*                     }*/
/*                 }, 'json');*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     // 确认保存*/
/*     function save(flag){*/
/*         if (flag == 'edit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/role/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*         } else if (flag == 'add') {*/
/*             var url = '/role/add';*/
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
/*                     window.location.href = '/role';*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
