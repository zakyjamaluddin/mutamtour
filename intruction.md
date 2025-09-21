MAPPING ONLINE MUTAMTOUR
Sebuah aplikasi berbasis laravel filament untuk pencatatan data jamaah umroh. Aplikasi ini berfungsi untuk membantu travel umroh Mutamtour dalam kelola data jamaah, kelola pembayaran jamaah, kelola paket umroh dan kelola keberangkatan umroh agar semuanya serba online, dapat dilihat kapanpun dimanapun


Menu
Menu Paket
simple resource yang Berfungsi untuk mencatat macam-macam paket yang ada di Mutamtour. 
di menu paket ini bakal tampil tabel berisi data paket yang ada di Mutamtour, beserta berapa group dari paket ini, beserta berapa jamaah yang memilih group dari paket ini.
saya ingin, ketika baris dari data paket ditekan, akan menuju ke suatu halaman dimana halaman ini menampilkan group group yang menggunakan paket ini.

Menu Group
simple resource yang berfungsi untuk mencatat keberangkatan jamaah, by paket, dengan batas jamaah tertentu.
di menu group nantinya bakal tampil tabel berisi data group apa saja yang ada, berapa total seat nya, berapa sisa siat yang belum terisi (diintegrasikan dengan total seat dikurangi dengan berapa jamaah yang punya group ID ini, dikurangi 1 (untuk seat tour leader (karena tour leader tidak tercatat sebagai jamaah)))
saya ingin, ketika baris dari data group ditekan, akan menuju ke suatu halaman dimana halaman ini akan menampilkan data jamaah-jamaah yang memilih paket ini. diantaranya nama jamaah, nama kantor (diintegrasikan dengan kantor ID), status vaksin, status paspor dan status pembayaran. di halaman ini juga ada menu tambah jamaah baru.

Menu Kantor
simple resource yang berfungsi untuk mencatat data cabang mutamtour. 
di menu ini nantinya akan tampil berapa jamaah dari kantor ini, dilihat dari kantor ID yang ada di tabel jamaah

Menu Jamaah
berfungsi untuk mencatat data jamaah, di baris data pada tabel jamaah, tambahkan action untuk menambah data pembayaran yaa, berbentuk popup saja

Menu User


Menu Pembayaran
simple resource yang berfungsi untuk mencatat pembayaran jamaah, 
di menu ini nantinya akan tampil list data pembayaran yang ditambahkan terakhir, dengan nama jamaah yang searchable dan keterangan yang searchable. ketika menambahkan data pembayaran, ada input semacam checkbox atau mungkin radiobutton, dengan label (tandai jamaah ini sebagai lunas). jika ini di aktifkan, maka ketika data yang ditambahkan ini di submit maka juga akan mengubah kolom status pembayaran di tabel jamaah, menjadi true yang artinya lunas
Struktur tabel
Tabel Jamaah
ID : Primary Key
Nama : String
Alamat : String (nullable)
Kantor ID : foreign Key dari tabel Kantor
Tanggal Lahir : date  (nullable)
Nomor WA : string  (nullable)
Group ID : foreign key dari tabel group
Vaksin Meningitis (Sudah/Belum) : boolean, default false
Vaksin Polio (Sudah/Belum) : boolean, default false
Passport (Sudah/Belum) : boolean, default false
StatusPembayaran (Lunas/Belum Lunas) : boolean, default false

Tabel Paket
ID : primary key
Jenis (Haji/Umroh) : enum (select)
Nama : string
Durasi : integer, nanti di inputnya, dikasih suffix ‘hari’

Tabel Group
ID : primary key 
Paket ID : foreign key dari tabel Paket 
Tanggal : integer  (nullable)
bulan : integer
tahun : integer
Keterangan : string  (nullable)
Total Seat : integer
Vendor : string  (nullable)
Tour Leader : string  (nullable)

Tabel Kantor
ID : primary key
Nama : string

Tabel Pembayaran
ID : primary key
Jamaah ID : foreign key dari tabel jamaah
Jenis (DP, Vaksin Meningitis, Vaksin Polio, Passport, Biaya Umroh, Lainnya) : enum (select)
Jumlah : integer, nanti di inputnya dikasih prefix Rp.
Keterangan : string  (nullable)

Tolong buatkan juga seeder untuk setiap tabel

