# simpli-wp-test-interview

### What is this repository for? ###

This repository is for testing Wordpress skills of candidates who apply to a job at Simplifia.

### How do I get set up? ###

Be sure to have a Wordpress last version installed on your machine  
```
Fork the project  
Clone the repository  and install it as a plugin in your Wordpress
cd /wp-content/plugins/simpli-wp-test-interview
Create a new branch named *interview/yourfirstname-yourlastname* from master. Never commit or push into master!  
```
### Mission 1 ###

Your mission is to create a new page.
On this page, you will show a title and a form to create a post and its metadata.
The goal is to submit the form and save in database a new post with name and content and a metadata witj key  'mymeta' and its value.
See the mockup : https://github.com/simplifia/simpli-wp-test-interview/blob/main/mockup.PNG

### Mission 2 ###

Create a block Gutenberg. 

```
# If you have problems we use node v20.10.0 and npm 10.2.3
cd /wp-content/plugins/simpli-wp-test-interview
npm i
cd src
npx @wordpress/create-block@latest --no-plugin
# choose dynamic
cd /wp-content/plugins/simpli-wp-test-interview
# Add register_block_type in simpli-wp-test-interview.php 
npm run start
```
You mission is to create a basic Gutenberg Block, in the administration side 
users can edit the text displayed in your block but by default it shows "Hello World".

In the front end when user click on your block, it reverse the text, "Hello World" become "dlroW olleH".
This feature must be accessible.

Bonus: in the administration users can change the background and the border of your block.

### Contribution guidelines ###
When you start working, please push an initial commit on a dedicated branch named with your own name and first name.  
After that, please push at least one commit every 30 minutes.  
When you are done, please create a Pull Request (https://help.github.com/articles/creating-a-pull-request-from-a-fork/)

#############################
### From Philippe Lavocat ###
#############################

Mission 1 : created folder & files :
simpli-wp-test-interview
-PostForm.php
-Modeles/PostModel.php
-Repositorys/PostRepository.php
-src/Controllers/PostController.php
-view/post-form.php