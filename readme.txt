Czynności wymagane do poprawnego działania aplikacji:

1. Import dołączonej bazy danych
Do poprawnego działania aplikacji należy zaimportować dołączoną bazę danych users.sql, są tam utworzeni domyślni użytkowncy,
o nastepujących danych logowania:
login  hasło
admin  admin
zwykly zwykly


2. Edycja php.ini na serwerze. 
Ze względu na operowanie na dużej ilości plików zaleca się zwiększenie maksymalnego czasu
wykonywania się skryptu PHP (max_execution_time), maksymalnej liczby
przesyłanych plików (max_file_uploads), maksymalnego rozmiaru przesyłanych
plików (upload_max_filesize), maksymalnego rozmiaru przesyłanych danych metodą
POST (post_max_size).