# How to run
Descreva aqui as instruções de execução do seu desafio.

## 1. Backend
Certifique-se de já não possua nenhum container com os nomes:
- php
- mysql
- nginx

Certifique-se de que tenha o node.js instalado em sua maquina

após averiguado a inexistencia dos containers 

entre na raiz do projeto desafio-fullstack e execute os comandos abaixo

```sh
  sudo chown -R ${USER}:www-data backend
  sudo chmod -R ug+rwx backend/storage backend/bootstrap/cache
  docker-compose up -d
  docker exec php cp .env.example .env
  docker exec php composer install
  docker exec php php artisan migrate
  docker exec php php artisan db:seed
```

Agora instale as dependencias do frontend e gere o build

## 2. Front
Entre no projeto do frontend e rode os comandos
```sh
  npm install
  npm run build
  npm run start
```

Abra a seguinte página no navegador http://localhost:3000/

### Utilize os dados abaixo para fazer o login no site
Login: admin@mail.com
Password: supersecret
