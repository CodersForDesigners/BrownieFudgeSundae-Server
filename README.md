
Here, we explain the setup required on the servers' end to get your site (or sites) up and running.





# Motivating Example
Assume you are creating a website for a real-estate developer "The Examples".
Their website ( https://example.com/ ) has a listing of all their projects. Clicking on any of them takes you a website dedicated solely to that project.
For example, clicking on the project "Outstanding" takes you to Outstanding's website ( https://example.com/outstanding ).





# Directory Structure
The individual project websites are children to "XYZ"'s website.

This is how the directory structure on the server should be.

```
├── /var/www/ 			( document root )
    ├── html/ 			( XYZ's website, linking to all the projects )
    ├── outstanding/ 		( Outstanding's website will be stored here )
    ├── mediocurry/ 		( Mediocurry's website will be stored here )
    ├── not-bad-bad/ 		( Not Bad Bad's website will be stored here )
    ├── .....
    ├── code-repo/ 		( not to be exposed to the public )
    ├── media/ 			( contains all media assets, not to be exposed directly to the public )
    ├── xyz/ 			( not to be exposed to the public )
    └── .htaccess 		( this is responsible for URL routing )
```

The `.htaccess` file that enables this structure is in the `DocumentRoot` folder here in this repository. Copy that onto the `/var/www/` directory of your server.





# Apache
**Virtual hosting** is a mechanism by which we can host multiple websites on a single physical server. Apache has this feature.

By default, Apache has one virtual-host in operation.
We need to disable that one, and add our own.

There's a virtual-host config file ( in the `Apache` directory ) that you have to plonk at `/etc/apache2/sites-available/` on the server. You can rename it to whatever. Then,
```
a2dismod <default-virtual-host-config-file>	# what is already there in the folder
a2enmod <your-virtual-host-config-file>		# what you just put in
```

You can find the name of the default virtual-host configuration file at `/etc/apache2/sites-enabled/`.





# Routing
The `.htaccess` file routes incoming URLs like so:

1. If the URL starts with the project name ( for example, http://example.com/not-bad-bad/... ), that route is by default delegated to that project's folder.
2. If the URL starts with anything but a project name ( for example, http://example.com/stylesheets/... ), then the route is delegated to the `html` directory.

For example,
```
/ → /html/index.php
/css/style.css → /html/css/style.css

/not-bad-bad/ → /not-bad-bad/index.php
```

Each project folder _can_ have its own `.htaccess` file. A route that is delegated to the project folder is then further handled by this `.htaccess` file.





# Adding a new project
When a new project is to be hosted on the server, duplicate the line ( you'll know when you see it ) in the `.htaccess` file, and change the text to correspond to the folder name where this project's files will be stored.
