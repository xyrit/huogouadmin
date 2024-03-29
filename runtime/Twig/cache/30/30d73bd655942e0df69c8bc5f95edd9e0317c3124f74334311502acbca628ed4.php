<?php

/* image-list.html */
class __TwigTemplate_b71c39a0f328a803f21a6100a93b300b6d1b1fe4e18c4312f340aa141c3ab3d2 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "image-list.html", 1);
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
    .datagrid-btable tr{height: 120px!important;}
</style>
<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"支付列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/image-list"), "html", null, true);
        echo "'\">
    <thead>
    <tr style=\"height:200px;\">
        <th data-options=\"field:'from', width:150, align:'center'\" formatter=\"formatFrom\">来源</th>
        <th data-options=\"field:'img', width:180, align:'center'\" formatter=\"formatImg\">图片</th>
        <th data-options=\"field:'link', width:180, align:'center'\">链接</th>
        <th data-options=\"field:'title', width:180, align:'center'\">标题</th>
        <th data-options=\"field:'start', width:180, align:'center'\">开始时间</th>
        <th data-options=\"field:'end', width:180, align:'center'\">结束时间</th>
        <th data-options=\"field:'system', width:180, align:'center'\">类型</th>
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
    ";
        // line 32
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "/app/add-image", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "submitForm", "enctype" => "multipart/form-data")), "method");
        echo "
        <table cellpadding=\"5\">
            <tr>
                <td>站点</td>
                <td>
                    <select id=\"image-from\" name=\"from\">
                        <option value=\"1\" >伙购网</option>
                        <option value=\"2\" >滴滴夺宝</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>图片:</td>
                <td><input class=\"easyui-filebox\" name=\"picture\" data-options=\"prompt:'选择图片'\"></td>
            </tr>
            <tr>
                <td>图片链接:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[image_link]\" ></td>
            </tr>
            <tr>
                <td>文件描述:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[image_title]\"  data-options=\"required:true\"></td>
            </tr>
            <tr>
                <td>开始时间:</td>
                <td><input class=\"easyui-datetimebox\" type=\"text\" name=\"content[start_time]\" ></td>
            </tr>
            <tr>
                <td>结束时间:</td>
                <td><input class=\"easyui-datetimebox\" type=\"text\" name=\"content[end_time]\" ></td>
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
    ";
        // line 72
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
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

    // line 84
    public function block_js($context, array $blocks = array())
    {
        // line 85
        echo "<script>
    function toTop()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择');
            return false;
        }
        \$.get(\"";
        // line 93
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
        // line 110
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/edit"), "html", null, true);
        echo "\" + '?type=image&id=' + selRow.id);
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
        // line 122
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
        \$('#submitForm').form({
            url: '/app/add-image',
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
                    setTimeout(function(){window.location.reload();}, 2000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            }
        });
        \$('#submitForm').submit();
    }
    function formatFrom(val, row) {
        if (val==1) {
            return '伙购网';
        } else if (val==2) {
            return '滴滴夺宝';
        }
    }

    function formatStatus(val, row)
    {
        if(val == 1) return '启用';
        else return '不启用';
    }
    function formatImg(val, row)
    {
        return \"<img src='\"+val+\"' style='width:100px;'>\";
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "image-list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  171 => 122,  156 => 110,  136 => 93,  126 => 85,  123 => 84,  108 => 72,  65 => 32,  37 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style>*/
/*     .datagrid-btable tr{height: 120px!important;}*/
/* </style>*/
/* <table id="listdata"  class="easyui-datagrid" title="支付列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{ url('app/image-list') }}'">*/
/*     <thead>*/
/*     <tr style="height:200px;">*/
/*         <th data-options="field:'from', width:150, align:'center'" formatter="formatFrom">来源</th>*/
/*         <th data-options="field:'img', width:180, align:'center'" formatter="formatImg">图片</th>*/
/*         <th data-options="field:'link', width:180, align:'center'">链接</th>*/
/*         <th data-options="field:'title', width:180, align:'center'">标题</th>*/
/*         <th data-options="field:'start', width:180, align:'center'">开始时间</th>*/
/*         <th data-options="field:'end', width:180, align:'center'">结束时间</th>*/
/*         <th data-options="field:'system', width:180, align:'center'">类型</th>*/
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
/*     {{ html.beginForm('/app/add-image', 'post', {'class':'am-form am-form-horizontal', 'id':'submitForm', 'enctype':"multipart/form-data"}) | raw }}*/
/*         <table cellpadding="5">*/
/*             <tr>*/
/*                 <td>站点</td>*/
/*                 <td>*/
/*                     <select id="image-from" name="from">*/
/*                         <option value="1" >伙购网</option>*/
/*                         <option value="2" >滴滴夺宝</option>*/
/*                     </select>*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>图片:</td>*/
/*                 <td><input class="easyui-filebox" name="picture" data-options="prompt:'选择图片'"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>图片链接:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[image_link]" ></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>文件描述:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[image_title]"  data-options="required:true"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>开始时间:</td>*/
/*                 <td><input class="easyui-datetimebox" type="text" name="content[start_time]" ></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>结束时间:</td>*/
/*                 <td><input class="easyui-datetimebox" type="text" name="content[end_time]" ></td>*/
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
/*     {{ html.endForm() | raw }}*/
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
/*         $('#edit_iframe').prop('src', "{{ url('app/edit') }}" + '?type=image&id=' + selRow.id);*/
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
/*         $('#submitForm').form({*/
/*             url: '/app/add-image',*/
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
/*                     setTimeout(function(){window.location.reload();}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#submitForm').submit();*/
/*     }*/
/*     function formatFrom(val, row) {*/
/*         if (val==1) {*/
/*             return '伙购网';*/
/*         } else if (val==2) {*/
/*             return '滴滴夺宝';*/
/*         }*/
/*     }*/
/* */
/*     function formatStatus(val, row)*/
/*     {*/
/*         if(val == 1) return '启用';*/
/*         else return '不启用';*/
/*     }*/
/*     function formatImg(val, row)*/
/*     {*/
/*         return "<img src='"+val+"' style='width:100px;'>";*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
