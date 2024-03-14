<?php include('./partials/menu.php') ?>

<?php
// Verifica se o parâmetro 'id' está definido na URL
if (isset($_GET['id'])) {
  // Atribui o valor 'id' da URL à variável $id
  $id = $_GET['id'];
}
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Password</h1>
    <br />
    <br />

    <!-- Formulário para atualização de senha -->
    <table class="tbl-30">
      <form method="post">
        <tr>
          <td>Current Password:</td>
          <td><input type="password" name="current_password" id="current_password" placeholder="Current Password" /></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input type="password" name="new_password" placeholder="Password" id="password" /></td>
        </tr>
        <tr>
          <td>Repeat Password:</td>
          <td><input type="password" name="confirm_password" placeholder="Repeat Password" id="password2" /></td>
        </tr>

        <tr>
          <!-- Campo oculto para armazenar o valor 'id' -->
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <td colspan="2">
            <!-- Botão para enviar o formulário -->
            <input type="submit" value="Alterar" class="btn-secondary" name="submit" />
          </td>
        </tr>
      </form>
    </table>
  </div>
</div>

<?php include('./partials/footer.php') ?>

<?php
// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
  // Obtém os valores dos campos do formulário
  $id = $_POST["id"];
  $current_password = md5($_POST['current_password']); // Convertendo a senha atual para MD5 (não recomendado, MD5 é considerado inseguro)
  $new_password = md5($_POST['new_password']); // Convertendo a nova senha para MD5 (não recomendado, MD5 é considerado inseguro)
  $confirm_password = md5($_POST['confirm_password']); // Convertendo a confirmação da senha para MD5 (não recomendado, MD5 é considerado inseguro)

  // Consulta para verificar se a senha atual está correta
  $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    // Verifica se há uma linha correspondente na consulta
    $count = mysqli_num_rows($res);
    if ($count == 1) {
      // Verifica se as novas senhas coincidem
      if ($new_password == $confirm_password) {
        // Atualiza a senha do administrador no banco de dados
        $sql2 = "UPDATE tbl_admin SET 
          password='$new_password'
          WHERE id=$id
        ";

        $res2 = mysqli_query($conn, $sql2);

        // Verifica se a atualização da senha foi bem-sucedida
        if ($res2 == true) {
          // Define uma mensagem de sucesso
          $flash_message = array('category' => "success", "message" => "Password updated!");
        } else {
          // Define uma mensagem de erro
          $flash_message = array("message" => "Something went wrong while updating password", "category" => "danger");
        }

        // Define a mensagem de flash para exibir após o redirecionamento
        $_SESSION['flash_message'] = $flash_message;
        // Redireciona para a página de gerenciamento de administradores
        header("location:" . SITEURL . "admin/manage-admin.php");
        exit();
      } else {
        // Define uma mensagem de erro se as senhas não coincidem
        $flash_message = array("message" => "Passwords don't match", "category" => "danger");
      }
    } else {
      // Define uma mensagem de erro se a senha atual está incorreta
      $flash_message = array("message" => "Wrong Password", "category" => "danger");
    }
  }

  // Redireciona de volta para a página de atualização de senha
  $_SESSION['flash_message'] = $flash_message;
  header('location:' . SITEURL . "admin/update-password.php?id=" . $id);
}
?>