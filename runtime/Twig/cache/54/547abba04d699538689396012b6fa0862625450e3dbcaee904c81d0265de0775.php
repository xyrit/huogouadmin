<?php

/* view.html */
class __TwigTemplate_d4db22a8417ce7e48044c7de0ec5a75ee54c984f42d292bb7ddb21893271363d extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "view.html", 1);
        $this->blocks = array(
            'css' => array($this, 'block_css'),
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
    public function block_css($context, array $blocks = array())
    {
        // line 4
        echo "<style>
    td {
        border: 1px solid #C1DAD7;
        background: #fff;
        font-size:11px;
        padding: 6px 6px 6px 12px;
        color: #4f6b72;
    }
    td label{background-color:#dddddd; width:100px;height: 35px; border-collapse: collapse;}
    td .alt {
        background: #F5FAFA;
        color: #797268;
    }
    .box span{font-size: 12px;padding: 6px 6px 6px 12px;color: #4f6b72;}
    .good{ border-collapse: collapse;}
    .panel-body div{ padding: 10px 0;}

</style>
";
    }

    // line 24
    public function block_main($context, array $blocks = array())
    {
        // line 25
        echo "<div title=\"Basic Window\"  style=\"padding:5px;height:auto\" class=\"box\">
    <div style=\"padding: 10px 0;\">
        <span>订单状态：";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["status"]) ? $context["status"] : null), "name", array()), "html", null, true);
        echo "</span><span>订单编号：";
        if ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "is_exchange", array())) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "is_exchange", array()), "html", null, true);
        } else {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        }
        echo "</span><span>伙购时间：";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["periodInfo"]) ? $context["periodInfo"] : null), "end_time", array()), "html", null, true);
        echo "</span><span>订单生成时间：";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "create_time", array()), "Y-m-d H:i:s"), "html", null, true);
        echo "</span>
    </div>

    <table class=\"good\">
        <tr>
            <td>商品图片</td>
            <td>商品名称</td>
            <td>商品编码</td>
            <td>商品品牌</td>
            <td>伙购价</td>
            <td>数量</td>
            <td>当前期号</td>
            <td>中奖来源</td>
            <td>购买次数</td>
            <td>所需金额</td>
            <td>福分抵扣</td>
            <td>红包抵扣</td>
            <td>实际购买金额</td>
        </tr>

        <tr>
            <td><img src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "picture", array()), "html", null, true);
        echo "\"></td>
            <td>";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "name", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 50
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "bn", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "brand_id", array()), "html", null, true);
        echo "</td>
            <td>￥";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "price", array()), "html", null, true);
        echo "</td>
            <td>1</td>
            <td>";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["periodInfo"]) ? $context["periodInfo"] : null), "period_no", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["periodTable"]) ? $context["periodTable"] : null), "source", array()), "name", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consume"]) ? $context["consume"] : null), "total", array()), "html", null, true);
        echo "次</td>
            <td>";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consume"]) ? $context["consume"] : null), "total", array()), "html", null, true);
        echo "元</td>
            <td>";
        // line 58
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["consume"]) ? $context["consume"] : null), "point", array()) / 100), "html", null, true);
        echo "元(";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consume"]) ? $context["consume"] : null), "point", array()), "html", null, true);
        echo "福分)</td>
            <td>";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consume"]) ? $context["consume"] : null), "red_packet", array()), "html", null, true);
        echo "元</td>
            <td>";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consume"]) ? $context["consume"] : null), "money", array()), "html", null, true);
        echo "元</td>
        </tr>
    </table>
    <table style=\"display: none\"  cellpadding=\"5\">
        <tr>
            <td><label>订单号：</label>";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "</td>
            <td>商品名称：";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "name", array()), "html", null, true);
        echo "</td>
            <td>状态：";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["status"]) ? $context["status"] : null), "name", array()), "html", null, true);
        echo "</td>
        </tr>

        <tr>
            <td>商品分类：";
        // line 71
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["catName"]) ? $context["catName"] : null), $this->getAttribute((isset($context["periodInfo"]) ? $context["periodInfo"] : null), "cat_id", array()), array(), "array"), "html", null, true);
        echo "</td>
            <td>发货方式：</td>
            <td>商品价格：￥";
        // line 73
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "price", array()), "html", null, true);
        echo "</td>
        </tr>

        <tr>
            <td>伙购码：";
        // line 77
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["periodInfo"]) ? $context["periodInfo"] : null), "lucky_code", array()), "html", null, true);
        echo "</td>
            <td>会员：";
        // line 78
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "user_id", array()), "username", array()), "html", null, true);
        echo "</td>
            <td>伙购时间：";
        // line 79
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["periodTable"]) ? $context["periodTable"] : null), "buy_time", array()), "html", null, true);
        echo "</td>
        </tr>

        <tr>
            <td>当期购买次数：";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consume"]) ? $context["consume"] : null), "total", array()), "html", null, true);
        echo "次</td>
            <td>实际购买金额：";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consume"]) ? $context["consume"] : null), "money", array()), "html", null, true);
        echo "元</td>
            <td>支付福分：";
        // line 85
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consume"]) ? $context["consume"] : null), "point", array()), "html", null, true);
        echo "</td>
        </tr>

        <tr>
            <td>来源：";
        // line 89
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["periodTable"]) ? $context["periodTable"] : null), "source", array()), "name", array()), "html", null, true);
        echo "</td>
            <td></td>
            <td></td>
        </tr>

    </table>
</div>

<div style=\"width:auto;height:auto;\">
    ";
        // line 98
        if (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) >= 0)) {
            // line 99
            echo "    <div title=\"收货地址\" style=\"padding:10px\" id=\"address\" class=\"easyui-dialog\" data-options=\"closed:true,modal:true\"  >
        <iframe id=\"address-info\" frameborder=\"0\" style=\"width: 500px;height: 300px;\" scrolling=\"no\"></iframe>
    </div>
    ";
        }
        // line 103
        echo "
    ";
        // line 104
        if (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) > 1)) {
            // line 105
            echo "    <div title=\"备货信息\" style=\"padding:10px\" class=\"easyui-dialog\" data-options=\"closed:true,modal:true\" id=\"deliver\">
        <iframe id=\"deliver-info\" frameborder=\"0\" style=\"width: 400px;height: 400px;\" scrolling=\"no\"></iframe>
    </div>
    ";
        }
        // line 109
        echo "
    ";
        // line 110
        if (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) > 2)) {
            // line 111
            echo "    <div title=\"发货信息\" style=\"padding:10px\" class=\"easyui-dialog\" data-options=\"closed:true,modal:true\" id=\"send\">
        <iframe id=\"send-info\" frameborder=\"0\" style=\"width: 400px;height: 300px;\"  scrolling=\"no\"></iframe>
    </div>
    ";
        }
        // line 115
        echo "
    <div title=\"备注\" style=\"padding: 10px;font-size: 13px;\">
        ";
        // line 117
        if ((isset($context["remarkArr"]) ? $context["remarkArr"] : null)) {
            // line 118
            echo "        <table class=\"good\">
            <tr>
                <td>备注内容</td>
                <td>备注人</td>
                <td>备注时间</td>
            </tr>
            ";
            // line 124
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["remarkArr"]) ? $context["remarkArr"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["remark"]) {
                // line 125
                echo "            <tr>
                <td>";
                // line 126
                echo twig_escape_filter($this->env, $this->getAttribute($context["remark"], "op_content", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 127
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["person"]) ? $context["person"] : null), $this->getAttribute($context["remark"], "op_user", array()), array(), "array"), "html", null, true);
                echo " </td>
                <td>";
                // line 128
                echo twig_escape_filter($this->env, $this->getAttribute($context["remark"], "op_time", array()), "html", null, true);
                echo "</td>
            </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['remark'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 131
            echo "        </table>
        ";
        }
        // line 133
        echo "


        ";
        // line 136
        if (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) == 6)) {
            echo "<br />异常备注：<br />
        <br />(1)管理员备注:&nbsp;";
            // line 137
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "fail_id", array()), "html", null, true);
            echo "<br />
        <br />(2)用户提交:<br /><br />
        <table class=\"good\">
            <tr>
                <td>用户手机号</td>
                <td>充值账号</td>
                <td>真实姓名</td>
                <td>充值类型</td>
                <td>添加时间</td>
                <td>更新时间</td>
            </tr>
            <tr>
                <td>";
            // line 149
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["unusual"]) ? $context["unusual"] : null), "phone", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 150
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["unusual"]) ? $context["unusual"] : null), "account", array()), "html", null, true);
            echo " </td>
                <td>";
            // line 151
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["unusual"]) ? $context["unusual"] : null), "name", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 152
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["unusual"]) ? $context["unusual"] : null), "type", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 153
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["unusual"]) ? $context["unusual"] : null), "created_at", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 154
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["unusual"]) ? $context["unusual"] : null), "updated_at", array()), "html", null, true);
            echo "</td>
            </tr>
        </table>
        ";
        }
        // line 158
        echo "    </div>
</div>
";
        // line 160
        if (($this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "delivery_id", array()) != 3)) {
            // line 161
            echo "    ";
            if ((((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) >= 1) && ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) != 6)) || (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "before_status", array()) >= 1) && ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "before_status", array()) != 10))) || (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) >= 0) && ($this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "delivery_id", array()) == 10)))) {
                // line 162
                echo "    <div class=\"easyui-tabs\" style=\"width:1000px;height:auto;font-size: 14px;\">
            <div title=\"收货地址\" style=\"padding:10px\">
                ";
                // line 164
                if ((isset($context["virtual"]) ? $context["virtual"] : null)) {
                    // line 165
                    echo "                <div>收货人：";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["virtual"]) ? $context["virtual"] : null), "account", array()), "html", null, true);
                    echo " | ";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["virtual"]) ? $context["virtual"] : null), "name", array()), "html", null, true);
                    echo "</div>
                <div>虚拟物品：";
                    // line 166
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["virtual"]) ? $context["virtual"] : null), "type", array()), "html", null, true);
                    echo "</div>
                ";
                } else {
                    // line 168
                    echo "                <div>收货人：";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "ship_name", array()), "html", null, true);
                    echo "</div>
                <div>联系方式：";
                    // line 169
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "ship_mobile", array()), "html", null, true);
                    echo "</div>
                <div>收货地址：";
                    // line 170
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "ship_area", array()), "html", null, true);
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "ship_addr", array()), "html", null, true);
                    echo "</div>
                <div>配送时间：";
                    // line 171
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "ship_time", array()), "html", null, true);
                    echo "</div>
                <div>备注信息：";
                    // line 172
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "mark_text", array()), "html", null, true);
                    echo "</div>
                ";
                }
                // line 174
                echo "                <div>提交时间：";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "confirm_addr_time", array()), "Y-m-d H:i:s"), "html", null, true);
                echo "</div>
                <br />
                ";
                // line 176
                if ($this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "third_order", array())) {
                    // line 177
                    echo "                <div>第三方订单号：";
                    echo $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "third_order", array());
                    echo "</div>
                ";
                }
                // line 179
                echo "                ";
                if (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) > 1)) {
                    // line 180
                    echo "                <div>确认人：";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["person"]) ? $context["person"] : null), $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "confirm_userid", array()), array(), "array"), "html", null, true);
                    echo "</div>
                <div>确认时间：";
                    // line 181
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "confirm_time", array()), "Y-m-d H:i:s"), "html", null, true);
                    echo "</div>
                ";
                }
                // line 183
                echo "            </div>

        ";
                // line 185
                if (((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) >= 3) && ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) != 6)) || (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "before_status", array()) >= 3) && ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "before_status", array()) != 10)))) {
                    // line 186
                    echo "            <div title=\"备货信息\" style=\"padding:10px\">
                <div>
                    <div>发货方式：";
                    // line 188
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "send", array()), "html", null, true);
                    echo "</div>
                    <div>备货平台：";
                    // line 189
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "platform", array()), "html", null, true);
                    echo "</div>
                    <div>成本：";
                    // line 190
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "price", array()), "html", null, true);
                    echo "</div>
                    <div>第三方订单号：";
                    // line 191
                    echo $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "third_order", array());
                    echo "</div>
                    <div>发票类型：";
                    // line 192
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "bill", array()), "html", null, true);
                    echo "</div>
                    <div>发票编号：";
                    // line 193
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "bill_num", array()), "html", null, true);
                    echo "</div>
                    <div>规格：";
                    // line 194
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "standard", array()), "html", null, true);
                    echo "</div>
                    <div>备注：";
                    // line 195
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "mark_text", array()), "html", null, true);
                    echo "</div>
                    <br />
                    <div>备货人：";
                    // line 197
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["person"]) ? $context["person"] : null), $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "prepare_userid", array()), array(), "array"), "html", null, true);
                    echo "</div>
                    <div>备货时间：";
                    // line 198
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "prepare_time", array()), "Y-m-d H:i:s"), "html", null, true);
                    echo "</div>
                </div>
            </div>
        ";
                }
                // line 202
                echo "
        ";
                // line 203
                if (((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) >= 4) && ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) != 6)) || (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "before_status", array()) >= 4) && ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "before_status", array()) != 10)))) {
                    // line 204
                    echo "        <div title=\"发货信息\" style=\"padding:10px\">
            <div>
                <div>快递公司：";
                    // line 206
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "deliver_company", array()), "html", null, true);
                    echo "</div>
                <div>快递订单号：";
                    // line 207
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "deliver_order", array()), "html", null, true);
                    echo "</div>
                <div>快递费用：";
                    // line 208
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "deliver_cost", array()), "html", null, true);
                    echo "</div>
                <br />
                <div>发货人：";
                    // line 210
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["person"]) ? $context["person"] : null), $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "prepare_userid", array()), array(), "array"), "html", null, true);
                    echo "</div>
                <div>发货时间：";
                    // line 211
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "deliver_time", array()), "Y-m-d H:i:s"), "html", null, true);
                    echo "</div>
            </div>
        </div>
        ";
                }
                // line 215
                echo "
        ";
                // line 216
                if (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) == 8)) {
                    // line 217
                    echo "        <div title=\"晒单信息\" style=\"padding:10px;font-size:14px;\">
            <table cellpadding=\"5\" style=\"border-collapse: collapse;\">
                <tr>
                    <td width=\"100\">晒单时间：</td><td>";
                    // line 220
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "created_at", array()), "Y-m-d H:i:s"), "html", null, true);
                    echo "</td>
                </tr>
                <tr>
                    <td>晒单图片：</td><td>";
                    // line 223
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["shareImg"]) ? $context["shareImg"] : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 224
                        echo "                    <img src=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "basename", array()), "html", null, true);
                        echo "\" width=\"200px\" height=\"200px\">
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 225
                    echo "</td>
                </tr>
                <tr>
                    <td>获奖感言：</td><td>";
                    // line 228
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "content", array()), "html", null, true);
                    echo "</td>
                </tr>
                <tr>
                    <td>奖励积分：</td><td>";
                    // line 231
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "point", array()), "html", null, true);
                    echo "</td>
                </tr>
                <tr>
                    <td>审核人：</td><td>";
                    // line 234
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["person"]) ? $context["person"] : null), $this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "admin_id", array()), array(), "array"), "html", null, true);
                    echo "</td>
                </tr>
                <tr>
                    <td>审核时间：</td><td>";
                    // line 237
                    if ($this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "checked_at", array())) {
                        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "checked_at", array()), "Y-m-d H:i:s"), "html", null, true);
                    }
                    echo "</td>
                </tr>
                <tr>
                    <td>状态：</td><td>";
                    // line 240
                    if (($this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "is_pass", array()) == 1)) {
                        echo "已通过";
                    } elseif (($this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "is_pass", array()) == 0)) {
                        echo "待审核";
                    } elseif (($this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "is_pass", array()) == 2)) {
                        echo "未通过";
                    }
                    echo "</td>
                </tr>
                <tr>
                    <td>推荐：</td><td>";
                    // line 243
                    if ($this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "is_recommend", array())) {
                        echo "是";
                    } else {
                        echo "否";
                    }
                    echo "  </td>
                </tr>
                <tr>
                    <td>精华：</td><td>";
                    // line 246
                    if ($this->getAttribute((isset($context["shareTopic"]) ? $context["shareTopic"] : null), "is_digest", array())) {
                        echo "是";
                    } else {
                        echo "否";
                    }
                    echo "</td>
                </tr>
            </table>
        </div>
        ";
                }
                // line 251
                echo "        ";
                if ((isset($context["exchange"]) ? $context["exchange"] : null)) {
                    // line 252
                    echo "        <div title=\"换货信息\" style=\"padding:10px\">
            <table cellpadding=\"10\" border=\"0\" cellspacing=\"1\">
                <tr>
                    <td>原单号</td><td>";
                    // line 255
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "id", array()), "html", null, true);
                    echo "</td>
                    <td>确认人</td><td>";
                    // line 256
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["person"]) ? $context["person"] : null), $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "confirm_userid", array()), array(), "array"), "html", null, true);
                    echo "</td>
                    <td>确认时间</td><td>";
                    // line 257
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "confirm_time", array()), "Y-m-d H:i:s"), "html", null, true);
                    echo "</td>
                </tr>
                <tr>
                    <td>发货方式</td><td>";
                    // line 260
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "send", array()), "html", null, true);
                    echo "</td>
                    <td>备货平台</td><td>";
                    // line 261
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "platform", array()), "html", null, true);
                    echo "</td>
                    <td>采购价格</td><td>";
                    // line 262
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "price", array()), "html", null, true);
                    echo "</td>
                </tr>
                <tr>
                    <td>第三方订单号</td><td>";
                    // line 265
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "third_order", array()), "html", null, true);
                    echo "</td>
                    <td>规格</td><td>";
                    // line 266
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "standard", array()), "html", null, true);
                    echo "</td>
                    <td>发票</td><td>";
                    // line 267
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "bill", array()), "html", null, true);
                    echo "</td>
                </tr>
                <tr>
                    <td>发票号</td><td>";
                    // line 270
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "bill_order", array()), "html", null, true);
                    echo "</td>
                    <td>备货人</td><td>";
                    // line 271
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["person"]) ? $context["person"] : null), $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "prepare_userid", array()), array(), "array"), "html", null, true);
                    echo "</td>
                    <td>备货时间</td><td>";
                    // line 272
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "prepare_time", array()), "Y-m-d H:i:s"), "html", null, true);
                    echo "</td>
                </tr>
                <tr>
                    <td>快递公司</td><td>";
                    // line 275
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "deliver_company", array()), "html", null, true);
                    echo "</td>
                    <td>快递单号</td><td>";
                    // line 276
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "deliver_order", array()), "html", null, true);
                    echo "</td>
                    <td>快递费</td><td>";
                    // line 277
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "deliver_cost", array()), "html", null, true);
                    echo "</td>
                </tr>
                <tr>
                    <td>发货人</td><td>";
                    // line 280
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["person"]) ? $context["person"] : null), $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "deliver_userid", array()), array(), "array"), "html", null, true);
                    echo "</td>
                    <td>发货时间</td><td>";
                    // line 281
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["exchange"]) ? $context["exchange"] : null), "deliver_time", array()), "Y-m-d H:i:s"), "html", null, true);
                    echo "</td>
                    <td></td><td></td>
                </tr>
                <tr>
                    <td>新单号</td><td>";
                    // line 285
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "id", array()), "html", null, true);
                    echo "</td>
                    <td>换货人</td><td>";
                    // line 286
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["person"]) ? $context["person"] : null), $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "admin_id", array()), array(), "array"), "html", null, true);
                    echo "</td>
                    <td>换货时间</td><td>";
                    // line 287
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["deliverInfo"]) ? $context["deliverInfo"] : null), "created_time", array()), "Y-m-d H:i:s"), "html", null, true);
                    echo "</td>
                </tr>
            </table>
        </div>
        ";
                }
                // line 292
                echo "    </div>
    ";
            }
        }
        // line 295
        echo "<br />

";
        // line 297
        if (($this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "delivery_id", array()) != 3)) {
            // line 298
            echo "   <!-- ";
            if ((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) == 0) && ($this->getAttribute((isset($context["priv"]) ? $context["priv"] : null), "address", array()) == 1))) {
                // line 299
                echo "    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\" id=\"address-show\">填写收货地址</a>
    ";
            }
            // line 300
            echo "-->
    ";
            // line 301
            if ((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) == 2) && ($this->getAttribute((isset($context["priv"]) ? $context["priv"] : null), "deliver", array()) == 1))) {
                // line 302
                echo "    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\" id=\"deliver-show\">备货</a>
    ";
            }
            // line 304
            echo "    ";
            if ((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) == 3) && ($this->getAttribute((isset($context["priv"]) ? $context["priv"] : null), "send", array()) == 1))) {
                // line 305
                if (($this->getAttribute((isset($context["priv"]) ? $context["priv"] : null), "buyback", array()) == 0)) {
                    // line 306
                    echo "    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\" id=\"send-show\">发货</a>
";
                }
                // line 308
                echo "    ";
            }
            // line 309
            echo "
    ";
            // line 310
            if (((((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) > 0) && ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) < 3)) && ($this->getAttribute((isset($context["priv"]) ? $context["priv"] : null), "confirm", array()) == 1)) && ($this->getAttribute((isset($context["priv"]) ? $context["priv"] : null), "refuse", array()) == 1)) || (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) >= 0) && ($this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "delivery_id", array()) == 10)))) {
                // line 311
                echo "        ";
                if (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) == 1)) {
                    // line 312
                    echo "            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\" id=\"comfirm\">确认</a>
        ";
                }
                // line 314
                echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\" onclick=\"refuse()\">驳回</a>
    ";
            }
            // line 316
            echo "
    ";
            // line 317
            if (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) == 4)) {
                // line 318
                echo "        ";
                if ((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "is_exchange", array()) == 0) && ($this->getAttribute((isset($context["priv"]) ? $context["priv"] : null), "exchange", array()) == 1))) {
                    // line 319
                    echo "            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\" onclick=\"change()\">申请换货</a>
        ";
                }
                // line 321
                echo "    ";
            }
            // line 322
            echo "
    ";
            // line 323
            if ((((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) >= 3) && ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) != 6)) && ($this->getAttribute((isset($context["priv"]) ? $context["priv"] : null), "modify", array()) == 1)) && ($this->getAttribute((isset($context["priv"]) ? $context["priv"] : null), "buyback", array()) != 1))) {
                // line 324
                echo "    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\" onclick=\"editOrder()\">修改订单</a>
    ";
            }
        }
        // line 327
        echo "<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"javascript:\$('#dlg-remark').window('open');;\">添加备注</a>

<div id=\"dlg-buttons-remark\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"saveRemark()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-remark').dialog('close')\">取消</a>
</div>

<div id=\"dlg-refuse\" title=\"驳回理由\" class=\"easyui-dialog\" style=\"width:320px;height:auto;padding:10px 20px\" data-options=\"closed:true,modal:true\" buttons=\"#dlg-buttons-add\">
    <textarea data-options=\"required:true\" class=\"easyui-textarea\" rows=\"6\" cols=\"34\" id=\"fail\"></textarea>
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-refuse').dialog('close')\">取消</a>
</div>

<div class=\"easyui-window\" data-options=\"closed:true,modal:true\" id=\"change\" title=\"申请换货\" style=\"text-align:center;padding:15px 5px 5px 5px;width:200px;height: 100px;\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"change()\">通过</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#change').dialog('close')\">取消</a>
</div>

<div class=\"easyui-window\" data-options=\"closed:true,\" id=\"orderInfo\" title=\"修改订单信息\">
    <iframe id=\"order-info\" frameborder=\"0\" style=\"width: 670px;height: 400px;\" scrolling=\"no\"></iframe>
</div>

<div id=\"dlg-remark\" title=\"添加备注\" class=\"easyui-dialog\" style=\"width:320px;height:auto;padding:10px 20px\" closed=\"true\" buttons=\"#dlg-buttons-remark\">
    <textarea data-options=\"required:true\" class=\"easyui-textarea\" rows=\"10\" cols=\"34\" id=\"remark\"></textarea>
</div>

<div class=\"easyui-window\" data-options=\"closed:true,\" id=\"dlg-view\" title=\"兑换\">
    <iframe id=\"duiba\" frameborder=\"0\" style=\"width: 670px;height: 400px;\" scrolling=\"no\"></iframe>
</div>
";
    }

    // line 361
    public function block_script($context, array $blocks = array())
    {
        // line 362
        echo "<script>
    var status = \"";
        // line 363
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()), "html", null, true);
        echo "\";
    var id = \"";
        // line 364
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "\";
    var exchange = \"";
        // line 365
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "is_exchange", array()), "html", null, true);
        echo "\";

    \$('#address-show').click(function(){
        \$('#address-info').prop('src',  '/win/address?id=' + id);
        \$('#address').window('open');
    })

    \$('#deliver-show').click(function(){
        if(exchange != 0) \$('#deliver-info').prop('src',  '/win/deliver?id=' + id + '&exchange='+exchange);
        else \$('#deliver-info').prop('src',  '/win/deliver?id=' + id);
        \$('#deliver').window('open');
    })

    \$('#send-show').click(function(){
        if(exchange != 0) \$('#send-info').prop('src',  '/win/send?id=' + id + '&exchange='+exchange);
        else \$('#send-info').prop('src',  '/win/send?id=' + id);
        \$('#send').window('open');
    })

    function change(){
        \$.messager.confirm('Confirm', '您确定同意换货吗？', function(r) {
            if (r) {
                \$.post('/win/change-status', {'id':id}, function(data){
                    if(data.error == 0){
                        \$.messager.alert('成功', '操作成功');
                        setTimeout(function(){window.location.reload()}, 2000);
                    }else{
                        \$.messager.alert('错误', '操作失败', 'error');
                        return false;
                    }
                })
            }
        })
    }

    function editOrder(){
        \$('#orderInfo').window('open');
        if(exchange != 0){
            \$('#order-info').prop('src',  '/win/modify?id=' + id+'&exchange='+exchange);
        }else{
            \$('#order-info').prop('src',  '/win/modify?id=' + id);
        }
    }

    var id = \"";
        // line 409
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "\";
    function saveRemark(){
        var remark = \$('#remark').val();
        \$.post('/order/remark', {'id':id, 'remark':remark}, function(data){
            if(data == 1){
                \$.messager.alert('成功', '添加成功');
                setTimeout(function(){window.location.reload()}, 2000);
            }else{
                \$.messager.alert('错误', '添加失败', 'error');
                return false;
            }
        })
    }

    function refuse(){
        \$('#dlg-refuse').window('open');
    }

    function save(){
        var content = \$('#fail').val();
        var id = \"";
        // line 429
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "\"
        \$.post('/win/refuse?id='+id, {'confirm_reason':content}, function(data){
            //data = eval('(' + data + ')');
            if(data.error == 0){
                \$.messager.alert('成功', data.message);
                setTimeout(function(){window.parent.window.load();window.parent.window.reloadgrid();}, 2000);
            }else{
                \$.messager.alert(data.message);
                return false;
            }
        })
    }

    \$('#comfirm').click(function(){
        var id = \"";
        // line 443
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "\";
        \$.post('/order/confirm-order', {'id': id}, function (data) {
            if(data == 1){
                \$.messager.alert('失败', '确认失败');
                return false;
            }else{
                \$.messager.alert('成功', '确认成功');
                setTimeout(function(){
                    window.parent.window.load();
                    window.parent.window.reloadgrid();
                }, 2000);
            }
        })
    })

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
        return array (  923 => 443,  906 => 429,  883 => 409,  836 => 365,  832 => 364,  828 => 363,  825 => 362,  822 => 361,  786 => 327,  781 => 324,  779 => 323,  776 => 322,  773 => 321,  769 => 319,  766 => 318,  764 => 317,  761 => 316,  757 => 314,  753 => 312,  750 => 311,  748 => 310,  745 => 309,  742 => 308,  738 => 306,  736 => 305,  733 => 304,  729 => 302,  727 => 301,  724 => 300,  720 => 299,  717 => 298,  715 => 297,  711 => 295,  706 => 292,  698 => 287,  694 => 286,  690 => 285,  683 => 281,  679 => 280,  673 => 277,  669 => 276,  665 => 275,  659 => 272,  655 => 271,  651 => 270,  645 => 267,  641 => 266,  637 => 265,  631 => 262,  627 => 261,  623 => 260,  617 => 257,  613 => 256,  609 => 255,  604 => 252,  601 => 251,  589 => 246,  579 => 243,  567 => 240,  559 => 237,  553 => 234,  547 => 231,  541 => 228,  536 => 225,  527 => 224,  523 => 223,  517 => 220,  512 => 217,  510 => 216,  507 => 215,  500 => 211,  496 => 210,  491 => 208,  487 => 207,  483 => 206,  479 => 204,  477 => 203,  474 => 202,  467 => 198,  463 => 197,  458 => 195,  454 => 194,  450 => 193,  446 => 192,  442 => 191,  438 => 190,  434 => 189,  430 => 188,  426 => 186,  424 => 185,  420 => 183,  415 => 181,  410 => 180,  407 => 179,  401 => 177,  399 => 176,  393 => 174,  388 => 172,  384 => 171,  379 => 170,  375 => 169,  370 => 168,  365 => 166,  358 => 165,  356 => 164,  352 => 162,  349 => 161,  347 => 160,  343 => 158,  336 => 154,  332 => 153,  328 => 152,  324 => 151,  320 => 150,  316 => 149,  301 => 137,  297 => 136,  292 => 133,  288 => 131,  279 => 128,  275 => 127,  271 => 126,  268 => 125,  264 => 124,  256 => 118,  254 => 117,  250 => 115,  244 => 111,  242 => 110,  239 => 109,  233 => 105,  231 => 104,  228 => 103,  222 => 99,  220 => 98,  208 => 89,  201 => 85,  197 => 84,  193 => 83,  186 => 79,  182 => 78,  178 => 77,  171 => 73,  166 => 71,  159 => 67,  155 => 66,  151 => 65,  143 => 60,  139 => 59,  133 => 58,  129 => 57,  125 => 56,  121 => 55,  117 => 54,  112 => 52,  108 => 51,  104 => 50,  100 => 49,  96 => 48,  62 => 27,  58 => 25,  55 => 24,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block css %}*/
/* <style>*/
/*     td {*/
/*         border: 1px solid #C1DAD7;*/
/*         background: #fff;*/
/*         font-size:11px;*/
/*         padding: 6px 6px 6px 12px;*/
/*         color: #4f6b72;*/
/*     }*/
/*     td label{background-color:#dddddd; width:100px;height: 35px; border-collapse: collapse;}*/
/*     td .alt {*/
/*         background: #F5FAFA;*/
/*         color: #797268;*/
/*     }*/
/*     .box span{font-size: 12px;padding: 6px 6px 6px 12px;color: #4f6b72;}*/
/*     .good{ border-collapse: collapse;}*/
/*     .panel-body div{ padding: 10px 0;}*/
/* */
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block main %}*/
/* <div title="Basic Window"  style="padding:5px;height:auto" class="box">*/
/*     <div style="padding: 10px 0;">*/
/*         <span>订单状态：{{ status.name }}</span><span>订单编号：{% if(detail.is_exchange) %}{{ detail.is_exchange }}{% else %}{{ detail.id }}{% endif %}</span><span>伙购时间：{{ periodInfo.end_time }}</span><span>订单生成时间：{{ detail.create_time|date('Y-m-d H:i:s') }}</span>*/
/*     </div>*/
/* */
/*     <table class="good">*/
/*         <tr>*/
/*             <td>商品图片</td>*/
/*             <td>商品名称</td>*/
/*             <td>商品编码</td>*/
/*             <td>商品品牌</td>*/
/*             <td>伙购价</td>*/
/*             <td>数量</td>*/
/*             <td>当前期号</td>*/
/*             <td>中奖来源</td>*/
/*             <td>购买次数</td>*/
/*             <td>所需金额</td>*/
/*             <td>福分抵扣</td>*/
/*             <td>红包抵扣</td>*/
/*             <td>实际购买金额</td>*/
/*         </tr>*/
/* */
/*         <tr>*/
/*             <td><img src="{{ goodInfo.picture }}"></td>*/
/*             <td>{{ goodInfo.name }}</td>*/
/*             <td>{{ goodInfo.bn }}</td>*/
/*             <td>{{ goodInfo.brand_id }}</td>*/
/*             <td>￥{{ goodInfo.price }}</td>*/
/*             <td>1</td>*/
/*             <td>{{ periodInfo.period_no }}</td>*/
/*             <td>{{ periodTable.source.name }}</td>*/
/*             <td>{{ consume.total }}次</td>*/
/*             <td>{{ consume.total }}元</td>*/
/*             <td>{{ consume.point/100 }}元({{ consume.point }}福分)</td>*/
/*             <td>{{ consume.red_packet }}元</td>*/
/*             <td>{{ consume.money }}元</td>*/
/*         </tr>*/
/*     </table>*/
/*     <table style="display: none"  cellpadding="5">*/
/*         <tr>*/
/*             <td><label>订单号：</label>{{ detail.id }}</td>*/
/*             <td>商品名称：{{ goodInfo.name }}</td>*/
/*             <td>状态：{{ status.name }}</td>*/
/*         </tr>*/
/* */
/*         <tr>*/
/*             <td>商品分类：{{ catName[periodInfo.cat_id] }}</td>*/
/*             <td>发货方式：</td>*/
/*             <td>商品价格：￥{{ goodInfo.price }}</td>*/
/*         </tr>*/
/* */
/*         <tr>*/
/*             <td>伙购码：{{ periodInfo.lucky_code }}</td>*/
/*             <td>会员：{{ detail.user_id.username }}</td>*/
/*             <td>伙购时间：{{ periodTable.buy_time }}</td>*/
/*         </tr>*/
/* */
/*         <tr>*/
/*             <td>当期购买次数：{{ consume.total }}次</td>*/
/*             <td>实际购买金额：{{ consume.money }}元</td>*/
/*             <td>支付福分：{{ consume.point }}</td>*/
/*         </tr>*/
/* */
/*         <tr>*/
/*             <td>来源：{{ periodTable.source.name }}</td>*/
/*             <td></td>*/
/*             <td></td>*/
/*         </tr>*/
/* */
/*     </table>*/
/* </div>*/
/* */
/* <div style="width:auto;height:auto;">*/
/*     {% if(detail.status >= 0) %}*/
/*     <div title="收货地址" style="padding:10px" id="address" class="easyui-dialog" data-options="closed:true,modal:true"  >*/
/*         <iframe id="address-info" frameborder="0" style="width: 500px;height: 300px;" scrolling="no"></iframe>*/
/*     </div>*/
/*     {% endif %}*/
/* */
/*     {% if(detail.status > 1) %}*/
/*     <div title="备货信息" style="padding:10px" class="easyui-dialog" data-options="closed:true,modal:true" id="deliver">*/
/*         <iframe id="deliver-info" frameborder="0" style="width: 400px;height: 400px;" scrolling="no"></iframe>*/
/*     </div>*/
/*     {% endif %}*/
/* */
/*     {% if(detail.status > 2) %}*/
/*     <div title="发货信息" style="padding:10px" class="easyui-dialog" data-options="closed:true,modal:true" id="send">*/
/*         <iframe id="send-info" frameborder="0" style="width: 400px;height: 300px;"  scrolling="no"></iframe>*/
/*     </div>*/
/*     {% endif %}*/
/* */
/*     <div title="备注" style="padding: 10px;font-size: 13px;">*/
/*         {% if(remarkArr) %}*/
/*         <table class="good">*/
/*             <tr>*/
/*                 <td>备注内容</td>*/
/*                 <td>备注人</td>*/
/*                 <td>备注时间</td>*/
/*             </tr>*/
/*             {% for remark in remarkArr %}*/
/*             <tr>*/
/*                 <td>{{ remark.op_content }}</td>*/
/*                 <td>{{person[remark.op_user]}} </td>*/
/*                 <td>{{remark.op_time}}</td>*/
/*             </tr>*/
/*             {% endfor %}*/
/*         </table>*/
/*         {% endif %}*/
/* */
/* */
/* */
/*         {% if(detail.status == 6) %}<br />异常备注：<br />*/
/*         <br />(1)管理员备注:&nbsp;{{ detail.fail_id }}<br />*/
/*         <br />(2)用户提交:<br /><br />*/
/*         <table class="good">*/
/*             <tr>*/
/*                 <td>用户手机号</td>*/
/*                 <td>充值账号</td>*/
/*                 <td>真实姓名</td>*/
/*                 <td>充值类型</td>*/
/*                 <td>添加时间</td>*/
/*                 <td>更新时间</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>{{ unusual.phone}}</td>*/
/*                 <td>{{ unusual.account}} </td>*/
/*                 <td>{{ unusual.name}}</td>*/
/*                 <td>{{ unusual.type}}</td>*/
/*                 <td>{{ unusual.created_at}}</td>*/
/*                 <td>{{ unusual.updated_at}}</td>*/
/*             </tr>*/
/*         </table>*/
/*         {%endif %}*/
/*     </div>*/
/* </div>*/
/* {% if goodInfo.delivery_id != 3 %}*/
/*     {% if((detail.status >= 1 and detail.status != 6) or (detail.before_status >= 1 and detail.before_status != 10)) or (detail.status >= 0 and goodInfo.delivery_id == 10) %}*/
/*     <div class="easyui-tabs" style="width:1000px;height:auto;font-size: 14px;">*/
/*             <div title="收货地址" style="padding:10px">*/
/*                 {% if(virtual) %}*/
/*                 <div>收货人：{{ virtual.account }} | {{virtual.name}}</div>*/
/*                 <div>虚拟物品：{{ virtual.type }}</div>*/
/*                 {% else %}*/
/*                 <div>收货人：{{ detail.ship_name }}</div>*/
/*                 <div>联系方式：{{ detail.ship_mobile }}</div>*/
/*                 <div>收货地址：{{ detail.ship_area }}{{ detail.ship_addr }}</div>*/
/*                 <div>配送时间：{{ detail.ship_time }}</div>*/
/*                 <div>备注信息：{{ detail.mark_text }}</div>*/
/*                 {% endif %}*/
/*                 <div>提交时间：{{ detail.confirm_addr_time|date('Y-m-d H:i:s') }}</div>*/
/*                 <br />*/
/*                 {% if deliverInfo.third_order %}*/
/*                 <div>第三方订单号：{{ deliverInfo.third_order|raw }}</div>*/
/*                 {% endif %}*/
/*                 {% if detail.status > 1 %}*/
/*                 <div>确认人：{{ person[deliverInfo.confirm_userid] }}</div>*/
/*                 <div>确认时间：{{ deliverInfo.confirm_time|date('Y-m-d H:i:s') }}</div>*/
/*                 {% endif %}*/
/*             </div>*/
/* */
/*         {% if((detail.status >= 3 and detail.status != 6) or (detail.before_status >= 3 and detail.before_status != 10)) %}*/
/*             <div title="备货信息" style="padding:10px">*/
/*                 <div>*/
/*                     <div>发货方式：{{ deliverInfo.send }}</div>*/
/*                     <div>备货平台：{{ deliverInfo.platform }}</div>*/
/*                     <div>成本：{{ deliverInfo.price }}</div>*/
/*                     <div>第三方订单号：{{ deliverInfo.third_order|raw }}</div>*/
/*                     <div>发票类型：{{ deliverInfo.bill }}</div>*/
/*                     <div>发票编号：{{ deliverInfo.bill_num }}</div>*/
/*                     <div>规格：{{ deliverInfo.standard }}</div>*/
/*                     <div>备注：{{ deliverInfo.mark_text }}</div>*/
/*                     <br />*/
/*                     <div>备货人：{{ person[deliverInfo.prepare_userid] }}</div>*/
/*                     <div>备货时间：{{ deliverInfo.prepare_time|date('Y-m-d H:i:s') }}</div>*/
/*                 </div>*/
/*             </div>*/
/*         {% endif %}*/
/* */
/*         {% if(detail.status >= 4 and detail.status != 6) or (detail.before_status >= 4 and detail.before_status != 10) %}*/
/*         <div title="发货信息" style="padding:10px">*/
/*             <div>*/
/*                 <div>快递公司：{{ deliverInfo.deliver_company }}</div>*/
/*                 <div>快递订单号：{{ deliverInfo.deliver_order }}</div>*/
/*                 <div>快递费用：{{ deliverInfo.deliver_cost }}</div>*/
/*                 <br />*/
/*                 <div>发货人：{{ person[deliverInfo.prepare_userid] }}</div>*/
/*                 <div>发货时间：{{ deliverInfo.deliver_time|date('Y-m-d H:i:s') }}</div>*/
/*             </div>*/
/*         </div>*/
/*         {% endif %}*/
/* */
/*         {% if(detail.status == 8) %}*/
/*         <div title="晒单信息" style="padding:10px;font-size:14px;">*/
/*             <table cellpadding="5" style="border-collapse: collapse;">*/
/*                 <tr>*/
/*                     <td width="100">晒单时间：</td><td>{{ shareTopic.created_at|date('Y-m-d H:i:s') }}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>晒单图片：</td><td>{% for item in shareImg %}*/
/*                     <img src="{{ item.basename }}" width="200px" height="200px">*/
/*                     {% endfor %}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>获奖感言：</td><td>{{ shareTopic.content }}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>奖励积分：</td><td>{{ shareTopic.point }}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>审核人：</td><td>{{ person[shareTopic.admin_id] }}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>审核时间：</td><td>{% if shareTopic.checked_at %}{{ shareTopic.checked_at|date('Y-m-d H:i:s') }}{% endif %}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>状态：</td><td>{% if shareTopic.is_pass == 1 %}已通过{% elseif shareTopic.is_pass == 0 %}待审核{% elseif shareTopic.is_pass == 2 %}未通过{% endif %}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>推荐：</td><td>{% if(shareTopic.is_recommend) %}是{% else %}否{% endif %}  </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>精华：</td><td>{% if(shareTopic.is_digest) %}是{% else %}否{% endif %}</td>*/
/*                 </tr>*/
/*             </table>*/
/*         </div>*/
/*         {% endif %}*/
/*         {% if exchange %}*/
/*         <div title="换货信息" style="padding:10px">*/
/*             <table cellpadding="10" border="0" cellspacing="1">*/
/*                 <tr>*/
/*                     <td>原单号</td><td>{{ exchange.id }}</td>*/
/*                     <td>确认人</td><td>{{ person[exchange.confirm_userid] }}</td>*/
/*                     <td>确认时间</td><td>{{ exchange.confirm_time|date('Y-m-d H:i:s') }}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>发货方式</td><td>{{ exchange.send }}</td>*/
/*                     <td>备货平台</td><td>{{ exchange.platform }}</td>*/
/*                     <td>采购价格</td><td>{{ exchange.price }}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>第三方订单号</td><td>{{ exchange.third_order }}</td>*/
/*                     <td>规格</td><td>{{ exchange.standard }}</td>*/
/*                     <td>发票</td><td>{{ exchange.bill }}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>发票号</td><td>{{ exchange.bill_order }}</td>*/
/*                     <td>备货人</td><td>{{ person[exchange.prepare_userid] }}</td>*/
/*                     <td>备货时间</td><td>{{ exchange.prepare_time|date('Y-m-d H:i:s') }}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>快递公司</td><td>{{ exchange.deliver_company }}</td>*/
/*                     <td>快递单号</td><td>{{ exchange.deliver_order }}</td>*/
/*                     <td>快递费</td><td>{{ exchange.deliver_cost }}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>发货人</td><td>{{ person[exchange.deliver_userid] }}</td>*/
/*                     <td>发货时间</td><td>{{ exchange.deliver_time|date('Y-m-d H:i:s') }}</td>*/
/*                     <td></td><td></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>新单号</td><td>{{ deliverInfo.id }}</td>*/
/*                     <td>换货人</td><td>{{ person[deliverInfo.admin_id] }}</td>*/
/*                     <td>换货时间</td><td>{{ deliverInfo.created_time|date('Y-m-d H:i:s') }}</td>*/
/*                 </tr>*/
/*             </table>*/
/*         </div>*/
/*         {% endif %}*/
/*     </div>*/
/*     {% endif %}*/
/* {% endif %}*/
/* <br />*/
/* */
/* {% if goodInfo.delivery_id != 3 %}*/
/*    <!-- {% if(detail.status == 0 and priv.address == 1 ) %}*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all" id="address-show">填写收货地址</a>*/
/*     {% endif %}-->*/
/*     {% if(detail.status == 2 and priv.deliver == 1) %}*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all" id="deliver-show">备货</a>*/
/*     {% endif %}*/
/*     {% if(detail.status == 3 and priv.send == 1) %}*/
/* {% if(priv.buyback == 0) %}*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all" id="send-show">发货</a>*/
/* {% endif %}*/
/*     {% endif %}*/
/* */
/*     {% if(detail.status >0 and detail.status <3 and priv.confirm == 1 and priv.refuse == 1 or (detail.status >= 0 and goodInfo.delivery_id == 10)) %}*/
/*         {% if(detail.status ==1) %}*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all" id="comfirm">确认</a>*/
/*         {% endif %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all" onclick="refuse()">驳回</a>*/
/*     {% endif %}*/
/* */
/*     {% if(detail.status == 4) %}*/
/*         {% if(detail.is_exchange == 0 and priv.exchange == 1) %}*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all" onclick="change()">申请换货</a>*/
/*         {% endif %}*/
/*     {% endif %}*/
/* */
/*     {% if(detail.status >= 3 and detail.status != 6 and priv.modify == 1 and priv.buyback!=1) %}*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all" onclick="editOrder()">修改订单</a>*/
/*     {% endif %}*/
/* {% endif %}*/
/* <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#dlg-remark').window('open');;">添加备注</a>*/
/* */
/* <div id="dlg-buttons-remark" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="saveRemark()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-remark').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* <div id="dlg-refuse" title="驳回理由" class="easyui-dialog" style="width:320px;height:auto;padding:10px 20px" data-options="closed:true,modal:true" buttons="#dlg-buttons-add">*/
/*     <textarea data-options="required:true" class="easyui-textarea" rows="6" cols="34" id="fail"></textarea>*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-refuse').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* <div class="easyui-window" data-options="closed:true,modal:true" id="change" title="申请换货" style="text-align:center;padding:15px 5px 5px 5px;width:200px;height: 100px;">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="change()">通过</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#change').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* <div class="easyui-window" data-options="closed:true," id="orderInfo" title="修改订单信息">*/
/*     <iframe id="order-info" frameborder="0" style="width: 670px;height: 400px;" scrolling="no"></iframe>*/
/* </div>*/
/* */
/* <div id="dlg-remark" title="添加备注" class="easyui-dialog" style="width:320px;height:auto;padding:10px 20px" closed="true" buttons="#dlg-buttons-remark">*/
/*     <textarea data-options="required:true" class="easyui-textarea" rows="10" cols="34" id="remark"></textarea>*/
/* </div>*/
/* */
/* <div class="easyui-window" data-options="closed:true," id="dlg-view" title="兑换">*/
/*     <iframe id="duiba" frameborder="0" style="width: 670px;height: 400px;" scrolling="no"></iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script>*/
/*     var status = "{{ detail.status }}";*/
/*     var id = "{{ detail.id }}";*/
/*     var exchange = "{{ detail.is_exchange }}";*/
/* */
/*     $('#address-show').click(function(){*/
/*         $('#address-info').prop('src',  '/win/address?id=' + id);*/
/*         $('#address').window('open');*/
/*     })*/
/* */
/*     $('#deliver-show').click(function(){*/
/*         if(exchange != 0) $('#deliver-info').prop('src',  '/win/deliver?id=' + id + '&exchange='+exchange);*/
/*         else $('#deliver-info').prop('src',  '/win/deliver?id=' + id);*/
/*         $('#deliver').window('open');*/
/*     })*/
/* */
/*     $('#send-show').click(function(){*/
/*         if(exchange != 0) $('#send-info').prop('src',  '/win/send?id=' + id + '&exchange='+exchange);*/
/*         else $('#send-info').prop('src',  '/win/send?id=' + id);*/
/*         $('#send').window('open');*/
/*     })*/
/* */
/*     function change(){*/
/*         $.messager.confirm('Confirm', '您确定同意换货吗？', function(r) {*/
/*             if (r) {*/
/*                 $.post('/win/change-status', {'id':id}, function(data){*/
/*                     if(data.error == 0){*/
/*                         $.messager.alert('成功', '操作成功');*/
/*                         setTimeout(function(){window.location.reload()}, 2000);*/
/*                     }else{*/
/*                         $.messager.alert('错误', '操作失败', 'error');*/
/*                         return false;*/
/*                     }*/
/*                 })*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     function editOrder(){*/
/*         $('#orderInfo').window('open');*/
/*         if(exchange != 0){*/
/*             $('#order-info').prop('src',  '/win/modify?id=' + id+'&exchange='+exchange);*/
/*         }else{*/
/*             $('#order-info').prop('src',  '/win/modify?id=' + id);*/
/*         }*/
/*     }*/
/* */
/*     var id = "{{ detail.id }}";*/
/*     function saveRemark(){*/
/*         var remark = $('#remark').val();*/
/*         $.post('/order/remark', {'id':id, 'remark':remark}, function(data){*/
/*             if(data == 1){*/
/*                 $.messager.alert('成功', '添加成功');*/
/*                 setTimeout(function(){window.location.reload()}, 2000);*/
/*             }else{*/
/*                 $.messager.alert('错误', '添加失败', 'error');*/
/*                 return false;*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     function refuse(){*/
/*         $('#dlg-refuse').window('open');*/
/*     }*/
/* */
/*     function save(){*/
/*         var content = $('#fail').val();*/
/*         var id = "{{ detail.id }}"*/
/*         $.post('/win/refuse?id='+id, {'confirm_reason':content}, function(data){*/
/*             //data = eval('(' + data + ')');*/
/*             if(data.error == 0){*/
/*                 $.messager.alert('成功', data.message);*/
/*                 setTimeout(function(){window.parent.window.load();window.parent.window.reloadgrid();}, 2000);*/
/*             }else{*/
/*                 $.messager.alert(data.message);*/
/*                 return false;*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     $('#comfirm').click(function(){*/
/*         var id = "{{ detail.id }}";*/
/*         $.post('/order/confirm-order', {'id': id}, function (data) {*/
/*             if(data == 1){*/
/*                 $.messager.alert('失败', '确认失败');*/
/*                 return false;*/
/*             }else{*/
/*                 $.messager.alert('成功', '确认成功');*/
/*                 setTimeout(function(){*/
/*                     window.parent.window.load();*/
/*                     window.parent.window.reloadgrid();*/
/*                 }, 2000);*/
/*             }*/
/*         })*/
/*     })*/
/* */
/* </script>*/
/* */
/* {% endblock %}*/
