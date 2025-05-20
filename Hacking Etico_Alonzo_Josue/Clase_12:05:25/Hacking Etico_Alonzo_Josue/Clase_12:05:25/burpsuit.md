PRACTICA BURPSUIT

El dia de hoy en clase se intercepto un paquete de informacion de una pagina de inicio de sesion en mutilidae con burpsuite:
![Cap1](/evidencias/Captura%20de%20Pantalla%202025-05-12%20a%20la(s)%208.21.39%20p.m..png)

Se creo un usuario para hacer pruebas dentro y con la herramienta de burpsuit se pudo hacer revisar la informacion del mismo:
![Cap2](/evidencias/Captura%20de%20Pantalla%202025-05-12%20a%20la(s)%208.36.31%20p.m..png)

Posterior a eso se modifico la solicitud interceptada del inicio de sesion del usuario:
![Cap3](/evidencias/Captura%20de%20Pantalla%202025-05-12%20a%20la(s)%208.50.32%20p.m..png) 

Se volvio a modificar para enviar datos que si funcionan (o sea password y usuario correctos) 
![Cap4](/evidencias/Captura%20de%20Pantalla%202025-05-12%20a%20la(s)%208.56.13%20p.m..png)

Por ultimo modificando el uid que pertenece a los usuarios nos logramos meter al usuario admin vulnerando totalmente la base de datos.
![Cap5](/evidencias/Captura%20de%20Pantalla%202025-05-12%20a%20la(s)%208.56.42%20p.m..png)
![Cap6](/evidencias/Captura%20de%20Pantalla%202025-05-12%20a%20la(s)%209.03.34%20p.m..png)