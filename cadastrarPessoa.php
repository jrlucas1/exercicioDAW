
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
<?php require('includes/componentes/header.php') ?>
<main>
    <section>
    <form action="includes/logica/logica_pessoa.php" method="post" enctype="multipart/form-data">
      
      <div class="form-group">
      <label for="nome">Nome: </label><input type="text" name="nome" id="nome" class="form-control">
      </div>

      <div class="form-group" >
      <label for="email">Email: </label><input type="text" name="email" id="email" class="form-control">
      </div>

      <div class="form-group">
      <label for="senha">Senha: </label> <input type="password" name="senha" id="senha" class="form-control">
      </div>
      
      <div class="form-group">
      <label for="imagem">Foto: </label> <input type="file" name="imagem" id="imagem" class="form-control">
      </div>

      <button type="submit" id='cadastrar' name='cadastrar' value="Cadastrar" class="btn btn-primary"> Cadastrar </button>   
    </form>
    <br><br>
    </section>
</main>
<?php require('includes/componentes/footer.php');?>
</body>
</html>
