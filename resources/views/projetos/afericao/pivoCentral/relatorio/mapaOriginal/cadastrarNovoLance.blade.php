@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('topo_detalhe')

<div class="container-fluid topo">
  <div class="row align-items-start">
    {{-- TITULO E SUBTITULO --}}
    <div class="col-6">
      <h1>@lang('afericao.lance')</h1><br>
      <h4 style="margin-top: -20px">@lang('comum.cadastrar')</h4>
    </div>

    {{-- BOTÃO DE SALVAR E VOLTAR --}}
    <div class="col-6 text-right botoes position">
      <a href="{{ route('originalMap_manager', $id_afericao) }}" style="color: #3c8dbc" data-toggle="tooltip" data-placement="bottom" title="Voltar">
        <button type="button">
          <span class="fa-stack fa-lg">
            <i class="fas fa-circle fa-stack-2x"></i>
            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
          </span>
        </button>
      </a>
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
@php
$afericao = session()->get('afericao');
$num_lance = session()->get('numero_lance');
@endphp

{{-- NAVTAB'S --}}
<div class="formafericao">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="lance1-tab" data-toggle="tab" href="#lance1" role="tab" aria-controls="lance1" aria-selected="true"> @lang('comum.informacoes_navtabs')
      </a>
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
  <form action="{{ route('newSpan_save') }}" method="post" id="formdados" class="mt-5">
    @include('_layouts._includes._alert')
    @csrf
    <input type="hidden" name="id_afericao" value="{{ $id_afericao }}">
    <div class="row col-12" id="cssPreloader">
      <div class="col-md-12 row justify-content-center">
        <div class="form-group col-md-3 col-sm-4 telo5ce">
          <label>@lang('afericao.posicao')</label>
          <select name="posicao_relativa" class="form-control" required>
            <option value=""></option>
            <option value="0">@lang('redimensionamento.antesDo')</option>
            <option value="1">@lang('redimensionamento.depoisDo')</option>
          </select>
          <div class="line"></div>
        </div>
        <div class="form-group col-md-3 col-sm-4 telo5ce">
          <label>@lang('afericao.lance')</label>
          <select name="lance_relativo" class="form-control" required>
            @foreach ($lances as $lance)
            <option value=""></option>
            <option value="{{ $lance['numero_lance'] }}">{{ $lance['numero_lance'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-3 col-6 telo5ce">
          @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroEmissores'), 'id' =>
          'numero_emissores'])@endcomponent
          <input type="number" name="numero_emissores" onchange="alterarQuantidadeDeEmissores()" id="numero_emissores" step=1 min=1 class="form-control ">
        </div>

        <div class="form-group col-md-3 col-6 telo5ce">
          @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroTubos'), 'id' =>
          'num_tubo'])@endcomponent
          <input type="number" step=1 min=1 name="numero_tubos" id="num_tubo" required class="form-control ">
        </div>
      </div>

      <div class="col-md-12 row justify-content-center">
        <div class="form-group col-md-3 col-sm-4 telo5ce">
          <label for=""> @lang('afericao.diametro')</label>
          <select name="diametro" class="form-control" required id="">
            <option value=""></option>
            <option value="0.127">5"</option>
            <option value="0.1413">5.9/16</option>
            <option value="0.1524">6"</option>
            <option value="0.1683">6.5/8"</option>
            <option value="0.2032">8"</option>
            <option value="0.219">8.5/8"</option>
            <option value="0.254">10"</option>
          </select>
          <div class="line"></div>
        </div>

        <div class="form-group  col-md-3 col-sm-4 telo5ce">
          <label for="val_reg"> @lang('afericao.valvulaReguladora')</label>
          <select id="val_reg" onchange="atualizarValvulaReguladora()" class='form-control' required='true' name='valvula_reguladora'>
            <option value=""></option>
            <option value='10'><b>10 PSI</b></option>
            <option value='15'><b>15 PSI</b></option>
            <option value='20'><b>20 PSI</b></option>
            <option value='25'><b>25 PSI</b></option>
            <option value='30'><b>30 PSI</b></option>
            <option value='35'><b>35 PSI</b></option>
            <option value='40'><b>40 PSI</b></option>
            <option value='45'><b>45 PSI</b></option>
            <option value='50'><b>50 PSI</b></option>
          </select>
          <div class="line"></div>
        </div>

        <div class="form-group col-md-3 col-6 telo5ce">
          <label for="tipo_valvula"> @lang('afericao.tipoValvula')</label>
          <select id="tipo_valvula" onchange="atualizarTipoValvulaReguladora()" class='form-control' required='true' name='tipo_valvula'>
            <option value=""></option>
            <option value='LF'><b>LF</b></option>
            <option value='MF'><b>MF</b></option>
            <option value='HF'><b>HF</b></option>
            <option value='PSR'><b>PSR</b></option>
          </select>
          <div class="line"></div>
        </div>

        <div class="form-group col-md-3 col-6 telo5ce">
          @component('_layouts._components._inputLabel', ['texto' => __('afericao.motorredutor'), 'id' =>
          'motorredutor'])@endcomponent
          <input type="number" class="form-control " id="motorredutor" step=0.01 name="motorredutor">
        </div>
        <hr>
      </div>
      <div class="form-row justify-content-start">
        <div class="form-group col-md-4 telo5ce">
          <label for="espacamento">@lang('afericao.espacamento')</label>
          <input type="number" class="form-control" id="espacamento[]" name="espacamento[]" step="0.01" min="0.01" />
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@section('scripts')

{{-- FILTRO SELECT --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

{{-- SALVAR E VALIDAR CAMPOS VAZIOS --}}
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script>
  $(document).ready(function() {
    $('#botaosalvar').on('click', function() {
      $('#formdados').submit();
    });

    $("#formdados").validate({
      rules: {
        "posicao_relativa": {
          required: true
        }
        , "lance_relativo": {
          required: true
        }
        , "numero_emissores": {
          required: true
        }
        , "numero_tubos": {
          required: true
        }
        , "diametro": {
          required: true
        }
        , "valvula_reguladora": {
          required: true
        }
        , "tipo_valvula": {
          required: true
        }
        , "motorredutor": {
          required: true
        }
        , "defaultSpace": {
          required: true
        }
      }
      , messages: {
        posicao_relativa: "@lang('validate.validate')",

        defaultSpace: "@lang('validate.validate')",

        "lance_relativo": {
          required: "@lang('validate.validate')"
        }
        , "numero_emissores": {
          required: "@lang('validate.validate')"
        }
        , "numero_tubos": {
          required: "@lang('validate.validate')"
        }
        , "diametro": {
          required: "@lang('validate.validate')"
        }
        , "valvula_reguladora": {
          required: "@lang('validate.validate')"
        }
        , "tipo_valvula": {
          required: "@lang('validate.validate')"
        }
        , "motorredutor": {
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
@endsection
