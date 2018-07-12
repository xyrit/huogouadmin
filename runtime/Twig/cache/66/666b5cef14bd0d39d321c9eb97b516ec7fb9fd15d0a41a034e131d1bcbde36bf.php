<?php

/* orders.html */
class __TwigTemplate_c671129d29ef077389fbad747ef9171c6b58ece7088b1eb8274d205064d1a66d extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "orders.html", 1);
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
<style>
    .high {
        color: #009ACD
    }
</style>
<div style=\"padding:5px;height:auto\">
    <a class=\"easyui-linkbutton l-btn l-btn-small l-btn-plain\" style=\"color: red\"  href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdorder/orders"), "html", null, true);
        echo "\">普通订单</a>
    <a class=\"easyui-linkbutton l-btn l-btn-small l-btn-plain\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdorder/pkorders"), "html", null, true);
        echo "\">PK订单</a>
</div>
<div style=\"padding:5px;height:auto\">
    <span>商品名称<input type=\"text\" name=\"product_name\" id=\"product_name\" class=\"easyui-textbox\"></span>
    <span>商品分类
        <select class=\"easyui-combobox\" id=\"catlist\" name=\"catlist\" data-options=\"required:true,panelHeight:'auto'\">
            <option value=\"\">全部</option>
            ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["catlist"]);
        foreach ($context['_seq'] as $context["_key"] => $context["catlist"]) {
            // line 20
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["catlist"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["catlist"], "name", array()), "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['catlist'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "        </select>
      <select class=\"easyui-combobox\" id=\"catlist2\" name=\"catlist2\"
              style=\"width: 60px\" data-options=\"required:true,panelHeight:'auto'\">
           <option value=\"\">全部</option>
       </select>
    </span>
    <span>商品当前期号<input type=\"text\" name=\"period_no\" id=\"period_no\" class=\"easyui-textbox\"></span>
    <span   style=\"display: none\">发货方式
        <select class=\"easyui-combobox\" id=\"deliver\" name=\"deliver\" data-options=\"required:true,panelHeight:'auto'\">
            <option value=\"8\">京东卡密</option>
        </select>
    </span>
    <span>时间选择
        <select class=\"easyui-combobox\" id=\"time_type\" name=\"time\" data-options=\"required:true,panelHeight:'auto'\">
            <option value=\"\">时间选择</option>
            <option value=\"1\">中奖时间</option>
            <option value=\"2\">备货时间</option>
            <option value=\"3\">发货时间</option>
            <option value=\"4\">发票时间</option>
        </select>
    </span>
        <span>订单类别
        <select class=\"easyui-combobox\" id=\"order_type\" name=\"order_type\" data-options=\"required:true,panelHeight:'auto'\">
            <option value=\"\">全部</option>
            <option value=\"1\">回购订单</option>
            <option value=\"2\">卡密订单</option>
        </select>
    </span><br/>
    <span>开始时间<input type=\"text\" name=\"startTime\" id=\"startTime\" class=\"easyui-datetimebox\"></span>
    <span>结束时间<input type=\"text\" name=\"endTime\" id=\"endTime\" class=\"easyui-datetimebox\"></span>
    <span>订单号<input type=\"text\" name=\"order\" id=\"order\" class=\"easyui-textbox\"></span>
    <span>备货人<input type=\"text\" name=\"prepare_userid\" id=\"prepare_userid\" class=\"easyui-textbox\"></span>
    <span>用户<input type=\"text\" name=\"name\" id=\"name\" class=\"easyui-textbox\"></span>
    <!--<span>商品分类<input class=\"easyui-combotree\" name=\"cat_id\" id=\"cat_id\" data-options=\"url:'";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product-category/all-list"), "html", null, true);
        echo "',method:'get'\" editable=\"true\"></span>-->
    <span>类别
        <select class=\"easyui-combobox\" id=\"types\" name=\"types\" data-options=\"required:true,panelHeight:'auto'\">
            <option value=\"\">全部</option>
            <option value=\"1\">实体</option>
            <option value=\"2\">虚拟物品</option>
        </select>
    </span>
    <span>站点
        <select class=\"easyui-combobox\" id=\"from\" name=\"from\" data-options=\"required:true,panelHeight:'auto'\">
            <option value=\"\">所有</option>
            <option value=\"1\">伙购网</option>
            <option value=\"2\">滴滴夺宝</option>
        </select>
    </span>
    <input type=\"hidden\" name=\"sub\" value=\"sub\" id=\"sub\">
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"dataexcel();\">导出</a>
</div>

<div style=\"width:auto;height:auto\" class=\"rem\">
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\">全部</a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"0\">新中奖 </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"1\">待确认 </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"2\">备货 </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"3\">发货 </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"4\">待收货 </a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"5\">待晒单</a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"6\">异常订单</a>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"8\">已完成</a>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"中奖列表\"
       data-options=\"toolbar:'#tb-user',pagination:true,method:'get',url:'";
        // line 87
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdorder/orders"), "html", null, true);
        echo "',pageSize:20,checkOnSelect:true,singleSelect:true\">
    <thead>
    <tr>
        <th data-options=\"field:'ck', checkbox:true\"></th>
        <th data-options=\"field:'id', width:80, align:'center'\" formatter=\"formatChange\">订单号</th>
        <th data-options=\"field:'from', width:80, align:'center'\" formatter=\"formatFrom\">站点</th>
        <th data-options=\"field:'name', width:300, align:'center'\">商品名称</th>
        <th data-options=\"field:'cat_id', width:150, align:'center'\">分类</th>
        <th data-options=\"field:'phone', width:100, align:'center'\" formatter=\"formatUsername\">会员手机</th>
        <th data-options=\"field:'period_number', width:50, align:'center'\">期数</th>
        <th data-options=\"field:'period_no', width:90, align:'center'\">当前期号</th>
        <th data-options=\"field:'code', width:100, align:'center'\">伙购码</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'delivery', width:100, align:'center'\">发货方式</th>
        <th data-options=\"field:'create_time', width:200, align:'center'\">中奖时间</th>
        <th data-options=\"field:'confirm_addr_time', width:200, align:'center'\">确认地址时间</th>
        <th data-options=\"field:'select_prepare', width:100, align:'center'\">备发货操作人</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\"
           onclick=\"oderview()\">查看</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-unusual',plain:true\"
           onclick=\"setUnusual()\" id=\"unusualBtn\">设为异常</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" id=\"reset\" data-options=\"iconCls:'icon-ok',plain:true\"
           onclick=\"reset()\" style=\"display: none\">重置订单</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" id=\"prepare\" data-options=\"iconCls:'icon-ok',plain:true\"
           onclick=\"javascript:\$('#dlg-prepare').dialog('open')\" style=\"display: none\">选取备货人</a>
        <!--<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-address',plain:true\" onclick=\"addAddressShow();\" id=\"add-address\">送货地址</a>-->
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

<div id=\"dlg-address\" title=\"填写收货地址\" class=\"easyui-dialog\" style=\"width:500px;height:auto;padding:10px 20px\"
     closed=\"true\" buttons=\"#dlg-buttons-address\">
    <table cellpadding=\"5\">
        <tr>
            <td>选择区域</td>
            <td>
                <select id=\"prov\" name=\"prov\"></select>
                <select id=\"city\" name=\"city\"></select>
                <select id=\"area\" name=\"area\"></select>
            </td>
        </tr>
        <tr>
            <td>详细地址</td>
            <td><input class=\"easyui-textbox\" type=\"text\" id=\"ship_addr\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>收货人</td>
            <td><input class=\"easyui-textbox\" type=\"text\" id=\"ship_name\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>联系电话</td>
            <td><input class=\"easyui-textbox\" type=\"text\" id=\"ship_phone\"
                       data-options=\"required:true,validType:'phoneRex'\"></td>
        </tr>
        <tr>
            <td>送货时间</td>
            <td>
                <select class=\"easyui-combobox\" id=\"ship_time\" style=\"width:170px;\">
                    <option value=\"时间不限\">时间不限</option>
                    <option value=\"周一至周五\">周一至周五</option>
                    <option value=\"周末及公众假日\">周末及公众假日</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>备注</td>
            <td>
                <textarea class=\"easyui-textarea\" rows=\"5\" cols=\"20\" id=\"remark\"></textarea>
            </td>
        </tr>
    </table>
</div>

<div id=\"dlg-buttons-address\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"saveAddress()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-address').dialog('close')\">取消</a>
</div>

<div id=\"dlg-unusual\" title=\"异常订单\" class=\"easyui-dialog\" style=\"width:380px;height:auto;padding:10px 20px\"
     data-options=\"modal:true\" closed=\"true\" buttons=\"#dlg-buttons-unusual\">
    ";
        // line 183
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "unusual_form")), "method");
        echo "
    <div><label>操作</label>
        <select name=\"un_fail\" id=\"fail\">
            <option value=\"1\">待办</option>
            <option value=\"2\">冻结</option>
        </select>
        <input class=\"easyui-datetimebox\" name=\"afterTime\" id=\"time\">
    </div>
    <div><label>备注</label>
        <textarea data-options=\"required:true\" class=\"easyui-textarea\" rows=\"5\" cols=\"30\" name=\"unusual\"
                  id=\"unusual\"></textarea>
    </div>
    ";
        // line 195
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
<div id=\"dlg-buttons-unusual\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"submitF()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-unusual').dialog('close')\">取消</a>
</div>

<div id=\"dlg-prepare\" title=\"设置备货人\" class=\"easyui-dialog\" style=\"width:380px;height:auto;padding:10px 20px\"
     data-options=\"modal:true\" closed=\"true\" buttons=\"#dlg-buttons-prepare\">
    ";
        // line 204
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "unusual_form")), "method");
        echo "
    <div><label>操作</label>
        <select name=\"prepare\">
            <option value=\"罗丽媚\">罗丽媚</option>
            <option value=\"刘俊芬\">刘俊芬</option>
            <option value=\"刘俊波\">刘俊波</option>
            <option value=\"黄文俊\">黄文俊</option>
            <option value=\"丘露露\">丘露露</option>
            <option value=\"李莹\">李莹</option>
            <option value=\"黄国际\">黄国际</option>
            <option value=\"张晓霞\">张晓霞</option>
            <option value=\"何桂清\">何桂清</option>
            <option value=\"李明\">李明</option>
            <option value=\"饶兴咏\">饶兴咏</option>
            <option value=\"刘奇才\">刘奇才</option>
            <option value=\"刘俊波\">刘俊波</option>
        </select>
    </div>
    ";
        // line 222
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
<div id=\"dlg-buttons-prepare\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"submitP()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-prepare').dialog('close')\">取消</a>
</div>

";
    }

    // line 231
    public function block_js($context, array $blocks = array())
    {
        // line 232
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/order.js?v=160718\"></script>
<script>
    function reset() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误', '请选择一个');
            return false;
        }

        if (selRow.status == '已中奖' || selRow.status == '待确认') {
            \$.messager.alert('错误', '不可操作新中奖');
            return false;
        }

        \$.get('";
        // line 246
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("win/reset"), "html", null, true);
        echo "', {'id': selRow.id}, function (data) {
            if (data.error == 0) {
                \$.messager.alert('成功', data.message);
                \$(\"#listdata\").datagrid('reload');
            } else {
                \$.messager.alert('失败', data.message, 'error');
            }
        })
    }

    function submitP() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误', '请至少选择一个');
            return false;
        }

        var checkName = \$('select[name=prepare] option:selected').val();
        var checkArr = \$('#listdata').treegrid('getSelections');

        var ids = new Array();
        \$.each(checkArr, function (i, v) {
            ids.push(v.id);
        });

        \$.post(\"";
        // line 271
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("win/select-prepare"), "html", null, true);
        echo "\", {checkArr: ids, prepareName: checkName}, function (data) {
            if (data.error == 0) {
                \$.messager.alert('成功', data.message);
                \$('#dlg-prepare').dialog('close');
                reloadgrid();
            } else {
                \$.messager.alert('失败', data.message, 'error');
            }
        })
    }

    \$(function () {
        \$('#time').combo({
            disabled: false,
            required: true
        })
        \$('#fail').change(function () {
            var val = \$('#fail option:selected').val();
            if (val == 2) {
                \$('#time').combo({
                    disabled: true,
                })
            } else if (val == 1) {
                \$('#time').combo({
                    disabled: false,
                    required: true
                })
            }
        })
        \$.get('/win/delay', {}, function (data) {
        })
    })

    function submitF() {
        var form = 'unusual_form';
        var selRow = \$('#listdata').datagrid('getSelected');
        var url = '/win/unusual?id=' + selRow.id;
        \$('#' + form).form({
            url: url,
            onSubmit: function () {
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                var data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    \$('#dlg-unusual').dialog('close');
                    setTimeout(function () {
                        reloadgrid();
                    }, 2000);
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
    }

    \$('#fail').change(function () {
        var val = \$('#fail option:selected').val();
        if (val == 2) {
            \$('#time').combo({
                disabled: true
            })
        } else if (val == 1) {
            \$('#time').combo({
                disabled: false,
                required: true
            })
        }
    })

    \$('#prov').change(function () {
        pid = \$(this).children('option:selected').val();
        getAreaList(pid, 'city');
    });

    \$('#city').change(function () {
        pid = \$(this).children('option:selected').val();
        getAreaList(pid, 'area');
    });

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

    \$(\"#catlist\").combobox({

        onSelect: function (n,o) {
            var opts = \$(this).combobox('options');
            var pid = \$(\"#catlist\").combobox(\"getValue\");
            //alert(\$(\"#catlist2\"))
            \$('#catlist2').combobox('setValue', '全部');
            \$('#catlist2').combobox('loadData', '');
            \$.ajax({
                type: \"GET\",
                url: \"/order/category?pid=\"+pid,
                dataType: \"json\",
                success: function(msg){//console.log(msg);
                    if (msg.length > 0) {

                        \$(\"#catlist2\").combobox('loadData', msg);
                    }
                    // console.log(msg);
                }
            });

        }

    });
    function oderview(){

        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个');
            return false;
        }
        \$('#add_iframe').prop('src',  '/order/view?id=' + selRow.id);
        \$('#dlg-add').window('open');
        /*
         \$('#content_tabs').tabs('close', '查看订单');
         window.parent.addTab('查看订单', 'order/view?id=' + selRow.id);*/
    }

</script>
";
    }

    public function getTemplateName()
    {
        return "orders.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  348 => 271,  320 => 246,  302 => 232,  299 => 231,  287 => 222,  266 => 204,  254 => 195,  239 => 183,  140 => 87,  105 => 55,  70 => 22,  59 => 20,  55 => 19,  45 => 12,  41 => 11,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <style>*/
/*     .high {*/
/*         color: #009ACD*/
/*     }*/
/* </style>*/
/* <div style="padding:5px;height:auto">*/
/*     <a class="easyui-linkbutton l-btn l-btn-small l-btn-plain" style="color: red"  href="{{  url('jdorder/orders')}}">普通订单</a>*/
/*     <a class="easyui-linkbutton l-btn l-btn-small l-btn-plain" href="{{  url('jdorder/pkorders')}}">PK订单</a>*/
/* </div>*/
/* <div style="padding:5px;height:auto">*/
/*     <span>商品名称<input type="text" name="product_name" id="product_name" class="easyui-textbox"></span>*/
/*     <span>商品分类*/
/*         <select class="easyui-combobox" id="catlist" name="catlist" data-options="required:true,panelHeight:'auto'">*/
/*             <option value="">全部</option>*/
/*             {% for catlist in catlist %}*/
/*             <option value="{{catlist.id }}">{{ catlist.name }}</option>*/
/*             {% endfor %}*/
/*         </select>*/
/*       <select class="easyui-combobox" id="catlist2" name="catlist2"*/
/*               style="width: 60px" data-options="required:true,panelHeight:'auto'">*/
/*            <option value="">全部</option>*/
/*        </select>*/
/*     </span>*/
/*     <span>商品当前期号<input type="text" name="period_no" id="period_no" class="easyui-textbox"></span>*/
/*     <span   style="display: none">发货方式*/
/*         <select class="easyui-combobox" id="deliver" name="deliver" data-options="required:true,panelHeight:'auto'">*/
/*             <option value="8">京东卡密</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>时间选择*/
/*         <select class="easyui-combobox" id="time_type" name="time" data-options="required:true,panelHeight:'auto'">*/
/*             <option value="">时间选择</option>*/
/*             <option value="1">中奖时间</option>*/
/*             <option value="2">备货时间</option>*/
/*             <option value="3">发货时间</option>*/
/*             <option value="4">发票时间</option>*/
/*         </select>*/
/*     </span>*/
/*         <span>订单类别*/
/*         <select class="easyui-combobox" id="order_type" name="order_type" data-options="required:true,panelHeight:'auto'">*/
/*             <option value="">全部</option>*/
/*             <option value="1">回购订单</option>*/
/*             <option value="2">卡密订单</option>*/
/*         </select>*/
/*     </span><br/>*/
/*     <span>开始时间<input type="text" name="startTime" id="startTime" class="easyui-datetimebox"></span>*/
/*     <span>结束时间<input type="text" name="endTime" id="endTime" class="easyui-datetimebox"></span>*/
/*     <span>订单号<input type="text" name="order" id="order" class="easyui-textbox"></span>*/
/*     <span>备货人<input type="text" name="prepare_userid" id="prepare_userid" class="easyui-textbox"></span>*/
/*     <span>用户<input type="text" name="name" id="name" class="easyui-textbox"></span>*/
/*     <!--<span>商品分类<input class="easyui-combotree" name="cat_id" id="cat_id" data-options="url:'{{ url('product-category/all-list') }}',method:'get'" editable="true"></span>-->*/
/*     <span>类别*/
/*         <select class="easyui-combobox" id="types" name="types" data-options="required:true,panelHeight:'auto'">*/
/*             <option value="">全部</option>*/
/*             <option value="1">实体</option>*/
/*             <option value="2">虚拟物品</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>站点*/
/*         <select class="easyui-combobox" id="from" name="from" data-options="required:true,panelHeight:'auto'">*/
/*             <option value="">所有</option>*/
/*             <option value="1">伙购网</option>*/
/*             <option value="2">滴滴夺宝</option>*/
/*         </select>*/
/*     </span>*/
/*     <input type="hidden" name="sub" value="sub" id="sub">*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="dataexcel();">导出</a>*/
/* </div>*/
/* */
/* <div style="width:auto;height:auto" class="rem">*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all">全部</a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="0">新中奖 </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="1">待确认 </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="2">备货 </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="3">发货 </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="4">待收货 </a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="5">待晒单</a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="6">异常订单</a>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="8">已完成</a>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="中奖列表"*/
/*        data-options="toolbar:'#tb-user',pagination:true,method:'get',url:'{{  url('jdorder/orders')}}',pageSize:20,checkOnSelect:true,singleSelect:true">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'ck', checkbox:true"></th>*/
/*         <th data-options="field:'id', width:80, align:'center'" formatter="formatChange">订单号</th>*/
/*         <th data-options="field:'from', width:80, align:'center'" formatter="formatFrom">站点</th>*/
/*         <th data-options="field:'name', width:300, align:'center'">商品名称</th>*/
/*         <th data-options="field:'cat_id', width:150, align:'center'">分类</th>*/
/*         <th data-options="field:'phone', width:100, align:'center'" formatter="formatUsername">会员手机</th>*/
/*         <th data-options="field:'period_number', width:50, align:'center'">期数</th>*/
/*         <th data-options="field:'period_no', width:90, align:'center'">当前期号</th>*/
/*         <th data-options="field:'code', width:100, align:'center'">伙购码</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'delivery', width:100, align:'center'">发货方式</th>*/
/*         <th data-options="field:'create_time', width:200, align:'center'">中奖时间</th>*/
/*         <th data-options="field:'confirm_addr_time', width:200, align:'center'">确认地址时间</th>*/
/*         <th data-options="field:'select_prepare', width:100, align:'center'">备发货操作人</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true"*/
/*            onclick="oderview()">查看</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-unusual',plain:true"*/
/*            onclick="setUnusual()" id="unusualBtn">设为异常</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" id="reset" data-options="iconCls:'icon-ok',plain:true"*/
/*            onclick="reset()" style="display: none">重置订单</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" id="prepare" data-options="iconCls:'icon-ok',plain:true"*/
/*            onclick="javascript:$('#dlg-prepare').dialog('open')" style="display: none">选取备货人</a>*/
/*         <!--<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-address',plain:true" onclick="addAddressShow();" id="add-address">送货地址</a>-->*/
/*     </div>*/
/* </div>*/
/* */
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
/* */
/* <div id="dlg-address" title="填写收货地址" class="easyui-dialog" style="width:500px;height:auto;padding:10px 20px"*/
/*      closed="true" buttons="#dlg-buttons-address">*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>选择区域</td>*/
/*             <td>*/
/*                 <select id="prov" name="prov"></select>*/
/*                 <select id="city" name="city"></select>*/
/*                 <select id="area" name="area"></select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>详细地址</td>*/
/*             <td><input class="easyui-textbox" type="text" id="ship_addr" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>收货人</td>*/
/*             <td><input class="easyui-textbox" type="text" id="ship_name" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>联系电话</td>*/
/*             <td><input class="easyui-textbox" type="text" id="ship_phone"*/
/*                        data-options="required:true,validType:'phoneRex'"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>送货时间</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" id="ship_time" style="width:170px;">*/
/*                     <option value="时间不限">时间不限</option>*/
/*                     <option value="周一至周五">周一至周五</option>*/
/*                     <option value="周末及公众假日">周末及公众假日</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>备注</td>*/
/*             <td>*/
/*                 <textarea class="easyui-textarea" rows="5" cols="20" id="remark"></textarea>*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/* </div>*/
/* */
/* <div id="dlg-buttons-address" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="saveAddress()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-address').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* <div id="dlg-unusual" title="异常订单" class="easyui-dialog" style="width:380px;height:auto;padding:10px 20px"*/
/*      data-options="modal:true" closed="true" buttons="#dlg-buttons-unusual">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'unusual_form'}) | raw }}*/
/*     <div><label>操作</label>*/
/*         <select name="un_fail" id="fail">*/
/*             <option value="1">待办</option>*/
/*             <option value="2">冻结</option>*/
/*         </select>*/
/*         <input class="easyui-datetimebox" name="afterTime" id="time">*/
/*     </div>*/
/*     <div><label>备注</label>*/
/*         <textarea data-options="required:true" class="easyui-textarea" rows="5" cols="30" name="unusual"*/
/*                   id="unusual"></textarea>*/
/*     </div>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* <div id="dlg-buttons-unusual" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="submitF()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-unusual').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* <div id="dlg-prepare" title="设置备货人" class="easyui-dialog" style="width:380px;height:auto;padding:10px 20px"*/
/*      data-options="modal:true" closed="true" buttons="#dlg-buttons-prepare">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'unusual_form'}) | raw }}*/
/*     <div><label>操作</label>*/
/*         <select name="prepare">*/
/*             <option value="罗丽媚">罗丽媚</option>*/
/*             <option value="刘俊芬">刘俊芬</option>*/
/*             <option value="刘俊波">刘俊波</option>*/
/*             <option value="黄文俊">黄文俊</option>*/
/*             <option value="丘露露">丘露露</option>*/
/*             <option value="李莹">李莹</option>*/
/*             <option value="黄国际">黄国际</option>*/
/*             <option value="张晓霞">张晓霞</option>*/
/*             <option value="何桂清">何桂清</option>*/
/*             <option value="李明">李明</option>*/
/*             <option value="饶兴咏">饶兴咏</option>*/
/*             <option value="刘奇才">刘奇才</option>*/
/*             <option value="刘俊波">刘俊波</option>*/
/*         </select>*/
/*     </div>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* <div id="dlg-buttons-prepare" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="submitP()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-prepare').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script src="{{ app.params.skinUrl }}/js/order.js?v=160718"></script>*/
/* <script>*/
/*     function reset() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误', '请选择一个');*/
/*             return false;*/
/*         }*/
/* */
/*         if (selRow.status == '已中奖' || selRow.status == '待确认') {*/
/*             $.messager.alert('错误', '不可操作新中奖');*/
/*             return false;*/
/*         }*/
/* */
/*         $.get('{{ url("win/reset") }}', {'id': selRow.id}, function (data) {*/
/*             if (data.error == 0) {*/
/*                 $.messager.alert('成功', data.message);*/
/*                 $("#listdata").datagrid('reload');*/
/*             } else {*/
/*                 $.messager.alert('失败', data.message, 'error');*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     function submitP() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误', '请至少选择一个');*/
/*             return false;*/
/*         }*/
/* */
/*         var checkName = $('select[name=prepare] option:selected').val();*/
/*         var checkArr = $('#listdata').treegrid('getSelections');*/
/* */
/*         var ids = new Array();*/
/*         $.each(checkArr, function (i, v) {*/
/*             ids.push(v.id);*/
/*         });*/
/* */
/*         $.post("{{ url('win/select-prepare') }}", {checkArr: ids, prepareName: checkName}, function (data) {*/
/*             if (data.error == 0) {*/
/*                 $.messager.alert('成功', data.message);*/
/*                 $('#dlg-prepare').dialog('close');*/
/*                 reloadgrid();*/
/*             } else {*/
/*                 $.messager.alert('失败', data.message, 'error');*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     $(function () {*/
/*         $('#time').combo({*/
/*             disabled: false,*/
/*             required: true*/
/*         })*/
/*         $('#fail').change(function () {*/
/*             var val = $('#fail option:selected').val();*/
/*             if (val == 2) {*/
/*                 $('#time').combo({*/
/*                     disabled: true,*/
/*                 })*/
/*             } else if (val == 1) {*/
/*                 $('#time').combo({*/
/*                     disabled: false,*/
/*                     required: true*/
/*                 })*/
/*             }*/
/*         })*/
/*         $.get('/win/delay', {}, function (data) {*/
/*         })*/
/*     })*/
/* */
/*     function submitF() {*/
/*         var form = 'unusual_form';*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         var url = '/win/unusual?id=' + selRow.id;*/
/*         $('#' + form).form({*/
/*             url: url,*/
/*             onSubmit: function () {*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 var data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     $('#dlg-unusual').dialog('close');*/
/*                     setTimeout(function () {*/
/*                         reloadgrid();*/
/*                     }, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* */
/*     $('#fail').change(function () {*/
/*         var val = $('#fail option:selected').val();*/
/*         if (val == 2) {*/
/*             $('#time').combo({*/
/*                 disabled: true*/
/*             })*/
/*         } else if (val == 1) {*/
/*             $('#time').combo({*/
/*                 disabled: false,*/
/*                 required: true*/
/*             })*/
/*         }*/
/*     })*/
/* */
/*     $('#prov').change(function () {*/
/*         pid = $(this).children('option:selected').val();*/
/*         getAreaList(pid, 'city');*/
/*     });*/
/* */
/*     $('#city').change(function () {*/
/*         pid = $(this).children('option:selected').val();*/
/*         getAreaList(pid, 'area');*/
/*     });*/
/* */
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
/* */
/*     $("#catlist").combobox({*/
/* */
/*         onSelect: function (n,o) {*/
/*             var opts = $(this).combobox('options');*/
/*             var pid = $("#catlist").combobox("getValue");*/
/*             //alert($("#catlist2"))*/
/*             $('#catlist2').combobox('setValue', '全部');*/
/*             $('#catlist2').combobox('loadData', '');*/
/*             $.ajax({*/
/*                 type: "GET",*/
/*                 url: "/order/category?pid="+pid,*/
/*                 dataType: "json",*/
/*                 success: function(msg){//console.log(msg);*/
/*                     if (msg.length > 0) {*/
/* */
/*                         $("#catlist2").combobox('loadData', msg);*/
/*                     }*/
/*                     // console.log(msg);*/
/*                 }*/
/*             });*/
/* */
/*         }*/
/* */
/*     });*/
/*     function oderview(){*/
/* */
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个');*/
/*             return false;*/
/*         }*/
/*         $('#add_iframe').prop('src',  '/order/view?id=' + selRow.id);*/
/*         $('#dlg-add').window('open');*/
/*         /**/
/*          $('#content_tabs').tabs('close', '查看订单');*/
/*          window.parent.addTab('查看订单', 'order/view?id=' + selRow.id);*//* */
/*     }*/
/* */
/* </script>*/
/* {% endblock %}*/
/* */
/* */
