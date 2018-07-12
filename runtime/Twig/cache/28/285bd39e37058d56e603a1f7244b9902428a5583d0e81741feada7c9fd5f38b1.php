<?php

/* edit.html */
class __TwigTemplate_1a1e30dc4820ec3bde57e4f37f511762ad53bb18a94e9bfdcc87d350858a532b extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "edit.html", 1);
        $this->blocks = array(
            'css' => array($this, 'block_css'),
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

    // line 2
    public function block_css($context, array $blocks = array())
    {
        // line 3
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/css/admin.css\">
<style>
html { overflow-x:hidden; }
</style>
";
    }

    // line 8
    public function block_main($context, array $blocks = array())
    {
        // line 9
        echo "<div id=\"coupon_add\" title=\"添加优惠券\" style=\"width: 780px;height: auto;overflow: auto;\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 10
        if ((isset($context["couponId"]) ? $context["couponId"] : null)) {
            // line 11
            echo "    ";
            echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm", "enctype" => "multipart/form-data")), "method");
            echo "
    ";
        } else {
            // line 13
            echo "    ";
            echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "add", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm", "enctype" => "multipart/form-data")), "method");
            echo "
    ";
        }
        // line 15
        echo "    <input type=\"hidden\" name=\"type_id\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["typeInfo"]) ? $context["typeInfo"] : null), "id", array(), "array"), "html", null, true);
        echo "\">
    <input type=\"hidden\" name=\"id\" value=\"\">
    <table cellSpacing=10>
        <tr>
            <th width=\"80px\">优惠券类型</th>
            <td colspan=\"2\" id=\"typeName\">";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["typeInfo"]) ? $context["typeInfo"] : null), "name", array(), "array"), "html", null, true);
        echo "</td>
            <td></td>
        </tr>
        <tr>
            <th>优惠券图标</th>
            <td colspan=\"2\">
                <input type=\"text\" class=\"easyui-filebox\" name=\"icon\">
            </td> 
        </tr>
        <tr>
            <th>优惠券名称</th>
            <td colspan=\"2\"><input class=\"easyui-textbox\" type=\"text\" name=\"name\" id=\"name\" data-options=\"required:true\"></td>
            <td></td>
        </tr>
        <tr id=\"amount\">
            ";
        // line 35
        if (($this->getAttribute((isset($context["typeInfo"]) ? $context["typeInfo"] : null), "id", array(), "array") == 3)) {
            // line 36
            echo "                <th>兑换</th> 
                <td colspan=\"2\">
                    <select name=\"recharge_type\" class=\"easyui-combobox\" id=\"recharge_type\">
                        <option value=\"point\">福分</option>
                        <option value=\"money\">余额</option>
                    </select>
                    <input type=\"text\" class=\"easyui-textbox\" name=\"amount\" id=\"quota\" data-options=\"required:true\">
                </td>
            ";
        } else {
            // line 45
            echo "            <th>优惠券额度</th>
            <td colspan=\"2\">
                <input class=\"easyui-numberbox\" type=\"text\" name=\"amount\" id=\"quota\" data-options=\"required:true\">
                ";
            // line 48
            if (($this->getAttribute((isset($context["typeInfo"]) ? $context["typeInfo"] : null), "id", array(), "array") == 2)) {
                // line 49
                echo "                <span>最多抵扣<input type=\"text\" value=\"0\" class=\"easyui-numberbox\" id=\"max\" name=\"max\"></span>
                ";
            }
            // line 51
            echo "            ";
        }
        // line 52
        echo "            </td>
            <td id=\"amount_intr\">
            \t";
        // line 54
        if (($this->getAttribute((isset($context["typeInfo"]) ? $context["typeInfo"] : null), "id", array(), "array") == 1)) {
            // line 55
            echo "            \t抵扣金额，值必须为整数
            \t";
        } elseif (($this->getAttribute(        // line 56
(isset($context["typeInfo"]) ? $context["typeInfo"] : null), "id", array(), "array") == 2)) {
            // line 57
            echo "            \t折扣额度，值范围为1-99,不设置最多抵扣，则完全按照折扣计算
            \t";
        } elseif (($this->getAttribute(        // line 58
(isset($context["typeInfo"]) ? $context["typeInfo"] : null), "id", array(), "array") == 3)) {
            // line 59
            echo "\t\t\t\t赠送金额
            \t";
        }
        // line 61
        echo "            </td>
        </tr>
        ";
        // line 63
        if ((($this->getAttribute((isset($context["typeInfo"]) ? $context["typeInfo"] : null), "id", array(), "array") == 1) || ($this->getAttribute((isset($context["typeInfo"]) ? $context["typeInfo"] : null), "id", array(), "array") == 2))) {
            // line 64
            echo "        <tr id=\"condition\">
            <th rowspan=\"2\">使用条件</th>
            <td width=\"60px\">满多少可用</td>
            <td><input type=\"text\" class=\"easyui-textbox\" value=\"0\" name=\"need\" id=\"need\"></td>
            <td>订单满足多少金额可用，默认为任意金额可用</td>
        </tr>
        <tr id=\"range\">
            <td>使用范围</td>
            <td>
                <input type=\"checkbox\" class=\"easyui-checkbox\" name=\"range[]\" value=\"1\" checked=\"checked\">全部<br/>
                <input type=\"checkbox\" class=\"easyui-checkbox\" name=\"range[]\" value=\"2\">限购专区<br/>
                <input type=\"checkbox\" class=\"easyui-checkbox\" name=\"range[]\" value=\"3\">十元专区<br/>
                <input type=\"checkbox\" class=\"easyui-checkbox\" name=\"range[]\" value=\"4\">选择商品   <a id=\"addProduct\" class=\"easyui-linkbutton\">添加商品</a><br/>
                <input type=\"checkbox\" class=\"easyui-checkbox\" name=\"range[]\" value=\"5\">选择PK商品   <a id=\"addPkProduct\" class=\"easyui-linkbutton\">添加Pk商品</a><br/>

                <ul id=\"products\" style=\"list-style: none;padding: 0\"></ul>
                <ul id=\"pk_products\" style=\"list-style: none;padding: 0\"></ul>
        </td>
            <td>默认全部商品可用</td>
        </tr> 
        ";
        }
        // line 85
        echo "        <tr>
            <th>有效期</th>
            <td colspan=\"2\">
                <input type=\"radio\" class=\"time\" name=\"time\" value=\"1\" checked><input class=\"easyui-datetimebox\" type=\"text\" data-options=\"required:true\" id=\"starttime\" name=\"starttime\">到<input class=\"easyui-datetimebox\" type=\"text\" data-options=\"required:true\" id=\"endtime\" name=\"endtime\"><br/><br/>
                <input type=\"radio\" class=\"time\" name=\"time\" value=\"2\"><input class=\"easyui-textbox\" type=\"text\" name=\"valid\" id=\"valid\" data-options=\"required:true,disabled:true\" id=\"type\">
            </td>
            <td>可选择绝对时间段或者用户领取后多少天内可用</td>
        </tr>
        <tr>
            <th>使用说明</th>
            <td colspan=\"2\">
                <textarea rows=\"10\" cols=\"60\" name=\"desc\" data-options=\"required:true\" id=\"desc\"></textarea>
            </td>
            <td>优惠券使用详细说明</td>
        </tr>
        <tr>
            <th>生成数量</th>
            <td colspan=\"2\"><input class=\"easyui-textbox\" type=\"text\" name=\"nums\" id=\"nums\" data-options=\"required:true\" value=\"0\"></td>
            <td>数量为0，则为不限</td>
        </tr>
        <tr>
            <th>领取数量</th>
            <td colspan=\"2\"><input class=\"easyui-textbox\" type=\"text\" name=\"limit\" id=\"limit\" data-options=\"required:true\" value=\"1\"></td>
            <td>每人可领取数量，默认为1（只对直接领取优惠券生效，如果是红包领取则不生效）</td>
        </tr>
    </table>
    ";
        // line 111
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    ";
        // line 115
        if ((isset($context["couponId"]) ? $context["couponId"] : null)) {
            // line 116
            echo "    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('edit')\">保存</a>
    ";
        } else {
            // line 118
            echo "    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">添加</a>
    ";
        }
        // line 120
        echo "    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:window.parent.location.reload();\">取消</a>
</div>

<div id=\"choose_product\" title=\"选择商品\"  class=\"easyui-dialog\" modal=\"true\" closed=\"true\" style=\"width: 700px;height: auto;\">
    <div style=\"padding: 10px;\">
        名称<input type=\"text\" class=\"easyui-textbox\" name=\"keywords\">
        商品编号<input type=\"text\" class=\"easyui-textbox\" name=\"sn\">
        <input type=\"button\" class=\"easyui-linkbutton\" iconCls=\"icon-search\" style=\"padding: 5px 10px\" value=\"搜索\" id=\"search\">
    </div>
    <table id=\"search_result\" cellSpacing=0 cellpadding=8 align=\"center\" border=\"1\" style=\"margin: 10px\">
        <thead>
            <tr>
                <th width=\"20\" align=\"center\"></th>
                <th width=\"80\" align=\"center\">商品编号</th>
                <th width=\"500\" align=\"center\">商品名称</th>
                <th width=\"80\" align=\"center\">类型</th>                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <div id=\"dlg-buttons-add-product\" style=\"text-align:center;padding:5px\">
        <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"javascript:;chooseProduct()\">确定</a>
        <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#choose_product').dialog('close');\">取消</a>
    </div>
</div>

<div id=\"choose_pk_product\" title=\"选择pk商品\"  class=\"easyui-dialog\" modal=\"true\" closed=\"true\" style=\"width: 700px;height: auto;\">
    <div style=\"padding: 10px;\">
        名称<input type=\"text\" class=\"easyui-textbox\" name=\"keywords\">
        商品编号<input type=\"text\" class=\"easyui-textbox\" name=\"sn\">
        <input type=\"button\" class=\"easyui-linkbutton\" iconCls=\"icon-search\" style=\"padding: 5px 10px\" value=\"搜索\" id=\"pk_search\">
    </div>
    <table id=\"search_pk_result\" cellSpacing=0 cellpadding=8 align=\"center\" border=\"1\" style=\"margin: 10px\">
        <thead>
        <tr>
            <th width=\"20\" align=\"center\"></th>
            <th width=\"80\" align=\"center\">商品编号</th>
            <th width=\"500\" align=\"center\">商品名称</th>
            <th width=\"80\" align=\"center\">类型</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
    <div id=\"dlg-buttons-add-pk-product\" style=\"text-align:center;padding:5px\">
        <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"javascript:;choosePkProduct()\">确定</a>
        <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#choose_pk_product').dialog('close');\">取消</a>
    </div>
</div>

";
    }

    // line 171
    public function block_js($context, array $blocks = array())
    {
        // line 172
        echo "<script type=\"text/javascript\">
    \$(function(){
        \$(\"input[name=time]\").click(function(){
            if (\$(this).val() == 1) {
                \$('#endtime').datetimebox({disabled:false, required:true});
                \$('#starttime').datetimebox({disabled:false, required:true});
                \$('#valid').textbox({disabled:true});
            }else if (\$(this).val() == 2) {
                \$('#valid').textbox({disabled:false});
                \$('#endtime').datetimebox({disabled:true});
                \$('#starttime').datetimebox({disabled:true});
            }
        })
        var couponId = \"";
        // line 185
        echo twig_escape_filter($this->env, (isset($context["couponId"]) ? $context["couponId"] : null), "html", null, true);
        echo "\";
        if (couponId) {
            \$.get('/coupon/info',{id:couponId},function(data){
                // \$(\"input[name=type_id]\").val(data.type);
                console.log(data)
                \$(\"input[name=id]\").val(data.id);
                \$(\"#name\").textbox({value:data.name});
                if (data.type == 1 || data.type == 2) {
                    if (data.type == 1) {
                        \$(\"#quota\").textbox({value:data.amount.money});
                    }else if (data.type == 2) {
                        \$(\"#quota\").textbox({value:data.amount.discount});
                        \$(\"#max\").textbox({value:data.amount.max});
                    }
                    \$(\"#need\").textbox({value:data.condition.need});
                    var rangeArr = data.condition.range.split(',');
                    console.log(data)
                    if (\$.inArray('1',rangeArr)>=0) {
                        \$(\"#range input[value=1]\").prop('checked','checked');
                    } else {
                        if (\$.inArray('4',rangeArr)>=0 || \$.inArray('5', rangeArr)>=0) {
                            if (\$.inArray('4',rangeArr)>=0) {
                                \$(\"#range input[value=4]\").prop('checked','checked');
                                \$(\"#range input[type=checkbox]\").eq(0).prop('checked','');
                                \$(\"#range input[type=checkbox]\").eq(1).prop('checked','');
                                \$(\"#range input[type=checkbox]\").eq(2).prop('checked','');
                                var html = \"\";
                                var productIdsArr = data.condition.products.split(',');
                                for(var i=0;i<productIdsArr.length;i++) {
                                    var productId = productIdsArr[i];
                                    html += '<li><input type=\"hidden\" name=\"products[]\" value=\"'+productId+'\">商品ID'+productId+' <a onclick=\"javascript:\$(this).parent().remove();\">删除</a></li>';
                                }
                                \$(\"#products\").append(html);
                            }
                            if (\$.inArray('5', rangeArr)>=0) {
                                \$(\"#range input[value=5]\").prop('checked','checked');
                                \$(\"#range input[type=checkbox]\").eq(0).prop('checked','');
                                \$(\"#range input[type=checkbox]\").eq(1).prop('checked','');
                                \$(\"#range input[type=checkbox]\").eq(2).prop('checked','');

                                var html = \"\";
                                var productIdsArr = data.condition.pk_products.split(',');
                                for(var i=0;i<productIdsArr.length;i++) {
                                    var productId = productIdsArr[i];
                                    html += '<li><input type=\"hidden\" name=\"pk_products[]\" value=\"'+productId+'\">[PK]商品ID'+productId+' <a onclick=\"javascript:\$(this).parent().remove();\">删除</a></li>';
                                }
                                \$(\"#pk_products\").append(html);
                            }
                        }else {
                            if (\$.inArray('2',rangeArr)>=0) {
                                \$(\"#range input[value=2]\").prop('checked','checked');
                            }
                            if (\$.inArray('3',rangeArr)>=0) {
                                \$(\"#range input[value=3]\").prop('checked','checked');
                            }
                        }

                    }

                }else if (data.type == 3) {
                     \$(\"#quota\").textbox({value:data.amount.amount});
                     \$(\"#recharge_type\").combobox({value:data.amount.type});
                     // \$.each(\$(\"#recharge_type option\"),function(data){
                     //    if (\$(this).val() == data.amount.point) {
                     //        \$(this).prop('selected', 'selected');
                     //    }
                     // })
                }
                if (data.valid_type == 1) {
                    \$(\".time:eq(0)\").prop('checked', 'checked');
                    \$(\"#starttime\").textbox({value:data.start_time});
                    \$(\"#endtime\").textbox({value:data.end_time});
                }else if (data.valid_type == 2) {
                    \$(\".time:eq(1)\").prop('checked', 'checked');
                    \$(\"#valid\").textbox({value:data.valid});
                }
                \$(\"#desc\").val(data.desc);
                \$(\"#nums\").textbox({value:data.num});
                \$(\"#limit\").textbox({value:data.receive_limit});

            },'json')
        }
        
        \$(\"#range input[type=checkbox]\").click(function(){
            if (\$(this).val() == 4 && \$(this).prop('checked') == true) {
                \$(\"#range input[type=checkbox]\").eq(0).prop('checked','');
                \$(\"#range input[type=checkbox]\").eq(1).prop('checked','');
                \$(\"#range input[type=checkbox]\").eq(2).prop('checked','');
                \$('#choose_product').dialog('open');
            } else if (\$(this).val() == 5 && \$(this).prop('checked') == true) {
                \$(\"#range input[type=checkbox]\").eq(0).prop('checked','');
                \$(\"#range input[type=checkbox]\").eq(1).prop('checked','');
                \$(\"#range input[type=checkbox]\").eq(2).prop('checked','');
                \$('#choose_pk_product').dialog('open');
            }else{
                \$(\"#range input[type=checkbox]\").eq(3).prop('checked','');
                \$(\"#range input[type=checkbox]\").eq(4).prop('checked','');
            }
        })
        \$(\"#addProduct\").click(function(){
            \$(\"#range input[type=checkbox]\").eq(0).prop('checked','');
            \$(\"#range input[type=checkbox]\").eq(1).prop('checked','');
            \$(\"#range input[type=checkbox]\").eq(2).prop('checked','');
            \$('#choose_product').dialog('open');
            \$(\"#range input[type=checkbox]\").eq(3).prop('checked','true');
        })
        \$(\"#addPkProduct\").click(function(){
            \$(\"#range input[type=checkbox]\").eq(0).prop('checked','');
            \$(\"#range input[type=checkbox]\").eq(1).prop('checked','');
            \$(\"#range input[type=checkbox]\").eq(2).prop('checked','');
            \$('#choose_pk_product').dialog('open');
            \$(\"#range input[type=checkbox]\").eq(4).prop('checked','true');
        })
        \$(\"#search\").click(function(){
            \$.post('/product/search', {keywords: \$(\"#choose_product input[name=keywords]\").val(),sn:\$(\"#choose_product input[name=sn]\").val()}, function(data) {
                if (data.length > 0) {
                    var html = \"\";
                    \$.each(data,function(i,v){
                        html += '<tr>';
                        html += '<td>';
                        html += '<input type=\"checkbox\" name=\"products\" pid=\"'+v.id+'\" title=\"'+v.name+'\">';
                        html += '</td>';
                        html += '<td align=\"center\">';
                        html += v.bn;
                        html += '</td>';
                        html += '<td>';
                        html += v.name;
                        html += '</td>';
                        html += '<td align=\"center\">';
                        if (v.limit_num > 0) {
                            html += '限购';
                        }
                        if (v.buy_unit == 10) {
                            html += '10元专区';
                        }
                        if (v.limit_num == 0 && v.buy_unit == 1) {
                            html += '普通';
                        }
                        html += '</td>';
                    })
                    \$(\"#search_result tbody\").html(html);
                }else{
                    \$(\"#search_result tbody\").html('<tr><td colspan=\"4\" align=\"center\">暂无数据</td></tr>');
                }
            },'json');
        })

        \$(\"#pk_search\").click(function(){
            \$.post('/activityproduct/pk-search', {keywords: \$(\"#choose_pk_product input[name=keywords]\").val(),sn:\$(\"#choose_pk_product input[name=sn]\").val()}, function(data) {
                if (data.length > 0) {
                    var html = \"\";
                    \$.each(data,function(i,v){
                        html += '<tr>';
                        html += '<td>';
                        html += '<input type=\"checkbox\" name=\"products\" pid=\"'+v.id+'\" title=\"'+v.name+'\">';
                        html += '</td>';
                        html += '<td align=\"center\">';
                        html += v.bn;
                        html += '</td>';
                        html += '<td>';
                        html += v.name;
                        html += '</td>';
                        html += '<td align=\"center\">';
                        html += '</td>';
                    })
                    \$(\"#search_pk_result tbody\").html(html);
                }else{
                    \$(\"#search_pk_result tbody\").html('<tr><td colspan=\"4\" align=\"center\">暂无数据</td></tr>');
                }
            },'json');
        })
    })
    function save(type){
        if (type == 'add') {
        \t\$(\"#addForm\").form('submit',{
        \t\tsuccess:function(data){
                    data = eval(\"(\" + data + \")\");
                    if (data.code == 100) {
            \t\t\t\$.messager.alert('添加成功', '优惠券添加成功', 'success');
                    }else{
                        \$.messager.alert('添加失败', '优惠券添加失败', 'fail');
                    }
        \t\t}
        \t})
        }else if (type == 'edit') {
            \$(\"#editForm\").form('submit',{
                success:function(data){
                    data = \$.parseJSON(data);
                    if (data.code == 100) {
                        \$.messager.alert('保存成功', '优惠券保存成功', 'success');
                        setTimeout(function(){window.parent.location.reload()}, 2000);
                    }else{
                        \$.messager.alert('保存失败', '优惠券保存失败', 'fail');
                    }
                }
            })
        }
    }
    function chooseProduct(){
        var choosedProducts = '';
        \$(\"#products li input\").each(function(){
            choosedProducts += \$(this).val() + ',';
        })
        var choosedProductsArr = choosedProducts.split(',');
        \$(\"#choose_product input:checkbox:checked\").each(function(){
            var pid = \$(this).attr('pid');
            if (\$.inArray(pid,choosedProductsArr) >= 0) {
                \$.messager.alert('不能重复选择','不能重复选择');
            }else{
                var html = \"\";
                html += '<li><input type=\"hidden\" name=\"products[]\" value=\"'+pid+'\">'+\$(this).attr('title')+'<a onclick=\"javascript:;\">删除</a></li>';
                \$(\"#products\").append(html);
            }
        })
        \$('#choose_product').dialog('close');
    }
    function choosePkProduct(){
        var choosedProducts = '';
        \$(\"#pk_products li input\").each(function(){
            choosedProducts += \$(this).val() + ',';
        })
        var choosedProductsArr = choosedProducts.split(',');
        \$(\"#choose_pk_product input:checkbox:checked\").each(function(){
            var pid = \$(this).attr('pid');
            if (\$.inArray(pid,choosedProductsArr) >= 0) {
                \$.messager.alert('不能重复选择','不能重复选择');
            }else{
                var html = \"\";
                html += '<li><input type=\"hidden\" name=\"pk_products[]\" value=\"'+pid+'\">[PK]'+\$(this).attr('title')+'<a onclick=\"javascript:;\">删除</a></li>';
                \$(\"#pk_products\").append(html);
            }
        })
        \$('#choose_pk_product').dialog('close');
    }
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
        return array (  282 => 185,  267 => 172,  264 => 171,  211 => 120,  207 => 118,  203 => 116,  201 => 115,  194 => 111,  166 => 85,  143 => 64,  141 => 63,  137 => 61,  133 => 59,  131 => 58,  128 => 57,  126 => 56,  123 => 55,  121 => 54,  117 => 52,  114 => 51,  110 => 49,  108 => 48,  103 => 45,  92 => 36,  90 => 35,  72 => 20,  63 => 15,  57 => 13,  51 => 11,  49 => 10,  46 => 9,  43 => 8,  33 => 3,  30 => 2,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* {% block css %}*/
/* <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/css/admin.css">*/
/* <style>*/
/* html { overflow-x:hidden; }*/
/* </style>*/
/* {% endblock %}*/
/* {% block main %}*/
/* <div id="coupon_add" title="添加优惠券" style="width: 780px;height: auto;overflow: auto;" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {% if couponId  %}*/
/*     {{ html.beginForm('','post',{'class':'am-form am-form-horizontal', 'id':'editForm', 'enctype':"multipart/form-data"}) | raw }}*/
/*     {% else %}*/
/*     {{ html.beginForm('add','post',{'class':'am-form am-form-horizontal', 'id':'addForm', 'enctype':"multipart/form-data"}) | raw }}*/
/*     {% endif %}*/
/*     <input type="hidden" name="type_id" value="{{ typeInfo['id'] }}">*/
/*     <input type="hidden" name="id" value="">*/
/*     <table cellSpacing=10>*/
/*         <tr>*/
/*             <th width="80px">优惠券类型</th>*/
/*             <td colspan="2" id="typeName">{{ typeInfo['name'] }}</td>*/
/*             <td></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th>优惠券图标</th>*/
/*             <td colspan="2">*/
/*                 <input type="text" class="easyui-filebox" name="icon">*/
/*             </td> */
/*         </tr>*/
/*         <tr>*/
/*             <th>优惠券名称</th>*/
/*             <td colspan="2"><input class="easyui-textbox" type="text" name="name" id="name" data-options="required:true"></td>*/
/*             <td></td>*/
/*         </tr>*/
/*         <tr id="amount">*/
/*             {% if typeInfo['id'] == 3 %}*/
/*                 <th>兑换</th> */
/*                 <td colspan="2">*/
/*                     <select name="recharge_type" class="easyui-combobox" id="recharge_type">*/
/*                         <option value="point">福分</option>*/
/*                         <option value="money">余额</option>*/
/*                     </select>*/
/*                     <input type="text" class="easyui-textbox" name="amount" id="quota" data-options="required:true">*/
/*                 </td>*/
/*             {% else %}*/
/*             <th>优惠券额度</th>*/
/*             <td colspan="2">*/
/*                 <input class="easyui-numberbox" type="text" name="amount" id="quota" data-options="required:true">*/
/*                 {% if typeInfo['id'] == 2 %}*/
/*                 <span>最多抵扣<input type="text" value="0" class="easyui-numberbox" id="max" name="max"></span>*/
/*                 {% endif %}*/
/*             {% endif %}*/
/*             </td>*/
/*             <td id="amount_intr">*/
/*             	{% if typeInfo['id'] == 1 %}*/
/*             	抵扣金额，值必须为整数*/
/*             	{% elseif typeInfo['id'] == 2 %}*/
/*             	折扣额度，值范围为1-99,不设置最多抵扣，则完全按照折扣计算*/
/*             	{% elseif typeInfo['id'] == 3 %}*/
/* 				赠送金额*/
/*             	{% endif %}*/
/*             </td>*/
/*         </tr>*/
/*         {% if typeInfo['id'] == 1 or typeInfo['id'] == 2 %}*/
/*         <tr id="condition">*/
/*             <th rowspan="2">使用条件</th>*/
/*             <td width="60px">满多少可用</td>*/
/*             <td><input type="text" class="easyui-textbox" value="0" name="need" id="need"></td>*/
/*             <td>订单满足多少金额可用，默认为任意金额可用</td>*/
/*         </tr>*/
/*         <tr id="range">*/
/*             <td>使用范围</td>*/
/*             <td>*/
/*                 <input type="checkbox" class="easyui-checkbox" name="range[]" value="1" checked="checked">全部<br/>*/
/*                 <input type="checkbox" class="easyui-checkbox" name="range[]" value="2">限购专区<br/>*/
/*                 <input type="checkbox" class="easyui-checkbox" name="range[]" value="3">十元专区<br/>*/
/*                 <input type="checkbox" class="easyui-checkbox" name="range[]" value="4">选择商品   <a id="addProduct" class="easyui-linkbutton">添加商品</a><br/>*/
/*                 <input type="checkbox" class="easyui-checkbox" name="range[]" value="5">选择PK商品   <a id="addPkProduct" class="easyui-linkbutton">添加Pk商品</a><br/>*/
/* */
/*                 <ul id="products" style="list-style: none;padding: 0"></ul>*/
/*                 <ul id="pk_products" style="list-style: none;padding: 0"></ul>*/
/*         </td>*/
/*             <td>默认全部商品可用</td>*/
/*         </tr> */
/*         {% endif %}*/
/*         <tr>*/
/*             <th>有效期</th>*/
/*             <td colspan="2">*/
/*                 <input type="radio" class="time" name="time" value="1" checked><input class="easyui-datetimebox" type="text" data-options="required:true" id="starttime" name="starttime">到<input class="easyui-datetimebox" type="text" data-options="required:true" id="endtime" name="endtime"><br/><br/>*/
/*                 <input type="radio" class="time" name="time" value="2"><input class="easyui-textbox" type="text" name="valid" id="valid" data-options="required:true,disabled:true" id="type">*/
/*             </td>*/
/*             <td>可选择绝对时间段或者用户领取后多少天内可用</td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th>使用说明</th>*/
/*             <td colspan="2">*/
/*                 <textarea rows="10" cols="60" name="desc" data-options="required:true" id="desc"></textarea>*/
/*             </td>*/
/*             <td>优惠券使用详细说明</td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th>生成数量</th>*/
/*             <td colspan="2"><input class="easyui-textbox" type="text" name="nums" id="nums" data-options="required:true" value="0"></td>*/
/*             <td>数量为0，则为不限</td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th>领取数量</th>*/
/*             <td colspan="2"><input class="easyui-textbox" type="text" name="limit" id="limit" data-options="required:true" value="1"></td>*/
/*             <td>每人可领取数量，默认为1（只对直接领取优惠券生效，如果是红包领取则不生效）</td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     {% if couponId %}*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('edit')">保存</a>*/
/*     {% else %}*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">添加</a>*/
/*     {% endif %}*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:window.parent.location.reload();">取消</a>*/
/* </div>*/
/* */
/* <div id="choose_product" title="选择商品"  class="easyui-dialog" modal="true" closed="true" style="width: 700px;height: auto;">*/
/*     <div style="padding: 10px;">*/
/*         名称<input type="text" class="easyui-textbox" name="keywords">*/
/*         商品编号<input type="text" class="easyui-textbox" name="sn">*/
/*         <input type="button" class="easyui-linkbutton" iconCls="icon-search" style="padding: 5px 10px" value="搜索" id="search">*/
/*     </div>*/
/*     <table id="search_result" cellSpacing=0 cellpadding=8 align="center" border="1" style="margin: 10px">*/
/*         <thead>*/
/*             <tr>*/
/*                 <th width="20" align="center"></th>*/
/*                 <th width="80" align="center">商品编号</th>*/
/*                 <th width="500" align="center">商品名称</th>*/
/*                 <th width="80" align="center">类型</th>                */
/*             </tr>*/
/*         </thead>*/
/*         <tbody></tbody>*/
/*     </table>*/
/*     <div id="dlg-buttons-add-product" style="text-align:center;padding:5px">*/
/*         <a class="easyui-linkbutton" iconCls="icon-ok" onclick="javascript:;chooseProduct()">确定</a>*/
/*         <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#choose_product').dialog('close');">取消</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="choose_pk_product" title="选择pk商品"  class="easyui-dialog" modal="true" closed="true" style="width: 700px;height: auto;">*/
/*     <div style="padding: 10px;">*/
/*         名称<input type="text" class="easyui-textbox" name="keywords">*/
/*         商品编号<input type="text" class="easyui-textbox" name="sn">*/
/*         <input type="button" class="easyui-linkbutton" iconCls="icon-search" style="padding: 5px 10px" value="搜索" id="pk_search">*/
/*     </div>*/
/*     <table id="search_pk_result" cellSpacing=0 cellpadding=8 align="center" border="1" style="margin: 10px">*/
/*         <thead>*/
/*         <tr>*/
/*             <th width="20" align="center"></th>*/
/*             <th width="80" align="center">商品编号</th>*/
/*             <th width="500" align="center">商品名称</th>*/
/*             <th width="80" align="center">类型</th>*/
/*         </tr>*/
/*         </thead>*/
/*         <tbody></tbody>*/
/*     </table>*/
/*     <div id="dlg-buttons-add-pk-product" style="text-align:center;padding:5px">*/
/*         <a class="easyui-linkbutton" iconCls="icon-ok" onclick="javascript:;choosePkProduct()">确定</a>*/
/*         <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#choose_pk_product').dialog('close');">取消</a>*/
/*     </div>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     $(function(){*/
/*         $("input[name=time]").click(function(){*/
/*             if ($(this).val() == 1) {*/
/*                 $('#endtime').datetimebox({disabled:false, required:true});*/
/*                 $('#starttime').datetimebox({disabled:false, required:true});*/
/*                 $('#valid').textbox({disabled:true});*/
/*             }else if ($(this).val() == 2) {*/
/*                 $('#valid').textbox({disabled:false});*/
/*                 $('#endtime').datetimebox({disabled:true});*/
/*                 $('#starttime').datetimebox({disabled:true});*/
/*             }*/
/*         })*/
/*         var couponId = "{{ couponId }}";*/
/*         if (couponId) {*/
/*             $.get('/coupon/info',{id:couponId},function(data){*/
/*                 // $("input[name=type_id]").val(data.type);*/
/*                 console.log(data)*/
/*                 $("input[name=id]").val(data.id);*/
/*                 $("#name").textbox({value:data.name});*/
/*                 if (data.type == 1 || data.type == 2) {*/
/*                     if (data.type == 1) {*/
/*                         $("#quota").textbox({value:data.amount.money});*/
/*                     }else if (data.type == 2) {*/
/*                         $("#quota").textbox({value:data.amount.discount});*/
/*                         $("#max").textbox({value:data.amount.max});*/
/*                     }*/
/*                     $("#need").textbox({value:data.condition.need});*/
/*                     var rangeArr = data.condition.range.split(',');*/
/*                     console.log(data)*/
/*                     if ($.inArray('1',rangeArr)>=0) {*/
/*                         $("#range input[value=1]").prop('checked','checked');*/
/*                     } else {*/
/*                         if ($.inArray('4',rangeArr)>=0 || $.inArray('5', rangeArr)>=0) {*/
/*                             if ($.inArray('4',rangeArr)>=0) {*/
/*                                 $("#range input[value=4]").prop('checked','checked');*/
/*                                 $("#range input[type=checkbox]").eq(0).prop('checked','');*/
/*                                 $("#range input[type=checkbox]").eq(1).prop('checked','');*/
/*                                 $("#range input[type=checkbox]").eq(2).prop('checked','');*/
/*                                 var html = "";*/
/*                                 var productIdsArr = data.condition.products.split(',');*/
/*                                 for(var i=0;i<productIdsArr.length;i++) {*/
/*                                     var productId = productIdsArr[i];*/
/*                                     html += '<li><input type="hidden" name="products[]" value="'+productId+'">商品ID'+productId+' <a onclick="javascript:$(this).parent().remove();">删除</a></li>';*/
/*                                 }*/
/*                                 $("#products").append(html);*/
/*                             }*/
/*                             if ($.inArray('5', rangeArr)>=0) {*/
/*                                 $("#range input[value=5]").prop('checked','checked');*/
/*                                 $("#range input[type=checkbox]").eq(0).prop('checked','');*/
/*                                 $("#range input[type=checkbox]").eq(1).prop('checked','');*/
/*                                 $("#range input[type=checkbox]").eq(2).prop('checked','');*/
/* */
/*                                 var html = "";*/
/*                                 var productIdsArr = data.condition.pk_products.split(',');*/
/*                                 for(var i=0;i<productIdsArr.length;i++) {*/
/*                                     var productId = productIdsArr[i];*/
/*                                     html += '<li><input type="hidden" name="pk_products[]" value="'+productId+'">[PK]商品ID'+productId+' <a onclick="javascript:$(this).parent().remove();">删除</a></li>';*/
/*                                 }*/
/*                                 $("#pk_products").append(html);*/
/*                             }*/
/*                         }else {*/
/*                             if ($.inArray('2',rangeArr)>=0) {*/
/*                                 $("#range input[value=2]").prop('checked','checked');*/
/*                             }*/
/*                             if ($.inArray('3',rangeArr)>=0) {*/
/*                                 $("#range input[value=3]").prop('checked','checked');*/
/*                             }*/
/*                         }*/
/* */
/*                     }*/
/* */
/*                 }else if (data.type == 3) {*/
/*                      $("#quota").textbox({value:data.amount.amount});*/
/*                      $("#recharge_type").combobox({value:data.amount.type});*/
/*                      // $.each($("#recharge_type option"),function(data){*/
/*                      //    if ($(this).val() == data.amount.point) {*/
/*                      //        $(this).prop('selected', 'selected');*/
/*                      //    }*/
/*                      // })*/
/*                 }*/
/*                 if (data.valid_type == 1) {*/
/*                     $(".time:eq(0)").prop('checked', 'checked');*/
/*                     $("#starttime").textbox({value:data.start_time});*/
/*                     $("#endtime").textbox({value:data.end_time});*/
/*                 }else if (data.valid_type == 2) {*/
/*                     $(".time:eq(1)").prop('checked', 'checked');*/
/*                     $("#valid").textbox({value:data.valid});*/
/*                 }*/
/*                 $("#desc").val(data.desc);*/
/*                 $("#nums").textbox({value:data.num});*/
/*                 $("#limit").textbox({value:data.receive_limit});*/
/* */
/*             },'json')*/
/*         }*/
/*         */
/*         $("#range input[type=checkbox]").click(function(){*/
/*             if ($(this).val() == 4 && $(this).prop('checked') == true) {*/
/*                 $("#range input[type=checkbox]").eq(0).prop('checked','');*/
/*                 $("#range input[type=checkbox]").eq(1).prop('checked','');*/
/*                 $("#range input[type=checkbox]").eq(2).prop('checked','');*/
/*                 $('#choose_product').dialog('open');*/
/*             } else if ($(this).val() == 5 && $(this).prop('checked') == true) {*/
/*                 $("#range input[type=checkbox]").eq(0).prop('checked','');*/
/*                 $("#range input[type=checkbox]").eq(1).prop('checked','');*/
/*                 $("#range input[type=checkbox]").eq(2).prop('checked','');*/
/*                 $('#choose_pk_product').dialog('open');*/
/*             }else{*/
/*                 $("#range input[type=checkbox]").eq(3).prop('checked','');*/
/*                 $("#range input[type=checkbox]").eq(4).prop('checked','');*/
/*             }*/
/*         })*/
/*         $("#addProduct").click(function(){*/
/*             $("#range input[type=checkbox]").eq(0).prop('checked','');*/
/*             $("#range input[type=checkbox]").eq(1).prop('checked','');*/
/*             $("#range input[type=checkbox]").eq(2).prop('checked','');*/
/*             $('#choose_product').dialog('open');*/
/*             $("#range input[type=checkbox]").eq(3).prop('checked','true');*/
/*         })*/
/*         $("#addPkProduct").click(function(){*/
/*             $("#range input[type=checkbox]").eq(0).prop('checked','');*/
/*             $("#range input[type=checkbox]").eq(1).prop('checked','');*/
/*             $("#range input[type=checkbox]").eq(2).prop('checked','');*/
/*             $('#choose_pk_product').dialog('open');*/
/*             $("#range input[type=checkbox]").eq(4).prop('checked','true');*/
/*         })*/
/*         $("#search").click(function(){*/
/*             $.post('/product/search', {keywords: $("#choose_product input[name=keywords]").val(),sn:$("#choose_product input[name=sn]").val()}, function(data) {*/
/*                 if (data.length > 0) {*/
/*                     var html = "";*/
/*                     $.each(data,function(i,v){*/
/*                         html += '<tr>';*/
/*                         html += '<td>';*/
/*                         html += '<input type="checkbox" name="products" pid="'+v.id+'" title="'+v.name+'">';*/
/*                         html += '</td>';*/
/*                         html += '<td align="center">';*/
/*                         html += v.bn;*/
/*                         html += '</td>';*/
/*                         html += '<td>';*/
/*                         html += v.name;*/
/*                         html += '</td>';*/
/*                         html += '<td align="center">';*/
/*                         if (v.limit_num > 0) {*/
/*                             html += '限购';*/
/*                         }*/
/*                         if (v.buy_unit == 10) {*/
/*                             html += '10元专区';*/
/*                         }*/
/*                         if (v.limit_num == 0 && v.buy_unit == 1) {*/
/*                             html += '普通';*/
/*                         }*/
/*                         html += '</td>';*/
/*                     })*/
/*                     $("#search_result tbody").html(html);*/
/*                 }else{*/
/*                     $("#search_result tbody").html('<tr><td colspan="4" align="center">暂无数据</td></tr>');*/
/*                 }*/
/*             },'json');*/
/*         })*/
/* */
/*         $("#pk_search").click(function(){*/
/*             $.post('/activityproduct/pk-search', {keywords: $("#choose_pk_product input[name=keywords]").val(),sn:$("#choose_pk_product input[name=sn]").val()}, function(data) {*/
/*                 if (data.length > 0) {*/
/*                     var html = "";*/
/*                     $.each(data,function(i,v){*/
/*                         html += '<tr>';*/
/*                         html += '<td>';*/
/*                         html += '<input type="checkbox" name="products" pid="'+v.id+'" title="'+v.name+'">';*/
/*                         html += '</td>';*/
/*                         html += '<td align="center">';*/
/*                         html += v.bn;*/
/*                         html += '</td>';*/
/*                         html += '<td>';*/
/*                         html += v.name;*/
/*                         html += '</td>';*/
/*                         html += '<td align="center">';*/
/*                         html += '</td>';*/
/*                     })*/
/*                     $("#search_pk_result tbody").html(html);*/
/*                 }else{*/
/*                     $("#search_pk_result tbody").html('<tr><td colspan="4" align="center">暂无数据</td></tr>');*/
/*                 }*/
/*             },'json');*/
/*         })*/
/*     })*/
/*     function save(type){*/
/*         if (type == 'add') {*/
/*         	$("#addForm").form('submit',{*/
/*         		success:function(data){*/
/*                     data = eval("(" + data + ")");*/
/*                     if (data.code == 100) {*/
/*             			$.messager.alert('添加成功', '优惠券添加成功', 'success');*/
/*                     }else{*/
/*                         $.messager.alert('添加失败', '优惠券添加失败', 'fail');*/
/*                     }*/
/*         		}*/
/*         	})*/
/*         }else if (type == 'edit') {*/
/*             $("#editForm").form('submit',{*/
/*                 success:function(data){*/
/*                     data = $.parseJSON(data);*/
/*                     if (data.code == 100) {*/
/*                         $.messager.alert('保存成功', '优惠券保存成功', 'success');*/
/*                         setTimeout(function(){window.parent.location.reload()}, 2000);*/
/*                     }else{*/
/*                         $.messager.alert('保存失败', '优惠券保存失败', 'fail');*/
/*                     }*/
/*                 }*/
/*             })*/
/*         }*/
/*     }*/
/*     function chooseProduct(){*/
/*         var choosedProducts = '';*/
/*         $("#products li input").each(function(){*/
/*             choosedProducts += $(this).val() + ',';*/
/*         })*/
/*         var choosedProductsArr = choosedProducts.split(',');*/
/*         $("#choose_product input:checkbox:checked").each(function(){*/
/*             var pid = $(this).attr('pid');*/
/*             if ($.inArray(pid,choosedProductsArr) >= 0) {*/
/*                 $.messager.alert('不能重复选择','不能重复选择');*/
/*             }else{*/
/*                 var html = "";*/
/*                 html += '<li><input type="hidden" name="products[]" value="'+pid+'">'+$(this).attr('title')+'<a onclick="javascript:;">删除</a></li>';*/
/*                 $("#products").append(html);*/
/*             }*/
/*         })*/
/*         $('#choose_product').dialog('close');*/
/*     }*/
/*     function choosePkProduct(){*/
/*         var choosedProducts = '';*/
/*         $("#pk_products li input").each(function(){*/
/*             choosedProducts += $(this).val() + ',';*/
/*         })*/
/*         var choosedProductsArr = choosedProducts.split(',');*/
/*         $("#choose_pk_product input:checkbox:checked").each(function(){*/
/*             var pid = $(this).attr('pid');*/
/*             if ($.inArray(pid,choosedProductsArr) >= 0) {*/
/*                 $.messager.alert('不能重复选择','不能重复选择');*/
/*             }else{*/
/*                 var html = "";*/
/*                 html += '<li><input type="hidden" name="pk_products[]" value="'+pid+'">[PK]'+$(this).attr('title')+'<a onclick="javascript:;">删除</a></li>';*/
/*                 $("#pk_products").append(html);*/
/*             }*/
/*         })*/
/*         $('#choose_pk_product').dialog('close');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
