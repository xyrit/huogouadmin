<?php

/* @app/views/base.html */
class __TwigTemplate_edde12643a0964330055c35e4792feb35e15699d19ff9ab724a7163413bf1f84 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'css' => array($this, 'block_css'),
            'main' => array($this, 'block_main'),
            'js' => array($this, 'block_js'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"language\" content=\"zh_cn\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\" />
    <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/themes/gray/easyui.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/themes/icon.css\">
    ";
        // line 11
        $this->displayBlock('css', $context, $blocks);
        // line 18
        echo "</head>

<body>

";
        // line 22
        $this->displayBlock('main', $context, $blocks);
        // line 23
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/jquery.min.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/jquery.easyui.min.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/common.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/combotree.js\" type=\"text/javascript\"></script>

";
        // line 29
        $this->displayBlock('js', $context, $blocks);
        // line 30
        $this->displayBlock('script', $context, $blocks);
        // line 31
        echo "</body>
</html>";
    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
    }

    // line 11
    public function block_css($context, array $blocks = array())
    {
        // line 12
        echo "    <!--<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/css/default.css\">-->
    <style>
        .search {margin-bottom: 5px;padding: 5px;height: auto;border: 1px solid gainsboro;}
        .search span {margin-right: 5px;}
    </style>
    ";
    }

    // line 22
    public function block_main($context, array $blocks = array())
    {
    }

    // line 29
    public function block_js($context, array $blocks = array())
    {
    }

    // line 30
    public function block_script($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "@app/views/base.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 30,  110 => 29,  105 => 22,  94 => 12,  91 => 11,  86 => 7,  81 => 31,  79 => 30,  77 => 29,  72 => 27,  68 => 26,  64 => 25,  60 => 24,  55 => 23,  53 => 22,  47 => 18,  45 => 11,  41 => 10,  37 => 9,  32 => 7,  24 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">*/
/* <head>*/
/*     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />*/
/*     <meta name="language" content="zh_cn" />*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=Edge" />*/
/*     <title>{% block title %}{% endblock %}</title>*/
/* */
/*     <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/gray/easyui.css">*/
/*     <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/icon.css">*/
/*     {% block css %}*/
/*     <!--<link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/css/default.css">-->*/
/*     <style>*/
/*         .search {margin-bottom: 5px;padding: 5px;height: auto;border: 1px solid gainsboro;}*/
/*         .search span {margin-right: 5px;}*/
/*     </style>*/
/*     {% endblock %}*/
/* </head>*/
/* */
/* <body>*/
/* */
/* {% block main %}{% endblock %}*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.easyui.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/common.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/combotree.js" type="text/javascript"></script>*/
/* */
/* {% block js %}{% endblock %}*/
/* {% block script %}{% endblock %}*/
/* </body>*/
/* </html>*/
