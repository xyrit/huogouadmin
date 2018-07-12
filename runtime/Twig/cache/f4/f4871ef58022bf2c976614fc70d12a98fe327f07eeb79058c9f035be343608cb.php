<?php

/* message.html */
class __TwigTemplate_5c6bc4c219cd63330b8d2d10ca0c89d95255f3c9b646b8d6f271ba6456730352 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "message.html", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'script' => array($this, 'block_script'),
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
        echo "<div class=\"search\">
    <span>时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <span style=\"float: right\">
        <select class=\"easyui-combobox\" id=\"type\" name=\"type\" data-options=\"panelHeight:'auto', onSelect:goto\">
            <option value=\"1\" ";
        // line 12
        if (((isset($context["type"]) ? $context["type"] : null) == 1)) {
            echo "selected";
        }
        echo ">系统消息</option>
            <option value=\"2\" ";
        // line 13
        if (((isset($context["type"]) ? $context["type"] : null) == 2)) {
            echo "selected";
        }
        echo ">私信</option>
            <option value=\"3\" ";
        // line 14
        if (((isset($context["type"]) ? $context["type"] : null) == 3)) {
            echo "selected";
        }
        echo ">好友请求</option>
        </select>
    </span>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"消息列表\" data-options=\"singleSelect:false,pagination:true,method:'get',url:'";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/message", array("id" => (isset($context["id"]) ? $context["id"] : null), "type" => (isset($context["type"]) ? $context["type"] : null))), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
    <tr>
        ";
        // line 21
        if (((isset($context["type"]) ? $context["type"] : null) == 1)) {
            // line 22
            echo "        <th data-options=\"field:'message', width:1000, align:'center'\">内容</th>
        <th data-options=\"field:'created_at', width:180, align:'center'\" formatter=\"formatTime\">时间</th>
        ";
        } elseif ((        // line 24
(isset($context["type"]) ? $context["type"] : null) == 2)) {
            // line 25
            echo "        <th data-options=\"field:'subject', width:120, align:'center'\">类型</th>
        <th data-options=\"field:'name', width:400, align:'center'\">对象</th>
        <th data-options=\"field:'comment_count', width:100, align:'center'\">内容</th>
        <th data-options=\"field:'created_at', width:180, align:'center'\" formatter=\"formatTime\">时间</th>
        ";
        } else {
            // line 30
            echo "        <th data-options=\"field:'username', width:120, align:'center'\">会员名</th>
        <th data-options=\"field:'status', width:400, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'apply_time', width:180, align:'center'\" formatter=\"formatTime\">时间</th>
        ";
        }
        // line 34
        echo "    </tr>
    </thead>
</table>

";
    }

    // line 40
    public function block_script($context, array $blocks = array())
    {
        // line 41
        echo "<script>
    function reloadgrid() {
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.type = \$('#type').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }
    function goto() {
        var startTime = \$('#startTime').datetimebox('getValue'),
                endTime = \$('#endTime').datetimebox('getValue'),
                type = \$('#type').combobox('getValue');
        var url = \"";
        // line 54
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/message", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "\";
        if (startTime) {
            url += '&startTime=' + startTime;
        }
        if (endTime) {
            url += '&endTime=' + endTime;
        }
        if (type) {
            url += '&type=' + type;
        }
        window.location.href = url;
    }
    function formatStatus(val, row) {
        return val == 0 ? '未处理' : (val == 1 ? '已同意' : '已忽略');
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
        return "message.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 54,  101 => 41,  98 => 40,  90 => 34,  84 => 30,  77 => 25,  75 => 24,  71 => 22,  69 => 21,  63 => 18,  54 => 14,  48 => 13,  42 => 12,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <span style="float: right">*/
/*         <select class="easyui-combobox" id="type" name="type" data-options="panelHeight:'auto', onSelect:goto">*/
/*             <option value="1" {% if type == 1 %}selected{% endif %}>系统消息</option>*/
/*             <option value="2" {% if type == 2 %}selected{% endif %}>私信</option>*/
/*             <option value="3" {% if type == 3 %}selected{% endif %}>好友请求</option>*/
/*         </select>*/
/*     </span>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="消息列表" data-options="singleSelect:false,pagination:true,method:'get',url:'{{ url('member/message', {id: id, type: type}) }}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         {% if type == 1 %}*/
/*         <th data-options="field:'message', width:1000, align:'center'">内容</th>*/
/*         <th data-options="field:'created_at', width:180, align:'center'" formatter="formatTime">时间</th>*/
/*         {% elseif type == 2 %}*/
/*         <th data-options="field:'subject', width:120, align:'center'">类型</th>*/
/*         <th data-options="field:'name', width:400, align:'center'">对象</th>*/
/*         <th data-options="field:'comment_count', width:100, align:'center'">内容</th>*/
/*         <th data-options="field:'created_at', width:180, align:'center'" formatter="formatTime">时间</th>*/
/*         {% else %}*/
/*         <th data-options="field:'username', width:120, align:'center'">会员名</th>*/
/*         <th data-options="field:'status', width:400, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'apply_time', width:180, align:'center'" formatter="formatTime">时间</th>*/
/*         {% endif %}*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script>*/
/*     function reloadgrid() {*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.type = $('#type').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/*     function goto() {*/
/*         var startTime = $('#startTime').datetimebox('getValue'),*/
/*                 endTime = $('#endTime').datetimebox('getValue'),*/
/*                 type = $('#type').combobox('getValue');*/
/*         var url = "{{ url('member/message', {id: id}) }}";*/
/*         if (startTime) {*/
/*             url += '&startTime=' + startTime;*/
/*         }*/
/*         if (endTime) {*/
/*             url += '&endTime=' + endTime;*/
/*         }*/
/*         if (type) {*/
/*             url += '&type=' + type;*/
/*         }*/
/*         window.location.href = url;*/
/*     }*/
/*     function formatStatus(val, row) {*/
/*         return val == 0 ? '未处理' : (val == 1 ? '已同意' : '已忽略');*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
