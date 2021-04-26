<html lang="{{ app()->getLocale() }}">
@include('_layouts._includes._head')
@include('_layouts._includes._scripts')

<head>@yield('head')</head>

<body>
    <div class="panel">
        <header class="teste navbar-fixed-top">
            <section>
                <div class="dropdown4">
                    <button onclick="myFunction4()" class="dropbtn4">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div id="myDropdown4" class="dropdown-content4 content">
                        <nav class="nav11" role="navigation">
                            <ul class="nav11__list">
                                <li class="navbar11">
                                    <input id="group-1" type="checkbox" hidden />
                                    <label for="group-1"><span class="fa fa-caret-right"></span>Aferições</label>
                                    <ul class="group-list">
                                        <li class="subnavbar">
                                            <input id="sub-group-1" type="checkbox" hidden />
                                            <label for="sub-group-1">
                                                <a href="{{ route('afericoes.pivo.central') }}" class='nav-link'>
                                                    <i class='fa fa-fw fa-money'></i>
                                                    @lang('afericao.pivoCentral')
                                                </a>
                                            </label>
                                            {{-- <input id="sub-group-1" type="checkbox" hidden />
                                        <label for="sub-group-1"></span><a href="#"> Second level</a></label>
                                        <input id="sub-group-1" type="checkbox" hidden />
                                        <label for="sub-group-1"></span><a href="#"> Second level</a></label>
                                        <input id="sub-group-1" type="checkbox" hidden />
                                        <label for="sub-group-1"></span><a href="#"> Second level</a></label> --}}
                                        </li>
                                    </ul>

                                    <input id="group-2" type="checkbox" hidden />
                                    <label for="group-2"><span
                                            class="fa fa-caret-right"></span>Redimensionamento</label>
                                    <ul class="group-list">
                                        <li class="subnavbar">
                                            <input id="sub-group-2" type="checkbox" hidden />
                                            <label for="sub-group-2"> Second level</label>
                                            <ul class="sub-group-list-2">
                                                <li><a href="#"><span>2nd level nav item</span> </a></li>
                                                <li><a href="#"><span>2nd level nav item</span></a></li>
                                                <li><a href="#"><span>2nd level nav item</span></a></li>
                                                <!-- <li class="subnavbar2">
                                                <input id="sub-sub-group-2" type="checkbox" hidden />
                                                <label for="sub-sub-group-2"><span class="fa fa-caret-right"></span>
                                                    Third level</label>
                                                <ul class="sub-sub-group-list-2">
                                                    <li><a href="#">3rd level nav item</a></li>
                                                    <li><a href="#">3rd level nav item</a></li>
                                                    <li><a href="#">3rd level nav item</a></li>
                                                </ul>
                                            </li> -->
                                            </ul>
                                        </li>
                                    </ul>
                                    {{-- <input id="group-3" type="checkbox" hidden />
                                <label for="group-3"><span class="fa fa-caret-right"></span>Lançamentos
                                    Diários</label>
                                <ul class="group-list">
                                    <li class="subnavbar">
                                        <input id="sub-group-3" type="checkbox" hidden />
                                        <label for="sub-group-3"><span class="fa fa-caret-right"></span> Second
                                            level</label>
                                        <ul class="sub-group-list-3">
                                            <li><a href="#">2nd level nav item</a></li>
                                            <li><a href="#">2nd level nav item</a></li>
                                            <li><a href="#">2nd level nav item</a></li>
                                            <li class="subnavbar2">
                                                <input id="sub-sub-group-3" type="checkbox" hidden />
                                                <label for="sub-sub-group-3"><span class="fa fa-caret-right"></span>
                                                    Third level</label>
                                                <ul class="sub-sub-group-list-3">
                                                    <li><a href="#">3rd level nav item</a></li>
                                                    <li><a href="#">3rd level nav item</a></li>
                                                    <li><a href="#">3rd level nav item</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <input id="group-4" type="checkbox" hidden />
                                <label for="group-4"><span class="fa fa-caret-right"></span>Gestão de
                                    Irrigação</label>
                                <ul class="group-list">
                                    <li class="subnavbar">
                                        <input id="sub-group-4" type="checkbox" hidden />
                                        <label for="sub-group-4"><span class="fa fa-caret-right"></span> Second
                                            level</label>
                                        <ul class="sub-group-list">
                                            <li><a href="#">2nd level nav item</a></li>
                                            <li><a href="#">2nd level nav item</a></li>
                                            <li><a href="#">2nd level nav item</a></li>
                                            <li class="subnavbar2">
                                                <input id="sub-sub-group-4" type="checkbox" hidden />
                                                <label for="sub-sub-group-4"><span class="fa fa-caret-right"></span>
                                                    Third level</label>
                                                <ul class="sub-sub-group-list-4">
                                                    <li><a href="#">3rd level nav item</a></li>
                                                    <li><a href="#">3rd level nav item</a></li>
                                                    <li><a href="#">3rd level nav item</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <input id="group-5" type="checkbox" hidden />
                                <label for="group-5"><span class="fa fa-caret-right"></span>Relatórios</label>
                                <ul class="group-list">
                                    <li class="subnavbar">
                                        <input id="sub-group-5" type="checkbox" hidden />
                                        <label for="sub-group-5"><span class="fa fa-caret-right"></span> Second
                                            level</label>
                                        <ul class="sub-group-list-5">
                                            <li><a href="#">2nd level nav item</a></li>
                                            <li><a href="#">2nd level nav item</a></li>
                                            <li><a href="#">2nd level nav item</a></li>
                                            <li class="subnavbar2">
                                                <input id="sub-sub-group-5" type="checkbox" hidden />
                                                <label for="sub-sub-group-5"><span class="fa fa-caret-right"></span>
                                                    Third level</label>
                                                <ul class="sub-sub-group-list-5">
                                                    <li><a href="#">3rd level nav item</a></li>
                                                    <li><a href="#">3rd level nav item</a></li>
                                                    <li><a href="#">3rd level nav item</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> --}}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>


                <div class="dropdown">
                    <button id="btnSelecionFazenda" onclick="myFunction()" class="dropbtn"
                        style="background: url({{ asset('img/ico_fazenda.png') }});background-repeat: no-repeat; background-color: #26546F; background-size: 30px; background-position: 5%;">
                        Selecionar fazenda<i class="fas fa-caret-down"></i>
                    </button>

                    <div id="myDropdown1" class="dropdown-content1">
                        <div class="inputicon">
                            <input type="text" placeholder="Pesquise uma fazenda" id="myInput" class="myInput"
                                onkeyup="filterFunction()"><i class="fas fa-search"></i>
                        </div>
                        <div class="headersearch">FAZENDAS DISPONÍVEIS</div>
                        <div class="listafazendas">

                        </div>
                    </div>
                </div>

                <div class="imagens ">
                    <a href="{{ route('dashboard') }}"> <img src="{{ asset('img/ico_dashboard.png') }}"
                            alt="dashboard" class="icodash"> </a>
                    <a href=""><img src="{{ asset('img/ico_afericao.png') }}" alt="afericao " class="icoafer "></a>
                </div>

                <div id="main">
                    <ul id="menu" class="nav navbar-right header-usuario">
                        <li class="header-logo"></li>
                        <label for="user"></label>
                        <li id="user"><img src="{{ asset('img/ico_user.png') }}" alt="" class="icones"><span>Pierre</span><i class="fas fa-caret-down "></i>
                            <ul>
                                <li><a href="{{ route('usuarios.listar') }}">@lang('sidenav.usuarios')</a></li>
                                <li><a href="{{ route('centrocusto.gerenciar') }}"></i> @lang('sidenav.cdc')</a></li>
                                <li><a href="{{ route('fazendas.gerenciar') }}">@lang('sidenav.fazendas')</a></li>
                                <li><a href="{{ route('proprietarios.gerenciar') }}">@lang('sidenav.proprietarios')</a></li>
                                <li><a href="{{ route('fabricantes.gerenciar') }}">@lang('sidenav.bocais')</a></li>
                                <li><a href="{{ route('producer.list') }}">Fabricantes</a></li>
                                <li><a href="{{ route('pivos.gerenciar') }}">@lang('sidenav.pivos')</a></li>
                            </ul>
                        </li>

                        <li><img src="{{ asset('img/ico_config.png') }}" class="icones"><i
                                class="fas fa-caret-down "></i>
                            <ul>
                                <li>Item 1</li>
                                <li>Item 2</li>
                                <li>Item 3</li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('sair') }}" data-toggle="tooltip" data-placement="bottom">
                                <img src="{{ asset('img/ico_sair.png') }}" class="icones sair2">
                            </a>
                        </li>
                    </ul>
                </div>
            </section>
        </header>



        <main>
            <section>
                <div>
                    @yield('topo_detalhe')
                </div>

                <div class="content-alert">
                    @include('_layouts._includes._alert')
                </div>

                <div>
                    @yield('conteudo')
                </div>
            </section>
        </main>
{{--
        <footer>
            <section>
                <div>teste</div>
            </section>
        </footer> --}}

    </div>








    <script>
        // PRIMEIRO GRAFICO
        var ctx = document.getElementById('myChart').getContext('2d');

        var chart = new Chart(ctx, {

            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'My first dataset',
                    backgroundColor: ['#89A92A', '#F1B300', 'red'],
                    data: [10, 15, 12],
                    borderWidth: 0,
                }]
            },
            options: {
                cutoutPercentage: 82,
                rotation: 4 * Math.PI,
                circumference: 1 * Math.PI
            }
        });

        // SEGUNDO GRAFICO
        var ctx = document.getElementById('myChart2').getContext('2d');

        var chart = new Chart(ctx, {


            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'My first dataset',
                    backgroundColor: ['#89A92A', '#F1B300', 'red'],
                    data: [10, 15, 12],
                    borderWidth: 0,
                }]
            },
            options: {
                cutoutPercentage: 82,
                rotation: 4 * Math.PI,
                circumference: 1 * Math.PI
            }
        });


        // TERCEIRO GRAFICO
        var ctx = document.getElementById('myChart3').getContext('2d');

        var chart = new Chart(ctx, {


            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'My first dataset',
                    backgroundColor: ['#89A92A', '#F1B300', 'red'],
                    data: [10, 15, 12],
                    borderWidth: 0,
                }]
            },
            options: {
                cutoutPercentage: 82,
                rotation: 4 * Math.PI,
                circumference: 1 * Math.PI
            }
        });

    </script>

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
        $(".dropbtn").click(function(e) {
            $(".listafazendas").empty();
            $.ajax({
                type: "GET",
                url: "{{ route('fazendas.listfazendas') }}",
                dataType: "json",
                success: function(data) {
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
                url: "{{ route('fazendas.setfazenda') }}",
                data: {
                    id: IdFazenda,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(data) {
                    $('#btnSelecionFazenda').html(data['nome'])
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

    <script>
        /////////////////////////////////////////////////////////////////

    </script>

</body>

@yield('scripts')

</html>
