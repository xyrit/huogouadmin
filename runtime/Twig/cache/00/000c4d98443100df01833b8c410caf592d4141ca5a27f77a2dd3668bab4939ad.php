<?php

/* index.html */
class __TwigTemplate_6e4c04b6089e3ad9b02548ab82ed714715216efb2128a68f6df0f7fb6bf436f2 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "index.html", 1);
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
        echo "<table title=\"数据统计\" id=\"listdata\" class=\"easyui-datagrid\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/stats/index"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'date',align:'center'\" width=\"100\">日期</th>
        <th data-options=\"field:'reg_num', align:'center'\" width=\"100\">注册人数</th>
        <th data-options=\"field:'valid_reg_num', align:'center'\" width=\"100\">有效用户</th>
        <th data-options=\"field:'today_reg_recharge', align:'center'\" width=\"100\">新用户充值</th>
        <th data-options=\"field:'today_reg_payment', align:'center'\" width=\"100\">新用户消费</th>
        <th data-options=\"field:'recharge_num', align:'center'\" width=\"100\">充值人数</th>
        <th data-options=\"field:'recharge_money', align:'center'\" width=\"100\">充值金额</th>
        <th data-options=\"field:'pay_num', align:'center'\" width=\"100\">消费人数</th>
        <th data-options=\"field:'pay_money', align:'center'\" width=\"100\">消费金额</th>
        <th data-options=\"field:'invite_num', align:'center'\" width=\"100\">邀请人数</th>
        <th data-options=\"field:'sign_num', align:'center'\" width=\"100\">签到人数</th>
        <th data-options=\"field:'share_lottery', align:'center'\" width=\"100\">分享抽奖</th>
        <th data-options=\"field:'recharge_lottery', align:'center'\" width=\"100\">充值抽奖</th>
        <th  data-options=\"field:'coupon_use_num', align:'center'\" width=\"100\">优惠券使用数量</th>
        <th  data-options=\"field:'coupon_money', align:'center'\" width=\"100\">优惠券抵扣金额</th>
        <th  data-options=\"field:'rich_money', align:'center'\" width=\"100\">土豪榜发放金额</th>
        <th  data-options=\"field:'rich_point', align:'center'\" width=\"100\">土豪榜发放福分</th>
    </tr>
    </thead>
</table>

";
    }

    // line 30
    public function block_js($context, array $blocks = array())
    {
        // line 31
        echo "<script type=\"text/javascript\">
    \$(function(){
        \$(\"#coupon_type li\").click(function(){
            \$(this).addClass('tree-node-selected').siblings().removeClass('tree-node-selected');
        })
    })
    function choose(){
        var type_id = \$(\".tree-node-selected\").attr('value');
        \$('#coupon-edit').prop('src',  'add?type_id=' + type_id);
        \$('#dlg-view').window('open');
    }
    function edit() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择活动');
            return false;
        }
        \$('#coupon-edit').prop('src',  '/coupon/edit?id=' + selRow.id);
        \$('#dlg-view').window('open');
    }
</script>
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
        return array (  65 => 31,  62 => 30,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table title="数据统计" id="listdata" class="easyui-datagrid" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{ url('/stats/index') }}',rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'date',align:'center'" width="100">日期</th>*/
/*         <th data-options="field:'reg_num', align:'center'" width="100">注册人数</th>*/
/*         <th data-options="field:'valid_reg_num', align:'center'" width="100">有效用户</th>*/
/*         <th data-options="field:'today_reg_recharge', align:'center'" width="100">新用户充值</th>*/
/*         <th data-options="field:'today_reg_payment', align:'center'" width="100">新用户消费</th>*/
/*         <th data-options="field:'recharge_num', align:'center'" width="100">充值人数</th>*/
/*         <th data-options="field:'recharge_money', align:'center'" width="100">充值金额</th>*/
/*         <th data-options="field:'pay_num', align:'center'" width="100">消费人数</th>*/
/*         <th data-options="field:'pay_money', align:'center'" width="100">消费金额</th>*/
/*         <th data-options="field:'invite_num', align:'center'" width="100">邀请人数</th>*/
/*         <th data-options="field:'sign_num', align:'center'" width="100">签到人数</th>*/
/*         <th data-options="field:'share_lottery', align:'center'" width="100">分享抽奖</th>*/
/*         <th data-options="field:'recharge_lottery', align:'center'" width="100">充值抽奖</th>*/
/*         <th  data-options="field:'coupon_use_num', align:'center'" width="100">优惠券使用数量</th>*/
/*         <th  data-options="field:'coupon_money', align:'center'" width="100">优惠券抵扣金额</th>*/
/*         <th  data-options="field:'rich_money', align:'center'" width="100">土豪榜发放金额</th>*/
/*         <th  data-options="field:'rich_point', align:'center'" width="100">土豪榜发放福分</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     $(function(){*/
/*         $("#coupon_type li").click(function(){*/
/*             $(this).addClass('tree-node-selected').siblings().removeClass('tree-node-selected');*/
/*         })*/
/*     })*/
/*     function choose(){*/
/*         var type_id = $(".tree-node-selected").attr('value');*/
/*         $('#coupon-edit').prop('src',  'add?type_id=' + type_id);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/*     function edit() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择活动');*/
/*             return false;*/
/*         }*/
/*         $('#coupon-edit').prop('src',  '/coupon/edit?id=' + selRow.id);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
