<?php

/* list.html */
class __TwigTemplate_33b68252ab8be1c315bbb918c332632f63cb29ba27f9028386de7575ec576025 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "list.html", 1);
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
        if (((isset($context["type"]) ? $context["type"] : null) == "confirm")) {
            // line 5
            echo "<div style=\"width:auto;height:auto\" class=\"rem\">
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"1\">未确认订单</a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"2\">已确认订单</a>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"中奖列表\"
       data-options=\"toolbar:'#tb-user',pagination:true,method:'get',url:'";
            // line 10
            echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("special-orders/list"), "html", null, true);
            echo "',pageSize:20,checkOnSelect:true\">
";
        } elseif (        // line 11
(isset($context["type"]) ? $context["type"] : null)) {
            // line 12
            echo "<div style=\"width:auto;height:auto\" class=\"rem\">
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"2\">未发货订单</a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"8\">已完成订单</a>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"中奖列表\"
       data-options=\"toolbar:'#tb-user',pagination:true,method:'get',url:'";
            // line 17
            echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("special-orders/undeliver"), "html", null, true);
            echo "',pageSize:20,checkOnSelect:true\">
";
        }
        // line 18
        echo "       
    <thead>
    <tr>
        <th data-options=\"field:'ck', checkbox:true\"></th>
        <th data-options=\"field:'id', width:80, align:'center'\" formatter=\"formatChange\">订单号</th>
        <th data-options=\"field:'from', width:80, align:'center'\" formatter=\"formatFrom\">站点</th>
        <th data-options=\"field:'name', width:300, align:'center'\">商品名称</th>
        <th data-options=\"field:'cat_id', width:150, align:'center'\">分类</th>
        <th data-options=\"field:'phone', width:100, align:'center'\" formatter=\"formatUsername\">会员手机</th>
        <th data-options=\"field:'period_number', width:50, align:'center'\">期数</th>
        <th data-options=\"field:'code', width:100, align:'center'\">伙购码</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'delivery', width:100, align:'center'\">发货方式</th>
        <th data-options=\"field:'create_time', width:200, align:'center'\">中奖时间</th>
        <th data-options=\"field:'confirm_addr_time', width:200, align:'center'\">确认地址时间</th>
        <th data-options=\"field:'select_prepare', width:200, align:'center'\">备发货操作人</th>
    </tr>
    </thead>
</table>
<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\"
           onclick=\"edit()\">查看</a>
    </div>
</div>
<div id=\"dlg-add\" class=\"easyui-window\" title=\"订单详情\" style=\"width:1198px;height:750px;padding:10px;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"add_iframe\">
    </iframe>
</div>
";
    }

    // line 54
    public function block_js($context, array $blocks = array())
    {
        // line 55
        echo "<script type=\"text/javascript\">
    \$(\".get-status\").click(function(){
        var status = \$(this).attr('data-id');
        //window.location.reload();
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.status = status;
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
        if(status != 0 && status != 1 && status != 2 && status != 3){
            \$('#add-address').hide();
        }else{
            \$('#add-address').show();
        }

        if(status == 'all' || status == '6' || status == '8' || status == undefined){
            \$('#unusualBtn').hide();
        }else{
            \$('#unusualBtn').show();
        }
    })
    function formatChange(val, row) {
        if (row.is_exchange != 0) return val + '<span style=\"color:red;\">换</span>';
        else return val;
    }

    function formatStatus(val, row) {
        if (row.fail == 1) return val + '(待办 ' + row.delay + ')，备注：' + row.fail_remark;
        else if (row.fail == 2) return val + '(冻结)';
        else return val;
    }

    function formatUsername(val, row) {
        if (row.email == null) return val;
        if (val == null) return row.email;
        if (row.email != null && val != null) return row.phone + '<br />' + row.email;
    }
    function formatFrom(val, row) {
        if (val==1) {
            return '伙购网';
        } else if (val==2) {
            return '滴滴夺宝';
        }
    }
    function edit(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个');
            return false;
        }
        \$('#add_iframe').prop('src',  'view?id=' + selRow.id);
        \$('#dlg-add').window('open');
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 55,  98 => 54,  59 => 18,  54 => 17,  47 => 12,  45 => 11,  41 => 10,  34 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* {% if type == 'confirm' %}*/
/* <div style="width:auto;height:auto" class="rem">*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="1">未确认订单</a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="2">已确认订单</a>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="中奖列表"*/
/*        data-options="toolbar:'#tb-user',pagination:true,method:'get',url:'{{  url('special-orders/list')}}',pageSize:20,checkOnSelect:true">*/
/* {% elseif type %}*/
/* <div style="width:auto;height:auto" class="rem">*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="2">未发货订单</a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="8">已完成订单</a>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="中奖列表"*/
/*        data-options="toolbar:'#tb-user',pagination:true,method:'get',url:'{{  url('special-orders/undeliver')}}',pageSize:20,checkOnSelect:true">*/
/* {% endif %}       */
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'ck', checkbox:true"></th>*/
/*         <th data-options="field:'id', width:80, align:'center'" formatter="formatChange">订单号</th>*/
/*         <th data-options="field:'from', width:80, align:'center'" formatter="formatFrom">站点</th>*/
/*         <th data-options="field:'name', width:300, align:'center'">商品名称</th>*/
/*         <th data-options="field:'cat_id', width:150, align:'center'">分类</th>*/
/*         <th data-options="field:'phone', width:100, align:'center'" formatter="formatUsername">会员手机</th>*/
/*         <th data-options="field:'period_number', width:50, align:'center'">期数</th>*/
/*         <th data-options="field:'code', width:100, align:'center'">伙购码</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'delivery', width:100, align:'center'">发货方式</th>*/
/*         <th data-options="field:'create_time', width:200, align:'center'">中奖时间</th>*/
/*         <th data-options="field:'confirm_addr_time', width:200, align:'center'">确认地址时间</th>*/
/*         <th data-options="field:'select_prepare', width:200, align:'center'">备发货操作人</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true"*/
/*            onclick="edit()">查看</a>*/
/*     </div>*/
/* </div>*/
/* <div id="dlg-add" class="easyui-window" title="订单详情" style="width:1198px;height:750px;padding:10px;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="add_iframe">*/
/*     </iframe>*/
/* </div>*/
/* {% endblock %}*/
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     $(".get-status").click(function(){*/
/*         var status = $(this).attr('data-id');*/
/*         //window.location.reload();*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.status = status;*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*         if(status != 0 && status != 1 && status != 2 && status != 3){*/
/*             $('#add-address').hide();*/
/*         }else{*/
/*             $('#add-address').show();*/
/*         }*/
/* */
/*         if(status == 'all' || status == '6' || status == '8' || status == undefined){*/
/*             $('#unusualBtn').hide();*/
/*         }else{*/
/*             $('#unusualBtn').show();*/
/*         }*/
/*     })*/
/*     function formatChange(val, row) {*/
/*         if (row.is_exchange != 0) return val + '<span style="color:red;">换</span>';*/
/*         else return val;*/
/*     }*/
/* */
/*     function formatStatus(val, row) {*/
/*         if (row.fail == 1) return val + '(待办 ' + row.delay + ')，备注：' + row.fail_remark;*/
/*         else if (row.fail == 2) return val + '(冻结)';*/
/*         else return val;*/
/*     }*/
/* */
/*     function formatUsername(val, row) {*/
/*         if (row.email == null) return val;*/
/*         if (val == null) return row.email;*/
/*         if (row.email != null && val != null) return row.phone + '<br />' + row.email;*/
/*     }*/
/*     function formatFrom(val, row) {*/
/*         if (val==1) {*/
/*             return '伙购网';*/
/*         } else if (val==2) {*/
/*             return '滴滴夺宝';*/
/*         }*/
/*     }*/
/*     function edit(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个');*/
/*             return false;*/
/*         }*/
/*         $('#add_iframe').prop('src',  'view?id=' + selRow.id);*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
