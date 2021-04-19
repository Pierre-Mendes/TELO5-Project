<template>
   
<div class="card card-login mx-auto mt-5">
    <div class="card-header">Levantamento Centro Parte Aérea</div>
    <div class="card-body">
        <form action="{{route('levantamentoCentroParteAerea.inserir')}}" class='row' method="post">
            {{csrf_field()}}
            <div class='container'>
            <!--------------------------------------Informações Gerais-------------------------------------->
            <div class='col-12'>
                <h3>Informações Gerais</h3>
                <div class='row'>
                    <div class='form-group col-md-6' >Propriedade<input name='propriedade' class='form-control' required='true' id='propriedade' placeholder='Propriedade' /></div>
                    <div class='form-group col-md-6' >Proprietario<input name='proprietario' class='form-control' required='true' id='proprietario' placeholder='Proprietario' /></div>
                    <div class='form-group col-md-6' >Consultor<input name='consultor' class='form-control' required='true' id='consultor' placeholder='Consultor' /></div>
                    <div class='form-group col-md-6' >Estado<input name='estado' class='form-control' required='true' id='estado' placeholder='Estado' /></div>                                       
                </div>
                <div class='row'>
                    <div class='form-group col-md-6' >Pivo Central Fixo<input name='pivo_central_fixo' class='form-control' required='true' id='pivo_central_fixo' placeholder='Pivo Central Fixo' /></div>                   
                    <div class='form-group col-md-6' >Data<input name='data' class='form-control' required='true' type='date' id='data' /></div> 
                    <div class='form-group col-md-6' >Cidade<input name='cidade' class='form-control' required='true' id='cidade' placeholder='Cidade' /></div>
                    <div class='form-group col-md-6' >Tempo de funcionamento<input name='tempo_funcionamento' class='form-control' required='true' id='tempo_funcionamento' placeholder='Tempo de funcionamento' /></div>
                </div>
            </div>        
                
            <!--------------------------------------Parte aérea-------------------------------------->
            <div class='container'>
                <div class='col-12'>
                    <hr>
                    <h3>Parte Aérea</h3>
                    <div class='row'>
                        <div class='form-group col-md-4' >Horímetro<input name='horimetro' class='form-control' required='true' placeholder='Horímetro' /></div>
                        <div class='form-group col-md-4' >Marca/Modelo Pivô:
                            <select class='form-control' required='true' name='marca_modelo_pivo'>
                                <option value='Valmont'>Valmont</option>
                                <option value='Lindsay'>Lindsay</option>
                                <option value='Fockink'>Fockink</option>
                                <option value='Krebsfer'>Krebsfer</option>
                                <option value='Romera'>Romera</option>
                                <option value='Carborundum'>Carborundum</option>
                                <option value='Asbrasil'>Asbrasil</option>
                                <option value='Dantas'>Dantas</option>
                                <option value='Bauer'>Bauer</option>
                                <option value='Outros'>Outros</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4' >Ano montagem<input name='ano_montagem' class='form-control' required='true' placeholder='Ano montagem' /></div>
                        <div class='form-group col-md-4' >Marca/Modelo emissores:
                            <select class='form-control' required='true' name='marca_modelo_emissores'>
                                <option value='I-WOB UP3'>I-WOB UP3</option>
                                <option value='Fabrimar'>Fabrimar</option>
                                <option value='Nelson'>Nelson</option>
                                <option value='Super Spray - UP3'>Super Spray UP3</option>
                                <option value='Super Spray'>Super Spray</option>
                                <option value='I-WOB'>I-WOB</option>
                                <option value='Trash Buster'>Trash Buster</option>
                                <option value='Komet'>Komet</option>
                                <option value='Fan Spray'>Fan Spray</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4' id='rodado' >Rodado:
                            <select class='form-control' required='true' name='rodado'>
                                <option value='12.4 x 24'>12.4 x 24</option>
                                <option value='12.4 x 28'>12.4 x 28</option>
                                <option value='12.4 x 38'>12.4 x 38</option>
                                <option value='14.9 x 24'>14.9 x 24</option>
                                <option value='14.9 x 28'>14.9 x 28</option>
                                <option value='16.9 x 28'>16.9 x 28</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4' >Giro do equip.(Graus)<input name='giro_equipamento' class='form-control' required='true' placeholder='Giro do equipamento' /></div>
                    </div>
                    
                    <div class='row'>
                        <div class='form-group col-md-4' >Tipo de painel<input name='tipo_painel' class='form-control' required='true' placeholder='Tipo de painel' /></div>
                        <div class='form-group col-md-4' >Tipo de equipamento:
                            <select class='form-control' required='true' name='tipo_equipamento'>
                                <option value='Pivô Central Fixo'>Pivô Central Fixo</option>
                                <option value='Pivô Rebocável'>Pivô Rebocável</option>
                                <option value='Linear'>Linear</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4' >Lâmina anual (mm)<input name='lamina_anual' class='form-control' required='true' placeholder='Lâmina anual (mm)' /></div>
                        <div class='form-group col-md-4' >Revestimento:
                            <select class='form-control' required='true' name='revestimento'>
                                <option value='Zincagem'>Zincagem</option>
                                <option value='Politetileno'>Polietileno</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4' >Pendural:
                            <select class='form-control' required='true' name='pendural'>
                                <option>Flexível</option>
                                <option>PVC</option>
                                <option>A.Z</option>
                                <option>Sem pendural</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4' >Custo médio ($/kWh) ou ($/L)<input name='custo_medio' class='form-control' required='true' placeholder='Custo médio' /></div>
                    </div>

                    <div class='row'>
                        <div class='form-group col-md-4' >Modelo do equipamento<input name='modelo_equipamento' class='form-control' required='true' placeholder='Modelo do equipamento' /></div>
                        <div class='form-group col-md-4' >Defletor<input name='defletor' class='form-control' required='true' placeholder='Defletor' /></div>
                        <div class='form-group col-md-4' >Altura do pivô:
                            <select class='form-control' required='true' name='altura_pivo'>
                                <option value='2.74'>2,74</option>
                                <option value='3.75'>3,75</option>
                                <option value='4.6'>4,6</option>
                                <option value='5.5'>5,5</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4' >Válv. reguladoras:
                            <select class='form-control' required='true' name='valv_reguladoras'>
                                <option value='10'>10 PSI</option>
                                <option value='15'>15 PSI</option>
                                <option value='20'>20 PSI</option>
                                <option value='25'>25 PSI</option>
                                <option value='30'>30 PSI</option>
                                <option value='35'>35 PSI</option>
                                <option value='40'>40 PSI</option>
                                <option value='45'>45 PSI</option>
                                <option value='50'>50 PSI</option>
                                <option value='0'>Ausente</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4' >Altura dos emissores<input name='altura_emissores' class='form-control' required='true' placeholder='Altura dos emissores' /></div>
                        <div class='form-group col-md-4' >Possui válvula reguladora?
                            <select class='form-control' required='true' name='possui_valvula_reguladora'>
                                <option value='SIM'>SIM</option>
                                <option value='NÃO'>NÃO</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--------------------------------------Pivô Conjugado-------------------------------------->
        <div class='container'>
            <div class='col-12'>
                <hr>
                <div>
                    <h3>Pivô Conjugado<button type="button" class="btn btn-outline-primary" onclick="mostraPivoConjugado()"><i class="fa fa-bars"></i></button></h3>                    
                </div>
                <div id='pivo_conjugado' style="display: none">
                    <div class='row'>
                        <div class='form-group col-md-6' >Área Pivô 01 (ha)<input name='area_pivo_01' class='form-control' placeholder='Área' /></div>
                        <div class='form-group col-md-6' >Vazão Pivô 01 (m³/h)<input name='vazao_pivo_01' class='form-control' placeholder='Vazão' /></div>
                        <div class='form-group col-md-6' >Área Pivô 02 (ha)<input name='area_pivo_02' class='form-control' placeholder='Área' /></div>
                        <div class='form-group col-md-6' >Vazão Pivô 02 (m³/h)<input name='vazao_pivo_02' class='form-control' placeholder='Vazão' /></div>
                    </div>
                    <div class='row'>
                            <div class='form-group col-md-6' >Área Pivô 03 (ha)<input name='area_pivo_03' class='form-control' placeholder='Área' /></div>
                            <div class='form-group col-md-6' >Vazão Pivô 03 (m³/h)<input name='vazao_pivo_03' class='form-control' placeholder='Vazão' /></div>
                            <div class='form-group col-md-6' >Área Pivô 04 (ha)<input name='area_pivo_04' class='form-control' placeholder='Área' /></div>
                            <div class='form-group col-md-6' >Vazão Pivô 04 (m³/h)<input name='vazao_pivo_04' class='form-control' placeholder='Vazão' /></div>
                    </div> 
                    <label>Obs: PIVOS 01; 02; 03; 04 E O PIVO PLANILHADO COMPÕE A LAMINA CONJUGADO</label>
                </div>
            </div>
        </div>

        <!--------------------------------------Considerações-------------------------------------->
        <div class='container'>
            <div class='col-12'>
                <hr>
                <div>
                    <h3>Considerações<button type="button" class="btn btn-outline-primary" onclick="mostraConsideracoes()"><i class="fa fa-bars"></i></button></h3>                    
                </div>
                <div id='consideracoes' style="display: none">
                    <div class='row'>
                        <div class='form-group col-md-6' >Painel central com funcionamento adequado<input name='area_pivo_01' class='form-control' placeholder='Área' /></div>
                        <div class='form-group col-md-6' >Vazão Pivô 01 (m³/h)<input name='vazao_pivo_01' class='form-control' placeholder='Vazão' /></div>
                        <div class='form-group col-md-6' >Área Pivô 02 (ha)<input name='area_pivo_02' class='form-control' placeholder='Área' /></div>
                        <div class='form-group col-md-6' >Vazão Pivô 02 (m³/h)<input name='vazao_pivo_02' class='form-control' placeholder='Vazão' /></div>
                    </div>
                    <div class='row'>
                            <div class='form-group col-md-6' >Área Pivô 03 (ha)<input name='area_pivo_03' class='form-control' placeholder='Área' /></div>
                            <div class='form-group col-md-6' >Vazão Pivô 03 (m³/h)<input name='vazao_pivo_03' class='form-control' placeholder='Vazão' /></div>
                            <div class='form-group col-md-6' >Área Pivô 04 (ha)<input name='area_pivo_04' class='form-control' placeholder='Área' /></div>
                            <div class='form-group col-md-6' >Vazão Pivô 04 (m³/h)<input name='vazao_pivo_04' class='form-control' placeholder='Vazão' /></div>
                    </div> 
                    <label>Obs: PIVOS 01; 02; 03; 04 E O PIVO PLANILHADO COMPÕE A LAMINA CONJUGADO</label>
                </div>
            </div>
        </div>

        <!--------------------------------------Canhão Final-------------------------------------->
        <div class='container'>
            <div class='col-12'>
                <hr>
                <div>
                    <h3>Canhão Final<button type="button" class="btn btn-outline-primary"  onclick="mostraCanhaoFinal()"><i class="fa fa-bars"></i></button></h3>                    
                </div>
                <div id='canhao_final' style="display: none">
                    <div class='row'>
                        <div class='form-group col-md-4' >Marca<input name='marca_canhao_final' class='form-control' placeholder='Marca' /></div>
                        <div class='form-group col-md-4' >Potência (cv)<input name='potencia_canhao_final' class='form-control' placeholder='Potência' /></div>
                        <div class='form-group col-md-4' >Vazão (m3/h)<input name='vazao_canhao_final' class='form-control' placeholder='Vazão' /></div>
                    </div>
                    <div class='row'>
                        <div class='form-group col-md-4' >Modelo<input name='modelo_canhao_final' class='form-control' placeholder='Modelo' /></div>
                        <div class='form-group col-md-4' >Bomba<input name='bomba_canhao_final' class='form-control' placeholder='Bomba' /></div>
                        <div class='form-group col-md-4' >Bocais<input name='bocais_canhao_final' class='form-control' placeholder='Bocais' /></div>                        
                    </div> 

                    <div class='row'>
                        <div class='form-group col-md-4' >Alcance canhão (m)<input name='alcance_canhao_final' class='form-control' placeholder='Alcance' /></div>
                        <div class='form-group col-md-4' >Motor<input name='motor_canhao_final' class='form-control' placeholder='Motor' /></div>
                        <div class='form-group col-md-4' >Válv. Reguladoras<input name='valv_reguladora_canhao_final' class='form-control' placeholder='Válv. Reguladora' /></div>                        
                    </div> 
                </div>
            </div>
        </div>

        <!--------------------------------------Aferição Hidráulica-------------------------------------->
        <div class='container'>
            <div class='col-12'>
                <hr>
                <h3>Aferição Hidráulica<button type="button" class="btn btn-outline-primary"  onclick="mostraAfericao()"><i class="fa fa-bars"></i></button></h3>
                <div id='afericao_hidraulica' style='display:none'>
                    <div class='row'>
                        <div class='form-group col-md-4'>Descrição</div>
                        <div class='form-group col-md-4'>Medida</div>
                        <div class='form-group col-md-4'>Cálculo</div>
                    </div>
                </div>
            </div>
        </div>

        <!--------------------------------------Quantidade de lances-------------------------------------->
        <div class='container'>
            <div class='col-12'>
                <hr>
                <h4>Quantidade de lances para mapa de bocal</h4>
                <input class='form-control col-md-4' placeholder="N° de lances" required='true' />
                {{ lances }}
            </div>
        </div>

        <!--<button class="btn btn-lg btn-info btn-block col-md-2 text-light" style="margin: 0 auto" type="submit">CADASTRAR</button>-->
        <button class="btn btn-lg btn-info btn-block col-md-2 text-light" style="margin: 0 auto" type='button' v-bind:href='url' >Seguir</button>

        </form>
        <div class="text-center">
            <a class="d-block small mt-3" href="{{URL::previous()}}">VOLTAR</a>
        </div>
    </div>            
</div>

</template>

<script>
    export default {
        props:['lances', 'url']
    }

</script>