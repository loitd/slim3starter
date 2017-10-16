# Slim Framework 3 Skeleton Full Application

## Edited by Loitd@config9.com
* Based on Slim 3 Skeleton
* Add twig-view
* Controller structure with BaseController
* Models, Database with Eloquent
* Template views with Bootstrap
* Auth (Register/Login) forms with Respect/Validation
* CSRF protect implemented
* Guest & Authenticated middlewares to process url
* Active nav pill to gui using twig

Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application.

    php composer.phar create-project slim/slim-skeleton [my-app-name]

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can also run this command. 

	php composer.phar start

Run this command to run the test suite

	php composer.phar test

That's it! Now go build something cool.
