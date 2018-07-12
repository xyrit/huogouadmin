<?php

/* indexPage.html */
class __TwigTemplate_3a451e6580c620c0c4e1e0daae9198943040deb40ba99724d6f38fb4f07c0b0d extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "indexPage.html", 1);
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

    // line 4
    public function block_main($context, array $blocks = array())
    {
        // line 5
        echo "
<!-- content start -->
<div class=\"admin-content\">

    <style>
        .admin-main {
            background: #f3f3f3;
        }

        .admin-content {
            width: auto;
            height: 100%;
            background: #fff;
        }

        .am-padding {
            padding: 1.6rem;
        }

        .am-g {
            margin: 0 auto;
            width: 100%;
        }

        .am-u-md-12 {
            width: 100%;
        }

        .am-panel-default {
            border-color: #ddd;
        }

        .am-panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 0;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            overflow: hidden;
        }

        .am-g .am-g {

            margin-right: -1.5rem;
        }

        .am-panel-default > .am-panel-hd {
            color: #444;
            background-color: #f5f5f5;
            border-color: #ddd;
            padding-left: 20px;
        }

        .am-u-sm-2 {
            height: 30px;
            padding-top: 25px;
            width: 16.66666667%;
            float: left;
        }

        .am-u-sm-4 {
            width: 33.33333333%;
        }
    </style>

    <div class=\"am-cf am-padding\">
        <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\">统计看板</strong></div>
    </div>

    <ul class=\"am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list \" style=\"display: none\">
        <li><a href=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "/order/all-order")), "html", null, true);
        echo "\" class=\"am-text-success\"><span
                class=\"am-icon-btn am-icon-file-text\"></span><br/>已支付<br/>";
        // line 77
        echo twig_escape_filter($this->env, (isset($context["consumeTotal"]) ? $context["consumeTotal"] : null), "html", null, true);
        echo "</a></li>
        <li><a href=\"";
        // line 78
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/deliver/index", array("status" => 3)), "html", null, true);
        echo "\" class=\"am-text-warning\"><span
                class=\"am-icon-btn am-icon-briefcase\"></span><br/>待发货<br/>";
        // line 79
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverCount"]) ? $context["deliverCount"] : null), "three", array()), "html", null, true);
        echo "</a></li>
        <li><a href=\"";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/order/index", array("status" => 7)), "html", null, true);
        echo "\" class=\"am-text-danger\"><span
                class=\"am-icon-btn am-icon-recycle\"></span><br/>需换货<br/>";
        // line 81
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverCount"]) ? $context["deliverCount"] : null), "four", array()), "html", null, true);
        echo "</a></li>
        <li><a href=\"#\" class=\"am-text-secondary\"><span class=\"am-icon-btn am-icon-user-md\"></span><br/><br/></a></li>
    </ul>

    <div class=\"am-g\">
        <div class=\"am-u-md-12\">
            <div class=\"am-panel am-panel-default\">
                <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-2'}\">财务数据<span
                        class=\"am-icon-chevron-down am-fr\"></span></div>
                <div class=\"am-g\">
                    <div class=\"am-u-sm-2\" id=\"incomeTotal\">总参与人次：<span><a
                            href=\"javascript:void(0);\"onclick=\"getValue('incomeTotal')\">点击查看</a></span></div>
                    <div class=\"am-u-sm-2\" id=\"moneyTotal\">总充值金额：<span><a href=\"javascript:void(0);\"
                                                                          onclick=\"getValue('moneyTotal')\">点击查看</a></span></div>
                    <div class=\"am-u-sm-2\">账号总余额：";
        // line 95
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "balance", array()), "html", null, true);
        echo "元</div>
                    <div class=\"am-u-sm-2\">佣金余额：";
        // line 96
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "comm", array()), "html", null, true);
        echo "元</div>
                    <div class=\"am-u-sm-4\"></div>
                </div>
            </div>

            <div class=\"am-panel am-panel-default\">
                <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-2'}\">福分数据<span
                        class=\"am-icon-chevron-down am-fr\"></span></div>
                <div class=\"am-g\">
                    <div class=\"am-u-sm-2\">邀请福分：";
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "inviteTotal", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">资料福分：";
        // line 106
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "taskTotal", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">晒单福分：";
        // line 107
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["return"]) ? $context["return"] : null), "shareTotal", array()) - 5000), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">购买福分：";
        // line 108
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "comTotal", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\"></div>
                    <div class=\"am-u-sm-2\"></div>
                </div>
                <div class=\"am-g\">
                    <div class=\"am-u-sm-2\">抵扣福分：";
        // line 113
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "totalComsue", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">余额福分：";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "totalPoint", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">后台操作：";
        // line 115
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "modifyTotal", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-6\"></div>
                </div>
            </div>

            <div class=\"am-panel am-panel-default\">
                <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-2'}\">运营数据<span
                        class=\"am-icon-chevron-down am-fr\"></span></div>
                <div class=\"am-g\">
                    <div class=\"am-u-sm-2\">一级分类：";
        // line 124
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "cateTotal", array()), "html", null, true);
        echo "个</div>
                    <div class=\"am-u-sm-2\">品牌：";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "brandTotal", array()), "html", null, true);
        echo "个</div>
                    <div class=\"am-u-sm-2\">商品总数量：";
        // line 126
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "productTotal", array()), "html", null, true);
        echo "个</div>
                    <div class=\"am-u-sm-2\">在售数量：";
        // line 127
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "onlineTotal", array()), "html", null, true);
        echo "个</div>
                    <div class=\"am-u-sm-2\">会员数量：";
        // line 128
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "userTotal", array()), "html", null, true);
        echo "个</div>
                    <div class=\"am-u-sm-2\"></div>
                </div>
            </div>

            <div class=\"am-panel am-panel-default\">
                <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-2'}\">今日数据<span
                        class=\"am-icon-chevron-down am-fr\"></span></div>
                <div class=\"am-g\">
                    <div class=\"am-u-sm-2\">今日新增会员：";
        // line 137
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "toadyTotal", array()), "html", null, true);
        echo "个</div>
                    <div class=\"am-u-sm-2\" id=\"todayIncomeTotal\">今日收入：<span><a
                            href=\"javascript:void(0);\"onclick=\"getValue('todayIncomeTotal')\">点击查看</a></span></div>
                    <div class=\"am-u-sm-2\" id=\"rechargeTotal\">今日充值：<span><a
                            href=\"javascript:void(0);\"onclick=\"getValue('rechargeTotal')\">点击查看</a></span></div>
                    <div class=\"am-u-sm-2\">今日开奖：";
        // line 142
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "luckyTotal", array()), "html", null, true);
        echo "次</div>
                    <div class=\"am-u-sm-2\">今日发货：";
        // line 143
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["return"]) ? $context["return"] : null), "deliverTotal", array()), "html", null, true);
        echo "次</div>
                    <div class=\"am-u-sm-2\"></div>
                </div>
            </div>

            <div class=\"am-panel am-panel-default\">
                <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-2'}\">进行中订单状态统计<span
                        class=\"am-icon-chevron-down am-fr\"></span></div>
                <div class=\"am-g\">
                    <div class=\"am-u-sm-2\">已中奖：";
        // line 152
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "one", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">待确认：";
        // line 153
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "two", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">待备货：";
        // line 154
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "three", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">待发货：";
        // line 155
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "four", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">待收货：";
        // line 156
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "five", array()), "html", null, true);
        echo "</div>
                    <div class=\"am-u-sm-2\">异常订单：";
        // line 157
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "seven", array()), "html", null, true);
        echo "</div>
                </div>
            </div>

            <div class=\"am-panel am-panel-default\">
                <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-2'}\">热销伙购商品<span
                        class=\"am-icon-chevron-down am-fr\"></span></div>
                <div class=\"am-g\">
                    <table class=\"am-u-sm-12\">
                        <tbody>
                        ";
        // line 167
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["hotProductList"]) ? $context["hotProductList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 168
            echo "                        <tr>
                            <td class=\"am-u-sm-1\"></td>
                            <td class=\"am-u-sm-7\">";
            // line 170
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "product_id", array()), "html", null, true);
            echo "</td>
                            <td class=\"am-u-sm-4\">";
            // line 171
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "period_number", array()), "html", null, true);
            echo "期</td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 174
        echo "                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content end -->
<script>
    function getValue(s) {
        \$.get('";
        // line 184
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("default/index-page"), "html", null, true);
        echo "', {'is_ajax': s}, function (data) {
            if (data.error == 0) {
                \$(\"#\"+s+\" span\").html(data.msg);
            } else {
                \$.messager.alert('失败', data.msg, 'error');
            }
        })
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "indexPage.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  315 => 184,  303 => 174,  294 => 171,  290 => 170,  286 => 168,  282 => 167,  269 => 157,  265 => 156,  261 => 155,  257 => 154,  253 => 153,  249 => 152,  237 => 143,  233 => 142,  225 => 137,  213 => 128,  209 => 127,  205 => 126,  201 => 125,  197 => 124,  185 => 115,  181 => 114,  177 => 113,  169 => 108,  165 => 107,  161 => 106,  157 => 105,  145 => 96,  141 => 95,  124 => 81,  120 => 80,  116 => 79,  112 => 78,  108 => 77,  104 => 76,  31 => 5,  28 => 4,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* */
/* {% block main %}*/
/* */
/* <!-- content start -->*/
/* <div class="admin-content">*/
/* */
/*     <style>*/
/*         .admin-main {*/
/*             background: #f3f3f3;*/
/*         }*/
/* */
/*         .admin-content {*/
/*             width: auto;*/
/*             height: 100%;*/
/*             background: #fff;*/
/*         }*/
/* */
/*         .am-padding {*/
/*             padding: 1.6rem;*/
/*         }*/
/* */
/*         .am-g {*/
/*             margin: 0 auto;*/
/*             width: 100%;*/
/*         }*/
/* */
/*         .am-u-md-12 {*/
/*             width: 100%;*/
/*         }*/
/* */
/*         .am-panel-default {*/
/*             border-color: #ddd;*/
/*         }*/
/* */
/*         .am-panel {*/
/*             margin-bottom: 20px;*/
/*             background-color: #fff;*/
/*             border: 1px solid transparent;*/
/*             border-radius: 0;*/
/*             -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);*/
/*             box-shadow: 0 1px 1px rgba(0, 0, 0, .05);*/
/*             overflow: hidden;*/
/*         }*/
/* */
/*         .am-g .am-g {*/
/* */
/*             margin-right: -1.5rem;*/
/*         }*/
/* */
/*         .am-panel-default > .am-panel-hd {*/
/*             color: #444;*/
/*             background-color: #f5f5f5;*/
/*             border-color: #ddd;*/
/*             padding-left: 20px;*/
/*         }*/
/* */
/*         .am-u-sm-2 {*/
/*             height: 30px;*/
/*             padding-top: 25px;*/
/*             width: 16.66666667%;*/
/*             float: left;*/
/*         }*/
/* */
/*         .am-u-sm-4 {*/
/*             width: 33.33333333%;*/
/*         }*/
/*     </style>*/
/* */
/*     <div class="am-cf am-padding">*/
/*         <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">统计看板</strong></div>*/
/*     </div>*/
/* */
/*     <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list " style="display: none">*/
/*         <li><a href="{{ url(['/order/all-order']) }}" class="am-text-success"><span*/
/*                 class="am-icon-btn am-icon-file-text"></span><br/>已支付<br/>{{ consumeTotal }}</a></li>*/
/*         <li><a href="{{ url('/deliver/index', {'status':3}) }}" class="am-text-warning"><span*/
/*                 class="am-icon-btn am-icon-briefcase"></span><br/>待发货<br/>{{ deliverCount.three }}</a></li>*/
/*         <li><a href="{{ url('/order/index', {'status':7}) }}" class="am-text-danger"><span*/
/*                 class="am-icon-btn am-icon-recycle"></span><br/>需换货<br/>{{ deliverCount.four }}</a></li>*/
/*         <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/><br/></a></li>*/
/*     </ul>*/
/* */
/*     <div class="am-g">*/
/*         <div class="am-u-md-12">*/
/*             <div class="am-panel am-panel-default">*/
/*                 <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">财务数据<span*/
/*                         class="am-icon-chevron-down am-fr"></span></div>*/
/*                 <div class="am-g">*/
/*                     <div class="am-u-sm-2" id="incomeTotal">总参与人次：<span><a*/
/*                             href="javascript:void(0);"onclick="getValue('incomeTotal')">点击查看</a></span></div>*/
/*                     <div class="am-u-sm-2" id="moneyTotal">总充值金额：<span><a href="javascript:void(0);"*/
/*                                                                           onclick="getValue('moneyTotal')">点击查看</a></span></div>*/
/*                     <div class="am-u-sm-2">账号总余额：{{ return.balance }}元</div>*/
/*                     <div class="am-u-sm-2">佣金余额：{{ return.comm }}元</div>*/
/*                     <div class="am-u-sm-4"></div>*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="am-panel am-panel-default">*/
/*                 <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">福分数据<span*/
/*                         class="am-icon-chevron-down am-fr"></span></div>*/
/*                 <div class="am-g">*/
/*                     <div class="am-u-sm-2">邀请福分：{{ return.inviteTotal }}</div>*/
/*                     <div class="am-u-sm-2">资料福分：{{ return.taskTotal }}</div>*/
/*                     <div class="am-u-sm-2">晒单福分：{{ return.shareTotal-5000 }}</div>*/
/*                     <div class="am-u-sm-2">购买福分：{{ return.comTotal }}</div>*/
/*                     <div class="am-u-sm-2"></div>*/
/*                     <div class="am-u-sm-2"></div>*/
/*                 </div>*/
/*                 <div class="am-g">*/
/*                     <div class="am-u-sm-2">抵扣福分：{{ return.totalComsue }}</div>*/
/*                     <div class="am-u-sm-2">余额福分：{{ return.totalPoint }}</div>*/
/*                     <div class="am-u-sm-2">后台操作：{{ return.modifyTotal }}</div>*/
/*                     <div class="am-u-sm-6"></div>*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="am-panel am-panel-default">*/
/*                 <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">运营数据<span*/
/*                         class="am-icon-chevron-down am-fr"></span></div>*/
/*                 <div class="am-g">*/
/*                     <div class="am-u-sm-2">一级分类：{{ return.cateTotal }}个</div>*/
/*                     <div class="am-u-sm-2">品牌：{{ return.brandTotal }}个</div>*/
/*                     <div class="am-u-sm-2">商品总数量：{{ return.productTotal }}个</div>*/
/*                     <div class="am-u-sm-2">在售数量：{{ return.onlineTotal }}个</div>*/
/*                     <div class="am-u-sm-2">会员数量：{{ return.userTotal }}个</div>*/
/*                     <div class="am-u-sm-2"></div>*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="am-panel am-panel-default">*/
/*                 <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">今日数据<span*/
/*                         class="am-icon-chevron-down am-fr"></span></div>*/
/*                 <div class="am-g">*/
/*                     <div class="am-u-sm-2">今日新增会员：{{ return.toadyTotal }}个</div>*/
/*                     <div class="am-u-sm-2" id="todayIncomeTotal">今日收入：<span><a*/
/*                             href="javascript:void(0);"onclick="getValue('todayIncomeTotal')">点击查看</a></span></div>*/
/*                     <div class="am-u-sm-2" id="rechargeTotal">今日充值：<span><a*/
/*                             href="javascript:void(0);"onclick="getValue('rechargeTotal')">点击查看</a></span></div>*/
/*                     <div class="am-u-sm-2">今日开奖：{{ return.luckyTotal }}次</div>*/
/*                     <div class="am-u-sm-2">今日发货：{{ return.deliverTotal }}次</div>*/
/*                     <div class="am-u-sm-2"></div>*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="am-panel am-panel-default">*/
/*                 <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">进行中订单状态统计<span*/
/*                         class="am-icon-chevron-down am-fr"></span></div>*/
/*                 <div class="am-g">*/
/*                     <div class="am-u-sm-2">已中奖：{{ order.one }}</div>*/
/*                     <div class="am-u-sm-2">待确认：{{ order.two }}</div>*/
/*                     <div class="am-u-sm-2">待备货：{{ order.three }}</div>*/
/*                     <div class="am-u-sm-2">待发货：{{ order.four }}</div>*/
/*                     <div class="am-u-sm-2">待收货：{{ order.five }}</div>*/
/*                     <div class="am-u-sm-2">异常订单：{{ order.seven }}</div>*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="am-panel am-panel-default">*/
/*                 <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">热销伙购商品<span*/
/*                         class="am-icon-chevron-down am-fr"></span></div>*/
/*                 <div class="am-g">*/
/*                     <table class="am-u-sm-12">*/
/*                         <tbody>*/
/*                         {% for item in hotProductList %}*/
/*                         <tr>*/
/*                             <td class="am-u-sm-1"></td>*/
/*                             <td class="am-u-sm-7">{{ item.product_id }}</td>*/
/*                             <td class="am-u-sm-4">{{ item.period_number }}期</td>*/
/*                         </tr>*/
/*                         {% endfor %}*/
/*                         </tbody>*/
/*                     </table>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!-- content end -->*/
/* <script>*/
/*     function getValue(s) {*/
/*         $.get('{{ url("default/index-page") }}', {'is_ajax': s}, function (data) {*/
/*             if (data.error == 0) {*/
/*                 $("#"+s+" span").html(data.msg);*/
/*             } else {*/
/*                 $.messager.alert('失败', data.msg, 'error');*/
/*             }*/
/*         })*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
