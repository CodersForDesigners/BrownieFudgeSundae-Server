
This document simply lists the things to do to get a server up and running on DigitalOcean with all the things.

- [ ] Spawn droplet on DigitalOcean
- [ ] Set locale settings
- [ ] Configure Apache
- [ ] Install nodeJS
- [ ] Install Cloud Commander
- [ ] Install PM2
- [ ] Setup our project deployment dashboard
- [ ] Adding a project

---

# Setup project deployment dashboard
On Cloud Commander, create a new folder called `dev` at the root.
Add this line to the .htaccess file, under the comment `# ADD NEW PROJECTS HERE`,
```
RewriteCond %{REQUEST_URI} !^/?dev/
```

Copy the files in the `Dev Dashboard` folder to the `dev` folder on the server through Cloud Commander. You can drag n' drop.

Then,
```
chmod 645 /var/www/dev/project-deploy.sh
```

Type this command on the server,
```
visudo
```
A file will open in a text editor. Add this to the end.
```
# Custom rules
www-data ALL = NOPASSWD: /var/www/dev/project-deploy.sh
```

# Adding a project
Whenever you're adding a new project, do these things.

Add this line to the .htaccess file, under the comment `# ADD NEW PROJECTS HERE`,
```
RewriteCond %{REQUEST_URI} !^/?project_name/
```
Replace `project_name` with the name of the folder where this project's files are going to be stored ( under `/var/www` ).

Access the Deployment Dashboard through the browser.

Input in the following fields,
- Project → the name of the folder where the project's files are to be stored
- Repository → the URL of the git repository where the project is stored
- Commit → the commit hash to use; defaults to the latest commit on the master branch
