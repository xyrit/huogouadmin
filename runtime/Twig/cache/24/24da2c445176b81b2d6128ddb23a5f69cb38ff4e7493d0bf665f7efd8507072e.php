<?php

/* index.html */
class __TwigTemplate_2484952747e31281fa0352c55759fc2494f27146325d6a837eff2dfcdb7b020a extends yii\twig\Template
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
<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"小组列表\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/order-manage-group/index"), "html", null, true);
        echo "',mode:'local',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'name', width:100, align:'center'\">小组名称</th>
        <th data-options=\"field:'user_nums', width:50, align:'center'\">人数</th>
        <th data-options=\"field:'product_nums', width:100, align:'center'\">处理商品</th>
        <th data-options=\"field:'username', width:100, align:'center'\">创建人</th>
        <th data-options=\"field:'updated_at', width:180\" formatter=\"formatTime\">创建时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 19
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 20
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 22
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 23
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        ";
        }
        // line 25
        echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"detail()\">详情</a>
        ";
        // line 26
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 27
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 29
        echo "    </div>
</div>

<!--新增小组-->
<div id=\"dlg-add\" title=\"新增小组\" class=\"easyui-dialog\" style=\"width:500px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 34
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td colspan=\"3\">小组名称  <input class=\"easyui-textbox\" type=\"text\" name=\"OrderManageGroupForm[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr><td>添加人员</td></tr>
        <tr>
            <td>
                <div class=\"easyui-datalist\" title=\"可添加成员\" id=\"can_add_user\" style=\"width:150px;height:250px\"></div>
            </td>
            <td>
                <a class=\"easyui-linkbutton\" id=\"add\">》》</a>
                <br>
                <a class=\"easyui-linkbutton\" id=\"del\">《《</a>
            </td>
            <td>
                <div class=\"easyui-datalist\" title=\"小组成员\" id=\"add_user\" data-options=\"valueField: 'id',textField: 'name', singleSelect: false\" style=\"width:150px;height:250px\"></div>
            </td>
        </tr>
        <input type=\"hidden\" name=\"OrderManageGroupForm[userIds]\" id=\"add_userIds\">
    </table>
    ";
        // line 55
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增小组-->

<!--编辑小组-->
<div id=\"dlg-edit\" title=\"编辑小组\" class=\"easyui-dialog\" style=\"width:500px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 66
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td colspan=\"3\">小组名称  <input class=\"easyui-textbox\" type=\"text\" name=\"OrderManageGroupForm[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr><td>添加人员</td></tr>
        <tr>
            <td>
                <div class=\"easyui-datalist\" title=\"可添加成员\" id=\"can_edit_user\" style=\"width:150px;height:250px\"></div>
            </td>
            <td>
                <a class=\"easyui-linkbutton\" id=\"edit_add\">》》</a>
                <br>
                <a class=\"easyui-linkbutton\" id=\"edit_del\">《《</a>
            </td>
            <td>
                <div class=\"easyui-datalist\" title=\"小组成员\" id=\"edit_user\" data-options=\"valueField: 'id',textField: 'name', singleSelect: false\" style=\"width:150px;height:250px\"></div>
            </td>
        </tr>
        <input type=\"hidden\" name=\"OrderManageGroupForm[userIds]\" id=\"edit_userIds\">
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
<!--编辑小组-->

<!--小组详情-->
<div id=\"dlg-detail\" title=\"小组详情\" class=\"easyui-dialog\" style=\"width:500px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\">
    <table cellpadding=\"5\">
        <tr>
            <td>小组名称</td>
            <td id=\"name\"></td>
        </tr>
        <tr>
            <td>小组成员</td>
            <td id=\"member\"></td>
        </tr>
        <tr>
            <td>商品处理数</td>
            <td id=\"number\"></td>
        </tr>
    </table>
</div>
<!--小组详情-->

";
    }

    // line 117
    public function block_js($context, array $blocks = array())
    {
        // line 118
        echo "<script>
    function reloadgrid(){
        console.log('reload');
        \$(\"#listdata\").datagrid('reload');
    }

    //格式化状态
    function formatStatus(val, row) {
        if (val == 1) {
            return '开启';
        } else {
            return '禁用';
        }
    }

    function formatShow(val, row) {
        if (val == 1) {
            return '是';
        } else {
            return '否';
        }
    }

    function formatPass(val, row) {
        if (val == 1) {
            return '是';
        } else {
            return '否';
        }
    }

    function formatTime(val, row){
        return new Date(parseInt(val) * 1000).toLocaleString().substr(0,21);
    }

    function add() {
        \$('#addForm').form('clear');
        //\$('#add_user').datalist('getPanel').panel('clear')
        //\$('#can_add_user').datalist('getPanel').panel('clear')
        \$('#can_add_user').datalist({
            url: \"";
        // line 158
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/employee/list"), "html", null, true);
        echo "\",
            method: 'get',
            singleSelect: false,
            valueField: 'id',
            textField: 'name'
        });
        \$('#dlg-add').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择小组');
            return false;
        }

        \$('#editForm').form('clear');
        //\$('#edit_user').datalist('getPanel').panel('clear')
        //\$('#can_edit_user').datalist('getPanel').panel('clear')
        \$('#can_edit_user').datalist({
            url: \"";
        // line 178
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/employee/list"), "html", null, true);
        echo "\" + \"?group_id=\" + selRow.id,
            method: 'get',
            singleSelect: false,
            valueField: 'id',
            textField: 'name'
        });
        \$('#edit_user').datalist({
            url: \"";
        // line 185
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/order-manage-group/user-list"), "html", null, true);
        echo "\" + \"?id=\" + selRow.id,
            method: 'get',
            singleSelect: false,
            valueField: 'id',
            textField: 'name'
        });
        \$('#dlg-edit').form('load',{
            'OrderManageGroupForm[name]' : selRow.name,
        });
        \$('#dlg-edit').window('open');
    }

    function save(flag) {
        if (flag == 'edit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/order-manage-group/edit?id=' + selRow.id;
            var form = 'editForm';
            var rows = \$('#edit_user').datagrid('getRows');
            var userids = new Array();
            \$.each(rows, function(i, v) {
                userids.push(v.id);
            });
            \$('#edit_userIds').val(userids.join(','));
        } else if (flag == 'add') {
            var url = '/order-manage-group/add';
            var form = 'addForm';
            var rows = \$('#add_user').datagrid('getRows');
            var userids = new Array();
            \$.each(rows, function(i, v) {
                userids.push(v.id);
            });
            \$('#add_userIds').val(userids.join(','));
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
                    window.location.href = '/order-manage-group/index';
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
    }

    function detail() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择小组');
            return false;
        }

        var member = new Array();
        \$.get(\"";
        // line 245
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/order-manage-group/user-list"), "html", null, true);
        echo "\" + \"?id=\" + selRow.id, function(data) {
            \$.each(data, function(i, v) {
                member.push(v.name);
            });
            \$('#member').html(member.join(','));
            \$('#name').html(selRow.name);
            \$('#number').html(selRow.product_nums);
            \$('#dlg-detail').window('open');
        })
    }

    function del() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择小组');
            return false;
        }

        \$.messager.confirm('Confirm', '您确定删除该小组？删除后该小组下的账号需重新分配小组', function(r) {
            if (r) {
                \$.post(\"";
        // line 265
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("order-manage-group/del"), "html", null, true);
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

    \$('#add').on('click', function() {
        var rows = \$('#can_add_user').datagrid('getSelections');
        \$.each(rows, function(i, v) {
            \$('#add_user').datagrid('appendRow', v);
            var index = \$('#can_add_user').datagrid('getRowIndex', v);
            \$('#can_add_user').datagrid('deleteRow', index);
        });
    });

    \$('#del').on('click', function() {
        var rows = \$('#add_user').datagrid('getSelections');
        \$.each(rows, function(i, v) {
            \$('#can_add_user').datagrid('appendRow', v);
            var index = \$('#add_user').datagrid('getRowIndex', v);
            \$('#add_user').datagrid('deleteRow', index);
        });
    });

    \$('#edit_add').on('click', function() {
        var rows = \$('#can_edit_user').datagrid('getSelections');
        \$.each(rows, function(i, v) {
            \$('#edit_user').datagrid('appendRow', v);
            var index = \$('#can_edit_user').datagrid('getRowIndex', v);
            \$('#can_edit_user').datagrid('deleteRow', index);
        });
    });

    \$('#edit_del').on('click', function() {
        var rows = \$('#edit_user').datagrid('getSelections');
        \$.each(rows, function(i, v) {
            \$('#can_edit_user').datagrid('appendRow', v);
            var index = \$('#edit_user').datagrid('getRowIndex', v);
            \$('#edit_user').datagrid('deleteRow', index);
        });
    });
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
        return array (  340 => 265,  317 => 245,  254 => 185,  244 => 178,  221 => 158,  179 => 118,  176 => 117,  143 => 87,  119 => 66,  105 => 55,  81 => 34,  74 => 29,  70 => 27,  68 => 26,  65 => 25,  61 => 23,  58 => 22,  54 => 20,  52 => 19,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="小组列表" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{  url('/order-manage-group/index')}}',mode:'local',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'name', width:100, align:'center'">小组名称</th>*/
/*         <th data-options="field:'user_nums', width:50, align:'center'">人数</th>*/
/*         <th data-options="field:'product_nums', width:100, align:'center'">处理商品</th>*/
/*         <th data-options="field:'username', width:100, align:'center'">创建人</th>*/
/*         <th data-options="field:'updated_at', width:180" formatter="formatTime">创建时间</th>*/
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
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="detail()">详情</a>*/
/*         {% if del == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增小组-->*/
/* <div id="dlg-add" title="新增小组" class="easyui-dialog" style="width:500px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td colspan="3">小组名称  <input class="easyui-textbox" type="text" name="OrderManageGroupForm[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr><td>添加人员</td></tr>*/
/*         <tr>*/
/*             <td>*/
/*                 <div class="easyui-datalist" title="可添加成员" id="can_add_user" style="width:150px;height:250px"></div>*/
/*             </td>*/
/*             <td>*/
/*                 <a class="easyui-linkbutton" id="add">》》</a>*/
/*                 <br>*/
/*                 <a class="easyui-linkbutton" id="del">《《</a>*/
/*             </td>*/
/*             <td>*/
/*                 <div class="easyui-datalist" title="小组成员" id="add_user" data-options="valueField: 'id',textField: 'name', singleSelect: false" style="width:150px;height:250px"></div>*/
/*             </td>*/
/*         </tr>*/
/*         <input type="hidden" name="OrderManageGroupForm[userIds]" id="add_userIds">*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增小组-->*/
/* */
/* <!--编辑小组-->*/
/* <div id="dlg-edit" title="编辑小组" class="easyui-dialog" style="width:500px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td colspan="3">小组名称  <input class="easyui-textbox" type="text" name="OrderManageGroupForm[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr><td>添加人员</td></tr>*/
/*         <tr>*/
/*             <td>*/
/*                 <div class="easyui-datalist" title="可添加成员" id="can_edit_user" style="width:150px;height:250px"></div>*/
/*             </td>*/
/*             <td>*/
/*                 <a class="easyui-linkbutton" id="edit_add">》》</a>*/
/*                 <br>*/
/*                 <a class="easyui-linkbutton" id="edit_del">《《</a>*/
/*             </td>*/
/*             <td>*/
/*                 <div class="easyui-datalist" title="小组成员" id="edit_user" data-options="valueField: 'id',textField: 'name', singleSelect: false" style="width:150px;height:250px"></div>*/
/*             </td>*/
/*         </tr>*/
/*         <input type="hidden" name="OrderManageGroupForm[userIds]" id="edit_userIds">*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-edit" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('edit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')">取消</a>*/
/* </div>*/
/* <!--编辑小组-->*/
/* */
/* <!--小组详情-->*/
/* <div id="dlg-detail" title="小组详情" class="easyui-dialog" style="width:500px;height:auto;padding:10px 20px" modal="true" closed="true">*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>小组名称</td>*/
/*             <td id="name"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>小组成员</td>*/
/*             <td id="member"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品处理数</td>*/
/*             <td id="number"></td>*/
/*         </tr>*/
/*     </table>*/
/* </div>*/
/* <!--小组详情-->*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         console.log('reload');*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     //格式化状态*/
/*     function formatStatus(val, row) {*/
/*         if (val == 1) {*/
/*             return '开启';*/
/*         } else {*/
/*             return '禁用';*/
/*         }*/
/*     }*/
/* */
/*     function formatShow(val, row) {*/
/*         if (val == 1) {*/
/*             return '是';*/
/*         } else {*/
/*             return '否';*/
/*         }*/
/*     }*/
/* */
/*     function formatPass(val, row) {*/
/*         if (val == 1) {*/
/*             return '是';*/
/*         } else {*/
/*             return '否';*/
/*         }*/
/*     }*/
/* */
/*     function formatTime(val, row){*/
/*         return new Date(parseInt(val) * 1000).toLocaleString().substr(0,21);*/
/*     }*/
/* */
/*     function add() {*/
/*         $('#addForm').form('clear');*/
/*         //$('#add_user').datalist('getPanel').panel('clear')*/
/*         //$('#can_add_user').datalist('getPanel').panel('clear')*/
/*         $('#can_add_user').datalist({*/
/*             url: "{{ url('/employee/list') }}",*/
/*             method: 'get',*/
/*             singleSelect: false,*/
/*             valueField: 'id',*/
/*             textField: 'name'*/
/*         });*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择小组');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#editForm').form('clear');*/
/*         //$('#edit_user').datalist('getPanel').panel('clear')*/
/*         //$('#can_edit_user').datalist('getPanel').panel('clear')*/
/*         $('#can_edit_user').datalist({*/
/*             url: "{{ url('/employee/list') }}" + "?group_id=" + selRow.id,*/
/*             method: 'get',*/
/*             singleSelect: false,*/
/*             valueField: 'id',*/
/*             textField: 'name'*/
/*         });*/
/*         $('#edit_user').datalist({*/
/*             url: "{{ url('/order-manage-group/user-list') }}" + "?id=" + selRow.id,*/
/*             method: 'get',*/
/*             singleSelect: false,*/
/*             valueField: 'id',*/
/*             textField: 'name'*/
/*         });*/
/*         $('#dlg-edit').form('load',{*/
/*             'OrderManageGroupForm[name]' : selRow.name,*/
/*         });*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function save(flag) {*/
/*         if (flag == 'edit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/order-manage-group/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*             var rows = $('#edit_user').datagrid('getRows');*/
/*             var userids = new Array();*/
/*             $.each(rows, function(i, v) {*/
/*                 userids.push(v.id);*/
/*             });*/
/*             $('#edit_userIds').val(userids.join(','));*/
/*         } else if (flag == 'add') {*/
/*             var url = '/order-manage-group/add';*/
/*             var form = 'addForm';*/
/*             var rows = $('#add_user').datagrid('getRows');*/
/*             var userids = new Array();*/
/*             $.each(rows, function(i, v) {*/
/*                 userids.push(v.id);*/
/*             });*/
/*             $('#add_userIds').val(userids.join(','));*/
/*         }*/
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
/*                     window.location.href = '/order-manage-group/index';*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* */
/*     function detail() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择小组');*/
/*             return false;*/
/*         }*/
/* */
/*         var member = new Array();*/
/*         $.get("{{ url('/order-manage-group/user-list') }}" + "?id=" + selRow.id, function(data) {*/
/*             $.each(data, function(i, v) {*/
/*                 member.push(v.name);*/
/*             });*/
/*             $('#member').html(member.join(','));*/
/*             $('#name').html(selRow.name);*/
/*             $('#number').html(selRow.product_nums);*/
/*             $('#dlg-detail').window('open');*/
/*         })*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择小组');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '您确定删除该小组？删除后该小组下的账号需重新分配小组', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('order-manage-group/del') }}", {'id':selRow.id}, function(data) {*/
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
/*     $('#add').on('click', function() {*/
/*         var rows = $('#can_add_user').datagrid('getSelections');*/
/*         $.each(rows, function(i, v) {*/
/*             $('#add_user').datagrid('appendRow', v);*/
/*             var index = $('#can_add_user').datagrid('getRowIndex', v);*/
/*             $('#can_add_user').datagrid('deleteRow', index);*/
/*         });*/
/*     });*/
/* */
/*     $('#del').on('click', function() {*/
/*         var rows = $('#add_user').datagrid('getSelections');*/
/*         $.each(rows, function(i, v) {*/
/*             $('#can_add_user').datagrid('appendRow', v);*/
/*             var index = $('#add_user').datagrid('getRowIndex', v);*/
/*             $('#add_user').datagrid('deleteRow', index);*/
/*         });*/
/*     });*/
/* */
/*     $('#edit_add').on('click', function() {*/
/*         var rows = $('#can_edit_user').datagrid('getSelections');*/
/*         $.each(rows, function(i, v) {*/
/*             $('#edit_user').datagrid('appendRow', v);*/
/*             var index = $('#can_edit_user').datagrid('getRowIndex', v);*/
/*             $('#can_edit_user').datagrid('deleteRow', index);*/
/*         });*/
/*     });*/
/* */
/*     $('#edit_del').on('click', function() {*/
/*         var rows = $('#edit_user').datagrid('getSelections');*/
/*         $.each(rows, function(i, v) {*/
/*             $('#can_edit_user').datagrid('appendRow', v);*/
/*             var index = $('#edit_user').datagrid('getRowIndex', v);*/
/*             $('#edit_user').datagrid('deleteRow', index);*/
/*         });*/
/*     });*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
