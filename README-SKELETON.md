# Slim Skeleton for PHP 7

This is a sample application built with the Slim PHP Framework 3, targeting PHP
7+. This application will NOT run on PHP 5.x or lower.

## Installing

You can create a new project based on this application by entering the following
command, changing `your-project-name` to the name of the directory that you want
to be created and the application installed to:

```
composer create-project --stability=dev --no-interaction antnee/slim-skeleton-php7 your-app-name
```

## Docker

A Docker image is hosted on Gitlab for this project. You can get it and run it by
entering the following commands:
```
# docker pull registry.gitlab.com/antnee/slim-skeleton-php7:latest
# docker run -d --name myslimphp7sampleapp registry.gitlab.com/antnee/slim-skeleton-php7:latest
```

You will now have a running container called `myslimphp7sampleapp` running PHP 7.2 which you can
start and stop using that name.

### Other PHP version images

If you want to run an older version of PHP 7.x I have uploaded a couple of other images to the
registry which are also available for use:

#### PHP 7.2
```
# docker pull registry.gitlab.com/antnee/slim-skeleton-php7:7.2
# docker run -d --name myslimphp7sampleapp registry.gitlab.com/antnee/slim-skeleton-php7:7.2
```

#### PHP 7.1
```
# docker pull registry.gitlab.com/antnee/slim-skeleton-php7:7.1
# docker run -d --name myslimphp7sampleapp registry.gitlab.com/antnee/slim-skeleton-php7:7.1
```

#### PHP 7.0
```
# docker pull registry.gitlab.com/antnee/slim-skeleton-php7:7.0
# docker run -d --name myslimphp7sampleapp registry.gitlab.com/antnee/slim-skeleton-php7:7.0
```

## Configuration

This app is configured to use _Environment Variables_ to change parameters.
These have been set up in the `Dockerfile` and can be overridden if you wish.
The default settings are appropriate for development only. You should change
these if you plan to use your app in a production environment.

## More

Once you have the container up and running, more information can be found on the
homepage when you open it in your browser. Happy developing!