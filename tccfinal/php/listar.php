<?php

if (!isset($_SESSION['usuario'])) {
  //Destrói
  session_destroy();

  //Limpa
  unset($_SESSION['usuario']);
  //  unset ($_SESSION['senha']);

  //Redireciona para a página de autenticação
  header('location:login.html');
}


//session_cache_expire(1);
//session_start();
//echo strtoupper($_SESSION['usuario']); 

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

<style>
  .hidetext { -webkit-text-security: disc; /* Default */ }
</style>
  <script>
    $(document).ready(function() {

      $('.editbtn').on('click', function() {

        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);

        $('#idUsuario').val(data[0]);
        $('#nomeUsuario').val(data[1]);
        $('#emailUsuario').val(data[2]);
        $('#senhaUsuario').val(data[4]);


      });
    });


  </script>


  <title>Lista de Usuários</title>


  <script language="Javascript">

  </script>


</head>

<body>


  <div class="container">
    <table id="myTable" class="table">
      <thead class="thead-dark">
        <?php

        include("php/conexao.php");
        $pdo = conectar();
        $sql = "SELECT idUsuario, nomeUsuario,loginUsuario, emailUsuario,senhaUsuario FROM tblUsuario where ativo=1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          echo "
    <tr>
        <th >ID</th>
        <th>Nome</th>        
        <th>Email</th>
        <th>Usuario</th>
        <th>Senha</th>
        <th></th>
        <th></th>
      </tr>        
      </thead>
    <tbody>";

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id        = $row["idUsuario"];
            $nome      = $row["nomeUsuario"];
            $email = $row["emailUsuario"];
            $senha = $row["senhaUsuario"];
            echo "<tr>
        <td>" . $row["idUsuario"] . "</td>
        <td>" . $row["nomeUsuario"] . "</td>
        <td>" . $row["emailUsuario"] . "</td> 
        <td id='psw' class='hidetext'>" . $row["senhaUsuario"] . "</td>
        <td><button type='button' class='btn btn-info btn-lg  editbtn' data-toggle='modal'  data-target='#editModal' >Editar</button></td>     
        <td><a href='javascript:func()' onclick='confirmacao(" . $row["idUsuario"] . ")' >Excluir</a></td>
    </tr>";
          }
          echo "</table>";
        } else {
          echo "0 results";
        }



        ?>





        </tbody>
    </table>


    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          </div>

        
            <div class="modal-body">

              <input type="hidden" name="idUsuario" id="idUsuario">

              <div class="form-group">
                <label> Email </label>
                <input type="text" name="emailUsuario" id="emailUsuario" class="form-control" placeholder="Email do Usuario">
              </div>
              <div class="form-group">
                <label> Senha </label>
                <input type="password" name="senhaUsuario" id="senhaUsuario" class="form-control" placeholder="Digite a Senha">
              </div>
            </div>
           

        </div>
      </div>
    </div>

  </div>




</body>

</html>