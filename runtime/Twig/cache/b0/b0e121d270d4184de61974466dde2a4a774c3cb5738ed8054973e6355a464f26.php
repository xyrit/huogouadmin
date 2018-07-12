<?php

/* index.html */
class __TwigTemplate_4432e1b53424275b0692c5f85c1f390bcc4ea02e701c177f34b5b98a47b297d6 extends yii\twig\Template
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
<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"虚拟卡列表\" data-options=\"toolbar:'#tb-user',rownumbers:false,singleSelect:true,pagination:true,method:'get',url:'";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/virtual-card/index"), "html", null, true);
        echo "',mode:'local',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">ID</th>
        <!--<th data-options=\"field:'type', align:'center'\" formatter=\"formatType\">类型</th>-->
        <th data-options=\"field:'card', width:200, align:'center'\">卡号</th>
        <th data-options=\"field:'pwd', width:200, align:'center'\">密码</th>
        <th data-options=\"field:'par_value', width:100, align:'center'\">面值</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'created_at', width:200, align:'center'\" formatter=\"formatTime\">导入时间</th>
        <th data-options=\"field:'admin_name', width:100, align:'center'\">管理员</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 22
        if (((isset($context["import"]) ? $context["import"] : null) == 1)) {
            // line 23
            echo "        <form id=\"uploadForm\" enctype=\"multipart/form-data\" method=\"post\" style=\"display:none\">
        <input type=\"file\" name=\"import\" id=\"uploadfile\" style=\"display:none\" onchange=\"upload()\" />
        </form>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"imp()\">导入</a>
        ";
        }
        // line 28
        echo "    </div>
</div>

<!--新增关键字-->
<div id=\"dlg-add\" title=\"新增关键字\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 33
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>关键字</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"content\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>适用类型</td>
            <td>
                <input type=\"checkbox\" name=\"add_type[]\" value=\"2\">昵称
                <input type=\"checkbox\" name=\"add_type[]\" value=\"1\">话题及回复
            </td>
        </tr>
    </table>
    ";
        // line 47
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增关键字-->

<!--编辑菜单-->
<div id=\"dlg-edit\" title=\"编辑菜单\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 58
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>关键字</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"content\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>适用类型</td>
            <td>
                <input type=\"checkbox\" name=\"edit_type[]\" value=\"2\">昵称
                <input type=\"checkbox\" name=\"edit_type[]\" value=\"1\">话题及回复
            </td>
        </tr>
    </table>
    ";
        // line 72
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

    // line 83
    public function block_js($context, array $blocks = array())
    {
        // line 84
        echo "<script>
    function reloadgrid(){
        \$(\"#listdata\").datagrid('reload');
    }

    //格式化
    function formatType(val, row) {
        if (val == 'jd') {
            return '京东';
        }
    }

    function formatStatus(val, row) {
        return val == 0 ? '未发出' : '已发出';
    }

    function add() {
        \$('#addForm').form('clear');
        \$(\"[name='add_type[]']\").prop(\"checked\",'true');
        \$('#dlg-add').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择关键字');
            return false;
        }

        \$('#editForm').form('clear');
        type = selRow.type;
        type = type.split(',');
        \$(\"[name='edit_type[]']\").each(function(){
            if (\$.inArray(\$(this).val(), type) >= 0) {
                \$(this).prop(\"checked\",'true');
            }
        });

        \$('#dlg-edit').form('load',{
            'content': selRow.content
        });
        \$('#dlg-edit').window('open');
    }

    function save(flag) {
        if (flag == 'edit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/keywords/edit?id=' + selRow.id;
            var form = 'editForm';
        } else if (flag == 'add') {
            var url = '/keywords/add';
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
                    window.location.href = '/keywords/index';
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
        // line 165
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("keywords/del"), "html", null, true);
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

    function imp() {
        \$('#uploadfile').click();
    }

    function exp() {
        window.location.href = \"";
        // line 182
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("keywords/export"), "html", null, true);
        echo "\";
    }

    function upload() {
        var docObj=document.getElementById(\"uploadfile\");

        if(docObj.files && docObj.files[0])
        {
            \$('#uploadForm').form({
                url: \"";
        // line 191
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("virtual-card/import"), "html", null, true);
        echo "\",
                success: function (data) {
                    data = eval('(' + data + ')');
                    if (data.error == 0) {
                        \$.messager.alert('成功', data.message);
                        window.location.href = '/virtual-card/index';
                    } else {
                        \$.messager.alert('失败', data.message, 'error');
                    }
                }
            });
            \$('#uploadForm').submit();
        }

        return true;
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
        return array (  251 => 191,  239 => 182,  219 => 165,  136 => 84,  133 => 83,  119 => 72,  102 => 58,  88 => 47,  71 => 33,  64 => 28,  57 => 23,  55 => 22,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="虚拟卡列表" data-options="toolbar:'#tb-user',rownumbers:false,singleSelect:true,pagination:true,method:'get',url:'{{  url('/virtual-card/index')}}',mode:'local',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">ID</th>*/
/*         <!--<th data-options="field:'type', align:'center'" formatter="formatType">类型</th>-->*/
/*         <th data-options="field:'card', width:200, align:'center'">卡号</th>*/
/*         <th data-options="field:'pwd', width:200, align:'center'">密码</th>*/
/*         <th data-options="field:'par_value', width:100, align:'center'">面值</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'created_at', width:200, align:'center'" formatter="formatTime">导入时间</th>*/
/*         <th data-options="field:'admin_name', width:100, align:'center'">管理员</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if import == 1 %}*/
/*         <form id="uploadForm" enctype="multipart/form-data" method="post" style="display:none">*/
/*         <input type="file" name="import" id="uploadfile" style="display:none" onchange="upload()" />*/
/*         </form>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="imp()">导入</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增关键字-->*/
/* <div id="dlg-add" title="新增关键字" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>关键字</td>*/
/*             <td><input class="easyui-textbox" type="text" name="content" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>适用类型</td>*/
/*             <td>*/
/*                 <input type="checkbox" name="add_type[]" value="2">昵称*/
/*                 <input type="checkbox" name="add_type[]" value="1">话题及回复*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增关键字-->*/
/* */
/* <!--编辑菜单-->*/
/* <div id="dlg-edit" title="编辑菜单" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>关键字</td>*/
/*             <td><input class="easyui-textbox" type="text" name="content" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>适用类型</td>*/
/*             <td>*/
/*                 <input type="checkbox" name="edit_type[]" value="2">昵称*/
/*                 <input type="checkbox" name="edit_type[]" value="1">话题及回复*/
/*             </td>*/
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
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     //格式化*/
/*     function formatType(val, row) {*/
/*         if (val == 'jd') {*/
/*             return '京东';*/
/*         }*/
/*     }*/
/* */
/*     function formatStatus(val, row) {*/
/*         return val == 0 ? '未发出' : '已发出';*/
/*     }*/
/* */
/*     function add() {*/
/*         $('#addForm').form('clear');*/
/*         $("[name='add_type[]']").prop("checked",'true');*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择关键字');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#editForm').form('clear');*/
/*         type = selRow.type;*/
/*         type = type.split(',');*/
/*         $("[name='edit_type[]']").each(function(){*/
/*             if ($.inArray($(this).val(), type) >= 0) {*/
/*                 $(this).prop("checked",'true');*/
/*             }*/
/*         });*/
/* */
/*         $('#dlg-edit').form('load',{*/
/*             'content': selRow.content*/
/*         });*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function save(flag) {*/
/*         if (flag == 'edit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/keywords/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*         } else if (flag == 'add') {*/
/*             var url = '/keywords/add';*/
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
/*                     window.location.href = '/keywords/index';*/
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
/*                 $.get("{{ url('keywords/del') }}", {'id':selRow.id}, function(data) {*/
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
/*     function imp() {*/
/*         $('#uploadfile').click();*/
/*     }*/
/* */
/*     function exp() {*/
/*         window.location.href = "{{ url('keywords/export') }}";*/
/*     }*/
/* */
/*     function upload() {*/
/*         var docObj=document.getElementById("uploadfile");*/
/* */
/*         if(docObj.files && docObj.files[0])*/
/*         {*/
/*             $('#uploadForm').form({*/
/*                 url: "{{ url('virtual-card/import') }}",*/
/*                 success: function (data) {*/
/*                     data = eval('(' + data + ')');*/
/*                     if (data.error == 0) {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         window.location.href = '/virtual-card/index';*/
/*                     } else {*/
/*                         $.messager.alert('失败', data.message, 'error');*/
/*                     }*/
/*                 }*/
/*             });*/
/*             $('#uploadForm').submit();*/
/*         }*/
/* */
/*         return true;*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* */
/* </script>*/
/* {% endblock %}*/
/* */
/* */
