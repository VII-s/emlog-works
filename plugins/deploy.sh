DEPLOY=~/Workspace/php-code/emlog/content/plugins
SOURCE=~/Workspace/fun-code/emlog-works/plugins

PLUGIN_NAME=$1

rm -rf $DEPLOY/$PLUGIN_NAME
cp -r $SOURCE/$PLUGIN_NAME $DEPLOY/$PLUGIN_NAME

echo 'ALL IS OK'

