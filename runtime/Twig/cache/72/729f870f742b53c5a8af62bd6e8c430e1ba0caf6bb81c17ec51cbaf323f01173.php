<?php

/* point.html */
class __TwigTemplate_4dfeea9595d67773ba496bdfc5429d363e5587bea16467400599160f6c1aa9ac extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "point.html", 1);
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
        echo "<span>福分余额：<b id=\"point\"></b></span><br><br>
<div class=\"search\">
    <span>时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <span style=\"float: right\">
        <select class=\"easyui-combobox\" id=\"type\" name=\"type\" data-options=\"panelHeight:'auto', onSelect:reloadgrid\">
            <option value=\"all\">全部</option>
            <option value=\"1\">增加</option>
            <option value=\"0\">减少</option>
        </select>
    </span>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"佣金明细\" data-options=\"singleSelect:false,pagination:true,method:'get',url:'";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/point", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'created_at', width:180, align:'center'\" formatter=\"formatTime\">时间</th>
        <th data-options=\"field:'type', width:120, align:'center'\" formatter=\"formatType\">变动原因</th>
        <th data-options=\"field:'desc', width:400, align:'center'\">内容</th>
        <th data-options=\"field:'point', width:100, align:'center'\">福分变动</th>
        <th data-options=\"field:'current_point', width:100, align:'center'\">福分余额</th>
    </tr>
    </thead>
</table>

";
    }

    // line 33
    public function block_script($context, array $blocks = array())
    {
        // line 34
        echo "<script>
    \$('#listdata').datagrid({
        'onLoadSuccess': function(data) {
            \$('#point').html(data.point);
        }
    });
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.type = \$('#type').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }
    function formatType(val, row) {
        if (row.point < 0) {
            return '减少';
        }
        return '增加';
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
        return "point.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 34,  66 => 33,  49 => 19,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <span>福分余额：<b id="point"></b></span><br><br>*/
/* <div class="search">*/
/*     <span>时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <span style="float: right">*/
/*         <select class="easyui-combobox" id="type" name="type" data-options="panelHeight:'auto', onSelect:reloadgrid">*/
/*             <option value="all">全部</option>*/
/*             <option value="1">增加</option>*/
/*             <option value="0">减少</option>*/
/*         </select>*/
/*     </span>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="佣金明细" data-options="singleSelect:false,pagination:true,method:'get',url:'{{ url('member/point', {id: id}) }}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'created_at', width:180, align:'center'" formatter="formatTime">时间</th>*/
/*         <th data-options="field:'type', width:120, align:'center'" formatter="formatType">变动原因</th>*/
/*         <th data-options="field:'desc', width:400, align:'center'">内容</th>*/
/*         <th data-options="field:'point', width:100, align:'center'">福分变动</th>*/
/*         <th data-options="field:'current_point', width:100, align:'center'">福分余额</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script>*/
/*     $('#listdata').datagrid({*/
/*         'onLoadSuccess': function(data) {*/
/*             $('#point').html(data.point);*/
/*         }*/
/*     });*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.type = $('#type').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/*     function formatType(val, row) {*/
/*         if (row.point < 0) {*/
/*             return '减少';*/
/*         }*/
/*         return '增加';*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
