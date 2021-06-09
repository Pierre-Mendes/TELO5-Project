<html lang="{{ app()->getLocale() }}">
@include('_layouts._includes._head')
@include('_layouts._includes._scripts')

<head>
    @yield('head')
</head>

<body>
    <div class="panel">


        <header class="teste navbar-fixed-top">
            <section>
                @include('_layouts._includes._header')
            </section>
        </header>

        <main>
            <section>
                <div>
                    @yield('topo_detalhe')
                </div>
                <div>
                    <div style="height: 50px">
                        @include('_layouts._includes._alert')
                    </div>
                </div>
                <div>
                    <div class="conteudo" id="conteudo">
                        @yield('conteudo')
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <section>
                @include('_layouts._includes._footer')
            </section>
        </footer>
    </div>
</body>



<script type="text/javascript">
    // FUNCAO PARA ABRIR A TELA DE USUARIOS NO MENU A DIREITA
    jQuery(document).ready(function($) {
        var uls = $('#menu ul');
        uls.hide();

        $('#menu > li').click(function(e) {
            e.stopPropagation();
            uls.hide();
            $(this).find('ul').show();
        });
        $('#menu ul').click(function(e) {
            e.stopPropagation();
        });
        $('body').click(function() {
            uls.hide();
        });
    });

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
    // Função para abrir dropdown de selecionar fazenda
    function myFunction() {
        $.post('/getFazendas/', function(fazendas) {

            var aux = "";

            $('#farm-active').html("");
            $.each(fazendas, function(key, value) {
                aux += '<a href="#">' + value.nome + ' </a>';
            })
            $('#farm-active').html(aux);
        })
        document.getElementById("myDropdown1").classList.toggle("show");
    }

    // Função para abrir dropdown do configuracao
    function myFunction2() {
        document.getElementById("myDropdown2").classList.toggle("show");
    }

    // Função para abrir dropdown de usuarios
    function myFunction3() {
        document.getElementById("myDropdown3").classList.toggle("show");
    }

    // Função para abrir dropdown do hamburguer
    function myFunction4() {
        document.getElementById("myDropdown4").classList.toggle("show");
    }

    // função para fechar os dropdowns ao clicar para abrir outros
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            if ((event.target.id != "myInput")) {
                var dropdowns = document.getElementsByClassName("dropdown-content1");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        if (!event.target.matches('.dropbtn2')) {
            var dropdowns = document.getElementsByClassName("dropdown-content2");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
        if (!event.target.matches('.dropbtn3')) {
            var dropdowns = document.getElementsByClassName("dropdown-content3");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

    // LISTAR FAZENDAS

    $('.dropbtn').on('click dblclick', function(e) {

        /*  Prevents default behaviour  */
        e.preventDefault();

        /*  Prevents event bubbling  */
        e.stopPropagation();

        return;

    });

    $(".dropbtn").on("click", function(e) {

        const horas = new Date();
        console.log(horas);
        $(".listafazendas").empty();
        $.ajax({
            type: "GET",
            url: "{{ route('farms_select') }}",
            dataType: "json",
            success: function(data) {
                const horas1 = new Date();
                console.log(horas1);
                $.each(data, function(key, value) {
                    $('.listafazendas').append('<a href="javascript:setFazenda(' +
                        value + ')">' + key + '</a>');
                });
            },
        });
    });

    // SETAR ROTAS PARA REDIRECIONAMENTO DAS FAZENDAS LISTADAS
    function setFazenda(IdFazenda) {
        $.ajax({
            type: "POST",
            url: "{{ route('farm_setFarm') }}",
            data: {
                id: IdFazenda,
                _token: '{{ csrf_token() }}'
            },
            dataType: "json",
            success: function(data) {
                // $('#btnSelecionFazenda').html(data['nome']);
                location.reload();
            },
            error: function(data, textStatus, errorThrown) {
                console.log(data);
                console.log(textStatus);
                console.log(errorThrown);
            },
        });
    }

    // FILTRO DE BUSCA DAS FAZENDAS LISTADAS

    function myFunction() {
        document.getElementById("myDropdown1").classList.toggle("show");
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown1");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }

</script>

</body>

@yield('scripts')

</html>
