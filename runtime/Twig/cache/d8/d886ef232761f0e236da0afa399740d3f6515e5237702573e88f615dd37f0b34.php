<?php

/* invite.html */
class __TwigTemplate_b35d5936922a7b7261d90ac04477c25bb956c2badb503a6a726446c24eea432a extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "invite.html", 1);
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
        echo "
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"邀请列表\" data-options=\"singleSelect:false,pagination:true,method:'get',url:'";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/invite", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
        <tr>
            <th data-options=\"field:'nickname', width:120, align:'center'\" formatter=\"formatNickname\">昵称</th>
            <th data-options=\"field:'phone', width:100, align:'center'\" formatter=\"formatNickname\">手机</th>
            <th data-options=\"field:'email', width:150, align:'center'\" formatter=\"formatNickname\">邮箱</th>
            <th data-options=\"field:'created_at', width:180\" formatter=\"formatTime\">注册时间</th>
            <th data-options=\"field:'money', width:100, align:'center'\">消费金额</th>
        </tr>
    </thead>
</table>

";
    }

    // line 19
    public function block_script($context, array $blocks = array())
    {
        // line 20
        echo "<script>
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
        return "invite.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 20,  52 => 19,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="邀请列表" data-options="singleSelect:false,pagination:true,method:'get',url:'{{  url('member/invite', {id: id})}}',pageSize: 20">*/
/*     <thead>*/
/*         <tr>*/
/*             <th data-options="field:'nickname', width:120, align:'center'" formatter="formatNickname">昵称</th>*/
/*             <th data-options="field:'phone', width:100, align:'center'" formatter="formatNickname">手机</th>*/
/*             <th data-options="field:'email', width:150, align:'center'" formatter="formatNickname">邮箱</th>*/
/*             <th data-options="field:'created_at', width:180" formatter="formatTime">注册时间</th>*/
/*             <th data-options="field:'money', width:100, align:'center'">消费金额</th>*/
/*         </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script>*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
