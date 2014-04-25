#/bin/bash

#global things
EMLOG_PLUGINS_PATH="/var/www/emlog/blog/content/plugins/"

while getopts r: folder
do
    case "$folder" in
        r)
            plugins_name=$OPTARG;;
        \?)
            echo 'USAGE: release -r folder';;
    esac
done

