<?php

/* login.html */
class __TwigTemplate_245ff25eef6e972c2f5eb102053f1f56b22f75e39f02b978d5aec01706d450a1 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "login.html", 1);
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
        echo "<div class=\"easyui-tabs\" style=\"width:500px;height:auto;float: left;\" >
    <span>伙购网</span>
    <div title=\"android\" style=\"padding:10px\">
        <form method=\"post\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/login"), "html", null, true);
        echo "\">
            <table cellpadding=\"5\">
                <input type=\"hidden\" name=\"id\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "id", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"system\" value=\"android\">
                <input type=\"hidden\" name=\"from\" value=\"1\">
                <tr>
                    <td>QQ:</td>
                    <td><input type=\"checkbox\" name=\"content[login_qq]\" value=\"1\" ";
        // line 14
        if (($this->getAttribute($this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "content", array()), "login_qq", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>微信:</td>
                    <td><input type=\"checkbox\" name=\"content[login_wechat]\" value=\"1\" ";
        // line 18
        if (($this->getAttribute($this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "content", array()), "login_wechat", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td><input type=\"hidden\" name=\"system\" value=\"android\"><input type=\"submit\" value=\"提交\"></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>
    <div title=\"ios\" style=\"padding:10px\">
        <form method=\"post\" action=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/login"), "html", null, true);
        echo "\">
            <table cellpadding=\"5\">
                <input type=\"hidden\" name=\"id\" value=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "id", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"system\" value=\"ios\">
                <input type=\"hidden\" name=\"from\" value=\"1\">
                <tr>
                    <td>QQ:</td>
                    <td><input type=\"checkbox\" name=\"content[login_qq]\" value=\"1\" ";
        // line 35
        if (($this->getAttribute($this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "content", array()), "login_qq", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>微信:</td>
                    <td><input type=\"checkbox\" name=\"content[login_wechat]\" value=\"1\" ";
        // line 39
        if (($this->getAttribute($this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "content", array()), "login_wechat", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>屏蔽版本</td>
                    <td><input type=\"text\" name=\"content[version]\" value=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "content", array()), "version", array()), "html", null, true);
        echo "\" id=\"version\"></td>
                </tr>
                <tr>
                    <td><input type=\"hidden\" name=\"system\" value=\"ios\"><input type=\"submit\" value=\"提交\"></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>
</div>


<div class=\"easyui-tabs\" style=\"width:500px;height:auto;float: left;margin-left: 10px;\" >
    <span>滴滴夺宝</span>
    <div title=\"android\" style=\"padding:10px\">
        <form method=\"post\" action=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/login"), "html", null, true);
        echo "\">
            <table cellpadding=\"5\">
                <input type=\"hidden\" name=\"id\" value=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "id", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"system\" value=\"android\">
                <input type=\"hidden\" name=\"from\" value=\"2\">
                <tr>
                    <td>QQ:</td>
                    <td><input type=\"checkbox\" name=\"content[login_qq]\" value=\"1\" ";
        // line 65
        if (($this->getAttribute($this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "content", array()), "login_qq", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>微信:</td>
                    <td><input type=\"checkbox\" name=\"content[login_wechat]\" value=\"1\" ";
        // line 69
        if (($this->getAttribute($this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "content", array()), "login_wechat", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td><input type=\"hidden\" name=\"system\" value=\"android\"><input type=\"submit\" value=\"提交\"></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>
    <div title=\"ios\" style=\"padding:10px\">
        <form method=\"post\" action=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/login"), "html", null, true);
        echo "\">
            <table cellpadding=\"5\">
                <input type=\"hidden\" name=\"id\" value=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "id", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"system\" value=\"ios\">
                <input type=\"hidden\" name=\"from\" value=\"2\">
                <tr>
                    <td>QQ:</td>
                    <td><input type=\"checkbox\" name=\"content[login_qq]\" value=\"1\" ";
        // line 86
        if (($this->getAttribute($this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "content", array()), "login_qq", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>微信:</td>
                    <td><input type=\"checkbox\" name=\"content[login_wechat]\" value=\"1\" ";
        // line 90
        if (($this->getAttribute($this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "content", array()), "login_wechat", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>屏蔽版本</td>
                    <td><input type=\"text\" name=\"content[version]\" value=\"";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "content", array()), "version", array()), "html", null, true);
        echo "\" id=\"version\"></td>
                </tr>
                <tr>
                    <td><input type=\"hidden\" name=\"system\" value=\"ios\"><input type=\"submit\" value=\"提交\"></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>
</div>
";
    }

    // line 106
    public function block_js($context, array $blocks = array())
    {
        // line 107
        echo "<script>

</script>
";
    }

    public function getTemplateName()
    {
        return "login.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  209 => 107,  206 => 106,  191 => 94,  182 => 90,  173 => 86,  165 => 81,  160 => 79,  145 => 69,  136 => 65,  128 => 60,  123 => 58,  105 => 43,  96 => 39,  87 => 35,  79 => 30,  74 => 28,  59 => 18,  50 => 14,  42 => 9,  37 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="easyui-tabs" style="width:500px;height:auto;float: left;" >*/
/*     <span>伙购网</span>*/
/*     <div title="android" style="padding:10px">*/
/*         <form method="post" action="{{ url('app/login') }}">*/
/*             <table cellpadding="5">*/
/*                 <input type="hidden" name="id" value="{{huogouAndroidModel.id}}">*/
/*                 <input type="hidden" name="system" value="android">*/
/*                 <input type="hidden" name="from" value="1">*/
/*                 <tr>*/
/*                     <td>QQ:</td>*/
/*                     <td><input type="checkbox" name="content[login_qq]" value="1" {% if(huogouAndroidModel.content.login_qq == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>微信:</td>*/
/*                     <td><input type="checkbox" name="content[login_wechat]" value="1" {% if(huogouAndroidModel.content.login_wechat == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td><input type="hidden" name="system" value="android"><input type="submit" value="提交"></td>*/
/*                     <td></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*     </div>*/
/*     <div title="ios" style="padding:10px">*/
/*         <form method="post" action="{{ url('app/login') }}">*/
/*             <table cellpadding="5">*/
/*                 <input type="hidden" name="id" value="{{huogouIosModel.id}}">*/
/*                 <input type="hidden" name="system" value="ios">*/
/*                 <input type="hidden" name="from" value="1">*/
/*                 <tr>*/
/*                     <td>QQ:</td>*/
/*                     <td><input type="checkbox" name="content[login_qq]" value="1" {% if(huogouIosModel.content.login_qq == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>微信:</td>*/
/*                     <td><input type="checkbox" name="content[login_wechat]" value="1" {% if(huogouIosModel.content.login_wechat == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>屏蔽版本</td>*/
/*                     <td><input type="text" name="content[version]" value="{{ huogouIosModel.content.version }}" id="version"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td><input type="hidden" name="system" value="ios"><input type="submit" value="提交"></td>*/
/*                     <td></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*     </div>*/
/* </div>*/
/* */
/* */
/* <div class="easyui-tabs" style="width:500px;height:auto;float: left;margin-left: 10px;" >*/
/*     <span>滴滴夺宝</span>*/
/*     <div title="android" style="padding:10px">*/
/*         <form method="post" action="{{ url('app/login') }}">*/
/*             <table cellpadding="5">*/
/*                 <input type="hidden" name="id" value="{{didiAndroidModel.id}}">*/
/*                 <input type="hidden" name="system" value="android">*/
/*                 <input type="hidden" name="from" value="2">*/
/*                 <tr>*/
/*                     <td>QQ:</td>*/
/*                     <td><input type="checkbox" name="content[login_qq]" value="1" {% if(didiAndroidModel.content.login_qq == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>微信:</td>*/
/*                     <td><input type="checkbox" name="content[login_wechat]" value="1" {% if(didiAndroidModel.content.login_wechat == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td><input type="hidden" name="system" value="android"><input type="submit" value="提交"></td>*/
/*                     <td></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*     </div>*/
/*     <div title="ios" style="padding:10px">*/
/*         <form method="post" action="{{ url('app/login') }}">*/
/*             <table cellpadding="5">*/
/*                 <input type="hidden" name="id" value="{{didiIosModel.id}}">*/
/*                 <input type="hidden" name="system" value="ios">*/
/*                 <input type="hidden" name="from" value="2">*/
/*                 <tr>*/
/*                     <td>QQ:</td>*/
/*                     <td><input type="checkbox" name="content[login_qq]" value="1" {% if(didiIosModel.content.login_qq == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>微信:</td>*/
/*                     <td><input type="checkbox" name="content[login_wechat]" value="1" {% if(didiIosModel.content.login_wechat == 1) %}checked{% endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>屏蔽版本</td>*/
/*                     <td><input type="text" name="content[version]" value="{{ didiIosModel.content.version }}" id="version"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td><input type="hidden" name="system" value="ios"><input type="submit" value="提交"></td>*/
/*                     <td></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/* */
/* </script>*/
/* {% endblock %}*/
