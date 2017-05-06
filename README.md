# tilang-report

1.composer install

2.copy isi file .env-example lalu buat file baru dengan filename ".env" (tanpa petik). Paste isi dari .env-example ke .env (create new file .env dilakukan di text editor)

3.php artisan key:generate

4.setting database di .env

5.php artisan migrate:refresh --seed

6.Untuk mengetahui perbedaan route api dan web laravel. Coba pastekan di browser. 
http://localhost:8000/api/postings (untuk API) 
http://localhost:8000/postings (untuk Web Laravel)
