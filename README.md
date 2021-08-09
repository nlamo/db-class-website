# db-class-website

Website/web application for the main project for our database course.


********
  TODO 
********

- IMPORTANT: Modify the 'Maintain Users' section in the employer dashboard to be for admin use only, such that an admin can change a user's status to active/inactive. Add the appropriate logic for login.
- Develop the payments system and consider how that will play out.
- Create new views for the user so that they can see their applications, responses, etc. as set out in the requirements.
- Continue adding to the ER diagram (with constraints!), the database relational schema, and the SQL database itself.
- Normalize the database concurrently with the addition of new relations. Consider trade-offs in design after normalization process, e.g. if decomposing the database is too costly (time-wise).
- Consider in real-time the design trade-offs where it makes more sense to keep certain relations in 2NF (e.g. ease of writing certain queries).
- Find out whether it will be necessary to host the website itself on the web server set up for us.
- Make some final modifications to the styling to make it modern, stylish, and user-friendly.

********
  DONE  
********

- Set up the ssh tunnel at localhost, which is now fairly easy to use.
- Styling for the sign-up form is likely complete. Might tweak it a bit more.
- The UI (dashboard) for 'Employer' is basically complete, apart from minor changes.
- The UI (dashboard) for 'User' is also basically complete, apart from bits of tweaking.
- 'Create New Account' page has been completed (for user).
- Login validation for user/employer mostly complete, including validating by user category.
- 'Password Retrieval' pages created for user/employer, admin can function on both.
- 'Current Application Summary' PHP successfully added/fully functional.
- Added new attributes to the 'job_application' SQL and removed the ability to submit more than one application per job. User views have been updated accordingly.
- 'Current Application Summary' improved to restrict the most recent application as dependant on whether the session is running for an admin or an employer. In case of employer, it will take the most recently submitted application for all applications submitted to that employer.
- 'Post Job' PHP successfully added/fully functional. Should be tweaked to automatically include the ID of the current user (employer) running their session.
- 'Update Job' PHP is almost completely done, except for an issue where the previous date needs to be maintained upon new insertions.
- 'Update Application' PHP is basically complete. As with the other ones, I still have to add some form of message printed to the user if data is incomplete.
- 'Maintain Users' PHP is done, but it's not a particularly useful bit. 
- 'Upgrade Category' for employers is finished, and is fully functional
- 'Search All Jobs' is complete, fully functional.
- 'Upgrade User Category' and 'Update User Profile' have been completed, apart from a bit of sanitization perhaps.
- 'Search Jobs By Category' and 'Search Jobs By Name' have been implemented.
- 'Apply for a Job' is now fully implemented for users.
- Users can now use 'Update Application Status', 'Withdraw Application', and 'Delete User Account'
