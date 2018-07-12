<?php

/* index.html */
class __TwigTemplate_ae3c93fe81534d7fe3ba802f21ecf68d434b3e41a65bb1c5d4c24edc182430da extends yii\twig\Template
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
        echo "<table title=\"红包列表\" id=\"listdata\" class=\"easyui-datagrid\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/packet/index"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id',align:'center'\" width=\"50\">ID</th>
        <th data-options=\"field:'name', align:'center'\" width=\"150\">红包名称</th>
        <th data-options=\"field:'num', align:'center'\" width=\"100\">生成数量</th>
        <th data-options=\"field:'send_num', align:'center'\" width=\"100\">发出数量</th>
        <th data-options=\"field:'left_num', align:'center'\" width=\"100\">剩余数量</th>
        <th data-options=\"field:'create_time', align:'center'\" formatter=\"formatTime\" width=\"200\">创建时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"javascript:\$('#add_packet').dialog('open')\">新增红包</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"view()\">详情</a>
    </div>
</div>

<!--新增红包-->
<!-- 选择红包类型 -->
<div id=\"add_packet\" title=\"选择红包类型\" class=\"easyui-dialog\" style=\"width:700px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-choose\" >
    ";
        // line 28
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "add", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <input type=\"hidden\" name=\"packet_id\" id=\"packet_id\" value=\"\">
    <table cellSpacing=10>
        <tr>
            <th width=\"60px\" align=\"right\">红包名称</th>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"name\" id=\"packet_name\" data-options=\"required:true\"></td>
            <td></td>
        </tr>
        <tr>
            <th align=\"right\">添加优惠券</th>
            <td>
                <div><a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" id=\"add_coupon\">塞入优惠券</a></div>
                <ul id=\"couponList\" class=\"tree\" style=\"margin-top: 5px;\">
                </ul>
            </td>
            <td>选择优惠券以及设置优惠券张数</td>
        </tr>
        <tr>
            <th align=\"right\">红包说明</th>
            <td>
                <textarea rows=\"10\" cols=\"60\" name=\"desc\" id=\"desc\" data-options=\"required:true\"></textarea>
            </td>
            <td></td>
        </tr>
        <tr>
            <th align=\"right\">生成数量</th>
            <td><input class=\"easyui-textbox\" type=\"text\" id=\"nums\" name=\"nums\" data-options=\"required:true\" value=\"0\"></td>
            <td>数量为0，则为不限</td>
        </tr>
        <tr>
            <th>领取数量</th>
            <td><input class=\"easyui-textbox\" type=\"text\" id=\"receive_limit\" name=\"receive_limit\" data-options=\"required:true\" value=\"1\"></td>
            <td>数量为0，则为不限</td>
        </tr>
    </table>
    ";
        // line 63
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>


<div id=\"dlg-buttons-choose\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#add_packet').dialog('close')\">取消</a>
</div>

";
    }

    // line 74
    public function block_js($context, array $blocks = array())
    {
        // line 75
        echo "<script type=\"text/javascript\">
    \$(function(){
        \$(\"#couponList li a\").click(function(){
            \$(\"#couponList\").append(\$(this).parent().clone());
        })
        \$(\"#add_coupon\").click(function(){
            \$.get('/coupon/get-list',function(data){
                // data = eval(\"(\" + data + \")\");
                var html = '<li class=\"tree\" style=\"margin-top:5px;\">';
                    html += '<select class=\"easyui-combobox\" name=\"coupons[]\">';
                    \$.each(data,function(i,v) {
                        html += '<option value=\"' + v.id + '\">' + v.id + ') ' + v.name + '</option>';
                    });
                    html += '</select>';
                    html += ' X <input type=\"text\" name=\"coupon_nums[]\" class=\"easyui-textbox\" value=\"1\" size=\"3\">';
                    html += '</li>';
                \$(\"#couponList\").append(html);    
            },'json')
        })
    })
    function save() {
        \$(\"#addForm\").form('submit',{
            success:function(data){
                data = eval(\"(\" + data + \")\");
                if (data.code == 100) {
                    \$.messager.alert('添加成功', '红包添加成功', 'success');
                    window.location.href = '/packet/index';
                }else{
                    \$.messager.alert('添加失败', '红包添加失败', 'fail');
                }
            }
        })
    }
    function edit() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择活动','error');
            return false;
        }
        \$.get('/packet/info?id='+selRow.id,function(data){
            \$(\"#couponList\").html('');
            \$.each(data.info.content,function(i,v){
                var html = '<li class=\"tree\" style=\"margin-top:5px;\">';
                    html += '<select class=\"easyui-combobox\" name=\"coupons[]\">';
                    \$.each(data.list,function(j,vv) {
                        if (i == j) {
                            html += '<option value=\"' + vv.id + '\" selected=\"selected\">' + vv.id + ') ' + vv.name + '</option>';
                        }else{
                            html += '<option value=\"' + vv.id + '\">' + vv.id + ') ' + vv.name + '</option>';
                        }
                    });
                    html += '</select>';
                    html += ' X <input type=\"text\" name=\"coupon_nums[]\" class=\"easyui-textbox\" value=\"' + v + '\" size=\"3\">';
                    html += '</li>';
                \$(\"#couponList\").append(html);
            })

            \$(\"#packet_id\").val(data.info.id);
            \$(\"#packet_name\").textbox({value:data.info.name});
            \$(\"#desc\").text(data.info.desc);
            \$(\"#nums\").textbox({disabled:false,value:data.info.num});
            \$(\"#receive_limit\").textbox({value:data.info.receive_limit});
            \$('#add_packet').dialog('open');
        },'json')
        // \$(\"#packet_id\").val(selRow.id);
    }
    function view(){
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择活动','error');
            return false;
        }
        \$.get('/packet/info?id='+selRow.id,function(data){
            \$(\"#couponList\").html('');
            \$.each(data.info.content,function(i,v){
                var html = '<li class=\"tree\" style=\"margin-top:5px;\">';
                html += '<select class=\"easyui-combobox\" name=\"coupons[]\">';
                \$.each(data.list,function(j,vv) {
                    if (i == j) {
                        html += '<option value=\"' + vv.id + '\" selected=\"selected\">' + vv.id + ') ' + vv.name + '</option>';
                    }else{
                        html += '<option value=\"' + vv.id + '\">' + vv.id + ') ' + vv.name + '</option>';
                    }
                });
                html += '</select>';
                html += ' X <input type=\"text\" name=\"coupon_nums[]\" class=\"easyui-textbox\" value=\"' + v + '\" size=\"3\">';
                html += '</li>';
                \$(\"#couponList\").append(html);
            })

            \$(\"#packet_id\").val(data.info.id);
            \$(\"#packet_name\").textbox({value:data.info.name});
            \$(\"#desc\").text(data.info.desc);
            \$(\"#nums\").textbox({disabled:false,value:data.info.num});
            \$(\"#receive_limit\").textbox({value:data.info.receive_limit});
            \$('#add_packet').dialog('open');
            //\$(\"#dlg-buttons-choose\").html('<a class=\"easyui-linkbutton\" iconCls=\"icon-ok\">&nbsp;</a>');
        },'json')
    }
    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
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
        return array (  115 => 75,  112 => 74,  98 => 63,  60 => 28,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table title="红包列表" id="listdata" class="easyui-datagrid" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{ url('/packet/index') }}',rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id',align:'center'" width="50">ID</th>*/
/*         <th data-options="field:'name', align:'center'" width="150">红包名称</th>*/
/*         <th data-options="field:'num', align:'center'" width="100">生成数量</th>*/
/*         <th data-options="field:'send_num', align:'center'" width="100">发出数量</th>*/
/*         <th data-options="field:'left_num', align:'center'" width="100">剩余数量</th>*/
/*         <th data-options="field:'create_time', align:'center'" formatter="formatTime" width="200">创建时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="javascript:$('#add_packet').dialog('open')">新增红包</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="view()">详情</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增红包-->*/
/* <!-- 选择红包类型 -->*/
/* <div id="add_packet" title="选择红包类型" class="easyui-dialog" style="width:700px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-choose" >*/
/*     {{ html.beginForm('add','post',{'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <input type="hidden" name="packet_id" id="packet_id" value="">*/
/*     <table cellSpacing=10>*/
/*         <tr>*/
/*             <th width="60px" align="right">红包名称</th>*/
/*             <td><input class="easyui-textbox" type="text" name="name" id="packet_name" data-options="required:true"></td>*/
/*             <td></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th align="right">添加优惠券</th>*/
/*             <td>*/
/*                 <div><a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" id="add_coupon">塞入优惠券</a></div>*/
/*                 <ul id="couponList" class="tree" style="margin-top: 5px;">*/
/*                 </ul>*/
/*             </td>*/
/*             <td>选择优惠券以及设置优惠券张数</td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th align="right">红包说明</th>*/
/*             <td>*/
/*                 <textarea rows="10" cols="60" name="desc" id="desc" data-options="required:true"></textarea>*/
/*             </td>*/
/*             <td></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th align="right">生成数量</th>*/
/*             <td><input class="easyui-textbox" type="text" id="nums" name="nums" data-options="required:true" value="0"></td>*/
/*             <td>数量为0，则为不限</td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th>领取数量</th>*/
/*             <td><input class="easyui-textbox" type="text" id="receive_limit" name="receive_limit" data-options="required:true" value="1"></td>*/
/*             <td>数量为0，则为不限</td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* */
/* <div id="dlg-buttons-choose" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#add_packet').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     $(function(){*/
/*         $("#couponList li a").click(function(){*/
/*             $("#couponList").append($(this).parent().clone());*/
/*         })*/
/*         $("#add_coupon").click(function(){*/
/*             $.get('/coupon/get-list',function(data){*/
/*                 // data = eval("(" + data + ")");*/
/*                 var html = '<li class="tree" style="margin-top:5px;">';*/
/*                     html += '<select class="easyui-combobox" name="coupons[]">';*/
/*                     $.each(data,function(i,v) {*/
/*                         html += '<option value="' + v.id + '">' + v.id + ') ' + v.name + '</option>';*/
/*                     });*/
/*                     html += '</select>';*/
/*                     html += ' X <input type="text" name="coupon_nums[]" class="easyui-textbox" value="1" size="3">';*/
/*                     html += '</li>';*/
/*                 $("#couponList").append(html);    */
/*             },'json')*/
/*         })*/
/*     })*/
/*     function save() {*/
/*         $("#addForm").form('submit',{*/
/*             success:function(data){*/
/*                 data = eval("(" + data + ")");*/
/*                 if (data.code == 100) {*/
/*                     $.messager.alert('添加成功', '红包添加成功', 'success');*/
/*                     window.location.href = '/packet/index';*/
/*                 }else{*/
/*                     $.messager.alert('添加失败', '红包添加失败', 'fail');*/
/*                 }*/
/*             }*/
/*         })*/
/*     }*/
/*     function edit() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择活动','error');*/
/*             return false;*/
/*         }*/
/*         $.get('/packet/info?id='+selRow.id,function(data){*/
/*             $("#couponList").html('');*/
/*             $.each(data.info.content,function(i,v){*/
/*                 var html = '<li class="tree" style="margin-top:5px;">';*/
/*                     html += '<select class="easyui-combobox" name="coupons[]">';*/
/*                     $.each(data.list,function(j,vv) {*/
/*                         if (i == j) {*/
/*                             html += '<option value="' + vv.id + '" selected="selected">' + vv.id + ') ' + vv.name + '</option>';*/
/*                         }else{*/
/*                             html += '<option value="' + vv.id + '">' + vv.id + ') ' + vv.name + '</option>';*/
/*                         }*/
/*                     });*/
/*                     html += '</select>';*/
/*                     html += ' X <input type="text" name="coupon_nums[]" class="easyui-textbox" value="' + v + '" size="3">';*/
/*                     html += '</li>';*/
/*                 $("#couponList").append(html);*/
/*             })*/
/* */
/*             $("#packet_id").val(data.info.id);*/
/*             $("#packet_name").textbox({value:data.info.name});*/
/*             $("#desc").text(data.info.desc);*/
/*             $("#nums").textbox({disabled:false,value:data.info.num});*/
/*             $("#receive_limit").textbox({value:data.info.receive_limit});*/
/*             $('#add_packet').dialog('open');*/
/*         },'json')*/
/*         // $("#packet_id").val(selRow.id);*/
/*     }*/
/*     function view(){*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择活动','error');*/
/*             return false;*/
/*         }*/
/*         $.get('/packet/info?id='+selRow.id,function(data){*/
/*             $("#couponList").html('');*/
/*             $.each(data.info.content,function(i,v){*/
/*                 var html = '<li class="tree" style="margin-top:5px;">';*/
/*                 html += '<select class="easyui-combobox" name="coupons[]">';*/
/*                 $.each(data.list,function(j,vv) {*/
/*                     if (i == j) {*/
/*                         html += '<option value="' + vv.id + '" selected="selected">' + vv.id + ') ' + vv.name + '</option>';*/
/*                     }else{*/
/*                         html += '<option value="' + vv.id + '">' + vv.id + ') ' + vv.name + '</option>';*/
/*                     }*/
/*                 });*/
/*                 html += '</select>';*/
/*                 html += ' X <input type="text" name="coupon_nums[]" class="easyui-textbox" value="' + v + '" size="3">';*/
/*                 html += '</li>';*/
/*                 $("#couponList").append(html);*/
/*             })*/
/* */
/*             $("#packet_id").val(data.info.id);*/
/*             $("#packet_name").textbox({value:data.info.name});*/
/*             $("#desc").text(data.info.desc);*/
/*             $("#nums").textbox({disabled:false,value:data.info.num});*/
/*             $("#receive_limit").textbox({value:data.info.receive_limit});*/
/*             $('#add_packet').dialog('open');*/
/*             //$("#dlg-buttons-choose").html('<a class="easyui-linkbutton" iconCls="icon-ok">&nbsp;</a>');*/
/*         },'json')*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
