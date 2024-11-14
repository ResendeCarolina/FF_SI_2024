<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../CSS/main.css">
</head>
<body>
    <main>
      <div class="wrapper">
         <div class="imgSignUp">
             <img id="imgSU" src="/IMAGENS/carro.jpg" alt="imagem_signUp">
         </div>
        <div class="outContainer">
            <div class="container">  
                <h2 id="titulo">Sign Up</h2>
                <div class="register_form">
                    <form>
                        <div>
                            <label for="nome">Name</label>
                            <input type="text" id="nome" name="nome" placeholder="Name" required>
                        </div>
                        <div>
                            <label for="mail">Email</label>
                            <input type="email" id="mail" name="mail" placeholder="fastfurious@gmail.com" required>
                        </div>
                        <div>
                            <label for="pwd">Password</label>
                            <input type="password" id="pwd" name="pwd" placeholder=". . . . . . . . . ." required>
                        </div>
<!-- 
            <div>
                <label for="nome">Birth Date</label>
                <input type="date" id="data" name="data" required>
            </div>
            <div>
                <label for="phone">Contacto telefónico:</label> 
                <input type="tel" id="phone" name="phone" placeholder="+(239)9123917916" required>
            </div>
-->
                        <div class="checkbox">
                            <input type="checkbox" id="is_admin" name="is_admin" value="1">
                            <label for="is_admin">Aministrator</label>
                            
                        </div>
                        <div>
                            <input id="botao" type="submit" value="SUBMIT">
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </main>
</body>
</html>

