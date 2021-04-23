@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')@endsection
@section('titulo')@lang('bocais.bocais')@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- Titlle and Subtitlle --}}
            <div class="col-6">
                <h1>@lang('bocais.bocais')</h1>
            </div>

            {{-- Save button an return button --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('fabricantes.gerenciar') }}" style="color: #3c8dbc">
                    <button type="button">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </a>
                <button type="button" id="botaosalvar">
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
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" role="tab" aria-controls="cadastro"
                    aria-current="page" aria-selected="true" href="#cadastro">Geral</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                <form action="{{route('bocais.cadastra')}}" method="POST">
                    @csrf
                    <div class="table table-striped mx-auto" id="filtertable">
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="fabricante">@lang('bocais.fabricante')</label>
                                <input type="text" name="fabricante" id="fabricante" class="form-control" required/>
                            </div>

                            <div class="col-md-3">
                                <label for="modelo">@lang('bocais.modelo')</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required/>
                            </div>

                            <div class="col-md-2">
                                <label for="tipo">@lang('bocais.tipo')</label>
                               <div>
                                <select name="options">
                                    <option value=""></option>
                                    <option value="0">@lang('afericao.acoSac')</option>
                                    <option value="1">@lang('afericao.az')</option>
                                    <option value="2">@lang('afericao.ferroFundido')</option>
                                    <option value="3">("PVC PN 125</option>
                                </select>
                            </div>
                            </div>

                            <div class="col-2">
                                <label >@lang('bocais.plug')</label>
                                <div>
                                <select>
                                    <option value='0'>@lang('bocais.nao')</option>
                                    <option value='1'>Sim</option>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                        <table class="table table-striped mx-auto" id="filtertable">
                            <thead class="headertable">
                                <tr class="text-center">
                                    <th scope="col-5">@lang('bocais.nome')</th>
                                    <th scope="col-5">@lang('bocais.vazao_10_psi')</th>
                                    <th scope="col-5">@lang('bocais.intervalo_trabalho')</th>
                                    <th scope="col-2">@lang('bocais.acoes')</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><input type="number" step="1" min="1" name="fabricante" id="fabricante" class="form-control" required></td>
                                    <td><input type="number" step="0.01" min="0.01" name="vazaoPSI" id="fabricante" class="form-control" required></td>
                                    <td><input type="number" step="0.01" min="0.01" name="intervaloTrabalho" id="fabricante" class="form-control" required></td>
                                    <td></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tfoot>
                        </table>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        //Function save button
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });
        });
        $('#botaosalvar').tooltip(options)

        //Function create select type tube
        function createSelectTypeTubes(value)
        {
            var select = $("<select  class='form-control' name=\"tipo_cano[]\" />");
            var valuesSelect = [];
            var optionsSelect = [];

            valuesSelect.push(0);
            optionsSelect.push("@lang('afericao.acoSac')");

            valuesSelect.push(1);
            optionsSelect.push("@lang('afericao.az')");

            valuesSelect.push(2);
            optionsSelect.push("@lang('afericao.ferroFundido')");

            valuesSelect.push(3);
            optionsSelect.push("PVC PN 125");

            valuesSelect.push(4);
            optionsSelect.push("PVC PN 140");

            valuesSelect.push(5);
            optionsSelect.push("PVC PN 180");

            valuesSelect.push(6);
            optionsSelect.push("PVC PN 60");

            valuesSelect.push(7);
            optionsSelect.push("PVC PN 80");

            valuesSelect.push(8);
            optionsSelect.push("RPVC PN 100");

            valuesSelect.push(9);
            optionsSelect.push("@lang('afericao.aluminio')");

            valuesSelect.forEach(function(item, index)
        {
            if(item == value)
            {
                $("<option />", {value: item, text: optionsSelect[index]}).appendTo(select).attr('selected', 'selected');
            }
            else
            {
                $("<option />", {value: item, text: optionsSelect[index]}).appendTo(select);
            }
        });
                return select;
        }
    </script>
    @include('_layouts._includes._validators_jquery')
@endsection
