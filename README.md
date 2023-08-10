# VehiManage

Aplikasi ini adalah sebuah platform pemesanan kendaraan yang dirancang untuk memudahkan proses pemesanan kendaraan dengan melibatkan tiga peran utama: Admin, Supervisor, dan Employee. Aplikasi ini juga dilengkapi dengan fitur dashboard untuk melihat grafik pemakaian kendaraan.

## Spesifikasi

-   PHP 8.1.10
-   MySQL Database
-   Laravel 10

## Fitur Utama

-   Pemesanan Kendaraan: Admin dapat membuat pemesanan kendaraan, memilih driver, memilih kendaraan, memilih penumpang yaitu employee.
-   Persetujuan Berjenjang: Persetujuan pemesanan dilakukan secara berjenjang oleh employee dan supervisor. Dengan dua tingkat persetujuan pertama dilakukan oleh pemesan atau employee setelah di aprove maka dilanjutkan aproval oleh supervisor atau atasa.
-   Status Pemesanan: User dapat melihat status pemesanan yang telah dibuat.
-   Dashboard dan Grafik: Admin dapat melihat informasi dan grafik pemakaian kendaraan.

## Akun

### Role

1. Admin
2. Supervisor
3. Employee

#### Admin

-   Email:intan.wibowo@example.com
-   Username:vkuswandari
-   Password:password

#### Supervisor

-   Email:hkusumo@example.com
-   Username:ihasanah
-   Password:password

#### Employee

-   Email:handayani.cecep@example.com
-   Username:parman76
-   Password:password

Note: Semua akun passwordnya sama yaitu "password"

## Cara Menggunakan

### 1. Admin

-   Masuk ke aplikasi menggunakan akun Admin.
-   Buat pemesanan kendaraan dengan mengisi detail seperti lokasi jemput, tujuan, dan lainnya.
-   Pilih driver yang akan melakukan pengantaran.
-   Pilih employee untuk persetujuan pemesanan.
-   Simpan pemesanan.

### 2. Supervisor

-   Setelah pemesanan dibuat, login menggunakan akun Supervisor.
-   Sebelum disetujui oleh supervisor, employee harus menyetujui terlebih dahulu.
-   Di halaman persetujuan, tinjau detail pemesanan dan setujui atau tolak.
-   Jika disetujui, pemesanan akan diteruskan ke Approver berikutnya.

### 3. Employee

-   Masuk ke aplikasi sebagai Employee.
-   Di halaman persetujuan, tinjau detail pemesanan dan setujui atau tolak, jika sudah tinggal menunggu aproval dari supervisor.
-   Lihat status pemesanan yang telah dibuat untuk mengetahui apakah sudah disetujui atau menunggu persetujuan.

### 4. Dashboard dan Grafik

-   Admin dapat mengakses halaman dashboard yang menampilkan grafik dan informasi mengenai pemakaian kendaraan.
-   Grafik dapat menampilkan data seperti jumlah pemesanan, jenis kendaraan yang paling sering digunakan, dan lainnya.

## Instalasi

1. Clone repositori ini ke direktori lokal Anda.
2. Salin berkas `.env.example` menjadi `.env` dan atur konfigurasi database.
3. Jalankan perintah `composer install` untuk menginstal dependensi.
4. Jalankan perintah `php artisan key:generate` untuk menghasilkan kunci aplikasi.
5. Jalankan migrasi database dengan perintah `php artisan migrate`.
6. Jalankan server dengan perintah `php artisan serve`.

## Catatan

Pastikan untuk mengganti instruksi di atas dengan langkah-langkah yang sesuai dengan lingkungan pengembangan Anda.

Dengan panduan ini, pengguna dapat dengan mudah mengakses dan menggunakan aplikasi pemesanan kendaraan dengan lancar. Semua peran akan memiliki akses yang sesuai dengan tugas dan tanggung jawab masing-masing.

## Physical Data Model

![Physical Data Model](/public/PhysicalModel2.png "Physical Data Model")
