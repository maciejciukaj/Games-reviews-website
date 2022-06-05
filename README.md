# Games reviews website 🎮

Simple website that allows logged in users to review the games.
<ul><li>A regular user has access to all reviews and the review form.</li>
<li>Admin, in addition to the functions mentioned above, can add the game to the base.</li>
<li>Super-admin has access to all functions along with changing the rights of the website users.</li></ul>

***Docker-compose*** and ***dockerfile*** have been added to the project, thanks to which the project can be run through the Docker container using following command:

```
docker-compose -f "docker-compose.yml" -p projektDocker up -d
```

Server is running by default on port 8000

```
localhost:8000
```

Site was built using [PHP](https://www.php.net/), HTML, CSS and [Docker](https://www.docker.com/)🐋
