<template>
  <div class="row">
    <div class="col-1 my-auto">
      <h3 style="padding-top: 20px">{{index}}</h3>
    </div>
    <div class="col-11 row">
      <input type="hidden" name="numero_emissor[]" v-bind:value="index" />
      <div class="form-group col-md-2">
        <input type="number" name="bocal_1[]" required class="form-control first_field" />
        <label class="float-label" >{{saida1}}</label>
        <div class="line"></div>
      </div>

      <div class="form-group col-md-2">
        <input type="number" step="0.1" min="0" name="bocal_2[]" class="form-control" />
        <label class="float-label" >{{saida2}}</label>
        <div class="line"></div>      </div>

      <div class="form-group col-md-2">
        <input
          type="number"
          name="espacamento[]"
          step="0.001"
          min="0.001"
          required
          class="form-control espacamento_field"
        />
        <label class="float-label" >{{espacamento}}</label>
        <div class="line"></div>      </div>

      <div class="form-group col-md-2">
        <label for>{{emissor}}</label>
        <select class="form-control" required name="emissor[]">
          <option value="I-WOB UP3">
            <b>('afericao.i-wob-up3')</b>
          </option>
          <option value="Fabrimar">
            <b>('afericao.fabrimar')</b>
          </option>
          <option value="Nelson">
            <b>('afericao.nelson')</b>
          </option>
          <option value="Super Spray UP3">
            <b>('afericao.super-spray-up3')</b>
          </option>
          <option value="Super Spray">
            <b>('afericao.super-spray')</b>
          </option>
          <option value="I-WOB">
            <b>('afericao.i-wob')</b>
          </option>
          <option value="Trash Buster">
            <b>('afericao.trash-buster')</b>
          </option>
          <option value="Komet">
            <b>('afericao.komet')</b>
          </option>
          <option value="Fan Spray">
            <b>('afericao.fan-spray')</b>
          </option>
        </select>
        <div class="line"></div>
      </div>

      <div class="form-group col-md-2">
        <label for="val_reg">{{tipoValvula}}</label>
        <select class="form-control" required="true" name="tipo_valvula[]">
          <option value="LF">
            <b>LF</b>
          </option>
          <option value="MF">
            <b>MF</b>
          </option>
          <option value="HF">
            <b>HF</b>
          </option>
          <option value="PSR">
            <b>PSR</b>
          </option>
        </select>
        <div class="line"></div>
      </div>

      <div class="form-group col-md-2">
        <label for="val_reg">{{psi}}</label>
        <select class="form-control" required="true" name="valvula_reguladora[]">
          <option value="10">
            <b>10 PSI</b>
          </option>
          <option value="15">
            <b>15 PSI</b>
          </option>
          <option value="20">
            <b>20 PSI</b>
          </option>
          <option value="25">
            <b>25 PSI</b>
          </option>
          <option value="30">
            <b>30 PSI</b>
          </option>
          <option value="35">
            <b>35 PSI</b>
          </option>
          <option value="40">
            <b>40 PSI</b>
          </option>
          <option value="45">
            <b>45 PSI</b>
          </option>
          <option value="50">
            <b>50 PSI</b>
          </option>
        </select>
        <div class="line"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props:['index', 'saida1', 'saida2', 'espacamento', 'unidadeMetros', 'tipoValvula', 'emissor', 'psi', 'tipo-emissores']
};
</script>
