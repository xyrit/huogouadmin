<?php

/* add.html */
class __TwigTemplate_59e47abcd78592fd2c9b4aa1bc5e4d5af95c4e3c4491877e734c7010b18e9eab extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "add.html", 1);
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
        echo "<link href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/css/bootstrap.css\" rel=\"stylesheet\">
<link href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/css/fileinput.min.css\" media=\"all\" rel=\"stylesheet\" type=\"text/css\"/>
<style>
    table tr td:first-child,table tr td:first-child{
        width:120px;
    }
    table tr {
        margin: 10px;
    }
    .file-preview-frame {
        position: relative;
    }
    .product_cover {
        width: 100px;
        position: absolute;
        left: 95px;
        color: green;
    }
    .set_product_cover {
        width: 120px;
        position: absolute;
        left: 68px;
        color: green;
        cursor: pointer;
    }
</style>
";
    }

    // line 32
    public function block_main($context, array $blocks = array())
    {
        // line 33
        echo "<div style=\"width:100%; padding:10px 60px 20px 60px\" style=\"\">
    ";
        // line 34
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "/product/add", 1 => "post", 2 => array("id" => "product-form", "name" => "product-form")), "method");
        echo "
    <table cellpadding=\"5\" width=\"100%\">
        <tr>
            <td>选择分类</td>
            <td><input class=\"easyui-combotree\" name=\"Product[cat_id]\" id=\"cat_id\" data-options=\"url:'";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product-category/all-list"), "html", null, true);
        echo "',method:'get'\" editable=\"true\"></td>
        </tr>
        <tr>
            <td>品牌</td>
            <td><input class=\"easyui-combobox\" name=\"Product[brand_id]\" data-options=\"url:'";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("brand/list"), "html", null, true);
        echo "', method:'get', valueField: 'id', textField: 'text', required:true\" /></td>
        </tr>
        <tr>
            <td>商品名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Product[name]\" data-options=\"required:true, width:'80%' \" /></td>
        </tr>
        <tr>
            <td>伙购期数</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Product[store]\" data-options=\"required:true\" /></td>
        </tr>
        <tr>
            <td>限购数量</td>
            <td>
                <input name=\"limit_num\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"0\">否
                <input name=\"limit_num\" type=\"radio\" class=\"easyui-validatebox\" value=\"1\">是
                <i style=\"font-style: normal; display: none\" id=\"limit_num\"><input class=\"easyui-textbox\" validType=\"checklimitnum['Product[limit_num]']\" type=\"text\" name=\"Product[limit_num]\" value=\"0\" id=\"limit\" /></i>
            </td>
        </tr>
        <tr>
            <td>十倍专区</td>
            <td>
                <input name=\"buy_unit\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"1\">否
                <input name=\"buy_unit\" type=\"radio\" class=\"easyui-validatebox\" value=\"10\">是
            </td>
        </tr>
        <tr>
            <td>商品编号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Product[bn]\" data-options=\"required:true\" /></td>
        </tr>
        <tr>
            <td>伙购价(元)</td>
            <td><input class=\"easyui-numberbox\" precision=\"0\" name=\"Product[price]\" data-options=\"required:true\" /></td>
        </tr>
        <tr>
            <td>面值(元)</td>
            <td><input class=\"easyui-numberbox\" precision=\"0\" name=\"Product[face_value]\" data-options=\"required:true\" /></td>
        </tr>
        <!--<tr>-->
            <!--<td>成本价(元)</td>-->
            <!--<td><input class=\"easyui-numberbox\" precision=\"0\" name=\"Product[cost]\" data-options=\"required:true\" /></td>-->
        <!--</tr>-->
        <tr>
            <td>商品条码</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Product[barcode]\" /></td>
        </tr>
        <tr>
            <td>商品标签</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Product[tag]\" data-options=\"required:true, width:'80%' \" /></td>
        </tr>
        <tr>
            <td>商品简介</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Product[brief]\" data-options=\"required:true, width:'80%' \" /></td>
        </tr>
        <tr>
            <td>关键字</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Product[keywords]\" data-options=\"required:true, width:'80%' \" /></td>
        </tr>
        <tr>
            <td>发货方式</td>
            <td>
                ";
        // line 102
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["deliveryItems"]) ? $context["deliveryItems"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 103
            echo "                <input name=\"Product[delivery_id][]\" type=\"radio\" class=\"easyui-validatebox\" value=\"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["item"], "html", null, true);
            echo "
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
        echo "            </td>
        </tr>
        <tr>
            <td>订单处理小组</td>
            <td><input class=\"easyui-combobox\" name=\"Product[order_manage_gid]\" data-options=\"url:'";
        // line 109
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("order-manage-group/list"), "html", null, true);
        echo "', method:'get', valueField: 'id', textField: 'name', required:true\" /></td>
        </tr>
        <tr>
            <td>商品相册</td>
            <td>
                <div id=\"product-images-div\">
                    <input id=\"product-images\" type=\"file\" name=\"imageFile\" multiple accept=\"image/*\">
                </div>
            </td>
            <input type=\"hidden\" id=\"product-picture\" name=\"Product[picture]\">
        </tr>
        <tr>
            <td>是否推荐</td>
            <td>
                <input name=\"Product[is_recommend]\" type=\"radio\" class=\"easyui-validatebox\" value=\"1\">是
                <input name=\"Product[is_recommend]\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"0\">否
            </td>
        </tr>
        <tr>
            <td>显示地址</td>
            <td>
                <input name=\"Product[display]\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"0\">全部
                <input name=\"Product[display]\" type=\"radio\" class=\"easyui-validatebox\" value=\"1\">伙购
                <input name=\"Product[display]\" type=\"radio\" class=\"easyui-validatebox\" value=\"2\">滴滴
            </td>
        </tr>
        <tr>
            <td>排序</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Product[list_order]\" data-options=\"required:true\" /></td>
        </tr>
        <tr>
            <td>是否上架</td>
            <td>
                <input name=\"Product[marketable]\" type=\"radio\" class=\"easyui-validatebox\" value=\"1\">是
                <input name=\"Product[marketable]\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"0\">否
            </td>
        </tr>
        <tr>
            <td>允许晒单</td>
            <td>
                <input name=\"Product[allow_share]\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"1\">是
                <input name=\"Product[allow_share]\" type=\"radio\" class=\"easyui-validatebox\" value=\"0\">否
            </td>
        </tr>
        <tr>
            <td>商品详情</td>
            <td><textarea id=\"product-intro\" rows=5 style=\"width: 931px;\" name=\"Product[intro]\"></textarea></td>
        </tr>
        <tr>
            <td><a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm()\" style=\"width: 80px;\">确定</a></td>
            <td><a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"clearForm()\" style=\"width: 80px;\">取消</a></td>
        </tr>
    </table>
    ";
        // line 162
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
";
    }

    // line 166
    public function block_script($context, array $blocks = array())
    {
        // line 167
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/fileinput.min.js\"></script>
<script src=\"";
        // line 168
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/fileinput_locale_zh.js\"></script>
<script charset=\"utf-8\" src=\"";
        // line 169
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/kindeditor-4.1.10/kindeditor-all-min.js\"></script>
<script>
    \$.extend(\$.fn.validatebox.defaults.rules, {
        checkbox: {
            validator: function (value, param) {
                var frm = param[0], groupname = param[1], checkNum = 0;
                \$('input[name=\"' + groupname + '\"]', document[frm]).each(function () { //查找表单中所有此名称的checkbox
                    if (this.checked) checkNum++;
                });

                return checkNum > 0;
            },
            message: '至少选择1项！'
        },
        checklimitnum: {
            validator: function (value, param) {
                // if(value != 0 && value != 5){
                //     \$('#limit').textbox('setValue', 5);
                // }
                return true;
            },
            message: ''
        }
    });
    \$('input[name=limit_num]').on('click', function() {
        if (\$(this).val() == 0) {
            \$('#limit_num').hide();
            \$('#limit').textbox('setValue', 0);
        } else {
            \$('#limit_num').show();
        }
    });
    \$('input[name=\"Product[is_recommend]\"]').on('click', function(){
        var recomm = \$('input[name=\"Product[is_recommend]\"]:checked').val();
        if(recomm == 1){
            \$.post(\"";
        // line 204
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "/product/check-recommand")), "html", null, true);
        echo "\", {}, function (data) {
                if (data.error == 1) {
                    \$.messager.alert('失败', data.message, 'error');
                    \$('input[name=\"Product[is_recommend]\"]').eq(1).prop('checked', true)
                    return false;
                }
            });
        }
    })
    \$(\"#product-images\").fileinput({
        language: 'zh',
        uploadUrl: \"";
        // line 215
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "/product/upload-image")), "html", null, true);
        echo "\",
        previewSettings:{image: {width: \"160px\", height: \"160px\"}},
        showUpload: false,
        showClose: false,
        showRemove: false,
        allowedFileExtensions: [\"jpg\", \"png\", \"gif\"],
        minImageWidth: 400,
        minImageHeight: 400,
        overwriteInitial: false,
    });

    \$('#product-images-div').on('click', '.set_product_cover', function() {
        var previewId = \$(this).parent().attr('id');
        var album = \$(this).attr('basename');
        \$('#product-picture').val(album);
        var p_album = \$('.file-preview-frame .product_cover').attr('basename');
        \$('.file-preview-frame .product_cover').after(\"<a class='set_product_cover' basename='\"+p_album+\"'>设为封面</a>\").remove();
        \$(this).after(\"<span class='product_cover' basename='\"+album+\"'>封面</span>\").remove();
        return false;
    });

    \$('#product-images').on('fileloaded', function (event, file, previewId, index, reader) {
        \$('#'+previewId).find('.glyphicon-upload').click();
    });
    \$('#product-images').on('fileuploaded', function (event, data, previewId, index) {
        var response = data.response;
        response = JSON.parse(response);
        if (index==0) {
            \$('#product-picture').val(response.basename);
            \$('#'+previewId+' img').after('<span class=\"product_cover\" basename=\"'+response.basename+'\">封面</span>');
        } else {
            \$('#'+previewId+' img').after('<a class=\"set_product_cover\" basename=\"'+response.basename+'\">设为封面</a>');
        }
        \$('#product-form').append('<input type=\"hidden\" id=\"'+previewId+'_album\" name=\"album[]\" value=\"' + response.basename + '\">');
    });
    \$('#product-images').on('filesuccessremove', function(event, id) {
        \$.post(\"";
        // line 251
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "/product/delete-image")), "html", null, true);
        echo "\",//未关联商品的图片删除
                {key: 0,picture:\$('#'+id+'_album').val()},
                function (data) {
                    console.log(data);
                }
        );
        \$('#'+id+'_album').remove();
    });

    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#product-intro', {
            resizeType : 2,
            allowPreviewEmoticons : false,
            allowImageUpload : true,
            minHeight: 400,
            uploadJson : \"";
        // line 267
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "/product/upload-info-image")), "html", null, true);
        echo "\",
            items : [
                'source', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'multiimage', 'link', 'fullscreen'
            ]
        });
        editor.clickToolbar('fullscreen', function() {
            \$('body').css({
                'height' : '100%',
            });
        });
    });

    \$('#product-limit_num').keyup(function(){
        var nums = \$(this).val();
        if(nums != 0 && nums != 5){
            \$(this).val(5);
        }
    })

    function submitForm() {
        \$('#product-form').form({
            onSubmit:function(){
                result = \$(this).form('enableValidation').form('validate');
                if (result) {
                    if (\$('.file-preview-frame').length > 5) {
                        \$.messager.alert('失败', '商品图片不能超过5张', 'error');
                        return false;
                    }
                    if (editor.html() == '') {
                        \$.messager.alert('失败', '商品详情不能为空', 'error');
                        return false;
                    }
                    \$('#product-intro').val(editor.html());
                }
                return result;
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    parent.reloadgrid();
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#product-form').submit();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "add.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  357 => 267,  338 => 251,  299 => 215,  285 => 204,  247 => 169,  243 => 168,  238 => 167,  235 => 166,  228 => 162,  172 => 109,  166 => 105,  155 => 103,  151 => 102,  88 => 42,  81 => 38,  74 => 34,  71 => 33,  68 => 32,  38 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block css %}*/
/* <link href="{{ app.params.skinUrl }}/css/bootstrap.css" rel="stylesheet">*/
/* <link href="{{ app.params.skinUrl }}/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>*/
/* <style>*/
/*     table tr td:first-child,table tr td:first-child{*/
/*         width:120px;*/
/*     }*/
/*     table tr {*/
/*         margin: 10px;*/
/*     }*/
/*     .file-preview-frame {*/
/*         position: relative;*/
/*     }*/
/*     .product_cover {*/
/*         width: 100px;*/
/*         position: absolute;*/
/*         left: 95px;*/
/*         color: green;*/
/*     }*/
/*     .set_product_cover {*/
/*         width: 120px;*/
/*         position: absolute;*/
/*         left: 68px;*/
/*         color: green;*/
/*         cursor: pointer;*/
/*     }*/
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block main %}*/
/* <div style="width:100%; padding:10px 60px 20px 60px" style="">*/
/*     {{ html.beginForm('/product/add', 'post', {'id':'product-form', 'name':'product-form'}) | raw }}*/
/*     <table cellpadding="5" width="100%">*/
/*         <tr>*/
/*             <td>选择分类</td>*/
/*             <td><input class="easyui-combotree" name="Product[cat_id]" id="cat_id" data-options="url:'{{ url('product-category/all-list') }}',method:'get'" editable="true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>品牌</td>*/
/*             <td><input class="easyui-combobox" name="Product[brand_id]" data-options="url:'{{ url('brand/list') }}', method:'get', valueField: 'id', textField: 'text', required:true" /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Product[name]" data-options="required:true, width:'80%' " /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>伙购期数</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Product[store]" data-options="required:true" /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>限购数量</td>*/
/*             <td>*/
/*                 <input name="limit_num" type="radio" class="easyui-validatebox" checked value="0">否*/
/*                 <input name="limit_num" type="radio" class="easyui-validatebox" value="1">是*/
/*                 <i style="font-style: normal; display: none" id="limit_num"><input class="easyui-textbox" validType="checklimitnum['Product[limit_num]']" type="text" name="Product[limit_num]" value="0" id="limit" /></i>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>十倍专区</td>*/
/*             <td>*/
/*                 <input name="buy_unit" type="radio" class="easyui-validatebox" checked value="1">否*/
/*                 <input name="buy_unit" type="radio" class="easyui-validatebox" value="10">是*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品编号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Product[bn]" data-options="required:true" /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>伙购价(元)</td>*/
/*             <td><input class="easyui-numberbox" precision="0" name="Product[price]" data-options="required:true" /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>面值(元)</td>*/
/*             <td><input class="easyui-numberbox" precision="0" name="Product[face_value]" data-options="required:true" /></td>*/
/*         </tr>*/
/*         <!--<tr>-->*/
/*             <!--<td>成本价(元)</td>-->*/
/*             <!--<td><input class="easyui-numberbox" precision="0" name="Product[cost]" data-options="required:true" /></td>-->*/
/*         <!--</tr>-->*/
/*         <tr>*/
/*             <td>商品条码</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Product[barcode]" /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品标签</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Product[tag]" data-options="required:true, width:'80%' " /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品简介</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Product[brief]" data-options="required:true, width:'80%' " /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>关键字</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Product[keywords]" data-options="required:true, width:'80%' " /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>发货方式</td>*/
/*             <td>*/
/*                 {% for key,item in deliveryItems %}*/
/*                 <input name="Product[delivery_id][]" type="radio" class="easyui-validatebox" value="{{key}}">{{item}}*/
/*                 {% endfor %}*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>订单处理小组</td>*/
/*             <td><input class="easyui-combobox" name="Product[order_manage_gid]" data-options="url:'{{ url('order-manage-group/list') }}', method:'get', valueField: 'id', textField: 'name', required:true" /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品相册</td>*/
/*             <td>*/
/*                 <div id="product-images-div">*/
/*                     <input id="product-images" type="file" name="imageFile" multiple accept="image/*">*/
/*                 </div>*/
/*             </td>*/
/*             <input type="hidden" id="product-picture" name="Product[picture]">*/
/*         </tr>*/
/*         <tr>*/
/*             <td>是否推荐</td>*/
/*             <td>*/
/*                 <input name="Product[is_recommend]" type="radio" class="easyui-validatebox" value="1">是*/
/*                 <input name="Product[is_recommend]" type="radio" class="easyui-validatebox" checked value="0">否*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>显示地址</td>*/
/*             <td>*/
/*                 <input name="Product[display]" type="radio" class="easyui-validatebox" checked value="0">全部*/
/*                 <input name="Product[display]" type="radio" class="easyui-validatebox" value="1">伙购*/
/*                 <input name="Product[display]" type="radio" class="easyui-validatebox" value="2">滴滴*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>排序</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Product[list_order]" data-options="required:true" /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>是否上架</td>*/
/*             <td>*/
/*                 <input name="Product[marketable]" type="radio" class="easyui-validatebox" value="1">是*/
/*                 <input name="Product[marketable]" type="radio" class="easyui-validatebox" checked value="0">否*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>允许晒单</td>*/
/*             <td>*/
/*                 <input name="Product[allow_share]" type="radio" class="easyui-validatebox" checked value="1">是*/
/*                 <input name="Product[allow_share]" type="radio" class="easyui-validatebox" value="0">否*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品详情</td>*/
/*             <td><textarea id="product-intro" rows=5 style="width: 931px;" name="Product[intro]"></textarea></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td><a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width: 80px;">确定</a></td>*/
/*             <td><a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width: 80px;">取消</a></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script src="{{ app.params.skinUrl }}/js/fileinput.min.js"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/fileinput_locale_zh.js"></script>*/
/* <script charset="utf-8" src="{{ app.params.skinUrl }}/js/kindeditor-4.1.10/kindeditor-all-min.js"></script>*/
/* <script>*/
/*     $.extend($.fn.validatebox.defaults.rules, {*/
/*         checkbox: {*/
/*             validator: function (value, param) {*/
/*                 var frm = param[0], groupname = param[1], checkNum = 0;*/
/*                 $('input[name="' + groupname + '"]', document[frm]).each(function () { //查找表单中所有此名称的checkbox*/
/*                     if (this.checked) checkNum++;*/
/*                 });*/
/* */
/*                 return checkNum > 0;*/
/*             },*/
/*             message: '至少选择1项！'*/
/*         },*/
/*         checklimitnum: {*/
/*             validator: function (value, param) {*/
/*                 // if(value != 0 && value != 5){*/
/*                 //     $('#limit').textbox('setValue', 5);*/
/*                 // }*/
/*                 return true;*/
/*             },*/
/*             message: ''*/
/*         }*/
/*     });*/
/*     $('input[name=limit_num]').on('click', function() {*/
/*         if ($(this).val() == 0) {*/
/*             $('#limit_num').hide();*/
/*             $('#limit').textbox('setValue', 0);*/
/*         } else {*/
/*             $('#limit_num').show();*/
/*         }*/
/*     });*/
/*     $('input[name="Product[is_recommend]"]').on('click', function(){*/
/*         var recomm = $('input[name="Product[is_recommend]"]:checked').val();*/
/*         if(recomm == 1){*/
/*             $.post("{{ url(['/product/check-recommand']) }}", {}, function (data) {*/
/*                 if (data.error == 1) {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                     $('input[name="Product[is_recommend]"]').eq(1).prop('checked', true)*/
/*                     return false;*/
/*                 }*/
/*             });*/
/*         }*/
/*     })*/
/*     $("#product-images").fileinput({*/
/*         language: 'zh',*/
/*         uploadUrl: "{{ url(['/product/upload-image']) }}",*/
/*         previewSettings:{image: {width: "160px", height: "160px"}},*/
/*         showUpload: false,*/
/*         showClose: false,*/
/*         showRemove: false,*/
/*         allowedFileExtensions: ["jpg", "png", "gif"],*/
/*         minImageWidth: 400,*/
/*         minImageHeight: 400,*/
/*         overwriteInitial: false,*/
/*     });*/
/* */
/*     $('#product-images-div').on('click', '.set_product_cover', function() {*/
/*         var previewId = $(this).parent().attr('id');*/
/*         var album = $(this).attr('basename');*/
/*         $('#product-picture').val(album);*/
/*         var p_album = $('.file-preview-frame .product_cover').attr('basename');*/
/*         $('.file-preview-frame .product_cover').after("<a class='set_product_cover' basename='"+p_album+"'>设为封面</a>").remove();*/
/*         $(this).after("<span class='product_cover' basename='"+album+"'>封面</span>").remove();*/
/*         return false;*/
/*     });*/
/* */
/*     $('#product-images').on('fileloaded', function (event, file, previewId, index, reader) {*/
/*         $('#'+previewId).find('.glyphicon-upload').click();*/
/*     });*/
/*     $('#product-images').on('fileuploaded', function (event, data, previewId, index) {*/
/*         var response = data.response;*/
/*         response = JSON.parse(response);*/
/*         if (index==0) {*/
/*             $('#product-picture').val(response.basename);*/
/*             $('#'+previewId+' img').after('<span class="product_cover" basename="'+response.basename+'">封面</span>');*/
/*         } else {*/
/*             $('#'+previewId+' img').after('<a class="set_product_cover" basename="'+response.basename+'">设为封面</a>');*/
/*         }*/
/*         $('#product-form').append('<input type="hidden" id="'+previewId+'_album" name="album[]" value="' + response.basename + '">');*/
/*     });*/
/*     $('#product-images').on('filesuccessremove', function(event, id) {*/
/*         $.post("{{ url(['/product/delete-image']) }}",//未关联商品的图片删除*/
/*                 {key: 0,picture:$('#'+id+'_album').val()},*/
/*                 function (data) {*/
/*                     console.log(data);*/
/*                 }*/
/*         );*/
/*         $('#'+id+'_album').remove();*/
/*     });*/
/* */
/*     var editor;*/
/*     KindEditor.ready(function(K) {*/
/*         editor = K.create('#product-intro', {*/
/*             resizeType : 2,*/
/*             allowPreviewEmoticons : false,*/
/*             allowImageUpload : true,*/
/*             minHeight: 400,*/
/*             uploadJson : "{{ url(['/product/upload-info-image']) }}",*/
/*             items : [*/
/*                 'source', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',*/
/*                 'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',*/
/*                 'insertunorderedlist', '|',  'multiimage', 'link', 'fullscreen'*/
/*             ]*/
/*         });*/
/*         editor.clickToolbar('fullscreen', function() {*/
/*             $('body').css({*/
/*                 'height' : '100%',*/
/*             });*/
/*         });*/
/*     });*/
/* */
/*     $('#product-limit_num').keyup(function(){*/
/*         var nums = $(this).val();*/
/*         if(nums != 0 && nums != 5){*/
/*             $(this).val(5);*/
/*         }*/
/*     })*/
/* */
/*     function submitForm() {*/
/*         $('#product-form').form({*/
/*             onSubmit:function(){*/
/*                 result = $(this).form('enableValidation').form('validate');*/
/*                 if (result) {*/
/*                     if ($('.file-preview-frame').length > 5) {*/
/*                         $.messager.alert('失败', '商品图片不能超过5张', 'error');*/
/*                         return false;*/
/*                     }*/
/*                     if (editor.html() == '') {*/
/*                         $.messager.alert('失败', '商品详情不能为空', 'error');*/
/*                         return false;*/
/*                     }*/
/*                     $('#product-intro').val(editor.html());*/
/*                 }*/
/*                 return result;*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     parent.reloadgrid();*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#product-form').submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
