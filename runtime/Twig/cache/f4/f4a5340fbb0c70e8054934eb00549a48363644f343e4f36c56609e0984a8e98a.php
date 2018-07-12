<?php

/* view.html */
class __TwigTemplate_1923ce10ea096901e0a4b177aea6732dcf3ce948500e0f0cc9afd62df35349df extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "view.html", 1);
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
        echo "<div class=\"easyui-tabs\" style=\"padding:10px;height: 750px;\" id=\"view_tabs\">
    <div title=\"签到任务\" style=\"padding:10px;\" >
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"sign_iframe\"></iframe>
    </div>
    <div title=\"新手任务\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"new_iframe\"></iframe>
    </div>
    <div title=\"日常任务\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"daily_iframe\"></iframe>
    </div>
    <div title=\"成长任务\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"grow_iframe\"></iframe>
    </div>
</div>
";
    }

    // line 20
    public function block_js($context, array $blocks = array())
    {
        // line 21
        echo "<script type=\"text/javascript\">
    \$('#view_tabs').tabs({
        onSelect: function(title, index){
            switch (title) {
                case '签到任务':
                    \$('#sign_iframe').prop('src', \"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/list", array("type" => 1)), "html", null, true);
        echo "\");
                    break;
                case '新手任务':
                    \$('#new_iframe').prop('src', \"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/list", array("type" => 2)), "html", null, true);
        echo "\");
                    break;
                case '日常任务':
                    \$('#daily_iframe').prop('src', \"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/list", array("type" => 3)), "html", null, true);
        echo "\");
                    break;
                case '成长任务':
                    \$('#grow_iframe').prop('src', \"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/list", array("type" => 4)), "html", null, true);
        echo "\");
                    break;
            }
        }
    });
    \$('#sign_iframe').prop('src', \"";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/list", array("type" => 1)), "html", null, true);
        echo "\");
    \$('#view_tabs').tabs('select', 0);
</script>
";
    }

    public function getTemplateName()
    {
        return "view.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 40,  78 => 35,  72 => 32,  66 => 29,  60 => 26,  53 => 21,  50 => 20,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="easyui-tabs" style="padding:10px;height: 750px;" id="view_tabs">*/
/*     <div title="签到任务" style="padding:10px;" >*/
/*         <iframe width="100%" height="100%" frameborder="0" id="sign_iframe"></iframe>*/
/*     </div>*/
/*     <div title="新手任务" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="new_iframe"></iframe>*/
/*     </div>*/
/*     <div title="日常任务" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="daily_iframe"></iframe>*/
/*     </div>*/
/*     <div title="成长任务" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="grow_iframe"></iframe>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     $('#view_tabs').tabs({*/
/*         onSelect: function(title, index){*/
/*             switch (title) {*/
/*                 case '签到任务':*/
/*                     $('#sign_iframe').prop('src', "{{ url('user-task/list', {'type': 1}) }}");*/
/*                     break;*/
/*                 case '新手任务':*/
/*                     $('#new_iframe').prop('src', "{{ url('user-task/list', {'type': 2}) }}");*/
/*                     break;*/
/*                 case '日常任务':*/
/*                     $('#daily_iframe').prop('src', "{{ url('user-task/list', {'type': 3}) }}");*/
/*                     break;*/
/*                 case '成长任务':*/
/*                     $('#grow_iframe').prop('src', "{{ url('user-task/list', {'type': 4}) }}");*/
/*                     break;*/
/*             }*/
/*         }*/
/*     });*/
/*     $('#sign_iframe').prop('src', "{{ url('user-task/list', {'type': 1}) }}");*/
/*     $('#view_tabs').tabs('select', 0);*/
/* </script>*/
/* {% endblock %}*/
