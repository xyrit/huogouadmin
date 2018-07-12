<?php

/* index.html */
class __TwigTemplate_c878f889547461741d86f77679038c7f060d6eefd9b1a32a33b8c502e7b0da2c extends yii\twig\Template
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
        echo "<table title=\"qq列表\" id=\"listdata\" class=\"easyui-datagrid\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/qq/index"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'num', align:'center'\" width=\"150\">qq群</th>
        <th data-options=\"field:'android_key', align:'center'\" width=\"150\">android key</th>
        <th data-options=\"field:'ios_key', align:'center'\" width=\"150\">ios key</th>
        <th data-options=\"field:'uin', align:'center'\" width=\"150\">ios uin</th>
        <th data-options=\"field:'default', align:'center'\" width=\"150\" formatter=\"formatDefault\">是否默认</th>
        <th data-options=\"field:'created_at', align:'center'\" width=\"220\" formatter=\"formatTime\">创建时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 19
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 20
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"javascript:\$('#dlg-add').dialog('open')\">新增</a>
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
        echo "        ";
        if (((isset($context["default"]) ? $context["default"] : null) == 1)) {
            // line 26
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"setDefault()\">默认设置</a>
        ";
        }
        // line 28
        echo "        ";
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 29
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 31
        echo "    </div>
</div>

<!--新增qq群-->
<div id=\"dlg-add\" title=\"新增qq群\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 36
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>qq群</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Qq[num]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>安卓key值</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Qq[android_key]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>ios key值</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Qq[ios_key]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>ios uin值</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Qq[uin]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>是否默认</td>
            <td>
                <select name=\"Qq[default]\" class=\"easyui-combobox\" id=\"default\" style=\"width:200px;\" data-options=\"required:true,panelHeight:'auto',editable:false,value:1\">
                    <option value=\"1\">是</option>
                    <option value=\"0\">否</option>
                </select>
            </td>
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

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"修改\" style=\"width:398px;height:300px;padding:10px;\" data-options=\"iconCls:'icon-save',closed:true,modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
</div>

";
    }

    // line 83
    public function block_js($context, array $blocks = array())
    {
        // line 84
        echo "<script>
    function edit(){
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择qq');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 91
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("qq/edit"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-edit').window('open');
    }


    function formatDefault(val, row) {
        if(val == 1) return '默认';
    }

    function setDefault(){
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择qq');
            return false;
        }

        if(selRow.default == 1){
            var tips = '您确认取消默认';
        }else{
            var tips = '您确认设置默认';
        }
        \$.messager.confirm('Confirm', tips, function(r) {
            if (r) {
                \$.get(\"";
        // line 114
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("qq/set-default"), "html", null, true);
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

    function del(){
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择qq');
            return false;
        }

        \$.messager.confirm('Confirm', '您确定删除该qq群', function(r) {
            if (r) {
                \$.get(\"";
        // line 135
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("qq/del"), "html", null, true);
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
        var url = '/qq/add';
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
        return array (  200 => 135,  176 => 114,  150 => 91,  141 => 84,  138 => 83,  116 => 64,  85 => 36,  78 => 31,  74 => 29,  71 => 28,  67 => 26,  64 => 25,  60 => 23,  57 => 22,  53 => 20,  51 => 19,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table title="qq列表" id="listdata" class="easyui-datagrid" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{ url('/qq/index') }}',rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'num', align:'center'" width="150">qq群</th>*/
/*         <th data-options="field:'android_key', align:'center'" width="150">android key</th>*/
/*         <th data-options="field:'ios_key', align:'center'" width="150">ios key</th>*/
/*         <th data-options="field:'uin', align:'center'" width="150">ios uin</th>*/
/*         <th data-options="field:'default', align:'center'" width="150" formatter="formatDefault">是否默认</th>*/
/*         <th data-options="field:'created_at', align:'center'" width="220" formatter="formatTime">创建时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if add == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="javascript:$('#dlg-add').dialog('open')">新增</a>*/
/*         {% endif %}*/
/*         {% if edit == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         {% endif %}*/
/*         {% if default == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="setDefault()">默认设置</a>*/
/*         {% endif %}*/
/*         {% if del == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增qq群-->*/
/* <div id="dlg-add" title="新增qq群" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>qq群</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Qq[num]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>安卓key值</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Qq[android_key]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>ios key值</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Qq[ios_key]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>ios uin值</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Qq[uin]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>是否默认</td>*/
/*             <td>*/
/*                 <select name="Qq[default]" class="easyui-combobox" id="default" style="width:200px;" data-options="required:true,panelHeight:'auto',editable:false,value:1">*/
/*                     <option value="1">是</option>*/
/*                     <option value="0">否</option>*/
/*                 </select>*/
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
/* <!--新增角色-->*/
/* */
/* <div id="dlg-edit" class="easyui-window" title="修改" style="width:398px;height:300px;padding:10px;" data-options="iconCls:'icon-save',closed:true,modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*     </iframe>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function edit(){*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择qq');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('qq/edit') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/* */
/*     function formatDefault(val, row) {*/
/*         if(val == 1) return '默认';*/
/*     }*/
/* */
/*     function setDefault(){*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择qq');*/
/*             return false;*/
/*         }*/
/* */
/*         if(selRow.default == 1){*/
/*             var tips = '您确认取消默认';*/
/*         }else{*/
/*             var tips = '您确认设置默认';*/
/*         }*/
/*         $.messager.confirm('Confirm', tips, function(r) {*/
/*             if (r) {*/
/*                 $.get("{{ url('qq/set-default') }}", {'id':selRow.id}, function(data) {*/
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
/*     function del(){*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择qq');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '您确定删除该qq群', function(r) {*/
/*             if (r) {*/
/*                 $.get("{{ url('qq/del') }}", {'id':selRow.id}, function(data) {*/
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
/*         var url = '/qq/add';*/
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
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
