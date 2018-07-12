<?php

/* index.html */
class __TwigTemplate_09c4a32750f93db181c094a7694615df919143f1795d7693f9ad045fb6dd2b02 extends yii\twig\Template
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
    <span>赛事名称 <input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <span>赛事日期<input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"赛事列表\"
       data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("olympic"), "html", null, true);
        echo "',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">编号</th>
        <th data-options=\"field:'date',width:150, align:'center'\">奥运赛期</th>
        <th data-options=\"field:'name', width:100\">比赛项目</th>
        <th data-options=\"field:'created_at', width:180\" formatter=\"formatTime\">创建时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 25
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 26
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 28
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 29
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        ";
        }
        // line 31
        echo "        ";
        if (((isset($context["status"]) ? $context["status"] : null) == 1)) {
            // line 32
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-ok',plain:true\" onclick=\"status(0)\">启用</a>
        ";
        }
        // line 34
        echo "        ";
        if (((isset($context["status"]) ? $context["status"] : null) == 1)) {
            // line 35
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-no',plain:true\" onclick=\"status(1)\">冻结</a>
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

<!--新增员工-->
<div id=\"dlg-add\" title=\"新增赛事\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 45
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>赛事项目</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"name\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>赛事日期</td>
            <td colspan=\"2\"><input class=\"easyui-datetimebox\" type=\"text\" id=\"starttime\" name=\"date\" formatter=\"formatDate\" value=\"";
        // line 53
        echo twig_escape_filter($this->env, (isset($context["date"]) ? $context["date"] : null), "html", null, true);
        echo "\"></td>
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
<!--新增员工-->

<!--编辑员工-->
<div id=\"dlg-edit\" title=\"编辑赛事\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 67
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>赛事项目</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"name\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>赛事日期</td>
            <td colspan=\"2\"><input class=\"easyui-datetimebox\" type=\"text\" id=\"date\" name=\"date\" formatter=\"formatterDate\" value=\"";
        // line 75
        echo twig_escape_filter($this->env, (isset($context["date"]) ? $context["date"] : null), "html", null, true);
        echo "\"></td>
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
<!--编辑员工-->

";
    }

    // line 89
    public function block_js($context, array $blocks = array())
    {
        // line 90
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
        // line 114
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("role/get-role-privilege"), "html", null, true);
        echo "\", {id: record.id}, function(data) {
            \$('#add_privilege').combotree('setValues', data.privilege.split(\",\"));
            \$('#add_privilege_tr').show();
        }, 'json');
    }

    function editOnSelect(record) {
        \$.get(\"";
        // line 121
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
        // line 130
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("olympic/add"), "html", null, true);
        echo "\",
            method:'get',
            valueField: 'id',
            textField: 'text'
        });
        \$('#add_privilege').combotree({
            url: \"";
        // line 136
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("olympic/index"), "html", null, true);
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
        // line 157
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("olympic/index"), "html", null, true);
        echo "\",
            method:'get',
            valueField: 'id',
            textField: 'text'
        });
        \$('#edit_privilege').combotree({
            url: \"";
        // line 163
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
            'date' : selRow.date

        });

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
        // line 188
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("olympic/del"), "html", null, true);
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
            var url = '/olympic/edit?id=' + selRow.id;
            var form = 'editForm';
        } else if (flag == 'add') {
            var url = '/olympic/add';
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
                    window.location.href = '/olympic';
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
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
        return array (  282 => 188,  254 => 163,  245 => 157,  221 => 136,  212 => 130,  200 => 121,  190 => 114,  164 => 90,  161 => 89,  147 => 78,  141 => 75,  130 => 67,  116 => 56,  110 => 53,  99 => 45,  92 => 40,  88 => 38,  85 => 37,  81 => 35,  78 => 34,  74 => 32,  71 => 31,  67 => 29,  64 => 28,  60 => 26,  58 => 25,  42 => 12,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>赛事名称 <input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <span>赛事日期<input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="赛事列表"*/
/*        data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{  url('olympic')}}',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">编号</th>*/
/*         <th data-options="field:'date',width:150, align:'center'">奥运赛期</th>*/
/*         <th data-options="field:'name', width:100">比赛项目</th>*/
/*         <th data-options="field:'created_at', width:180" formatter="formatTime">创建时间</th>*/
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
/* <div id="dlg-add" title="新增赛事" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>赛事项目</td>*/
/*             <td><input class="easyui-textbox" type="text" name="name" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>赛事日期</td>*/
/*             <td colspan="2"><input class="easyui-datetimebox" type="text" id="starttime" name="date" formatter="formatDate" value="{{date}}"></td>*/
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
/* <div id="dlg-edit" title="编辑赛事" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>赛事项目</td>*/
/*             <td><input class="easyui-textbox" type="text" name="name" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>赛事日期</td>*/
/*             <td colspan="2"><input class="easyui-datetimebox" type="text" id="date" name="date" formatter="formatterDate" value="{{date}}"></td>*/
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
/*             url:"{{ url('olympic/add') }}",*/
/*             method:'get',*/
/*             valueField: 'id',*/
/*             textField: 'text'*/
/*         });*/
/*         $('#add_privilege').combotree({*/
/*             url: "{{ url('olympic/index') }}",*/
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
/*             url:"{{ url('olympic/index') }}",*/
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
/*             'date' : selRow.date*/
/* */
/*         });*/
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
/*                 $.post("{{ url('olympic/del') }}", {'id':selRow.id}, function(data) {*/
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
/*             var url = '/olympic/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*         } else if (flag == 'add') {*/
/*             var url = '/olympic/add';*/
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
/*                     window.location.href = '/olympic';*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
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
