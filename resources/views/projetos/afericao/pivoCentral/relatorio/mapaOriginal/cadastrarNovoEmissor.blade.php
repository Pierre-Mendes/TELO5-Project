@extends('_layouts._layout_site')
<?php
$afericao = session()->get('afericao');
$num_lance = session()->get('lance')['numero_lance'];
$lance = session()->get('lance');
$total_emissores = $emissores['numero_emissores'];
?>

@section('head')
    <script>
        function setValue(id, valor) {
            console.log(id + "-" + valor);
            $("#" + id + "").val(valor);
        }

    </script>
@endsection

@section('titulo')

@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.emissores')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.cadastrar')</h4>
            </div>
            <div class="col-6 text-right botoes position">
                <button type="button" id="botaosalvar" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-save fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('conteudo')
    {{-- NAVTAB'S --}}
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">@lang('comum.informacoes_navtabs')</a>
        </li>
    </ul>

    {{-- PRELOADER --}}
    <div id="coverScreen">
        <div class="preloader">
            <i class="fas fa-circle-notch fa-spin fa-2x"></i>
            <div>@lang('comum.preloader')</div>
        </div>
    </div>

    {{-- FORMULARIO DE CADASTRO --}}
    <form action="{{ route('newIssuer_save') }}" method="POST" id="formdados" class="mx-5">
        <div class="tab-content" id="myTabContent">
            @include('_layouts._includes._alert')
            <div class="tab-pane fade show active formcdc" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                @csrf
                <input type="hidden" name="id_lance" id="id_lance" value="{{ $id_lance }}">
                <input type="hidden" name="emissores" id="emissores" value="{{ $emissores }}">
                <input type="hidden" name="id_afericao" id="id_afericao" value="{{ $id_afericao }}">
                <input type="hidden" name="espacamento" id="espacamento" value="{{ $espacamento }}">
                <input type="hidden" name="comprimento" id="comprimento" value=0>
                <div class="table-responsive m-auto tabela" id="cssPreloader">
                    <table class="table table-striped mx-auto mt-5 text-center" id="tabelaTrechos">
                        <thead>
                            <tr>
                                <th hidden></th>
                                <th >@lang('comum.#')</th>
                                <th scope="col">@lang('afericao.saida1')</th>
                                <th scope="col">@lang('afericao.saida2')</th>
                                <th scope="col">@lang('afericao.espacamento')</th>
                                <th scope="col">@lang('afericao.emissor')</th>
                                <th scope="col">@lang('afericao.tipoValvula')</th>
                                <th scope="col">@lang('afericao.psi')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= $total_emissores; $i++)

                                <tr>
                                    <td hidden><input type="hidden" name="numero_emissores[]" value="{{ $i }}"></td>
                                    <td name="numero_emissores[]">{{ $i }}</td>

                                    <td>
                                        <input type="number" @if (!empty($emissores[$i - 1]['saida_1'])) value="{{ $emissores[$i - 1]['saida_1'] }}" @endif step=0.1 min=0 id="bocal_{{ $i }}" name="bocal_1[]"
                                            class="form-control first_field telo5ce ">
                                    </td>
                                    <td>
                                        <input type="number" @if (!empty($emissores[$i - 1]['saida_2'])) value="{{ $emissores[$i - 1]['saida_2'] }}" @endif step=0.1 min=0 name="bocal_2[]" class="form-control telo5ce">
                                    </td>
                                    <td>
                                        <input type="number" name="espacamento[]"
                                            value="{{ $espacamento }}" step=0.001 min=0.001 required
                                            class="form-control espacamento_field telo5ce">
                                    </td>
                                    <td>
                                        <select class='form-control telo5ce' required='true' required name='emissor[]'>
                                            <option @if (strtoupper($id_lance['marca_modelo_emissores']) == 'I-WOB UP3') selected @endif value='I-WOB UP3'>
                                                <b>@lang('afericao.i-wob-up3')</b>
                                            </option>
                                            <option @if (strtoupper($id_lance['marca_modelo_emissores']) == 'FABRIMAR') selected @endif value='Fabrimar'>
                                                <b>@lang('afericao.fabrimar')</b>
                                            </option>
                                            <option @if (strtoupper($id_lance['marca_modelo_emissores']) == 'NELSON') selected @endif value='Nelson'>
                                                <b>@lang('afericao.nelson')</b>
                                            </option>
                                            <option @if (strtoupper($id_lance['marca_modelo_emissores']) == 'SUPER SPRAY - UP3') selected @endif value='Super Spray - UP3'>
                                                <b>@lang('afericao.super-spray-up3')</b>
                                            </option>
                                            <option @if (strtoupper($id_lance['marca_modelo_emissores']) == 'SUPER SPRAY') selected @endif value='Super Spray'>
                                                <b>@lang('afericao.super-spray')</b>
                                            </option>
                                            <option @if (strtoupper($id_lance['marca_modelo_emissores']) == 'I-WOB') selected @endif value='I-WOB'>
                                                <b>@lang('afericao.i-wob')</b>
                                            </option>
                                            <option @if (strtoupper($id_lance['marca_modelo_emissores']) == 'TRASH BUSTER') selected @endif value='Trash Buster'>
                                                <b>@lang('afericao.trash-buster')</b>
                                            </option>
                                            <option @if (strtoupper($id_lance['marca_modelo_emissores']) == 'KOMET') selected @endif value='Komet'>
                                                <b>@lang('afericao.komet')</b>
                                            </option>
                                            <option @if (strtoupper($id_lance['marca_modelo_emissores']) == 'FAN SPRAY') selected @endif value='Fan Spray'>
                                                <b>@lang('afericao.fan-spray')</b>
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="val_reg" class='form-control telo5ce' required='true'
                                            name='tipo_valvula[]'>
                                            <option value='LF' @if ($id_lance['tipo_valvula'] == 'LF') selected @endif><b>LF</b></option>
                                            <option value='MF' @if ($id_lance['tipo_valvula'] == 'MF') selected @endif><b>MF</b></option>
                                            <option value='HF' @if ($id_lance['tipo_valvula'] == 'HF') selected @endif><b>HF</b></option>
                                            <option value='PSR' @if ($id_lance['tipo_valvula'] == 'PSR') selected @endif><b>PSR</b></option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="val_reg_{{ $i }}" class='form-control telo5ce'
                                            required='true' name='valvula_reguladora[]'>
                                            <option value='10' @if ($id_lance['valvula_reguladora'] == 10) selected @endif><b>10 PSI</b></option>
                                            <option value='15' @if ($id_lance['valvula_reguladora'] == 15) selected @endif><b>15 PSI</b></option>
                                            <option value='20' @if ($id_lance['valvula_reguladora'] == 20) selected @endif><b>20 PSI</b></option>
                                            <option value='25' @if ($id_lance['valvula_reguladora'] == 25) selected @endif><b>25 PSI</b></option>
                                            <option value='30' @if ($id_lance['valvula_reguladora'] == 30) selected @endif><b>30 PSI</b></option>
                                            <option value='35' @if ($id_lance['valvula_reguladora'] == 35) selected @endif><b>35 PSI</b></option>
                                            <option value='40' @if ($id_lance['valvula_reguladora'] == 40) selected @endif><b>40 PSI</b></option>
                                            <option value='45' @if ($id_lance['valvula_reguladora'] == 45) selected @endif><b>45 PSI</b></option>
                                            <option value='50' @if ($id_lance['valvula_reguladora'] == 50) selected @endif><b>50 PSI</b></option>
                                        </select>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                        <tfoot>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
<script>
  var emissores = [];
  var num_emissor = 1;
  var total_emissor = {
    {
      $total_emissores
    }
  };

  $(document).ready(function() {
    getComprimentoLance();
    $("#bocal_1").focus();
  });

  $('.first_field').keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
      console.log('Enter pressed');
    }
  });

  $(".espacamento_field").change(function() {
    getComprimentoLance();
  })

  function getComprimentoLance() {
    var espacamentos = $(".espacamento_field").toArray();
    var total = 0;
    espacamentos.forEach(valor => {
      total += parseFloat(valor.value);
    });
    $("#comprimento").val(total);
  }

  function getValorEspacamento(emissor) {
    switch (emissor) {
      case '':

        break;
      case '':

        break;
      default:
        return ''
        break;
    }
  }

</script>

{{-- SALVAR E CARREGAR PRELOADER --}}
<script>
  $(document).ready(function() {
    $('#botaosalvar').on('click', function() {
      $("#coverScreen").show();
      $("#cssPreloader input").each(function() {
        $(this).css('opacity', '0.2');
      });
      $("#cssPreloader select").each(function() {
        $(this).css('opacity', '0.2');
      });
      $('#formdados').submit();
    });
  });

  $(window).on('load', function() {
    $("#coverScreen").hide();
  });

</script>
{{-- VALIDAÇÕES DE CAMPOS --}}
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script>
  $(document).ready(function() {
    $('#botaosalvar').on('click', function() {
      $('#formdados').submit();
    });

    $("#formdados").validate({
      ignore: ""
      , invalidHandler: function() {
        setTimeout(function() {
          $('.nav-tabs a small.required').remove();
          var validatePane = $(
            '.tab-content.tab-validate .tab-pane:has(input.error)').each(
            function() {
              var id = $(this).attr('id');
              $('.nav-tabs').find('a[href^="#' + id + '"]').append(
                ' <small class="required">&#9888;&#65039;</small>');
            });
        });
      }
      , rules: {
        "bocal_1[]": {
          required: true
        }
        , "espacamento[]": {
          required: true
        }
        , "emissor[]": {
          required: true
        }
        , "tipo_valvula[]": {
          required: true
        }
        , "valvula_reguladora[]": {
          required: true
        }
      }
      , messages: {
        bocal_1: {
          required: "@lang('validate.validate')"
        }
        , "espacamento[]": {
          required: "@lang('validate.validate')"
        }
        , "emissor[]": {
          required: "@lang('validate.validate')"
        }
        , "tipo_valvula[]": {
          required: "@lang('validate.validate')"
        }
        , "valvula_reguladora[]": {
          required: "@lang('validate.validate')"
        }
      }
      , submitHandler: function(form) {
        $("#coverScreen").show();
        $("#cssPreloader input").each(function() {
          $(this).css('opacity', '0.2');
        });
        $("#cssPreloader select").each(function() {
          $(this).css('opacity', '0.2');
        });
        form.submit();
      }
    });

    $(window).on('load', function() {
      $("#coverScreen").hide();
    });
  });

</script>

<script type="text/javascript" src="jquery-1.6.2.min.js"></script>
<script type="text/javascript">
  /*
$(document).ready(function() {
$("input, select", "form").keypress(function(e) { // evento ao presionar uma tecla válida keypress
   var key = e.which || e.keyCode; // pega o código do evento

   if(key == 13) { // se for == ENTER
      e.preventDefault(); // cancela o submit do formulário através da ação da tecla enter(13)
      $(this).closest('tr') // seleciona a linha atual da tabela
      .next('td') // seleciona a próxima linha do formulário
      .find('input, select') // busca por um input ou select no form
      .first() // seleciona o primeiro input ou select que encontrar no form
      .focus(); // coloca o elemento em foco (aguardando entrada de dados...)
   }
    });
});*/

</script>

<script type="text/javascript" src="jquery-1.6.2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.inputUnico').keypress(function(e) {
      // verifica se o evento é Keycode (para IE e outros browsers) se não for pega o evento Which
      var keyEnter = (e.keyCode ? e.keyCode : e.which);
      //verifica se a keyEnter pressionada é a keyEnter == 'ENTER'
      // 13 é o valor da tecla enter
      if (keyEnter == 13) {
        //guarda o seletor do respectivo input onde foi pressionado o Enter
        input = $('.inputUnico');
        //captura o indexElement do elemento
        indexElement = input.index(this);
        // verifica se não é null
        //se não for null existe outro elemento
        if (input[indexElement + 1] != null) {
          // adiciona 1 no valor do indexElement para alterar o index/input
          nextInput = input[indexElement + 1];
          // passa o foco para o nextInput e o deixa selecionado
          nextInput.focus();
        } else {
          return true;
        }
      }
      if (keyEnter == 13) {
        // impede o submit do form caso esteja dentro de uma tag form e seja disparada a ação da tecla enter
        e.preventDefault(e);

        return false;

      } else {
        /* se tecla != keyEnter deixa escrever */
        return true;
      }
    });
  });
</script>

@endsection
