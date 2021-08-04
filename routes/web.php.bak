<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Auth::routes(['verify' => true]);

//////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// ROTAS DE LOGIN ///////////////////////////////////////////////////
/////////////////////////////////////// LOGIN ROUTE //////////////////////////////////////////////////////

    Route::post('/login/Signin', ['as' => 'signin', 'uses' => 'Auth\AutenticacaoController@Signin']);
    Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AutenticacaoController@login']);

    //Rota de alteração de idioma
    Route::get('locale/{locale}', function ($locale) {
        Session::put('locale', $locale);
        return redirect()->back();
    })->name('alterarIdioma');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Rotas para apenas usuários cadastrados
 */
Route::group(['middleware' => 'auth'], function () {
    //Logout
    Route::get('/sair', ['as' => 'sair', 'uses' => 'Auth\AutenticacaoController@sair']);
});


Route::group(['middleware' => 'auth', 'middleware' => 'verified'], function () {

    Route::group(['middleware' => 'administrador'], function () {

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE BOCAIS ///////////////////////////////////////////////////
        /////////////////////////////////////// NOZZLE ROUTE /////////////////////////////////////////////////////

            Route::get('/nozzles', ['as' => 'manager_nozzles', 'uses' => 'Sistema\BocalController@manageNozzles']);
            Route::get('/nozzles/create', ['as' => 'create_nozzles', 'uses' => 'Sistema\BocalController@createNozzle']);
            Route::post('/nozzles/save', ['as' => 'save_nozzle', 'uses' => 'Sistema\BocalController@saveNozzle']);
            Route::get('/nozzles/edit/{id}', ['as' => 'edit_nozzle', 'uses' => 'Sistema\BocalController@editNozzle']);
            Route::post('/nozzles/update', ['as' => 'update_nozzle', 'uses' => 'Sistema\BocalController@updateNozzle']);
            Route::delete('/nozzles/delete/{id}', ['as' => 'delete_nozzle', 'uses' => 'Sistema\BocalController@delete']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE PIVÔ ///////////////////////////////////////////////////
        /////////////////////////////////////// PIVOT ROUTE /////////////////////////////////////////////////////

            Route::get('/pivots', ['as' => 'manager_pivot', 'uses' => 'Sistema\PivoController@managerPivot']);
            Route::get('/pivots/create', ['as' => 'create_pivot', 'uses' => 'Sistema\PivoController@createPivot']);
            Route::post('/pivots/save', ['as' => 'save_pivot', 'uses' => 'Sistema\PivoController@savePivot']);
            Route::get('/pivots/edit/{id}', ['as' => 'edit_pivot', 'uses' => 'Sistema\PivoController@editPivot']);
            Route::post('/pivots/update', ['as' => 'update_pivot', 'uses' => 'Sistema\PivoController@updatePivot']);
            Route::delete('/pivots/delete/{id}', ['as' => 'delete_pivot', 'uses' => 'Sistema\PivoController@delete']);

            //////////////////////////////////////////////////////////////////////////////////////////////////////////

            Route::get('/usuarios/{id_usuario}/aprovar_email_usuario', ['as' => 'aprovarUsuario', 'uses' => 'Sistema\UsuarioController@validarEmailUsuario']);
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

    });

    /*
     *  Rotas de usuários gerentes
     *  Podem ser acessadas apenas por usuários administradores e gerentes
     */
    Route::group(['middleware' => 'gerente'], function () {

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE USUÁRIOS ////////////////////////////////////////////////
        /////////////////////////////////////// USER ROUTE ///////////////////////////////////////////////////////
            Route::get('/user', ['as' => 'usuarios_manager', 'uses' => 'Sistema\UsuarioController@managerUsuarios']);
            Route::get('/user/create', ['as' => 'usuario_create', 'uses' => 'Sistema\UsuarioController@createUsuario']);
            Route::post('/user/save', ['as' => 'usuario_save', 'uses' => 'Sistema\UsuarioController@saveUsuario']);
            Route::get('/user/edit/{id}', ['as' => 'usuario_edit', 'uses' => 'Sistema\UsuarioController@editUsuarios']);
            Route::post('/user/update', ['as' => 'usuario_update', 'uses' => 'Sistema\UsuarioController@updateUsuarios']);
            Route::delete('/user/remover/{id}', ['as' => 'usuario.remover', 'uses' => 'Sistema\UsuarioController@delete']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE CENTRO DE CUSTO /////////////////////////////////////////
        /////////////////////////////////////// COST CENTER ROUTES (SUB REGIONS) /////////////////////////////////

            Route::get('/cost_center', ['as' => 'manage_cost_center', 'uses' => 'Sistema\CentroCustosController@manageCostCenter']);
            Route::get('/cost_center/create', ['as' => 'create_cost_center', 'uses' => 'Sistema\CentroCustosController@createCostCenter']);
            Route::post('/cost_center/save', ['as' => 'save_cost_center', 'uses' => 'Sistema\CentroCustosController@saveCostCenter']);
            Route::get('/cost_center/edit/{id}', ['as' => 'edit_cost_center', 'uses' => 'Sistema\CentroCustosController@editCostCenter']);
            Route::post('/cost_center/update', ['as' => 'update_cost_center', 'uses' => 'Sistema\CentroCustosController@updateCostCenter']);
            Route::delete('/cost_center/delete/{id}', ['as' => 'delete_center_cost', 'uses' => 'Sistema\CentroCustosController@delete']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

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

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE FAZENDAS ////////////////////////////////////////////////
        /////////////////////////////////////// FARM ROUTES //////////////////////////////////////////////////////

            Route::get('/farm', ['as' => 'farms_manager', 'uses' => 'Sistema\FazendaController@manageFarms']);
            Route::get('/farm/farmSelect', ['as' => 'farms_select', 'uses' => 'Sistema\FazendaController@selectFarms']);
            Route::post('/farm/setfarm', ['as' => 'farm_setFarm', 'uses' => 'Sistema\FazendaController@setFarm']);
            Route::get('/farm/create', ['as' => 'farm_create', 'uses' => 'Sistema\FazendaController@createFarm']);
            Route::post('/farm/save', ['as' => 'farm_save', 'uses' => 'Sistema\FazendaController@saveFarm']);
            Route::get('/farm/edit/{id}', ['as' => 'farm_edit', 'uses' => 'Sistema\FazendaController@editFarm']);
            Route::POST('/farm/update', ['as' => 'farm_update', 'uses' => 'Sistema\FazendaController@updateFarm']);
            Route::delete('/farm/delete/{id}', ['as' => 'delete_Farm', 'uses' => 'Sistema\FazendaController@deleteFarm']);

            //Rotas de fazenda
            Route::get('/farm/userAssist', ['as' => 'farm_userAssist', 'uses' => 'Sistema\FazendaController@userAssist']);
            Route::post('/farm/assist/create', ['as' => 'farm_createUserAssist', 'uses' => 'Sistema\FazendaController@createAssist']);
            Route::delete('/farm/assist/delete/{id}', ['as' => 'farm_deleteAssist', 'uses' => 'Sistema\FazendaController@deleteAssist']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////// ROTAS DE PROPRIETÁRIOS ///////////////////////////////////////////
        /////////////////////////////////////// OWNER ROUTES /////////////////////////////////////////////////////
            Route::get('/owners', ['as' => 'owner_manager', 'uses' => 'Sistema\ProprietarioController@managerOwners']);
            Route::get('/owner/createOwner', ['as' => 'owner_create', 'uses' => 'Sistema\ProprietarioController@createOwner']);
            Route::post('/owner/saveOwner', ['as' => 'owner_save', 'uses' => 'Sistema\ProprietarioController@saveOwner']);
            Route::get('/owner/editOwner/{id}', ['as' => 'owner_edit', 'uses' => 'Sistema\ProprietarioController@editOwner']);
            Route::post('/owner/update', ['as' => 'owner_update', 'uses' => 'Sistema\ProprietarioController@updateOwner']);
            Route::delete('/owner/delete/{id}', ['as' => 'owner_delete', 'uses' => 'Sistema\ProprietarioController@delete']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

    });


    /*
     *  Rotas de usuários assistentes
     *  Podem ser acessadas apenas por usuários administradores, gerentes, supervisores, consultores e assistentes
     */
    Route::group(['middleware' => 'assistente'], function () {

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTA DO DASHBOARD ////////////////////////////////////////////////
        /////////////////////////////////////// DASHBOARD ROUTE //////////////////////////////////////////////////

            Route::get('/', ['as' => 'dashboard', 'uses' => 'Projetos\DashboardController@index']);
            Route::put('afericao/pivo_central/afericao_pendente/ir', ['as' => 'ir_para_afericao_dashboard', 'uses' => 'Projetos\DashboardController@irParaAfericao']);
        
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE MAPA ORIGINAL ///////////////////////////////////////////
        /////////////////////////////////////// ORIGINAL MAP ROUTE ///////////////////////////////////////////////
           
            Route::get("/gauging/central_pivot/original_map/calculate/{id}", ['as' => 'originalMap_create', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@createOriginalMap']);
            Route::get("/gauging/central_pivot/original_map/{id}", ['as' => 'originalMap_manager', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@managerOriginalMap']);
            Route::post("/gauging/central_pivot/original_map/edit", ['as' => 'originalMap_edit', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@originalMapEdit']);
            Route::get("/gauging/central_pivot/original_map/createNewSpan/{id}", ['as' => 'newSpan_create', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@createNewSpan']);
            Route::post("/gauging/central_pivot/original_map/saveNewSpan", ['as' => 'newSpan_save', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@saveNewSpan']);
            Route::get("/gauging/central_pivot/original_map/createNewIssuer", ['as' => 'cadastrarNovoEmissor', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@cadastrarNovoEmissor']);
            Route::post("/gauging/central_pivot/original_map/saveNewIssuer", ['as' => 'newIssuer_save', 'uses' => 'Projetos\Afericao\PivoCentral\MapaOriginalController@saveNewIssuer']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE PIVÔ CENTRAL ////////////////////////////////////////////
        /////////////////////////////////////// CENTRAL PIVOT ROUTE //////////////////////////////////////////////
            
            Route::get("/gauging/central_pivot", ['as' => 'gauging_manager', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@managerMeasurements']);
            Route::get('/gauging/central_pivot/create_gauging', ['as' => 'gauging_create', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@createGauging']);
            Route::post('/gauging/central_pivot/save_gauging', ['as' => 'gauging_save', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@saveGauging']);
            Route::get("/gauging/central_pivot/edit_gauging/{id}", ['as' => 'gauging_edit', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@editGauging']);
            Route::put('/gauging/central_pivot/update_gauging', ['as' => 'gauging_update', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@updateGauging']);
            Route::delete('/gauging/central_pivot/delete/{id}', ['as' => 'gauging_delete', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@delete']);
            Route::get("/gauging/central_pivot/continue_gauging/{id}", ['as' => 'gauging_continue', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@continueNozzleMap']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE LANCE E EMISSORES ///////////////////////////////////////
        /////////////////////////////////////// SPANS ROUTES AND ISSUERS////////////////////////////////////////
            
            Route::get("/gauging/central_pivot/nozzle_map/nozzle_map_create/{id_afericao}", ['as' => 'add_measurement_the_session', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@loadRegisteredMeasurement']);
            Route::get("/gauging/central_pivot/nozzle_map/span/back_span", ['as' => 'span_back', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@backSpanPrevious']);
            Route::get("/gauging/central_pivot/nozzle_map/span/create_span", ['as' => 'span_create', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@createSpan']);
            Route::post("/gauging/central_pivot/nozzle_map/span/save_span", ['as' => 'span_save', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@saveSpan']);
            Route::get("/gauging/central_pivot/nozzle_map/emitters/create_issuer", ['as' => 'issuer_create', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@createIssuer']);
            Route::post("/gauging/central_pivot/nozzle_map/emitters/save_spanAndIssuer", ['as' => 'spanAndIssuer_save', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@saveSpanAndIssuer']);
            Route::get('/gauging/central_pivot/nozzle_map/emitters_manage/{id}', ['as' => 'manage_issuer', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@manageIssuer']);
            Route::put("/gauging/central_pivot/nozzle_map/emitters_edit", ['as' => 'edit_emitters', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@editaEmissores']);
            Route::post("/gauging/central_pivot/nozzle_map/emitters_All_edit", ['as' => 'edit_all_emitters', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@editAllEmitters']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE ADUTORAS ////////////////////////////////////////////////
        /////////////////////////////////////// ADAPTER ROUTES ///////////////////////////////////////////////////
            
            Route::get("/gauging/central_pivot/adductor/create_adductor/{id_afericao}", ['as' => 'create_adductor', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@createAdductor']);
            Route::post("/gauging/central_pivot/adductor/save_adductor", ['as' => 'adductor_save', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@saveAdductor']);
            Route::get("/gauging/central_pivot/adductor/calculate/{id_adutora}", ['as' => 'adductor_calculate', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@calculateAdductor']);
            Route::get("/gauging/central_pivot/adductor/adductor_edit/{id_afericao}", ['as' => 'adductor_edit', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@editAdductor']);
            Route::post("/gauging/central_pivot/adductor/update", ['as' => 'adductor_update', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@updateAdductor']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE BOMBEAMENTOS ////////////////////////////////////////////
        /////////////////////////////////////// PUMPS ROUTES /////////////////////////////////////////////////////
            
            Route::get("/gauging/central_pivot/pumping/create_pumping/{id_afericao}", ['as' => 'pumping_create', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@createPumping']);
            Route::get("/gauging/central_pivot/pumping/create_pumping/continue_pumping_create/{id_adutora}", ['as' => 'pumping_continue_create', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@ContinuePumpingCreate']);
            Route::post("/gauging/central_pivot/pumping/save_pumping", ['as' => 'pumping_save', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@savePumping']);
            Route::get("/gauging/central_pivot/pumping/edit_pumping/{id}", ['as' => 'edit_Pumping', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@editPumping']);
            Route::post("/gauging/central_pivot/pumping/update_pumping", ['as' => 'update_pumping', 'uses' => 'Projetos\Afericao\PivoCentral\LevantamentoAdutoraController@updatePumping']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //Rota de dashboard da afericao
        Route::get("/gauging/central_pivot/actions/{id}", ['as' => 'gauging_status', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@gaugingStatus']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE VELOCIDADE DA AFERIÇÃO //////////////////////////////////
        /////////////////////////////////////// SPEED ROUTE //////////////////////////////////////////////////////
           
            Route::get("/gauging/central_pivot/speed_gauging/create_gauging/{id_afericao}", ['as' => 'gauging_speed_create', 'uses' => 'Projetos\Afericao\PivoCentral\VelocidadeController@createGaugingSpeed']);
            Route::post("/gauging/central_pivot/speed_gauging/save_gauging/{id}", ['as' => 'gauging_speed_save', 'uses' => 'Projetos\Afericao\PivoCentral\VelocidadeController@saveGaugingSpeed']);
            Route::get("/gauging/central_pivot/speed_gauging/edit_gauging/{id_afericao}", ['as' => 'gauging_speed_edit', 'uses' => 'Projetos\Afericao\PivoCentral\VelocidadeController@editGaugingSpeed']);
            Route::post("/gauging/central_pivot/speed_gauging/update_gauging/{id}", ['as' => 'gauging_speed_update', 'uses' => 'Projetos\Afericao\PivoCentral\VelocidadeController@updateGaugingSpeed']);
            Route::get("/gauging/central_pivot/speed_gauging/report_gauging/{id}", ['as' => 'gauging_speed_report', 'uses' => 'Projetos\Afericao\PivoCentral\RelatorioVelocidadeController@gaugingSpeedReport']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE IMPRESSÕES //////////////////////////////////////////////
        /////////////////////////////////////// ROUTE OF IMPRESSIONS /////////////////////////////////////////////
            
            Route::get("/gauging/central_pivot/impressions/{id}", ['as' => 'manage_impressions', 'uses' => 'Projetos\Afericao\PivoCentral\ImpressoesController@manageImpressions']);
            Route::get("/gauging/central_pivot/nozzle_map_prints/{id}", ['as' => 'nozzle_map_prints', 'uses' => 'Projetos\Afericao\PivoCentral\ImpressoesController@nozzleMapsPrint']);
            Route::get("/gauging/central_pivot/pivot_operating_impression/{id}", ['as' => 'manage_pivot_operating_impression', 'uses' => 'Projetos\Afericao\PivoCentral\ImpressoesController@managePivotOperating']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE FICHA TÉCNICA ///////////////////////////////////////////
        /////////////////////////////////////// TECHNICAL DATA ROUTE /////////////////////////////////////////////
            
            Route::get("/gauging/central_pivot/datasheet/{id}", ['as' => 'manage_datasheet', 'uses' => 'Projetos\Afericao\PivoCentral\FichaTecnicaController@Datasheet']);
            // Route::get("/gauging/central_pivot/datasheet/{id}", ['as' => 'manage_datasheetBocaisLandScape', 'uses' => 'Projetos\Afericao\PivoCentral\FichaTecnicaController@DatasheetLandScape']);
            // Route::get("/gauging/central_pivot/datasheet/{id}", ['as' => 'manage_datasheetBocaisPortrait', 'uses' => 'Projetos\Afericao\PivoCentral\FichaTecnicaController@Datasheetportrait']);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// ROTAS DE REDIMENSIONAMENTO ///////////////////////////////////////
        /////////////////////////////////////// ROTAS DE LOGIN ///////////////////////////////////////////////////

            Route::get('/resizing/central_pivot/gerenciar', ['as' => 'gerenciarRedimensionamentos', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@index']);
            // Route::get('/resizing/central_pivot/acoes/{id_redimensionamento}', ['as' => 'status_redimensionamento', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@statusAfericao']);
            Route::post('/resizing/central_pivot/criar_redimensionamento', ['as' => 'criarRedimensionamento', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@criarRedimensionamento']);
            // Route::get('/resizing/central_pivot/configurar_redimensionamento/{id_redimensionamento}', ['as' => 'configurarRedimensionamento', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@carregarViewConfigurarRedimensionamento']);
            Route::put('/resizing/central_pivot/atualizar_redimensionamento', ['as' => 'atualizaRedimensionamento', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@atualizarInformacoesRedimensionamento']);
            
            //Estas duas rotas fazem a mesma coisa, a única diferença é a url que vai aparecer para o usuário
            Route::get('/resizing/central_pivot/{id_redimensionamento}/configurar_pivo', ['as' => 'configurarPivoRedimensionamento', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@carregarTelaConfigurarPivo']);
            Route::get('/afericao/central_pivot/{id_afericao}/configurar_pivo', ['as' => 'configurarPivoAfericao', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@carregarTelaConfigurarPivo']);
            Route::post('/resizing/central_pivot/configurar_pivo/adicionar_lance', ['as' => 'adicionarLance', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@adicionarLance']);
            Route::delete('/resizing/central_pivot/configurar_pivo/remover_lance', ['as' => 'removerLance', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@removerLance']);
            Route::put('/resizing/central_pivot/configurar_pivo/informacoes_lance', ['as' => 'getInformacoesLance', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@getInformacoesLance']);
            Route::put('/resizing/central_pivot/configurar_pivo/informacoes_lance/salvar', ['as' => 'salvarInformacoesLance', 'uses' => 'Projetos\Redimensionamento\PivoCentral\ConfigurarLanceController@atualizarLance']);
            
            // NEW ROUTES
            Route::get('/resizing/central_pivot/acoes/{id_redimensionamento}', ['as' => 'resizing_status', 'uses' => 'Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@gaugingStatus']);
            Route::get('resizing/central_pivot/manager_resizing', ['as' => 'resizing_manager', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@managerRedimensionamento']);
            Route::post('resizing/central_pivot/create_resizing', ['as' => 'resizing_create', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@createRedimensionamento']);
            Route::get('/resizing/central_pivot/configure_resizing/{id_redimensionamento}', ['as' => 'redimensionamento_setup_view', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@setupViewRedimensionamento']);
            Route::delete('resizing/central_pivot/delete/{id_redimensionamento}', ['as' => 'resizing_edit_delete', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@delete']);
            Route::get('resizing/central_pivot/edit/{id_redimensionamento}', ['as' => 'resizing_edit', 'uses' => 'Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@setupViewRedimensionamento']);
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

    });
});
