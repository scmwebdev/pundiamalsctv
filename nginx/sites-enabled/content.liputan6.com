server {
	listen   80; ## listen for ipv4; this line is default and implied
	root /usr/share/nginx/www/cms/;
	index index.html index.htm index.php;

	server_name content.liputan6.com;

	location / {
		try_files $uri $uri/ /index.php;
		allow 139.0.19.152/29;
                allow 117.102.83.232/29;
                allow 202.58.124.0/24;
                allow 192.168.7.0/24;
                #allow 127.0.0.1;
                deny all;

	}

	location ~ \.php$ {
		fastcgi_split_path_info ^(.+\.php)(/.+)$;
	#	# NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini
		fastcgi_pass unix:/var/run/php5-fpm.sock;
		fastcgi_index index.php;
		include fastcgi_params;

	}

}


