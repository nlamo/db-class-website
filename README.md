# db-class-website

Website/web application for the main project for our database course.


********
  TODO 
********

- Continue adding to the ER diagram (with constraints!), the database relational schema, and the SQL database itself.
- After finalizing the diagrams and SQL, normalize the database and modify everything accordingly.
- Greatly improve the user validation for login (authentication). Use SESSION variables for this. Consider hashing.
- Follow all of the requirements strictly and ensure that the design of the database system proceeds logically.
- Add PHP for the dashboards to talk to the localhost database (e.g. submit, update, get, for each section).
- Find out whether it will be necessary to host the website itself on the web server set up for us.
- Make everything as clean/modular as possible. Use multiple PHP files and include them where relevant
- Consider whether it might useful to have a proper MVC structure, i.e. PHP OOP.
- Make some final modifications to the styling to make it modern, stylish, and user-friendly.
- Only *consider* making it responsive if absolutely everything else is done. Even then, no need.

********
  DONE  
********

- The UI (dashboard) for 'Employer' is basically complete, apart from minor changes.
- The UI (dashboard) for 'User' is also basically complete, apart from bits of tweaking.
- 'Current Application Summary' PHP successfully added/fully functional.
- 'Post Job' PHP successfully added/fully functional. Will be tweaked to automatically include the ID of the current user (employer) running their session.
- Non-functional 'Create Account' view has been made.
- Set up the ssh tunnel at localhost, which is now fairly easy to use.
