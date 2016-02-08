<?php 
require("header.php");
 ?>
<div class="container marketing" style="padding-top: 70px;">
   
    
<h2 class="featurette-heading" style="padding-top: 60px; padding-bottom: 40px;" id="About">Grupo de Emails do Google </h2>

<p> Nossa principal ferramenta de conversa interna, para nos conhecermos melhor, alinharmos as ações, e </P>    
    
<iframe id="forum_embed"
  src="javascript:void(0)"
  scrolling="no"
  frameborder="0"
  width="900"
  height="700">
</iframe>
<script type="text/javascript">
  document.getElementById('forum_embed').src =
     'https://groups.google.com/forum/embed/?place=forum/aceleradoradepessoas'
     + '&showsearch=true&showpopout=true&showtabs=false'
     + '&parenturl=' + encodeURIComponent(window.location.href);
</script>

</div>

<?php 
require("footer.php");
 ?>
