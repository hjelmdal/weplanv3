#!/bin/bash


branch=$(Build.SourceBranchName)
newrev=$(Build.SourceVersion)

tmp=/home/jjahmusi/temp_deploy/$branch

#Check whether this build should be deployed or not
    if [ -n "$branch" ] && [ "master" == "$branch" ]; then
        #Define target folder for LIVE
        working_tree="/home/jjahmusi/websites/weplan.dk/v3/live"
        backup="/home/jjahmusi/backup/weplan.dk/v3/live/"
        dependencies="/home/jjahmusi/deployment/websites/weplan.dk/v3/live"

    elif [ -n "$branch" ] && [ "dev" == "$branch" ]; then
        #Define target folder for dev
        working_tree="/home/jjahmusi/websites/weplan.dk/v3/dev"
        backup="/home/jjahmusi/backup/weplan.dk/v3/dev"
        dependencies="/home/jjahmusi/deployment/websites/weplan.dk/v3/dev"

elif [ -n "$branch" ] && [ "qa" == "$branch" ]; then
        #Define target folder for qa
        working_tree="/home/jjahmusi/websites/weplan.dk/v3/qa"
        backup="/home/jjahmusi/backup/weplan.dk/v3/qa"
        dependencies="/home/jjahmusi/deployment/websites/weplan.dk/v3/qa"


    else
        echo "   /=================================="
        echo "   | No proper branch is active for deployment"
        echo "   \=================================="
    fi

if [ "master" == "$branch" ] || [ "dev" == "$branch" ] || [ "qa" == "$branch" ]; then

       echo "   /=================================="
       echo "   | Welcome to Pixel8 deployment"
       echo "   | DEPLOYMENT STARTED"
       echo "   | Target branch: $branch"
       echo "   | Target folder: $working_tree"
       echo "   | Revision     : $newrev"
       echo "   \=================================="

       if [ ! -d "temp_deploy" ]; then
       mkdir -p temp_deploy
       echo "   /=================================="
       echo "   | Temporary folder created..."
       echo "   \=================================="
fi

       cd temp_deploy


       if [ ! -d "$backup" ]; then
         mkdir -p $backup
         echo "   /=================================="
         echo "   | Backup folder created..."
         echo "   \=================================="
       fi

       #Copy production version into backup folder
       #cp -rf $working_tree $backup


       #mkdir -p $working_tree

       #Deploy build to temporary folder
       echo "   /=================================="
       echo "   | Deploying and compiling new build to server..."
       echo "   \=================================="


       if [ ! -d "$tmp" ]; then
            mkdir -p $tmp
       fi

cd $tmp
if [ "master" == "$branch" ]; then
git clone -b master https://hjelmdal:qfolklz73jxxkzwtqmk5bk7al6saajepvzgnthst5qesbicml2da@hjelmdal.visualstudio.com/WePlan/_git/WePlanV3 .
elif [ "dev" == "$branch" ]; then
git clone -b dev https://hjelmdal:qfolklz73jxxkzwtqmk5bk7al6saajepvzgnthst5qesbicml2da@hjelmdal.visualstudio.com/WePlan/_git/WePlanV3 .
elif [ "qa" == "$branch" ]; then
git clone -b qa https://hjelmdal:qfolklz73jxxkzwtqmk5bk7al6saajepvzgnthst5qesbicml2da@hjelmdal.visualstudio.com/WePlan/_git/WePlanV3 .
fi



       echo "   /=================================="
       echo "   | Copying dependencies to folder..."
       echo "   \=================================="
       #Run composer to install/update vendor folder
       cp -rfv $dependencies/* $tmp
       cp -rfv $dependencies/.env $tmp

cd $tmp && composer install --ignore-platform-reqs && php artisan migrate --force

cd $tmp && php artisan db:seed

 echo "   /=================================="
       echo "   | Building frontend assets"
       echo "   \=================================="


       npm install
       npm run production



       echo "   /=================================="
       echo "   | Frontend assets builded successfully"
       echo "   \=================================="

       rm -rf .git
       rm -rf theme
       rm -rf node_modules
       rm -rf setup

       #Remove old backup
       rm -rfv $backup

       #Move Production into backup
       echo "   /=================================="
       echo "   | Syncronizing new build into production..."
       echo "   \=================================="


       mv -v $working_tree $backup

       #Move temporary folder into production
       mv -v $tmp $working_tree

       #Copy system files not in repo back to production
       echo "   /=================================="
       echo "   | Deploying user generated content back to production..."
       echo "   \=================================="
       #cp -rf $backup/storage/ $working_tree/
       #cp -rf $backup/updates/ $working_tree/
       cp -rfv $backup/storage/app $working_tree/storage
       cp -rfv $backup/storage/framework/sessions $working_tree/storage/framework
       cd $working_tree && php artisan storage:link && php artisan optimize && composer dump-autoload


       #Cleanup and remove temporary folder
       echo "   /=================================="
       echo "   | Cleaning up temporary build process..."
       echo "   \=================================="

       rm -rf $tmp



       echo "   /==================================="
       echo "   | DEPLOYMENT COMPLETED SUCCESSFULLY"
       echo "   | Target branch: $branch"
       echo "   | Target folder: $working_tree"
       echo "   | Revision     : $newrev"
       echo "   \==================================="

       #Put the revision number into version file
       echo "$newrev" > $working_tree/deploy_version.txt

    fi
