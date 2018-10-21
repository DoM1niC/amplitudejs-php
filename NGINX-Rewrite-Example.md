## NGINX Rewrite Rule Example

    location / {
    try_files   $uri $uri/ /player.php?$args;
	rewrite  ^/player(.*)/(.*)$   /player.php?folder=$1&id=$2  last;
    }