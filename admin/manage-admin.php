<!-- imports navbar -->
<?php include("./partials/menu.php") ?>

<!-- Main content section starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Admin</h1>

    <br /><br />
    <a href="add_admin.php" class="btn-primary">Add Admin</a>
    <br /><br /><br />

    <table class="tbl-full">
      <!-- Table Heading -->
      <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>

      <!-- Table content -->
      <tr>
        <td>1</td>
        <td>Rafael Pimenta</td>
        <td>Rafawastaken</td>
        <td>
          <a href="#" class="btn-secondary">
            Update Admin
          </a>
          <a href="#" class="btn-danger ms-2">
            Delete Admin
          </a>
        </td>
      </tr>
    </table>
    <!-- End of table content -->

  </div>
</div>
<!-- Main content section ends -->

<!-- imports footer -->
<?php include("./partials/footer.php") ?>