<?php

/* login-log.html */
class __TwigTemplate_e06c5fe108d19b3181bba025586739c7e061a67b2d931c678ac96c0f4e9de555 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "login-log.html", 1);
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
    <span>会员名 <input class=\"easyui-textbox\" type=\"text\" name=\"content\" id=\"content\" placeholder=\"请输入用户邮箱或手机\"></span>
    <span>终端类型
        <select class=\"easyui-combobox\" id=\"type\" name=\"type\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"0\">PC</option>
            <option value=\"1\">微信</option>
            <option value=\"2\">WAP</option>
            <option value=\"3\">安卓</option>
            <option value=\"4\">IOS</option>
        </select>
    </span>
    <span>操作时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"用户登录日志\"
       data-options=\"
            rownumbers:false,
            singleSelect:true,
            pagination:true,
            method:'get',
            url:'";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("log/login-log"), "html", null, true);
        echo "',
            rownumbers: false,
            pageSize: 20
        \">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:80, align:'center'\">序号</th>
        <th data-options=\"field:'username', width:200\" formatter=\"formatName\">会员名</th>
        <th data-options=\"field:'type', width:50, align:'center'\" formatter=\"formatType\">终端</th>
        <th data-options=\"field:'action', width:80, align:'center'\" formatter=\"formatAction\">动作</th>
        <th data-options=\"field:'ip', width:100, align:'center'\">IP地址</th>
        <th data-options=\"field:'created_at', width:180\" formatter=\"formatTime\">操作时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 48
    public function block_js($context, array $blocks = array())
    {
        // line 49
        echo "<script>
    function onLoadSuccess() {console.log(\$(\"#listdata\").datagrid('getData').total);}

    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.content = \$('#content').val();
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.type = \$('#type').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    //格式化
    function formatName(val, row) {
        result = '';

        if (row.phone) {
            result += '手机号：' + row.phone + '<br />';
        }
        if (row.email) {
            result += '邮箱：' + row.email;
        }

        return result;
    }

    function formatType(val, row) {
        if (val == 0) {
            return 'PC';
        } else if (val == 1) {
            return '微信';
        } else if (val == 2) {
            return 'WAP';
        } else if (val == 3) {
            return '安卓';
        } else if (val == 4) {
            return 'IOS';
        }
    }

    function formatAction(val, row) {
        if (val == 0) {
            return '登录';
        } else if (val == 1) {
            return '登出';
        }
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
        return "login-log.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 49,  81 => 48,  60 => 30,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>会员名 <input class="easyui-textbox" type="text" name="content" id="content" placeholder="请输入用户邮箱或手机"></span>*/
/*     <span>终端类型*/
/*         <select class="easyui-combobox" id="type" name="type" data-options="panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="0">PC</option>*/
/*             <option value="1">微信</option>*/
/*             <option value="2">WAP</option>*/
/*             <option value="3">安卓</option>*/
/*             <option value="4">IOS</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>操作时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="用户登录日志"*/
/*        data-options="*/
/*             rownumbers:false,*/
/*             singleSelect:true,*/
/*             pagination:true,*/
/*             method:'get',*/
/*             url:'{{ url('log/login-log') }}',*/
/*             rownumbers: false,*/
/*             pageSize: 20*/
/*         ">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:80, align:'center'">序号</th>*/
/*         <th data-options="field:'username', width:200" formatter="formatName">会员名</th>*/
/*         <th data-options="field:'type', width:50, align:'center'" formatter="formatType">终端</th>*/
/*         <th data-options="field:'action', width:80, align:'center'" formatter="formatAction">动作</th>*/
/*         <th data-options="field:'ip', width:100, align:'center'">IP地址</th>*/
/*         <th data-options="field:'created_at', width:180" formatter="formatTime">操作时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function onLoadSuccess() {console.log($("#listdata").datagrid('getData').total);}*/
/* */
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.content = $('#content').val();*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.type = $('#type').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     //格式化*/
/*     function formatName(val, row) {*/
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
/* */
/*     function formatType(val, row) {*/
/*         if (val == 0) {*/
/*             return 'PC';*/
/*         } else if (val == 1) {*/
/*             return '微信';*/
/*         } else if (val == 2) {*/
/*             return 'WAP';*/
/*         } else if (val == 3) {*/
/*             return '安卓';*/
/*         } else if (val == 4) {*/
/*             return 'IOS';*/
/*         }*/
/*     }*/
/* */
/*     function formatAction(val, row) {*/
/*         if (val == 0) {*/
/*             return '登录';*/
/*         } else if (val == 1) {*/
/*             return '登出';*/
/*         }*/
/*     }*/
/* */
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
