# Requisitos de instalación

Instalar docker desktop desde [Docker Desktop] (https://docs.docker.com/desktop/setup/install/windows-install/)

Instalar ubuntu 22.04LTS desde la microsoft store de windows

Configurar el wsl2 en la configuración de docker desktop


### Pasos para iniciar el proyecto

- Situarnos dentro del proyecto apiSpotifyVictor
- Ejecutar docker build -t Spotify .
- Una vez dentro de images en docker desktop hay que montar las carpetas de credentials y del secret para ello:
	- Seleccionamos el botón de "play" y seleccionamos optional settings
	- En container name le ponemos un nombre
	- En ports en host port ponemos 80
	- En volumes en host path seleccionamos la carpeta secrets y en container path /etc/secret
	- Le damos al mas y añadimos otro volumen
	- En host path seleccionamos la carpeta credentials y en container path /etc/credentials

- Después iniciarlo en el puerto 80 que es el que esta expuesto para poder verlo
- Escribir en el navegador localhost/docs/api y hay estarán las apis creadas con su documentación 
- Para poder usar las apis, una vez dentro de localhost/docs/api
	- Primero hay que llamar al servicio de authControllerUsers.registerUser que se sitúa dentro de AuthUsers
	- Segundo llamamos con el email y contraseña al servicio de authControllerUsers.loginUser con eel email y password introducidos anteriormente
	- Tercero nos quedamos con el token que devuelve este servicio
	- Cuarto llamamos al servicio authControllerUsers.getUserInfo y en el token introducimos el token obtenido anteriormente y vemos si nos devuelve la información del usuario que nos hemos logueado en caso de que no repetir el proceso
- Para llamar a los servicios necesitamos añadir dicho token 
- Si se accede a traves de la url dará error porque hay que pasar como header --header 'Authorization: Bearer mi_token_generado '
