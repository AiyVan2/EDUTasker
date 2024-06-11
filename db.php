<?php
$conn = mysqli_init();
mysqli_ssl_set($conn,NULL,NULL, "DigiCertGlobalRootCA.crt.pem", NULL, NULL);
mysqli_real_connect($conn, "todolist.mysql.database.azure.com", "Aiyvan", "MEGA7TROn@@", "todo_list", 3306, MYSQLI_CLIENT_SSL);
?>