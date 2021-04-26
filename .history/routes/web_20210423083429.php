<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 just test
*/

/*
---------------------------------------------------------------------------
                    EXEMPLOS DE ROTAS
---------------------------------------------------------------------------
|
|   Route::get('teste', ['as'=>'teste', 'uses'=>'TesteController@teste']);
|   Route::get('/', function () {     return view('app'); });
*/


Auth::routes(['verify' => true]);

/*
 * Rotas Públicas da aplicação
 */

//Rotas de Login
Route::post('/login/entrar', ['as' => 'login.entrar', 'uses' => 'Auth\AutenticacaoController@entrar']);
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AutenticacaoController@login']);

//Rota de alteração de idioma
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('alterarIdioma');




/**
 * Rotas para apenas usuários cadastrados
 */
Route::group(['middleware' => 'auth'], function () {
    //Logout
    Route::get('/sair', ['as' => 'sair', 'uses' => 'Auth\AutenticacaoController@sair']);
});
Route::group(['middleware' => 'auth', 'middleware' => 'verified'], function () {

    /*
     *  ROTAS PÚBLICAS DE USUÁRIOS LOGADOS
     */


    /*
     *  Rotas de usuários administradores
     *  Podem ser acessadas apenas por usuários administradores
     */
    Route::group(['middleware' => 'administrador'], function () {
        //Teste
        Route::get('/fazendas/teste', ['as' => 'fazenda.teste', 'uses' => 'Sistema\FazendaController@teste']);

//*****************************************************************************************************************************************//
        /*
        * PÁGINA DOS BOCAIS - NOZZLE PAGES
        ================================================
        * *this page has the following functions*
        * - Registration
        * - Editing
        * - Deletion
        * - Management
        */
        Route::get('/fabricantes', ['as'=>'fabricantes.gerenciar', 'uses'=>'Sistema\BocalController@getListaDeFabricantes']);
        Route::get('/fabricantes/cadastrar', ['as' => 'fabricantes.cadastrar', 'uses' => 'Sistema\BocalController@cadastraFabricantte']);
        Route::get('/fabricantes/salva', ['as' => 'fabricantes.salva', 'uses' => 'Sistema\BocalController@cadastraFabricantte']);
        Route::get('/fabricantes/editar/{id}', ['as' => 'fabricantes.editar', 'uses' => 'Sistema\BocalController@editaFabricante']);
        Route::delete('/fabricantes/remover/{id}', ['as' =>  'fabricantes.remover', 'uses' => 'Sistema\BocalController@destroy']);
        //Route::get('/fabricantes/edita', ['as' => 'fabricantes.edita', 'uses' => 'Sistema\BocalController@editaFabricante']);
        //Route::post('/fabricantes', ['as' => 'fabricantes.salvar', 'uses' => 'Sistema\BocalController@salvarFabricante']);

        Route::get('/bocais', ['as'=>'bocais.gerenciar', 'uses'=>'Sistema\BocalController@getListaDeBocais']);
        Route::get('/bocais/cadastrar', ['as' => 'bocais.cadastrar', 'uses' => 'Sistema\BocalController@cadastrarBocal']);
        Route::post('/bocais/cadastra', ['as' => 'bocais.cadastra', 'uses' => 'Sistema\BocalController@cadastraBocal']);
        Route::get('/bocais/editar/{id}', ['as' => 'bocais.editar', 'uses' => 'Sistema\BocalController@getListaDeBocais']);
        Route::put('/bocais/edita', ['as' => 'bocais.edita', 'uses' => 'Sistema\BocalController@editaBocal']);
        Route::delete('/bocais/remove/{id}', ['as' => 'bocais.remove', 'uses' => 'Sistema\BocalController@removerBocal']);
        Route::get('/bocais/bocal/{id}', ['as'=>'bocais.bocal', 'uses'=>'Sistema\BocalController@getInfosBocal']);

        Route::get('/producer', ['as' => 'producer.list', 'uses' => 'Sistema\FabricanteController@getListProducer']);
        Route::get('/producer/update', ['as' => 'producer.register', 'uses', => 'Sistema\FabricanteController@update'])
//*****************************************************************************************************************************************//

        //Gerenciamento de pivos
        Route::get('/pivos', ['as' => 'pivos.gerenciar', 'uses' => 'Sistema\PivoController@getListaDePivos']);
        Route::get('/pivos/pivo/{id}', ['as' => 'pivos.pivo', 'uses' => 'Sistema\PivoController@getInfosPivo']);
        Route::get('/pivos/cadastrar', ['as' => 'pivos.cadastrar', 'uses' => 'Sistema\PivoController@cadastrarPivo']);
        Route::post('/pivos/salvar', ['as' => 'pivos.salvar', 'uses' => 'Sistema\PivoController@salvarPivo']);
        Route::get('/pivos/editar/{id}', ['as' => 'pivos.editar', 'uses' => 'Sistema\PivoController@editarPivo']);
        Route::post('/pivos/edita', ['as' => 'pivos.edita', 'uses' => 'Sistema\PivoController@editaPivo']);
        Route::delete('/pivos/remover/{id}', ['as' => 'pivos.remover', 'uses' => 'Sistema\PivoController@destroy']);
        Route::get('/pivos/ajaxRequest/{valor}', ['as' => 'pivos.atualiza', 'uses' => 'Sistema\PivoController@ajaxAtualizaSaidas']);
        //Route::get('/pivos/ajaxRequest', function(){if(Request::ajax()){return "teste";}});

        Route::get('/usuarios/{id_usuario}/aprovar_email_usuario', ['as' => 'aprovarUsuario', 'uses' => 'Sistema\UsuarioController@validarEmailUsuario']);
    });

    /*
     *  Rotas de usuários gerentes
     *  Podem ser acessadas apenas por usuários administradores e gerentes
     */
    Route::group(['middleware' => 'gerente'], function () {
        //Rotas de gerenciamento de usuários
        Route::get('/usuarios', ['as' => 'usuarios.listar', 'uses' => 'Sistema\UsuarioController@listarUsuarios']);
        Route::post('/usuarios/salvar', ['as' => 'usuario.salvar', 'uses' => 'Sistema\UsuarioController@salvarUsuario']);
        Route::get('/usuarios/cadastrar', ['as' => 'usuario.cadastrar', 'uses' => 'Sistema\UsuarioController@cadastrarUsuario']);
        Route::get('/usuarios/editar/{id}', ['as' => 'usuario.editar', 'uses' => 'Sistema\UsuarioController@editarUsuarios']);
        Route::post('/usuarios/edita', ['as' => 'usuario.edita', 'uses' => 'Sistema\UsuarioController@editaUsuarios']);
        // Route::delete('/usuarios/remove/{id}', ['as' => 'usuario.remover', 'uses' => 'Sistema\UsuarioController@removerUsuario']);
        Route::delete('/usuarios/remover/{id}', ['as' => 'usuario.remover', 'uses' => 'Sistema\UsuarioController@destroy']);

        //Rotas de gerenciamento de centro de custos
        Route::get('/centros_de_custos', ['as' => 'centrocusto.gerenciar', 'uses' => 'Sistema\CentroCustosController@listarCentroCustos']);
        Route::post('/centros_de_custos/salvar', ['as' => 'centrocusto.salvar', 'uses' => 'Sistema\CentroCustosController@salvarCentroCustos']);
        Route::get('/centros_de_custos/cadastrar', ['as' => 'centrocusto.cadastrar', 'uses' => 'Sistema\CentroCustosController@cadastrarCentroCustos']);
        Route::get('/centros_de_custos/editar/{id}', ['as' => 'centrocusto.editar', 'uses' => 'Sistema\CentroCustosController@editarCentroCustos']);
        Route::post('/centros_de_custos/edita', ['as' => 'centrocusto.edita', 'uses' => 'Sistema\CentroCustosController@editaCentroCustos']);
        Route::delete('/centros_de_custos/remover/{id}', ['as' => 'centrocusto.remover', 'uses' => 'Sistema\CentroCustosController@removerCentroCustos']);
        Route::delete('/centros_de_custos/remover/{id}', ['as' => 'centrocusto.remover', 'uses' => 'Sistema\CentroCustosController@destroy']);
    });

    /*
     *  Rotas de usuários supervisores
     *  Podem ser acessadas apenas por usuários administradores, gerentes e supervisores
     */
    Route::group(['middleware' => 'supervisor'], function () {
    });

    /*
     *  Rotas de usuários consultores
     *  Podem ser acessadas apenas por usuários administradores, gerentes, supervisores e consultores
     */
    Route::group(['middleware' => 'consultor'], function () {
        //Rotas de gerenciamento de fazendas
        Route::get('/fazendas', ['as' => 'fazendas.gerenciar', 'uses' => 'Sistema\FazendaController@listarFazendas']);
        Route::get('/fazendas/listfazendas', ['as' => 'fazendas.listfazendas', 'uses' => 'Sistema\FazendaController@listFazendas']);
        Route::post('/fazendas/setfazenda', ['as' => 'fazendas.setfazenda', 'uses' => 'Sistema\FazendaController@setFazenda']);
        Route::post('/fazendas/salvar', ['as' => 'fazenda.salvar', 'uses' => 'Sistema\FazendaController@salvarFazenda']);
        Route::get('/fazendas/cadastrar', ['as' => 'fazenda.cadastrar', 'uses' => 'Sistema\FazendaController@cadastrarFazenda']);
        Route::get('/fazendas/editar/{id}', ['as' => 'fazenda.editar', 'uses' => 'Sistema\FazendaController@editarFazenda']);
        Route::POST('/fazendas/edita', ['as' => 'fazenda.edita', 'uses' => 'Sistema\FazendaController@editaFazenda']);
        Route::delete('/fazendas/remove/{id}', ['as' => 'fazenda.remover', 'uses' => 'Sistema\FazendaController@removerFazenda']);
        Route::get('/fazendas/fazenda', ['as' => 'fazenda.fazenda', 'uses' => 'Sistema\FazendaController@selecionarFazenda']);

        //Rotas de fazenda
        Route::get('/fazenda/assistentes_usuario', ['as' => 'fazenda.assistentes_usuario', 'uses' => 'Sistema\FazendaController@getAssistentesDoUsuario']);
        Route::post('/fazenda/assistentes/adicionar', ['as' => 'fazenda.adicionar_assistente', 'uses' => 'Sistema\FazendaController@adicionarAssistente']);
        Route::delete('/fazenda/assistentes/remover/{id}', ['as' => 'fazenda.remover_assistente', 'uses' => 'Sistema\FazendaController@removerAssistente']);

        //Rotas de gerenciamento de proprietários
        Route::get('/proprietarios', ['as' => 'proprietarios.gerenciar', 'uses' => 'Sistema\ProprietarioController@listarProprietarios']);
        Route::get('/proprietarios/cadastrar', ['as' => 'proprietario.cadastrar', 'uses' => 'Sistema\ProprietarioController@cadastrarProprietario']);
        Route::post('/proprietarios/salvar', ['as' => 'proprietario.salvar', 'uses' => 'Sistema\ProprietarioController@salvarProprietario']);
        Route::get('/proprietarios/editar/{id}', ['as' => 'proprietario.editar', 'uses' => 'Sistema\ProprietarioController@editarProprietario']);
        Route::post('/proprietarios/edita', ['as' => 'proprietario.edita', 'uses' => 'Sistema\ProprietarioController@editaProprietario']);
        Route::delete('/proprietarios/remove/{id}', ['as' => 'proprietario.remover', 'uses' => 'Sistema\ProprietarioController@removerProprietario']);
        Route::delete('/proprietarios/remover/{id}', ['as' => 'proprietario.remover', 'uses' => 'Sistema\ProprietarioController@destroy']);
    });


    /*
     *  Rotas de usuários assistentes
     *  Podem ser acessadas apenas por usuários administradores, gerentes, supervisores, consultores e assistentes
     */
    Route::group(['middleware' => 'assistente'], function () {

        //Rotas da fazenda
        Route::get('/fazendas/selecionar', ['as' => 'fazenda.selecionar', 'uses' => 'Sistema\FazendaController@getFazendasParaSelecionar']);
        Route::put('/fazendas/alterar', ['as' => 'fazenda.alterar', 'uses' => 'Sistema\FazendaController@alterarFazendaSessao']);
        //Route::get('/fazenda', ['as'=>'fazenda.detalhe', 'uses'=>'Sistema\FazendaController@detalheFazenda']);

        //Rotas da Dashboard
        Route::get('/', ['as' => 'dashboard', 'uses' => 'Projetos\DashboardController@index']);

        Route::put('afericao/pivo_central/afericao_pendente/ir', ['as' => 'ir_para_afericao_dashboard', 'uses' => 'Projetos\DashboardController@irParaAfericao']);

        //Rota do mapa original
        Route::get("/afericao/pivo_central/mapa_original/calcular/{id}", ['as' => 'calcular_mapa_original', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@criarMapaOriginal']);
        Route::get("/afericao/pivo_central/mapa_original/{id}", ['as' => 'visualizar_mapa_original', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@getMapaOriginal']);
        Route::put("/afericao/pivo_central/mapa_original/editar", ['as' => 'mapa_original_editar', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@editareMapaOriginal']);

        //Rotas de aferição pivo central
        Route::get("/afericao/pivo_central", ['as' => 'afericoes.pivo.central', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@listarAfericoes']);
        Route::get('/afericao/pivo_central/cadastrar', ['as' => 'afericoes.pivo.central.cadastrar', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@carregarTelaCadastroInformacoesAfericao']);
        Route::post('/afericao/pivo_central/salvar', ['as' => 'afericoes.pivo.central.salvar', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@salvarInformacoesGeraisAfericao']);
        Route::get("/afericao/pivo_central/editar/{id}", ['as' => 'afericoes.pivo.central.editar', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@carregarTelaEditarAfericao']);
        Route::put('/afericao/pivo_central/editar/', ['as' => 'afericao.pivo_central.edita', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@editaAfericao']);
        Route::delete('/afericao/pivo_central/remover/{id}', ['as' => 'afericoes.pivo.central.remover', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@destroy']);
        Route::get("/afericao/pivo_central/continuar_afericao/{id}", ['as' => 'afericoes.pivo.central.continuar', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@continuarMapaBocais']);
        Route::delete('/afericao/pivo_central/remove/{id}', ['as' => 'afericao.remove', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@arquivarAfericao']);
        Route::post("/afericao/pivo_central/submit", ['as' => 'submit_levantamento_centro_pt_1', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@salvarInformacoesGeraisAfericao']);

        /*Rotas de cadastro do mapa de bocais */
        Route::get("/afericao/pivo_central/mapa_bocais/criar_mapa_bocais/{id_afericao}", ['as' => 'adicionar_afericao_sessao', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@carregarDadosAfericaoSessao']);
        Route::get("/afericao/pivo_central/mapa_bocais/lance/voltar", ['as' => 'voltar_lance', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@voltarLanceAnterior']);
        Route::get("/afericao/pivo_central/mapa_bocais/lance/cadastrar", ['as' => 'cadastrar_levantamento_centro_pt_2', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@carregarTelaRegistroLance']);
        Route::post("/afericao/pivo_central/mapa_bocais/lance/submit", ['as' => 'submit_levantamento_centro_pt_2', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@registrarLance']);
        Route::get("/afericao/pivo_central/mapa_bocais/emissores/cadastrar", ['as' => 'cadastrar_levantamento_centro_pt_3', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@carregarTelaCadastroEmissores']);
        Route::post("/afericao/pivo_central/mapa_bocais/emissores/submit", ['as' => 'submit_levantamento_centro_pt_3', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@salvarLanceNoDB']);
        Route::get('/afericao/pivo_central/mapa_bocais/gerenciar_emissores/{id}', ['as' => 'afericao.pivo_central.emissores.gerencia', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@carregaEmissores']);
        Route::put("/afericao/pivo_central/mapa_bocais/editar_emissor", ['as' => 'emissores_editar', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@editaEmissores']);
        Route::post("/afericao/pivo_central/mapa_bocais/editar_todos_emissores", ['as' => 'emissores_editar_todos', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@editaTodosEmissores']);

        //Rotas de adutora
        Route::get("/afericao/pivo_central/adutora/cadastrar/{id_afericao}", ['as' => 'cadastrarMotorBomba', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@carregarTelaCadastroAdutora']);
        Route::post("/afericao/pivo_central/adutora/cadastra", ['as' => 'cadastraMotorBomba', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@cadastraMotorBomba']);
        Route::get("/afericao/pivo_central/adutora/calcular/{id_adutora}", ['as' => 'calcularAdutora', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@calcularAdutora']);
        Route::get("/afericao/pivo_central/adutora/editar/{id_afericao}", ['as' => 'editarMotorBomba', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@carregarTelaEditarAdutora']);
        Route::post("/afericao/pivo_central/adutora/edita", ['as' => 'editaMotorBomba', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@editaMotorBomba']);

        //Rotas de Bombeamento
        Route::get("/afericao/pivo_central/bombeamento/cadastrar/{id_afericao}", ['as' => 'cadastrarBombeamento', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@carregarTelaCadastroBombeamentos']);
        Route::get("/afericao/pivo_central/bombeamento/cadastrar/continuar/{id_adutora}", ['as' => 'continuarBombeamentos', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@continuarCadastroBombeamentos']);
        //Route::get("/afericao/pivo_central/bombeamento/acoes/cadastrar/{id_afericao}", ['as' => 'cadastrarBombeamentoAcoes', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@carregarTelaCadastroBombeamentosAcoes']);
        Route::post("/afericao/pivo_central/bombeamento/cadastra", ['as' => 'cadastraBombeamento', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@cadastraBombeamento']);
        Route::post("/afericao/pivo_central/bombeamento/edita", ['as' => 'editaBombeamento', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@editaBombeamento']);
        Route::get("/afericao/pivo_central/bombeamento/editar/{id}", ['as' => 'editarBombeamento', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@editarBombeamento']);

        //Rota de dashboard da afericao
        Route::get("/afericao/pivo_central/acoes/{id}", ['as' => 'status_afericao', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@statusAfericao']);

        //Rotas Velocidades
        Route::get("/afericao/pivo_central/velocidade/cadastrar/{id_afericao}", ['as' => 'velocidade_cadastrar', 'uses' => 'Projetos\Afericao\PivoCentral\VelocidadeController@carregarTelaCadastroVelocidadeAfe']);
        Route::post("/afericao/pivo_central/velocidade/cadastra/{id}", ['as' => 'velocidade_cadastra', 'uses' => 'Projetos\Afericao\PivoCentral\VelocidadeController@cadastraVelocidadeAfe']);
        Route::get("/afericao/pivo_central/velocidade/editar/{id_afericao}", ['as' => 'velocidade_editar', 'uses' => 'Projetos\Afericao\PivoCentral\VelocidadeController@carregarTelaEditarVelocidadeAfe']);
        Route::post("/afericao/pivo_central/velocidade/edita/{id}", ['as' => 'velocidade_edita', 'uses' => 'Projetos\Afericao\PivoCentral\VelocidadeController@editaVelocidadeAfe']);
        Route::get("/afericao/pivo_central/velocidade/relatorio/{id}", ['as' => 'velocidade_relatorio', 'uses' => 'Projetos\Afericao\PivoCentral\RelatorioVelocidadeController@getRelatorioVelocidade']);

        //Rota de impressões
        Route::get("/afericao/pivo_central/impressoes/{id}", ['as' => 'gerenciar_impressao', 'uses' => 'Projetos\Afericao\PivoCentral\ImpressoesController@geranciaImpressoes']);
        Route::get("/afericao/pivo_central/impressoes_mapa_bocais/{id}", ['as' => 'gerenciar_impressao_mapa_bocal', 'uses' => 'Projetos\Afericao\PivoCentral\ImpressoesController@geranciaImpressaoMapaBocal']);
        Route::get("/afericao/pivo_central/impressoes_funcionamento_pivo/{id}", ['as' => 'gerenciar_impressao_fncionamento_pivo', 'uses' => 'Projetos\Afericao\PivoCentral\ImpressoesController@geranciaImpressaoFuncionamentoPivo']);

        //Rota ficha técnica
        Route::get("/afericao/pivo_central/ficha_tecnica/{id}", ['as' => 'gerenciar_ficha_tecnica', 'uses' => 'Projetos\Afericao\PivoCentral\FichaTecnicaController@geraFichaTecnica']);

        Route::get('/redimensionamento/pivo_central/gerenciar', ['as' => 'gerenciarRedimensionamentos', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@index']);
        Route::get('/redimensionamento/pivo_central/acoes/{id_redimensionamento}', ['as' => 'status_redimensionamento', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@statusAfericao']);
        Route::post('/redimensionamento/pivo_central/criar_redimensionamento', ['as' => 'criarRedimensionamento', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@criarRedimensionamento']);
        Route::get('/redimensionamento/pivo_central/configurar_redimensionamento/{id_redimensionamento}', ['as' => 'configurarRedimensionamento', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@carregarViewConfigurarRedimensionamento']);
        Route::put('/redimensionamento/pivo_central/atualizar_redimensionamento', ['as' => 'atualizaRedimensionamento', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@atualizarInformacoesRedimensionamento']);

        //Estas duas rotas fazem a mesma coisa, a única diferença é a url que vai aparecer para o usuário
        Route::get('/redimensionamento/pivo_central/{id_redimensionamento}/configurar_pivo', ['as' => 'configurarPivoRedimensionamento', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@carregarTelaConfigurarPivo']);
        Route::get('/afericao/pivo_central/{id_afericao}/configurar_pivo', ['as' => 'configurarPivoAfericao', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@carregarTelaConfigurarPivo']);

        Route::post('/redimensionamento/pivo_central/configurar_pivo/adicionar_lance', ['as' => 'adicionarLance', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@adicionarLance']);
        Route::delete('/redimensionamento/pivo_central/configurar_pivo/remover_lance', ['as' => 'removerLance', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@removerLance']);
        Route::put('/redimensionamento/pivo_central/configurar_pivo/informacoes_lance', ['as' => 'getInformacoesLance', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@getInformacoesLance']);
        Route::put('/redimensionamento/pivo_central/configurar_pivo/informacoes_lance/salvar', ['as' => 'salvarInformacoesLance', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@atualizarLance']);

        /**yatsgyatsgyagsya derson */
    });
});
