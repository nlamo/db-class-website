# db-class-website

Website for the main project for the 'Files and Databases' course, COMP 5531.


********
  TODO 
********

- Create the first version of the ER diagram (with constraints!), the database relational schema, and the SQL database itself.
- After creating the diagrams and maybe the SQL, normalize the database and modify/decompose everything accordingly.
- Greatly improve the user validation for login (authentication). Use SESSION variables for this. Consider later hashing passwords.
- Follow all of the requirements as strictly as possible and ensure that the design of the database system proceeds logically.
- Add PHP for the dashboards to talk to the localhost database (e.g. submit, update, get, for each section).
- Find out whether it will be necessary to host the website itself (and not just the database) on the web server set up for us.
- Make everything as clean and modular as possible so that it can be easily changed later. Use multiple PHP files and include them where relevant.
- Consider whether it might be worth it to actually have a proper MVC structure, i.e. if it makes sense to use class-based PHP (OOP).
- Make some final modifications to the styling to make it modern, stylish, and user-friendly.
- Only *consider* making it responsive if absolutely everything else is done. Even then, no need.

********
  DONE  
********

- Basic dashboards have been developed, but will likely be further modified and expanded.
- Added some basic PHP for insertions for the 'Warm-Up Project'.
- Set up the ssh tunnel at localhost, which is now fairly easy to use.
- Successfully performed insertions into the remote database.
