@extends('_layouts._layout_site')

@section('head')
@endsection
@section('titulo')
    @lang('proprietarios.proprietarios')
@endsection

@section('topo_detalhe')

    <div style="display: inline-block">
        <p>teste</p>
    </div>
    {{-- <div style="display: inline-block; float: right; margin-right: 20px; margin-top: -60px">
        <a href="{{ route('proprietarios.gerenciar') }}"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
    </div> --}}
    <div class="menubotoes">
        <div style="display: inline-block; float: right;" class="botoes">
            <button type="button" class="botaosalvar5" style="margin-right: -10px; outline: none" id="botaosalvar"><i
                    class="fas fa-save fa-2x" style="color:rgba(255, 255, 255, 0.822)"></i></button>
        </div>
        <div style="display: inline-block; float: right;" class="voltar">
            <a href="{{ route('proprietarios.gerenciar') }}">
                <button class="voltar" style="outline: none"><i class="fas fa-angle-double-left"></i></button>
            </a>
        </div>
    </div>
@endsection

@section('conteudo')
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Editar</a>
            </li>
        </ul>
        <form action="{{ route('proprietario.edita') }}" method="post" class="row" id="formdados">
            @csrf
            <input type="hidden" name="id" value="{{ $proprietarios->id }}">
            <div class="col-md-12">
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-3">
                        <label for="nome">@lang('proprietarios.nome')</label>
                        <input type="text" class="form-control" id="nome" name="nome" maxlength="50" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefone">@lang('proprietarios.telefone')</label>
                        <input type="number" class="form-control" id="telefone" name="telefone" maxlength="15"
                            required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="email">@lang('proprietarios.email')</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="50" required>
                    </div>
                </div>

                <div class="form-row justify-content-center">
                    <div class="form-group col-md-3">
                        <label for="tipo_pessoa">@lang('proprietarios.tipo_pessoa')</label><br>
                        <select name="tipo_pessoa" id="tipo_pessoa" required>
                            <option value="fisica">@lang('proprietarios.pessoa_fisica')</option>
                            <option value="juridica">@lang('proprietarios.pessoa_juridica')</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="documento">@lang('proprietarios.documento')</label>
                        <input type="text" class="form-control" id="documento" name="documento" maxlength="20"
                            required>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });
        });

    </script>
    @include('_layouts._includes._validators_jquery')
@endsection
