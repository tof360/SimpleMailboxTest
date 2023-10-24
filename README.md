# SimpleMailboxTest

Launch the Symfony application development environment using:

<pre>docker-compose up</pre>

Access app container console:
<pre> docker exec -it containerId bash </pre>

Creating database from migration files on new docker container (in docker container console) :
<pre> php bin/console doctrine:migrations:migrate </pre>