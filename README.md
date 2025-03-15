# Requisitos de instalación

Instalar docker desktop desde [Docker Desktop] (https://docs.docker.com/desktop/setup/install/windows-install/)

Instalar ubuntu 22.04LTS desde la microsoft store de windows

Configurar el wsl2 en la configuración de docker desktop


### Pasos para iniciar el proyecto

``` Crear .env y añadir configuración correspondiente
DB_CONNECTION=mysql
DB_HOST=bwv43jnbrszanyo519gm-mysql.services.clever-cloud.com
DB_PORT=3306
DB_DATABASE=bwv43jnbrszanyo519gm
DB_USERNAME=ugp3r1x6mn5y17me
DB_PASSWORD=6CJCjxKoFfkDsjBu6LR6
```
- Posteriormente ejecutar docker build -t spotifyApp 
- Después iniciarlo en el puerto 80 que es el que esta expuesto para poder verlo y después escribir en el navegador localhost/docs/api y hay estarán las apis creadas con su documentación 