# AdaptiveGallery
1.Description:
Implementation of an adaptive photo gallery model based on processor performance with photo scaling, metadata and watermarking algorithms
It is an application acting as a gallery of photos with watermarking algorithms, simple metadata support and an adaptive algorithms
that adjusts the operations of the application to client processor performance connecting to the server

2.Actions required for the proper operation of the application:

-Import of the included database
To ensure proper operation of the application, you need to import the included database called "users.sql", which contains default users with the following login data:
login password
admin admin
zwykly zwykly

-Editing php.ini on the server.
Due to the operation on a large number of files, it is recommended to increase the maximum execution time of the PHP script (max_execution_time),
the maximum number of uploaded files (max_file_uploads), the maximum size of uploaded files (upload_max_filesize),
and the maximum size of uploaded data via the POST method (post_max_size).

