#!/bin/bash

set -e
testDir="php-sdk-test"
GREEN="\033[0;32m"
NC="\033[0m"

if [ ! $PLIVO_API_PROD_HOST ] || [ ! $PLIVO_API_DEV_HOST ] || [ ! $PLIVO_AUTH_ID ] || [ ! $PLIVO_AUTH_TOKEN ]; then
    echo "Environment variables not properly set! Please refer to Local Development section in README!"
    exit 126
fi

cd /usr/src/app

echo "Setting plivo-api endpoint to dev..."
find /usr/src/app/src/Plivo -type f -exec sed -i "s/$PLIVO_API_PROD_HOST/$PLIVO_API_DEV_HOST/g" {} \;

composer install

if [ ! -d $testDir ]; then
    echo "Creating test dir..."
    mkdir -p $testDir
fi

if [ ! -f $testDir/test.php ]; then
    echo "Creating test file..."
    cd $testDir
    echo "<?php" > test.php
    echo "require '/usr/src/app/vendor/autoload.php';" >> test.php
    echo "use Plivo\\RestClient;" >> test.php
    echo -e "\n\n\$client = new RestClient();\n" >> test.php
    echo -e "\n\n?>" >> test.php
    cd -
fi

echo -e "\n\nSDK setup complete!"
echo "To test your changes:"
echo -e "\t1. Add your test code in <path_to_cloned_sdk>/$testDir/test.php on host (or /usr/src/app/$testDir/test.php in the container)"
echo -e "\t\tNote: To use sdk in test file, import using $GREEN require '/usr/src/app/vendor/autoload.php';$NC"
echo -e "\t2. Run a terminal in the container using: $GREEN docker exec -it $HOSTNAME /bin/bash$NC"
echo -e "\t3. Navigate to the test directory: $GREEN cd /usr/src/app/$testDir$NC"
echo -e "\t4. Run your test file: $GREEN php test.php$NC"
echo -e "\t5. For running unit tests, run on host: $GREEN make test CONTAINER=$HOSTNAME$NC"

# To keep the container running post setup
/bin/bash