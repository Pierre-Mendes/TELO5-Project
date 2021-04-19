<template>
   
    <div class="card  mx-auto mt-5">
        <div class="card-header" align='center'> <h1 class='text-center'>CADASTRAR USUÁRIO</h1> </div>
        <div class="card-body">
            <form action="/cadastrar/submit" class='row' method="post">
                <div class='col-12'>
                    <hr>
                    <h3>Informações Pessoais</h3>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Nome</label>
                    <input class="form-control" id="name" name="nome" type="text" aria-describedby="" placeholder="Nome" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="telefone">Telefone</label>
                    <input class="form-control" id="telefone" name="telefone" type="text" aria-describedby="" placeholder="Telefone" required>
                </div>

                <div class='col-12'>
                    <hr>
                    <h3>Informações de Endereço</h3>
                </div>

               <div class="form-group col-md-4">
                    <label for="rua">Rua</label>
                    <input class="form-control" id="rua" name="rua" type="text" aria-describedby="" placeholder="Rua" required>
                </div>       

                 <div class="form-group col-md-4">
                    <label for="cep">CEP</label>
                    <input class="form-control" id="cep" name="cep" type="text" aria-describedby="" placeholder="CEP" required>
                </div>   

                <div class="form-group col-md-4">
                    <label for="cidade">Cidade</label>
                    <input class="form-control" id="cidade" name="cidade" type="text" aria-describedby="" placeholder="Cidade" required>
                </div>                
                
       
                <div class="form-group col-md-6">
                    <label for="estado">Estado</label>
                    <input class="form-control" id="Estado" name="estado" type="text" aria-describedby="" placeholder="Estado" required>
                </div> 

                <div class="form-group col-md-6">
                    <label for="pais">País</label>
                    <input class="form-control" id="pais" name="pais" type="text" aria-describedby="" placeholder="País" required>
                </div>

                <div class='col-12'>
                    <hr>
                    <h3>Configurações de Sistema</h3>
                </div>


                <div class="form-group col-md-6">
                    <label for="Idioma">Idioma</label>
                    <input class="form-control" id="Idioma" name="configuracao_idioma" type="text" aria-describedby="" placeholder="Idioma" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="tipo_usuario">Tipo Usuário</label>
                    <input class="form-control" id="tipo_usuario" name="tipo_usuario" type="text" aria-describedby="" placeholder="Tipo de Usuário" required>
                </div>
                
                   

                <div class='col-12'>
                    <hr>
                    <h3>Credenciais de Login</h3>
                </div>


                
                <div class="form-group col-md-4">
                    <label for="email" >E-Mail</label>
                    <input class="form-control" id="email" name="email" type="email" aria-describedby="" placeholder="E-Mail" required>
                </div>
                
                <div class="form-group  col-md-4">
                    <label for="passwd1">Senha</label>
                    <input class="form-control" id="passwd1" name="password" type="password" placeholder="Senha" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="passwd2">Confirmar Senha</label>
                    <input class="form-control" id="passwd2" type="password" placeholder="Senha" required>
                </div>


                
                <button class="btn btn-lg btn-info btn-block col-md-2 text-light" style="margin: 0 auto" type="submit">CADASTRAR</button>
                
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="/">VOLTAR</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>