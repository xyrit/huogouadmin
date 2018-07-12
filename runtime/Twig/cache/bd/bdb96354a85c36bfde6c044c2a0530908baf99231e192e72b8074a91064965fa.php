<?php

/* index.html */
class __TwigTemplate_564880bb5b66c6b02ffb20e08607d374da315a324ae8fd71f47b7ff0eeabcfe1 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head lang=\"en\">
    <meta charset=\"UTF-8\">
    <title>";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "name", array()), "html", null, true);
        echo "</title>
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no\">
    <meta name=\"format-detection\" content=\"telephone=no\">
    <meta name=\"renderer\" content=\"webkit\">
    <meta http-equiv=\"Cache-Control\" content=\"no-siteapp\"/>
    <link rel=\"alternate icon\" type=\"image/png\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "getAlias", array(0 => "skinUrl"), "method"), "html", null, true);
        echo "/img/favicon.png\">
    <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "getAlias", array(0 => "skinUrl"), "method"), "html", null, true);
        echo "/css/amazeui.min.css\"/>
    <style>
        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }

        .header p {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class=\"header\">
        <div class=\"am-g\">
            <h1>";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "name", array()), "html", null, true);
        echo "</h1>
            <p>深圳首页网络科技有限公司</p>
        </div>
        <hr/>
    </div>
    <div class=\"am-g\">
        <div class=\"am-u-lg-3 am-u-md-8 am-u-sm-centered\">
            ";
        // line 41
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form")), "method");
        echo "
                <div class=\"am-form-group\">
                    ";
        // line 43
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "username"), "method");
        echo "
                    ";
        // line 44
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeTextInput", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "username", 2 => array("placeholder" => "输入用户名")), "method");
        echo "
                    ";
        // line 45
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "username", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
                </div>
                <div class=\"am-form-group\">
                    ";
        // line 48
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "password"), "method");
        echo "
                    ";
        // line 49
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activePasswordInput", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "password", 2 => array("placeholder" => "输入密码")), "method");
        echo "
                    ";
        // line 50
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "password", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
                </div>
                <div class=\"am-form-group\">
                    ";
        // line 53
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeCheckbox", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "rememberMe"), "method");
        echo "
                </div>
            <div class=\"am-form-group\">
                <input type=\"button\" class=\"fsyzm\" value=\"发送验证码\">
                <input type=\"text\" name=\"yzm\" class=\"yzm\" placeholder=\"填写验证码\">
            </div>
            <div class=\"am-cf\">
                    ";
        // line 60
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "submitButton", array(0 => "登 录", 1 => array("class" => "am-btn am-btn-primary am-btn-sm am-fl")), "method");
        echo "
                </div>

            ";
        // line 63
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
        </div>
        ";
        // line 65
        echo twig_escape_filter($this->env, (isset($context["linkpage"]) ? $context["linkpage"] : null), "html", null, true);
        echo "
    </div>
    <script type=\"text/javascript\" src=\"http://libs.baidu.com/jquery/1.9.1/jquery.min.js\"></script>
    <script>
        \$('.fsyzm').click(function () {

            var account = \$('#loginform-username').val();
            \$.ajax({
                type: 'get',
                url: 'code',
                data: {
                    account: account
                },
                dataType: 'json',
                success: function (data) {
                    alert(data['info'])
                }
            });

        })
    </script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 65,  122 => 63,  116 => 60,  106 => 53,  100 => 50,  96 => 49,  92 => 48,  86 => 45,  82 => 44,  78 => 43,  73 => 41,  63 => 34,  38 => 12,  34 => 11,  25 => 5,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head lang="en">*/
/*     <meta charset="UTF-8">*/
/*     <title>{{ app.name }}</title>*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">*/
/*     <meta name="format-detection" content="telephone=no">*/
/*     <meta name="renderer" content="webkit">*/
/*     <meta http-equiv="Cache-Control" content="no-siteapp"/>*/
/*     <link rel="alternate icon" type="image/png" href="{{ app.getAlias('skinUrl') }}/img/favicon.png">*/
/*     <link rel="stylesheet" href="{{ app.getAlias('skinUrl') }}/css/amazeui.min.css"/>*/
/*     <style>*/
/*         .header {*/
/*             text-align: center;*/
/*         }*/
/* */
/*         .header h1 {*/
/*             font-size: 200%;*/
/*             color: #333;*/
/*             margin-top: 30px;*/
/*         }*/
/* */
/*         .header p {*/
/*             font-size: 14px;*/
/*         }*/
/*     </style>*/
/* </head>*/
/* */
/* <body>*/
/* */
/*     <div class="header">*/
/*         <div class="am-g">*/
/*             <h1>{{ app.name }}</h1>*/
/*             <p>深圳首页网络科技有限公司</p>*/
/*         </div>*/
/*         <hr/>*/
/*     </div>*/
/*     <div class="am-g">*/
/*         <div class="am-u-lg-3 am-u-md-8 am-u-sm-centered">*/
/*             {{ html.beginForm('', 'post', {'class':'am-form'})|raw }}*/
/*                 <div class="am-form-group">*/
/*                     {{ html.activeLabel(model, 'username')|raw }}*/
/*                     {{ html.activeTextInput(model, 'username', {'placeholder':'输入用户名'})|raw }}*/
/*                     {{ html.error(model, 'username', {'class':'am-alert am-alert-danger'})|raw }}*/
/*                 </div>*/
/*                 <div class="am-form-group">*/
/*                     {{ html.activeLabel(model, 'password')|raw }}*/
/*                     {{ html.activePasswordInput(model, 'password', {'placeholder':'输入密码'})|raw }}*/
/*                     {{ html.error(model, 'password', {'class':'am-alert am-alert-danger'})|raw }}*/
/*                 </div>*/
/*                 <div class="am-form-group">*/
/*                     {{ html.activeCheckbox(model, 'rememberMe')|raw }}*/
/*                 </div>*/
/*             <div class="am-form-group">*/
/*                 <input type="button" class="fsyzm" value="发送验证码">*/
/*                 <input type="text" name="yzm" class="yzm" placeholder="填写验证码">*/
/*             </div>*/
/*             <div class="am-cf">*/
/*                     {{ html.submitButton('登 录', {'class':'am-btn am-btn-primary am-btn-sm am-fl'})|raw }}*/
/*                 </div>*/
/* */
/*             {{ html.endForm()|raw }}*/
/*         </div>*/
/*         {{ linkpage }}*/
/*     </div>*/
/*     <script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>*/
/*     <script>*/
/*         $('.fsyzm').click(function () {*/
/* */
/*             var account = $('#loginform-username').val();*/
/*             $.ajax({*/
/*                 type: 'get',*/
/*                 url: 'code',*/
/*                 data: {*/
/*                     account: account*/
/*                 },*/
/*                 dataType: 'json',*/
/*                 success: function (data) {*/
/*                     alert(data['info'])*/
/*                 }*/
/*             });*/
/* */
/*         })*/
/*     </script>*/
/* </body>*/
/* </html>*/
