<style>
    .cor-fundo{
        background-color:#005F8D;
        color:white;
    }
</style>

<!--Bombeamento-->
@foreach($bombeamentos AS $key => $bombeamento)
<div class="do-not-break">
        <div class="text-center cor-fundo" >
                <h4><b>@lang('fichaTecnica.bombeamento') {{$key + 1}}</b></h4>
            </div>
            <div class="row">
                <div class="col-md-2"><b>@lang('fichaTecnica.comprimentoSuccao')</b>@lang('unidadesAcoes.(m)'):</div>
                <div class="col-md-2">{{ number_format( $bombeamento['comprimento_succao'] ,2,",",".")}} </div>
                <div class="col-md-2"><b>@lang('fichaTecnica.diametroSuccao')</b>@lang('unidadesAcoes.(m)'):</div>
                <div class="col-md-2">{{ number_format( $bombeamento['diametro_succao'] ,2,",",".")}} </div>
                <div class="col-md-2"><b>@lang('fichaTecnica.materialSuccao')</b></div>                
                <div class="col-md-2">
                    @if($bombeamento['material_succao'] == 0)@lang('afericao.acoSac') @endif
                    @if($bombeamento['material_succao'] == 1)@lang('afericao.AZ') @endif
                    @if($bombeamento['material_succao'] == 2)@lang('afericao.PVC') @endif
                    @if($bombeamento['material_succao'] == 3)@lang('afericao.RPVC') @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"><b>@lang('fichaTecnica.alturaSuccao')</b>@lang('unidadesAcoes.(m)'):</div>
                <div class="col-md-2"> <!-- Adicionar a coluna no db ou buscar forma de calcular Lev mB. Adut. -> H35 --></div>
                <div class="col-md-2"><b>@lang('fichaTecnica.marca')</b>:</div>
                <div class="col-md-2">{{$bombeamento['marca']}}</div>
                <div class="col-md-2"><b>@lang('fichaTecnica.modelo')</b>:</div>
                <div class="col-md-2">{{$bombeamento['modelo']}}</div>                
            </div>
            <div class="row">
                <div class="col-md-2"><b>@lang('fichaTecnica.rendBomba')</b>:</div>
                <div class="col-md-2">{{$bombeamento['rendimento_bomba']}} %</div>
                <div class="col-md-2"><b>@lang('fichaTecnica.rotacao')</b>@lang('unidadesAcoes.(rpm)'):</div>
                <div class="col-md-2">{{$bombeamento['rotacao']}}</div>
                <div class="col-md-2"><b>@lang('fichaTecnica.numRotores')</b>:</div>
                <div class="col-md-2">{{$bombeamento['numero_rotores']}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"><b>@lang('fichaTecnica.diametroRotor')</b>@lang('unidadesAcoes.(mm)'):</div>
                <div class="col-md-2">{{ number_format( $bombeamento['diametro_rotor'] ,2,",",".")}} </div>
                <div class="col-md-2"><b>@lang('fichaTecnica.shutOff')</b>@lang('unidadesAcoes.(mca)'):</div>
                <div class="col-md-2">{{ number_format( $bombeamento['shutoff'] ,2,",",".")}} </div>
                <div class="col-md-2" style="font-size: 15px;"><b>@lang('fichaTecnica.pressaoBomba')</b>@lang('unidadesAcoes.(mca)')</div>
                <div class="col-md-2">{{$bombeamento['pressao_bomba']}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"><b>@lang('fichaTecnica.motor')</b>:</div>
                <div class="col-md-2">{{$bombeamento['tipo_motor']}}</div>
                <div class="col-md-2"><b>@lang('fichaTecnica.modelo')</b>:</div>
                <div class="col-md-2">{{$bombeamento['modelo_motor']}}</div>
                <div class="col-md-2"><b>@lang('fichaTecnica.potencia')</b>@lang('unidadesAcoes.(cv)'):</div>
                <div class="col-md-2">{{$bombeamento['potencia']}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"><b>@lang('fichaTecnica.numMotores')</b>:</div>
                <div class="col-md-2">{{$bombeamento['numero_motores']}}</div>
                <div class="col-md-2"><b>@lang('fichaTecnica.chavePartida')</b>:</div>
        
                <div class="col-md-2">
                    @switch($bombeamento['chave_partida'])
                        @case(1)
                            @lang('afericao.serieParalela')
                            @break
                        @case(2)
                            @lang('afericao.estrelaTriangulo')
                            @break
                        @case(3)
                            @lang('afericao.compensadora')
                            @break
                        @case(4)
                            @lang('afericao.softStarter')
                            @break
                        @default
                            -
                    @endswitch
                </div>
                <div class="col-md-2"><b>@lang('fichaTecnica.fatorServico')</b>:</div>
                <div class="col-md-2">{{$bombeamento['fator_servico']}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"><b>@lang('fichaTecnica.amperagemNominal')</b> @lang('unidadesAcoes.(A)'):</div>
                <div class="col-md-2">{{ number_format( $bombeamento['corrente_nominal'] ,2,",",".")}} </div>
                <div class="col-md-2"><b>@lang('fichaTecnica.tensaoNominal')</b> @lang('unidadesAcoes.(V)'):</div>
                <div class="col-md-2">{{ number_format( $bombeamento['tensao_nominal'] ,2,",",".")}} </div>
                <div class="col-md-2"><b>@lang('fichaTecnica.rendimento')</b>:</div>
                <div class="col-md-2">{{$bombeamento['rendimento']}}@lang('unidadesAcoes.porcentagem'):</div>
                <div class="col-md-2"><b>@lang('fichaTecnica.frequencia')</b>@lang('unidadesAcoes.(hz)'):</div>
                <div class="col-md-2">{{$bombeamento['frequencia']}}</div>
            </div>
        </div>
        <div class="do-not-break">
        
            <!--Índice de carregamento-->
            <div class="text-center cor-fundo" >
                <h4><b>@lang('fichaTecnica.indiceCarregamento')</b></h4>
            </div>
            <div class="row">
                <div class="col-md-2 text-center"><b>@lang('fichaTecnica.correnteEletrica1')@lang('unidadesAcoes.(A)')</b></div>
                <div class="col-md-2 text-center"><b>@lang('fichaTecnica.correnteEletrica2')@lang('unidadesAcoes.(A)')</b></div>
                <div class="col-md-2 text-center"><b>@lang('fichaTecnica.tensao1')@lang('unidadesAcoes.(V)')</b></div>
                <div class="col-md-2 text-center"><b>@lang('fichaTecnica.tensao2')@lang('unidadesAcoes.(V)')</b></div>
                <div class="col-md-2 text-center"><b>@lang('fichaTecnica.ic1')@lang('unidadesAcoes.(%)')</b></div>
                <div class="col-md-2 text-center"><b>@lang('fichaTecnica.ic2')@lang('unidadesAcoes.(%)')</b></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['corrente_leitura_1_fase_1'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['corrente_leitura_2_fase_1'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['tensao_leitura_1_fase_1'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['tensao_leitura_2_fase_1'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{number_format($bombeamento['indice_carregamento_1_fase_1_corrigido'], 2,",",".")}}</div>
                <div class="col-md-2 text-center">@if($bombeamento['indice_carregamento_2_fase_1_corrigido'] != 0){{number_format($bombeamento['indice_carregamento_2_fase_1_corrigido'], 2,",",".")}} @endif</div>
            </div>
            <div class="row">
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['corrente_leitura_1_fase_2'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['corrente_leitura_2_fase_2'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['tensao_leitura_1_fase_2'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['tensao_leitura_2_fase_2'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['indice_carregamento_1_fase_2_corrigido'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">@if($bombeamento['indice_carregamento_2_fase_2_corrigido'] != 0) {{number_format($bombeamento['indice_carregamento_2_fase_2_corrigido'], 2,",",".")}} @endif</div>
            </div>
            <div class="row">
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['corrente_leitura_1_fase_3'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['corrente_leitura_2_fase_3'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['tensao_leitura_1_fase_3'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['tensao_leitura_2_fase_3'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">{{ number_format( $bombeamento['indice_carregamento_1_fase_3_corrigido'] ,2,",",".")}} </div>
                <div class="col-md-2 text-center">@if($bombeamento['indice_carregamento_2_fase_3_corrigido'] != 0) {{number_format($bombeamento['indice_carregamento_2_fase_3_corrigido'], 2,",",".")}} @endif</div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2 text-center"><b>{{ number_format(($bombeamento['corrente_leitura_1_fase_1'] + $bombeamento['corrente_leitura_1_fase_2'] + $bombeamento['corrente_leitura_1_fase_3'])/3, 2,",",".")}}</b></div>
                <div class="col-md-2 text-center"><b>{{ number_format(($bombeamento['corrente_leitura_2_fase_1'] + $bombeamento['corrente_leitura_2_fase_2'] + $bombeamento['corrente_leitura_2_fase_3'])/3, 2,",",".")}}</b></div>
                
                <div class="col-md-2 text-center"><b>{{ number_format(($bombeamento['tensao_leitura_1_fase_1'] + $bombeamento['tensao_leitura_1_fase_2'] + $bombeamento['tensao_leitura_1_fase_3'])/3, 2,",",".")}}</b></div>
                <div class="col-md-2 text-center"><b>{{ number_format(($bombeamento['tensao_leitura_2_fase_1'] + $bombeamento['tensao_leitura_2_fase_2'] + $bombeamento['tensao_leitura_2_fase_3'])/3, 2,",",".")}}</b></div>

                <div class="col-md-2 text-center">-</div>
                <div class="col-md-2 text-center">-</div>
            </div>
</div>
@endforeach
<!------------------------------------------------------------------------------------------------>
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
            <textarea name="txt_observacoes" class="form-control" onchange="checkIfTextAreaIsEmpty()" id="textoObservacoes" rows="3" cols="100"> {{$texto_observacoes}}</textarea>
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
        <textarea name="txt_uniformidade" class="form-control" onchange="checkIfTextAreaIsEmpty()" id="textoUniformidade" cols="" rows="5">{{$texto_uniformidade}}</textarea>
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
        <textarea name="txt_teste_velocidade" class="form-control" id="textoVelocidade" style="text-align: justify;" onchange="checkIfTextAreaIsEmpty()" cols="30" rows="5">{{$texto_velocidade_100}}</textarea>
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
        <textarea name="txt_conclusao" id="textoConclusao" onchange="checkIfTextAreaIsEmpty()" class="form-control" cols="30" rows="5">{{$texto_conclusao}}</textarea>
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