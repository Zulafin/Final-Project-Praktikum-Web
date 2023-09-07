<?php
session_start();
session_destroy();
?>
<script language script="javascript">
    alert('Anda Berhasil Logout');
    document.location = 'login.php';
</script>