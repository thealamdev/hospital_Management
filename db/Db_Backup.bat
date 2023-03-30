
set TIMESTAMP=%DATE:~7,2%_%DATE:~4,2%_%DATE:~10,4%

"C:\xampp\mysql\bin\mysqldump.exe" -u root hospiceerp> E:\Hospital_Backup_%TIMESTAMP%.sql 

exit
