<?php

/* index-btn.html */
class __TwigTemplate_67f14805404de9a3c22a38df756ccb5fc1f0a235f69e7d18e5162cc0822412fc extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "index-btn.html", 1);
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
        echo "<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"首页按钮设置\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/index-btn"), "html", null, true);
        echo "',pageSize:50\">
    <thead>
    <tr style=\"height:200px;\">
        <th data-options=\"field:'from', width:150, align:'center'\" formatter=\"formatFrom\">来源</th>
        <th data-options=\"field:'system', width:180, align:'center'\">系统</th>
        <th data-options=\"field:'type', width:180, align:'center'\">按钮类型</th>
        <th data-options=\"field:'url', width:180, align:'center'\">按钮链接</th>
        <th data-options=\"field:'text', width:180, align:'center'\">按钮文字</th>
        <th data-options=\"field:'index', width:180, align:'center'\" formatter=\"formatIndex\">按钮位置</th>
        <th data-options=\"field:'img', width:180, align:'center'\" formatter=\"formatImg\">按钮图片</th>
        <th data-options=\"field:'img_hover', width:180, align:'center'\" formatter=\"formatImg\">按钮hover图片</th>
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
    <form id=\"index-btn\" method=\"post\" enctype=\"multipart/form-data\">
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
                <td>按钮类型</td>
                <td>
                    <select name=\"content[type]\">
                        ";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["targetTypes"]) ? $context["targetTypes"] : null));
        foreach ($context['_seq'] as $context["val"] => $context["text"]) {
            // line 46
            echo "                        <option value=\"";
            echo twig_escape_filter($this->env, $context["val"], "html", null, true);
            echo "\" >";
            echo twig_escape_filter($this->env, $context["text"], "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['val'], $context['text'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "                    </select>
                </td>
            </tr>
            <tr>
                <td>按钮链接:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[url]\"  value=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "url", array()), "html", null, true);
        echo "\" data-options=\"required:true\"></td>
            </tr>
            <tr>
                <td>按钮文字:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[text]\"  value=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "text", array()), "html", null, true);
        echo "\"  data-options=\"required:true\"></td>
            </tr>
            <tr>
                <td>按钮位置:</td>
                <td>
                    <select name=\"content[index]\">
                        <option value=\"1\" >位置一</option>
                        <option value=\"2\" >位置二</option>
                        <option value=\"3\" >位置三</option>
                        <option value=\"4\" >位置四</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>图片</td>
                <td><input class=\"easyui-filebox\" type=\"text\" name=\"picture\" data-options=\"required:true\"></td>
            </tr>
            <tr>
                <td>hover图片</td>
                <td><input class=\"easyui-filebox\" type=\"text\" name=\"picture2\" data-options=\"required:true\"></td>
            </tr>
            <tr>
                <td>系统:</td>
                <td><input type=\"radio\" name=\"system\" value=\"android\" checked>Android<input type=\"radio\" name=\"system\" value=\"ios\">IOS</td>
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

    // line 99
    public function block_js($context, array $blocks = array())
    {
        // line 100
        echo "<script>
    function toTop()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择');
            return false;
        }
        \$.get(\"";
        // line 108
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
        // line 125
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/edit"), "html", null, true);
        echo "\" + '?type=index-btn&id=' + selRow.id);
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
        // line 137
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
        \$('#index-btn').form({
            url: '/app/add-index-btn',
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
                    setTimeout(function(){window.location.reload()}, 1000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            }
        });
        \$('#index-btn').submit();
    }
    function formatImg (val, row)
    {
        return '<img src=\"'+val+'\" width=\"30\" height=\"30\">';
    }

    function formatIndex(val, row)
    {
        var indexDetail = {
            '1':'位置一',
            '2':'位置二',
            '3':'位置三',
            '4':'位置四',
            '5':'位置五',
        };
        return indexDetail[val];
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
        return "index-btn.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  199 => 137,  184 => 125,  164 => 108,  154 => 100,  151 => 99,  106 => 57,  99 => 53,  92 => 48,  81 => 46,  77 => 45,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table id="listdata"  class="easyui-datagrid" title="首页按钮设置" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{ url('app/index-btn') }}',pageSize:50">*/
/*     <thead>*/
/*     <tr style="height:200px;">*/
/*         <th data-options="field:'from', width:150, align:'center'" formatter="formatFrom">来源</th>*/
/*         <th data-options="field:'system', width:180, align:'center'">系统</th>*/
/*         <th data-options="field:'type', width:180, align:'center'">按钮类型</th>*/
/*         <th data-options="field:'url', width:180, align:'center'">按钮链接</th>*/
/*         <th data-options="field:'text', width:180, align:'center'">按钮文字</th>*/
/*         <th data-options="field:'index', width:180, align:'center'" formatter="formatIndex">按钮位置</th>*/
/*         <th data-options="field:'img', width:180, align:'center'" formatter="formatImg">按钮图片</th>*/
/*         <th data-options="field:'img_hover', width:180, align:'center'" formatter="formatImg">按钮hover图片</th>*/
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
/*     <form id="index-btn" method="post" enctype="multipart/form-data">*/
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
/*                 <td>按钮类型</td>*/
/*                 <td>*/
/*                     <select name="content[type]">*/
/*                         {% for val,text in targetTypes %}*/
/*                         <option value="{{val}}" >{{text}}</option>*/
/*                         {% endfor %}*/
/*                     </select>*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>按钮链接:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[url]"  value="{{ model.content.url }}" data-options="required:true"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>按钮文字:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[text]"  value="{{ model.content.text }}"  data-options="required:true"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>按钮位置:</td>*/
/*                 <td>*/
/*                     <select name="content[index]">*/
/*                         <option value="1" >位置一</option>*/
/*                         <option value="2" >位置二</option>*/
/*                         <option value="3" >位置三</option>*/
/*                         <option value="4" >位置四</option>*/
/*                     </select>*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>图片</td>*/
/*                 <td><input class="easyui-filebox" type="text" name="picture" data-options="required:true"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>hover图片</td>*/
/*                 <td><input class="easyui-filebox" type="text" name="picture2" data-options="required:true"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>系统:</td>*/
/*                 <td><input type="radio" name="system" value="android" checked>Android<input type="radio" name="system" value="ios">IOS</td>*/
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
/*         $('#edit_iframe').prop('src', "{{ url('app/edit') }}" + '?type=index-btn&id=' + selRow.id);*/
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
/*         $('#index-btn').form({*/
/*             url: '/app/add-index-btn',*/
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
/*                     setTimeout(function(){window.location.reload()}, 1000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#index-btn').submit();*/
/*     }*/
/*     function formatImg (val, row)*/
/*     {*/
/*         return '<img src="'+val+'" width="30" height="30">';*/
/*     }*/
/* */
/*     function formatIndex(val, row)*/
/*     {*/
/*         var indexDetail = {*/
/*             '1':'位置一',*/
/*             '2':'位置二',*/
/*             '3':'位置三',*/
/*             '4':'位置四',*/
/*             '5':'位置五',*/
/*         };*/
/*         return indexDetail[val];*/
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
