<?php

/* config.html */
class __TwigTemplate_43ee938bb5282ffe88d13828b27c98b43a7134ecde8b1c511c0b7d0325f3fec8 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "config.html", 1);
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
    .datagrid-btable tr{height: 200px!important;}
</style>
<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"土豪榜奖品配置列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("rich/reward-config"), "html", null, true);
        echo "'\">
    <thead>
    <tr style=\"height:200px;\">
        <th data-options=\"field:'type', width:150, align:'center'\">类型</th>
        <th data-options=\"field:'name', width:280, align:'center'\">奖品</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 18
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 19
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"\$('#dlg-add').dialog('open')\">新增</a>
        ";
        }
        // line 21
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 22
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">修改</a>
        ";
        }
        // line 24
        echo "        ";
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 25
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 27
        echo "    </div>
</div>

<div id=\"dlg-add\" title=\"新增配置页\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px;\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 31
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm", "enctype" => "multipart/form-data")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>类型</td>
            <td>
                <select class=\"easyui-combobox\" name=\"key\" data-options=\"panelHeight:'auto'\" id=\"richKey\">
                    <option value=\"richdayconfig\">日榜</option>
                    <!--<option value=\"richweekconfig\">周榜</option>-->
                    <option value=\"richmonthconfig\">月榜</option>
                    <option value=\"richseasonconfig\">季榜</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>添加奖项</td>
            <td id=\"content\"><input type=\"button\" value=\"添加奖励\" onclick=\"openReward();\"></td>
        </tr>
    </table>
    ";
        // line 49
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>

<div id=\"dlg-add-reward\" title=\"新增奖励\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px;\" modal=\"true\" closed=\"true\">
    ";
        // line 58
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addRewardForm", "enctype" => "multipart/form-data")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>排名</td>
            <td>
                <select class=\"easyui-combobox\" name=\"rank\" data-options=\"panelHeight:'auto'\" id=\"rank\">
                    <option value=\"1\">第一名</option>
                    <option value=\"2\">第二名</option>
                    <option value=\"3\">第三名</option>
                    <option value=\"4\">第四名</option>
                    <option value=\"5\">第五名</option>
                    <option value=\"6\">第六名</option>
                    <option value=\"7\">第七名</option>
                    <option value=\"8\">第八名</option>
                    <option value=\"9\">第九名</option>
                    <option value=\"10\">第十名</option>
                    <option value=\"11-50\">第十一名到第五十名</option>
                    <option value=\"51-100\">第五十一名到第一百名</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>类型</td>
            <td>
                <select class=\"easyui-combobox\" name=\"type\" data-options=\"panelHeight:'auto'\" id=\"type\">
                    <option value=\"1\">实物</option>
                    <option value=\"2\">现金</option>
                    <option value=\"3\">返现</option>
                    <option value=\"4\">红包</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>奖品</td>
            <td><input class=\"easyui-textbox\" name=\"reward\" class=\"reward\" id=\"reward\"/></td>
        </tr>
        <tr>
            <td>奖品图片</td>
            <td><input class=\"easyui-filebox\" name=\"file\" class=\"picture\" id=\"picture\"/></td>
        </tr>
        <tr>
            <td></td>
            <td><a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitRewardForm()\" style=\"width: 80px;\">确定</a></td>
        </tr>
    </table>
    ";
        // line 103
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"修改配置\" style=\"width:500px;height:600px;padding:10px;\" data-options=\"iconCls:'icon-save',closed:true,modal:true,onResize:function(){ \$(this).window('hcenter');}\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\"></iframe>
</div>
";
    }

    // line 111
    public function block_js($context, array $blocks = array())
    {
        // line 112
        echo "<script>
    \$('#picture').filebox({
        onChange: function(n, o){
            if(n != ''){
                \$('#addRewardForm').form({
                    url: '";
        // line 117
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("rich/upload"), "html", null, true);
        echo "',
                    onSubmit: function(param){
                    },
                    success: function (data) {
                        \$('#picture').attr('data-id', data);
                    }
                });
                \$('#addRewardForm').submit();
            }
        }
    })

    function openReward()
    {
        \$('#dlg-add-reward').dialog('open');
        \$('#picture').filebox('setValue', '');
        \$('#picture').removeAttr('data-id');
    }

    function edit()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请至少选择一个');
            return false;
        }

        \$('#edit_iframe').prop('src', \"";
        // line 144
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("rich/edit-reward"), "html", null, true);
        echo "\" + '?type=' + selRow.type);
        \$('#dlg-edit').window('open');
    }

    function submitRewardForm()
    {
        var type = \$('#type').combobox('getValue');
        var name = \$('#reward').textbox('getValue');
        var rank = \$('#rank').combobox('getValue');
        var picture = \$('#picture').attr('data-id');

        if(type != 1){
            if(parseInt(name) != name){
                \$.messager.alert('错误','奖品必须为整数');
                return false;
            }
        }
        if(name == ''){
            \$.messager.alert('错误','奖品不能为空');
            return false;
        }
        if(picture == undefined){
            picture = '';
            \$('#content').append('<p class=\"goods-name\" data-rank=\"'+rank+'\" data-name=\"'+name+'\" data-type=\"'+type+'\">第'+rank+'名  <span>'+name+'</span>&nbsp;&nbsp;<a href=\"javascript:void(0);\" onclick=\"delReward(this)\">删除</a></p>');
        }else{
            \$('#content').append('<p class=\"goods-name\" data-rank=\"'+rank+'\" data-name=\"'+name+'\" data-type=\"'+type+'\" data-picture=\"'+picture+'\">第'+rank+'名  <span>'+name+'</span>&nbsp;&nbsp;<a href=\"javascript:void(0);\" onclick=\"delReward(this)\">删除</a></p>');
        }


        \$('#dlg-add-reward').dialog('close');
    }

    function delReward(nowP){
        \$.messager.confirm('Confirm', '您确定删除该奖品吗？', function(r) {
            if (r) {
                \$(nowP).parent('p').remove();
            }
        });
    }

    function del()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请至少选择一个');
            return false;
        }
        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            \$.post('/rich/del-config', {'type':selRow.type}, function(data){
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){location.reload();}, 2000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            })
        });
    }

    function save()
    {
        \$('#addForm').form({
            url: '";
        // line 207
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("rich/reward-config"), "html", null, true);
        echo "',
            onSubmit: function(param){
                var isValid = \$(this).form('validate');
                if (!isValid){
                    \$.messager.progress('close');\t// 如果表单是无效的则隐藏进度条
                }
                var json = {};
                var jsonArrKey = 0;
                \$(\".goods-name\").each(function(k){
                    var rank = \$(this).attr('data-rank');
                    var type = \$(this).attr('data-type');
                    var name = \$(this).attr('data-name');
                    var picture = \$(this).attr('data-picture');
                    if(picture == undefined) picture = '';
                    if (rank.indexOf('-')>0) {
                        var  rankArr = rank.split('-');
                        var start = parseInt(rankArr[0]);
                        var end = parseInt(rankArr[1]);
                        for(var i=start;i<=end;i++) {
                            json[jsonArrKey] = {'rank':i, 'type':type, 'name':name, 'picture':picture};
                            jsonArrKey ++;
                        }
                    } else {
                        json[jsonArrKey] = {'rank':rank, 'type':type, 'name':name, 'picture':picture};
                        jsonArrKey ++;
                    }
                });
                var jsonArr = JSON.stringify(json);
                console.log(jsonArr);
                param.content = jsonArr;
                return isValid;\t// 返回false终止表单提交
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){location.reload();}, 2000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            }
        });
        \$('#addForm').submit();
    }

    /*function edit(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 259
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("active/edit"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-edit').window('open');
    }
*/
</script>
";
    }

    public function getTemplateName()
    {
        return "config.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  330 => 259,  275 => 207,  209 => 144,  179 => 117,  172 => 112,  169 => 111,  158 => 103,  110 => 58,  98 => 49,  77 => 31,  71 => 27,  67 => 25,  64 => 24,  60 => 22,  57 => 21,  53 => 19,  51 => 18,  37 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style>*/
/*     .datagrid-btable tr{height: 200px!important;}*/
/* </style>*/
/* <table id="listdata"  class="easyui-datagrid" title="土豪榜奖品配置列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{ url('rich/reward-config') }}'">*/
/*     <thead>*/
/*     <tr style="height:200px;">*/
/*         <th data-options="field:'type', width:150, align:'center'">类型</th>*/
/*         <th data-options="field:'name', width:280, align:'center'">奖品</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if(add == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="$('#dlg-add').dialog('open')">新增</a>*/
/*         {% endif %}*/
/*         {% if(edit == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">修改</a>*/
/*         {% endif %}*/
/*         {% if(del == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-add" title="新增配置页" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px;" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm','enctype':"multipart/form-data"}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>类型</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="key" data-options="panelHeight:'auto'" id="richKey">*/
/*                     <option value="richdayconfig">日榜</option>*/
/*                     <!--<option value="richweekconfig">周榜</option>-->*/
/*                     <option value="richmonthconfig">月榜</option>*/
/*                     <option value="richseasonconfig">季榜</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>添加奖项</td>*/
/*             <td id="content"><input type="button" value="添加奖励" onclick="openReward();"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* <div id="dlg-add-reward" title="新增奖励" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px;" modal="true" closed="true">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addRewardForm','enctype':"multipart/form-data"}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>排名</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="rank" data-options="panelHeight:'auto'" id="rank">*/
/*                     <option value="1">第一名</option>*/
/*                     <option value="2">第二名</option>*/
/*                     <option value="3">第三名</option>*/
/*                     <option value="4">第四名</option>*/
/*                     <option value="5">第五名</option>*/
/*                     <option value="6">第六名</option>*/
/*                     <option value="7">第七名</option>*/
/*                     <option value="8">第八名</option>*/
/*                     <option value="9">第九名</option>*/
/*                     <option value="10">第十名</option>*/
/*                     <option value="11-50">第十一名到第五十名</option>*/
/*                     <option value="51-100">第五十一名到第一百名</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>类型</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="type" data-options="panelHeight:'auto'" id="type">*/
/*                     <option value="1">实物</option>*/
/*                     <option value="2">现金</option>*/
/*                     <option value="3">返现</option>*/
/*                     <option value="4">红包</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>奖品</td>*/
/*             <td><input class="easyui-textbox" name="reward" class="reward" id="reward"/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>奖品图片</td>*/
/*             <td><input class="easyui-filebox" name="file" class="picture" id="picture"/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td></td>*/
/*             <td><a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitRewardForm()" style="width: 80px;">确定</a></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-edit" class="easyui-window" title="修改配置" style="width:500px;height:600px;padding:10px;" data-options="iconCls:'icon-save',closed:true,modal:true,onResize:function(){ $(this).window('hcenter');}">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe"></iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     $('#picture').filebox({*/
/*         onChange: function(n, o){*/
/*             if(n != ''){*/
/*                 $('#addRewardForm').form({*/
/*                     url: '{{ url("rich/upload") }}',*/
/*                     onSubmit: function(param){*/
/*                     },*/
/*                     success: function (data) {*/
/*                         $('#picture').attr('data-id', data);*/
/*                     }*/
/*                 });*/
/*                 $('#addRewardForm').submit();*/
/*             }*/
/*         }*/
/*     })*/
/* */
/*     function openReward()*/
/*     {*/
/*         $('#dlg-add-reward').dialog('open');*/
/*         $('#picture').filebox('setValue', '');*/
/*         $('#picture').removeAttr('data-id');*/
/*     }*/
/* */
/*     function edit()*/
/*     {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请至少选择一个');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#edit_iframe').prop('src', "{{ url('rich/edit-reward') }}" + '?type=' + selRow.type);*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function submitRewardForm()*/
/*     {*/
/*         var type = $('#type').combobox('getValue');*/
/*         var name = $('#reward').textbox('getValue');*/
/*         var rank = $('#rank').combobox('getValue');*/
/*         var picture = $('#picture').attr('data-id');*/
/* */
/*         if(type != 1){*/
/*             if(parseInt(name) != name){*/
/*                 $.messager.alert('错误','奖品必须为整数');*/
/*                 return false;*/
/*             }*/
/*         }*/
/*         if(name == ''){*/
/*             $.messager.alert('错误','奖品不能为空');*/
/*             return false;*/
/*         }*/
/*         if(picture == undefined){*/
/*             picture = '';*/
/*             $('#content').append('<p class="goods-name" data-rank="'+rank+'" data-name="'+name+'" data-type="'+type+'">第'+rank+'名  <span>'+name+'</span>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delReward(this)">删除</a></p>');*/
/*         }else{*/
/*             $('#content').append('<p class="goods-name" data-rank="'+rank+'" data-name="'+name+'" data-type="'+type+'" data-picture="'+picture+'">第'+rank+'名  <span>'+name+'</span>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delReward(this)">删除</a></p>');*/
/*         }*/
/* */
/* */
/*         $('#dlg-add-reward').dialog('close');*/
/*     }*/
/* */
/*     function delReward(nowP){*/
/*         $.messager.confirm('Confirm', '您确定删除该奖品吗？', function(r) {*/
/*             if (r) {*/
/*                 $(nowP).parent('p').remove();*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     function del()*/
/*     {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请至少选择一个');*/
/*             return false;*/
/*         }*/
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             $.post('/rich/del-config', {'type':selRow.type}, function(data){*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){location.reload();}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             })*/
/*         });*/
/*     }*/
/* */
/*     function save()*/
/*     {*/
/*         $('#addForm').form({*/
/*             url: '{{ url("rich/reward-config") }}',*/
/*             onSubmit: function(param){*/
/*                 var isValid = $(this).form('validate');*/
/*                 if (!isValid){*/
/*                     $.messager.progress('close');	// 如果表单是无效的则隐藏进度条*/
/*                 }*/
/*                 var json = {};*/
/*                 var jsonArrKey = 0;*/
/*                 $(".goods-name").each(function(k){*/
/*                     var rank = $(this).attr('data-rank');*/
/*                     var type = $(this).attr('data-type');*/
/*                     var name = $(this).attr('data-name');*/
/*                     var picture = $(this).attr('data-picture');*/
/*                     if(picture == undefined) picture = '';*/
/*                     if (rank.indexOf('-')>0) {*/
/*                         var  rankArr = rank.split('-');*/
/*                         var start = parseInt(rankArr[0]);*/
/*                         var end = parseInt(rankArr[1]);*/
/*                         for(var i=start;i<=end;i++) {*/
/*                             json[jsonArrKey] = {'rank':i, 'type':type, 'name':name, 'picture':picture};*/
/*                             jsonArrKey ++;*/
/*                         }*/
/*                     } else {*/
/*                         json[jsonArrKey] = {'rank':rank, 'type':type, 'name':name, 'picture':picture};*/
/*                         jsonArrKey ++;*/
/*                     }*/
/*                 });*/
/*                 var jsonArr = JSON.stringify(json);*/
/*                 console.log(jsonArr);*/
/*                 param.content = jsonArr;*/
/*                 return isValid;	// 返回false终止表单提交*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){location.reload();}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#addForm').submit();*/
/*     }*/
/* */
/*     /*function edit(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('active/edit') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* *//* */
/* </script>*/
/* {% endblock %}*/
/* */
/* */
