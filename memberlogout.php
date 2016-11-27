<?php
  session_start();
  // session_destroy();
  unset($_SESSION['levelmember']);
  echo "<script>alert('Anda telah keluar dari halaman administrator');location.href='member.html'</script>";
?>
