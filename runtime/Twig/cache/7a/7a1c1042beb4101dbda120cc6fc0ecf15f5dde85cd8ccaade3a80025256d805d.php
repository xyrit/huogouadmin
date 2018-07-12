<?php

/* index.html */
class __TwigTemplate_3e593d065a78d385675950e93c4917f1d4cb07db56f314ef3822d5c9ed5f9181 extends yii\twig\Template
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
        echo "
<div class=\"search\">
    <span>快递名称 <input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <span>管理员<input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <span>状态
        <select class=\"easyui-combobox\" id=\"status\" name=\"status\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"0\">正常</option>
            <option value=\"1\">冻结</option>
        </select>
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"快递列表\"
       data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("express"), "html", null, true);
        echo "',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">编号</th>
        <th data-options=\"field:'name'\">快递名称</th>
        <th data-options=\"field:'keyword', width:100\">快递代号</th>
        <th data-options=\"field:'admin', width:100\">添加人</th>
        <th data-options=\"field:'created_at', width:180\" formatter=\"formatTime\">创建时间</th>
        <th data-options=\"field:'updated_at', width:180\" formatter=\"formatTime\">更新时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 34
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 35
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 37
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 38
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        ";
        }
        // line 40
        echo "        ";
        if (((isset($context["status"]) ? $context["status"] : null) == 1)) {
            // line 41
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-ok',plain:true\" onclick=\"status(0)\">启用</a>
        ";
        }
        // line 43
        echo "        ";
        if (((isset($context["status"]) ? $context["status"] : null) == 1)) {
            // line 44
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-no',plain:true\" onclick=\"status(1)\">冻结</a>
        ";
        }
        // line 46
        echo "        ";
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 47
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 49
        echo "    </div>
</div>

<!--新增员工-->
<div id=\"dlg-add\" title=\"新增快递\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 54
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>快递名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"name\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>快递代号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"keyword\" data-options=\"required:true\"></td>
        </tr>
    </table>
    ";
        // line 65
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增员工-->

<!--编辑员工-->
<div id=\"dlg-edit\" title=\"编辑员工\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 76
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>快递名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"name\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>快递代号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"keyword\" data-options=\"required:true\"></td>
        </tr>
    </table>
    ";
        // line 87
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-edit\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('edit')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-edit').dialog('close')\">取消</a>
</div>
<!--编辑员工-->

";
    }

    // line 98
    public function block_js($context, array $blocks = array())
    {
        // line 99
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.account = \$('#account').val();
        queryParams.role\t= \$('#role').combobox('getValue');
        queryParams.status\t= \$('#status').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    //格式化状态
    function formatStatus(val, row) {
        if (val == 0) {
            return '<span style=\"color:red\">启用</span>';
        } else {
            return '<span style=\"color:red\">冻结</span>';
        }
    }

    function formatTime(val, row) {
        return new Date(parseInt(val) * 1000).toLocaleString();
    }

    function addOnSelect(record) {
        \$.get(\"";
        // line 123
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("role/get-role-privilege"), "html", null, true);
        echo "\", {id: record.id}, function(data) {
            \$('#add_privilege').combotree('setValues', data.privilege.split(\",\"));
            \$('#add_privilege_tr').show();
        }, 'json');
    }

    function editOnSelect(record) {
        \$.get(\"";
        // line 130
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("role/get-role-privilege"), "html", null, true);
        echo "\", {id: record.id}, function(data) {
            \$('#edit_privilege').combotree('setValues', data.privilege.split(\",\"));
            \$('#edit_privilege_tr').show();
        }, 'json');
    }

    function add() {
        \$('#addForm').form('clear');
        \$('#role_add').combobox({
            url:\"";
        // line 139
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("express/add"), "html", null, true);
        echo "\",
            method:'get',
            valueField: 'id',
            textField: 'text'
        });
        \$('#add_privilege').combotree({
            url: \"";
        // line 145
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("express/index"), "html", null, true);
        echo "\",
            method: 'get',
            cascadeCheck: false,
            onCheck: function (node, checked) {
                myCascadeCheck(\$('#add_privilege'), node, checked);
            }
        });
        \$('.privilege_tr').hide();
        \$('#dlg-add').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        console.log(selRow);
        if (!selRow) {
            \$.messager.alert('错误','请选择对象');
            return false;
        }

        \$('#editForm').form('clear');
        \$('#role_edit').combobox({
            url:\"";
        // line 166
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("express/index"), "html", null, true);
        echo "\",
            method:'get',
            valueField: 'id',
            textField: 'text'
        });
        \$('#edit_privilege').combotree({
            url: \"";
        // line 172
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/menu-list"), "html", null, true);
        echo "\",
            method: 'get',
            cascadeCheck: false,
            onCheck: function (node, checked) {
                myCascadeCheck(\$('#edit_privilege'), node, checked);
            }
        });
        \$('#dlg-edit').form('load',{
            'name' : selRow.name,
            'keyword' : selRow.keyword

        });
       // \$('#edit_privilege').combotree('setValues', selRow.privilege.split(\",\"));

        \$('#dlg-edit').window('open');
    }

    function del() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择账号');
            return false;
        }

        \$.messager.confirm('Confirm', '您确定删除该账号？', function(r) {
            if (r) {
                \$.post(\"";
        // line 198
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("employee/del"), "html", null, true);
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
            var url = '/express/edit?id=' + selRow.id;
            var form = 'editForm';
        } else if (flag == 'add') {
            var url = '/express/add';
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
                    window.location.href = '/express';
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
    }

    function status(flag) {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择员工');
            return false;
        }
        if (selRow.status == flag) {
            \$.messager.alert('错误','该账号已' + (flag == 0 ? \"启用\" : \"冻结\"));
            return false;
        }

        \$.messager.confirm('Confirm', '您确定'+(flag == 0 ? \"启用\" : \"冻结\")+'该账号', function(r) {
            if (r) {
                \$.post(\"";
        // line 253
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("employee/change-status"), "html", null, true);
        echo "\", {id: selRow.id, status: flag}, function(data) {
                    if (data.error == 0) {
                        \$.messager.alert('成功', data.message);
                        reloadgrid();
                    } else {
                        \$.messager.alert('失败', data.message, 'error');
                    }
                })
            }
        });
    }
    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
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
        return array (  344 => 253,  286 => 198,  257 => 172,  248 => 166,  224 => 145,  215 => 139,  203 => 130,  193 => 123,  167 => 99,  164 => 98,  150 => 87,  136 => 76,  122 => 65,  108 => 54,  101 => 49,  97 => 47,  94 => 46,  90 => 44,  87 => 43,  83 => 41,  80 => 40,  76 => 38,  73 => 37,  69 => 35,  67 => 34,  49 => 19,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>快递名称 <input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <span>管理员<input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <span>状态*/
/*         <select class="easyui-combobox" id="status" name="status" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="0">正常</option>*/
/*             <option value="1">冻结</option>*/
/*         </select>*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="快递列表"*/
/*        data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{  url('express')}}',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">编号</th>*/
/*         <th data-options="field:'name'">快递名称</th>*/
/*         <th data-options="field:'keyword', width:100">快递代号</th>*/
/*         <th data-options="field:'admin', width:100">添加人</th>*/
/*         <th data-options="field:'created_at', width:180" formatter="formatTime">创建时间</th>*/
/*         <th data-options="field:'updated_at', width:180" formatter="formatTime">更新时间</th>*/
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
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         {% endif %}*/
/*         {% if status == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="status(0)">启用</a>*/
/*         {% endif %}*/
/*         {% if status == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-no',plain:true" onclick="status(1)">冻结</a>*/
/*         {% endif %}*/
/*         {% if del == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增员工-->*/
/* <div id="dlg-add" title="新增快递" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>快递名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="name" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>快递代号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="keyword" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增员工-->*/
/* */
/* <!--编辑员工-->*/
/* <div id="dlg-edit" title="编辑员工" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>快递名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="name" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>快递代号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="keyword" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-edit" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('edit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')">取消</a>*/
/* </div>*/
/* <!--编辑员工-->*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.account = $('#account').val();*/
/*         queryParams.role	= $('#role').combobox('getValue');*/
/*         queryParams.status	= $('#status').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     //格式化状态*/
/*     function formatStatus(val, row) {*/
/*         if (val == 0) {*/
/*             return '<span style="color:red">启用</span>';*/
/*         } else {*/
/*             return '<span style="color:red">冻结</span>';*/
/*         }*/
/*     }*/
/* */
/*     function formatTime(val, row) {*/
/*         return new Date(parseInt(val) * 1000).toLocaleString();*/
/*     }*/
/* */
/*     function addOnSelect(record) {*/
/*         $.get("{{ url('role/get-role-privilege') }}", {id: record.id}, function(data) {*/
/*             $('#add_privilege').combotree('setValues', data.privilege.split(","));*/
/*             $('#add_privilege_tr').show();*/
/*         }, 'json');*/
/*     }*/
/* */
/*     function editOnSelect(record) {*/
/*         $.get("{{ url('role/get-role-privilege') }}", {id: record.id}, function(data) {*/
/*             $('#edit_privilege').combotree('setValues', data.privilege.split(","));*/
/*             $('#edit_privilege_tr').show();*/
/*         }, 'json');*/
/*     }*/
/* */
/*     function add() {*/
/*         $('#addForm').form('clear');*/
/*         $('#role_add').combobox({*/
/*             url:"{{ url('express/add') }}",*/
/*             method:'get',*/
/*             valueField: 'id',*/
/*             textField: 'text'*/
/*         });*/
/*         $('#add_privilege').combotree({*/
/*             url: "{{ url('express/index') }}",*/
/*             method: 'get',*/
/*             cascadeCheck: false,*/
/*             onCheck: function (node, checked) {*/
/*                 myCascadeCheck($('#add_privilege'), node, checked);*/
/*             }*/
/*         });*/
/*         $('.privilege_tr').hide();*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         console.log(selRow);*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择对象');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#editForm').form('clear');*/
/*         $('#role_edit').combobox({*/
/*             url:"{{ url('express/index') }}",*/
/*             method:'get',*/
/*             valueField: 'id',*/
/*             textField: 'text'*/
/*         });*/
/*         $('#edit_privilege').combotree({*/
/*             url: "{{ url('auth/menu-list') }}",*/
/*             method: 'get',*/
/*             cascadeCheck: false,*/
/*             onCheck: function (node, checked) {*/
/*                 myCascadeCheck($('#edit_privilege'), node, checked);*/
/*             }*/
/*         });*/
/*         $('#dlg-edit').form('load',{*/
/*             'name' : selRow.name,*/
/*             'keyword' : selRow.keyword*/
/* */
/*         });*/
/*        // $('#edit_privilege').combotree('setValues', selRow.privilege.split(","));*/
/* */
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择账号');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '您确定删除该账号？', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('employee/del') }}", {'id':selRow.id}, function(data) {*/
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
/*             var url = '/express/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*         } else if (flag == 'add') {*/
/*             var url = '/express/add';*/
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
/*                     window.location.href = '/express';*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* */
/*     function status(flag) {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择员工');*/
/*             return false;*/
/*         }*/
/*         if (selRow.status == flag) {*/
/*             $.messager.alert('错误','该账号已' + (flag == 0 ? "启用" : "冻结"));*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '您确定'+(flag == 0 ? "启用" : "冻结")+'该账号', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('employee/change-status') }}", {id: selRow.id, status: flag}, function(data) {*/
/*                     if (data.error == 0) {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         reloadgrid();*/
/*                     } else {*/
/*                         $.messager.alert('失败', data.message, 'error');*/
/*                     }*/
/*                 })*/
/*             }*/
/*         });*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
