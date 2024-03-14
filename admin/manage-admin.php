<!-- imports navbar -->
<?php include("./partials/menu.php") ?>

<!-- Main content section starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Admin</h1>
    <br />



    <br /><br />
    <!-- Link para adicionar um novo administrador -->
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <br /><br /><br />

    <table class="tbl-full">
      <!-- Cabeçalho da tabela -->
      <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>

      <?php
      // Obter administradores do banco de dados
      $sql = 'SELECT * FROM tbl_admin';
      // Executar a consulta
      $res = mysqli_query($conn, $sql);

      // Criar serial number
      $sn = 1;

      // Verificar se a consulta foi executada com sucesso
      if ($res == TRUE) {
        // Contar linhas para verificar se há dados ou não
        $rows = mysqli_num_rows($res);
        if ($rows > 0) {

          while ($rows = mysqli_fetch_assoc($res)) {
            // Usar um loop while para obter todos os dados do banco de dados

            // Obter dados individuais
            $id = $rows['id'];
            $full_name = $rows['full_name'];
            $username = $rows['username'];

            // Exibir valores do banco de dados
      ?>
            <!-- Conteúdo da tabela -->
            <tr>
              <td><?php echo $sn++ ?></td>
              <td><?php echo $full_name ?></td>
              <td><?php echo $username ?></td>
              <td>
                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">
                  Change Pass
                </a>
                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary ms-2">
                  Update Admin
                </a>
                <a href="<?php echo SITEURL ?>admin/delete-admin.php?id=<?php echo $id ?>&username=<?php echo $username ?>" class="btn-danger ms-2">
                  Delete Admin
                </a>
              </td>
            </tr>

            <!-- Fim do conteúdo da tabela -->
      <?php
          }
        } else {
          echo "There's no data";
        }
      }

      ?>
    </table>
  </div>
</div>


<!-- Fim da seção de conteúdo principal -->

<!-- imports footer -->
<?php include("./partials/footer.php") ?>