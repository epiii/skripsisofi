<?php
     if(!empty($_SESSION))  header('Location:media.php?module=home');
     else 
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
        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
           <form id="form-login" name="login" method="post" action="cek_memberlogin.php" onSubmit="return validasi(this)">
                <div class="body bg-lime">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-teal btn-block">Submit</button>  
                </div>
            </form>

            <div class="margin text-center">
            </div>
        </div>
