<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>


    <meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Basic Example</title>

<style type="text/css">
/*margin and padding on body element
  can introduce errors in determining
  element position and are not recommended;
  we turn them off as a foundation for YUI
  CSS treatments. */
body {
	margin:0;
	padding:0;
}
</style>

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/datatable/assets/skins/sam/datatable.css" />
<script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/element/element-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/event-delegate/event-delegate-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/datatable/datatable-min.js"></script>


<!--begin custom header content for this example-->
<style type="text/css">
/* custom styles for this example */
.yui-skin-sam .yui-dt-liner { white-space:nowrap; } 
</style>

<!--end custom header content for this example-->

</head>

<body class="yui-skin-sam">


<h1>Basic Example</h1>

<div class="exampleIntro">
	<p>A demonstration of the DataTable's basic feature set.</p>
			
</div>

<!--BEGIN SOURCE CODE FOR EXAMPLE =============================== -->

<div id="basic"></div>

<script type="text/javascript" src="assets/js/data.js"></script>
<script type="text/javascript">
YAHOO.util.Event.addListener(window, "load", function() {
    YAHOO.example.Basic = function() {
        var myColumnDefs = [
            {key:"id", sortable:true, resizeable:true},
            {key:"date", formatter:YAHOO.widget.DataTable.formatDate, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC},resizeable:true},
            {key:"quantity", formatter:YAHOO.widget.DataTable.formatNumber, sortable:true, resizeable:true},
            {key:"amount", formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true, resizeable:true},
            {key:"title", sortable:true, resizeable:true}
        ];

        var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.bookorders);
        myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
        myDataSource.responseSchema = {
            fields: ["id","date","quantity","amount","title"]
        };

        var myDataTable = new YAHOO.widget.DataTable("basic",
                myColumnDefs, myDataSource, {caption:"DataTable Caption"});
                
        return {
            oDS: myDataSource,
            oDT: myDataTable
        };
    }();
});
</script>

<!--END SOURCE CODE FOR EXAMPLE =============================== -->


<!--MyBlogLog instrumentation-->
<script type="text/javascript" src="http://track2.mybloglog.com/js/jsserv.php?mblID=2007020704011645"></script>

</body>
</html>

<script type="text/javascript"
src="http://l.yimg.com/d/lib/rt/rto1_78.js"></script><script>var rt_page="792403987:FRTMA"; var
rt_ip="129.118.122.72";
if ("function" == typeof(rt_AddVar) ){ rt_AddVar("ys", escape("18198B62")); rt_AddVar("cr", escape("wAZPKQOKYDk"));
rt_AddVar("sg", escape("/SIG=13r2r0ahv6e83v1976kmvt&b=4&d=U9NQMtVpYEKr79LrxcXT2_W5WwnPVR63BS53mQ--&s=o9&i=f0K1CrOjBNNXb.G8ckmY/1339010054/129.118.122.72/18198B62")); rt_AddVar("yd", escape("1354311323"));
}</script><noscript><img src="http://rtb.pclick.yahoo.com/images/nojs.gif?p=792403987:FRTMA"></noscript>
<!-- SpaceID=792403987 loc=FSRVY noad -->
<script language=javascript>
if(window.yzq_d==null)window.yzq_d=new Object();
window.yzq_d['ciChE2KL5Mg-']='&U=12dflfbqs%2fN%3dciChE2KL5Mg-%2fC%3d-1%2fD%3dFSRVY%2fB%3d-1%2fV%3d0';
</script><noscript><img width=1 height=1 alt="" src="http://us.bc.yahoo.com/b?P=gNEpDGKLGUlnIH8KTmpb_RCAgXZ6SE_PrAYACBZw&T=181jb5bss%2fX%3d1339010054%2fE%3d792403987%2fR%3ddev_net%2fK%3d5%2fV%3d2.1%2fW%3dH%2fY%3dYAHOO%2fF%3d3897113102%2fH%3dc2VydmVJZD0iZ05FcERHS0xHVWxuSUg4S1RtcGJfUkNBZ1haNlNFX1ByQVlBQ0JadyIgc2l0ZUlkPSI0NDY1NTUxIiB0U3RtcD0iMTMzOTAxMDA1NDUzMjQ4MyIg%2fQ%3d-1%2fS%3d1%2fJ%3d18198B62&U=12dflfbqs%2fN%3dciChE2KL5Mg-%2fC%3d-1%2fD%3dFSRVY%2fB%3d-1%2fV%3d0"></noscript><script language=javascript>
if(window.yzq_d==null)window.yzq_d=new Object();
window.yzq_d['cCChE2KL5Mg-']='&U=13ee31sqk%2fN%3dcCChE2KL5Mg-%2fC%3d289534.9603437.10326224.9298098%2fD%3dFOOT%2fB%3d4123617%2fV%3d1';
</script><noscript><img width=1 height=1 alt="" src="http://us.bc.yahoo.com/b?P=gNEpDGKLGUlnIH8KTmpb_RCAgXZ6SE_PrAYACBZw&T=181n7u8qi%2fX%3d1339010054%2fE%3d792403987%2fR%3ddev_net%2fK%3d5%2fV%3d2.1%2fW%3dH%2fY%3dYAHOO%2fF%3d1249431047%2fH%3dc2VydmVJZD0iZ05FcERHS0xHVWxuSUg4S1RtcGJfUkNBZ1haNlNFX1ByQVlBQ0JadyIgc2l0ZUlkPSI0NDY1NTUxIiB0U3RtcD0iMTMzOTAxMDA1NDUzMjQ4MyIg%2fQ%3d-1%2fS%3d1%2fJ%3d18198B62&U=13ee31sqk%2fN%3dcCChE2KL5Mg-%2fC%3d289534.9603437.10326224.9298098%2fD%3dFOOT%2fB%3d4123617%2fV%3d1"></noscript><!--QYZ ,;;;792403987;;-->
<!-- VER-3.0.218032 -->
<script language=javascript>
if(window.yzq_p==null)document.write("<scr"+"ipt language=javascript src=http://l.yimg.com/d/lib/bc/bc_2.0.5.js></scr"+"ipt>");
</script><script language=javascript>
if(window.yzq_p)yzq_p('P=gNEpDGKLGUlnIH8KTmpb_RCAgXZ6SE_PrAYACBZw&T=17rg62vh1%2fX%3d1339010054%2fE%3d792403987%2fR%3ddev_net%2fK%3d5%2fV%3d1.1%2fW%3dJ%2fY%3dYAHOO%2fF%3d806359609%2fH%3dc2VydmVJZD0iZ05FcERHS0xHVWxuSUg4S1RtcGJfUkNBZ1haNlNFX1ByQVlBQ0JadyIgc2l0ZUlkPSI0NDY1NTUxIiB0U3RtcD0iMTMzOTAxMDA1NDUzMjQ4MyIg%2fS%3d1%2fJ%3d18198B62');
if(window.yzq_s)yzq_s();
</script><noscript><img width=1 height=1 alt="" src="http://us.bc.yahoo.com/b?P=gNEpDGKLGUlnIH8KTmpb_RCAgXZ6SE_PrAYACBZw&T=181r9ks2e%2fX%3d1339010054%2fE%3d792403987%2fR%3ddev_net%2fK%3d5%2fV%3d3.1%2fW%3dJ%2fY%3dYAHOO%2fF%3d1568900494%2fH%3dc2VydmVJZD0iZ05FcERHS0xHVWxuSUg4S1RtcGJfUkNBZ1haNlNFX1ByQVlBQ0JadyIgc2l0ZUlkPSI0NDY1NTUxIiB0U3RtcD0iMTMzOTAxMDA1NDUzMjQ4MyIg%2fQ%3d-1%2fS%3d1%2fJ%3d18198B62"></noscript><script language=javascript>
(function(){window.xzq_p=function(R){M=R};window.xzq_svr=function(R){J=R};function F(S){var T=document;if(T.xzq_i==null){T.xzq_i=new Array();T.xzq_i.c=0}var R=T.xzq_i;R[++R.c]=new Image();R[R.c].src=S}window.xzq_sr=function(){var S=window;var Y=S.xzq_d;if(Y==null){return }if(J==null){return }var T=J+M;if(T.length>P){C();return }var X="";var U=0;var W=Math.random();var V=(Y.hasOwnProperty!=null);var R;for(R in Y){if(typeof Y[R]=="string"){if(V&&!Y.hasOwnProperty(R)){continue}if(T.length+X.length+Y[R].length<=P){X+=Y[R]}else{if(T.length+Y[R].length>P){}else{U++;N(T,X,U,W);X=Y[R]}}}}if(U){U++}N(T,X,U,W);C()};function N(R,U,S,T){if(U.length>0){R+="&al="}F(R+U+"&s="+S+"&r="+T)}function C(){window.xzq_d=null;M=null;J=null}function K(R){xzq_sr()}function B(R){xzq_sr()}function L(U,V,W){if(W){var R=W.toString();var T=U;var Y=R.match(new RegExp("\\\\(([^\\\\)]*)\\\\)"));Y=(Y[1].length>0?Y[1]:"e");T=T.replace(new RegExp("\\\\([^\\\\)]*\\\\)","g"),"("+Y+")");if(R.indexOf(T)<0){var X=R.indexOf("{");if(X>0){R=R.substring(X,R.length)}else{return W}R=R.replace(new RegExp("([^a-zA-Z0-9$_])this([^a-zA-Z0-9$_])","g"),"$1xzq_this$2");var Z=T+";var rv = f( "+Y+",this);";var S="{var a0 = '"+Y+"';var ofb = '"+escape(R)+"' ;var f = new Function( a0, 'xzq_this', unescape(ofb));"+Z+"return rv;}";return new Function(Y,S)}else{return W}}return V}window.xzq_eh=function(){if(E||I){this.onload=L("xzq_onload(e)",K,this.onload,0);if(E&&typeof (this.onbeforeunload)!=O){this.onbeforeunload=L("xzq_dobeforeunload(e)",B,this.onbeforeunload,0)}}};window.xzq_s=function(){setTimeout("xzq_sr()",1)};var J=null;var M=null;var Q=navigator.appName;var H=navigator.appVersion;var G=navigator.userAgent;var A=parseInt(H);var D=Q.indexOf("Microsoft");var E=D!=-1&&A>=4;var I=(Q.indexOf("Netscape")!=-1||Q.indexOf("Opera")!=-1)&&A>=4;var O="undefined";var P=2000})();
</script><script language=javascript>
if(window.xzq_svr)xzq_svr('http://csc.beap.bc.yahoo.com/');
if(window.xzq_p)xzq_p('yi?bv=1.0.0&bs=(128l302s8(gid$gNEpDGKLGUlnIH8KTmpb_RCAgXZ6SE_PrAYACBZw,st$1339010054532483,v$1.0))&t=J_3-D_3');
if(window.xzq_s)xzq_s();
</script><noscript><img width=1 height=1 alt="" src="http://csc.beap.bc.yahoo.com/yi?bv=1.0.0&bs=(128l302s8(gid$gNEpDGKLGUlnIH8KTmpb_RCAgXZ6SE_PrAYACBZw,st$1339010054532483,v$1.0))&t=J_3-D_3"></noscript>
<!-- p1.ydn.bf1.yahoo.com compressed/chunked Wed Jun  6 12:14:14 PDT 2012 -->
