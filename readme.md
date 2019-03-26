## Welcome to WePlan V3 project


## Installation instructions

### Prerequisites
Composer: [https://getcomposer.org/download/](https://getcomposer.org/download/)
NPM and Node.js: [https://nodejs.org/en/download/](https://nodejs.org/en/download/)  
SSH-keys: [https://docs.microsoft.com](https://docs.microsoft.com/en-us/azure/devops/repos/git/use-ssh-keys-to-authenticate?view=azure-devops)
Sequel Pro (MAC): [https://www.sequelpro.com/](https://www.sequelpro.com/)
Docker (optional): [MAC](https://www.docker.com/community-edition) or [Windows](https://store.docker.com/editions/community/docker-ce-desktop-windows)
MAMP Pro (optional): [link](https://coming.soon)

### Instructions

 1. Download Docker installer [MAC](https://www.docker.com/community-edition) or [Windows](https://store.docker.com/editions/community/docker-ce-desktop-windows)
 2. ```Windows Only : Share your C drive in docker settings```  
 OR  
 1. Download MAMP Pro from here: [link](https://coming.soon)
 2. Setup new virtual server pointing to http://local.weplan.dk on port 80 with MYSQL pointing on Port 3306
####Run the following commands in your terminal in the project root folder  
__Before you can clone the project you need to setup a key pair and upload the public key to your profile in Azure DevOps - see instructions [here](https://docs.microsoft.com/en-us/azure/devops/repos/git/use-ssh-keys-to-authenticate?view=azure-devops)__
 3. ```git clone Hjelmdal@vs-ssh.visualstudio.com:v3/Hjelmdal/WePlan/WePlanV3 .```
 4. ```navigate to project root folder```  
 IF Docker is chosen  
 5. ```docker-compose run --rm composer install --ignore-platform-reqs```
 6. ```docker-compose up -d weplan database```
 7. ```copy .env.local and rename to .env```
 8. ```docker-compose run --rm artisan migrate```
 9. ```docker-compose run --rm artisan key:generate```
 10. ```Add local.weplan.dk to your hosts file```
 11. ```In terminal run: export DB_HOST=127.0.0.1 or add it to your .bashrc file to make it permanently ```  
 IF MAMP is chosen  
 5. Follow instructions here: [link](https://gist.github.com/irazasyed/5987693)
 6. ```Make MAMP Pro add local.weplan.dk to your hosts file```
 7. ```composer install --ignore-platform-reqs```
 8. ```copy .env.local and rename to .env```
 9. ```php artisan migrate```
### Ready to go!
 -Open [http://local.weplan.dk](http://local.weplan.dk) in your browser
 
 -Download Sequel pro for db handling: [link](https://www.sequelpro.com/)
 
### Frontend
If you need to change something in the front end, you will need npm and node [link](https://nodejs.org/en/download/)  
After installing Node / npm run the following in terminal to install webpack for Laravel:
```npm install```

We have Two main folders we add our css / js into:
```
resources/assets/js
resources/assets/sass 
```
When building these changes run:
```
npm run dev
or
npm run production (for minification)
```
Assets will now be bundled into the public folder and included in the theme
For theme components look into theme : [link](https://keenthemes.com/keen/preview/demo5/)
 

 ### If Logs are not accessible
 When logs not accessible - run in terminal:
```
    php artisan route:clear
    php artisan config:clear
    php artisan cache:clear
```
 
## Urls

| Tool   | Url                                                                             |
|----------|---------------------------------------------------------------------------------|  
| Git repo   | Hjelmdal@vs-ssh.visualstudio.com:v3/Hjelmdal/WePlan/WePlanV3                                          |
| Azure Devops   | https://hjelmdal.visualstudio.com/WePlan


## Pushing to Azure DevOps
 When pushing to Azure DevOps __always__ push to the dev branch, and open a merge request if things needs to go to QA or LIVE (in following order). In this way we can control what goes into the master branch, and optionally do a pair code review before accepting builds into the master branch.  
 Code being pushed to the dev branch in Azure DevOps will automatically build and deploy to [DEV](https://dev.v3.weplan.dk/) - you can always check the commit id in the footer of the website (not on local) - furthermore a Slack notification will go into [#weplan-devops](https://hjelmdal.slack.com/messages/CGDMNARBL/)
  
 

 For deploy to webserver there are three options - deploy to __DEV__, __QA__ or __LIVE__
 
### Deploy to DEV
 The DEV branch is our playground, and you can always push to that to test your code. Please keep in mind, that things being pushed to the webserver in any case should be expected to work relatively stable and only reveal things you could not test on your local environment (such as scheduled jobs and stuff)
 
for pushing to [DEV](https://dev.v3.weplan.dk/):
```
 git push origin dev 
```

### Deploy to QA
Open a merge request from a tested dev commit -> QA branch [here](https://hjelmdal.visualstudio.com/WePlan/_git/WePlanV3/pullrequestcreate)

### Deploy to LIVE
Open a merge request from a tested QA commit -> Master branch [here](https://hjelmdal.visualstudio.com/WePlan/_git/WePlanV3/pullrequestcreate)
 
 
## Test data
### Activities 
```
php artisan db:seed --class=ActivityTableSeeder
```
 
  
 ## Communication
 ### Slack
 Slack is main communication tool: [Slack](https://hjelmdal.slack.com)
 
        
