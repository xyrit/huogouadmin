<?php

/* glory-list.html */
class __TwigTemplate_b3e0cebd0f28b691d757980d7115fd7f31fb13e81bcd9b13d6586d3ab3d6ebdd extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "glory-list.html", 1);
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
        echo "<h2>荣誉榜</h2>
<table border=\"1\" cellspacing=\"0\">
    <thead>
    <tr>
        <th width=\"200px\">次数</th>
        <th width=\"200px\">到达人数</th>
        <th width=\"200px\">操作</th>
    </tr>
    </thead>
    <tbody>
    ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["gloryTask"]) ? $context["gloryTask"] : null));
        foreach ($context['_seq'] as $context["num"] => $context["item"]) {
            // line 15
            echo "    <tr align=\"center\">
        <td>";
            // line 16
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo "</td>
        <td>";
            // line 17
            echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "count", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "count", array()), 0)) : (0)), "html", null, true);
            echo "</td>
        <td><a onclick=\"view(4, 1, 1, ";
            // line 18
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo ", '登荣誉榜";
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo "次')\">详情</a></td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['num'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "    </tbody>
</table>

<h2>土豪君</h2>
<table border=\"1\" cellspacing=\"0\">
    <thead>
    <tr>
        <th width=\"200px\">次数</th>
        <th width=\"200px\">到达人数</th>
        <th width=\"200px\">操作</th>
    </tr>
    </thead>
    <tbody>
    ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["richTask"]) ? $context["richTask"] : null));
        foreach ($context['_seq'] as $context["num"] => $context["item"]) {
            // line 35
            echo "    <tr align=\"center\">
        <td>";
            // line 36
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo "</td>
        <td>";
            // line 37
            echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "count", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "count", array()), 0)) : (0)), "html", null, true);
            echo "</td>
        <td><a onclick=\"view(4, 1, 2, ";
            // line 38
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo ", '土豪君";
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo "次')\">详情</a></td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['num'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "    </tbody>
</table>

<h2>沙发君</h2>
<table border=\"1\" cellspacing=\"0\">
    <thead>
    <tr>
        <th width=\"200px\">次数</th>
        <th width=\"200px\">到达人数</th>
        <th width=\"200px\">操作</th>
    </tr>
    </thead>
    <tbody>
    ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["firstTask"]) ? $context["firstTask"] : null));
        foreach ($context['_seq'] as $context["num"] => $context["item"]) {
            // line 55
            echo "    <tr align=\"center\">
        <td>";
            // line 56
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo "</td>
        <td>";
            // line 57
            echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "count", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "count", array()), 0)) : (0)), "html", null, true);
            echo "</td>
        <td><a onclick=\"view(4, 1, 3, ";
            // line 58
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo ", '沙发君";
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo "次')\">详情</a></td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['num'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "    </tbody>
</table>

<h2>收尾君</h2>
<table border=\"1\" cellspacing=\"0\">
    <thead>
    <tr>
        <th width=\"200px\">次数</th>
        <th width=\"200px\">到达人数</th>
        <th width=\"200px\">操作</th>
    </tr>
    </thead>
    <tbody>
    ";
        // line 74
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["endTask"]) ? $context["endTask"] : null));
        foreach ($context['_seq'] as $context["num"] => $context["item"]) {
            // line 75
            echo "    <tr align=\"center\">
        <td>";
            // line 76
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo "</td>
        <td>";
            // line 77
            echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "count", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "count", array()), 0)) : (0)), "html", null, true);
            echo "</td>
        <td><a onclick=\"view(4, 1, 4, ";
            // line 78
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo ", '收尾君";
            echo twig_escape_filter($this->env, $context["num"], "html", null, true);
            echo "次')\">详情</a></td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['num'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        echo "    </tbody>
</table>

<div id=\"dlg-view\" class=\"easyui-window\" title=\"查看详情\" style=\"width:1242px;height:600px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"view_iframe\">
    </iframe>
</div>
";
    }

    // line 96
    public function block_script($context, array $blocks = array())
    {
        // line 97
        echo "<script type=\"text/javascript\">
    function view(type, level, cate, num, title) {
        \$('#view_iframe').prop('src', \"";
        // line 99
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/detail"), "html", null, true);
        echo "\"+'?type='+type+'&level='+level+'&cate='+cate+'&num='+num+'&title='+title);
        \$('#dlg-view').window('open');
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "glory-list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 99,  213 => 97,  210 => 96,  193 => 81,  182 => 78,  178 => 77,  174 => 76,  171 => 75,  167 => 74,  152 => 61,  141 => 58,  137 => 57,  133 => 56,  130 => 55,  126 => 54,  111 => 41,  100 => 38,  96 => 37,  92 => 36,  89 => 35,  85 => 34,  70 => 21,  59 => 18,  55 => 17,  51 => 16,  48 => 15,  44 => 14,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/*   */
/* {% block main %}*/
/* <h2>荣誉榜</h2>*/
/* <table border="1" cellspacing="0">*/
/*     <thead>*/
/*     <tr>*/
/*         <th width="200px">次数</th>*/
/*         <th width="200px">到达人数</th>*/
/*         <th width="200px">操作</th>*/
/*     </tr>*/
/*     </thead>*/
/*     <tbody>*/
/*     {% for num,item in gloryTask %}*/
/*     <tr align="center">*/
/*         <td>{{ num }}</td>*/
/*         <td>{{ item.count | default(0) }}</td>*/
/*         <td><a onclick="view(4, 1, 1, {{ num }}, '登荣誉榜{{ num }}次')">详情</a></td>*/
/*     </tr>*/
/*     {% endfor %}*/
/*     </tbody>*/
/* </table>*/
/* */
/* <h2>土豪君</h2>*/
/* <table border="1" cellspacing="0">*/
/*     <thead>*/
/*     <tr>*/
/*         <th width="200px">次数</th>*/
/*         <th width="200px">到达人数</th>*/
/*         <th width="200px">操作</th>*/
/*     </tr>*/
/*     </thead>*/
/*     <tbody>*/
/*     {% for num,item in richTask %}*/
/*     <tr align="center">*/
/*         <td>{{ num }}</td>*/
/*         <td>{{ item.count | default(0) }}</td>*/
/*         <td><a onclick="view(4, 1, 2, {{ num }}, '土豪君{{ num }}次')">详情</a></td>*/
/*     </tr>*/
/*     {% endfor %}*/
/*     </tbody>*/
/* </table>*/
/* */
/* <h2>沙发君</h2>*/
/* <table border="1" cellspacing="0">*/
/*     <thead>*/
/*     <tr>*/
/*         <th width="200px">次数</th>*/
/*         <th width="200px">到达人数</th>*/
/*         <th width="200px">操作</th>*/
/*     </tr>*/
/*     </thead>*/
/*     <tbody>*/
/*     {% for num,item in firstTask %}*/
/*     <tr align="center">*/
/*         <td>{{ num }}</td>*/
/*         <td>{{ item.count | default(0) }}</td>*/
/*         <td><a onclick="view(4, 1, 3, {{ num }}, '沙发君{{ num }}次')">详情</a></td>*/
/*     </tr>*/
/*     {% endfor %}*/
/*     </tbody>*/
/* </table>*/
/* */
/* <h2>收尾君</h2>*/
/* <table border="1" cellspacing="0">*/
/*     <thead>*/
/*     <tr>*/
/*         <th width="200px">次数</th>*/
/*         <th width="200px">到达人数</th>*/
/*         <th width="200px">操作</th>*/
/*     </tr>*/
/*     </thead>*/
/*     <tbody>*/
/*     {% for num,item in endTask %}*/
/*     <tr align="center">*/
/*         <td>{{ num }}</td>*/
/*         <td>{{ item.count | default(0) }}</td>*/
/*         <td><a onclick="view(4, 1, 4, {{ num }}, '收尾君{{ num }}次')">详情</a></td>*/
/*     </tr>*/
/*     {% endfor %}*/
/*     </tbody>*/
/* </table>*/
/* */
/* <div id="dlg-view" class="easyui-window" title="查看详情" style="width:1242px;height:600px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="view_iframe">*/
/*     </iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script type="text/javascript">*/
/*     function view(type, level, cate, num, title) {*/
/*         $('#view_iframe').prop('src', "{{ url('user-task/detail') }}"+'?type='+type+'&level='+level+'&cate='+cate+'&num='+num+'&title='+title);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
