# How to run
Descreva aqui as instruções de execução do seu desafio.

## 1. Backend
Certifique-se de já não possua nenhum container com os nomes:
- php
- mysql
- nginx

Certifique-se de que tenha o node.js instalado em sua maquina

após averiguado a inexistencia dos containers execute os comandos abaixo

```sh
  sudo chown -R ${USER}:www-data backend
  docker-compose up -d
  docker exec php cp .env.example .env
  docker exec php composer install
  docker exec php php artisan migrate
```

Agora instale as dependencias do frontend e gere o build

## 2. Front
  entre no projeto do frontend
```sh
  npm install
  npm run build
  npm run start
```

Abra a seguinte página no navegador http://localhost:3000/

