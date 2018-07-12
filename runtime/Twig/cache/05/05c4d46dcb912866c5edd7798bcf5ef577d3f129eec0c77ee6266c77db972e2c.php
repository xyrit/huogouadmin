<?php

/* message-log.html */
class __TwigTemplate_b856df1b3485817e466a05964b0dd21b72826c6047f402238dd4cb364c64ed89 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "message-log.html", 1);
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
    <span>发送方式
        <select class=\"easyui-combobox\" id=\"type\" name=\"type\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">全部</option>
            <option value=\"1\">短信</option>
            <option value=\"2\">邮箱</option>
            <option value=\"3\">站内信</option>
            <option value=\"4\">微信</option>
        </select>
    </span>
    <span>类型
        <input class=\"easyui-combobox\" name=\"type_name\" id=\"type_name\" data-options=\"url:'";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/log/get-log-type"), "html", null, true);
        echo "', valueField: 'id', textField: 'text'\" editable=\"true\" style=\"width:200px;\">
    </span>
    <span>状态
        <select class=\"easyui-combobox\" id=\"status\" name=\"status\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">全部</option>
            <option value=\"0\">成功</option>
            <option value=\"1\">失败</option>
        </select>
    </span>
    <span>操作时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"通知发送日志\"
       data-options=\"
            rownumbers:false,
            singleSelect:true,
            pagination:true,
            method:'get',
            url:'";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("log/message-log"), "html", null, true);
        echo "',
            rownumbers: false,
            pageSize: 20,
            nowrap: false
        \">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:80, align:'center'\">序号</th>
        <th data-options=\"field:'username', width:200\" formatter=\"formatName\">会员名</th>
        <th data-options=\"field:'mode', width:100, align:'center'\" formatter=\"formatType\">发送方式</th>
        <th data-options=\"field:'type_name', width:150, align:'center'\">类型</th>
        <th data-options=\"field:'message', width:800, align:'center'\">内容</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'created_at', width:180\" formatter=\"formatTime\">操作时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 59
    public function block_js($context, array $blocks = array())
    {
        // line 60
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.content = \$('#content').val();
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.type = \$('#type').combobox('getValue');
        queryParams.status = \$('#status').combobox('getValue');
        queryParams.type_name = \$('#type_name').combobox('getValue');
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
        if (val == 1) {
            return '短信';
        } else if (val == 2) {
            return '邮件';
        } else if (val == 3) {
            return '站内信';
        } else if (val == 4) {
            return '微信';
        }
    }

    function formatStatus(val, row) {
        if (val == 0) {
            return '成功';
        } else if (val == 1) {
            return '失败';
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
        return "message-log.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 60,  95 => 59,  72 => 39,  47 => 17,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>会员名 <input class="easyui-textbox" type="text" name="content" id="content" placeholder="请输入用户邮箱或手机"></span>*/
/*     <span>发送方式*/
/*         <select class="easyui-combobox" id="type" name="type" data-options="panelHeight:'auto'">*/
/*             <option value="all">全部</option>*/
/*             <option value="1">短信</option>*/
/*             <option value="2">邮箱</option>*/
/*             <option value="3">站内信</option>*/
/*             <option value="4">微信</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>类型*/
/*         <input class="easyui-combobox" name="type_name" id="type_name" data-options="url:'{{ url('/log/get-log-type') }}', valueField: 'id', textField: 'text'" editable="true" style="width:200px;">*/
/*     </span>*/
/*     <span>状态*/
/*         <select class="easyui-combobox" id="status" name="status" data-options="panelHeight:'auto'">*/
/*             <option value="all">全部</option>*/
/*             <option value="0">成功</option>*/
/*             <option value="1">失败</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>操作时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="通知发送日志"*/
/*        data-options="*/
/*             rownumbers:false,*/
/*             singleSelect:true,*/
/*             pagination:true,*/
/*             method:'get',*/
/*             url:'{{ url('log/message-log') }}',*/
/*             rownumbers: false,*/
/*             pageSize: 20,*/
/*             nowrap: false*/
/*         ">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:80, align:'center'">序号</th>*/
/*         <th data-options="field:'username', width:200" formatter="formatName">会员名</th>*/
/*         <th data-options="field:'mode', width:100, align:'center'" formatter="formatType">发送方式</th>*/
/*         <th data-options="field:'type_name', width:150, align:'center'">类型</th>*/
/*         <th data-options="field:'message', width:800, align:'center'">内容</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'created_at', width:180" formatter="formatTime">操作时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.content = $('#content').val();*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.type = $('#type').combobox('getValue');*/
/*         queryParams.status = $('#status').combobox('getValue');*/
/*         queryParams.type_name = $('#type_name').combobox('getValue');*/
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
/*         if (val == 1) {*/
/*             return '短信';*/
/*         } else if (val == 2) {*/
/*             return '邮件';*/
/*         } else if (val == 3) {*/
/*             return '站内信';*/
/*         } else if (val == 4) {*/
/*             return '微信';*/
/*         }*/
/*     }*/
/* */
/*     function formatStatus(val, row) {*/
/*         if (val == 0) {*/
/*             return '成功';*/
/*         } else if (val == 1) {*/
/*             return '失败';*/
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
