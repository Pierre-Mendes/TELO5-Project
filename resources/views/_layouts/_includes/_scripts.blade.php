
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script> -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/inputMaterial.js') }}"></script>
<script src="{{ asset('js/diversos.js') }}"></script>

<script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>

<script type="text/javascript">
    // Define a altura mínima da interface
    $(window).bind("load resize", function() {
        // Identifica a altura da tela
        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight :
            this.screen.height) - 1;
        if (height < 1) height = 1;

        // Identifica a altura do cabeçalho do conteúdo
        var content_header_height = parseInt($('.content-header').height());

        // Define o tamanho da área de conteúdo
        $("#page-wrapper").css("min-height", (height) + "px");

        // Define o tamanho da área branca de conteúdo
        $(".content-box.white").css("min-height", (height -
            content_header_height - 53) + "px");

        // Define o tamanho da área branca das tabs
        $(".tab-content.tab-full").css("min-height", (height -
            content_header_height - 100) + "px");
    });

</script>

<script>
    function IO_Edit_Check() {
        var Ordem = $('#IO_Edit_Ordem').val();
        var Min = parseInt($('#IO_Edit_Ordem').data('min'));
        var Max = parseInt($('#IO_Edit_Ordem').data('max'));

        // Verifica os limites da ordem
        if (Ordem < Min) Ordem = Min;
        else if (Ordem > Max) Ordem = Max;

        // Atualiza a ordem
        $('#IO_Edit_Ordem').val(Ordem);
    }

</script>

<script type="text/javascript">
    $(document).ready(function() {
        // Troca de idioma do conteúdo
        $('.IDIOMAS_SELECTION').click(function() {
            var Idioma_Atual = $('#IDIOMA_SELECTION').val();
            var Idioma = $(this).data('id');

            if (Idioma != Idioma_Atual) {
                $('#IDIOMA_SELECTION').val(Idioma);
                $('#FORM_IDIOMA_SELECTION').submit();
            }
        });

        // Barra de scroll do menu de fazendas
        $('#fazendas-scroll-WEB').slimScroll({
            height: "300px",
            railVisible: true,
            alwaysVisible: true,
            size: '6px',
            railColor: '#FFF',
            color: '#FFF',
            railOpacity: 0.2,
            opacity: 0.45,
            railBorderRadius: '0px',
            borderRadius: '0px'
        });

        // Barra de scroll do menu de fazendas
        $('#fazendas-scroll-MOBILE').slimScroll({
            height: "300px",
            railVisible: true,
            alwaysVisible: true,
            size: '6px',
            railColor: '#FFF',
            color: '#FFF',
            railOpacity: 0.2,
            opacity: 0.45,
            railBorderRadius: '0px',
            borderRadius: '0px'
        });


        // Barra de scroll do menu da sementeira
        $('#sementeira-scroll-WEB').slimScroll({
            height: "300px",
            railVisible: true,
            alwaysVisible: true,
            size: '6px',
            railColor: '#FFF',
            color: '#FFF',
            railOpacity: 0.2,
            opacity: 0.45,
            railBorderRadius: '0px',
            borderRadius: '0px'
        });

        // Barra de scroll do menu da sementeira
        $('#sementeira-scroll-MOBILE').slimScroll({
            height: "300px",
            railVisible: true,
            alwaysVisible: true,
            size: '6px',
            railColor: '#FFF',
            color: '#FFF',
            railOpacity: 0.2,
            opacity: 0.45,
            railBorderRadius: '0px',
            borderRadius: '0px'
        });


        // Prepara a lista de fazendas para o a pesquisa
        $('.fazendas-live-search a').each(function() {
            $(this).attr('data-search-term', $(this).html().toLowerCase());
        });

        // Realiza a pesquisa nas fazendas
        $('.lista-fazendas input.search-fazendas').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();

            $('.fazendas-live-search a').each(function() {
                if ($(this).filter('[data-search-term *= ' +
                        searchTerm + ']').length > 0 || searchTerm
                    .length < 1) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        });


        // Prepara a lista de regiões e técnicos para o a pesquisa
        $('.sementeira-live-search a').each(function() {
            $(this).attr('data-search-term', $(this).html().toLowerCase());
        });

        // Realiza a pesquisa nas fazendas
        $('.lista-fazendas input.search-sementeira').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();

            $('.sementeira-live-search a').each(function() {
                if ($(this).filter('[data-search-term *= ' +
                        searchTerm + ']').length > 0 || searchTerm
                    .length < 1) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        });


        // Abertura e fechamento das opções de configuração
        $('.usuario-preferencias .configuracao label').click(function() {
            // Troca o ícone
            $(this).find('i').toggleClass('fa-caret-right').toggleClass(
                'fa-caret-down');

            // Abre ou fecha a div
            $(this).parent().find('div').toggle(300);
        });

        //Ajusta o AutoFocus para o campo de pesquisa de fazendas (Henrique)
        $('.dropdown').on('shown.bs.dropdown', function() {
            var x = setTimeout('$("#search-fazendas-WEB").focus()', 0);

            document.querySelector('nav').addEventListener('keydown', function(
                event) {
                var tecla = event.keyCode;

                var altura_fazendas_scroll_WEB = $(
                    "#fazendas-scroll-WEB").height();
                var scrollbar_fazendas = $('.slimScrollBar');
                var posicao_scrollbar_fazendas = 0;

                //Se foi clicado a seta para CIMA
                if (tecla == 38) {
                    document.getElementById('fazendas-scroll-WEB')
                        .scrollTop -= 50;
                    posicao_scrollbar_fazendas = scrollbar_fazendas
                        .position();
                    //scrollbar_fazendas.css('top', posicao_scrollbar_fazendas.top-10);

                    //Se foi clicado a seta para BAIXO
                } else if (tecla == 40) {
                    document.getElementById('fazendas-scroll-WEB')
                        .scrollTop += 50;
                    posicao_scrollbar_fazendas = scrollbar_fazendas
                        .position();
                    //scrollbar_fazendas.css('top', posicao_scrollbar_fazendas.top+20);

                }

            });


        });



        // Abertura e fechamento dos itens do menu completo
        $('.header-menu-completo .menu > ul > li > a').click(function() {
            // Verifica se o item clicado já está aberto
            if ($(this).parent().hasClass('open')) {
                // Apenas fecha o item clicado
                $(this).parent().removeClass('open');
                $(this).parent().find('> ul').hide(300);
                $(this).find('i').addClass('fa-caret-right').removeClass(
                    'fa-caret-down');
            } else {
                // Fecha todos os itens
                $('.header-menu-completo .menu > ul > li').removeClass('open');
                $('.header-menu-completo .menu > ul > li > ul').hide(300);
                $('.header-menu-completo .menu > ul > li > a').find('i')
                    .addClass('fa-caret-right').removeClass('fa-caret-down');

                // Abre o item clicado
                $(this).parent().addClass('open');
                $(this).parent().find('> ul').show(300);
                $(this).find('i').removeClass('fa-caret-right').addClass(
                    'fa-caret-down');
            }
        });

        // Abertura e fechamento dos subitens do menu completo
        $('.header-menu-completo .menu > ul > li > ul .submenu a').click(function() {
            $(this).parent().find('ul').toggle(300);
            $(this).parent().find('i').toggleClass('fa-caret-right')
                .toggleClass('fa-caret-down');
        });
    });

</script>

<!-- Plugins -->
<script src={{ asset('Plugins/ScrollBar/SlimScroll.js') }} type="text/javascript"></script>
<script src={{ asset('Plugins/ColorBox/ColorBox.js') }} type="text/javascript"></script>
<script src={{ asset('Plugins/FancyBox/FancyBox.js') }} type="text/javascript"></script>
<script src={{ asset('Plugins/JQueryUI/JQueryUI.js') }} type="text/javascript"> </script>
<script src={{ asset('Plugins/Validation/JQuery.Validate.js') }} type="text/javascript"></script>
<script src={{ asset('Plugins/ColorPicker/ColorPicker.js') }} type="text/javascript"></script>
<script src={{ asset('Plugins/Bootstrap/Slider/Bootstrap-Slider.js') }} type="text/javascript"></script>

<!-- Plugin Slick -->

<script src={{ asset('Plugins/Slick/Slick.js') }} type="text/javascript"></script>


<!-- JS : JQuery -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- ------------------------------------------------------------------------------ -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" type="text/javascript"></script>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
