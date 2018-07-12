<?php

/* index.html */
class __TwigTemplate_4395df33d264df2c463d8ba87faf158f03edc5b529fa48d996974d9f6b7a01ea extends yii\twig\Template
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
    <span>菜单名
        <select name=\"id\" class=\"easyui-combotree\" id=\"id\" style=\"width:200px;\" data-options=\"url: '";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/menu-list"), "html", null, true);
        echo "', method: 'get'\"></select>
    </span>
    <span>路由
        <input class=\"easyui-textbox\" type=\"text\" name=\"url\" id=\"url\">
    </span>
    <span>状态
        <select class=\"easyui-combobox\" id=\"status\" name=\"status\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"1\">开启</option>
            <option value=\"2\">禁用</option>
        </select>
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"菜单列表\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/auth/index"), "html", null, true);
        echo "',mode:'local',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">序号</th>
        <th data-options=\"field:'name', width:200, align:'center'\">菜单名</th>
        <th data-options=\"field:'route', width:200, align:'center'\">路由</th>
        <th data-options=\"field:'pass', width:100, align:'center'\" formatter=\"formatPass\">验证</th>
        <th data-options=\"field:'show', width:100, align:'center'\" formatter=\"formatShow\">显示</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'updated_at', width:180\" formatter=\"formatTime\">更新时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 38
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 39
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 41
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 42
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        ";
        }
        // line 44
        echo "        ";
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 45
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 47
        echo "    </div>
</div>

<!--新增菜单-->
<div id=\"dlg-add\" title=\"新增菜单\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 52
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>父级菜单</td>
            <td><input class=\"easyui-combotree\" name=\"Menu[parent_id]\" id=\"add_parent_id\" style=\"width:200px;\"></td>
        </tr>
        <tr>
            <td>菜单名</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Menu[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>路由</td>
            <td><input class=\"easyui-combobox\" name=\"Menu[route]\" id=\"add_route\" data-options=\"required:true\" editable=\"true\" style=\"width:200px;\"></td>
        </tr>
        <tr>
            <td>验证</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Menu[pass]\" id=\"add_pass\" data-options=\"panelHeight:'auto'\">
                    <option value=\"0\">否</option>
                    <option value=\"1\">是</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>显示</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Menu[show]\" id=\"add_show\" data-options=\"panelHeight:'auto'\">
                    <option value=\"0\">否</option>
                    <option value=\"1\">是</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>状态</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Menu[status]\" id=\"add_status\" data-options=\"panelHeight:'auto'\">
                    <option value=\"1\">启用</option>
                    <option value=\"0\">禁用</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>排序</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Menu[order]\" data-options=\"required:true\"></td>
        </tr>
    </table>
    ";
        // line 98
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增菜单-->

<!--编辑菜单-->
<div id=\"dlg-edit\" title=\"编辑菜单\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 109
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>父级菜单</td>
            <td><input class=\"easyui-combotree\" name=\"Menu[parent_id]\" id=\"edit_parent_id\" style=\"width:200px;\"></td>
        </tr>
        <tr>
            <td>菜单名</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Menu[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>路由</td>
            <td><input class=\"easyui-combobox\" name=\"Menu[route]\" id=\"edit_route\" data-options=\"required:true\" editable=\"true\" style=\"width:200px;\"></td>
        </tr>
        <tr>
            <td>验证</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Menu[pass]\" id=\"edit_pass\" data-options=\"panelHeight:'auto'\">
                    <option value=\"0\">否</option>
                    <option value=\"1\">是</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>显示</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Menu[show]\" id=\"edit_show\" data-options=\"panelHeight:'auto'\">
                    <option value=\"0\">否</option>
                    <option value=\"1\">是</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>状态</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Menu[status]\" id=\"edit_status\" data-options=\"panelHeight:'auto'\">
                    <option value=\"1\">启用</option>
                    <option value=\"0\">禁用</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>排序</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Menu[order]\" data-options=\"required:true\"></td>
        </tr>
    </table>
    ";
        // line 155
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-edit\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('edit')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-edit').dialog('close')\">取消</a>
</div>
<!--编辑菜单-->

";
    }

    // line 166
    public function block_js($context, array $blocks = array())
    {
        // line 167
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.id = \$('input[name=id]').val();
        queryParams.url = \$('#url').val();
        queryParams.status\t= \$('#status').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
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

    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
    }

    function add() {
        \$('#addForm').form('clear');
        \$('#add_parent_id').combotree({
                url: \"";
        // line 212
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/menu-list"), "html", null, true);
        echo "\",
                method:'get'
        });
        \$('#add_route').combobox({
                url:\"";
        // line 216
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/route-list"), "html", null, true);
        echo "\",
                method:'get',
                valueField: 'id',
                textField: 'text'
        });
        \$('#add_show').combobox('setValue', 0);
        \$('#add_status').combobox('setValue', 1);
        \$('#add_pass').combobox('setValue', 1);
        \$('#add_parent_id').combotree('setValue', 0);
        \$('#dlg-add').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择菜单');
            return false;
        }

        \$('#editForm').form('clear');
        \$('#edit_parent_id').combotree({
            url: \"";
        // line 237
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/menu-list"), "html", null, true);
        echo "\",
            method:'get'
        });
        \$('#edit_route').combobox({
            url:\"";
        // line 241
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/route-list"), "html", null, true);
        echo "\",
            method:'get',
            valueField: 'id',
            textField: 'text'
        });
        \$('#dlg-edit').form('load',{
            'Menu[parent_id]' : selRow.parent_id,
            'Menu[name]' : selRow.name,
            'Menu[route]' : selRow.route,
            'Menu[pass]' : selRow.pass,
            'Menu[show]' : selRow.show,
            'Menu[status]' : selRow.status,
            'Menu[order]' : selRow.order
        });
        \$('#dlg-edit').window('open');
    }

    function save(flag) {
        if (flag == 'edit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/auth/edit?id=' + selRow.id;
            var form = 'editForm';
        } else if (flag == 'add') {
            var url = '/auth/add';
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
                    //window.location.href = '/auth/index';
                    \$('#dlg-' + flag).window('close');
                    reloadgrid();
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
    }

    function del() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择菜单');
            return false;
        }

        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            if (r) {
                \$.get(\"";
        // line 297
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/del"), "html", null, true);
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
        return array (  374 => 297,  315 => 241,  308 => 237,  284 => 216,  277 => 212,  230 => 167,  227 => 166,  213 => 155,  164 => 109,  150 => 98,  101 => 52,  94 => 47,  90 => 45,  87 => 44,  83 => 42,  80 => 41,  76 => 39,  74 => 38,  55 => 22,  37 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>菜单名*/
/*         <select name="id" class="easyui-combotree" id="id" style="width:200px;" data-options="url: '{{ url('auth/menu-list') }}', method: 'get'"></select>*/
/*     </span>*/
/*     <span>路由*/
/*         <input class="easyui-textbox" type="text" name="url" id="url">*/
/*     </span>*/
/*     <span>状态*/
/*         <select class="easyui-combobox" id="status" name="status" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="1">开启</option>*/
/*             <option value="2">禁用</option>*/
/*         </select>*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="菜单列表" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{  url('/auth/index')}}',mode:'local',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">序号</th>*/
/*         <th data-options="field:'name', width:200, align:'center'">菜单名</th>*/
/*         <th data-options="field:'route', width:200, align:'center'">路由</th>*/
/*         <th data-options="field:'pass', width:100, align:'center'" formatter="formatPass">验证</th>*/
/*         <th data-options="field:'show', width:100, align:'center'" formatter="formatShow">显示</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
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
/*         {% if del == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增菜单-->*/
/* <div id="dlg-add" title="新增菜单" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>父级菜单</td>*/
/*             <td><input class="easyui-combotree" name="Menu[parent_id]" id="add_parent_id" style="width:200px;"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>菜单名</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Menu[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>路由</td>*/
/*             <td><input class="easyui-combobox" name="Menu[route]" id="add_route" data-options="required:true" editable="true" style="width:200px;"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>验证</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Menu[pass]" id="add_pass" data-options="panelHeight:'auto'">*/
/*                     <option value="0">否</option>*/
/*                     <option value="1">是</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>显示</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Menu[show]" id="add_show" data-options="panelHeight:'auto'">*/
/*                     <option value="0">否</option>*/
/*                     <option value="1">是</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>状态</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Menu[status]" id="add_status" data-options="panelHeight:'auto'">*/
/*                     <option value="1">启用</option>*/
/*                     <option value="0">禁用</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>排序</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Menu[order]" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增菜单-->*/
/* */
/* <!--编辑菜单-->*/
/* <div id="dlg-edit" title="编辑菜单" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>父级菜单</td>*/
/*             <td><input class="easyui-combotree" name="Menu[parent_id]" id="edit_parent_id" style="width:200px;"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>菜单名</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Menu[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>路由</td>*/
/*             <td><input class="easyui-combobox" name="Menu[route]" id="edit_route" data-options="required:true" editable="true" style="width:200px;"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>验证</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Menu[pass]" id="edit_pass" data-options="panelHeight:'auto'">*/
/*                     <option value="0">否</option>*/
/*                     <option value="1">是</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>显示</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Menu[show]" id="edit_show" data-options="panelHeight:'auto'">*/
/*                     <option value="0">否</option>*/
/*                     <option value="1">是</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>状态</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Menu[status]" id="edit_status" data-options="panelHeight:'auto'">*/
/*                     <option value="1">启用</option>*/
/*                     <option value="0">禁用</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>排序</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Menu[order]" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-edit" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('edit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')">取消</a>*/
/* </div>*/
/* <!--编辑菜单-->*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.id = $('input[name=id]').val();*/
/*         queryParams.url = $('#url').val();*/
/*         queryParams.status	= $('#status').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
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
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* */
/*     function add() {*/
/*         $('#addForm').form('clear');*/
/*         $('#add_parent_id').combotree({*/
/*                 url: "{{ url('auth/menu-list') }}",*/
/*                 method:'get'*/
/*         });*/
/*         $('#add_route').combobox({*/
/*                 url:"{{ url('auth/route-list') }}",*/
/*                 method:'get',*/
/*                 valueField: 'id',*/
/*                 textField: 'text'*/
/*         });*/
/*         $('#add_show').combobox('setValue', 0);*/
/*         $('#add_status').combobox('setValue', 1);*/
/*         $('#add_pass').combobox('setValue', 1);*/
/*         $('#add_parent_id').combotree('setValue', 0);*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择菜单');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#editForm').form('clear');*/
/*         $('#edit_parent_id').combotree({*/
/*             url: "{{ url('auth/menu-list') }}",*/
/*             method:'get'*/
/*         });*/
/*         $('#edit_route').combobox({*/
/*             url:"{{ url('auth/route-list') }}",*/
/*             method:'get',*/
/*             valueField: 'id',*/
/*             textField: 'text'*/
/*         });*/
/*         $('#dlg-edit').form('load',{*/
/*             'Menu[parent_id]' : selRow.parent_id,*/
/*             'Menu[name]' : selRow.name,*/
/*             'Menu[route]' : selRow.route,*/
/*             'Menu[pass]' : selRow.pass,*/
/*             'Menu[show]' : selRow.show,*/
/*             'Menu[status]' : selRow.status,*/
/*             'Menu[order]' : selRow.order*/
/*         });*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function save(flag) {*/
/*         if (flag == 'edit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/auth/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*         } else if (flag == 'add') {*/
/*             var url = '/auth/add';*/
/*             var form = 'addForm';*/
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
/*                     //window.location.href = '/auth/index';*/
/*                     $('#dlg-' + flag).window('close');*/
/*                     reloadgrid();*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择菜单');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             if (r) {*/
/*                 $.get("{{ url('auth/del') }}", {'id':selRow.id}, function(data) {*/
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
/* */
/* </script>*/
/* {% endblock %}*/
/* */
/* */
