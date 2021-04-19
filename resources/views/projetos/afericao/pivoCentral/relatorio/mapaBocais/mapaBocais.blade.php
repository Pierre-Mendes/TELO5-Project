<!DOCTYPE html>

<style>
    .cor-fundo{
        background-color:#005F8D;
        color:white;
    }
</style>

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.1.2/css/highcharts.css" integrity="sha256-4bpG/e3EbIONg49CHrSw5c4jzs+8fb4eQbTJTibHWdw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"/>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.1.2/css/highcharts.css" integrity="sha256-4bpG/e3EbIONg49CHrSw5c4jzs+8fb4eQbTJTibHWdw=" crossorigin="anonymous" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <title>@lang('redimensionamento.ftRedimensionamento')</title>
    <link rel="stylesheet" href="{{asset('css/print.css')}}"/>
    <style>
        hr{
            background-color:black;
            margin-top: 0.25rem;
            margin-bottom: 0.25rem;
        }
        .table td, .table th {
            padding: 0rem;
        }
        textarea{
            text-align: justify;
        }

    </style>
</head>
<body>
    <!-- <page size="A4"></page> -->
    
    <div class="container">
        <div class="do-not-break col-12" style="height: 2%; background-color: #005f8d; padding: 10px">
            <div class="row">
                <div class="col-2" >
                    <img src="{{asset('img/logos/logo.png')}}" style="height: 50px" class="img-responsive mx-auto d-block" alt="">
                </div>
                <div class="col-4"></div>
                <div class="col-6 row text-light text-right">
                    <div class="col-12">
                        <b>Consultor: Joao</b>
                    </div>
                    <div class="col-12">
                        <b><i class="fa fa-fw fa-envelope"></i> teste@teste.com | <i class="fa fa-fw fa-phone"></i> 123456</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="do-not-break">
            <div class="text-center cor-fundo" >
                <h2><b>MAPA DE BOCAIS</b></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 ">
                <b>Propriedade</b>
            </div>
            <div class="col-md-2 text-center">
                Teste
            </div>
            <div class="col-md-2 ">
                <b>Consultor</b>
            </div>
            <div class="col-md-2 text-center">
                Joao
            </div>
            <div class="col-md-2 ">
                <b>Proprietário</b>
            </div>
            <div class="col-md-2 text-center">
                Joao
            </div>
        </div>
        <div class='row'>
            <div class="col-md-2">
                <b>Defletor</b>
            </div>
            <div class="col-md-2 text-center">
                Preto
            </div>
            <div class="col-md-2">
                <b>Marca/Modelo Emissores</b>
            </div>
            <div class="col-md-2 text-center">
                I-WOB UP3
            </div>
            <div class="col-md-2">
                <b>Pivô Central</b>
            </div>
            <div class="col-md-2 text-center">
                Teste
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Modelo</b>
            </div>
            <div class="col-md-2 text-center">
                Valmont-8000
            </div>
            <div class="col-md-2">
                <b>Válvula Reguladoras</b>
            </div>
            <div class="col-md-2 text-center">
                10 PSI
            </div>
        </div>

        <div class="do-not-break">
            <div class="text-center cor-fundo" >
                <h4><b>MAPA DE BOCAL ORIGINAL</b></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1">
                <div class="col-sm-1">
                    <b>N°</b>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-1">
                        1
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        2
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        3
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        4
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        5
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        6
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        7
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        8
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        9
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        10
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        11
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        12
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        13
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        14
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        15
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        16
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        17
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        18
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        19
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        20
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        21
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        22
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        23
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        24
                    </div>
                </div>
                
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 1</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 2</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 3</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <b>N° Tubos</b>
            </div>
            <div class="col-md-2">
                8
            </div>
            <div class="text-center col-md-3">
                8
            </div>
            <div class="text-center col-md-5">
                8
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>N° Sprays</b>
            </div>
            <div class="col-md-2">
                18
            </div>
            <div class="text-center col-md-3">
                18
            </div>
            <div class="text-center col-md-5">
                18
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Diâmetro</b>
            </div>
            <div class="col-md-2">
                5"
            </div>
            <div class="text-center col-md-3">
                5"
            </div>
            <div class="text-center col-md-5">
                5"
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Comprimento</b>
            </div>
            <div class="col-md-2">
                40.6
            </div>
            <div class="text-center col-md-3">
                40.6
            </div>
            <div class="text-center col-md-5">
                40.6
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-1">
                <div class="col-sm-1">
                    <b>N°</b>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-1">
                        1
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        2
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        3
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        4
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        5
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        6
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        7
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        8
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        9
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        10
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        11
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        12
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        13
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        14
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        15
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        16
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        17
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        18
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        19
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        20
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        21
                    </div>
                </div>             
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 4</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 5</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 6</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <b>N° Tubos</b>
            </div>
            <div class="col-md-2">
                8
            </div>
            <div class="text-center col-md-3">
                8
            </div>
            <div class="text-center col-md-5">
                8
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>N° Sprays</b>
            </div>
            <div class="col-md-2">
                18
            </div>
            <div class="text-center col-md-3">
                18
            </div>
            <div class="text-center col-md-5">
                18
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Diâmetro</b>
            </div>
            <div class="col-md-2">
                5"
            </div>
            <div class="text-center col-md-3">
                5"
            </div>
            <div class="text-center col-md-5">
                5"
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Comprimento</b>
            </div>
            <div class="col-md-2">
                40.6
            </div>
            <div class="text-center col-md-3">
                40.6
            </div>
            <div class="text-center col-md-5">
                40.6
            </div>
        </div>

        <hr>

                <div class="row">
            <div class="col-sm-1">
                <div class="col-sm-1">
                    <b>N°</b>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-1">
                        1
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        2
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        3
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        4
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        5
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        6
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        7
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        8
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        9
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        10
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        11
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        12
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        13
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        14
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        15
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        16
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        17
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        18
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        19
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        20
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        21
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 7</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 8</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 9</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <b>N° Tubos</b>
            </div>
            <div class="col-md-2">
                8
            </div>
            <div class="text-center col-md-3">
                8
            </div>
            <div class="text-center col-md-5">
                8
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>N° Sprays</b>
            </div>
            <div class="col-md-2">
                18
            </div>
            <div class="text-center col-md-3">
                18
            </div>
            <div class="text-center col-md-5">
                18
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Diâmetro</b>
            </div>
            <div class="col-md-2">
                5"
            </div>
            <div class="text-center col-md-3">
                5"
            </div>
            <div class="text-center col-md-5">
                5"
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Comprimento</b>
            </div>
            <div class="col-md-2">
                40.6
            </div>
            <div class="text-center col-md-3">
                40.6
            </div>
            <div class="text-center col-md-5">
                40.6
            </div>
        </div>

        <hr>
        
        <div class="do-not-break">
            <div class="text-center cor-fundo" >
                <h4><b>NOVO MAPA DE BOCAL</b></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1">
                <div class="col-sm-1">
                    <b>N°</b>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-1">
                        1
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        2
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        3
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        4
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        5
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        6
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        7
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        8
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        9
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        10
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        11
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        12
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        13
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        14
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        15
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        16
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        17
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        18
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        19
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        20
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        21
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        22
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        23
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        24
                    </div>
                </div>
                
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 1</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 2</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 3</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <b>N° Tubos</b>
            </div>
            <div class="col-md-2">
                8
            </div>
            <div class="text-center col-md-3">
                8
            </div>
            <div class="text-center col-md-5">
                8
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>N° Sprays</b>
            </div>
            <div class="col-md-2">
                18
            </div>
            <div class="text-center col-md-3">
                18
            </div>
            <div class="text-center col-md-5">
                18
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Diâmetro</b>
            </div>
            <div class="col-md-2">
                5"
            </div>
            <div class="text-center col-md-3">
                5"
            </div>
            <div class="text-center col-md-5">
                5"
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Comprimento</b>
            </div>
            <div class="col-md-2">
                40.6
            </div>
            <div class="text-center col-md-3">
                40.6
            </div>
            <div class="text-center col-md-5">
                40.6
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-1">
                <div class="col-sm-1">
                    <b>N°</b>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-1">
                        1
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        2
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        3
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        4
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        5
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        6
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        7
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        8
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        9
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        10
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        11
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        12
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        13
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        14
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        15
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        16
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        17
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        18
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        19
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        20
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        21
                    </div>
                </div>             
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 4</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 5</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 6</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <b>N° Tubos</b>
            </div>
            <div class="col-md-2">
                8
            </div>
            <div class="text-center col-md-3">
                8
            </div>
            <div class="text-center col-md-5">
                8
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>N° Sprays</b>
            </div>
            <div class="col-md-2">
                18
            </div>
            <div class="text-center col-md-3">
                18
            </div>
            <div class="text-center col-md-5">
                18
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Diâmetro</b>
            </div>
            <div class="col-md-2">
                5"
            </div>
            <div class="text-center col-md-3">
                5"
            </div>
            <div class="text-center col-md-5">
                5"
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Comprimento</b>
            </div>
            <div class="col-md-2">
                40.6
            </div>
            <div class="text-center col-md-3">
                40.6
            </div>
            <div class="text-center col-md-5">
                40.6
            </div>
        </div>

        <hr>

                <div class="row">
            <div class="col-sm-1">
                <div class="col-sm-1">
                    <b>N°</b>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-1">
                        1
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        2
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        3
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        4
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        5
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        6
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        7
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        8
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        9
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        10
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        11
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        12
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        13
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        14
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        15
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        16
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        17
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        18
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        19
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        20
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-1">
                        21
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 7</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 8</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="col-md-5">
                    <div class="text-center"><b>Lance 9</b></div>
                    <div class="row">
                        <div class="col-md-6">
                            Bocais
                        </div>
                        <div class="col-md-3">
                            Esp.
                        </div>
                        <div class="col-md-2">
                            Val.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            0
                        </div>
                        <div class="col-md-3">
                            1,48
                        </div>
                        <div class="col-md-2">
                            10
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <b>N° Tubos</b>
            </div>
            <div class="col-md-2">
                8
            </div>
            <div class="text-center col-md-3">
                8
            </div>
            <div class="text-center col-md-5">
                8
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>N° Sprays</b>
            </div>
            <div class="col-md-2">
                18
            </div>
            <div class="text-center col-md-3">
                18
            </div>
            <div class="text-center col-md-5">
                18
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Diâmetro</b>
            </div>
            <div class="col-md-2">
                5"
            </div>
            <div class="text-center col-md-3">
                5"
            </div>
            <div class="text-center col-md-5">
                5"
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <b>Comprimento</b>
            </div>
            <div class="col-md-2">
                40.6
            </div>
            <div class="text-center col-md-3">
                40.6
            </div>
            <div class="text-center col-md-5">
                40.6
            </div>
        </div>

        <hr>
        
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
</html>
