server {
	listen   80; ## listen for ipv4; this line is default and implied
	root /san/static/pundiamalsctv.com/;
	index index.html index.htm index.php;

	server_name static.pundiamalsctv.com; 

	location / {
		try_files $uri $uri/ /index.php;
	}

	location ~ \.php$ {
		fastcgi_split_path_info ^(.+\.php)(/.+)$;
	#	# NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini
		fastcgi_pass unix:/var/run/php5-fpm.sock;
		fastcgi_index index.php;
		include fastcgi_params;
	}

}


