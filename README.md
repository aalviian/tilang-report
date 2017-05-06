# tilang-report

composer install

copy isi file .env-example lalu buat file baru dengan filename ".env" (tanpa petik). Paste isi dari .env-example ke .env (create new file .env dilakukan di text editor)

php artisan key:generate

setting database di .env

php artisan migrate:refresh --seed

Untuk mengetahui perbedaan route api dan web laravel. Coba pastekan di browser. http://localhost:8000/api/postings (untuk API) http://localhost:8000/postings (untuk Web Laravel)
