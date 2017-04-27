<!-- Bootstrap core JavaScript 
    ================================================== -->    
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
    <script src="<?php echo e(asset('public/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/jquery.easing.1.3.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/jquery-ui-1.10.3.custom.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/jquery.ui.touch-punch.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/jquery.autosize.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/jqueryTimeago.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/count.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/functions.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/jquery.form.js')); ?>"></script>
    <script src="<?php echo e(asset('public/plugins/sweetalert/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/holder.min.js')); ?>"></script>
    
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-97048697-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- start Mixpanel -->
<script type="text/javascript">(function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+"=([^&]*)")))?l[1]:null};g&&c(g,"state")&&(i=JSON.parse(decodeURIComponent(c(g,"state"))),"mpeditor"===i.action&&(b.sessionStorage.setItem("_mpcehash",g),history.replaceState(i.desiredHash||"",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(".");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,
0)))}}var d=a;"undefined"!==typeof f?d=a[f]=[]:f="mixpanel";d.people=d.people||[];d.toString=function(b){var a="mixpanel";"mixpanel"!==f&&(a+="."+f);b||(a+=" (stub)");return a};d.people.toString=function(){return d.toString(1)+".people (stub)"};k="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";c=e.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
mixpanel.init("d0ff146f449ac88f87fc58c5d555a564");</script><!-- end Mixpanel -->