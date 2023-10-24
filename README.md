# SimpleMailboxTest

Launch the Symfony application development environment using:

<pre>docker-compose up</pre>

Access app container console:
<pre> docker exec -it containerId bash </pre>

Install dependencies (in previously opened docker container console):
<pre> composer install </pre>

Creating database from migration files on new docker container (in docker container console) :
<pre> php bin/console doctrine:migrations:migrate </pre>

Application is now running on: 
<pre> http://localhost:8000/ </pre>

Next possible improvements: 
- Use Dispatcher and listeners
- Create some Manager to reduce code in controllers 
- Create list for archived mails
- Install webpack to use some JS and CSS
- And many more!