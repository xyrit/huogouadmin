<?php

/* index.html */
class __TwigTemplate_4b35d0806e501f36dd79a5bfed9493021c6a054f6a27e8498b3f54feecfdacf0 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "index.html", 1);
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
        echo "    <div class=\"admin-content\">
        <div class=\"am-cf am-padding\">
            <div class=\"am-fl am-cf\">
                <strong class=\"am-text-primary am-text-lg\">";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["code"]) ? $context["code"] : null), "html", null, true);
        echo "</strong>
            </div>
        </div>

        <div class=\"am-g\">
            <div class=\"am-u-sm-12\">
                <h2 class=\"am-text-center am-text-xxxl am-margin-top-lg\">";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "</h2>
                <p class=\"am-text-center\">";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : null), "html", null, true);
        echo "</p>
                <pre class=\"page-404\">
          .----.
       _.'__    `.
   .--(\$)(\$\$)---/#\\
 .' @          /###\\
 :         ,   #####
  `-..__.-' _.-\\###/
        `;_:    `\"'
      .'\"\"\"\"\"`.
     /,  ya ,\\\\
    //  ";
        // line 25
        echo twig_escape_filter($this->env, (isset($context["code"]) ? $context["code"] : null), "html", null, true);
        echo "!  \\\\
    `-._______.-'
    ___`. | .'___
   (______|______)
                </pre>
            </div>
        </div>
    </div>
";
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
        return array (  63 => 25,  49 => 14,  45 => 13,  36 => 7,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/*     <div class="admin-content">*/
/*         <div class="am-cf am-padding">*/
/*             <div class="am-fl am-cf">*/
/*                 <strong class="am-text-primary am-text-lg">{{ code }}</strong>*/
/*             </div>*/
/*         </div>*/
/* */
/*         <div class="am-g">*/
/*             <div class="am-u-sm-12">*/
/*                 <h2 class="am-text-center am-text-xxxl am-margin-top-lg">{{ name }}</h2>*/
/*                 <p class="am-text-center">{{ message }}</p>*/
/*                 <pre class="page-404">*/
/*           .----.*/
/*        _.'__    `.*/
/*    .--($)($$)---/#\*/
/*  .' @          /###\*/
/*  :         ,   #####*/
/*   `-..__.-' _.-\###/*/
/*         `;_:    `"'*/
/*       .'"""""`.*/
/*      /,  ya ,\\*/
/*     //  {{ code }}!  \\*/
/*     `-._______.-'*/
/*     ___`. | .'___*/
/*    (______|______)*/
/*                 </pre>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
