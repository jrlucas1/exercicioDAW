<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    require __DIR__.'/PHPMailer/src/PHPMailer.php';
    require __DIR__.'/PHPMailer/src/SMTP.php';
 
    function inserirUsuario($conexao,$array){
       try {
            $query = $conexao->prepare("insert into usuarios (nome, email, senha, foto) values (?, ?, ?, ?)");

            $resultado = $query->execute($array);
            
            return $resultado;
            
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


    function alterarUsuario($conexao, $array){
        try {
            $query = $conexao->prepare("update usuarios set nome= ?, email = ?, senha= ? where idusuarios = ?");
            $resultado = $query->execute($array);   
            return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function deletarUsuario($conexao, $array){
        try {
            $query = $conexao->prepare("delete from usuario where idusuarios = ?");
            $resultado = $query->execute($array);   
             return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }
 
    function listarUsuario($conexao){
      try {
        $query = $conexao->prepare("select * from usuarios");      
        $query->execute();
        $usuarios = $query->fetchAll();
        return $usuarios;
      }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  

    }

     function buscarUsuario($conexao,$array){
        try {
        $query = $conexao->prepare("select * from usuarios where idusuarios=?");
        if($query->execute($array)){
            $usuarios = $query->fetch(); //coloca os dados num array $usuario
            return $usuarios;
        }
        else{
            return false;
        }
         }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  
    }

    function acessarUsuario($conexao,$array){
        try {
        $query = $conexao->prepare("select * from usuarios where email=? and status = true");
        if($query->execute($array)){
            $usuario = $query->fetch(); //coloca os dados num array $pessoa
          if ($usuario)
            {  
                return $usuario;
            }
        else
            {
                return false;
            }
        }
        else{
            return false;
        }
         }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  
    }

 function pesquisarUsuario($conexao,$array){
        try {
        $query = $conexao->prepare("select * from usuarios where upper(nome) like ?");
        if($query->execute($array)){
            $usuarios = $query->fetchAll(); //coloca os dados num array $pessoa
          if ($usuarios)
            {  
                return $usuarios;
            }
        else
            {
                return false;
            }
        }
        else{
            return false;
        }
         }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  
    }
 
function enviarEmail($nome, $email, $assunto, $mensagem){
        
        $email_resposta ='nao-responda@abuble.com';

        $mail = new PHPMailer();

        // habilitando SMTP 
        $mail->isSMTP();

        // habilitando tranfer??cia segura 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // Pode ser: 0 = n??o exibe erros, 1 = exibe erros e mensagens, 2 = apenas mensagens 

        $mail->SMTPDebug = 0; // Debug

        // habilitando autentica????o 
        $mail->SMTPAuth = true;

        // Configura????es para utiliza????o do SMTP do Gmail 

        $mail->Host = 'smtp-mail.outlook.com';
        $mail->Port = 587; // porta gmail/outlook
        $mail->SMTPOptions = [
            'tls' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $mail->Username = 'jrsmtpteste@outlook.com'; ////Usu??rio para autentica????o 
        $mail->Password = '@Kidding435'; //senha autentica????o

        // Remetente da mensagem - sempre usar o mesmo usu??rio da autentica????o  
        $mail->setFrom('jrsmtpteste@outlook.com','Adm Site');

        // Endere??o de destino do email
        $mail->addAddress($email, $nome);

        $mail->CharSet = "utf-8";

        // Endere??o para resposta
        $mail->addReplyTo($email_resposta);
      
        // Assunto e Corpo do email
        $mail->Subject = $assunto;

        $mail->Body = $mensagem;

        // Enviando o email
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo $mensagem." E-mail SMTP enviado com sucesso para " . $email . " Enviado por: ".$email_resposta ;
    }
} 

function pesquisarPessoaEmail($conexao,$array){
        try {

        $query = $conexao->prepare("select * from usuarios where md5(email) = ?");
        if($query->execute($array)){
            $usuario = $query->fetch(); //coloca os dados num array $pessoa
          if ($usuario)
            {  
                return $usuario;
            }
        else
            {
                return false;
            }
        }
        else{
            return false;
        }
         }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  
    }

 function alterarStatustrue($conexao, $array){
        try {
            session_start();
            $query = $conexao->prepare("update usuarios set status = true where idusuarios = ?");
            $resultado = $query->execute($array);     
            return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
function alterarSenha($conexao, $array){
    try{
        $query = $conexao->prepare("update usuarios set senha = ? where idusuarios = ?");
        $resultado = $query->execute($array);
        return $resultado;
    }catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
function esqueciSenha($conexao, $array){
    try{
       $query = $conexao->prepare("INSERT into recuperacao (email, chave) values (?, ?)");
       $resultado = $query->execute($array);
       return $resultado;
     }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
}
function alterarPassword($conexao, $array){
    try{
        $query = $conexao->prepare("update usuarios set senha = ? where email=?");
        $resultado = $query->execute($array);
        return $resultado;
    }catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
function checkConf($conexao,$array){
    try {
         $query = $conexao->prepare("SELECT COUNT(*) FROM recuperacao WHERE email=? and chave=?");

         $resultado = $query->execute($array);
         
         return $resultado;
         
     }catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
     }

 }

 function deleteConf($conexao, $array){
     try{
        $query = $conexao->prepare("DELETE FROM recuperacao WHERE email = ? AND chave = ?");

        $resultado = $query->execute($array);
        
        return $resultado;
     } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
 }
   ?>
