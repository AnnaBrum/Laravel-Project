# Laravel-Project
An app where you can login, submit and rate movie-ideas.

# Code-review
- create.blade.php - could have a more descriptive name, prehaps createUser.
- dashboard.blade.php - could also have a more descriptive name, home etc. 
- index.blade.php - could be named login.
- registerController line 46-69 - outcommented code could be removed. 
- model Movie - movie_likes is not present in the model file but exists in the migration file. 
-  CreateMovieController.php - line 19 - make max characters on movie_plot abit longer?
- Testing - Could test if a movie got a like. 
- Testing - Could test filtering by category. 
- Testing - add a register user test. 
- Maybe allow guests to view movie ideas without being able to like. (middleware auth in dashboard prevents this)
- Could generally add more comments to describe what is happening. 
- better names for controller functions, for example createUser instead of create. 
- dashboard.blade.php line 9-19 - could use same variable name for messages in controllers to reduce the amount of ifstatements in the bladefile. 
- You have a h2 before a h1 element in your dashboard.blade
- routes/web line 41 - the name movie_genre could be more descriptive. 
- Code can be removed in dashboard controller line 19. 
- maybe there could be an option to add a movie genre. We miss the romance genre. 
- Migrations/ create_movies_table - line 18 -could use longText instaed of text for movie_plot column. 
- dont forget to comment back 2 rows in phpunit.xml when your´re testing.
- Would be cool to have a pivot-table to enable movies to have multiple genres such as romantic-comedy or action-thriller
