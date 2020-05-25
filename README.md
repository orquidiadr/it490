froothies.com 

*** all requests are done through rabbitmq
    .ini files:
            testRabbitMQ.ibi
            recipe.ini
            account.ini
            AMD_Server.ini
            RMQ_Server.ini
            recommend.ini
            form.ini
            local.ini
            comment.ini
            backup.ini
            blog.ini
            host.ini
            rating.ini
            testRMQ.ini

  frontend: php/html hosted on apache
    front page: 
                index.php, login and authentication, redirects to welcome page
                register.php, registeration, redirects to login

                welcome.php, user dashboard, links to user account page and recipe maker
                            user ratings.php, and comments.php, search bar
                
                myaccount.php, requests users data from localdb

                recipe.php, creates user smoothie recipe, adds to users data
                
                search.php, searches for ingredients and recipes
                
                recommendSmoothie.php, requests smoothies data from localdb
                
                rating.php, user can rate smoothies *still beta*
                
                comment.php, user can send us their comments about our page
                
                logout.php, terminates the user's session
                
                blog.php, users can add comments to previously created smoothies *still beta*
                
                form.php, users add fruits and veggies that can't find
                
                register.php, creation of users
                
                                       
  backend: php hosted on mysql and mariadb
                mysqlserver.php, connects to localdb, authenticates login and creates table for new users

                myaccountserver.php, pulls users data from my account request

                makesmoothie.php, takes users recipe and adds to localdb and users data

                mdserver.php, dmz_server.php, takes search request and checks local db if not available requests from dmz_server, adds to local db and returns data to frontend
                
                recommendSmoothieServer.php, pulls random smoothie data


How do I run this? You can run this manually or preferrably through Systemd
<ul>
<li>./mysqlserver.php -> log in, register</li>
<li>./myaccountserver.php -> my account</li>
<li>./makesmoothie.php -> create a smoothie form in the welcome page</li>
<li>./recommendSmoothieServer.php -> smoothie of the day from the welcome page</li>
<li>./search.php -> search.php, dmz_server.php, loginDB.php, md_cred.php, md_server.php</li>
<li>./makesmoothie.php -> create a smoothie form in the welcome page</li>
<li> Create databases, tables, and database user as stated in the files. Grant all privileges to 'nemo' user</li>
</ul>

Needs attention
<ul>
<li> logging: https://github.com/jyoussef98/Froothies/tree/master/logs Need face to face testing </li>
</ul>



Contact Email: jy353@njit.edu
trello: https://trello.com/b/y4qIl03S/it-490system-integration

Side note: contributor captainpwnbugs is Orquidia's other account.
