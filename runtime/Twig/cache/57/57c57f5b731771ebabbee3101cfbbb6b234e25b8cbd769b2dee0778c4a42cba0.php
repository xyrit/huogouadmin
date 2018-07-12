<?php

/* index.html */
class __TwigTemplate_97e9af59be17fd439d3dcd8e1fcac6c351831e95404ce7422d5c8abcd311f93b extends yii\twig\Template
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
        echo "<table title=\"配置列表\" id=\"listdata\" class=\"easyui-datagrid\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/rich/index"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', align:'center'\" width=\"150\">序号</th>
        <th data-options=\"field:'name', align:'center'\" width=\"150\">活动名称</th>
        <th data-options=\"field:'time_type', align:'center'\" width=\"300\" formatter=\"formatTime\">时间</th>
        <th data-options=\"field:'comment', align:'center'\" width=\"300\">说明</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"javascript:\$('#dlg-add').dialog('open')\">新增</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"view()\">查看土豪榜</a>
        ";
        // line 19
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 20
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 22
        echo "    </div>
</div>

<!--查看土豪榜-->
<div class=\"easyui-dialog\" data-options=\"closed:true,\" id=\"dlg-view\" title=\"查看土豪榜\" style=\"width: 700px;height: 600px\" modal=\"true\">
    <iframe id=\"rich-info\" frameborder=\"0\" style=\"width: 600px;height: 850px;\" scrolling=\"no\"></iframe>
</div>
<!--查看土豪榜-->

<!--新增qq群-->
<div id=\"dlg-add\" title=\"新增配置\" class=\"easyui-dialog\" style=\"width:550px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 33
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>活动名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"RichSet[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>是否开启</td>
            <td>
                <select name=\"RichSet[status]\" class=\"easyui-combobox\" id=\"default\" style=\"width:50px;\" data-options=\"required:true,panelHeight:'auto',editable:false,value:1\">
                    <option value=\"1\">是</option>
                    <option value=\"0\">否</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>活动起止</td>
            <td><input type=\"radio\" class=\"time\" name=\"time\" value=\"1\" checked><input class=\"easyui-datetimebox\" type=\"text\" data-options=\"required:true\" name=\"RichSet[start_time]\" id=\"starttime\">到<input class=\"easyui-datetimebox\" type=\"text\" data-options=\"required:true\"
name=\"RichSet[end_time]\" id=\"endtime\"><br/>
                <input type=\"radio\" class=\"time\" name=\"time\" value=\"2\"><select style=\"width:50px;\" name=\"RichSet[time_type]\" class=\"easyui-combobox\" style=\"width:200px;\" data-options=\"required:true,panelHeight:'auto',editable:false,value:1,disabled:true\" id=\"type\">
                    <option value=\"1\">每天</option>
                    <option value=\"2\">每周</option>
                    <option value=\"3\">每月</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>活动说明</td>
            <td><textarea name=\"RichSet[comment]\" rows=\"5\" cols=\"50\"></textarea></td>
        </tr>
    </table>
    ";
        // line 64
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增角色-->

";
    }

    // line 75
    public function block_js($context, array $blocks = array())
    {
        // line 76
        echo "<script>
    function view(){
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择活动');
            return false;
        }

        \$('#rich-info').prop('src',  '/rich/view?id=' + selRow.id);
        \$('#dlg-view').window('open');
    }

    function formatTime(val, row) {
        if(val == 0){
            var start = new Date(parseInt(row.start_time) * 1000).toLocaleString();
            var end = new Date(parseInt(row.end_time) * 1000).toLocaleString();
            return start + ' -- ' + end;
        }else if(val == 1){
            return '每天';
        }else if(val == 2){
            return '每周';
        }else if(val == 3){
            return '每月';
        }
    }

    \$('.time').change(function(){
        var val = \$(this).val();
        if(val == 1){
            \$('#endtime').datetimebox({disabled:false, required:true});
            \$('#starttime').datetimebox({disabled:false, required:true});
            \$('#type').combobox({disabled:true});
        }else if(val == 2){
            \$('#type').combobox({disabled:false});
            \$('#endtime').datetimebox({disabled:true});
            \$('#starttime').datetimebox({disabled:true});
        }
    })

    function del(){
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请至少选择一个');
            return false;
        }

        \$.messager.confirm('Confirm', '您确定删除该活动吗？', function(r) {
            if (r) {
                \$.get(\"";
        // line 124
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("rich/del"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                    if (data.error) {
                        \$.messager.alert('错误', data.message, 'error');
                    } else {
                        \$.messager.alert('成功', data.message);
                        setTimeout(function(){window.location.reload()}, 2000);
                    }
                }, 'json');
            }
        });
    }

    function save(){
        var form = 'addForm';
        var url = '/rich/add';
        \$('#' + form).form({
            url: url,
            onSubmit:function(){
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){window.location.reload()}, 2000);
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
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
        return array (  171 => 124,  121 => 76,  118 => 75,  104 => 64,  70 => 33,  57 => 22,  53 => 20,  51 => 19,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table title="配置列表" id="listdata" class="easyui-datagrid" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{ url('/rich/index') }}',rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', align:'center'" width="150">序号</th>*/
/*         <th data-options="field:'name', align:'center'" width="150">活动名称</th>*/
/*         <th data-options="field:'time_type', align:'center'" width="300" formatter="formatTime">时间</th>*/
/*         <th data-options="field:'comment', align:'center'" width="300">说明</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="javascript:$('#dlg-add').dialog('open')">新增</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="view()">查看土豪榜</a>*/
/*         {% if del == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--查看土豪榜-->*/
/* <div class="easyui-dialog" data-options="closed:true," id="dlg-view" title="查看土豪榜" style="width: 700px;height: 600px" modal="true">*/
/*     <iframe id="rich-info" frameborder="0" style="width: 600px;height: 850px;" scrolling="no"></iframe>*/
/* </div>*/
/* <!--查看土豪榜-->*/
/* */
/* <!--新增qq群-->*/
/* <div id="dlg-add" title="新增配置" class="easyui-dialog" style="width:550px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>活动名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="RichSet[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>是否开启</td>*/
/*             <td>*/
/*                 <select name="RichSet[status]" class="easyui-combobox" id="default" style="width:50px;" data-options="required:true,panelHeight:'auto',editable:false,value:1">*/
/*                     <option value="1">是</option>*/
/*                     <option value="0">否</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>活动起止</td>*/
/*             <td><input type="radio" class="time" name="time" value="1" checked><input class="easyui-datetimebox" type="text" data-options="required:true" name="RichSet[start_time]" id="starttime">到<input class="easyui-datetimebox" type="text" data-options="required:true"*/
/* name="RichSet[end_time]" id="endtime"><br/>*/
/*                 <input type="radio" class="time" name="time" value="2"><select style="width:50px;" name="RichSet[time_type]" class="easyui-combobox" style="width:200px;" data-options="required:true,panelHeight:'auto',editable:false,value:1,disabled:true" id="type">*/
/*                     <option value="1">每天</option>*/
/*                     <option value="2">每周</option>*/
/*                     <option value="3">每月</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>活动说明</td>*/
/*             <td><textarea name="RichSet[comment]" rows="5" cols="50"></textarea></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增角色-->*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function view(){*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择活动');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#rich-info').prop('src',  '/rich/view?id=' + selRow.id);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/* */
/*     function formatTime(val, row) {*/
/*         if(val == 0){*/
/*             var start = new Date(parseInt(row.start_time) * 1000).toLocaleString();*/
/*             var end = new Date(parseInt(row.end_time) * 1000).toLocaleString();*/
/*             return start + ' -- ' + end;*/
/*         }else if(val == 1){*/
/*             return '每天';*/
/*         }else if(val == 2){*/
/*             return '每周';*/
/*         }else if(val == 3){*/
/*             return '每月';*/
/*         }*/
/*     }*/
/* */
/*     $('.time').change(function(){*/
/*         var val = $(this).val();*/
/*         if(val == 1){*/
/*             $('#endtime').datetimebox({disabled:false, required:true});*/
/*             $('#starttime').datetimebox({disabled:false, required:true});*/
/*             $('#type').combobox({disabled:true});*/
/*         }else if(val == 2){*/
/*             $('#type').combobox({disabled:false});*/
/*             $('#endtime').datetimebox({disabled:true});*/
/*             $('#starttime').datetimebox({disabled:true});*/
/*         }*/
/*     })*/
/* */
/*     function del(){*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请至少选择一个');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '您确定删除该活动吗？', function(r) {*/
/*             if (r) {*/
/*                 $.get("{{ url('rich/del') }}", {'id':selRow.id}, function(data) {*/
/*                     if (data.error) {*/
/*                         $.messager.alert('错误', data.message, 'error');*/
/*                     } else {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         setTimeout(function(){window.location.reload()}, 2000);*/
/*                     }*/
/*                 }, 'json');*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     function save(){*/
/*         var form = 'addForm';*/
/*         var url = '/rich/add';*/
/*         $('#' + form).form({*/
/*             url: url,*/
/*             onSubmit:function(){*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){window.location.reload()}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
