<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2>Login Form</h2>

<form action="/action_page.php">
  <div class="imgcontainer">
    <img src="<?= base_url(); ?>assets/images/img_avatar2.png"  alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
</div>
</form>

</body>
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script>
    $("#login").click(function(event){
        var username = $("#username").val();
        var password = $("#password").val();
        var url = "<?php echo base_url() ?>/index.php/Login/login_aksi";
        $.ajax({
            url:url,
            type:"POST",
            data:{username,password},
            success:function(response){
               if(response==="success"){
                $("#pesan").html(" <div class='alert alert-"+response+"'><strong>Success!</strong> Selamat Login Berhasil</div>")
                setTimeout(() => {
                    window.location="Admin"
                }, 1000);
               }else{
                $("#pesan").html(" <div class='alert alert-"+response+"'><strong>Gagal!</strong> Pastikan Data Sudah Benar</div>")
                setTimeout(() => {
                    $("#pesan").html("")
                }, 1000);
               }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        })
    })
</script>
</html>