<?php

/* sdk-list.html */
class __TwigTemplate_2355e5fc7d7c9c276324c422535d8b5168d207095811773a843cc2a61dfd6d8c extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "sdk-list.html", 1);
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
        echo "<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"支付列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/sdk-list"), "html", null, true);
        echo "',pageSize:50\">
    <thead>
    <tr style=\"height:200px;\">
        <th data-options=\"field:'from', width:150, align:'center'\" formatter=\"formatFrom\">来源</th>
        <th data-options=\"field:'name', width:180, align:'center'\">支付名称</th>
        <th data-options=\"field:'type', width:180, align:'center'\">支付类型</th>
        <th data-options=\"field:'system', width:180, align:'center'\">系统</th>
        <th data-options=\"field:'status',width:300, align:'center'\" formatter=\"formatStatus\">是否启用</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"javascript:\$('#dlg-add').dialog('open');\">新增</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-ok',plain:true\" onclick=\"toTop()\">上移</a>
    </div>
</div>

<div id=\"dlg-add\" title=\"新增\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px;\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    <form id=\"sdk\" method=\"post\">
        <table cellpadding=\"5\">
            <tr>
                <td>站点</td>
                <td>
                    <select name=\"from\">
                        <option value=\"1\" >伙购网</option>
                        <option value=\"2\" >滴滴夺宝</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>支付名称:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[sdk_name]\" data-options=\"required:true\"></td>
            </tr>
            <tr>
                <td>支付类型:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[sdk_type]\"  data-options=\"required:true\"></td>
            </tr>
            <tr>
                <td>备注:</td>
                <td><textarea rows=5 name=\"content[sdk_des]\" class=\"textarea easyui-validatebox\"></textarea></td>
            </tr>
            <tr>
                <td>限额:</td>
                <td><input class=\"easyui-textbox\" name=\"content[sdk_limit]\"></td>
            </tr>
            <tr>
                <td>超限提示:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[sdk_limit_title]\"></td>
            </tr>
            <tr>
                <td>系统:</td>
                <td><input type=\"radio\" name=\"system\" value=\"android\" checked>Android<input type=\"radio\" name=\"system\" value=\"ios\">Ios</td>
            </tr>
            <tr>
                <td>是否启用:</td>
                <td><input type=\"checkbox\" name=\"status\" value=\"1\" checked></td>
            </tr>
        </table>
    </form>
    <div style=\"text-align:center;padding:5px\">
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm()\">提交</a>
    </div>
</div>

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"修改\" style=\"width:480px;height:450px;padding:10px;overflow:hidden;\" data-options=\"width:440,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ \$(this).window('hcenter');}\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
</div>
";
    }

    // line 78
    public function block_js($context, array $blocks = array())
    {
        // line 79
        echo "<script>
    function toTop()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择');
            return false;
        }
        \$.get(\"";
        // line 87
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/top"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
            if(data.error == 0){
                \$.messager.alert('成功', data.message);
                window.location.reload();
            }else{
                \$.messager.alert('错误', data.message, 'error');
            }
        })
    }

    function edit()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 104
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/edit"), "html", null, true);
        echo "\" + '?type=sdk&id=' + selRow.id);
        \$('#dlg-edit').window('open');
    }

    function del()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择');
            return false;
        }
        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            \$.get(\"";
        // line 116
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/del"), "html", null, true);
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

    function add()
    {
        \$('#dlg-add').dialog('open');
    }

    function submitForm()
    {
        \$('#sdk').form({
            url: '/app/add-sdk',
            onSubmit: function(param){
                var isValid = \$(this).form('validate');
                if (!isValid){
                    \$.messager.progress('close');\t// 如果表单是无效的则隐藏进度条
                }
                return isValid;\t// 返回false终止表单提交
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){window.location.href=\"/app/sdk-list\";}, 2000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            }
        });
        \$('#sdk').submit();
    }

    function formatStatus(val, row)
    {
        if(val == 1) return '启用';
        else return '不启用';
    }

    function formatFrom(val, row) {
        if (val==1) {
            return '伙购网';
        } else if (val==2) {
            return '滴滴夺宝';
        }
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "sdk-list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  158 => 116,  143 => 104,  123 => 87,  113 => 79,  110 => 78,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table id="listdata"  class="easyui-datagrid" title="支付列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{ url('app/sdk-list') }}',pageSize:50">*/
/*     <thead>*/
/*     <tr style="height:200px;">*/
/*         <th data-options="field:'from', width:150, align:'center'" formatter="formatFrom">来源</th>*/
/*         <th data-options="field:'name', width:180, align:'center'">支付名称</th>*/
/*         <th data-options="field:'type', width:180, align:'center'">支付类型</th>*/
/*         <th data-options="field:'system', width:180, align:'center'">系统</th>*/
/*         <th data-options="field:'status',width:300, align:'center'" formatter="formatStatus">是否启用</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="javascript:$('#dlg-add').dialog('open');">新增</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="del()">删除</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="toTop()">上移</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-add" title="新增" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px;" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     <form id="sdk" method="post">*/
/*         <table cellpadding="5">*/
/*             <tr>*/
/*                 <td>站点</td>*/
/*                 <td>*/
/*                     <select name="from">*/
/*                         <option value="1" >伙购网</option>*/
/*                         <option value="2" >滴滴夺宝</option>*/
/*                     </select>*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>支付名称:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[sdk_name]" data-options="required:true"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>支付类型:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[sdk_type]"  data-options="required:true"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>备注:</td>*/
/*                 <td><textarea rows=5 name="content[sdk_des]" class="textarea easyui-validatebox"></textarea></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>限额:</td>*/
/*                 <td><input class="easyui-textbox" name="content[sdk_limit]"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>超限提示:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[sdk_limit_title]"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>系统:</td>*/
/*                 <td><input type="radio" name="system" value="android" checked>Android<input type="radio" name="system" value="ios">Ios</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>是否启用:</td>*/
/*                 <td><input type="checkbox" name="status" value="1" checked></td>*/
/*             </tr>*/
/*         </table>*/
/*     </form>*/
/*     <div style="text-align:center;padding:5px">*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">提交</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-edit" class="easyui-window" title="修改" style="width:480px;height:450px;padding:10px;overflow:hidden;" data-options="width:440,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ $(this).window('hcenter');}">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*     </iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function toTop()*/
/*     {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择');*/
/*             return false;*/
/*         }*/
/*         $.get("{{ url('app/top') }}", {'id':selRow.id}, function(data) {*/
/*             if(data.error == 0){*/
/*                 $.messager.alert('成功', data.message);*/
/*                 window.location.reload();*/
/*             }else{*/
/*                 $.messager.alert('错误', data.message, 'error');*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     function edit()*/
/*     {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('app/edit') }}" + '?type=sdk&id=' + selRow.id);*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function del()*/
/*     {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择');*/
/*             return false;*/
/*         }*/
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             $.get("{{ url('app/del') }}", {'id':selRow.id}, function(data) {*/
/*                 if (data.error) {*/
/*                     $.messager.alert('错误', data.message, 'error');*/
/*                 } else {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     window.location.reload();*/
/*                 }*/
/*             }, 'json');*/
/*         });*/
/*     }*/
/* */
/*     function add()*/
/*     {*/
/*         $('#dlg-add').dialog('open');*/
/*     }*/
/* */
/*     function submitForm()*/
/*     {*/
/*         $('#sdk').form({*/
/*             url: '/app/add-sdk',*/
/*             onSubmit: function(param){*/
/*                 var isValid = $(this).form('validate');*/
/*                 if (!isValid){*/
/*                     $.messager.progress('close');	// 如果表单是无效的则隐藏进度条*/
/*                 }*/
/*                 return isValid;	// 返回false终止表单提交*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){window.location.href="/app/sdk-list";}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#sdk').submit();*/
/*     }*/
/* */
/*     function formatStatus(val, row)*/
/*     {*/
/*         if(val == 1) return '启用';*/
/*         else return '不启用';*/
/*     }*/
/* */
/*     function formatFrom(val, row) {*/
/*         if (val==1) {*/
/*             return '伙购网';*/
/*         } else if (val==2) {*/
/*             return '滴滴夺宝';*/
/*         }*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
