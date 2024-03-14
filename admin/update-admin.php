<?php
include('./partials/menu.php');

// Obtém o ID do administrador a partir dos parâmetros da URL
$id = $_GET['id'];

// Query SQL para selecionar todos os campos do administrador com o ID especificado
$sql = "SELECT * FROM tbl_admin WHERE id = $id";

// Executa a consulta SQL no banco de dados
$res = mysqli_query($conn, $sql);

// Verifica se a consulta foi executada com sucesso
if ($res == true) {
  // Obtém o número de linhas retornadas pela consulta
  $count = mysqli_num_rows($res);

  // Verifica se há registros retornados
  if ($count > 0) {

    // Se houver exatamente 1 registro retornado
    if ($count === 1) {
      // Extrai os dados do registro retornado
      $row = mysqli_fetch_assoc($res);
      $username = $row['username'];
      $full_name = $row['full_name'];
    } else {
      // Se o número de registros for diferente de 1, exibe uma mensagem de erro e 
      // redireciona de volta para a página de gerenciamento de administradores
      $_SESSION["flash_message"] = array(
        "category" => "danger",
        "message" => "Não foi possível encontrar nenhum usuário para o ID especificado"
      );
      header("location:" . SITEURL . "admin/manage-admin.php");
    }
  }
}
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Admin</h1>
    <br />
    <br />

    <form action="#" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Full Name:</td>
          <td>
            <input placeholder="Full Name" type="text" name="full_name" id="fullname" value="<?php echo $full_name ?>" />
          </td>
        </tr>

        <tr>
          <td>Username:</td>
          <td>
            <input placeholder="Username" type="text" name="username" id="username" value="<?php echo $username ?>" />
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="submit" name="submit" value="Update Admin" class="btn-secondary" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php

// Verifica se o formulário foi submetido
if (isset($_POST['submit'])) {
  // Obtém os valores enviados pelo formulário
  $id = $_POST['id'];
  $username = $_POST['username'];
  $full_name = $_POST['full_name'];

  // Query SQL para atualizar os valores do administrador
  $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username'
    WHERE id = '$id'";

  // Executa a query no banco de dados
  $res = mysqli_query($conn, $sql);

  // Verifica se a query foi executada corretamente
  if ($res == true) {
    // Se a query foi executada corretamente, define uma mensagem de sucesso
    $flash_message = array(
      "message" => "Admin atualizado com sucesso",
      "category" => "success"
    );
  } else {
    // Se a query falhou, define uma mensagem de erro
    $flash_message = array(
      "message" => "Não foi possível atualizar o admin",
      "category" => "danger"
    );
  }

  // Define a mensagem de flash na sessão para exibição posterior
  $_SESSION['flash_message'] = $flash_message;

  // Redireciona de volta para a página de gerenciamento de administradores
  header('location:' . SITEURL . "admin/manage-admin.php");
  exit();
}
?>


<?php include('./partials/footer.php'); ?>