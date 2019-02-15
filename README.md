 - JIRA Plugin
 - bitbucket Plugin
 - SeriesMoco Plugin
 - Exchange Plugin
 
 
 xdebug.remote_enable=1
 xdebug.remote_port=9000
 xdebug.remote_autostart=1
 xdebug.idekey="PHPSTORM"
 xdebug.remote_host=172.17.0.1
 xdebug.max_nesting_level=1000
 memory_limit=2G
 max_execution_time=300
 
 export PHP_IDE_CONFIG="serverName=zed"
 
 
 apt-get install python-software-properties
 apt-get install -y software-properties-common
 add-apt-repository ppa:ondrej/php
apt-get install -y libxml2-dev
docker-php-ext-install soap
