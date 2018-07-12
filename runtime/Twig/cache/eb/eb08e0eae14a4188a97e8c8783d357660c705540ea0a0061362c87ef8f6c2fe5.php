<?php

/* index.html */
class __TwigTemplate_9827f39efb95424dbafc733a66fcc7136c9b9ebad403a283fe9a41675e2db240 extends yii\twig\Template
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
    .datagrid-btable tr{height: 200px!important;}
</style>
<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"活动列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("active/index"), "html", null, true);
        echo "'\">
    <thead>
    <tr style=\"height:200px;\">
        <th data-options=\"field:'id', width:150, align:'center'\">序号</th>
        <th data-options=\"field:'from', width:150, align:'center'\" formatter=\"formatFrom\">来源</th>
        <th data-options=\"field:'title', width:180, align:'center'\">标题</th>
        <th data-options=\"field:'sub_title', width:180, align:'center'\">小标题</th>
        <th data-options=\"field:'status', width:180, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'icon',width:300, align:'center'\" formatter=\"formatPicture\">图片</th>
        <th data-options=\"field:'url', width:180, align:'center'\">链接地址</th>
        <th data-options=\"field:'created_at', width:250, align:'center'\">时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 24
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 25
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 27
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 28
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">修改</a>
        ";
        }
        // line 30
        echo "        ";
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 31
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 33
        echo "    </div>
</div>

<div id=\"dlg-add\" title=\"新增配置页\" class=\"easyui-dialog\" style=\"width:450px;height:auto;padding:10px 20px;\" modal=\"true\"
     closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 38
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm", "enctype" => "multipart/form-data")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>站点</td>
            <td>
                <select id=\"active-from\" name=\"Active[from]\">
                    <option value=\"1\" >伙购网</option>
                    <option value=\"2\" >滴滴夺宝</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>最低版本</td>
            <td><input class=\"easyui-textbox\" name=\"Active[min_ver]\" data-options=\"required:true\">
                <span style=\"color: red\">(例:2.0.0,默认不填)</span>
            </td>
        </tr>
        <tr>
            <td>添加标题</td>
            <td><input class=\"easyui-textbox\" name=\"Active[title]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>添加小标题</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Active[sub_title]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>状态</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Active[status]\" data-options=\"panelHeight:'auto'\">
                    <option value=\"1\">启用</option>
                    <option value=\"0\">禁用</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>类型</td>
            <td><input type=\"radio\" name=\"Active[type]\" value=\"1\" checked>H5 <input type=\"radio\" name=\"Active[type]\" value=\"2\">原生 </td>
        </tr>
        <tr>
            <td>添加标签</td>
            <td><input type=\"radio\" name=\"Active[flag]\" value=\"0\">不选<input type=\"radio\" name=\"Active[flag]\" value=\"1\">new <input type=\"radio\" name=\"Active[flag]\" value=\"2\">hot <input type=\"radio\" name=\"Active[flag]\" value=\"3\">全选</td>
        </tr>
        <tr>
            <td>添加图片</td>
            <td>
                <input class=\"easyui-filebox\" name=\"picture\" data-options=\"prompt:'上传图片'\" style=\"width:100%\" data-options=\"required:true\">
            </td>
        </tr>
        <tr>
            <td>关联url</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Active[url]\" data-options=\"required:true,validType:'url'\"></td>
        </tr>
        <tr>
            <td>排序</td>
            <td><input class=\"easyui-textbox\" name=\"Active[list_order]\" value=\"0\"></td>
        </tr>
        <tr>
            <td>描述</td>
            <td>
                <textarea name=\"Active[desc]\" rows=\"8\" cols=\"25\"></textarea>
            </td>
        </tr>
    </table>
    ";
        // line 101
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"修改banner\" style=\"width:480px;height:450px;padding:10px;overflow:hidden;\" data-options=\"width:440,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ \$(this).window('hcenter');}\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
</div>
";
    }

    // line 115
    public function block_js($context, array $blocks = array())
    {
        // line 116
        echo "<script>
    function add(){
        \$('#dlg-add').dialog('open');
    }

    function formatFrom(val, row) {
        if (val==1) {
            return '伙购网';
        } else if (val==2) {
            return '滴滴夺宝';
        }
    }

    function formatStatus(val, row){
        if(val == 0) return '禁用';
        else if(val == 1) return '开启';
    }

    function formatPicture(val, row) {
        return '<img src=\"'+val+'\">';
    }

    function edit(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 144
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("active/edit"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-edit').window('open');
    }

    function del(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个');
            return false;
        }
        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            \$.get(\"";
        // line 155
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("active/del"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                if (data.error) {
                    \$.messager.alert('错误', data.message, 'error');
                } else {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){location.reload();}, 2000);
                }
            }, 'json');
        });
    }

    function save(){
        \$('#addForm').form({
            url: '";
        // line 168
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("active/add"), "html", null, true);
        echo "',
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
                    setTimeout(function(){location.reload();}, 2000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            }
        });
        \$('#addForm').submit();
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
        return array (  230 => 168,  214 => 155,  200 => 144,  170 => 116,  167 => 115,  150 => 101,  84 => 38,  77 => 33,  73 => 31,  70 => 30,  66 => 28,  63 => 27,  59 => 25,  57 => 24,  37 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style>*/
/*     .datagrid-btable tr{height: 200px!important;}*/
/* </style>*/
/* <table id="listdata"  class="easyui-datagrid" title="活动列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{ url('active/index') }}'">*/
/*     <thead>*/
/*     <tr style="height:200px;">*/
/*         <th data-options="field:'id', width:150, align:'center'">序号</th>*/
/*         <th data-options="field:'from', width:150, align:'center'" formatter="formatFrom">来源</th>*/
/*         <th data-options="field:'title', width:180, align:'center'">标题</th>*/
/*         <th data-options="field:'sub_title', width:180, align:'center'">小标题</th>*/
/*         <th data-options="field:'status', width:180, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'icon',width:300, align:'center'" formatter="formatPicture">图片</th>*/
/*         <th data-options="field:'url', width:180, align:'center'">链接地址</th>*/
/*         <th data-options="field:'created_at', width:250, align:'center'">时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if(add == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*         {% endif %}*/
/*         {% if(edit == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">修改</a>*/
/*         {% endif %}*/
/*         {% if(del == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-add" title="新增配置页" class="easyui-dialog" style="width:450px;height:auto;padding:10px 20px;" modal="true"*/
/*      closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm','enctype':"multipart/form-data"}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>站点</td>*/
/*             <td>*/
/*                 <select id="active-from" name="Active[from]">*/
/*                     <option value="1" >伙购网</option>*/
/*                     <option value="2" >滴滴夺宝</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>最低版本</td>*/
/*             <td><input class="easyui-textbox" name="Active[min_ver]" data-options="required:true">*/
/*                 <span style="color: red">(例:2.0.0,默认不填)</span>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>添加标题</td>*/
/*             <td><input class="easyui-textbox" name="Active[title]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>添加小标题</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Active[sub_title]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>状态</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Active[status]" data-options="panelHeight:'auto'">*/
/*                     <option value="1">启用</option>*/
/*                     <option value="0">禁用</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>类型</td>*/
/*             <td><input type="radio" name="Active[type]" value="1" checked>H5 <input type="radio" name="Active[type]" value="2">原生 </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>添加标签</td>*/
/*             <td><input type="radio" name="Active[flag]" value="0">不选<input type="radio" name="Active[flag]" value="1">new <input type="radio" name="Active[flag]" value="2">hot <input type="radio" name="Active[flag]" value="3">全选</td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>添加图片</td>*/
/*             <td>*/
/*                 <input class="easyui-filebox" name="picture" data-options="prompt:'上传图片'" style="width:100%" data-options="required:true">*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>关联url</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Active[url]" data-options="required:true,validType:'url'"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>排序</td>*/
/*             <td><input class="easyui-textbox" name="Active[list_order]" value="0"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>描述</td>*/
/*             <td>*/
/*                 <textarea name="Active[desc]" rows="8" cols="25"></textarea>*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* <div id="dlg-edit" class="easyui-window" title="修改banner" style="width:480px;height:450px;padding:10px;overflow:hidden;" data-options="width:440,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ $(this).window('hcenter');}">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*     </iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function add(){*/
/*         $('#dlg-add').dialog('open');*/
/*     }*/
/* */
/*     function formatFrom(val, row) {*/
/*         if (val==1) {*/
/*             return '伙购网';*/
/*         } else if (val==2) {*/
/*             return '滴滴夺宝';*/
/*         }*/
/*     }*/
/* */
/*     function formatStatus(val, row){*/
/*         if(val == 0) return '禁用';*/
/*         else if(val == 1) return '开启';*/
/*     }*/
/* */
/*     function formatPicture(val, row) {*/
/*         return '<img src="'+val+'">';*/
/*     }*/
/* */
/*     function edit(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('active/edit') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function del(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个');*/
/*             return false;*/
/*         }*/
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             $.get("{{ url('active/del') }}", {'id':selRow.id}, function(data) {*/
/*                 if (data.error) {*/
/*                     $.messager.alert('错误', data.message, 'error');*/
/*                 } else {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){location.reload();}, 2000);*/
/*                 }*/
/*             }, 'json');*/
/*         });*/
/*     }*/
/* */
/*     function save(){*/
/*         $('#addForm').form({*/
/*             url: '{{ url("active/add") }}',*/
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
/*                     setTimeout(function(){location.reload();}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#addForm').submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
