#Requirement specification 

##Secure MVC Framework for Fagersta Klätterklubb (Fagersta Climbing Society).

#UC1 User logs in and adds page
###Main scenario
1. User navigates to login page.
2. User provides correct username and password on input fields and clicks login.
3. The System authenticates the user and the user is welcomed by the system.
4. A new menu option "Add page" is presented for the user which user clicks on.
5. The system provides input fields for the user to enter new page information.
6. User saves clicks on a button to save the page, the system saves the page.
7. The system displays the new page in the menu.

### Alternate Scenarios
* 2a. User wants the system system to remember login for easier administration of page.
 * 1. The system authenticates the user and stores the login information securily for user to login more easily next time.
* 3a. User was not authenticated due to providing incorrect credentials.
 1. System presents an error message to user.
 2. Back to Step 2.

#UC2 User edits a page and logs out.
##Precondition
UC1. 3 User is successfully logged in.
1. User is logged in and clicks on a item in the menu which the user wishes to edit.
2. The system presents the user with a form where the user can edit the page.
3. The user edits the page and clicks on save.
4. The system saves the page and informs the user about this.
5. The user clicks on the logoutbutton on the menu to logout.
6. The system logs out the user, removing eventual stored credentials for remembering the users login.
7. The system presents a message to the user that the logut was successful.


###Supplementary specification
System Quality Requirements
 * The system should be fast.
 * The system should be user-friendly
 * The system should be secure
 * System provides helpful messages on actions
 * The system should follow web standards.

Security Considerations
 * SQL injections
 * Javascript injections
 * Password handling
 * Session hijacking
 * Execution of server files
