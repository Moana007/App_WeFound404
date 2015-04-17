<!-- FACEBOOK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&appId=371666859671907&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&appId=371666859671907&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->

<!-- Commentaires FB -->
<!-- <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->


<script>
  function ShareVote(nom_redacteur) {
    FB.ui({
      method: 'feed',
      name: 'Je viens de voter pour ' + nom_redacteur + ' !',
      link: 'http://appwefound404.herokuapp.com/',
      picture: 'http://appwefound404.herokuapp.com/img/logo_wefound404.png',
      caption: 'Vous aussi, venez voter pour le meilleur redacteur du mois!',
      description: 'Inscrivez vous à l\'application FB de WeFound404 pour voter pour le meilleur redacteur du mois ! Et gagner peut etre une interview avec le redacteur de votre choix !',
    }, function(response){});
  }
</script>