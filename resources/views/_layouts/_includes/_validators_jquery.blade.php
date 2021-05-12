<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js" crossorigin="anonymous"></script>
<!-- Languages -->
@if(app()->getLocale() == 'pt-br')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/localization/messages_pt_BR.min.js" crossorigin="anonymous"></script>
@elseif(app()->getLocale() == 'ru')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/localization/messages_ru.min.js" crossorigin="anonymous"></script>
@elseif(app()->getLocale() == 'tr')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/localization/messages_tr.min.js" crossorigin="anonymous"></script>
@elseif(app()->getLocale() == 'es')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/localization/messages_es.min.js" crossorigin="anonymous"></script>
@elseif( app()->getLocale() == 'ar')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/localization/messages_ar.min.js" crossorigin="anonymous"></script>
@endif