<?php

/* edit.html */
class __TwigTemplate_974367b28294dde2865dbce02e7a476cf2a9dbc53e28fee628defb8047a7aa61 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "edit.html", 1);
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
    table tr td:first-child, table tr td:first-child {
        width: 120px;
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

    // line 36
    public function block_main($context, array $blocks = array())
    {
        // line 37
        echo "<div style=\"width:100%; padding:10px 60px 20px 60px\" style=\"\">
    ";
        // line 38
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("id" => "product-form", "name" => "product-form")), "method");
        echo "
    <table cellpadding=\"5\" width=\"100%\">
        <tr>
            <td>选择分类</td>
            <td><input class=\"easyui-combotree\" name=\"Product[cat_id]\" id=\"cat_id\"
                       data-options=\"url:'";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product-category/all-list"), "html", null, true);
        echo "',method:'get', onLoadSuccess: function() {\$('#cat_id').combotree('setValue', '";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "cat_id", array()), "html", null, true);
        echo "');}\"
                       editable=\"true\"></td>
        </tr>
        <tr>
            <td>品牌</td>
            <td><input class=\"easyui-combobox\" name=\"Product[brand_id]\" id=\"brand_id\"
                       data-options=\"url:'";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("brand/list"), "html", null, true);
        echo "', method:'get', valueField: 'id', textField: 'text', required:true, onLoadSuccess: function() {\$('#brand_id').combobox('setValue', '";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "brand_id", array()), "html", null, true);
        echo "');}\"/>
            </td>
        </tr>
        <tr>
            <td>商品名称</td>
            <td><input class=\"easyui-textbox\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "name", array()), "html", null, true);
        echo "\" type=\"text\" name=\"Product[name]\"
                       data-options=\"required:true, width:'80%'\"/></td>
        </tr>
        <tr>
            <td>伙购期数</td>
            <td><input class=\"easyui-textbox\" value=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "store", array()), "html", null, true);
        echo "\" type=\"text\" name=\"Product[store]\"
                       data-options=\"required:true\"/></td>
        </tr>
        <tr>
            <td>限购数量</td>
            <td>
                <input name=\"limit_num\" type=\"radio\" class=\"easyui-validatebox\" ";
        // line 65
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "limit_num", array()) == 0)) {
            // line 66
            echo "checked";
        }
        echo " value=\"0\">否
                <input name=\"limit_num\" type=\"radio\" class=\"easyui-validatebox\" ";
        // line 67
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "limit_num", array()) > 0)) {
            // line 68
            echo "checked";
        }
        echo " value=\"1\">是
                <i style=\"font-style: normal; display: ";
        // line 69
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "limit_num", array()) == 0)) {
            echo "none";
        } else {
            echo "inline";
        }
        echo "\"
                   id=\"limit_num\"><input class=\"easyui-textbox\" validType=\"checklimitnum['Product[limit_num]']\"
                                         type=\"text\" name=\"Product[limit_num]\" value=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "limit_num", array()), "html", null, true);
        echo "\"
                                         id=\"limit\"/></i>
            </td>
        </tr>
        <tr>
            <td>十倍专区</td>
            <td>
                <input name=\"Product[buy_unit]\" type=\"radio\" class=\"easyui-validatebox\" ";
        // line 78
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "buy_unit", array()) == 1)) {
            // line 79
            echo "checked";
        }
        echo " value=\"1\">否
                <input name=\"Product[buy_unit]\" type=\"radio\" class=\"easyui-validatebox\" ";
        // line 80
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "buy_unit", array()) == 10)) {
            // line 81
            echo "checked";
        }
        echo " value=\"10\">是
            </td>
        </tr>
        <tr>
            <td>商品编号</td>
            <td><input class=\"easyui-textbox\" value=\"";
        // line 86
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "bn", array()), "html", null, true);
        echo "\" type=\"text\" name=\"Product[bn]\"
                       data-options=\"required:true\"/></td>
        </tr>
        <tr>
            <td>伙购价(元)</td>
            <td><input class=\"easyui-numberbox\" value=\"";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "price", array()), "html", null, true);
        echo "\" precision=\"0\" name=\"Product[price]\"
                       data-options=\"required:true\"/></td>
        </tr>
        <tr>
            <td>面值(元)</td>
            <td><input class=\"easyui-numberbox\" value=\"";
        // line 96
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "face_value", array()), "html", null, true);
        echo "\" precision=\"0\" name=\"Product[face_value]\"
                       data-options=\"required:true\"/></td>
        </tr>
        <!--<tr>-->
        <!--<td>成本价(元)</td>-->
        <!--<td><input class=\"easyui-numberbox\" value=\"";
        // line 101
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "cost", array()), "html", null, true);
        echo "\" precision=\"0\" name=\"Product[cost]\" data-options=\"required:true\" /></td>-->
        <!--</tr>-->
        <tr>
            <td>商品条码</td>
            <td><input class=\"easyui-textbox\" value=\"";
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "barcode", array()), "html", null, true);
        echo "\" type=\"text\" name=\"Product[barcode]\"/></td>
        </tr>
        <tr>
            <td>商品标签</td>
            <td><input class=\"easyui-textbox\" value=\"";
        // line 109
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "tag", array()), "html", null, true);
        echo "\" type=\"text\" name=\"Product[tag]\"
                       data-options=\"required:true, width:'80%' \"/></td>
        </tr>
        <tr>
            <td>商品简介</td>
            <td><input class=\"easyui-textbox\" value=\"";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "brief", array()), "html", null, true);
        echo "\" type=\"text\" name=\"Product[brief]\"
                       data-options=\"required:true, width:'80%' \"/></td>
        </tr>
        <tr>
            <td>关键字</td>
            <td><input class=\"easyui-textbox\" value=\"";
        // line 119
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "keywords", array()), "html", null, true);
        echo "\" type=\"text\" name=\"Product[keywords]\"
                       data-options=\"required:true, width:'80%' \"/></td>
        </tr>
        <tr>
            <td>发货方式</td>
            <td>
                ";
        // line 125
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["deliveryItems"]) ? $context["deliveryItems"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 126
            echo "                <input ";
            if (((isset($context["delivery"]) ? $context["delivery"] : null) == $context["key"])) {
                echo "checked";
            }
            echo " name=\"Product[delivery_id][]\" type=\"radio\"
                       class=\"easyui-validatebox\" value=\"";
            // line 127
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["item"], "html", null, true);
            echo "
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 129
        echo "            </td>
        </tr>
        <tr>
            <td>订单处理小组</td>
            <td><input class=\"easyui-combobox\" name=\"Product[order_manage_gid]\" id=\"order_manage_gid\"
                       data-options=\"url:'";
        // line 134
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("order-manage-group/list"), "html", null, true);
        echo "', method:'get', valueField: 'id', textField: 'name', required:true, onLoadSuccess: function() {\$('#order_manage_gid').combobox('setValue', '";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "order_manage_gid", array()), "html", null, true);
        echo "');}\"/>
            </td>
        </tr>
        <tr>
            <td>商品相册</td>
            <td>
                <div id=\"product-images-div\">
                    <input id=\"product-images\" type=\"file\" name=\"imageFile\" multiple accept=\"image/*\">
                </div>
            </td>
            <input type=\"hidden\" id=\"product-picture\" name=\"Product[picture]\" value=\"";
        // line 144
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "picture", array()), "html", null, true);
        echo "\">
        </tr>
        <tr>
            <td>是否推荐</td>
            <td>
                <input ";
        // line 149
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "is_recommend", array()) == 1)) {
            echo "checked";
        }
        echo " name=\"Product[is_recommend]\" type=\"radio\"
                       class=\"easyui-validatebox\" value=\"1\">是
                <input ";
        // line 151
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "is_recommend", array()) == 0)) {
            echo "checked";
        }
        echo " name=\"Product[is_recommend]\" type=\"radio\"
                       class=\"easyui-validatebox\" value=\"0\">否
            </td>
        </tr>
        <tr>
            <td>显示地址</td>
            <td>

                <input name=\"Product[display]\" type=\"radio\" class=\"easyui-validatebox\" ";
        // line 159
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "display", array()) == 0)) {
            // line 160
            echo "checked";
        }
        echo " value=\"0\">全部
                <input name=\"Product[display]\" type=\"radio\" class=\"easyui-validatebox\" ";
        // line 161
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "display", array()) == 1)) {
            // line 162
            echo "checked";
        }
        echo " value=\"1\">伙购
                <input name=\"Product[display]\" type=\"radio\" class=\"easyui-validatebox\" ";
        // line 163
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "display", array()) == 2)) {
            // line 164
            echo "checked";
        }
        echo " value=\"2\">滴滴
            </td>
        </tr>
        <tr>
            <td>排序</td>
            <td><input class=\"easyui-textbox\" value=\"";
        // line 169
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "list_order", array()), "html", null, true);
        echo "\" type=\"text\" name=\"Product[list_order]\"
                       data-options=\"required:true\"/></td>
        </tr>
        <tr>
            <td>是否上架</td>
            <td>
                <input ";
        // line 175
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "marketable", array()) == 1)) {
            echo "checked";
        }
        echo " name=\"Product[marketable]\" type=\"radio\"
                       class=\"easyui-validatebox\" value=\"1\">是
                <input ";
        // line 177
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "marketable", array()) == 0)) {
            echo "checked";
        }
        echo " name=\"Product[marketable]\" type=\"radio\"
                       class=\"easyui-validatebox\" value=\"0\">否
            </td>
        </tr>
        <tr>
            <td>允许晒单</td>
            <td>
                <input ";
        // line 184
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "allow_share", array()) == 1)) {
            echo "checked";
        }
        echo " name=\"Product[allow_share]\" type=\"radio\"
                       class=\"easyui-validatebox\" value=\"1\">是
                <input ";
        // line 186
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "allow_share", array()) == 0)) {
            echo "checked";
        }
        echo " name=\"Product[allow_share]\" type=\"radio\"
                       class=\"easyui-validatebox\" value=\"0\">否
            </td>
        </tr>
        <tr>
            <td>商品详情</td>
            <td><textarea id=\"product-intro\" rows=5 style=\"width: 931px;\"
                          name=\"Product[intro]\">";
        // line 193
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "intro", array()), "html", null, true);
        echo "</textarea></td>
        </tr>
        <tr>
            <td><a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm()\"
                   style=\"width: 80px;\">确定</a></td>
            <td><a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"clearForm()\" style=\"width: 80px;\">取消</a>
            </td>
        </tr>
    </table>
    ";
        // line 202
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
";
    }

    // line 206
    public function block_script($context, array $blocks = array())
    {
        // line 207
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/fileinput.min.js\"></script>
<script src=\"";
        // line 208
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/fileinput_locale_zh.js\"></script>
<script charset=\"utf-8\" src=\"";
        // line 209
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/kindeditor-4.1.10/kindeditor-all-min.js\"></script>
<script>
    //
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
    \$('input[name=limit_num]').on('click', function () {
        if (\$(this).val() == 0) {
            \$('#limit_num').hide();
            \$('#limit').textbox('setValue', 0);
        } else {
            \$('#limit_num').show();
        }
    });
    \$('input[name=\"Product[is_recommend]\"]').on('click', function () {
        var recomm = \$('input[name=\"Product[is_recommend]\"]:checked').val();
        if (recomm == 1) {
            \$.post(\"";
        // line 245
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
        // line 256
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "/product/upload-image")), "html", null, true);
        echo "\",
        previewSettings: {image: {width: \"160px\", height: \"160px\"}},
        showUpload: false,
        showClose: false,
        showRemove: false,
        allowedFileExtensions: [\"jpg\", \"png\", \"gif\"],
        minImageWidth: 400,
        minImageHeight: 400,
        overwriteInitial: false,
        initialPreview: [
        ";
        // line 266
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pictures"]) ? $context["pictures"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["pic"]) {
            // line 267
            echo "    ";
            if (($this->getAttribute($context["pic"], "basename", array()) == $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "picture", array()))) {
                // line 268
                echo "    \"<img src='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "url", array()), "html", null, true);
                echo "' class='file-preview-image' alt='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
                echo "' title='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
                echo "'><span class='product_cover' basename='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
                echo "'>封面</span>\",
    ";
            } else {
                // line 270
                echo "    \"<img src='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "url", array()), "html", null, true);
                echo "' class='file-preview-image' alt='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
                echo "' title='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
                echo "'><a class='set_product_cover' basename='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
                echo "'>设为封面</a>\",
    ";
            }
            // line 272
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "],
    // initial preview configuration
    initialPreviewConfig: [
    ";
        // line 275
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pictures"]) ? $context["pictures"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["pic"]) {
            // line 276
            echo "    {caption: '";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
            echo "', width:'120px', url:'";
            echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "/product/delete-image")), "html", null, true);
            echo "',//关联商品的图片删除
            extra:{product_id: ";
            // line 277
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "id", array()), "html", null, true);
            echo ",picture: '";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
            echo "'}},
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 278
        echo "]
    });

    \$('#product-images-div').on('click', '.set_product_cover', function () {
        var previewId = \$(this).parent().attr('id');
        var album = \$(this).attr('basename');
        \$('#product-picture').val(album);
        var p_album = \$('.file-preview-frame .product_cover').attr('basename');
        \$('.file-preview-frame .product_cover').after(\"<a class='set_product_cover' basename='\" + p_album + \"'>设为封面</a>\").remove();
        \$(this).after(\"<span class='product_cover' basename='\" + album + \"'>封面</span>\").remove();
        return false;
    });

    \$('#product-images').on('fileloaded', function (event, file, previewId, index, reader) {
        \$('#' + previewId).find('.glyphicon-upload').click();
    });
    \$('#product-images').on('fileuploaded', function (event, data, previewId, index) {
        var response = data.response;
        response = JSON.parse(response);
        if (index == 0) {
            \$('#product-picture').val(response.basename);
            \$('#' + previewId + ' img').after('<span class=\"product_cover\" basename=\"' + response.basename + '\">封面</span>');
        } else {
            \$('#' + previewId + ' img').after('<a class=\"set_product_cover\" basename=\"' + response.basename + '\">设为封面</a>');
        }
        \$('#product-form').append('<input type=\"hidden\" id=\"' + previewId + '_album\" name=\"album[]\" value=\"' + response.basename + '\">');
    });
    \$('#product-images').on('filesuccessremove', function (event, id) {
        \$.post(\"";
        // line 306
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "/product/delete-image")), "html", null, true);
        echo "\",//未关联商品的图片删除
                {key: 0, picture: \$('#' + id + '_album').val()},
                function (data) {
                    console.log(data);
                }
        );
        \$('#' + id + '_album').remove();
    });

    var editor;
    KindEditor.ready(function (K) {
        editor = K.create('#product-intro', {
            resizeType: 2,
            allowPreviewEmoticons: false,
            allowImageUpload: true,
            minHeight: 400,
            uploadJson: \"";
        // line 322
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url(array(0 => "/product/upload-info-image")), "html", null, true);
        echo "\",
            items: [
                'source', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'multiimage', 'link', 'fullscreen'
            ]
        });
        editor.clickToolbar('fullscreen', function () {
            \$('body').css({
                'height': '100%',
            });
        });
    });

    \$('#product-limit_num').keyup(function () {
        var nums = \$(this).val();
        if (nums != 0 && nums != 5) {
            \$(this).val(5);
        }
    })

    function submitForm() {
        \$('#product-form').form({
            url: \"";
        // line 345
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product/edit", array("id" => $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "id", array()))), "html", null, true);
        echo "\",
            onSubmit: function () {
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
        return "edit.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  615 => 345,  589 => 322,  570 => 306,  540 => 278,  530 => 277,  523 => 276,  519 => 275,  509 => 272,  497 => 270,  485 => 268,  482 => 267,  478 => 266,  465 => 256,  451 => 245,  412 => 209,  408 => 208,  403 => 207,  400 => 206,  393 => 202,  381 => 193,  369 => 186,  362 => 184,  350 => 177,  343 => 175,  334 => 169,  325 => 164,  323 => 163,  318 => 162,  316 => 161,  311 => 160,  309 => 159,  296 => 151,  289 => 149,  281 => 144,  266 => 134,  259 => 129,  249 => 127,  242 => 126,  238 => 125,  229 => 119,  221 => 114,  213 => 109,  206 => 105,  199 => 101,  191 => 96,  183 => 91,  175 => 86,  166 => 81,  164 => 80,  159 => 79,  157 => 78,  147 => 71,  138 => 69,  133 => 68,  131 => 67,  126 => 66,  124 => 65,  115 => 59,  107 => 54,  97 => 49,  86 => 43,  78 => 38,  75 => 37,  72 => 36,  38 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block css %}*/
/* <link href="{{ app.params.skinUrl }}/css/bootstrap.css" rel="stylesheet">*/
/* <link href="{{ app.params.skinUrl }}/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>*/
/* <style>*/
/*     table tr td:first-child, table tr td:first-child {*/
/*         width: 120px;*/
/*     }*/
/* */
/*     table tr {*/
/*         margin: 10px;*/
/*     }*/
/* */
/*     .file-preview-frame {*/
/*         position: relative;*/
/*     }*/
/* */
/*     .product_cover {*/
/*         width: 100px;*/
/*         position: absolute;*/
/*         left: 95px;*/
/*         color: green;*/
/*     }*/
/* */
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
/*     {{ html.beginForm('', 'post', {'id':'product-form', 'name':'product-form'}) | raw }}*/
/*     <table cellpadding="5" width="100%">*/
/*         <tr>*/
/*             <td>选择分类</td>*/
/*             <td><input class="easyui-combotree" name="Product[cat_id]" id="cat_id"*/
/*                        data-options="url:'{{ url('product-category/all-list') }}',method:'get', onLoadSuccess: function() {$('#cat_id').combotree('setValue', '{{ model.cat_id }}');}"*/
/*                        editable="true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>品牌</td>*/
/*             <td><input class="easyui-combobox" name="Product[brand_id]" id="brand_id"*/
/*                        data-options="url:'{{ url('brand/list') }}', method:'get', valueField: 'id', textField: 'text', required:true, onLoadSuccess: function() {$('#brand_id').combobox('setValue', '{{ model.brand_id }}');}"/>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品名称</td>*/
/*             <td><input class="easyui-textbox" value="{{ model.name }}" type="text" name="Product[name]"*/
/*                        data-options="required:true, width:'80%'"/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>伙购期数</td>*/
/*             <td><input class="easyui-textbox" value="{{ model.store }}" type="text" name="Product[store]"*/
/*                        data-options="required:true"/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>限购数量</td>*/
/*             <td>*/
/*                 <input name="limit_num" type="radio" class="easyui-validatebox" {% if model.limit_num== 0*/
/*                        %}checked{% endif %} value="0">否*/
/*                 <input name="limit_num" type="radio" class="easyui-validatebox" {% if model.limit_num> 0*/
/*                 %}checked{% endif %} value="1">是*/
/*                 <i style="font-style: normal; display: {% if model.limit_num == 0 %}none{% else %}inline{% endif %}"*/
/*                    id="limit_num"><input class="easyui-textbox" validType="checklimitnum['Product[limit_num]']"*/
/*                                          type="text" name="Product[limit_num]" value="{{ model.limit_num }}"*/
/*                                          id="limit"/></i>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>十倍专区</td>*/
/*             <td>*/
/*                 <input name="Product[buy_unit]" type="radio" class="easyui-validatebox" {% if model.buy_unit== 1*/
/*                        %}checked{% endif %} value="1">否*/
/*                 <input name="Product[buy_unit]" type="radio" class="easyui-validatebox" {% if model.buy_unit== 10*/
/*                        %}checked{% endif %} value="10">是*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品编号</td>*/
/*             <td><input class="easyui-textbox" value="{{ model.bn }}" type="text" name="Product[bn]"*/
/*                        data-options="required:true"/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>伙购价(元)</td>*/
/*             <td><input class="easyui-numberbox" value="{{ model.price }}" precision="0" name="Product[price]"*/
/*                        data-options="required:true"/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>面值(元)</td>*/
/*             <td><input class="easyui-numberbox" value="{{ model.face_value }}" precision="0" name="Product[face_value]"*/
/*                        data-options="required:true"/></td>*/
/*         </tr>*/
/*         <!--<tr>-->*/
/*         <!--<td>成本价(元)</td>-->*/
/*         <!--<td><input class="easyui-numberbox" value="{{ model.cost }}" precision="0" name="Product[cost]" data-options="required:true" /></td>-->*/
/*         <!--</tr>-->*/
/*         <tr>*/
/*             <td>商品条码</td>*/
/*             <td><input class="easyui-textbox" value="{{ model.barcode }}" type="text" name="Product[barcode]"/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品标签</td>*/
/*             <td><input class="easyui-textbox" value="{{ model.tag }}" type="text" name="Product[tag]"*/
/*                        data-options="required:true, width:'80%' "/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品简介</td>*/
/*             <td><input class="easyui-textbox" value="{{ model.brief }}" type="text" name="Product[brief]"*/
/*                        data-options="required:true, width:'80%' "/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>关键字</td>*/
/*             <td><input class="easyui-textbox" value="{{ model.keywords }}" type="text" name="Product[keywords]"*/
/*                        data-options="required:true, width:'80%' "/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>发货方式</td>*/
/*             <td>*/
/*                 {% for key,item in deliveryItems %}*/
/*                 <input {% if delivery== key %}checked{% endif %} name="Product[delivery_id][]" type="radio"*/
/*                        class="easyui-validatebox" value="{{key}}">{{item}}*/
/*                 {% endfor %}*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>订单处理小组</td>*/
/*             <td><input class="easyui-combobox" name="Product[order_manage_gid]" id="order_manage_gid"*/
/*                        data-options="url:'{{ url('order-manage-group/list') }}', method:'get', valueField: 'id', textField: 'name', required:true, onLoadSuccess: function() {$('#order_manage_gid').combobox('setValue', '{{ model.order_manage_gid }}');}"/>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品相册</td>*/
/*             <td>*/
/*                 <div id="product-images-div">*/
/*                     <input id="product-images" type="file" name="imageFile" multiple accept="image/*">*/
/*                 </div>*/
/*             </td>*/
/*             <input type="hidden" id="product-picture" name="Product[picture]" value="{{ model.picture }}">*/
/*         </tr>*/
/*         <tr>*/
/*             <td>是否推荐</td>*/
/*             <td>*/
/*                 <input {% if model.is_recommend== 1 %}checked{% endif %} name="Product[is_recommend]" type="radio"*/
/*                        class="easyui-validatebox" value="1">是*/
/*                 <input {% if model.is_recommend== 0 %}checked{% endif %} name="Product[is_recommend]" type="radio"*/
/*                        class="easyui-validatebox" value="0">否*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>显示地址</td>*/
/*             <td>*/
/* */
/*                 <input name="Product[display]" type="radio" class="easyui-validatebox" {% if model.display== 0*/
/*                        %}checked{% endif %} value="0">全部*/
/*                 <input name="Product[display]" type="radio" class="easyui-validatebox" {% if model.display== 1*/
/*                        %}checked{% endif %} value="1">伙购*/
/*                 <input name="Product[display]" type="radio" class="easyui-validatebox" {% if model.display== 2*/
/*                        %}checked{% endif %} value="2">滴滴*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>排序</td>*/
/*             <td><input class="easyui-textbox" value="{{ model.list_order }}" type="text" name="Product[list_order]"*/
/*                        data-options="required:true"/></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>是否上架</td>*/
/*             <td>*/
/*                 <input {% if model.marketable== 1 %}checked{% endif %} name="Product[marketable]" type="radio"*/
/*                        class="easyui-validatebox" value="1">是*/
/*                 <input {% if model.marketable== 0 %}checked{% endif %} name="Product[marketable]" type="radio"*/
/*                        class="easyui-validatebox" value="0">否*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>允许晒单</td>*/
/*             <td>*/
/*                 <input {% if model.allow_share== 1 %}checked{% endif %} name="Product[allow_share]" type="radio"*/
/*                        class="easyui-validatebox" value="1">是*/
/*                 <input {% if model.allow_share== 0 %}checked{% endif %} name="Product[allow_share]" type="radio"*/
/*                        class="easyui-validatebox" value="0">否*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品详情</td>*/
/*             <td><textarea id="product-intro" rows=5 style="width: 931px;"*/
/*                           name="Product[intro]">{{ model.intro }}</textarea></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td><a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()"*/
/*                    style="width: 80px;">确定</a></td>*/
/*             <td><a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width: 80px;">取消</a>*/
/*             </td>*/
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
/*     //*/
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
/*     $('input[name=limit_num]').on('click', function () {*/
/*         if ($(this).val() == 0) {*/
/*             $('#limit_num').hide();*/
/*             $('#limit').textbox('setValue', 0);*/
/*         } else {*/
/*             $('#limit_num').show();*/
/*         }*/
/*     });*/
/*     $('input[name="Product[is_recommend]"]').on('click', function () {*/
/*         var recomm = $('input[name="Product[is_recommend]"]:checked').val();*/
/*         if (recomm == 1) {*/
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
/*         previewSettings: {image: {width: "160px", height: "160px"}},*/
/*         showUpload: false,*/
/*         showClose: false,*/
/*         showRemove: false,*/
/*         allowedFileExtensions: ["jpg", "png", "gif"],*/
/*         minImageWidth: 400,*/
/*         minImageHeight: 400,*/
/*         overwriteInitial: false,*/
/*         initialPreview: [*/
/*         {% for pic in pictures %}*/
/*     {% if pic.basename == model.picture %}*/
/*     "<img src='{{ pic.url }}' class='file-preview-image' alt='{{ pic.basename }}' title='{{ pic.basename }}'><span class='product_cover' basename='{{ pic.basename }}'>封面</span>",*/
/*     {% else %}*/
/*     "<img src='{{ pic.url }}' class='file-preview-image' alt='{{ pic.basename }}' title='{{ pic.basename }}'><a class='set_product_cover' basename='{{ pic.basename }}'>设为封面</a>",*/
/*     {% endif %}*/
/*     {% endfor %}],*/
/*     // initial preview configuration*/
/*     initialPreviewConfig: [*/
/*     {% for pic in pictures %}*/
/*     {caption: '{{ pic.basename }}', width:'120px', url:'{{ url(['/product/delete-image']) }}',//关联商品的图片删除*/
/*             extra:{product_id: {{model.id}},picture: '{{ pic.basename }}'}},*/
/*     {% endfor %}]*/
/*     });*/
/* */
/*     $('#product-images-div').on('click', '.set_product_cover', function () {*/
/*         var previewId = $(this).parent().attr('id');*/
/*         var album = $(this).attr('basename');*/
/*         $('#product-picture').val(album);*/
/*         var p_album = $('.file-preview-frame .product_cover').attr('basename');*/
/*         $('.file-preview-frame .product_cover').after("<a class='set_product_cover' basename='" + p_album + "'>设为封面</a>").remove();*/
/*         $(this).after("<span class='product_cover' basename='" + album + "'>封面</span>").remove();*/
/*         return false;*/
/*     });*/
/* */
/*     $('#product-images').on('fileloaded', function (event, file, previewId, index, reader) {*/
/*         $('#' + previewId).find('.glyphicon-upload').click();*/
/*     });*/
/*     $('#product-images').on('fileuploaded', function (event, data, previewId, index) {*/
/*         var response = data.response;*/
/*         response = JSON.parse(response);*/
/*         if (index == 0) {*/
/*             $('#product-picture').val(response.basename);*/
/*             $('#' + previewId + ' img').after('<span class="product_cover" basename="' + response.basename + '">封面</span>');*/
/*         } else {*/
/*             $('#' + previewId + ' img').after('<a class="set_product_cover" basename="' + response.basename + '">设为封面</a>');*/
/*         }*/
/*         $('#product-form').append('<input type="hidden" id="' + previewId + '_album" name="album[]" value="' + response.basename + '">');*/
/*     });*/
/*     $('#product-images').on('filesuccessremove', function (event, id) {*/
/*         $.post("{{ url(['/product/delete-image']) }}",//未关联商品的图片删除*/
/*                 {key: 0, picture: $('#' + id + '_album').val()},*/
/*                 function (data) {*/
/*                     console.log(data);*/
/*                 }*/
/*         );*/
/*         $('#' + id + '_album').remove();*/
/*     });*/
/* */
/*     var editor;*/
/*     KindEditor.ready(function (K) {*/
/*         editor = K.create('#product-intro', {*/
/*             resizeType: 2,*/
/*             allowPreviewEmoticons: false,*/
/*             allowImageUpload: true,*/
/*             minHeight: 400,*/
/*             uploadJson: "{{ url(['/product/upload-info-image']) }}",*/
/*             items: [*/
/*                 'source', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',*/
/*                 'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',*/
/*                 'insertunorderedlist', '|', 'multiimage', 'link', 'fullscreen'*/
/*             ]*/
/*         });*/
/*         editor.clickToolbar('fullscreen', function () {*/
/*             $('body').css({*/
/*                 'height': '100%',*/
/*             });*/
/*         });*/
/*     });*/
/* */
/*     $('#product-limit_num').keyup(function () {*/
/*         var nums = $(this).val();*/
/*         if (nums != 0 && nums != 5) {*/
/*             $(this).val(5);*/
/*         }*/
/*     })*/
/* */
/*     function submitForm() {*/
/*         $('#product-form').form({*/
/*             url: "{{ url('product/edit', {'id': model.id}) }}",*/
/*             onSubmit: function () {*/
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
