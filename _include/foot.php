<!-- REQUIRED SCRIPTS -->



<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-select/js/dataTables.select.min.js"></script>
<script src="plugins/datatables-select/js/select.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Data table -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#example2').DataTable({
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: false,
      autoWidth: false,
      responsive: true,
      select: {
        style: 'api'
      }
    });
  });
</script>

<!--Registration Modal-->
<script type="text/javascript">
  // email validation
  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
  }
  //Select Row
  $(document).ready(function() {

    var table = $('#example2').DataTable();
    $('#example2 tbody').on('click', 'tr', function() {
      if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
      } else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected')
        //Delete User
        $('#deleteUser').click(function() {
          var userid = $(".selected").attr("id");
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: 'regdelete.php',
                type: 'post',
                data: {
                  userid: userid
                },
                success: function(data) {
                  table.row('.selected').remove().draw(false);
                }


              })
              Toast.fire({
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                icon: 'success',
                timer: 2000
              })
            }
          })
        });
      }
    });
    $('#save').click(function() {
      var username = $('#username').val();
      var useremail = $('#useremail').val();
      var password = $('#password').val();
      var role = $('#role').val();
      if (username == "") {
        $('#lblusername').html('Please input name!')
      } else
      if (useremail == "") {
        $('#lbluseremail').html('Please input email!')
      } else
      if (!validateEmail(useremail)) {
        $('#lbluseremail').html('Please input a valid email!')
      } else
      if (password == "") {
        $('#lblpassword').html('Please input password!')
      } else
      if (role == "") {
        $('#lblrole').html('Please input role!')
      } else {

        $.ajax({
          url: "regsave.php",
          type: "post",
          data: {

            username: username,
            useremail: useremail,
            password: password,
            role: role
          },
          success: function(data) {
            $('#regModal').modal('hide');

            Toast.fire({
              icon: 'success',
              title: 'Sucess',
              timer: '3000'
            });

          },
          error: function(xhr, thrownError, ajaxOptions) {

          }
        });
      }
    });
  });
</script>