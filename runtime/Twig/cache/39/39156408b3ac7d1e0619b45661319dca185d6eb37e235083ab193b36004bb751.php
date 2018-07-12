<?php

/* comment.html */
class __TwigTemplate_deb33454d5130dfd0eb7b9ea5209537c85a90dbeb67fedecc8a90fd22b3786c1 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "comment.html", 1);
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
        echo "<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"话题列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("group/comment"), "html", null, true);
        echo "'\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">ID</th>
        <th data-options=\"field:'content', width:500, align:'center'\">内容</th>
        <th data-options=\"field:'username', width:150, align:'center'\" formatter=\"formatUsername\">用户</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'created_at', width:150, align:'center'\">时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 18
        if (((isset($context["verify"]) ? $context["verify"] : null) == 1)) {
            // line 19
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"verify()\">审核</a>
        ";
        }
        // line 21
        echo "        ";
        if (((isset($context["del_comment"]) ? $context["del_comment"] : null) == 1)) {
            // line 22
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 24
        echo "    </div>
</div>

<div id=\"dlg_verify\" class=\"easyui-window\" title=\"审核\" data-options=\"closed:true,modal:true\" style=\"width:400px;height:200px;padding:10px\" >
    <table cellpadding=\"5\">
        <tr>
            <td style=\"width: 100px\">审核</td>
            <td>
                <select class=\"easyui-combobox\" name=\"status\" id=\"status\" data-options=\"panelHeight:'auto'\">
                    <option value=\"1\">通过</option>
                    <option value=\"0\">不通过</option>
                </select>
            </td>
        </tr>
    </table>
    <div style=\"text-align:center;padding:5px;margin-top:20px;\">
        <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save()\">确定</a>
        <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg_verify').dialog('close')\">取消</a>
    </div>
</div>

";
    }

    // line 47
    public function block_js($context, array $blocks = array())
    {
        // line 48
        echo "<script>
    function save(){
        var selRow = \$('#listdata').datagrid('getSelected');
        var status = \$('#status').combobox('getValue');
        \$.get('/group/verify-comment', {'id':selRow.id, 'status':status}, function(data){
            if (data == 1) {
                \$.messager.alert('成功', '审核成功');
                setTimeout(function(){location.reload();}, 2000);
            } else {
                \$.messager.alert('错误', '审核失败', 'error');
            }
        })
    }

    function verify(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个话题');
            return false;
        }
        if (selRow.status != 0) {
            \$.messager.alert('错误','请选择待审核回帖');
            return false;
        }
        \$('#dlg_verify').window('open');
    }

    function del(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个回帖');
            return false;
        }

        \$.messager.confirm('Confirm', '您确定删除该回帖吗？', function(r) {
            if (r) {
                \$.post(\"";
        // line 84
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("group/del-comment"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                    if (data == 0) {
                        \$.messager.alert('错误', '删除失败');
                    } else {
                        \$.messager.alert('成功', '删除成功');
                        setTimeout(function(){location.reload();}, 2000);
                    }
                }, 'json');
            }
        });
    }


    function formatUsername(val, row){
        result = '';

        if (row.phone) {
            result += '手机号：' + row.phone + '<br />';
        }
        if (row.email) {
            result += '邮箱：' + row.email;
        }

        return result;
    }
    function formatStatus(val, row){
        if(val == 0) return '<span color=\"red\">待审核</span>';
        else if(val == 1) return '通过';
        else if(val == 2) return '不通过';
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "comment.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 84,  91 => 48,  88 => 47,  63 => 24,  59 => 22,  56 => 21,  52 => 19,  50 => 18,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table id="listdata"  class="easyui-datagrid" title="话题列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('group/comment')}}'">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">ID</th>*/
/*         <th data-options="field:'content', width:500, align:'center'">内容</th>*/
/*         <th data-options="field:'username', width:150, align:'center'" formatter="formatUsername">用户</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'created_at', width:150, align:'center'">时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if verify == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="verify()">审核</a>*/
/*         {% endif %}*/
/*         {% if del_comment == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg_verify" class="easyui-window" title="审核" data-options="closed:true,modal:true" style="width:400px;height:200px;padding:10px" >*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td style="width: 100px">审核</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="status" id="status" data-options="panelHeight:'auto'">*/
/*                     <option value="1">通过</option>*/
/*                     <option value="0">不通过</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     <div style="text-align:center;padding:5px;margin-top:20px;">*/
/*         <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">确定</a>*/
/*         <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_verify').dialog('close')">取消</a>*/
/*     </div>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function save(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         var status = $('#status').combobox('getValue');*/
/*         $.get('/group/verify-comment', {'id':selRow.id, 'status':status}, function(data){*/
/*             if (data == 1) {*/
/*                 $.messager.alert('成功', '审核成功');*/
/*                 setTimeout(function(){location.reload();}, 2000);*/
/*             } else {*/
/*                 $.messager.alert('错误', '审核失败', 'error');*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     function verify(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个话题');*/
/*             return false;*/
/*         }*/
/*         if (selRow.status != 0) {*/
/*             $.messager.alert('错误','请选择待审核回帖');*/
/*             return false;*/
/*         }*/
/*         $('#dlg_verify').window('open');*/
/*     }*/
/* */
/*     function del(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个回帖');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '您确定删除该回帖吗？', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('group/del-comment') }}", {'id':selRow.id}, function(data) {*/
/*                     if (data == 0) {*/
/*                         $.messager.alert('错误', '删除失败');*/
/*                     } else {*/
/*                         $.messager.alert('成功', '删除成功');*/
/*                         setTimeout(function(){location.reload();}, 2000);*/
/*                     }*/
/*                 }, 'json');*/
/*             }*/
/*         });*/
/*     }*/
/* */
/* */
/*     function formatUsername(val, row){*/
/*         result = '';*/
/* */
/*         if (row.phone) {*/
/*             result += '手机号：' + row.phone + '<br />';*/
/*         }*/
/*         if (row.email) {*/
/*             result += '邮箱：' + row.email;*/
/*         }*/
/* */
/*         return result;*/
/*     }*/
/*     function formatStatus(val, row){*/
/*         if(val == 0) return '<span color="red">待审核</span>';*/
/*         else if(val == 1) return '通过';*/
/*         else if(val == 2) return '不通过';*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
