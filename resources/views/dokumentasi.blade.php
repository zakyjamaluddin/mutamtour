<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi Aplikasi Mapping Mutamtour</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <!-- Tailwind CSS untuk tampilan modern dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            background-color: #f0f4f8;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 24px;
        }
        .card {
            background: #ffffff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 32px;
        }
        h1 {
            border-bottom: 4px solid #f74605;
            padding-bottom: 16px;
        }
        h2 {
            color: #1f2937;
            border-left: 4px solid #6b6b6bff;
            padding-left: 12px;
            margin-top: 24px;
            margin-bottom: 16px;
        }
        h3 {
            color: #4b5563;
            margin-top: 16px;
        }
        .screenshot {
            max-width: 100%;
            height: auto;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-top: 15px;
            display: block;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        .screenshot-caption {
            text-align: center;
            font-style: italic;
            margin-top: 8px;
            color: #6b7280;
            font-size: 0.9rem;
        }
        .benefit-list li {
            padding: 4px 0;
        }
        .role-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-right: 8px;
        }
        .admin-feature {
            background-color: #fef3c7; /* yellow-100 */
            color: #b45309; /* amber-700 */
            border: 1px dashed #fcd34d; /* amber-300 */
            padding: 8px;
            border-radius: 6px;
            margin-top: 10px;
        }
    </style>
</head>
<body class="p-4 md:p-8">
    <div class="container">
        <header class="flex flex-col md:flex-row md:justify-between md:items-center mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-800">Dokumentasi Aplikasi Mapping Mutamtour</h1>
                <p class="text-lg text-gray-600 mt-2">Sistem Informasi Terpusat untuk Manajemen Jamaah, Paket, dan Keberangkatan Umroh.</p>
            </div>
            <a href="/admin/login" class="bg-orange-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-orange-700 transition duration-300 whitespace-nowrap self-start md:self-auto">
                Login Aplikasi
            </a>
        </header>

        <div class="card">
            <h2 class="text-2xl font-bold">Pengantar Aplikasi & Hak Akses Pengguna</h2>
            <p class="text-gray-700 mt-4">Aplikasi Mapping Mutamtour dirancang dengan sistem hak akses (Role-Based Access Control) untuk membedakan fungsi antara peran Admin (Pusat) dan Staff/Cabang.</p>
            
            <h3 class="text-xl font-semibold mt-4 text-orange-600">Perbedaan Hak Akses Kunci</h3>
            <ul class="list-disc pl-5 text-gray-700 benefit-list">
                <li><strong>Staff/Cabang</strong>: Fokus pada pencatatan data jamaah baru, pembaruan status kelengkapan dokumen, dan mencatat pembayaran jamaah yang berada di bawah kantor cabangnya. Tidak memiliki akses ke menu Pembayaran global.</li>
                <li><strong>Admin (Pusat)</strong>: Memiliki kontrol penuh (CRUD: Create, Read, Update, Delete) di semua menu, termasuk kemampuan membuat Group baru, mengubah Group jamaah, dan mengelola semua transaksi pembayaran melalui menu Keuangan.</li>
            </ul>
        </div>

        <div class="card">
            <h2 class="text-2xl font-bold">1. Dashboard</h2>
            <p class="text-gray-700 mt-4">Dashboard berfungsi sebagai pusat kendali dan pemantauan kinerja Mutamtour secara keseluruhan.</p>
            
            <h3 class="text-xl font-semibold mt-2 text-orange-600">Fungsi dan Manfaat (Sama untuk Admin & Staff)</h3>
            <ul class="list-disc pl-5 text-gray-700 benefit-list">
                <li>Ringkasan Cepat: Menampilkan total Group, Total Jamaah, dan Total Paket yang aktif.</li>
                <li>Analisis Tren Pendaftaran: Grafik Jamaah per Bulan membantu manajemen menganalisis musim puncak pendaftaran.</li>
                <li>Analisis Kinerja Cabang: Diagram lingkaran Jamaah per Kantor menunjukkan kontribusi cabang.</li>
            </ul>
            <img src="{{ asset('dokumentasi/dashboard.png') }}" alt="Dashboard Aplikasi Mutamtour" class="screenshot">
            <div class="screenshot-caption">Cuplikan Layar Dashboard: Ringkasan data kunci dan visualisasi statistik.</div>
        </div>

        <div class="card">
            <h2 class="text-2xl font-bold">2. Menu Group</h2>
            <p class="text-gray-700 mt-4">Menu ini adalah inti dari manajemen keberangkatan, mencatat jadwal spesifik yang terikat pada paket tertentu.</p>
            
            <h3 class="text-xl font-semibold mt-2 text-orange-600">Fitur Utama (Untuk Semua Peran)</h3>
            <ul class="list-disc pl-5 text-gray-700 benefit-list">
                <li>Manajemen Seat: Kolom Sisa Seat dikalkulasi secara otomatis.</li>
                <li>Navigasi Cepat: Baris group dapat ditekan untuk melihat detail Jamaah yang tergabung dalam group tersebut.</li>
            </ul>
            <img src="{{ asset('dokumentasi/group.png') }}" alt="Dashboard Aplikasi Mutamtour" class="screenshot">
            <div class="screenshot-caption">Cuplikan Layar Dashboard: Ringkasan data kunci dan visualisasi statistik.</div>
            <div class="admin-feature">
                <span class="role-badge bg-red-200 text-red-800">FITUR KHUSUS ADMIN</span>
                <p class="mt-2 font-bold">Tambah Group Baru</p>
                <p>Hanya Admin yang dapat membuat group keberangkatan baru. Ini dilakukan melalui pop-up modal yang meminta detail Paket, Total Seat, Vendor, Tour Leader, serta tanggal, bulan, dan tahun keberangkatan.</p>
                <img src="{{ asset('dokumentasi/group-tambah.png') }}" alt="Form Tambah Group Baru Admin" class="screenshot">
                <div class="screenshot-caption">Form Modal Tambah Group Baru (Hanya oleh Admin).</div>
            </div>
        </div>

        <div class="card">
            <h2 class="text-2xl font-bold">3. Menu Jamaah</h2>
            <p class="text-gray-700 mt-4">Menu untuk manajemen data detail setiap jamaah, dengan fokus pada status kelengkapan dokumen dan pembayaran.</p>
            
            <h3 class="text-xl font-semibold mt-2 text-orange-600">Fitur Utama (Tabel)</h3>
            <ul class="list-disc pl-5 text-gray-700 benefit-list">
                <li>Status Kelengkapan: Kolom Meningitis, Polio, Passport, dan Lunas (Status Pembayaran) ditandai dengan centang hijau (`✓`) jika sudah selesai.</li>
                <li>Unduh Dokumen: Aksi Unduh Rekomendasi Imigrasi tersedia pada baris data untuk membuat dokumen pendukung.</li>
            </ul>
            <img src="{{ asset('dokumentasi/jamaah-action.png') }}" alt="Aksi Ubah Group Jamaah" class="screenshot">
                <div class="screenshot-caption">Unduh Rekomendasi Imigrasi (Semua Akses)</div>

            <div class="admin-feature">
                <span class="role-badge bg-red-200 text-red-800">FITUR KHUSUS ADMIN</span>
                <p class="mt-2 font-bold">Akses dan Ubah data Jamaah</p>

                <p>Admin memiliki tombol titik tiga pada setiap baris data untuk aksi tambah pembayaran, ubah group, ubah data jamaah, hapus dan unduh rekomendasi imigrasi.</p>
                <img src="{{ asset('dokumentasi/jamaah-action-admin.png') }}" alt="Form Tambah Jamaah Baru Admin" class="screenshot mb-4">
                <div class="screenshot-caption">Form akses dan ubah data jamaah (Akses Penuh Admin).</div>
                <p class="mt-2 font-bold">Tambah Jamaah Baru & Ubah Group</p>
                <p>Admin memiliki tombol Tambah Jamaah (di header tabel) dan aksi Ubah Group pada setiap baris data. Staf/Cabang biasanya hanya memiliki hak untuk mengubah data dasar dan menambah pembayaran.</p>
                <img src="{{ asset('dokumentasi/jamaah-tambah.png') }}" alt="Form Tambah Jamaah Baru Admin" class="screenshot mb-4">
                <div class="screenshot-caption">Form Tambah Jamaah Baru (Akses Penuh Admin).</div>
                
                <img src="{{ asset('dokumentasi/ubah-group.png') }}" alt="Aksi Ubah Group Jamaah" class="screenshot">
                <div class="screenshot-caption">Modal Ubah Group Jamaah (Aksi Khusus Admin).</div>
                <p class="mt-2 font-bold">Aksi Pembayaran</p>
                <p>Aksi Tambah Pembayaran (melalui ikon titik tiga pada baris) dapat diakses oleh Admin maupun Staff/Cabang untuk mencatat transaksi keuangan:</p>
                <img src="{{ asset('dokumentasi/jamaah-tambah-pembayaran.png') }}" alt="Modal Tambah Pembayaran" class="screenshot">
                <div class="screenshot-caption">Modal Tambah Pembayaran (termasuk checkbox "Tandai jamaah ini sebagai lunas").</div>
            </div>

        </div>

        <div class="card">
            <h2 class="text-2xl font-bold">4. Detail Jamaah dan Riwayat Pembayaran</h2>
            <p class="text-gray-700 mt-4">Pada tampilan detail individual jamaah, terdapat tab atau bagian yang menunjukkan detail informasi jamaah dan seluruh riwayat pembayaran yang telah dicatat.</p>
            <img src="{{ asset('dokumentasi/detail-jamaah.png') }}" alt="Detail Jamaah dengan Riwayat Pembayaran" class="screenshot">
            <div class="screenshot-caption">Detail Jamaah: Riwayat Pembayaran dan Aksi Ubah/Hapus/Cetak Invoice.</div>
            
            <h3 class="text-xl font-semibold mt-2 text-orange-600">Fitur Riwayat Pembayaran</h3>
            <ul class="list-disc pl-5 text-gray-700 benefit-list">
                <li>Total Pembayaran: Menampilkan akumulasi total uang yang telah dibayarkan jamaah.</li>
                <li>Riwayat Transaksi: Daftar transaksi (Tanggal, Jenis, Jumlah, Keterangan).</li>
                <li>Aksi Transaksi: Terdapat aksi Ubah dan Hapus (khusus Admin) serta Cetak Invoice pada setiap transaksi pembayaran.</li>
            </ul>
            <img src="{{ asset('dokumentasi/detail-pembayaran.png') }}" alt="Detail Jamaah dengan Riwayat Pembayaran" class="screenshot">
            <div class="screenshot-caption">Detail Jamaah: Riwayat Pembayaran</div>
            <img src="{{ asset('dokumentasi/unduh-invoice.png') }}" alt="Detail Jamaah dengan Riwayat Pembayaran" class="screenshot">
            <div class="screenshot-caption">Detail Jamaah: Unduh Invoice.</div>
        </div>

        <div class="card">
            <h2 class="text-2xl font-bold">5. Menu Keuangan: Pembayaran</h2>
            <div class="admin-feature bg-blue-100 border-blue-300 text-blue-800">
                <span class="role-badge bg-blue-200 text-blue-800">MENU KHUSUS ADMIN</span>
                <p class="mt-2 font-bold">Akses Global Transaksi Pembayaran</p>
            </div>
            <p class="text-gray-700 mt-4">Menu ini hanya dapat diakses oleh Admin (Pusat) dan berfungsi sebagai jurnal pusat untuk semua transaksi pembayaran dari seluruh jamaah Mutamtour.</p>
            
            <h3 class="text-xl font-semibold mt-2 text-orange-600">Fungsi dan Manfaat</h3>
            <ul class="list-disc pl-5 text-gray-700 benefit-list">
                <li>Jurnal Pusat: Menyajikan daftar transaksi pembayaran terbaru dari seluruh cabang.</li>
                <li>Audit dan Rekonsiliasi: Memudahkan tim keuangan untuk mengaudit dan merekonsiliasi penerimaan dana secara global.</li>
                <li>Pencarian Global: Data dapat dicari berdasarkan Nama Jamaah atau Keterangan transaksi.</li>
            </ul>
            <img src="{{ asset('dokumentasi/pembayaran.png') }}" alt="Menu Pembayaran Admin" class="screenshot">
            <div class="screenshot-caption">Menu Pembayaran (Global) yang hanya dapat diakses oleh Admin.</div>
        </div>
        
        <footer class="text-center mt-12 pt-6 border-t border-gray-300">
            <p class="text-gray-600 text-sm">Dokumentasi ini dibuat untuk Aplikasi Mapping Mutamtour. Semua cuplikan layar adalah representasi UI dari sistem.</p>
        </footer>

    </div>
</body>
</html>
