# db-class-website

Website/web application for the main project for our database course.


********
  TODO 
********

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
- A 'Project Overview' document has been provided to provide reasonable assumptions and describe the functionality of the application.
- The UI (dashboard) for 'Employer' is basically complete, apart from minor changes.
- The UI (dashboard) for 'User' is also basically complete, apart from bits of tweaking.
- The UIs for payments for 'Employer' and 'User' have been created.
- 'Create New Account' page has been completed for employer.
- 'Create New Account' page has been completed for user.
- Login validation for user/employer mostly complete, including validating by user category.
- 'Password Retrieval' pages created for user/employer, admin can function on both.
- 'Current Application Summary' PHP successfully added/fully functional.
- Added new attributes to the 'job_application' SQL and removed the ability to submit more than one application per job. User views have been updated accordingly.
- 'Current Application Summary' improved to restrict the most recent application as dependant on whether the session is running for an admin or an employer. In case of employer, it will take the most recently submitted application for all applications submitted to that employer.
- 'Post Job' PHP successfully added/fully functional. Should be tweaked to automatically include the ID of the current user (employer) running their session.
- 'Update Job' PHP is almost completely done, except for an issue where the previous date needs to be maintained upon new insertions.
- 'Update Application' PHP is basically complete. As with the other ones, I still have to add some form of message printed to the user if data is incomplete.
- 'Maintain User Status' section has been completed and is functional. Allows changing a user/employer's status only if current session user is admin.
- 'Upgrade Category' for employers is finished, and is fully functional
- 'Search All Jobs' is complete, fully functional.
- 'Upgrade User Category' and 'Update User Profile' have been completed, apart from a bit of sanitization perhaps.
- 'Search Jobs By Category' and 'Search Jobs By Name' have been implemented.
- 'Apply for a Job' is now fully implemented for users.
- 'Update Application Status', 'Withdraw Application', and 'Delete User Account' have been implemented.
- 'Add Payment Option' for both employers and users.
- Logic to ensure that 'frozen' accounts do not have access to dashboard services (except for editing account, in the case of 'user')