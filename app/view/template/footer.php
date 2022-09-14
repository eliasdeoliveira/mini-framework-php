</div>
</section>
</div>
<script>
    var barraLateralEsquerda = true;
    var mobile = true;

    function manipularBarraLateralEsquerda() {
        if (!barraLateralEsquerda === true) {
            barraLateralEsquerda = !barraLateralEsquerda;
            document.getElementById('barraLateralEsqueda').classList.remove('none')
            document.getElementById('main').classList.add('col-lg-8')
            document.getElementById('main').classList.add('col-xl-9')
            document.getElementById('exibirBotaoAtivarLateralEsquerda').classList.add('none')
        } else {
            barraLateralEsquerda = !barraLateralEsquerda;
            document.getElementById('barraLateralEsqueda').classList.add('none')
            document.getElementById('exibirBotaoAtivarLateralEsquerda').classList.remove('none')
            document.getElementById('main').classList.remove('col-lg-8')
            document.getElementById('main').classList.remove('col-xl-9')
        }
    }

    function startApp() {
        let isMobile = navigator.userAgentData.mobile; //resolves true/false
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            console.log('mobile')
            barraLateralEsquerda = false
            manipularBarraLateralEsquerda()
            document.getElementById('barraLateralEsqueda').classList.add('none')
            document.getElementById('exibirBotaoAtivarLateralEsquerda').classList.remove('none')

        } else {
            // false for not mobile device
            console.log("not mobile device");
        }
        if (isMobile === true) {
            
        } else {
            barraLateralEsquerda = !document.querySelector('body').clientWidth > 991;
            manipularBarraLateralEsquerda()
            document.getElementById('app').classList.remove('none')
        }
    }

    startApp();
</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>