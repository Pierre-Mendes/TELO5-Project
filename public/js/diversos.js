

    
        $(document).ready(function() {
            //EditorHTML('.editor_html');

            $(".mask-money").maskMoney({
                prefix: "R$ ",
                affixesStay: false,
                decimal: ",",
                thousands: "",
                allowZero: true,
                allowNegative: true
            });
            $(".mask-money-nozero").maskMoney({
                prefix: "R$ ",
                affixesStay: false,
                decimal: ",",
                thousands: "",
                allowZero: false,
                allowNegative: true
            });

            $(".mask-int").maskMoney({
                decimal: "",
                thousands: "",
                precision: 0,
                allowZero: true,
                allowNegative: true
            });
            $(".mask-int-nozero").maskMoney({
                decimal: "",
                thousands: "",
                precision: 0,
                allowZero: false,
                allowNegative: true
            });
            $(".mask-int-nonegative").maskMoney({
                decimal: "",
                thousands: "",
                precision: 0,
                allowZero: true,
                allowNegative: false
            });
            $(".mask-int-nozero-nonegative").maskMoney({
                decimal: "",
                thousands: "",
                precision: 0,
                allowZero: false,
                allowNegative: false
            });

            $(".mask-float").maskMoney({
                decimal: ",",
                thousands: "",
                precision: 2,
                allowZero: true,
                allowNegative: true
            });
            $(".mask-float-nozero").maskMoney({
                decimal: ",",
                thousands: "",
                precision: 2,
                allowZero: false,
                allowNegative: true
            });
            $(".mask-float-nonegative").maskMoney({
                decimal: ",",
                thousands: "",
                precision: 2,
                allowZero: true,
                allowNegative: false
            });
            $(".mask-float-nozero-nonegative").maskMoney({
                decimal: ",",
                thousands: "",
                precision: 2,
                allowZero: false,
                allowNegative: false
            });

            $(".mask-coordinate").maskMoney({
                decimal: ".",
                thousands: "",
                precision: 8,
                allowZero: true,
                allowNegative: true
            });

            $('.mask-hora-completa').mask('99:99:99');
            $('.mask-hora').mask('99:99');
            $('.mask-data').mask('99/99/9999');
            $('.mask-data-hora').mask('99/99/9999 - 99:99');

            $('.mask-datapicker').mask('99/99/9999').datepicker({
                beforeShow: function() {
                    setTimeout(function() {
                        $('.ui-datepicker').css('z-index', 300000);
                    }, 0);
                }
            });

            $('.mask-ano').mask('9999');
            $('.mask-cep').mask('99999-999');
            $('.mask-cpf').mask('999.999.999-99');
            $('.mask-cnpj').mask('99.999.999/9999-99');

            $('.mask-int-1').mask('9');
            $('.mask-int-2').mask('9?9');
            $('.mask-int-3').mask('9?99');

            $('.mask-phone').mask("(99) 9999-9999?9").on('focusout', function(event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask("(99) 99999-999?9");
                } else {
                    element.mask("(99) 9999-9999?9");
                }
            });

            $('.mask-phone-international').mask("+99 (99) 9999-9999?9").on('focusout', function(event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 12) {
                    element.mask("+99 (99) 99999-999?9");
                } else {
                    element.mask("+99 (99) 9999-9999?9");
                }
            });

            $('.mask-hora-dinamica').mask("99:99?9").on('focusout', function(event) {
                var target, hora, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                hora = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (hora.length > 4) {
                    element.mask("999:9?9");
                } else {
                    element.mask("99:99?9");
                }
            });

            $('.mask-hora-dinamica[data-onload]').each(function() {
                var hora = $(this).val();
                hora = hora.replace(/\D/g, '');
                var element = $(this);
                element.unmask();
                if (hora.length > 4) {
                    element.mask("999:9?9");
                } else {
                    element.mask("99:99?9");
                }
            });


            // Frame : Visualizar Pessoa
            $(".link_pessoa").colorbox({
                iframe: true,
                innerWidth: 400,
                innerHeight: 550
            });

            // FancyBox (Fotos)
            $(".frame-fotos").attr('rel', 'gallery').fancybox({
                openEffect: 'fade',
                closeEffect: 'none'
            });

            // FancyBox (Vídeo YouTube)
            $(".frame-video-youtube").click(function() {
                $.fancybox({
                    'padding': 0,
                    'autoScale': false,
                    'transitionIn': 'none',
                    'transitionOut': 'none',
                    'title': this.title,
                    'width': 680,
                    'height': 495,
                    'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
                    'type': 'swf',
                    'swf': {
                        'wmode': 'transparent',
                        'allowfullscreen': 'true'
                    }
                });

                return false;
            });

            // FancyBox (Vídeo Vimeo)
            $(".frame-video-vimeo").click(function() {
                $.fancybox({
                    'padding': 0,
                    'autoScale': false,
                    'transitionIn': 'none',
                    'transitionOut': 'none',
                    'width': 680,
                    'height': 495,
                    'href': this.href,
                    'type': 'swf'
                });

                return false;
            });


            $(document).tooltip({
                position: {
                    my: "center bottom-15",
                    at: "center top",
                    using: function(position, feedback) {
                        $(this).css(position);
                        $("<div>")
                            .addClass("arrow")
                            .addClass(feedback.vertical)
                            .addClass(feedback.horizontal)
                            .appendTo(this);
                    }
                },
                content: function() {
                    return $(this).prop('title');
                }
            });

            // Show the Modal on load
            $("#modalNotificacoes").modal("show");

        });

        $(window).scroll(function() {
            // Altera a posição dos botões "bullet" de ação da página
            if ($(window).scrollTop() > 100) {
                $('.bullet-actions').addClass('fixed-bottom');
            } else {
                $('.bullet-actions').removeClass('fixed-bottom');
            }
        });

        // Função "number_format"
        Number.prototype.number_format = function(c, d, t) {
            var n = this,
                c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "." : d,
                t = t == undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
                j = (j = i.length) > 3 ? j % 3 : 0;

            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d +
                Math.abs(n - i).toFixed(c).slice(2) : "");
        };

    
    /* JS : Sistema de Conversões */


        /**
         * Converte um comprimento de "mm" para "polegada"
         * @param Float $MM -> O comprimento em milímetro (mm)
         * @return Float $Polegada -> O comprimento em polegadas (polegadas)
         */
        function CONVERSOR_MM__Polegada($MM) {
            // Trata a entrada
            $MM = parseFloat($MM);
            if (isNaN($MM)) $MM = 0.00;

            // Aplica a conversão
            $Polegada = $MM * 0.03937008;

            // Retorna o valor convertido
            return $Polegada;
        }

        /**
         * Converte um comprimento de "polegada" para "mm"
         * @param Float $Polegada -> O comprimento em polegadas (polegadas)
         * @return Float $MM -> O comprimento em milímetros (mm)
         */
        function CONVERSOR_Polegada__MM($Polegada) {
            // Trata a entrada
            $Polegada = parseFloat($Polegada);
            if (isNaN($Polegada)) $Polegada = 0.00;

            // Aplica a conversão
            $MM = $Polegada / 0.03937008;

            // Retorna o valor convertido
            return $MM;
        }

        /**
         * Converte um comprimento de "cm" para "polegada"
         * @param Float $CM -> O comprimento em centímetro (cm)
         * @return Float $Polegada -> O comprimento em polegadas (polegadas)
         */
        function CONVERSOR_CM__Polegada($CM) {
            // Trata a entrada
            $CM = parseFloat($CM);
            if (isNaN($CM)) $CM = 0.00;

            // Aplica a conversão
            $Polegada = $CM * 0.3937008;

            // Retorna o valor convertido
            return $Polegada;
        }

        /**
         * Converte um comprimento de "polegada" para "cm"
         * @param Float $Polegada -> O comprimento em polegadas (polegadas)
         * @return Float $CM -> O comprimento em centímetros (cm)
         */
        function CONVERSOR_Polegada__CM($Polegada) {
            // Trata a entrada
            $Polegada = parseFloat($Polegada);
            if (isNaN($Polegada)) $Polegada = 0.00;

            // Aplica a conversão
            $CM = $Polegada / 0.3937008;

            // Retorna o valor convertido
            return $CM;
        }

        /**
         * <b>Converte "mm/h" para "pol/h"</b>
         * @param FLOAT $MMh
         * @return FLOAT
         */
        function CONVERSOR_MMh__POLEGADAh($MMh) {
            // Trata a entrada
            $MMh = parseFloat($MMh);
            if (isNaN($MMh)) $MMh = 0.00;

            // Aplica a conversão
            $POLEGADAh = $MMh * 25.400013716;

            // Retorna o valor convertido
            return $POLEGADAh;
        }

        /**
         * <b>Converte "pol/h" para "mm/h" </b>
         * @param FLOAT $POLEGADAh
         * @return FLOAT
         */
        function CONVERSOR_POLEGADAh__MMh($POLEGADAh) {
            // Trata a entrada
            $POLEGADAh = parseFloat($POLEGADAh);
            if (isNaN($POLEGADAh)) $POLEGADAh = 0.00;

            // Aplica a conversão
            $MMh = $POLEGADAh * 0.0393701;

            // Retorna o valor convertido
            return $MMh;
        }

        /**
         * Converte um comprimento de "m" para "pé"
         * @param Float $M -> O comprimento em metro (m)
         * @return Float $Pe -> O comprimento em pés (pé)
         */
        function CONVERSOR_Metro__Pe($M) {
            // Trata a entrada
            $M = parseFloat($M);
            if (isNaN($M)) $M = 0.00;

            // Aplica a conversão
            $Pe = $M / 0.3048;

            // Retorna o valor convertido
            return $Pe;
        }

        /**
         * Converte um comprimento de "pé" para "m"
         * @param Float $Pe -> O comprimento em pés (pé)
         * @return Float $M -> O comprimento em metros (m)
         */
        function CONVERSOR_Pe__Metro($Pe) {
            // Trata a entrada
            $Pe = parseFloat($Pe);
            if (isNaN($Pe)) $Pe = 0.00;

            // Aplica a conversão
            $M = $Pe * 0.3048;

            // Retorna o valor convertido
            return $M;
        }

        /**
         * Converte uma área de "hectare" para "acre"
         * @param Float $HA -> A área em hectare (ha)
         * @return Float $Acre -> A área em acre (acre)
         */
        function CONVERSOR_Hectare__Acre($HA) {
            // Trata a entrada
            $HA = parseFloat($HA);
            if (isNaN($HA)) $HA = 0.00;

            // Aplica a conversão
            $Acre = $HA / 0.404686;

            // Retorna o valor convertido
            return $Acre;
        }

        /**
         * Converte uma área de "acre" para "hectare"
         * @param Float $Acre -> A área em acre (acre)
         * @return Float $HA -> A área em hectare (ha)
         */
        function CONVERSOR_Acre__Hectare($Acre) {
            // Trata a entrada
            $Acre = parseFloat($Acre);
            if (isNaN($Acre)) $Acre = 0.00;

            // Aplica a conversão
            $HA = $Acre * 0.404686;

            // Retorna o valor convertido
            return $HA;
        }

        /**
         * Converte um valor de "R$/ha" para "R$/acre"
         * @param Float $RS_HA -> O valor em (R$/ha)
         * @return Float $RS_ACRE -> O valor em (R$/acre)
         */
        function CONVERSOR_RS_HA__RS_Acre($RS_HA) {
            // Trata a entrada
            $RS_HA = parseFloat($RS_HA);
            if (isNaN($RS_HA)) $RS_HA = 0.00;

            // Aplica a conversão
            $RS_Acre = $RS_HA / 0.404686;

            // Retorna o valor convertido
            return $RS_Acre;
        }

        /**
         * Converte um valor de "R$/acre" para "R$/ha"
         * @param Float $RS_Acre -> O valor em (R$/acre)
         * @return Float $RS_HA -> O valor em (R$/ha)
         */
        function CONVERSOR_RS_Acre__RS_HA($RS_Acre) {
            // Trata a entrada
            $RS_Acre = parseFloat($RS_Acre);
            if (isNaN($RS_Acre)) $RS_Acre = 0.00;

            // Aplica a conversão
            $RS_HA = $RS_Acre * 0.404686;

            // Retorna o valor convertido
            return $RS_HA;
        }

        /**
         * Converte um valor de "R$/mm/ha" para "R$/pol/acre"
         * @param Float $RS_MM_HA -> O valor em (R$/mm/ha)
         * @return Float $RS_Pol_Acre -> O valor em (R$/pol/acre)
         */
        function CONVERSOR_RS_MM_HA__RS_Polegada_Acre($RS_MM_HA) {
            // Trata a entrada
            $RS_MM_HA = parseFloat($RS_MM_HA);
            if (isNaN($RS_MM_HA)) $RS_MM_HA = 0.00;

            // Aplica a conversão
            $RS_Pol_Acre = $RS_MM_HA / 2.47105 / 0.0393701;

            // Retorna o valor convertido
            return $RS_Pol_Acre;
        }

        /**
         * Converte um valor de "R$/pol/acre" para "R$/mm/ha"
         * @param Float $RS_Pol_Acre -> O valor em (R$/pol/acre)
         * @return Float $RS_MM_HA -> O valor em (R$/mm/ha)
         */
        function CONVERSOR_RS_Polegada_Acre__RS_MM_HA($RS_Pol_Acre) {
            // Trata a entrada
            $RS_Pol_Acre = parseFloat($RS_Pol_Acre);
            if (isNaN($RS_Pol_Acre)) $RS_Pol_Acre = 0.00;

            // Aplica a conversão
            $RS_MM_HA = $RS_Pol_Acre * 2.47105 * 0.0393701;

            // Retorna o valor convertido
            return $RS_MM_HA;
        }

        /**
         * Converte um peso de "tonelada/hectare" para "tonelada/acre"
         * @param Float $THA -> O peso em tonelada/hectare (t/ha)
         * @return Float $TAcre -> O peso em tonlada/acre (t/acre)
         */
        function CONVERSOR_ToneladaHectare__ToneladaAcre($THA) {
            // Trata a entrada
            $THA = parseFloat($THA);
            if (isNaN($THA)) $THA = 0.00;

            // Aplica a conversão
            $TAcre = $THA * 0.404686;

            // Retorna o valor convertido
            return $TAcre;
        }

        /**
         * Converte um peso de "tonelada/acre" para "tonelada/hectare"
         * @param Float $TAcre -> O peso em tonelada/acre (t/acre)
         * @return Float $THA -> O peso em tonelada/hectare (t/ha)
         */
        function CONVERSOR_ToneladaAcre__ToneladaHectare($TAcre) {
            // Trata a entrada
            $TAcre = parseFloat($TAcre);
            if (isNaN($TAcre)) $TAcre = 0.00;

            // Aplica a conversão
            $THA = $TAcre / 0.404686;

            // Retorna o valor convertido
            return $THA;
        }

        /**
         * Converte uma temperatura de "Celsius" para "Fahrenheit"
         * @param Float $Celsius -> A temperatura em Celsius (ºC)
         * @return Float $Fahrenheit -> A temperatura em Fahrenheit (ºF)
         */
        function CONVERSOR_Celsius__Fahrenheit($Celsius) {
            // Trata a entrada
            $Celsius = parseFloat($Celsius);
            if (isNaN($Celsius)) $Celsius = 0.00;

            // Aplica a conversão
            $Fahrenheit = ($Celsius * 1.8) + 32;

            // Retorna o valor convertido
            return $Fahrenheit;
        }

        /**
         * Converte uma temperatura de "Fahrenheit" para "Celsius"
         * @param Float $Fahrenheit -> A temperatura em Fahrenheit (ºF)
         * @return Float $Celsius -> A temperatura em Celsius (ºC)
         */
        function CONVERSOR_Fahrenheit__Celsius($Fahrenheit) {
            // Trata a entrada
            $Fahrenheit = parseFloat($Fahrenheit);
            if (isNaN($Fahrenheit)) $Fahrenheit = 0.00;

            // Aplica a conversão
            $Celsius = ($Fahrenheit - 32) / 1.8;

            // Retorna o valor convertido
            return $Celsius;
        }

        /**
         * Converte uma velocidade de "m/s" para "mph"
         * @param Float $MetroSegundo -> A velocidade em metro porsegundo (m/s)
         * @return Float $MilhaHora -> A velocidade em milha por hora (mph)
         */
        function CONVERSOR_MetroSegundo__MilhaHora($MetroSegundo) {
            // Trata a entrada
            $MetroSegundo = parseFloat($MetroSegundo);
            if (isNaN($MetroSegundo)) $MetroSegundo = 0.00;

            // Aplica a conversão
            $MilhaHora = $MetroSegundo / 0.44704;

            // Retorna o valor convertido
            return $MilhaHora;
        }

        /**
         * Converte uma velocidade de "mph" para "m/s"
         * @param Float $MilhaHora -> A velocidade em metro porsegundo (mph)
         * @return Float $MetroSegundo -> A velocidade em milha por hora (m/s)
         */
        function CONVERSOR_MilhaHora__MetroSegundo($MilhaHora) {
            // Trata a entrada
            $MilhaHora = parseFloat($MilhaHora);
            if (isNaN($MilhaHora)) $MilhaHora = 0.00;

            // Aplica a conversão
            $MetroSegundo = $MilhaHora * 0.44704;

            // Retorna o valor convertido
            return $MetroSegundo;
        }

        /**
         * Converte uma velocidade de "m/h" para "pé/h"
         * @param Float $MetroHora -> A velocidade em metro por hora (m/h)
         * @return Float $PeHora -> A velocidade em pés por hora (pé/h)
         */
        function CONVERSOR_MetroHora__PeHora($MetroHora) {
            // Trata a entrada
            $MetroHora = parseFloat($MetroHora);
            if (isNaN($MetroHora)) $MetroHora = 0.00;

            // Aplica a conversão
            $PeHora = $MetroHora / 0.304800956159235;

            // Retorna o valor convertido
            return $PeHora;
        }

        /**
         * Converte uma velocidade de "pé/h" para "m/h"
         * @param Float $PeHora -> A velocidade em pés por hora (pé/h)
         * @return Float $MetroHora -> A velocidade em metro por hora (m/h)
         */
        function CONVERSOR_PeHora__MetroHora($PeHora) {
            // Trata a entrada
            $PeHora = parseFloat($PeHora);
            if (isNaN($PeHora)) $PeHora = 0.00;

            // Aplica a conversão
            $MetroHora = $PeHora * 0.304800956159235;

            // Retorna o valor convertido
            return $MetroHora;
        }

        /**
         * Converte Litros/Segundos para Galões/Minutos
         * @param Float $LitroSeg
         * @return Float $Galoes
         */
        function CONVERSOR_LitroSeg__GalaoMin($LitroSeg) {
            // Trata a entrada
            $LitroSeg = parseFloat($LitroSeg);
            if (isNaN($LitroSeg)) $LitroSeg = 0.00;

            // Aplica a conversão
            $Galoes = $LitroSeg * 0.0630902;

            // Retorna o valor convertido
            return $Galoes;
        }

        /**
         * Converte Galões/Minutos para Litros/Segundos 
         * @param Float $GalaoMin
         * @return Float $LitroSeg
         */
        function CONVERSOR_GalaoMin__LitroSeg($GalaoMin) {
            // Trata a entrada
            $GalaoMin = parseFloat($GalaoMin);
            if (isNaN($GalaoMin)) $GalaoMin = 0.00;

            // Aplica a conversão
            $LitroSeg = $GalaoMin / 18.8503;

            // Retorna o valor convertido
            return $LitroSeg;
        }

        /**
         * Converte uma pressão de "mca" para "psi"
         * @param Float $MCA -> A pressão em mca
         * @return Float $PSI -> A pressão em psi
         */
        function CONVERSOR_MCA__PSI($MCA) {
            // Trata a entrada
            $MCA = parseFloat($MCA);
            if (isNaN($MCA)) $MCA = 0.00;

            // Aplica a conversão
            $PSI = $MCA / 0.7035466625683673;

            // Retorna o valor convertido
            return $PSI;
        }

        /**
         * Converte uma pressão de "psi" para "mca"
         * @param Float $PSI -> A pressão em psi
         * @return Float $MCA -> A pressão em mca
         */
        function CONVERSOR_PSI__MCA($PSI) {
            // Trata a entrada
            $PSI = parseFloat($PSI);
            if (isNaN($PSI)) $PSI = 0.00;

            // Aplica a conversão
            $MCA = $PSI * 0.7035466625683673;

            // Retorna o valor convertido
            return $MCA;
        }

        /**
         * Converte uma velocidade de "m³/h" para "gpm"
         * @param Float $M3H -> A velocidade em m³/h
         * @return Float $GPM -> A velocidade em gpm
         */
        function CONVERSOR_M3H__GPM($M3H) {
            // Trata a entrada
            $M3H = parseFloat($M3H);
            if (isNaN($M3H)) $M3H = 0.00;

            // Aplica a conversão
            $GPM = $M3H / 0.227;

            // Retorna o valor convertido
            return $GPM;
        }

        /**
         * Converte uma velocidade de "gpm" para "m³/h"
         * @param Float $GPM -> A velocidade em gpm
         * @return Float $M3H -> A velocidade em m³/h
         */
        function CONVERSOR_GPM__M3H($GPM) {
            // Trata a entrada
            $GPM = parseFloat($GPM);
            if (isNaN($GPM)) $GPM = 0.00;

            // Aplica a conversão
            $M3H = $GPM * 0.227;

            // Retorna o valor convertido
            return $M3H;
        }

        //As configurações do conversor
        var Medidas = parseInt("1");
        if (Medidas < 1) Medidas = 1;
        var Temperaturas = parseInt("1");
        if (Temperaturas < 1) Temperaturas = 1;
        var Datas = parseInt("1");
        if (Datas < 1) Datas = 1;
        var Numeros = parseInt("1");
        if (Numeros < 1) Numeros = 1;

        // MM : Converte para o sistea métrico 
        function CONVERSOR_Interface_MM(Valor, Casas_Decimais = 2, Formatar = true) {
            if (Medidas == 1) return CONVERSOR_Interface_Formata_Numero(Valor, Casas_Decimais, Formatar);
            else if (Medidas == 2) return CONVERSOR_Interface_Formata_Numero(CONVERSOR_Polegada__MM(Valor),
                Casas_Decimais, Formatar);
        }

        // MM : Converte de volta para o sistea imperial
        function CONVERSOR_Interface_MM_VOLTA(Valor, Casas_Decimais = 2, Formatar = true) {
            if (Medidas == 1) return CONVERSOR_Interface_Formata_Numero(Valor, Casas_Decimais, Formatar);
            else if (Medidas == 2) return CONVERSOR_Interface_Formata_Numero(CONVERSOR_MM__Polegada(Valor),
                Casas_Decimais, Formatar);
        }

        // Metro : Converte para o sistea métrico
        function CONVERSOR_Interface_M(Valor, Casas_Decimais = 2, Formatar = true) {
            if (Medidas == 1) return CONVERSOR_Interface_Formata_Numero(Valor, Casas_Decimais, Formatar);
            else if (Medidas == 2) return CONVERSOR_Interface_Formata_Numero(CONVERSOR_Pe__Metro(Valor), Casas_Decimais,
                Formatar);
        }

        // Metro : Converte de volta para o sistea imperial
        function CONVERSOR_Interface_M_VOLTA(Valor, Casas_Decimais = 2, Formatar = true) {
            if (Medidas == 1) return CONVERSOR_Interface_Formata_Numero(Valor, Casas_Decimais, Formatar);
            else if (Medidas == 2) return CONVERSOR_Interface_Formata_Numero(CONVERSOR_Metro__Pe(Valor), Casas_Decimais,
                Formatar);
        }

        // Hectare : Converte para o sistea métrico
        function CONVERSOR_Interface_Hectare(Valor, Casas_Decimais = 2, Formatar = true) {
            if (Medidas == 1) return CONVERSOR_Interface_Formata_Numero(Valor, Casas_Decimais, Formatar);
            else if (Medidas == 2) return CONVERSOR_Interface_Formata_Numero(CONVERSOR_Acre__Hectare(Valor),
                Casas_Decimais, Formatar);
        }

        // Hectare : Converte de volta para o sistea imperial
        function CONVERSOR_Interface_Hectare_VOLTA(Valor, Casas_Decimais = 2, Formatar = true) {
            if (Medidas == 1) return CONVERSOR_Interface_Formata_Numero(Valor, Casas_Decimais, Formatar);
            else if (Medidas == 2) return CONVERSOR_Interface_Formata_Numero(CONVERSOR_Hectare__Acre(Valor),
                Casas_Decimais, Formatar);
        }

        // m³/h : Converte para o sistea métrico
        function CONVERSOR_Interface_M3H(Valor, Casas_Decimais = 2, Formatar = true) {
            if (Medidas == 1) return CONVERSOR_Interface_Formata_Numero(Valor, Casas_Decimais, Formatar);
            else if (Medidas == 2) return CONVERSOR_Interface_Formata_Numero(CONVERSOR_GPM__M3H(Valor), Casas_Decimais,
                Formatar);
        }

        // m³/h : Converte de volta para o sistea imperial
        function CONVERSOR_Interface_M3H_VOLTA(Valor, Casas_Decimais = 2, Formatar = true) {
            if (Medidas == 1) return CONVERSOR_Interface_Formata_Numero(Valor, Casas_Decimais, Formatar);
            else if (Medidas == 2) return CONVERSOR_Interface_Formata_Numero(CONVERSOR_M3H__GPM(Valor), Casas_Decimais,
                Formatar);
        }

        // Função de formatação de números (usada pelas outras funções acima)
        function CONVERSOR_Interface_Formata_Numero(Valor, Casas_Decimais = 2, Formatar = true) {
            Valor = parseFloat(Valor);
            if (Formatar == true) {
                // Os caracteres de separação
                if (Numeros == 1) {
                    Caractere_Milhares = ".";
                    Caractere_Decimais = ",";
                } else if (Numeros == 2) {
                    Caractere_Milhares = ",";
                    Caractere_Decimais = ".";
                }

                return Valor.number_format(Casas_Decimais, Caractere_Decimais, Caractere_Milhares);
            } else {
                // Retorna a formatação padrão para uso em formulários e gráficos
                //return parseFloat(Valor.number_format(Casas_Decimais, ".", ""));
                return parseFloat(Valor.toFixed(Casas_Decimais)); //parseFloat(irrigacaoMM.toFixed(2));    	
            }
        }
