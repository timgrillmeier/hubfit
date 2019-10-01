#!/bin/bash

### Variables ###

version='v0.1.0'
year='2019'

# Terminal Colours
red='\033[0;31m'
green='\033[0;32m'
yellow='\033[0;33m'
blue='\033[0;34m'
magenta='\033[0;35m'
cyan='\033[0;36m'
grey='\033[0;90m'
none='\033[0m'

red_bold='\033[1;31m'
green_bold='\033[1;32m'
yellow_bold='\033[1;33m'
blue_bold='\033[1;34m'
magenta_bold='\033[1;35m'
cyan_bold='\033[1;36m'
grey_bold='\033[1;90m'


### Colophon ### 

printf '\n\n'
printf "${green_bold}Build Kit ${version}${none}\n"
printf 'A Wordpress project boilerplate for the Orange Digital development team.\n'
printf "${grey}Copyright (c) ${year} Orange Digital.${none}\n\n\n"


### Input ### 

# Set project name
printf "${green}?${none} Choose a name for your project:\n"
printf "${grey}This should be the abbreviated name of your project. It will be used to name the\n"
printf "theme folder and other project files. One word, lowercase, hyphens allowed.${none}\n\n"

read input

printf '\n'

project_id=`echo $input | awk '{print tolower(substr($0,1,1))substr($0,2)}'`
project_name=`echo $project_id | awk '{print toupper(substr($0,1,1))substr($0,2)}'`

# Set project name
printf "${green}?${none} Set the password:\n"
printf "${grey}Make it strong, keep it secure.${none}\n\n"

read password

printf '\n'

printf 'This may take a while, hang tight ...\n\n'


### Substitutions ###

printf "make substitutions  ${grey}...${none} "

# Change .lando.yml
sed -E -i '' 's/(name: ).*$/\1'$project_id'/' .lando.yml

# Change theme folder
mv ./wp-content/themes/build-kit ./wp-content/themes/$project_id

# Change theme/resources/assets/config.json
sed -E -i '' 's/("publicPath": "\/app\/themes\/).*",$/\1'$project_id'",/' ./wp-content/themes/$project_id/resources/assets/config.json
sed -E -i '' 's/("devUrl": ").*",$/\1http:\/\/'$project_id'.lndo.site",/' ./wp-content/themes/$project_id/resources/assets/config.json

# Change theme/style.css
sed -E -i '' 's/(Theme Name: {1,10}).*$/\1'$project_name'/' ./wp-content/themes/$project_id/resources/style.css
sed -E -i '' 's/{{PROJECT}}/'$project_name'/' ./wp-content/themes/$project_id/resources/style.css
sed -E -i '' 's/(Text Domain: {0,10}).*$/\1'$project_id'/' ./wp-content/themes/$project_id/resources/style.css

# Change theme/package.json
sed -E -i '' 's/("name": ")build-kit(",)/\1'$project_id'\2/' ./wp-content/themes/$project_id/package.json

# Change all other file references
find ./wp-content/themes/$project_id/app -type f -exec sed -i '' "s/'build-kit'/'"$project_id"'/" {} \;
find ./wp-content/themes/$project_id/resources/views -type f -exec sed -i '' "s/'build-kit'/'"$project_id"'/" {} \;
sed -i '' "s/'build-kit'/'"$project_id"'/" ./wp-content/themes/$project_id/resources/functions.php;
sed -E -i '' 's=("template": "|"stylesheet": ").*(",)=\1'$project_id'\\\/resources\2=' ./wp-content/config/base.json;

printf "${green}done${none}\n"

### Dependencies ###
cd ./wp-content/themes/$project_id

printf "composer install    ${grey}...${none} "
if composer install > /dev/null 2>&1; then
    printf "${green}done${none}\n"
else
    printf "${red}error${none}\n"
fi

printf "yarn install        ${grey}...${none} "
if yarn > /dev/null 2>&1; then
    printf "${green}done${none}\n"
else
    printf "${red}error${none}\n"
fi

printf "lando start         ${grey}...${none} "
cd ../../../
if lando start > /dev/null 2>&1; then
    printf "${green}done${none}\n"
else
    printf "${red}error${none}\n"
fi

printf "configure wordpress ${grey}...${none} "
if lando wp core install --url=$project_id.lndo.site --title=$project_name --admin_name=orangedigital --admin_password=$password --admin_email=support@orangedigital.com.au > /dev/null 2>&1; then
    if lando wp plugin activate wp-cfm > /dev/null 2>&1; then
        if lando wp config pull base > /dev/null 2>&1; then
            printf "${green}done${none}\n"
        else
            printf "${red}error${none}\n"
        fi
    else
        printf "${red}error${none}\n"
    fi
else
    printf "${red}error${none}\n"
fi


### Fin ###

printf '\n'
printf "${green}Congratulations, you're good to go!\n${grey}Run the following commands to get started:${none}\n\n"

printf "${cyan_bold}cd ${cyan}wp-content/themes/${project_id}${none}\n"
printf "${cyan_bold}yarn start${none}\n\n"
