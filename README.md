 - JIRA Plugin
 - bitbucket Plugin
 - SeriesMoco Plugin
 - Exchange Plugin
 
 
debug.idekey="PHPSTORM"
xdebug.remote_enable=1
xdebug.remote_port=9009
xdebug.remote_autostart=0
;xdebug.remote_log=/tmp/xdebug.log
xdebug.remote_host=192.168.103.125
xdebug.max_nesting_level=1000
memory_limit=2G
max_execution_time=300

 
 export PHP_IDE_CONFIG="serverName=zed"
 export XDEBUG_CONFIG="remote_port=9009 remote_autostart=1"
 
 apt-get install python-software-properties
 apt-get install -y software-properties-common
 add-apt-repository ppa:ondrej/php
apt-get install -y libxml2-dev
docker-php-ext-install soap
