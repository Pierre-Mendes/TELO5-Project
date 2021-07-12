<style>
    .cor-fundo{
        background-color:#005F8D;
        color:white;
    }
</style>

<br/>
<!--Tabela de funcionamento do pivô-->
<div class="do-not-break">
        <div class="row">
                <div class="col-8">
                    <div class="text-center cor-fundo" >
                        <h4><b>@lang('fichaTecnica.tabelaFuncionamentoPivo')</b></h4>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead class="thead" style="">
                            <tr>
                                <th class="text-center">@lang('afericao.velocidade') @lang('unidadesAcoes.porcentagem')</th>
                                <th class="text-center">@lang('afericao.volta') @lang('unidadesAcoes.(h:min)')</th>
                                <th class="text-center">@lang('afericao.1/2Volta') @lang('unidadesAcoes.(h:min)')</th>
                                <th class="text-center">@lang('afericao.1/4Volta') @lang('unidadesAcoes.(h:min)')</th>
                                <th class="text-center">@lang('afericao.lamina') @lang('unidadesAcoes.(mm)')</th>
                                <th class="text-center">@lang('afericao.estimativaCusto') @lang('afericao.eletrico') @lang('unidadesAcoes.(R$)')</th>
                                <th hidden class="text-center">@lang('afericao.estimativaCusto') @lang('afericao.diesel') @lang('unidadesAcoes.(R$)')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($b=100; $b>=5; $b=$b-5)
                                <tr>
                                    <td class="text-center">{{$b}}</td>
                                    <td class="text-center">{{ number_format($velocidade_pivo[$b]['volta'], 2,",",".") }}</td>
                                    <td class="text-center">{{ number_format($velocidade_pivo[$b]['volta_1_2'], 2,",",".") }}</td>
                                    <td class="text-center">{{ number_format($velocidade_pivo[$b]['volta_1_4'], 2,",",".") }}</td>
                                    <td class="text-center">{{ number_format($velocidade_pivo[$b]['lamina_mm'], 2,",",".") }}</td>
                                    <td class="text-center">{{ number_format($velocidade_pivo[$b]['estimativa_custo_eletrico'], 2,",",".") }}</td>
                                    @if(array_key_exists('estimativa_custo_diesel', $velocidade_pivo[$b]))
                                        <td hidden class="text-center">{{ number_format($velocidade_pivo[$b]['estimativa_custo_diesel'], 2,",",".") }}</td>
                                    @endif
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            
                <!--Estimativa de custo de aplicação da lâmina-->
                <div class="col-4">
                    <div class="text-center cor-fundo" >
                        <h4><b>@lang('fichaTecnica.estimativaCustoAplicacaoLamina')</b> (@lang('afericao.eletrico'))</h4>
                    </div>
            
                    <div class="row">
                        <div class="col-md-6"><b>@lang('fichaTecnica.numMotores')</b></div>
                        <div class="col-md-6 text-right">{{$dados_estimativa_custo_lamina['num_motores']}}</div>
                    </div>
            
            
                    <div class="row">
                        <div class="col-md-6"><b>@lang('fichaTecnica.motor')</b></div>
                        <div class="col-md-6 text-right">
                            @lang('afericao.eletrico')
                        </div>
                    </div>
            
            
                    <div class="row">
                        <div class="col-md-8"><b>@lang('fichaTecnica.potenciaTotalSistema')</b>@lang('unidadesAcoes.(cv)')</div>
                        <div class="col-md-4 text-right">{{ number_format( $dados_estimativa_custo_lamina['potencia_total_sistema'] ,2,",",".")}} </div>
                    </div>
            
            
                    <div class="row">
                        <div class="col-md-6"><b>@lang('fichaTecnica.laminaAnual')</b>@lang('unidadesAcoes.(mm)')</div>
                        <div class="col-md-6 text-right">{{ number_format( $dados_estimativa_custo_lamina['lamina_anual'] ,2,",",".")}} </div>
                    </div>
            
            
                    <div class="row">
                        <div class="col-md-8"><b>@lang('fichaTecnica.consumoEletricoAnual')</b>@lang('unidadesAcoes.(h)')</div>
                        <div class="col-md-4 text-right">{{$dados_estimativa_custo_lamina['consumo_eletrico_anual']}} </div>
                    </div>  
            
                    <div class="row">
                        <div class="col-md-6"><b>@lang('fichaTecnica.custoMedio')</b>@lang('unidadesAcoes.($/kWh)')</div>
                        <div class="col-md-6 text-right">{{ number_format( $dados_estimativa_custo_lamina['custo_medio'] ,2,",",".")}} </div>
                    </div>
            
            
                    <div class="row">
                        <div class="col-md-8"><b>@lang('fichaTecnica.custoEletrico')</b>@lang('unidadesAcoes.(R$/mm/ha)')</div>
                        <div class="col-md-4 text-right">{{ number_format( $dados_estimativa_custo_lamina['custo_eletrico'] ,2,",",".")}}</div>
                    </div>
                </div>
            </div>  
            <!------------------------------------------------------------------------------------------------>
            <br>
</div>

<!--Observações-->
<div class='row do-not-break'>
    <div class="col-12">
        <div class="text-center cor-fundo" >
            <h4><b>@lang('fichaTecnica.observacoes')</b></h4>
        </div>
        <div class="text-center">
            <textarea name="" class="form-control" onchange="checkIfTextAreaIsEmpty()" id="textoObservacoes" rows="3" cols="100"> {{$texto_observacoes}}</textarea>
        </div>
    <br>
    </div>
</div>

<div class="do-not-break">
    <!--AVALIAÇÕES-->
    <div class="text-center cor-fundo cor-fundo" >
        <h4><b>@lang('fichaTecnica.avaliacoes')</b></h4>
    </div>
    <hr>
    <!--UNIFORMIDADE-->
    <div class="text-center cor-fundo" >
        <h4><b>@lang('fichaTecnica.uniformidade')</b></h4>
    </div>
    <div class="text-center">
        <textarea name="" class="form-control" onchange="checkIfTextAreaIsEmpty()" id="textoUniformidade" cols="" rows="5">{{$texto_uniformidade}}</textarea>
    </div>
    <div class="row" >

        <div class="col-12" style="">
            <div class="text-center justify-content-center"  id="grafico_uniformidade"></div>
            
        </div>
    </div>
    <!------------------------------------------------------------------------------------------------>
</div>
<hr>
<!--Teste velocidade a 100%-->
<div class="do-not-break">
    <div class="text-center cor-fundo" >
        <h4><b>@lang('fichaTecnica.testeVelocidade100')</b></h4>
    </div>
    <div class="form-group">
        <textarea name="" class="form-control" id="textoVelocidade" style="text-align: justify;" onchange="checkIfTextAreaIsEmpty()" cols="30" rows="5">{{$texto_velocidade_100}}</textarea>
    </div>
</div>

<!--Tabela de velocidade-->
<div class="row do-not-break">
    <div class="col-md-4">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="">@lang('afericao.percentimetro')</th>
                    <th class="">@lang('afericao.velocidadeProjeto')@lang('unidadesAcoes.(m/h)')</th>
                    <th class="">@lang('afericao.velocidadeMedido')@lang('unidadesAcoes.(m/h)')</th>
                    <th class="">@lang('afericao.velocidadeVariacao')@lang('unidadesAcoes.(%)')</th>
                </tr>                
            </thead>
            <tbody>
                @for($i=100; $i>=10; $i=$i-10)
                    <tr>
                        <td>{{$i}}%</td>
                        @if(isset($dados_velocidade_red['tabela_resultante']['projeto_'.$i.''])) <td>{{ number_format($dados_velocidade_red['tabela_resultante']['projeto_'.$i.''] ,2,",",".")}} </td> @else <td></td> @endif
                        @if(isset($dados_velocidade_red['tabela_resultante']['medido_'.$i.''])) <td>{{number_format($dados_velocidade_red['tabela_resultante']['medido_'.$i.''], 2,",",".")}}</td> @else <td></td> @endif
                        @if(isset($dados_velocidade_red['tabela_resultante']['variacao_'.$i.''])) <td>{{number_format($dados_velocidade_red['tabela_resultante']['variacao_'.$i.''] * 100, 2,",",".")}}</td> @else <td></td> @endif
                    </tr>
                @endfor                                    
            </tbody>
        </table>
    </div>

    <!--Gráfico de velocidade-->
    <div class="col-md-8">
        <div id="grafico_redimensionamento_percentimetro"></div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------>

<!--Conclusão-->
<div class="do-not-break">
    <div class="text-center cor-fundo" >
        <h4><b>@lang('fichaTecnica.conclusao')</b></h4>
    </div>
    <div class="text-center form-group">
        <textarea name="" id="textoConclusao" onchange="checkIfTextAreaIsEmpty()" class="form-control" cols="30" rows="5">{{$texto_conclusao}}</textarea>
    </div>
</div>
<!------------------------------------------------------------------------------------------------>

<script type="text/javascript">
    let textoObservacoes = `{{$texto_observacoes}}`;
    let textoVelocidade = `{{$texto_velocidade_100}}`;
    let textoConclusao = `{{$texto_conclusao}}`;
    let textoUniformidade = `{{$texto_uniformidade}}`;

    function checkIfTextAreaIsEmpty(){
        var velocidade = $("#textoVelocidade");
        var observacoes = $("#textoObservacoes");
        var conclusao = $("#textoConclusao");
        var uniformidade = $("#textoUniformidade");
        if(velocidade.val() === ""){
            velocidade.val(textoVelocidade);
        }
        if(observacoes.val() === ""){
            observacoes.val(textoObservacoes);
        }
        if(conclusao.val() === ""){
            conclusao.val(textoConclusao);
        }
        if(uniformidade.val() === ""){
            uniformidade.val(textoUniformidade);
        }
    }
</script>