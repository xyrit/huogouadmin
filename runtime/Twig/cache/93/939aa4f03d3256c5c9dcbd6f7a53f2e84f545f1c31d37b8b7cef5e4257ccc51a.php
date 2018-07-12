<?php

/* group.html */
class __TwigTemplate_b4650e1c0587b9b83b2cf5b27fb2671e0f364988793b829455648ded1df8a39c extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "group.html", 1);
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
        echo "<table id=\"listdata\" class=\"easyui-datagrid\" title=\"圈子列表\" data-options=\"singleSelect:false,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/group", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'name', width:300, align:'center'\">圈子名</th>
        <th data-options=\"field:'created_at', width:200, align:'center'\" formatter=\"formatTime\">加入时间</th>
    </tr>
    </thead>
</table>
";
    }

    // line 14
    public function block_script($context, array $blocks = array())
    {
        // line 15
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
        return "group.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 15,  46 => 14,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table id="listdata" class="easyui-datagrid" title="圈子列表" data-options="singleSelect:false,pagination:true,method:'get',url:'{{ url('member/group', {id: id}) }}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'name', width:300, align:'center'">圈子名</th>*/
/*         <th data-options="field:'created_at', width:200, align:'center'" formatter="formatTime">加入时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
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
