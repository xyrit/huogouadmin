<?php

/* index.html */
class __TwigTemplate_54aa04f57599bcf0e6ff4fdc9adbb8e231a8a42d1373d05fadfa1c213950d90f extends yii\twig\Template
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
        echo "<style>
    .high{color:#009ACD}
</style>
<div style=\"padding:5px;height:auto\">
    <span>商品名<input type=\"text\" class=\"easyui-textbox\"  name=\"product\" id=\"product\"></span>
    <span>订单号<input type=\"text\" name=\"order\" id=\"order\" class=\"easyui-textbox\" ></span>
    <span>用户<input type=\"text\" name=\"name\" id=\"name\" class=\"easyui-textbox\" ></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"dataexcel();\">导出</a>
    <input type=\"hidden\" name=\"status\" id=\"status\" value=\"all\">
</div>

<div style=\"width:auto;height:auto\" class=\"rem\">
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\">全部(";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["count"]) ? $context["count"] : null), "all", array()), "html", null, true);
        echo ")</a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"0\">新中奖(";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["count"]) ? $context["count"] : null), 0, array(), "array"), "html", null, true);
        echo ") </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"1\">待确认(";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["count"]) ? $context["count"] : null), 1, array(), "array"), "html", null, true);
        echo ") </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"2\">备货(";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["count"]) ? $context["count"] : null), 2, array(), "array"), "html", null, true);
        echo ") </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"3\">发货(";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["count"]) ? $context["count"] : null), 3, array(), "array"), "html", null, true);
        echo ") </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"4\">待收货(";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["count"]) ? $context["count"] : null), 4, array(), "array"), "html", null, true);
        echo ") </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"8\">已完成(";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["count"]) ? $context["count"] : null), 8, array(), "array"), "html", null, true);
        echo ")</a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"9\">已过期(";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["count"]) ? $context["count"] : null), 9, array(), "array"), "html", null, true);
        echo ")</a>
</div>
<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"中奖列表\" data-options=\"toolbar:'#tb-user',pagination:true,method:'get',url:'";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("act-order/index"), "html", null, true);
        echo "',pageSize:20,checkOnSelect:true,
            singleSelect:true\">
    <thead>
    <tr>
        <th data-options=\"field:'ck', checkbox:true\"></th>
        <th data-options=\"field:'id', width:200, align:'center'\"  >订单号</th>
        <th data-options=\"field:'picture', width:100, align:'center'\" formatter=\"formatPicture\">商品图片</th>
        <th data-options=\"field:'name', width:360, align:'center'\">商品名称</th>
        <th data-options=\"field:'phone', width:100, align:'center'\">会员手机</th>
        <th data-options=\"field:'email', width:150, align:'center'\">会员邮箱</th>
        <th data-options=\"field:'act_type_name', width:80, align:'center'\" >活动类型</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'create_time', width:200, align:'center'\">中奖时间</th>
        <th data-options=\"field:'select_prepare', width:200, align:'center'\">备发货操作人</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"view()\">查看</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" id=\"reset\" data-options=\"iconCls:'icon-ok',plain:true\" onclick=\"reset()\" style=\"display: none\">重置订单</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" id=\"sel-prepare\" data-options=\"iconCls:'icon-ok',plain:true\" onclick=\"javascript:\$('#dlg-sel-prepare').dialog('open')\" style=\"display: none\">选取备货人</a>
    </div>
</div>

<div id=\"dlg-detail\" class=\"easyui-window\" title=\"订单详情\" style=\"width:80%;height:700px;padding:10px;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"detail_iframe\">
    </iframe>
</div>

<div id=\"dlg-sel-prepare\" title=\"设置备货人\" class=\"easyui-dialog\" style=\"width:380px;height:auto;padding:10px 20px\" data-options=\"modal:true\" closed=\"true\" buttons=\"#dlg-buttons-sel-prepare\">
    ";
        // line 64
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "unusual_form")), "method");
        echo "
    <div><label>操作</label>
        <select name=\"prepareUser\" >
            <option value=\"罗丽媚\">罗丽媚</option>
            <option value=\"张晓霞\">张晓霞</option>
        </select>
    </div>
    ";
        // line 71
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
<div id=\"dlg-buttons-sel-prepare\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"submitSelPrepare()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-sel-prepare').dialog('close')\">取消</a>
</div>


";
    }

    // line 81
    public function block_js($context, array $blocks = array())
    {
        // line 82
        echo "<script>
    \$(function() {
        \$('.rem a:first').addClass('high');
    });

    \$(\".get-status\").click(function(){
        var status = \$(this).attr('data-id');
        \$('#status').val(status);
        \$('.rem a').removeClass('high');
        \$(this).addClass('high');
        reloadgrid();

        if(status == 2){
            \$('#sel-prepare').css('display', 'inline');
        }else{
            \$('#sel-prepare').css('display', 'none');
        }

    });

    function submitSelPrepare() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请至少选择一个');
            return false;
        }

        var checkName = \$('select[name=prepareUser] option:selected').val();
        var checkArr = \$('#listdata').treegrid('getSelections');

        var ids = new Array();
        \$.each(checkArr, function(i, v) {
            ids.push(v.id);
        });

        \$.post(\"";
        // line 117
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("act-order/select-prepare"), "html", null, true);
        echo "\", {checkArr: ids, prepareName: checkName}, function(data) {
            if (data.error == 0) {
                \$.messager.alert('成功', data.message);
                \$('#dlg-sel-prepare').dialog('close');
                reloadgrid();
            } else {
                \$.messager.alert('失败', data.message, 'error');
            }
        });
    }

    function view(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个');
            return false;
        }
        \$('#detail_iframe').prop('src',  'view?id=' + selRow.id);
        \$('#dlg-detail').window('open');
    }

    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.name = \$('#name').val();
        queryParams.order = \$('#order').val();
        queryParams.product = \$('#product').val();
        queryParams.status = \$('#status').val();
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

   //下载
    function dataexcel(){
        var name = \$('#name').val();
        var order = \$('#order').val();
        var product = \$('#product').val();
        var status = \$('#status').val();
        if(status == undefined) status = 'all';
        var url = \"/act-order/index?excel=order&name=\"+name+'&order='+order+'&product='+product+'&status='+status;
        window.location.href=url;
    }

    function formatPicture(val, row) {
        var imgUrl =  createActiveImgUrl(val,'small');
        return '<img src=\"'+imgUrl+'\" width=\"30\" height=\"30\"/>';
    }

    function formatActType(val, row) {
        var actType = '类型';
        switch (val) {
            case '1' :
                actType = '幸运大转盘';
                break;
            case '2' :
                actType = '0元购';
                break;
            case '3' :
                actType = '月度土豪榜';
                break;
        }
        return actType;
    }

    function formatStatus(val, row) {
        var status = '状态';
        switch (val) {
            case '0' :
                status = '已中奖';
                break;
            case '1' :
                status = '待确认';
                break;
            case '2' :
                status = '备货';
                break;
            case '3' :
                status = '发货';
                break;
            case '4' :
                status = '待收货';
                break;
            case '8' :
                status = '已完成';
                break;
            case '9' :
                status = '已过期';
                break;
        }
        return status;
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
        return array (  184 => 117,  147 => 82,  144 => 81,  131 => 71,  121 => 64,  80 => 26,  75 => 24,  71 => 23,  67 => 22,  63 => 21,  59 => 20,  55 => 19,  51 => 18,  47 => 17,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style>*/
/*     .high{color:#009ACD}*/
/* </style>*/
/* <div style="padding:5px;height:auto">*/
/*     <span>商品名<input type="text" class="easyui-textbox"  name="product" id="product"></span>*/
/*     <span>订单号<input type="text" name="order" id="order" class="easyui-textbox" ></span>*/
/*     <span>用户<input type="text" name="name" id="name" class="easyui-textbox" ></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="dataexcel();">导出</a>*/
/*     <input type="hidden" name="status" id="status" value="all">*/
/* </div>*/
/* */
/* <div style="width:auto;height:auto" class="rem">*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all">全部({{ count.all }})</a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="0">新中奖({{ count[0] }}) </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="1">待确认({{ count[1] }}) </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="2">备货({{ count[2] }}) </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="3">发货({{ count[3] }}) </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="4">待收货({{ count[4] }}) </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="8">已完成({{ count[8] }})</a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="9">已过期({{ count[9] }})</a>*/
/* </div>*/
/* <table id="listdata"  class="easyui-datagrid" title="中奖列表" data-options="toolbar:'#tb-user',pagination:true,method:'get',url:'{{  url('act-order/index')}}',pageSize:20,checkOnSelect:true,*/
/*             singleSelect:true">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'ck', checkbox:true"></th>*/
/*         <th data-options="field:'id', width:200, align:'center'"  >订单号</th>*/
/*         <th data-options="field:'picture', width:100, align:'center'" formatter="formatPicture">商品图片</th>*/
/*         <th data-options="field:'name', width:360, align:'center'">商品名称</th>*/
/*         <th data-options="field:'phone', width:100, align:'center'">会员手机</th>*/
/*         <th data-options="field:'email', width:150, align:'center'">会员邮箱</th>*/
/*         <th data-options="field:'act_type_name', width:80, align:'center'" >活动类型</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'create_time', width:200, align:'center'">中奖时间</th>*/
/*         <th data-options="field:'select_prepare', width:200, align:'center'">备发货操作人</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="view()">查看</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" id="reset" data-options="iconCls:'icon-ok',plain:true" onclick="reset()" style="display: none">重置订单</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" id="sel-prepare" data-options="iconCls:'icon-ok',plain:true" onclick="javascript:$('#dlg-sel-prepare').dialog('open')" style="display: none">选取备货人</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-detail" class="easyui-window" title="订单详情" style="width:80%;height:700px;padding:10px;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="detail_iframe">*/
/*     </iframe>*/
/* </div>*/
/* */
/* <div id="dlg-sel-prepare" title="设置备货人" class="easyui-dialog" style="width:380px;height:auto;padding:10px 20px" data-options="modal:true" closed="true" buttons="#dlg-buttons-sel-prepare">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'unusual_form'}) | raw }}*/
/*     <div><label>操作</label>*/
/*         <select name="prepareUser" >*/
/*             <option value="罗丽媚">罗丽媚</option>*/
/*             <option value="张晓霞">张晓霞</option>*/
/*         </select>*/
/*     </div>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* <div id="dlg-buttons-sel-prepare" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="submitSelPrepare()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-sel-prepare').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     $(function() {*/
/*         $('.rem a:first').addClass('high');*/
/*     });*/
/* */
/*     $(".get-status").click(function(){*/
/*         var status = $(this).attr('data-id');*/
/*         $('#status').val(status);*/
/*         $('.rem a').removeClass('high');*/
/*         $(this).addClass('high');*/
/*         reloadgrid();*/
/* */
/*         if(status == 2){*/
/*             $('#sel-prepare').css('display', 'inline');*/
/*         }else{*/
/*             $('#sel-prepare').css('display', 'none');*/
/*         }*/
/* */
/*     });*/
/* */
/*     function submitSelPrepare() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请至少选择一个');*/
/*             return false;*/
/*         }*/
/* */
/*         var checkName = $('select[name=prepareUser] option:selected').val();*/
/*         var checkArr = $('#listdata').treegrid('getSelections');*/
/* */
/*         var ids = new Array();*/
/*         $.each(checkArr, function(i, v) {*/
/*             ids.push(v.id);*/
/*         });*/
/* */
/*         $.post("{{ url('act-order/select-prepare') }}", {checkArr: ids, prepareName: checkName}, function(data) {*/
/*             if (data.error == 0) {*/
/*                 $.messager.alert('成功', data.message);*/
/*                 $('#dlg-sel-prepare').dialog('close');*/
/*                 reloadgrid();*/
/*             } else {*/
/*                 $.messager.alert('失败', data.message, 'error');*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     function view(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个');*/
/*             return false;*/
/*         }*/
/*         $('#detail_iframe').prop('src',  'view?id=' + selRow.id);*/
/*         $('#dlg-detail').window('open');*/
/*     }*/
/* */
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.name = $('#name').val();*/
/*         queryParams.order = $('#order').val();*/
/*         queryParams.product = $('#product').val();*/
/*         queryParams.status = $('#status').val();*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*    //下载*/
/*     function dataexcel(){*/
/*         var name = $('#name').val();*/
/*         var order = $('#order').val();*/
/*         var product = $('#product').val();*/
/*         var status = $('#status').val();*/
/*         if(status == undefined) status = 'all';*/
/*         var url = "/act-order/index?excel=order&name="+name+'&order='+order+'&product='+product+'&status='+status;*/
/*         window.location.href=url;*/
/*     }*/
/* */
/*     function formatPicture(val, row) {*/
/*         var imgUrl =  createActiveImgUrl(val,'small');*/
/*         return '<img src="'+imgUrl+'" width="30" height="30"/>';*/
/*     }*/
/* */
/*     function formatActType(val, row) {*/
/*         var actType = '类型';*/
/*         switch (val) {*/
/*             case '1' :*/
/*                 actType = '幸运大转盘';*/
/*                 break;*/
/*             case '2' :*/
/*                 actType = '0元购';*/
/*                 break;*/
/*             case '3' :*/
/*                 actType = '月度土豪榜';*/
/*                 break;*/
/*         }*/
/*         return actType;*/
/*     }*/
/* */
/*     function formatStatus(val, row) {*/
/*         var status = '状态';*/
/*         switch (val) {*/
/*             case '0' :*/
/*                 status = '已中奖';*/
/*                 break;*/
/*             case '1' :*/
/*                 status = '待确认';*/
/*                 break;*/
/*             case '2' :*/
/*                 status = '备货';*/
/*                 break;*/
/*             case '3' :*/
/*                 status = '发货';*/
/*                 break;*/
/*             case '4' :*/
/*                 status = '待收货';*/
/*                 break;*/
/*             case '8' :*/
/*                 status = '已完成';*/
/*                 break;*/
/*             case '9' :*/
/*                 status = '已过期';*/
/*                 break;*/
/*         }*/
/*         return status;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
