
@if(session()->has('modal'))
<?php
    $modal = Session::get('modal');
    Session::forget('modal');
?>
<div class="modal fade" id="modalPagina" tabindex="-1" role="dialog" aria-labelledby="Logoff" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title text-{{$modal['tipo']}}"  id="modalPagina">@lang($modal['titulo'])</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">@lang($modal['mensagem'])</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">OK</button>
                @if(isset($modal['link']))
                    <a class="btn btn-{{$modal['tipo']}} center-block" href="{{route($modal['link'])}}">@lang($modal['descLink'])</a>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (){
        $('#modalPagina').modal('show');
    })
</script>
@endif