<a id="link" href="{{$url}}" target="_blank">Для продолжения оплаты перейдите по этой ссылке</a>
<a id="redirect" href="{{$redirectUrl}}" style="display: none"></a>
<br><span> {{$sumDescription}}</span>

<script>
    window.onload = function(){
         var link = document.getElementById("link");
         link.onclick = redirectToPayment;

         function redirectToPayment() {
            var urlRedirect = document.getElementById("redirect").getAttribute("href");
            window.location.href = urlRedirect;
         }
    }
</script>