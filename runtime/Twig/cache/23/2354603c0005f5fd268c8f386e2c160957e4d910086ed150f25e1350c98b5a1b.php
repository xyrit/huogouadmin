<?php

/* index.html */
class __TwigTemplate_1982b1923e0e193a13ce1ace8bf91515a9b89048a0df6a1e5400d63eb6e155e1 extends yii\twig\Template
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
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("honour/index"), "html", null, true);
        echo "'\">
    <thead>
    <tr style=\"height:200px;\">
        <th data-options=\"field:'id', width:150, align:'center'\">序号</th>
        <th data-options=\"field:'from', width:150, align:'center'\" formatter=\"formatFrom\">来源</th>
        <th data-options=\"field:'title', width:180, align:'center'\">标题</th>
        <th data-options=\"field:'icon',width:300, align:'center'\" formatter=\"formatPicture\">图片</th>
        <th data-options=\"field:'desc', width:500, align:'center'\">说明</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 21
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 22
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 24
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 25
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">修改</a>
        ";
        }
        // line 27
        echo "        ";
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 28
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 30
        echo "    </div>
</div>

<div id=\"dlg-add\" title=\"新增\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px;\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 34
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm", "enctype" => "multipart/form-data")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>站点</td>
            <td>
                <select name=\"HonourDesc[from]\">
                    <option value=\"1\" >伙购网</option>
                    <option value=\"2\" >滴滴夺宝</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>添加标题</td>
            <td><input class=\"easyui-textbox\" name=\"HonourDesc[title]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>添加图片</td>
            <td>
                <input class=\"easyui-filebox\" name=\"picture\" data-options=\"prompt:'上传图片'\" style=\"width:100%\" data-options=\"required:true\">
            </td>
        </tr>
        <tr>
            <td>描述</td>
            <td>
                <textarea name=\"HonourDesc[desc]\" rows=\"8\" cols=\"25\"></textarea>
            </td>
        </tr>
    </table>
    ";
        // line 62
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

    // line 76
    public function block_js($context, array $blocks = array())
    {
        // line 77
        echo "<script>
    function add(){
        \$('#dlg-add').dialog('open');
    }

    function formatPicture(val, row) {
        return '<img src=\"'+val+'\">';
    }
    function formatFrom(val, row) {
        if (val==1) {
            return '伙购网';
        } else if (val==2) {
            return '滴滴夺宝';
        }
    }

    function edit(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 99
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("honour/edit"), "html", null, true);
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
        // line 110
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("honour/del"), "html", null, true);
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
        // line 123
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("honour/add"), "html", null, true);
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
        return array (  185 => 123,  169 => 110,  155 => 99,  131 => 77,  128 => 76,  111 => 62,  80 => 34,  74 => 30,  70 => 28,  67 => 27,  63 => 25,  60 => 24,  56 => 22,  54 => 21,  37 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style>*/
/*     .datagrid-btable tr{height: 200px!important;}*/
/* </style>*/
/* <table id="listdata"  class="easyui-datagrid" title="活动列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{ url('honour/index') }}'">*/
/*     <thead>*/
/*     <tr style="height:200px;">*/
/*         <th data-options="field:'id', width:150, align:'center'">序号</th>*/
/*         <th data-options="field:'from', width:150, align:'center'" formatter="formatFrom">来源</th>*/
/*         <th data-options="field:'title', width:180, align:'center'">标题</th>*/
/*         <th data-options="field:'icon',width:300, align:'center'" formatter="formatPicture">图片</th>*/
/*         <th data-options="field:'desc', width:500, align:'center'">说明</th>*/
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
/* <div id="dlg-add" title="新增" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px;" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm','enctype':"multipart/form-data"}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>站点</td>*/
/*             <td>*/
/*                 <select name="HonourDesc[from]">*/
/*                     <option value="1" >伙购网</option>*/
/*                     <option value="2" >滴滴夺宝</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>添加标题</td>*/
/*             <td><input class="easyui-textbox" name="HonourDesc[title]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>添加图片</td>*/
/*             <td>*/
/*                 <input class="easyui-filebox" name="picture" data-options="prompt:'上传图片'" style="width:100%" data-options="required:true">*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>描述</td>*/
/*             <td>*/
/*                 <textarea name="HonourDesc[desc]" rows="8" cols="25"></textarea>*/
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
/*     function formatPicture(val, row) {*/
/*         return '<img src="'+val+'">';*/
/*     }*/
/*     function formatFrom(val, row) {*/
/*         if (val==1) {*/
/*             return '伙购网';*/
/*         } else if (val==2) {*/
/*             return '滴滴夺宝';*/
/*         }*/
/*     }*/
/* */
/*     function edit(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('honour/edit') }}" + '?id=' + selRow.id);*/
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
/*             $.get("{{ url('honour/del') }}", {'id':selRow.id}, function(data) {*/
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
/*             url: '{{ url("honour/add") }}',*/
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
