

@section('conteudo')
    <div class="col-md-11 m-auto tabela">
        <table class="table table-striped mx-auto" id="filtertable">
            @csrf
            <thead class="headertable">
                <tr class="text-center">
                    <th scope="col-5">@lang('proprietarios.nome')</th>
                    <th scope="col-5">@lang('proprietarios.tipo_pessoa')</th>
                    <th scope="col-5">@lang('proprietarios.documento')</th>
                    <th scope="col-5">@lang('proprietarios.telefone')</th>
                    <th scope="col-5">@lang('proprietarios.email')</th>
                    <th scope="col-2">@lang('sidenav.acoes')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proprietarios as $proprietario)
                    <tr>
                        <td>{{ $proprietario->nome }}</td>
                        <td>{{ $proprietario->tipo_pessoa }}</td>
                        <td>{{ $proprietario->documento }}</td>
                        <td>{{ $proprietario->telefone }}</td>
                        <td>{{ $proprietario->email }}</td>
                        <td class="acoes">
                            <form action="{{ action('Sistema\ProprietarioController@destroy', $proprietario['id']) }}"
                                method="POST" class="delete_form">
                                {{ csrf_field() }}
                                <a href="{{ route('proprietario.editar', $proprietario->id) }}"><button type="button" class=""><i
                                        class='fa fa-fw fa-pen'></i></button></a>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class=""><i class='fa fa-fw fa-times'></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tfoot>
        </table>
    </div>
@endsection

{{-- *************************************************** --}}
{{-- Start of the JS scripts on this page  --}}
@section('scripts')
<script>
    /* --- Deletes a row from the table --- */
    $('.delete_form').on('submit', function()
    {
        if (confirm(" Deseja realmente excluir ? "))
        {
            return true;
        }
        else
        {
            return false;
        }
    });

    /* --- Page input search filter --- */
    $(document).ready(function() {
        $("#filtrotabela").on("keyup", function()
        {
            var value = $(this).val().toLowerCase();
            $("#filtertable tr").filter(function()
            {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
    @include('_layouts._includes._validators_jquery')
@endsection
