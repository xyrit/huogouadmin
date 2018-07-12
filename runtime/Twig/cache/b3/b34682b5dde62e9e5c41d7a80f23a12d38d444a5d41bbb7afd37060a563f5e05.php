<?php

/* recharge.html */
class __TwigTemplate_c43b354e631c022e77c2a9d62da88e0da527995d31eaf08e36c3168859ddcc13 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "recharge.html", 1);
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
        echo "
<div class=\"search\">
    <span>支付方式
        <select name=\"payment\" id=\"payment\" class=\"easyui-combobox\" data-options=\"panelHeight:'auto',onSelect:paymentOnSelect, required:true\">
            <option value=\"-1\">全部</option>
            <option value=\"1\">储蓄卡</option>
            <option value=\"2\">信用卡</option>
            <option value=\"3\">充值平台</option>
            <option value=\"4\">佣金</option>
            <option value=\"5\">充值卡</option>
            <option value=\"6\">兑换伙购币</option>
            <option value=\"7\">平台赠送</option>
        </select>
    </span>
    <span id=\"source\">支付平台
        <select name=\"source\" id=\"sourcename\" data-options=\"panelHeight:'auto'\" class=\"easyui-combobox\">
            <option value=\"0\">全部</option>
            <option value=\"zhifukachat\">微信支付</option>
            <option value=\"jd\">京东支付</option>
            <option value=\"zhifukaqq\">手q支付</option>
            <option value=\"iapp\">爱贝支付</option>
            <option value=\"kq\">快钱</option>
            <option value=\"chinaBank\">网银在线</option>
            <option value=\"union\">银联在线</option>
        </select>
    </span>
    <span>支付状态
        <select name=\"status\" id=\"status\" class=\"easyui-combobox\"  data-options=\"panelHeight:'auto'\">
            <option value=\"-1\">全部</option>
            <option value=\"1\">已支付</option>
            <option value=\"0\">未支付</option>
        </select>
    </span>
    <span>订单号<input class=\"easyui-textbox\" type=\"text\" name=\"id\" id=\"id\"></span>
    <span>开始时间<input style=\"width:200px\" name=\"start_time\" id=\"start_time\"  class=\"easyui-datetimebox\" ></span>
    <span>结束时间<input style=\"width:200px\" name=\"end_time\" id=\"end_time\" class=\"easyui-datetimebox\" ></span>
    <span>用户<input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"dataexcel();\">导出</a>
    <span>总计：<b id=\"total\"></b></span>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"伙购列表\" data-options=\"toolbar:'#tb-user',rownumbers:false,singleSelect:true,pagination:true,method:'get',url:'";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("order/recharge"), "html", null, true);
        echo "',onLoadSuccess: OnloadSuccess,pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:200, align:'center'\">订单号</th>
        <th data-options=\"field:'result', width:200, align:'center'\">流水号</th>
        <th data-options=\"field:'user_id', width:200, align:'center'\" formatter=\"formatName\">会员</th>
        <th data-options=\"field:'post_money', width:100, align:'center'\">金额</th>
        <th data-options=\"field:'payment', width:100, align:'center'\">支付方式</th>
        <th data-options=\"field:'source', width:150, align:'center'\">来源</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'pay_time', width:200, align:'center'\">充值时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 63
    public function block_js($context, array $blocks = array())
    {
        // line 64
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/laydate/laydate.js\"></script>
<script>
    \$(function(){
        \$('#source').hide();
    })
    function paymentOnSelect(newValue, oldValue) {
        if (newValue.value == 3) {
            \$('#source').show();
        } else {
            \$('#source').hide();
        }
    }

    function formatName(val, row) {
        result = '';

        if (row.user_id.phone) {
            result += '手机号：' + row.user_id.phone + '<br />';
        }
        if (row.user_id.email) {
            result += '邮箱：' + row.user_id.email;
        }

        return result;
    }

    function OnloadSuccess(){
        var totalmoney = \$('#listdata').datagrid('getData').money;
        \$('#total').html(totalmoney);
    }

    //格式化状态
    function formatStatus(val, row) {
        if (val == 1) {
            return '<span style=\"color:red\">已支付</span>';
        } else {
            return '<span>未支付</span>';
        }
    }

    \$('#payment').change(function(){
        var val = \$(this).val();
        var ui = document.getElementById(\"source\");
        if(val == 3){
            ui.style.display=\"inline\";
        }else{
            ui.style.display=\"none\";
        }
    })


    function dataexcel(){
        var start_time = \$('#start_time').datetimebox('getValue');
        var end_time = \$('#end_time').datetimebox('getValue');
        var account = \$('#account').val();
        var status = \$('#status').combobox(\"getValue\");
        var payment = \$('#payment').combobox(\"getValue\");
        var id = \$('#id').val();
        if ( \$(\"#source\").length > 0 ) {
            var source = \$('#sourcename').combobox(\"getValue\");
        }else{
            var source = '';
        }

        window.location.href=\"/order/recharge?excel=recharge&start_time=\"+start_time+'&end_time='+end_time+'&account='+account+'&status='+status+'&payment='+payment+'&source='+source+'&id='+id;
    }

    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.start_time = \$('#start_time').datetimebox('getValue');
        queryParams.end_time = \$('#end_time').datetimebox('getValue');
        queryParams.account = \$('#account').val();
        queryParams.id = \$('#id').val();
        queryParams.status = \$('#status').combobox(\"getValue\");
        queryParams.payment = \$('#payment').combobox(\"getValue\");
        if ( \$(\"#source\").length > 0 ) {
            queryParams.source = \$('#sourcename').combobox(\"getValue\");
        }
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

</script>
";
    }

    public function getTemplateName()
    {
        return "recharge.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 64,  96 => 63,  76 => 46,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>支付方式*/
/*         <select name="payment" id="payment" class="easyui-combobox" data-options="panelHeight:'auto',onSelect:paymentOnSelect, required:true">*/
/*             <option value="-1">全部</option>*/
/*             <option value="1">储蓄卡</option>*/
/*             <option value="2">信用卡</option>*/
/*             <option value="3">充值平台</option>*/
/*             <option value="4">佣金</option>*/
/*             <option value="5">充值卡</option>*/
/*             <option value="6">兑换伙购币</option>*/
/*             <option value="7">平台赠送</option>*/
/*         </select>*/
/*     </span>*/
/*     <span id="source">支付平台*/
/*         <select name="source" id="sourcename" data-options="panelHeight:'auto'" class="easyui-combobox">*/
/*             <option value="0">全部</option>*/
/*             <option value="zhifukachat">微信支付</option>*/
/*             <option value="jd">京东支付</option>*/
/*             <option value="zhifukaqq">手q支付</option>*/
/*             <option value="iapp">爱贝支付</option>*/
/*             <option value="kq">快钱</option>*/
/*             <option value="chinaBank">网银在线</option>*/
/*             <option value="union">银联在线</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>支付状态*/
/*         <select name="status" id="status" class="easyui-combobox"  data-options="panelHeight:'auto'">*/
/*             <option value="-1">全部</option>*/
/*             <option value="1">已支付</option>*/
/*             <option value="0">未支付</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>订单号<input class="easyui-textbox" type="text" name="id" id="id"></span>*/
/*     <span>开始时间<input style="width:200px" name="start_time" id="start_time"  class="easyui-datetimebox" ></span>*/
/*     <span>结束时间<input style="width:200px" name="end_time" id="end_time" class="easyui-datetimebox" ></span>*/
/*     <span>用户<input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="dataexcel();">导出</a>*/
/*     <span>总计：<b id="total"></b></span>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="伙购列表" data-options="toolbar:'#tb-user',rownumbers:false,singleSelect:true,pagination:true,method:'get',url:'{{  url('order/recharge')}}',onLoadSuccess: OnloadSuccess,pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:200, align:'center'">订单号</th>*/
/*         <th data-options="field:'result', width:200, align:'center'">流水号</th>*/
/*         <th data-options="field:'user_id', width:200, align:'center'" formatter="formatName">会员</th>*/
/*         <th data-options="field:'post_money', width:100, align:'center'">金额</th>*/
/*         <th data-options="field:'payment', width:100, align:'center'">支付方式</th>*/
/*         <th data-options="field:'source', width:150, align:'center'">来源</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'pay_time', width:200, align:'center'">充值时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script src="{{ app.params.skinUrl }}/js/laydate/laydate.js"></script>*/
/* <script>*/
/*     $(function(){*/
/*         $('#source').hide();*/
/*     })*/
/*     function paymentOnSelect(newValue, oldValue) {*/
/*         if (newValue.value == 3) {*/
/*             $('#source').show();*/
/*         } else {*/
/*             $('#source').hide();*/
/*         }*/
/*     }*/
/* */
/*     function formatName(val, row) {*/
/*         result = '';*/
/* */
/*         if (row.user_id.phone) {*/
/*             result += '手机号：' + row.user_id.phone + '<br />';*/
/*         }*/
/*         if (row.user_id.email) {*/
/*             result += '邮箱：' + row.user_id.email;*/
/*         }*/
/* */
/*         return result;*/
/*     }*/
/* */
/*     function OnloadSuccess(){*/
/*         var totalmoney = $('#listdata').datagrid('getData').money;*/
/*         $('#total').html(totalmoney);*/
/*     }*/
/* */
/*     //格式化状态*/
/*     function formatStatus(val, row) {*/
/*         if (val == 1) {*/
/*             return '<span style="color:red">已支付</span>';*/
/*         } else {*/
/*             return '<span>未支付</span>';*/
/*         }*/
/*     }*/
/* */
/*     $('#payment').change(function(){*/
/*         var val = $(this).val();*/
/*         var ui = document.getElementById("source");*/
/*         if(val == 3){*/
/*             ui.style.display="inline";*/
/*         }else{*/
/*             ui.style.display="none";*/
/*         }*/
/*     })*/
/* */
/* */
/*     function dataexcel(){*/
/*         var start_time = $('#start_time').datetimebox('getValue');*/
/*         var end_time = $('#end_time').datetimebox('getValue');*/
/*         var account = $('#account').val();*/
/*         var status = $('#status').combobox("getValue");*/
/*         var payment = $('#payment').combobox("getValue");*/
/*         var id = $('#id').val();*/
/*         if ( $("#source").length > 0 ) {*/
/*             var source = $('#sourcename').combobox("getValue");*/
/*         }else{*/
/*             var source = '';*/
/*         }*/
/* */
/*         window.location.href="/order/recharge?excel=recharge&start_time="+start_time+'&end_time='+end_time+'&account='+account+'&status='+status+'&payment='+payment+'&source='+source+'&id='+id;*/
/*     }*/
/* */
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.start_time = $('#start_time').datetimebox('getValue');*/
/*         queryParams.end_time = $('#end_time').datetimebox('getValue');*/
/*         queryParams.account = $('#account').val();*/
/*         queryParams.id = $('#id').val();*/
/*         queryParams.status = $('#status').combobox("getValue");*/
/*         queryParams.payment = $('#payment').combobox("getValue");*/
/*         if ( $("#source").length > 0 ) {*/
/*             queryParams.source = $('#sourcename').combobox("getValue");*/
/*         }*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/* </script>*/
/* {% endblock %}*/
/* */
/* */
