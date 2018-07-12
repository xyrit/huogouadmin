<?php

/* edit.html */
class __TwigTemplate_5d38331b5da717bc5de697bc396754fd7c453ec7ef6c114508003729dc5e3ced extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "edit.html", 1);
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
        echo "  <!-- content start -->
  <div class=\"admin-content\">

    <div class=\"am-cf am-padding\">
      <div class=\"am-fl am-cf\">
        <strong class=\"am-text-primary am-text-lg\">编辑通知模板</strong>
      </div>
    </div>

    <div class=\"am-g\">

      <div class=\"am-u-sm-12\">
        ";
        // line 16
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "order-manage-group-form")), "method");
        echo "

        <div class=\"am-form-group\">
          ";
        // line 19
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "desc", 2 => array("class" => "am-u-sm-2 am-form-label")), "method");
        echo "
          <div class=\"am-u-sm-10\">
            ";
        // line 21
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeTextInput", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "desc"), "method");
        echo "
            ";
        // line 22
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "desc", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
          </div>
        </div>
        <div class=\"am-form-group\">
          ";
        // line 26
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "notice_way", 2 => array("class" => "am-u-sm-2 am-form-label")), "method");
        echo "
          <div class=\"am-u-sm-10\">
            ";
        // line 28
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeCheckboxList", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "notice_way", 2 => array("1" => "短信", "2" => "邮件", "3" => "站内信", "4" => "微信", "5" => "APP")), "method");
        echo "
            ";
        // line 29
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "notice_way", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
          </div>
        </div>
        <div class=\"am-form-group\">
          ";
        // line 33
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "status", 2 => array("class" => "am-u-sm-2 am-form-label")), "method");
        echo "
          <div class=\"am-u-sm-10\">
            ";
        // line 35
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeRadioList", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "status", 2 => array("1" => "启用", "0" => "停用")), "method");
        echo "
            ";
        // line 36
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "status", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
          </div>
        </div>
        <div class=\"am-form-group\">
          ";
        // line 40
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "sms_content", 2 => array("class" => "am-u-sm-2 am-form-label")), "method");
        echo "
          <div class=\"am-u-sm-10\">
            ";
        // line 42
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeTextarea", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "sms_content"), "method");
        echo "
            ";
        // line 43
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "sms_content", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
          </div>
        </div>
        <div class=\"am-form-group\">
          ";
        // line 47
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "email_content", 2 => array("class" => "am-u-sm-2 am-form-label")), "method");
        echo "
          <div class=\"am-u-sm-10\">
            ";
        // line 49
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeTextarea", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "email_content"), "method");
        echo "
            ";
        // line 50
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "email_content", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
          </div>
        </div>
        <div class=\"am-form-group\">
          ";
        // line 54
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "sysmsg_content", 2 => array("class" => "am-u-sm-2 am-form-label")), "method");
        echo "
          <div class=\"am-u-sm-10\">
            ";
        // line 56
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeTextarea", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "sysmsg_content"), "method");
        echo "
            ";
        // line 57
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "sysmsg_content", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
          </div>
        </div>
        <div class=\"am-form-group\">
          ";
        // line 61
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "wechat_content", 2 => array("class" => "am-u-sm-2 am-form-label")), "method");
        echo "
          <div class=\"am-u-sm-10\">
            ";
        // line 63
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeTextarea", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "wechat_content"), "method");
        echo "
            ";
        // line 64
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "wechat_content", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
          </div>
        </div>
        <div class=\"am-form-group\">
          ";
        // line 68
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeLabel", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "app_content", 2 => array("class" => "am-u-sm-2 am-form-label")), "method");
        echo "
          <div class=\"am-u-sm-10\">
            ";
        // line 70
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "activeTextarea", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "app_content"), "method");
        echo "
            ";
        // line 71
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "error", array(0 => (isset($context["model"]) ? $context["model"] : null), 1 => "app_content", 2 => array("class" => "am-alert am-alert-danger")), "method");
        echo "
          </div>
        </div>

        <div class=\"am-form-group\">
          <div class=\"am-u-sm-10 am-u-sm-push-2\">
            <button type=\"submit\" class=\"am-btn am-btn-primary\">保存</button>
            <a href=\"";
        // line 78
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "notice/params")), "html", null, true);
        echo "\" target=\"_blank\">参数说明</a>
          </div>
        </div>
        ";
        // line 81
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "getFlash", array(0 => "success"), "method"), "html", null, true);
        echo "
        ";
        // line 82
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
      </div>

    </div>
  </div>
  <!-- content end -->

  <a href=\"#\" class=\"am-show-sm-only admin-menu\" data-am-offcanvas=\"{target: '#admin-offcanvas'}\">
    <span class=\"am-icon-btn am-icon-th-list\"></span>
  </a>

";
    }

    // line 95
    public function block_script($context, array $blocks = array())
    {
        // line 96
        echo "  <script>


  </script>
";
    }

    public function getTemplateName()
    {
        return "edit.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  212 => 96,  209 => 95,  193 => 82,  189 => 81,  183 => 78,  173 => 71,  169 => 70,  164 => 68,  157 => 64,  153 => 63,  148 => 61,  141 => 57,  137 => 56,  132 => 54,  125 => 50,  121 => 49,  116 => 47,  109 => 43,  105 => 42,  100 => 40,  93 => 36,  89 => 35,  84 => 33,  77 => 29,  73 => 28,  68 => 26,  61 => 22,  57 => 21,  52 => 19,  46 => 16,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/*   <!-- content start -->*/
/*   <div class="admin-content">*/
/* */
/*     <div class="am-cf am-padding">*/
/*       <div class="am-fl am-cf">*/
/*         <strong class="am-text-primary am-text-lg">编辑通知模板</strong>*/
/*       </div>*/
/*     </div>*/
/* */
/*     <div class="am-g">*/
/* */
/*       <div class="am-u-sm-12">*/
/*         {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'order-manage-group-form'}) | raw }}*/
/* */
/*         <div class="am-form-group">*/
/*           {{ html.activeLabel(model, 'desc', {'class':'am-u-sm-2 am-form-label'})|raw }}*/
/*           <div class="am-u-sm-10">*/
/*             {{ html.activeTextInput(model, 'desc')|raw }}*/
/*             {{ html.error(model, 'desc', {'class':'am-alert am-alert-danger'})|raw }}*/
/*           </div>*/
/*         </div>*/
/*         <div class="am-form-group">*/
/*           {{ html.activeLabel(model, 'notice_way', {'class':'am-u-sm-2 am-form-label'})|raw }}*/
/*           <div class="am-u-sm-10">*/
/*             {{ html.activeCheckboxList(model, 'notice_way', {'1':'短信', '2':'邮件', '3':'站内信', '4':'微信', '5':'APP'})|raw }}*/
/*             {{ html.error(model, 'notice_way', {'class':'am-alert am-alert-danger'})|raw }}*/
/*           </div>*/
/*         </div>*/
/*         <div class="am-form-group">*/
/*           {{ html.activeLabel(model, 'status', {'class':'am-u-sm-2 am-form-label'})|raw }}*/
/*           <div class="am-u-sm-10">*/
/*             {{ html.activeRadioList(model, 'status', {'1':'启用', '0':'停用'})|raw }}*/
/*             {{ html.error(model, 'status', {'class':'am-alert am-alert-danger'})|raw }}*/
/*           </div>*/
/*         </div>*/
/*         <div class="am-form-group">*/
/*           {{ html.activeLabel(model, 'sms_content', {'class':'am-u-sm-2 am-form-label'})|raw }}*/
/*           <div class="am-u-sm-10">*/
/*             {{ html.activeTextarea(model, 'sms_content')|raw }}*/
/*             {{ html.error(model, 'sms_content', {'class':'am-alert am-alert-danger'})|raw }}*/
/*           </div>*/
/*         </div>*/
/*         <div class="am-form-group">*/
/*           {{ html.activeLabel(model, 'email_content', {'class':'am-u-sm-2 am-form-label'})|raw }}*/
/*           <div class="am-u-sm-10">*/
/*             {{ html.activeTextarea(model, 'email_content')|raw }}*/
/*             {{ html.error(model, 'email_content', {'class':'am-alert am-alert-danger'})|raw }}*/
/*           </div>*/
/*         </div>*/
/*         <div class="am-form-group">*/
/*           {{ html.activeLabel(model, 'sysmsg_content', {'class':'am-u-sm-2 am-form-label'})|raw }}*/
/*           <div class="am-u-sm-10">*/
/*             {{ html.activeTextarea(model, 'sysmsg_content')|raw }}*/
/*             {{ html.error(model, 'sysmsg_content', {'class':'am-alert am-alert-danger'})|raw }}*/
/*           </div>*/
/*         </div>*/
/*         <div class="am-form-group">*/
/*           {{ html.activeLabel(model, 'wechat_content', {'class':'am-u-sm-2 am-form-label'})|raw }}*/
/*           <div class="am-u-sm-10">*/
/*             {{ html.activeTextarea(model, 'wechat_content')|raw }}*/
/*             {{ html.error(model, 'wechat_content', {'class':'am-alert am-alert-danger'})|raw }}*/
/*           </div>*/
/*         </div>*/
/*         <div class="am-form-group">*/
/*           {{ html.activeLabel(model, 'app_content', {'class':'am-u-sm-2 am-form-label'})|raw }}*/
/*           <div class="am-u-sm-10">*/
/*             {{ html.activeTextarea(model, 'app_content')|raw }}*/
/*             {{ html.error(model, 'app_content', {'class':'am-alert am-alert-danger'})|raw }}*/
/*           </div>*/
/*         </div>*/
/* */
/*         <div class="am-form-group">*/
/*           <div class="am-u-sm-10 am-u-sm-push-2">*/
/*             <button type="submit" class="am-btn am-btn-primary">保存</button>*/
/*             <a href="{{ url(['notice/params']) }}" target="_blank">参数说明</a>*/
/*           </div>*/
/*         </div>*/
/*         {{ app.session.getFlash('success') }}*/
/*         {{ html.endForm() | raw }}*/
/*       </div>*/
/* */
/*     </div>*/
/*   </div>*/
/*   <!-- content end -->*/
/* */
/*   <a href="#" class="am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}">*/
/*     <span class="am-icon-btn am-icon-th-list"></span>*/
/*   </a>*/
/* */
/* {% endblock %}*/
/* */
/* {% block script %}*/
/*   <script>*/
/* */
/* */
/*   </script>*/
/* {% endblock %}*/
