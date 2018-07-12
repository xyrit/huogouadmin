<?php

/* money.html */
class __TwigTemplate_10d144bfb0aa942519a75511c6ecb05ab1ee4b159a4947b74d85754a09fdafe7 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "money.html", 1);
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
    <span>账户余额：<b>";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "money", array()), "html", null, true);
        echo "</b></span>
    <span style=\"float: right\">
        <select class=\"easyui-combobox\" id=\"type\" name=\"type\" data-options=\"panelHeight:'auto', onSelect:reloadgrid\">
            <option value=\"1\">充值</option>
            <option value=\"2\">消费</option>
            <option value=\"3\">转账</option>
        </select>
    </span>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"账户变动明细\" data-options=\"singleSelect:false,pagination:true,method:'get',url:'";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/money", array("id" => $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "id", array()))), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'created_at', width:180, align:'center'\" formatter=\"formatTime\">时间</th>
        <th data-options=\"field:'type', width:120, align:'center'\">变动类型</th>
        <th data-options=\"field:'content', width:400, align:'center'\">内容</th>
        <th data-options=\"field:'money', width:100, align:'center'\">账户变动</th>
    </tr>
    </thead>
</table>

";
    }

    // line 27
    public function block_script($context, array $blocks = array())
    {
        // line 28
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.type = \$('#type').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
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
        return "money.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 28,  63 => 27,  47 => 14,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>账户余额：<b>{{ user.money }}</b></span>*/
/*     <span style="float: right">*/
/*         <select class="easyui-combobox" id="type" name="type" data-options="panelHeight:'auto', onSelect:reloadgrid">*/
/*             <option value="1">充值</option>*/
/*             <option value="2">消费</option>*/
/*             <option value="3">转账</option>*/
/*         </select>*/
/*     </span>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="账户变动明细" data-options="singleSelect:false,pagination:true,method:'get',url:'{{ url('member/money', {id: user.id}) }}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'created_at', width:180, align:'center'" formatter="formatTime">时间</th>*/
/*         <th data-options="field:'type', width:120, align:'center'">变动类型</th>*/
/*         <th data-options="field:'content', width:400, align:'center'">内容</th>*/
/*         <th data-options="field:'money', width:100, align:'center'">账户变动</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.type = $('#type').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
