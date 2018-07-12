<?php

/* index.html */
class __TwigTemplate_7ed47f727b47345f462e6a09f61104c808c119b501ad5a3264c83e071f26729a extends yii\twig\Template
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
    <span>建议类型
        <select class=\"easyui-combobox\" id=\"type\" name=\"type\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"0\">投诉与建议</option>
            <option value=\"1\">商品配送</option>
            <option value=\"2\">售后服务</option>
        </select>
    </span>
    <span>电话
        <input class=\"easyui-textbox\" type=\"text\" name=\"phone\" id=\"phone\">
    </span>
    <span>Email
        <input class=\"easyui-textbox\" type=\"text\" name=\"email\" id=\"email\">
    </span>
    <span>提交时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"投诉列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/suggestion/index"), "html", null, true);
        echo "',mode:'local',pageSize:20,nowrap:false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">序号</th>
        <th data-options=\"field:'type', width:100, align:'center'\" formatter=\"formatType\">建议类型</th>
        <th data-options=\"field:'phone', width:100, align:'center'\">电话</th>
        <th data-options=\"field:'email', width:200, align:'center'\">Email</th>
        <th data-options=\"field:'content', width:800, align:'center'\">内容</th>
        <th data-options=\"field:'created_at', width:180, align:'center'\" formatter=\"formatTime\">提交时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 42
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 43
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-no',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 45
        echo "    </div>
</div>

";
    }

    // line 50
    public function block_js($context, array $blocks = array())
    {
        // line 51
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.phone = \$('#phone').val();
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.email = \$('#email').val();
        queryParams.type\t= \$('#type').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function formatType(val, row) {
        if (val == 0) {
            return '投诉与建议';
        } else if (val == 1) {
            return '商品配送';
        } else if (val == 2) {
            return '售后服务';
        }
    }

    function del() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }

        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            if (r) {
                \$.post(\"";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/suggestion/del"), "html", null, true);
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
        return array (  124 => 82,  91 => 51,  88 => 50,  81 => 45,  77 => 43,  75 => 42,  57 => 27,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>建议类型*/
/*         <select class="easyui-combobox" id="type" name="type" data-options="panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="0">投诉与建议</option>*/
/*             <option value="1">商品配送</option>*/
/*             <option value="2">售后服务</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>电话*/
/*         <input class="easyui-textbox" type="text" name="phone" id="phone">*/
/*     </span>*/
/*     <span>Email*/
/*         <input class="easyui-textbox" type="text" name="email" id="email">*/
/*     </span>*/
/*     <span>提交时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="投诉列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('/suggestion/index')}}',mode:'local',pageSize:20,nowrap:false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">序号</th>*/
/*         <th data-options="field:'type', width:100, align:'center'" formatter="formatType">建议类型</th>*/
/*         <th data-options="field:'phone', width:100, align:'center'">电话</th>*/
/*         <th data-options="field:'email', width:200, align:'center'">Email</th>*/
/*         <th data-options="field:'content', width:800, align:'center'">内容</th>*/
/*         <th data-options="field:'created_at', width:180, align:'center'" formatter="formatTime">提交时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if del == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-no',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.phone = $('#phone').val();*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.email = $('#email').val();*/
/*         queryParams.type	= $('#type').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function formatType(val, row) {*/
/*         if (val == 0) {*/
/*             return '投诉与建议';*/
/*         } else if (val == 1) {*/
/*             return '商品配送';*/
/*         } else if (val == 2) {*/
/*             return '售后服务';*/
/*         }*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('/suggestion/del') }}", {'id':selRow.id}, function(data) {*/
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
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
