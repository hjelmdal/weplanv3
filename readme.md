## Welcome to WePlan V3 project

### Installation instructions

 1. Download Docker installer [MAC](https://www.docker.com/community-edition) or [Windows](https://store.docker.com/editions/community/docker-ce-desktop-windows)
 2. ```Windows Only : Share your C drive in docker settings```
####Run the following commands in your terminal in the project root folder
 3. ```git clone git@gitlab.com:pixel8/weplan.dk.git```
 4. ```navigate to project root folder```
 5. ```docker-compose run --rm composer install --ignore-platform-reqs```
 6. ```docker-compose up -d weplan database```
 7. ```copy .env.sample and rename to .env```
 8. ```docker-compose run --rm artisan migrate```
 9. ```docker-compose run --rm artisan key:generate``` 
 10. ```Add local.weplan.dk to your hosts fil```
 11. ```Open http://local.weplan.dk in your browser```
 12. ```In terminal run: export DB_HOST=127.0.0.1 or add it to your .bashrc file to make it permanently ```
 
 ## Tips
 Add alias for commands:
 
 | Alias | OS | Command |
 |-------|----|---------|
 | artisan | Win | doskey artisan=docker-compose run --rm artisan $* |
 | docker-start | Win | doskey docker-start=docker-compose up -d weplan database |
 | docker-stop | Win | doskey docker-stop=docker-compose down |
 
 
 
## Git repos

| Remote   | Url                                                                             |
|----------|---------------------------------------------------------------------------------|  
| origin   | git@gitlab.com:pixel8/weplan.dk.git                                            |
| deploy   | ssh://jjahmusi@falk9.azehosting.net:33/home/jjahmusi/git/weplan.dk/weplanv2.git |

## Pushing to gitlab
 When pushing to gitlab __always__ push to the dev branch, and open a merge request. In this way we can control what goes into the master branch, and optionally do a pair code review before accepting builds into the master branch. 
 
## Deploy to webserver

 For deploy to webserver there are two options - deploy to __DEV__ or __LIVE__
 
### Deploy to DEV
 The DEV branch is our playground, and you can always push to that to test your code. Please keep in mind, that things being pushed to the webserver in any case should be expected to work relatively stable and only reveal things you could not test on your local environment (such as scheduled jobs and stuff)
 
for pushing to [DEV](https://dev.v2.weplan.dk/):
```
 git push deploy dev 
```

### Deploy to LIVE
 Only accepted merge requests in gitlab should be deployed to LIVE, as these are considered tested builds reviewed and ready for production. 

For pushing to [LIVE](https://v2.weplan.dk/): 
```
git push deploy master 
```
 
## Test data
### Activities 
```
php artisan db:seed --class=ActivityTableSeeder
```
 
  
 ## Communication
 ### Slack
 
        
