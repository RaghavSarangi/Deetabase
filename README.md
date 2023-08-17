# Deetabase
CMS TFPx Deetabase
Author: Raghav Sarangi, Cornell University
This is a web database that can save information about Dee sensors produced by the TFPx team at Cornell University. The following document provides details on its usage.

Administrators: Raghav Sarangi (rs977@cornell.edu), Jose A. Monroy (jam957@cornell.edu)
Setting up an Account
The main page is known as the “index” and is meant for logging into the database. To create an account to log into, click the ‘Sign up now.’ hyperlink and enter the required information in the form given. Please take care to store your username and password in a secure place so as to not forget it. Confirm that your credentials are accurate and active by logging in, on the index page which you should be redirected to after creating your account.

After logging in, you will be taken to the ‘main.php’ page (see end of address line at the top of the browser) where the actions you can undertake will be laid out under your account’s details.

Note that when your account is newly created, the ‘Viewer’ privilege (the privilege determines which actions one can carry out within the database, and has been expanded upon below). To request a privilege change, please contact the database administrative team.
Viewer Mode
As a viewer, you can see the Dees that are recorded in the database at present. There are two ways to do so:
To view a comprehensive list of all recorded entries, click on ‘See all Dees stored in the database’ from the main page (see end of address line at the top of the browser) to which you are brought after logging in. This will be presented in a table format with all attributes laid out.
To view one or multiple Dees by specifying certain parameters,  click on ‘Filter-search Dees of the database’ instead. This will take you to a page where you can immediately find the Dees if you know its ID #, or by filtering different attributes to shortlist some. Take care to read the box on the right to be able to use the searching functionality effectively. If the value for a field is unknown, leave it as the default since that will create a general query. Note that not all details can be seen initially. After locating a particular Dee to focus on, you may click the ‘View’ button under the Actions column to see all of its attributes.
You can exit and return to the main page from anywhere by clicking the ‘Back’ button on the bottom left.

Editor Mode
In addition to the features available as a viewer, an editor can perform the following actions:
To add dees to the database, click on ‘Add Dees to the database’ from the main page and fill out the given form. You may leave unknown fields, except for Operators (in case the user recording the data does not know the operators, their own name will suffice), empty. For both the X-Ray and CMM evaluations, if you would like the database to have a record of certain PDF or PNG/JPEG files, a Google Drive Folder can be created containing them and its link placed into the corresponding field. Do NOT include any single inverted commas (‘__’) in any field. After clicking Upload Data, you will receive a LOG message if the data has been added, along with the ID # that has been assigned (it is recommended to then name the aforementioned Google Drive folder as “Dee_{ID #}_evaluation” for ease-of-access). A QR code to view the Dee will also be generated below the LOG message that can be saved locally by right-clicking on it. To add more Dees, you can continue filling out the form, or you can exit to the main page by clicking ‘Back’.
To edit dees currently stored, you must again find it using the Filter-search method described above. Having done so, one may click ‘Edit’ under the Actions column and confirm with the pop-up that arises in the browser, which will redirect you to a page that looks much like the Add form and has all the current information of the Dee, with fields that can be modified. Click ‘Upload Data’ when the information has been edited to confirm your changes. You will be redirected to a page with a LOG message confirming the update of the chosen Dee. You can then exit to the main page by clicking ‘Back’.

Administrator Mode
In addition to the features available as both a viewer AND an editor, an administrator can perform the following actions:
To delete a given dee, find it using the Filter-search method from before. Then, click ‘Delete’ under the Actions column and confirm with the pop-up that arises in the browser. Note that this action cannot be undone so care is required to prevent the wrong Dee from being deleted. After confirming, you will be redirected to a page with a LOG message validating the deletion, from which you can exit to the main page by clicking ‘Back’.
You can view all of the users registered with the database by clicking ‘View users of the database’. This will list out their names, affiliations, privileges and email addresses.