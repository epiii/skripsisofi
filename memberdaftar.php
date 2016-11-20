<?php
 if(!empty($_SESSION))  header('Location:member.html');
 else{ 
?>
       <script type="text/javascript">
        function validasi(form){
        if (form.username.value == ""){
        alert("Anda belum mengisikan Username");
        form.username.focus();
        return (false);
        }
             
        if (form.password.value == ""){
        alert("Anda belum mengisikan Password");
        form.password.focus();
        return (false);
        }
        return (true);
        }
        </script>
    
        <!-- form login  <epi> -->
        <div class="container">
            
        <div class="form-box" id="login-box">
        <div class="header">Daftar</div>
           <form id="form-login" name="login" method="post" action="memberdaftarproses.php" onSubmit="return validasi(this)">
                <div class="body bg-lime">
                    <div class="form-group">
                        <label for="">Nama:</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="nama_lengkap"/>
                    </div>
                    <div class="form-group">
                        <label for="">alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="alamat"/>
                    </div>
                    <div class="form-group">
                        <label for="">telpom</label>
                        <input type="text" name="telpon" class="form-control" placeholder="telpon"/>
                    </div>
                    <div class="form-group">
                        <label for="">username</label>
                        <input type="text" name="username" class="form-control" placeholder="username"/>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="password"/>
                    </div>          
                </div>
                <!-- <div class="footer">                                                                -->
                    <button type="submit" class="btn bg-teal ">Simpan</button>  
                <!-- </div> -->
                <a  href="member.html">Login</a>

            </form>

            <div class="margin text-center">
            </div>
        </div>
        </div>


<?php
    }
?>