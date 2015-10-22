server '192.168.33.200',
     roles: %w{web app db},
     user: 'vagrant',
     ssh_options: {
         password: fetch(:password)
     },
     cake_env: "production",
     app_config:'production.php',
     group: 'vagrant'