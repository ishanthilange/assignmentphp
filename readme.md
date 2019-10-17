Installing Guide Lines ::: Assignment - 01

1) You need to copy the project into server's public access folder (in many cases it's the /var/www/html folder)
2) Configuration change in Nginx
	
	server {
    listen 80; // you can use your own port number
    server_name example.com; // server name (domain name)
    root /example.com/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
	
	}
	
3) Optimization by caching the routes and configurations
	go to the project folder and run bellow commands
	php artisan config:cache // cache the configurations
	php artisan route:cache // cache the routes
	
	!important:: if you are going to chage the configurations or routes in later, you need to clear the cache and cache again before use start the project.
	
4) Then go the the project folder and run bellow command to start the project.
	php artisan serve	
	



