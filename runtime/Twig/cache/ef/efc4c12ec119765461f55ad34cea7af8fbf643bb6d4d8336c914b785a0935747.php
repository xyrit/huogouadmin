<?php

/* view.html */
class __TwigTemplate_f75b583df1c41f659852656740a90f62fe593438bff54f27127a1adda12f2385 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "view.html", 1);
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
        echo "<style type=\"text/css\">
    td {
        padding-left: 20px
    }
</style>
<table cellpadding=\"5\">
    <tr>
        <td>会员ID：";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()), "html", null, true);
        echo "</td>
        <td>消费总额：￥";
        // line 12
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "totalPayment", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "totalPayment", array()), 0)) : (0)), "html", null, true);
        echo "</td>
        <td>个人主页-伙购记录：";
        // line 13
        if ($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "id", array())) {
            if (($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "ucenter_buylist", array()) == 1)) {
                echo "全部 (";
                echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "buylist_number", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "buylist_number", array()), "所有")) : ("所有")), "html", null, true);
                // line 14
                echo ")";
            } elseif (($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "ucenter_buylist", array()) == 2)) {
                echo "好友可见";
            } else {
                echo "自己可见";
            }
        } else {
            echo "全部";
        }
        // line 15
        echo "        </td>
    </tr>
    <tr>
        <td>用户名：";
        // line 18
        if (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array()) && $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array()))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array()), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array()), "html", null, true);
        } else {
            echo twig_escape_filter($this->env, (($this->getAttribute(            // line 19
(isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array()), $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array()))) : ($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array()))), "html", null, true);
        }
        // line 20
        echo "        </td>
        <td>账户总额：￥";
        // line 21
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "money", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "money", array()), 0)) : (0)), "html", null, true);
        echo "</td>
        <td>个人主页-获得商品：";
        // line 22
        if ($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "id", array())) {
            if (($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "ucenter_orderlist", array()) == 1)) {
                echo "全部 (";
                echo twig_escape_filter($this->env, (($this->getAttribute(                // line 23
(isset($context["limit"]) ? $context["limit"] : null), "orderlist_number", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "orderlist_number", array()), "所有")) : ("所有")), "html", null, true);
                echo ")";
            } elseif (($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "ucenter_orderlist", array()) == 2)) {
                echo "好友可见";
            } else {
                echo "自己可见";
            }
        } else {
            // line 24
            echo "全部";
        }
        // line 25
        echo "        </td>
    </tr>
    <tr>
        <td>昵称：";
        // line 28
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "nickname", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "nickname", array()), "空")) : ("空")), "html", null, true);
        echo "</td>
        <td>转出总额：￥";
        // line 29
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "outTotal", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "outTotal", array()), 0)) : (0)), "html", null, true);
        echo "</td>
        <td>个人主页-晒单记录：";
        // line 30
        if ($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "id", array())) {
            if (($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "ucenter_sharelist", array()) == 1)) {
                echo "全部 (";
                echo twig_escape_filter($this->env, (($this->getAttribute(                // line 31
(isset($context["limit"]) ? $context["limit"] : null), "sharelist_number", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "sharelist_number", array()), "所有")) : ("所有")), "html", null, true);
                echo ")";
            } elseif (($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "ucenter_sharelist", array()) == 2)) {
                echo "好友可见";
            } else {
                echo "自己可见";
            }
        } else {
            // line 32
            echo "全部";
        }
        // line 33
        echo "        </td>
    </tr>
    <tr>
        <td>性别：";
        // line 36
        if (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "sex", array()) == 1)) {
            echo "男";
        } elseif (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "sex", array()) == 2)) {
            echo "女";
        } else {
            echo "保密";
        }
        echo "</td>
        <td>转入总额：￥";
        // line 37
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "inTotal", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "inTotal", array()), 0)) : (0)), "html", null, true);
        echo "</td>
        <td>个性签名：";
        // line 38
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "intro", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "intro", array()), "空")) : ("空")), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td>经验：";
        // line 41
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "experience", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "experience", array()), 0)) : (0)), "html", null, true);
        echo "</td>
        <td>佣金余额：￥";
        // line 42
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "commission", array()) / twig_number_format_filter($this->env, 100, 2)), "html", null, true);
        echo "</td>
        <td>好友搜索：";
        // line 43
        if ((($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "friend_search", array()) == 1) || (null === $this->getAttribute($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "limit", array()), "id", array())))) {
            echo "允许";
        } else {
            echo "禁止";
        }
        echo "</td>
    </tr>
    <tr>
        <td>邀请人：";
        // line 46
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "invite", array()), "html", null, true);
        echo "</td>
        <td>福分：";
        // line 47
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "point", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "point", array()), 0)) : (0)), "html", null, true);
        echo "</td>
        <td>私信：";
        // line 48
        if ((($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "private_letter", array()) == 2) || (null === $this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "id", array())))) {
            echo "仅限好友";
        } else {
            echo "禁止";
        }
        echo "</td>
    </tr>
    <tr>
        <td>手机：";
        // line 51
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array()), "空")) : ("空")), "html", null, true);
        echo "</td>
        <td>地理位置：";
        // line 52
        if ((($this->getAttribute((isset($context["limit"]) ? $context["limit"] : null), "position", array()) == 1) || (null === $this->getAttribute($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "limit", array()), "id", array())))) {
            echo "允许";
        } else {
            echo "禁止";
        }
        echo "</td>
        <td>接收系统消息：";
        // line 53
        if (((null === $this->getAttribute((isset($context["notice"]) ? $context["notice"] : null), "id", array())) || ($this->getAttribute((isset($context["notice"]) ? $context["notice"] : null), "receive_sysinfo", array()) == 1))) {
            echo "允许";
        } else {
            echo "禁止";
        }
        echo "</td>
    </tr>
    <tr>
        <td>QQ号：";
        // line 56
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "qq", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "qq", array()), "空")) : ("空")), "html", null, true);
        echo "</td>
        <td>注册时间：";
        // line 57
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "created_at", array()), "Y-m-d H:i:s"), "html", null, true);
        echo "</td>
        <td>接收微信或邮件消息：";
        // line 58
        if (((null === $this->getAttribute((isset($context["notice"]) ? $context["notice"] : null), "id", array())) || ($this->getAttribute((isset($context["notice"]) ? $context["notice"] : null), "receive_wchat", array()) == 1))) {
            echo "允许";
        } else {
            echo "禁止";
        }
        echo "</td>
    </tr>
    <tr>
        <td>微信昵称：";
        // line 61
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "wx", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "wx", array()), "空")) : ("空")), "html", null, true);
        echo "</td>
        <td>注册IP：";
        // line 62
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "reg_ip", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "reg_ip", array()), "空")) : ("空")), "html", null, true);
        echo "</td>
        <td>首次充值：￥";
        // line 63
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "firstRecharge", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "firstRecharge", array()), 0)) : (0)), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td>邮箱：";
        // line 66
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array()), "空")) : ("空")), "html", null, true);
        echo "</td>
        <td>最后登录时间：";
        // line 67
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "updated_at", array()), "Y-m-d H:i:s"), "html", null, true);
        echo "</td>
        <td>截至当前累计充值：￥";
        // line 68
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "totalRecharge", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "totalRecharge", array()), 0)) : (0)), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td>现居住地：";
        // line 71
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "live_city", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "live_city", array()), "空")) : ("空")), "html", null, true);
        echo "</td>
        <td>最后登录IP：";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "last_login_ip", array()), "html", null, true);
        echo "</td>
        <td>截至当前累计消费：￥";
        // line 73
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "totalPayment", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "totalPayment", array()), 0)) : (0)), "html", null, true);
        echo "</td>
    </tr>
</table>
<div class=\"easyui-tabs\" style=\"padding:10px;height: 400px;\" id=\"view_tabs\">
    <div title=\"伙购记录\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"90%\" frameborder=\"0\" id=\"buylist_iframe\"></iframe>
    </div>
    <div title=\"中奖记录\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"winning_iframe\"></iframe>
    </div>
    <div title=\"晒单记录\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"share_iframe\"></iframe>
    </div>
    <div title=\"账户明细\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"money_iframe\"></iframe>
    </div>
    <div title=\"佣金明细\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"commission_iframe\"></iframe>
    </div>
    <div title=\"福分明细\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"point_iframe\"></iframe>
    </div>
    <div title=\"邀请列表\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"invite_iframe\"></iframe>
    </div>
    <div title=\"好友列表\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"friend_iframe\"></iframe>
    </div>
    <div title=\"收货地址\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"address_iframe\"></iframe>
    </div>
    <div title=\"圈子\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"group_iframe\"></iframe>
    </div>
    <div title=\"话题\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"topic_iframe\"></iframe>
    </div>
    <div title=\"消息\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"message_iframe\"></iframe>
    </div>
</div>
";
    }

    // line 116
    public function block_script($context, array $blocks = array())
    {
        // line 117
        echo "<script type=\"text/javascript\">
    \$('#view_tabs').tabs({
        onSelect: function (title, index) {
            switch (title) {
                case '伙购记录':
                    \$('#buylist_iframe').prop('src', \"";
        // line 122
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/buy", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '中奖记录':
                    \$('#winning_iframe').prop('src', \"";
        // line 125
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/winning", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '晒单记录':
                    \$('#share_iframe').prop('src', \"";
        // line 128
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/share", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '账户明细':
                    \$('#money_iframe').prop('src', \"";
        // line 131
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/money", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '佣金明细':
                    \$('#commission_iframe').prop('src', \"";
        // line 134
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/commission", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '福分明细':
                    \$('#point_iframe').prop('src', \"";
        // line 137
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/point", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '邀请列表':
                    \$('#invite_iframe').prop('src', \"";
        // line 140
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/invite", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '好友列表':
                    \$('#friend_iframe').prop('src', \"";
        // line 143
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/friend", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '收货地址':
                    \$('#address_iframe').prop('src', \"";
        // line 146
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/address", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '圈子':
                    \$('#group_iframe').prop('src', \"";
        // line 149
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/group", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '话题':
                    \$('#topic_iframe').prop('src', \"";
        // line 152
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/topic", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
                case '消息':
                    \$('#message_iframe').prop('src', \"";
        // line 155
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/message", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
        echo "\");
                    break;
            }
        }
    });
    \$('#buylist_iframe').prop('src', \"";
        // line 160
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/buy", array("id" => $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "id", array()))), "html", null, true);
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
        return array (  397 => 160,  389 => 155,  383 => 152,  377 => 149,  371 => 146,  365 => 143,  359 => 140,  353 => 137,  347 => 134,  341 => 131,  335 => 128,  329 => 125,  323 => 122,  316 => 117,  313 => 116,  267 => 73,  263 => 72,  259 => 71,  253 => 68,  249 => 67,  245 => 66,  239 => 63,  235 => 62,  231 => 61,  221 => 58,  217 => 57,  213 => 56,  203 => 53,  195 => 52,  191 => 51,  181 => 48,  177 => 47,  173 => 46,  163 => 43,  159 => 42,  155 => 41,  149 => 38,  145 => 37,  135 => 36,  130 => 33,  127 => 32,  118 => 31,  114 => 30,  110 => 29,  106 => 28,  101 => 25,  98 => 24,  89 => 23,  85 => 22,  81 => 21,  78 => 20,  75 => 19,  69 => 18,  64 => 15,  54 => 14,  49 => 13,  45 => 12,  41 => 11,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style type="text/css">*/
/*     td {*/
/*         padding-left: 20px*/
/*     }*/
/* </style>*/
/* <table cellpadding="5">*/
/*     <tr>*/
/*         <td>会员ID：{{ userInfo.id }}</td>*/
/*         <td>消费总额：￥{{ userInfo.totalPayment|default(0) }}</td>*/
/*         <td>个人主页-伙购记录：{% if(limit.id) %}{% if(limit.ucenter_buylist == 1) %}全部 ({{ limit.buylist_number|default('所有')*/
/*             }}){% elseif(limit.ucenter_buylist == 2) %}好友可见{% else %}自己可见{% endif %}{% else %}全部{% endif %}*/
/*         </td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>用户名：{% if userInfo.email and userInfo.phone %}{{ userInfo.phone }} {{ userInfo.email }}{% else %}{{*/
/*             userInfo.phone|default(userInfo.email) }}{% endif %}*/
/*         </td>*/
/*         <td>账户总额：￥{{ userInfo.money|default(0) }}</td>*/
/*         <td>个人主页-获得商品：{% if(limit.id) %}{% if(limit.ucenter_orderlist == 1) %}全部 ({{*/
/*             limit.orderlist_number|default('所有') }}){% elseif(limit.ucenter_orderlist == 2) %}好友可见{% else %}自己可见{% endif*/
/*             %}{% else %}全部{% endif %}*/
/*         </td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>昵称：{{ userInfo.nickname|default('空') }}</td>*/
/*         <td>转出总额：￥{{ userInfo.outTotal|default(0) }}</td>*/
/*         <td>个人主页-晒单记录：{% if(limit.id) %}{% if(limit.ucenter_sharelist == 1) %}全部 ({{*/
/*             limit.sharelist_number|default('所有') }}){% elseif(limit.ucenter_sharelist == 2) %}好友可见{% else %}自己可见{% endif*/
/*             %}{% else %}全部{% endif %}*/
/*         </td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>性别：{% if userInfo.sex == 1 %}男{% elseif userInfo.sex == 2 %}女{% else %}保密{% endif %}</td>*/
/*         <td>转入总额：￥{{ userInfo.inTotal|default(0) }}</td>*/
/*         <td>个性签名：{{ userInfo.intro|default('空') }}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>经验：{{ userInfo.experience|default(0) }}</td>*/
/*         <td>佣金余额：￥{{ userInfo.commission / 100|number_format(2) }}</td>*/
/*         <td>好友搜索：{% if(limit.friend_search == 1 or userInfo.limit.id is null) %}允许{% else %}禁止{% endif %}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>邀请人：{{ userInfo.invite }}</td>*/
/*         <td>福分：{{ userInfo.point|default(0) }}</td>*/
/*         <td>私信：{% if(limit.private_letter == 2 or limit.id is null) %}仅限好友{% else %}禁止{% endif %}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>手机：{{ userInfo.phone|default('空') }}</td>*/
/*         <td>地理位置：{% if(limit.position == 1 or userInfo.limit.id is null) %}允许{% else %}禁止{% endif %}</td>*/
/*         <td>接收系统消息：{% if(notice.id is null or notice.receive_sysinfo == 1) %}允许{% else %}禁止{% endif %}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>QQ号：{{ userInfo.qq|default('空') }}</td>*/
/*         <td>注册时间：{{ userInfo.created_at|date('Y-m-d H:i:s') }}</td>*/
/*         <td>接收微信或邮件消息：{% if(notice.id is null or notice.receive_wchat == 1) %}允许{% else %}禁止{% endif %}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>微信昵称：{{ userInfo.wx|default('空') }}</td>*/
/*         <td>注册IP：{{ userInfo.reg_ip|default('空') }}</td>*/
/*         <td>首次充值：￥{{ userInfo.firstRecharge|default(0) }}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>邮箱：{{ userInfo.email|default('空') }}</td>*/
/*         <td>最后登录时间：{{ userInfo.updated_at|date('Y-m-d H:i:s') }}</td>*/
/*         <td>截至当前累计充值：￥{{ userInfo.totalRecharge|default(0) }}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>现居住地：{{ userInfo.live_city|default('空') }}</td>*/
/*         <td>最后登录IP：{{ userInfo.last_login_ip }}</td>*/
/*         <td>截至当前累计消费：￥{{ userInfo.totalPayment|default(0) }}</td>*/
/*     </tr>*/
/* </table>*/
/* <div class="easyui-tabs" style="padding:10px;height: 400px;" id="view_tabs">*/
/*     <div title="伙购记录" style="padding:10px;">*/
/*         <iframe width="100%" height="90%" frameborder="0" id="buylist_iframe"></iframe>*/
/*     </div>*/
/*     <div title="中奖记录" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="winning_iframe"></iframe>*/
/*     </div>*/
/*     <div title="晒单记录" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="share_iframe"></iframe>*/
/*     </div>*/
/*     <div title="账户明细" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="money_iframe"></iframe>*/
/*     </div>*/
/*     <div title="佣金明细" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="commission_iframe"></iframe>*/
/*     </div>*/
/*     <div title="福分明细" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="point_iframe"></iframe>*/
/*     </div>*/
/*     <div title="邀请列表" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="invite_iframe"></iframe>*/
/*     </div>*/
/*     <div title="好友列表" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="friend_iframe"></iframe>*/
/*     </div>*/
/*     <div title="收货地址" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="address_iframe"></iframe>*/
/*     </div>*/
/*     <div title="圈子" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="group_iframe"></iframe>*/
/*     </div>*/
/*     <div title="话题" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="topic_iframe"></iframe>*/
/*     </div>*/
/*     <div title="消息" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="message_iframe"></iframe>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script type="text/javascript">*/
/*     $('#view_tabs').tabs({*/
/*         onSelect: function (title, index) {*/
/*             switch (title) {*/
/*                 case '伙购记录':*/
/*                     $('#buylist_iframe').prop('src', "{{ url('member/buy', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '中奖记录':*/
/*                     $('#winning_iframe').prop('src', "{{ url('member/winning', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '晒单记录':*/
/*                     $('#share_iframe').prop('src', "{{ url('member/share', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '账户明细':*/
/*                     $('#money_iframe').prop('src', "{{ url('member/money', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '佣金明细':*/
/*                     $('#commission_iframe').prop('src', "{{ url('member/commission', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '福分明细':*/
/*                     $('#point_iframe').prop('src', "{{ url('member/point', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '邀请列表':*/
/*                     $('#invite_iframe').prop('src', "{{ url('member/invite', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '好友列表':*/
/*                     $('#friend_iframe').prop('src', "{{ url('member/friend', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '收货地址':*/
/*                     $('#address_iframe').prop('src', "{{ url('member/address', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '圈子':*/
/*                     $('#group_iframe').prop('src', "{{ url('member/group', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '话题':*/
/*                     $('#topic_iframe').prop('src', "{{ url('member/topic', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*                 case '消息':*/
/*                     $('#message_iframe').prop('src', "{{ url('member/message', {'id': userInfo.id}) }}");*/
/*                     break;*/
/*             }*/
/*         }*/
/*     });*/
/*     $('#buylist_iframe').prop('src', "{{ url('member/buy', {'id': userInfo.id}) }}");*/
/*     $('#view_tabs').tabs('select', 0);*/
/* </script>*/
/* {% endblock %}*/
