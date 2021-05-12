<!-- Sidebar -->
<div class="navbar-toggler" id="sidebar-wrapper">
  <div class="sidebar-heading text-light">
    <img src="{{asset('img/logos/logo.png')}}" alt="" class="img-fluid" style="max-width: 10rem">
  </div>

   <ul class=" list-group list-group-flush">
      <li >
          <h2 class=" list-group-item list-group-item-action list-group-sidenav text-light" > <b></b></h2>
      </li>
      <li hidden>
          <a    class=" list-group-item list-group-item-action list-group-sidenav text-light" href="#">TESTE</a>
      </li>
      <li>

            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.inspecao_eletrica')</a>

            <a class="dropdown-item dropdown-toggle list-group-item list-group-item-action list-group-sidenav text-light"  data-toggle="collapse" aria-expanded="false" href="#sidenav_afericao">@lang('sidenav.afericao')</a>
            <ul class="collapse list-group list-group-flush" id="sidenav_afericao">
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#"><i class="fa fa-fw"></i> @lang('sidenav.gotejamento')</a>
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#"><i class="fa fa-fw"></i> @lang('sidenav.aspersao')</a>
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#"><i class="fa fa-fw"></i> @lang('sidenav.linear')</a>
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light"    href="{{route('afericoes.pivo.central')}}"><i class="fa fa-fw"></i> @lang('sidenav.pivo_central')</a>
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#"><i class="fa fa-fw"></i> @lang('sidenav.pivo_rebocavel')</a>
            </ul>

            <a class="dropdown-item dropdown-toggle list-group-item list-group-item-action list-group-sidenav text-light"  data-toggle="collapse" aria-expanded="false" href="#sidenav_redimensionamento">@lang('sidenav.redimensionamento')</a>
            <ul class="collapse list-group list-group-flush" id="sidenav_redimensionamento">
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#"><i class="fa fa-fw"></i> @lang('sidenav.gotejamento')</a>
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#"><i class="fa fa-fw"></i> @lang('sidenav.aspersao')</a>
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#"><i class="fa fa-fw"></i> @lang('sidenav.linear')</a>
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light"  href="{{route('gerenciarRedimensionamentos')}}"><i class="fa fa-fw"></i> @lang('sidenav.pivo_central')</a>
              <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#"><i class="fa fa-fw"></i> @lang('sidenav.pivo_rebocavel')</a>
            </ul>

            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.redimensionamento')</a>
            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.projeto_irrigacao')</a>
            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.projeto_bombeamento')</a>
            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.barragem')</a>
            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.viabilidade')</a>
            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.analise_solo')</a>
            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.simulacao_lamina')</a>
            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.canal')</a>
            <a class="dropdown-item  list-group-item list-group-item-action list-group-sidenav text-light" hidden  href="#">@lang('sidenav.inversor_frequencia')</a>
        
      </li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->
