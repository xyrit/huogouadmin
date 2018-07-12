<?php

/* order.html */
class __TwigTemplate_e2c895b2efcccb17598fc1ff2a61ac0387f616bbd29d212d7ce32b873eb842eb extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <title></title>
    <link href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/css/jquery.jqplot.min.css\" rel=\"stylesheet\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/themes/gray/easyui.css\">
    <script src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/jquery.min.js\"></script>
    <script src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/jquery.jqplot.min.js\"></script>
    <script src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/plugins/jqplot.pointLabels.min.js\"></script>
    <script src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js\"></script>
    <script src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js\"></script>
    <script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/jquery.easyui.min.js\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js\" type=\"text/javascript\"></script>
    <script>
        \$(function(){
            var tick = '";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["date"]) ? $context["date"] : null), "html", null, true);
        echo "';
            var tick2 = tick.split(\",\");
            var b1 = '";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["order"]) ? $context["order"] : null), "html", null, true);
        echo "'.split(\",\");
            var b2 = '";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["deliver"]) ? $context["deliver"] : null), "html", null, true);
        echo "'.split(\",\");
            var b3 = '";
        // line 20
        echo twig_escape_filter($this->env, (isset($context["ten"]) ? $context["ten"] : null), "html", null, true);
        echo "'.split(\",\");
            var b4 = '";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["limit"]) ? $context["limit"] : null), "html", null, true);
        echo "'.split(\",\");
            \$.each(b1, function(i, v){
                b1[i] = parseInt(v);
            })
            \$.each(b2, function(i, v){
                b2[i] = parseInt(v);
            })
            \$.each(b3, function(i, v){
                b3[i] = parseInt(v);
            })
            \$.each(b4, function(i, v){
                b4[i] = parseInt(v);
            })

            //var b2 = [969,1087,1399,1399,1512,1449,2029];
            //var b1 = [955,1146,1414,1414,1668,1570,2027];
            var plot2 = \$.jqplot('chart2', [b1, b2, b3, b4], {
                title: tick2[0] + '到' + tick2[tick2.length-1] + '订单统计',
                legend: { show: true, location: 'ne' }, //提示工具栏--show：是否显示,location: 显示位置 (e:东,w:西,s:南,n:北,nw:西北,ne:东北,sw:西南,se:东南)
                series: [
                    {
                        label: '开奖数',
                        // lineWidth: 8, //线条粗细
                        markerOptions: { size: 6, style: \"circle\" }  // 节点配置
                    },
                    {
                        label: '发货数',
                        // lineWidth: 8, //线条粗细
                        markerOptions: { size: 6, style: \"circle\" }  // 节点配置
                    },
                    {
                        label: '十元专区',
                        // lineWidth: 8, //线条粗细
                        markerOptions: { size: 6, style: \"circle\" }  // 节点配置
                    },
                    {
                        label: '限购专区',
                        // lineWidth: 8, //线条粗细
                        markerOptions: { size: 6, style: \"circle\" }  // 节点配置
                    },
                ], //提示工具栏
                //captureRightClick: true,//禁用右键
                seriesDefaults: {
                    //pointLabels: { show: true, ypadding: -1 } //数据点标签
                    //renderer: \$.jqplot.BarRenderer, //使用柱状图表示
                    //柱状体组之间间隔
                    //rendererOptions: {barMargin: 25}
                },
                axes: {
                    xaxis: {
                        label: \"日期\",  //x轴显示标题
                        pad: 5,
                        renderer: \$.jqplot.CategoryAxisRenderer, //x轴绘制方式
                        tickInterval: '1day',
                        ticks: tick2,
                        tickOptions: {

                            fontSize: '10pt'
                        },
                        mark: 'cross'
                    },
                    yaxis: {
                        label: \"订单数\", // y轴显示标题
                        min: 0,
                        //tickInterval: 10,     //网格线间隔大小
                        tickOptions: { fontSize: '10pt' }
                    }
                }
            });
        })
    </script>
</head>
<body>
<div>
    <form action=\"\" method=\"get\">
        <select name=\"type\">
            <option value=\"0\" selected>默认</option>
            <option value=\"1\" ";
        // line 98
        if (($this->getAttribute((isset($context["get"]) ? $context["get"] : null), "type", array()) == 1)) {
            echo "selected";
        }
        echo ">按天查询</option>
            <option value=\"2\" ";
        // line 99
        if (($this->getAttribute((isset($context["get"]) ? $context["get"] : null), "type", array()) == 2)) {
            echo "selected";
        }
        echo ">按月查询</option>
            <option value=\"3\" ";
        // line 100
        if (($this->getAttribute((isset($context["get"]) ? $context["get"] : null), "type", array()) == 3)) {
            echo "selected";
        }
        echo ">按年查询</option>
        </select>
        <input type=\"text\" name=\"startTime\"  id=\"startTime\" class=\"easyui-datebox\" value=\"";
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["get"]) ? $context["get"] : null), "startTime", array()), "html", null, true);
        echo "\">
        <input type=\"text\" name=\"endTime\"  id=\"endTime\" class=\"easyui-datebox\" value=\"";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["get"]) ? $context["get"] : null), "endTime", array()), "html", null, true);
        echo "\">
        <input type=\"submit\" value=\"查询\">
    </form>
    <span></span>
</div>
<div id=\"chart2\" style=\"width: 1000px; height: 400px;\"></div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"订单列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 110
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("stats/list"), "html", null, true);
        echo "',nowrap:false,rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'date', width:150, align:'center'\">日期</th>
        <th data-options=\"field:'lottery_num', width:150, align:'center'\">中奖订单数</th>
        <th data-options=\"field:'deliver_num', width:150, align:'center'\">发货订单数</th>
        <th data-options=\"field:'ten_num', width:150, align:'center'\">十元专区</th>
        <th data-options=\"field:'limit_num', width:150, align:'center'\">限购专区</th>
    </tr>
    </thead>
</table>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "order.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 110,  183 => 103,  179 => 102,  172 => 100,  166 => 99,  160 => 98,  80 => 21,  76 => 20,  72 => 19,  68 => 18,  63 => 16,  57 => 13,  53 => 12,  49 => 11,  45 => 10,  41 => 9,  37 => 8,  33 => 7,  29 => 6,  25 => 5,  19 => 1,);
    }
}
/* <html xmlns="http://www.w3.org/1999/xhtml">*/
/* <head>*/
/*     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />*/
/*     <title></title>*/
/*     <link href="{{ app.params.skinUrl }}/css/jquery.jqplot.min.css" rel="stylesheet" />*/
/*     <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/gray/easyui.css">*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/jquery.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/jquery.jqplot.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.easyui.min.js" type="text/javascript"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js" type="text/javascript"></script>*/
/*     <script>*/
/*         $(function(){*/
/*             var tick = '{{ date }}';*/
/*             var tick2 = tick.split(",");*/
/*             var b1 = '{{ order }}'.split(",");*/
/*             var b2 = '{{ deliver }}'.split(",");*/
/*             var b3 = '{{ ten }}'.split(",");*/
/*             var b4 = '{{ limit }}'.split(",");*/
/*             $.each(b1, function(i, v){*/
/*                 b1[i] = parseInt(v);*/
/*             })*/
/*             $.each(b2, function(i, v){*/
/*                 b2[i] = parseInt(v);*/
/*             })*/
/*             $.each(b3, function(i, v){*/
/*                 b3[i] = parseInt(v);*/
/*             })*/
/*             $.each(b4, function(i, v){*/
/*                 b4[i] = parseInt(v);*/
/*             })*/
/* */
/*             //var b2 = [969,1087,1399,1399,1512,1449,2029];*/
/*             //var b1 = [955,1146,1414,1414,1668,1570,2027];*/
/*             var plot2 = $.jqplot('chart2', [b1, b2, b3, b4], {*/
/*                 title: tick2[0] + '到' + tick2[tick2.length-1] + '订单统计',*/
/*                 legend: { show: true, location: 'ne' }, //提示工具栏--show：是否显示,location: 显示位置 (e:东,w:西,s:南,n:北,nw:西北,ne:东北,sw:西南,se:东南)*/
/*                 series: [*/
/*                     {*/
/*                         label: '开奖数',*/
/*                         // lineWidth: 8, //线条粗细*/
/*                         markerOptions: { size: 6, style: "circle" }  // 节点配置*/
/*                     },*/
/*                     {*/
/*                         label: '发货数',*/
/*                         // lineWidth: 8, //线条粗细*/
/*                         markerOptions: { size: 6, style: "circle" }  // 节点配置*/
/*                     },*/
/*                     {*/
/*                         label: '十元专区',*/
/*                         // lineWidth: 8, //线条粗细*/
/*                         markerOptions: { size: 6, style: "circle" }  // 节点配置*/
/*                     },*/
/*                     {*/
/*                         label: '限购专区',*/
/*                         // lineWidth: 8, //线条粗细*/
/*                         markerOptions: { size: 6, style: "circle" }  // 节点配置*/
/*                     },*/
/*                 ], //提示工具栏*/
/*                 //captureRightClick: true,//禁用右键*/
/*                 seriesDefaults: {*/
/*                     //pointLabels: { show: true, ypadding: -1 } //数据点标签*/
/*                     //renderer: $.jqplot.BarRenderer, //使用柱状图表示*/
/*                     //柱状体组之间间隔*/
/*                     //rendererOptions: {barMargin: 25}*/
/*                 },*/
/*                 axes: {*/
/*                     xaxis: {*/
/*                         label: "日期",  //x轴显示标题*/
/*                         pad: 5,*/
/*                         renderer: $.jqplot.CategoryAxisRenderer, //x轴绘制方式*/
/*                         tickInterval: '1day',*/
/*                         ticks: tick2,*/
/*                         tickOptions: {*/
/* */
/*                             fontSize: '10pt'*/
/*                         },*/
/*                         mark: 'cross'*/
/*                     },*/
/*                     yaxis: {*/
/*                         label: "订单数", // y轴显示标题*/
/*                         min: 0,*/
/*                         //tickInterval: 10,     //网格线间隔大小*/
/*                         tickOptions: { fontSize: '10pt' }*/
/*                     }*/
/*                 }*/
/*             });*/
/*         })*/
/*     </script>*/
/* </head>*/
/* <body>*/
/* <div>*/
/*     <form action="" method="get">*/
/*         <select name="type">*/
/*             <option value="0" selected>默认</option>*/
/*             <option value="1" {% if(get.type == 1) %}selected{% endif %}>按天查询</option>*/
/*             <option value="2" {% if(get.type == 2) %}selected{% endif %}>按月查询</option>*/
/*             <option value="3" {% if(get.type == 3) %}selected{% endif %}>按年查询</option>*/
/*         </select>*/
/*         <input type="text" name="startTime"  id="startTime" class="easyui-datebox" value="{{ get.startTime }}">*/
/*         <input type="text" name="endTime"  id="endTime" class="easyui-datebox" value="{{ get.endTime }}">*/
/*         <input type="submit" value="查询">*/
/*     </form>*/
/*     <span></span>*/
/* </div>*/
/* <div id="chart2" style="width: 1000px; height: 400px;"></div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="订单列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{ url('stats/list')}}',nowrap:false,rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'date', width:150, align:'center'">日期</th>*/
/*         <th data-options="field:'lottery_num', width:150, align:'center'">中奖订单数</th>*/
/*         <th data-options="field:'deliver_num', width:150, align:'center'">发货订单数</th>*/
/*         <th data-options="field:'ten_num', width:150, align:'center'">十元专区</th>*/
/*         <th data-options="field:'limit_num', width:150, align:'center'">限购专区</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* </body>*/
/* </html>*/