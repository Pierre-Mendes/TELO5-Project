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
