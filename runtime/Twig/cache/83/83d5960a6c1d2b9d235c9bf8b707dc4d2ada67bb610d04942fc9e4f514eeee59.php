<?php

/* h5pay.html */
class __TwigTemplate_d73e54d5d14b8a4a0efb009cfeae85c0bffb8d4bfbe770af5ec5e56eef2df543 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "h5pay.html", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
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
<div class=\"easyui-tabs\" style=\"width:500px;height:auto\" id=\"login\">
    <div title=\"伙购\">
        <form method=\"post\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/h5pay"), "html", null, true);
        echo "\" name=\"huogouForm\">
            <table cellpadding=\"5\">
                <tr>
                    <input type=\"hidden\" name=\"from\" value=\"1\" id=\"huogouFrom\">
                    <td>伙购网</td>
                    <td>启用版本号:</td>
                    <td><input type=\"text\" name=\"content[version]\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["huogou"]) ? $context["huogou"] : null), "content", array()), "version", array()), "html", null, true);
        echo "\"></td>
                    <td>是否启用:</td>
                    <td><input type=\"checkbox\" name=\"status\" value=\"1\" ";
        // line 15
        if (($this->getAttribute((isset($context["huogou"]) ? $context["huogou"] : null), "status", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td><input type=\"submit\" value=\"提交\"></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>

    <div title=\"滴滴\">
        <form method=\"post\" action=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/h5pay"), "html", null, true);
        echo "?from=2\" name=\"diForm\">
            <table cellpadding=\"5\">
                <tr>
                    <input type=\"hidden\" name=\"from\" value=\"2\" id=\"didiFrom\">
                    <td>滴滴夺宝</td>
                    <td>启用版本号:</td>
                    <td><input type=\"text\" name=\"content[version]\" value=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["didi"]) ? $context["didi"] : null), "content", array()), "version", array()), "html", null, true);
        echo "\"></td>
                    <td>是否启用:</td>
                    <td><input type=\"checkbox\" name=\"status\" value=\"1\" ";
        // line 34
        if (($this->getAttribute((isset($context["didi"]) ? $context["didi"] : null), "status", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td><input type=\"submit\" value=\"提交\" ></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "h5pay.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 34,  75 => 32,  66 => 26,  50 => 15,  45 => 13,  36 => 7,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="easyui-tabs" style="width:500px;height:auto" id="login">*/
/*     <div title="伙购">*/
/*         <form method="post" action="{{ url('app/h5pay') }}" name="huogouForm">*/
/*             <table cellpadding="5">*/
/*                 <tr>*/
/*                     <input type="hidden" name="from" value="1" id="huogouFrom">*/
/*                     <td>伙购网</td>*/
/*                     <td>启用版本号:</td>*/
/*                     <td><input type="text" name="content[version]" value="{{ huogou.content.version}}"></td>*/
/*                     <td>是否启用:</td>*/
/*                     <td><input type="checkbox" name="status" value="1" {% if(huogou.status == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td><input type="submit" value="提交"></td>*/
/*                     <td></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*     </div>*/
/* */
/*     <div title="滴滴">*/
/*         <form method="post" action="{{ url('app/h5pay') }}?from=2" name="diForm">*/
/*             <table cellpadding="5">*/
/*                 <tr>*/
/*                     <input type="hidden" name="from" value="2" id="didiFrom">*/
/*                     <td>滴滴夺宝</td>*/
/*                     <td>启用版本号:</td>*/
/*                     <td><input type="text" name="content[version]" value="{{ didi.content.version}}"></td>*/
/*                     <td>是否启用:</td>*/
/*                     <td><input type="checkbox" name="status" value="1" {% if(didi.status == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td><input type="submit" value="提交" ></td>*/
/*                     <td></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
