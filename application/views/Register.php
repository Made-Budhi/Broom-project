<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    
<div>
  <h2>Halaman Daftar</h2>
  <form name="formdaftar" method="post" action="<?php echo base_url('Cregister/regis'); ?>">
    <div>
      <label>Email</label>
      <input type="text" name="email">
    </div>
    <div>
      <label>Password</label>
      <input type="password" name="password">
    </div>
    <div>
      <label>Nomor Induk</label>
      <input type="text" name="id">
    </div>
    <div>
      <label>Name</label>
      <input type="text" name="name">
    </div>
    <div>
      <label>Telp</label>
      <input type="text" name="phone">
    </div>

    <hr>

    <button type="submit" >Daftar</button>
    <button type="button" onClick="login()">Login</button>
  </form>
</div>

<script language="javascript">
	function login()
	{
		window.open("<?php echo base_url('Cviews/loginpage')?>","_self");	
	}
</script>

</body>
</html>