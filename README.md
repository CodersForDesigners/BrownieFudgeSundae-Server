
This repo consists of files that are to be placed on an actual production server environment.

# Directory Structure
This is applicable for multi-site project where you are hosting multiple websites that are children to a single parent website.

The following is a sample directory structure on the server that you should base your use-case on.

```
├── /var/www/ 			( document root )
    ├── html/ 			( parent website, linking to all the following projects )
    ├── project-one/ 		( code for Project One website will be stored here )
    ├── project-two/ 		( code for Project Two website will be stored here )
    ├── project-three/ 		( code for Project Three website will be stored here )
    ├── .....
    ├── code-repo/ 		( not to be exposed to the public )
    ├── media/ 			( not to be exposed to the public )
    ├── xyz/ 			( not to be exposed to the public )
    └── .htaccess 		( this is responsible for setting the URL routing )
```

The `.htaccess` file that enables this structure is in the `DocumentRoot` folder here in this repository. Copy that onto the `/var/www/` directory of your server.

Also, there's the virtual-host config file ( in the `Apache` directory here ) that you have to plonk in the `/etc/apache2/sites-available/` directory on the server. You can rename it to whatever. You enable this config by,
```
a2dismod <default-virtual-host-config-file>
a2enmod <your-virtual-host-config-file>
```

You can find the name of the default virtual-host config at `/etc/apache2/sites-enabled/`.

The `.htaccess` file performs the following routing:

If the URL starts with the project name, that route is by default delegated to that project's folder. If that project has its own `.htaccess` file, then it will take it from there, else it will default to Apache's static mapping.


If the URL starts with anything but either of the project names, then the route is delegated to the `html` directory.
For example,
```
/ → /html/index.(html|php)
/css/style.css → /html/css/style.css
```

## Adding a new project
When a new project is to be hosted on the server, duplicate the line ( you'll know when you see it ) in the `.htaccess` file, and change the text to correspond to the folder name where this project's files will be stored.
