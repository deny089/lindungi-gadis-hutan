-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 27 Apr 2017 pada 10.37
-- Versi Server: 10.0.30-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lindungihutan_dua`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `welcome_text` varchar(200) NOT NULL,
  `welcome_subtitle` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `result_request` int(10) UNSIGNED NOT NULL COMMENT 'The max number of shots per request',
  `status_page` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0 Offline, 1 Online',
  `email_verification` enum('0','1') NOT NULL COMMENT '0 Off, 1 On',
  `email_no_reply` varchar(200) NOT NULL,
  `email_admin` varchar(200) NOT NULL,
  `captcha` enum('on','off') NOT NULL DEFAULT 'on',
  `file_size_allowed` int(11) UNSIGNED NOT NULL COMMENT 'Size in Bytes',
  `google_analytics` text NOT NULL,
  `paypal_account` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `googleplus` varchar(200) NOT NULL,
  `instagram` varchar(200) NOT NULL,
  `google_adsense` text NOT NULL,
  `currency_symbol` char(10) NOT NULL,
  `currency_code` varchar(20) NOT NULL,
  `min_donation_amount` int(11) UNSIGNED NOT NULL,
  `min_campaign_amount` int(11) UNSIGNED NOT NULL,
  `payment_gateway` enum('Paypal','Stripe') NOT NULL DEFAULT 'Paypal',
  `paypal_sandbox` enum('true','false') NOT NULL DEFAULT 'true',
  `min_width_height_image` varchar(100) NOT NULL,
  `fee_donation` int(10) UNSIGNED NOT NULL,
  `stripe_secret_key` varchar(255) NOT NULL,
  `stripe_public_key` varchar(255) NOT NULL,
  `kode_pohon` varchar(10) NOT NULL,
  `hargapohon` int(15) NOT NULL,
  `max_campaign_amount` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `title`, `description`, `welcome_text`, `welcome_subtitle`, `keywords`, `result_request`, `status_page`, `email_verification`, `email_no_reply`, `email_admin`, `captcha`, `file_size_allowed`, `google_analytics`, `paypal_account`, `twitter`, `facebook`, `googleplus`, `instagram`, `google_adsense`, `currency_symbol`, `currency_code`, `min_donation_amount`, `min_campaign_amount`, `payment_gateway`, `paypal_sandbox`, `min_width_height_image`, `fee_donation`, `stripe_secret_key`, `stripe_public_key`, `kode_pohon`, `hargapohon`, `max_campaign_amount`) VALUES
(1, 'Lindungi Hutan', 'Lindungi hutan merupakan Platform dan Gerakan untuk membantu menjaga ekosistem Hutan Indonesia.', 'Gotong royong melindungi hutan Indonesia', 'Tunjukkan Kontribusi Anda !', 'lindungihutan, hutan, indonesia', 4, '1', '', 'lindungihutan23@gmail.com', 'lindungihutan23@gmail.com', 'on', 1024, '', 'harios1si@gmail.com', 'https://twitter.com/LindungiHutan', 'https://www.facebook.com/lindungihutan.org/', 'https://plus.google.com/', 'https://www.instagram.com/lindungihutan/', '<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n<ins class=\"adsbygoogle\"\r\nstyle=\"display:block\"\r\ndata-ad-client=\"ca-pub-4300901855004979\"\r\ndata-ad-slot=\"7623553448\"\r\ndata-ad-format=\"auto\"></ins> <script>(adsbygoogle=window.adsbygoogle||[]).push({});</script>', 'Rp', 'RP', 1, 1, 'Paypal', 'true', '800x400', 1, '', '', 'Pohon', 0, 4000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog`
--

CREATE TABLE `blog` (
  `id` int(11) UNSIGNED NOT NULL,
  `judul` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `isi` text NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `small_image` varchar(255) NOT NULL,
  `large_image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','pending') NOT NULL DEFAULT 'active',
  `token_id` varchar(255) NOT NULL,
  `goal` int(11) UNSIGNED DEFAULT NULL,
  `location` varchar(200) NOT NULL,
  `finalized` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 No 1 Yes',
  `id_pohon` int(11) NOT NULL,
  `hargapohon` int(15) DEFAULT NULL,
  `tanggal_pelaksanaan` date NOT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lng` varchar(50) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL,
  `youtube2` varchar(400) DEFAULT NULL,
  `tinggi` double(10,2) DEFAULT NULL,
  `diameter` double(10,2) DEFAULT NULL,
  `hidup` int(10) DEFAULT NULL,
  `mati` int(10) DEFAULT NULL,
  `petani` varchar(200) DEFAULT NULL,
  `jabatan_petani` varchar(200) DEFAULT NULL,
  `proyeksi` text,
  `perkembangan` double(10,2) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `goalhewan` int(11) DEFAULT NULL,
  `publish` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `campaigns`
--

INSERT INTO `campaigns` (`id`, `small_image`, `large_image`, `title`, `description`, `user_id`, `date`, `status`, `token_id`, `goal`, `location`, `finalized`, `id_pohon`, `hargapohon`, `tanggal_pelaksanaan`, `lat`, `lng`, `youtube`, `youtube2`, `tinggi`, `diameter`, `hidup`, `mati`, `petani`, `jabatan_petani`, `proyeksi`, `perkembangan`, `cat_id`, `goalhewan`, `publish`) VALUES
(36, '11489402811gokhe3osqtsrhcpnjplcsrp583wrnd5yegkdnkzv.jpg', '11489402811vyebbhyvcyols1nwnqydil3weehwxi2hkpzgena4.jpg', 'Aksi Cegah Abrasi Tambakrejo', 'Salam Sahabat Alam. Semoga selalu sehat dan menebar manfaat Kami, Lindungi Hutan, merupakan sebuah platform dan gerakan untuk membantu dan mendukung pelestarian ekosistem hutan di Indonesia. Hadirnya Lindungi Hutan berawal dari keresahan kami akan kondisi alam kita saat ini. Tahukan sahabat, bahwa seperti halnya manusia, dunia pun punya paru-paru? Dan salah satu paru-paru tersebut ada di Indonesia, tepatnya di Kalimantan. Bagaimana kondisi paru-paru kita saat ini? Berdasarkan data FAO tahun 2010, hutan dunia &ndash;termasuk didalamnya Indonesia&mdash;secara total menyimpan 289 gigaton karbon dan memegang peranan penting dalam menjaga kestabilan iklim dunia (wwf.or.id). <br><br>Hal yang membuat kita prihatin ialah melihat sedikitnya 1,1 juta hektar atau 2% dari hutan Indonesia menyusut tiap tahunnya. Data Kementerian kehutanan menyebutkan dari sekitar 130 juta hektar hutan yang tersisa di Indonesia, 42 juta hektar diantaranya sudah habis ditebang (Kementerian Kehutanan RI, dalam wwf.or.id). Karena itulah, Lindungi Hutan hadir sebagai salah satu penggerak dalam pelestarian ekosistem hutan Indonesia.<br><br><img src=\"https://4.bp.blogspot.com/-JrDrpKUx2wQ/WE1sZEsHVeI/AAAAAAAAC6c/ksxvV_fyXE0xFWhtR5OchDKf0iV2084dwCLcB/s320/IMG_20161016_143856.jpg\" alt=\"\" width=\"356\" height=\"267\"><br><br>Kampanye untuk melindungi alam menjadi sebuah cara yang kami lakukan untuk menjaga alam Indonesia yang luas nan indah ini. Pada setiap kampanye, kami memberikan kesempatan kepada partner (kelompok tani ??), pengguna (relawan), dan sponsor untuk ambil bagian dalam pelestarian lingkungan ini. Partner bertugas untuk penyediaan bibit dan melakukan kontrol terhadap pertumbuhan pohon. Pengguna dapat melakukan donasi dan penanaman pohon di tempat yang telah disediakan, begitu juga dengan sponsor. Lindungi Hutan menggunakan sistem yang dapat memberikan manfaat berupa monitoring terhadap rantai alur hasil donasi mulai dari pembibitan, penanaman, pemetaan tempat tanam, hingga efek yang dihasilkan dari pohon yang telah ditanam.<br><br>Laporan perkembangan dapat dilihat pada laman website lindungihutan.org. 3 hal yang menjadi fokus kami yakni penanaman pohon, pelestarikan hewan endemik Indonesia, dan menjaga ekosistem gunung. <br><br><img src=\"/public/img/logo.png\" alt=\"\" width=\"413\" height=\"124\"><br><br> Pada penanaman pohon kali ini, kami melakukan kerjasama dengan kelompok Camar (Cinta Alam Mangrove Arif dan Rukun) sebagai sebuah kelompok masyarakat yang bergerak di bidang lingkungan di Desa Tambak Rejo, Kelurahan Tanjung Emas, Semarang. Kelompok Camar merupakan binaan dari Pertamina dan Universitas Negeri Semarang. Lokasi ini sangat sesuai untuk melakukan aksi kampanye, dikarenakan kondisi lingkungan yang sangat memprihatinkan.<br><br>Abrasi yang kian meluas dan ditemukannya lokasi yang tidak memiliki batas antara daratan dan lautan, mengakibatkan banyak rumah penduduk yang tenggelam akibat naiknya air laut. Selain itu, beberapa penduduk tetap bertahan di rumah mereka dengan kondisi permukaan lantai/tanah yang ditinggikan untuk menjaga agar air laut tidak menenggelamkan rumah, sehingga kondisi rumah menjadi sangat rendah. <br><br><img src=\"https://2.bp.blogspot.com/-SzCcnfPXLBs/WE1sZkffgGI/AAAAAAAAC6g/nv__OdBGHgs5uCZuMe8s5I2X3M9dU3amACLcB/s320/IMG_20161105_093629.jpg\" alt=\"\" width=\"432\" height=\"324\"><br><br>Di lokasi yang dulunya dipakai sebagai lapangan sepak bola, kini hanya menjadi kenangan bagi mereka yang dulu pernah merasakannya. Lokasi ini sekarang menyatu dengan lautan pantai utara Pulau Jawa. Tak hanya sampai di situ, abrasi dan erosi yang terjadi menyebabkan rusaknya kondisi jalan yang ada pada Desa Tambak Rejo ini. Seperti yang diketahui, bahwa daerah Tanjung Emas terdapat sebuah pelabuhan yang dikenal dengan Pelabuhan Tanjung Emas. Pelabuhan yang langsung menghadap ke Laut Jawa ini merupakan jantung utama pusat perekonomian dan pengiriman melalui ekspedisi laut di Semarang. Maka, tidak heran jika banyak perusahaan industri yang berlokasi di sini. <br><br>Dengan banyaknya perusahaan yang membangun pabrik di Tanjung Emas, maka kawasan ini memiliki polusi udara yang tinggi. Menjadikan terganggunya keseimbangan antara industri dan lingkungan. Oleh sebab itu, melalui kampanye alam yang akan diselenggarakan pada tanggal 18 Desember 2016 nanti, kami mengajak para pecinta, pemerhati, dan sahabat alam semua untuk bergabung besama, memberikan kontribusi terbaik untuk kelestarian alam kita dalam bentuk donasi. Semoga kebaikan yang sahabat berikan dibalas dengan yang lebih baik lagi oleh-Nya. Anda dapat berdonasi atau gabung Aksi pada kampanye alam di Tanjung Mas ini.<br><br>Anda dapat berdonasi sebesar Rp 3.000,00/Pohon. Anda akan mendapatkan fasilitas dari donasi Anda berupa:<br><br>1. Certificate Digital Apreciate<br>2. Akses Monitoring Perawatan, Perkembangan dan dampak penanaman pada aplikasi \"Lindungi Hutan\"<br>3. Biaya perawatan tanaman selamanya<br>4. Pohon donasi Anda akan mendapatkan nama berdasarkan nama anda, anda dapat memantau lokasinya di aplikasi \"lindungi hutan\"<br><br> Keterangan : Baca aturan pengguna pada <a href=\"/page/sadasdasd1212\">klik</a>.<br><br>Donasi Anda dipergunakan untuk (Rp 3.000,00) :<br><br>1. Pembelian Bibit Mangrove<br><br>2. Perawatan Tanaman (Selamanya)<br><br>3. Pengembangan Platform Lindungi Hutan<br><br>4. Tenaga Survey Update perkembangan pohon yang dapat di akses di Platform Lindungi Hutan yang mana anda dapat memantau pertumbuhan pohon melalui aplikasi (selamanya). <br><br>Donasi anda akan membantu dalam pelestarian Ekosistem Hutan di Indonesia.', 1, '2016-12-11 08:44:21', 'active', 'zvWfssELPM4NkFkUzvGIDKdDd7xQiJCAiBPajAy61vtWOfT2tSiQRoBmvZeTINwDTeRo2xal5ahcTJCy0YVOSxwKKg4kibcSir6jvVrm9pQhYijyBeBMSuULfTa44Bi9k6gvFZKF98r3E8y9QM9bRBELn8GUlbqM8qbOE2jcvLCAEbTpIP0xzFhQULQcAVdGUU9MGwsD', 2000, 'Kelurahan Tanjung Mas Tambakrejo Semarang', '1', 1, 3000, '2016-12-18', '-6.93441987212095', '110.45874480830071', 'https://www.youtube.com/embed/D5BpPinRAJ8', 'https://www.youtube.com/embed/bjlN9vTlXlQ', 81.00, 0.50, 2102, 11, 'Pak Junaidi', 'Ketua Kelompok Petani Camar', 'Penanaman 2.113 pohon mangrove di Kawasan Konservasi Hutan Mangrove Tanjung Mas bertujuan untuk menciptakan ekosistem hutan mangrove yang dapat mengurangi abrasi dan erosi di 5 tahun kedepan.', 100.00, 1, NULL, '1'),
(37, '11489403810goolejyyylgf8llae1uutwkygyk6kl408pq8ensm.jpg', '11489403810gqywln2qidmlebf5bng9ndhityzdyjdfv6sllazj.jpg', 'Bantu Konservasi Mangkang', 'Area Konservasi hutan mangrove mangkang memang belum banyak yang mengenal kawasan ini, karena daerah ini belum di jadikan hutan mangrove ekoswisata. Dan untuk menyusurinya masih harus dengan melewati jembatan bambu tradisional dan rute perjalanan yang masih diatas tanah lembab dan akar pohon. <br><br><img src=\"https://4.bp.blogspot.com/-rOA369Clmdc/WFazs2rKDiI/AAAAAAAADM8/6EiYjtBM0m8LPPSYe20m3xgX4B3pnt5QQCLcB/s320/1796730_10200576996824567_568085605521473870_o%2Bcopy.jpg\" alt=\"\" width=\"619\" height=\"465\"><br><br>Namun keindahan dan potensinya tidak kalah bagus dibandingkan dengan kawasan mangrove lainnya. Area mangkang kami pilih sebagai daerah penanaman mangrove pada Kampanye Alam kali ini. <br><br>Hal ini bertujuan untuk meningkatkan ekosistem hutan mangrove di daerah mangkang. Sekaligus menunjang terbentuknya \"ekowisata\" hutan mangrove di wilayah ini. <br><br>Terdapat sebuah komunitas pecinta mangrove di daerah ini. Penggerak dan ketua komunitas (Bapak Suluri) dengan nama Komunitas Petani Mangrove Lestari ini telah berhasil memperkenalkan mangrove hingga ke Benua Amerika.<br><br>Di bawah asuhannya, hampir satu juta pohon telah tertanam.<br><br><img src=\"https://4.bp.blogspot.com/-01I_NBt5wFc/WFaxhORZLQI/AAAAAAAADM4/xhfy2PxUcuoU8rQrwsuQ404c-lY3Yrb4wCEw/s320/IMG_20161105_114431.jpg\" alt=\"\" width=\"623\" height=\"467\"><br><br>Namun, penanaman mangrove harus menjadi sebuah kegiatan berkelanjutan, yang harus dilakukan pemantauan, agar dampaknya bisa dirasakan, agar Semarang tetap hijau dan menghijaukan.<br><br>Oleh sebab itu, Lindungi Hutan kembali mengajak Sahabat Alam untuk berpartisipasi dalam penanaman mangrove pekan depan.<br><br><img src=\"http://1.bp.blogspot.com/-gZu5NiWdpVM/UINcrTL90dI/AAAAAAAAAGM/lTijaGC0v54/s1600/IMG_2666.JPG\" alt=\"\" width=\"620\" height=\"412\"><br><br> Kami tunggu kontribusimu sebagai donatur pohon atau gabung aksi penanaman mangrove dengan <br>target 1000 Mangrove.<br><br>Anda dapat berdonasi sebesar Rp 3.000,00/Pohon. Anda akan mendapatkan fasilitas dari donasi Anda berupa:<br><br>1. Certificate Digital Apreciate<br><br>2. Akses Monitoring Perawatan, Perkembangan dan dampak penanaman pada aplikasi \"Lindungi Hutan\"<br><br>3. Biaya perawatan tanaman selamanya<br><br>4. Pohon donasi Anda akan mendapatkan nama berdasarkan nama anda, anda dapat memantau lokasinya di aplikasi \"lindungi hutan\"<br><br>Keterangan : Baca aturan pengguna pada <a href=\"/page/sadasdasd1212\">klik</a>.<br><br>Donasi Anda dipergunakan untuk (Rp 3.000,00) :<br><br>1. Pembelian Bibit Mangrove<br><br>2. Perawatan Tanaman (Selamanya)<br><br>3. Pengembangan Platform Lindungi Hutan<br><br>4. Tenaga Survey Update perkembangan pohon yang dapat di akses di Platform Lindungi Hutan yang mana anda dapat memantau pertumbuhan pohon melalui aplikasi (selamanya). <br><br>Donasi anda akan membantu dalam pelestarian Ekosistem Hutan di Indonesia.', 1, '2016-12-18 08:43:28', 'active', 'k77t7oOA08H8rLJk6DOFEIfLrcN4Kv5Kma2z047yYYysrTA65gSpNGBUkZwhFhFAFDvji0BMYhQPSGmBHaOlZLlgSk5Q1KO8bM8EKXMD8b5xGD6rL9iUSqnjE2hGSmNmDRzva1PLTu5mvakYgGHFSLPH0ifHuQQGgRuEnnXGCy5Fkr7Dk91BLhsVm5YJADWZOMlSurnI', 1000, 'Pantai Mangkang', '1', 1, 3000, '2016-12-31', '-6.944303297403686', '110.32210235224602', 'https://www.youtube.com/embed/UmTZ4MWLOqQ', 'https://www.youtube.com/embed/bQTWOtqhilU', 50.00, 0.50, 730, 0, 'Pak Sururi', 'Ketua Kelompok Petani Lestari ', 'Penanaman 730 pohon mangrove bertujuan untuk menciptakan Ekosistem Hutan Mangrove di daerah Mangkang Semarang dengan periode besar tumbuh mangrove 9-10 Tahun lagi.', 100.00, 1, NULL, '1'),
(40, '11489404850q1yr7uceknznseu1zabouvndtdhsqmjpq7mt75j6.jpg', '11489404850xalbqrshdpffms9irebffbawetav7n3okn5axvml.jpg', 'Pohon untuk Mata Air', 'Desa wates merupakan desa yang terletak di tenggara gunung prau. Desa dengan pemandangan pegunungan yang elok dan juga masyarakatnya yang ramah membuat desa ini menjadi destinasi menarik untuk di kunjungi. Tapi sayangnya masalah ketersediaan mata air menjadi permasalahan utama penduduk desa ini. Apalagi pada musim kemarau. Penduduk memanfaatkan lubang tadah hujan dan juga pipa -pipa air untuk disalurkan ke mata air yang jauh di atas pemukiman warga.<br><br> Penanaman pohon merupakan salah satu solusi dalam membuat mata air di desa ini. Beberapa pengiat alam dan juga organisasi merencanakan untuk menanam 500 pohon di desa wates. Kegiatan kampanye alam penanaman 500 pohon non profit di bukit larikan desa wates temanggung. Kegiatan ini di lakukan oleh beberapa organisasi dan pecinta alam di Indonesia. Kegiatan ini dilakukan pada tanggal 28-29 Januari 2017. <br><br>Kegiatan ini diselenggarakan oleh PALASI, IAPP, PERUM PERHUTANI KPH KEDU UTARA, Mbah Basri, Pengurus Basecamp Kenjuran, Sar Macan Gunung Prau, Indosiar dan Lindungi Hutan. Tujuan dari penanaman pohon ini adalah menciptakan mata air bagi penduduk desa wates. Mata air tersebut dapat digunakan penduduk untuk pengairan ataupun kebutuhan keseharian penduduk di desa wates.', 1, '2017-01-31 09:19:44', 'active', 'H2EAnUjs8jCMdQm7mmv5qgyqPU1FAkM0lwYmX1M5JTDBlbHDfRICuvaMFdgjhH0nRy5WbzRblcpAfMKGsTiMCkE8cd6EeBkB4ugvG55Zya4kkcccgVmMBeTNRcRIzJwbbs7WWry1LNjJzziassEFoJeipF51AVueJLc5dEDQvZMSpiiDXuCvwBSgokQ68jzv9HbM6W2v', 500, 'Bukit Larikan Desa Wates Temanggung Jawa Tengah', '1', 7, 15000, '2017-01-28', '-7.289068655242656', '109.7442901574218', 'https://www.youtube.com/embed/zoRS2w4Gsqc', 'https://www.youtube.com/embed/HCoQLSS56js', 40.00, 0.30, 500, 0, 'Gravita Eka Purnama', 'Koordinator Pengelola Basecamp Wates Gunung Prau', 'Pohon yang tertanam diharapkan dapat membantu dalam menciptakan mata air di desa wates temanggung Jawa Tengah.', 100.00, 1, NULL, '1'),
(41, '11489405437e2itzstrfywetqnohlh69w4mkglqneg2c1mfymm0.jpg', '11489405437txyl4cvm5pgnhzn1qlyqbw6m15s3zkw2yxgftlkp.jpg', 'Penghijauan Gunung Prau', 'Jalur pendakian Gunung Prau melalui dusun Wagir Bawang merupakan jalur baru yang tak kalah menarik (dibanding Patak Banteng). Jalur ini dimulai dari Dusun Wates, Kecamatan Wonoboyo, Kabupaten Temanggung dengan ketinggian 1.896 meter di atas permukaan laut (mdpl) dengan panjang jalur pendakian 4,7 kilometer.<br><br>Desa wagir bawang sendiri terdiri dari 2 dusun 2 RW 8 RT dan terdapat 320 rumah tangga. jumlah penduduk mencapai 957 jiwa, pada umumnya penduduk menggantungkan kehidupannya melalui bertani baik kentang, jagung, sawi dan kubis. Akan tetapi perubahan mulai terjadi akibat kebakaran hutan di gunung prau pada 17 november 2015 yang mengakibatkan kekeringan.<br><br>Kebakaran ini menyebar hingga 35 hektar lahan di empat titik lokasi yakni : Kasur, Dukuh Blijo Sawen Desa Sidoharjo, Tomengan Mojotengah kecamatan Reban dan di daerah Pranten. Usaha yang saat ini dilakukan ialah membangun saluran air melalui pipa2 saluran air yang diharapkan dapat mengalirkan air ke sawah2 penduduk. Oleh sebab itu, Lindungi Hutan kembali mengajak Sahabat Alam untuk berpartisipasi dalam penanaman pohon pada 25- 26 Februari 2017 mendatang. <br><br>Penghijauan di Desa Wagir bawang ini penting dilakukan mengingat pentingnya pemulihan ekosistem dan pembentukan sumber mata air untuk 957 jiwa penduduk desa Wates yang pada umumnya berprofesi sebagai petani. <img src=\"http://assets.kompas.com/data/photo/2014/05/28/1744013EI-DIENG-Setiap-pagi-petani-Dieng-mendaki-bukit-menuju-ladang-kentang-foto-Anjas-Prawioko-s780x390.jpg\" alt=\"\" width=\"780\" height=\"390\"><br> Harapannya semoga langkah kecil ini dapat memberikan kontribusi tidak hanya untuk saat ini tetapi untuk masa depan mendatang.<br><br>Kami tunggu kontribusi anda sebagai Donatur Pohon atau Gabung Aksi penanaman pohon keras nonprofit dengan<br>target 2000 pohon.<br><br>Anda dapat berdonasi sebesar Rp 15.000/Pohon.Donasi anda akan dipergunakan untuk : <br><br>1. Pembelian bibit tanaman keras non profit<br>2. Biaya Perawatan tanaman selamanya<br>3. Pembelian Tonggak penyangga pohon<br>4. Biaya pencomplongan untuk tempat penanaman<br>5. Pengembangan platform lindungi hutan<br>6. Biaya operasional penyelenggaraan acara tanggal 25-26 Februari 2017<br><br>Pohon yang ditanaman adalah pohon keras non profit, antara lain : <br>1. Cemara Gunung<br>2. Cemara Bitani<br>3. Cantigi<br>4. Trembesi<br>5. Beringin<br>6. Tanaman keras non profit<br><br><img src=\"data:image/jpeg;base64,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\" alt=\"\" width=\"476\" height=\"427\"><br><strong>Bibit Cemara Gunung</strong><br><br><img src=\"http://1.bp.blogspot.com/-mJ1OvihoS_w/Ufpt-SySZkI/AAAAAAAAAW4/TC0PURE5Q_g/s1600/jual-bibit-trembesi-di-palembang-1.jpg\" alt=\"\" width=\"475\" height=\"298\"><br><br><strong>Bibit Trembesi</strong> <br><br>Anda dapat melakukan pemantauan perawatan dan perkembangan donasi tanaman anda melalui aplikasi Lindungi Hutan. Aplikasi dapat di download di google play atau akses di www.lindungihutan.org<br><br>Mari kita bergotong royong dalam menjaga ekosistem hutan di Indonesia !! <br><br>Bersama Lindungi Hutan', 1, '2017-01-31 23:14:35', 'active', 'eVhXAjdTlFp00hcjGO2lC8Nn5SfujSKaHTx5LnSKgULuiNuB9xqhvRDnVFXEa8ztPZGoShyMfxXiRLkOWRW3lRK1NC4c5AO56Z6yKpUtJuTQ1Sz2Hg1RXBEtIUGhbVUZ4Za5O8tOxLUn3iwNQiJoUkyNp7JZevRGfDGXppoalzZyVVy6c9y31J7AEZYt45jzwnKM1bb6', 2000, 'Jalur Pendakian Desa Wagir Bawang Temanggung', '1', 7, 15000, '2017-02-25', '-7.18484882647802', '109.99766234980461', 'https://www.youtube.com/embed/Pj5-bqXWal0', 'https://www.youtube.com/embed/SzadPvLmd4s', 80.00, 0.40, 69, 0, 'SAR Macan Prau', 'SAR Macan Prau', 'Pohon tumbuh di hutan lindung gunung prau.', 100.00, 1, NULL, '1'),
(42, '114899927402yfycpf7qzd8fmrgrh9gn9a2wfri8o6pgt75thna.png', '11489992740z6iegeaz4zqpfcwo7zvqnpufccks1icsh838liwi.png', 'Pantai Tirang yang Hilang', '<strong>Pantai tirang </strong>memang rasanya cukup jarang terdengar di telinga masyarakat sebagai salah satu bagian destinasi wisata di Semarang. Pantai ini berada tidak jauh dari Pantai Marina (beseberangan dengan Pantai Maron). Lebih tepatnya lagi pantai satu ini berlokasi di Desa Tambakrejo, kecamatan Tugurejo, Semarang. <strong><br></strong>Pantai Tirang memberikan panorama keindahan yang sangat khas dari deretan tambak dan mangrove yang berjajar rapi di tepian tambaknya yang mampu memanjakan mata.<br><br><img src=\"/public/img-campaign-desc/img_20120831_211659.png\" width=\"471\" height=\"353\"><br><br>Apa yang menarik di pantai tirang ??<br><br>Meskipun jika dibandingkan dengan Pantai Maron, pantai yang satu ini tergolong cukup memilukan.<br><img src=\"/public/img-campaign-desc/img_20120831_2157051.png\" width=\"477\" height=\"358\"><br><br>Masalah abrasi dan erosi telah membuat sebagian bibir pantai ini hilang. Jika dibiarkan terus , pantai ini akan hilang karena tergerus oleh air laut. Berikut penampakan pantai tirang jika di lihat melalui google map : <img src=\"/public/img-campaign-desc/pantai_tirang_semarang.jpg\" width=\"579\" height=\"311\"><br><br><img src=\"/public/img-campaign-desc/pantaitirang2.png\" width=\"580\" height=\"238\"><br><br>Beberapa pohon cemarat laut tumbuh subur di pantai ini.<br><br><img src=\"/public/img-campaign-desc/IMG_9531.png\" width=\"504\" height=\"335\"><br><br>Beberapa penjual disini mengeluhkan sepinya pengunjung di Pantai Tirang dan juaga masalah alam yang terjadi di sekitar pantai tirang. Terlebih lagi ekosistem di pantai ini yang semakin hari -semakin memburuk.<br><br><img src=\"/public/img-campaign-desc/IMG_9505.png\" width=\"483\" height=\"321\"><br><br>Penanaman mangrove di sekitar pantai tirang , lebih tepatnya di area konservasi dapat membantu dalam pemulihan ekosistem di wilayah ini. Terlebih lagi jika mangrove tersebut tumbuh subur akan membuat daya tarik tersendiri dari pantai tirang. Ekosistem pesisir terjaga dan membantu dalam meningkatkan ekowisata di daerah ini. Masalah abrasi dan erosipun dapat tertangani dalam jangka panjang.<br><br><img src=\"/public/img-campaign-desc/IMG_9595.png\" width=\"484\" height=\"322\"><br><br>Adanya penanaman mangrove di sekitar pantai Tirang dapat membantu mencegah abrasi dan erosidalam jangka panjang.<br><br>Anda dapat melakukan kontribusi melalui donasi sebesar Rp 3.000/pohon atau <br>gabung aksi penanaman pada 14 Mei 2017.<br><br>Donasi anda akan dipergunakan untuk : <br>1. Biaya pembelian bibit<br>2. Biaya pembelian acir<br>3. Biaya perawatan tanaman selama 1 tahun<br>4. Operasional penanaman (pada 14 Mei 2017)<br>5. Pengembangan Aplikasi Lindungi Hutan<br><br>Perkembangan dan perawatan donasi anda dapat dilihat di aplikasi lindungi hutan, <a href=\"http://www.lindungihutan.org\">www.lindungihutan.org</a>. Menciptakan hutan digital yang dapat dipantau oleh masyarakat merupakan tujuan dari penanaman ini.<br><br>- Membantu menjaga ekosistem hutan Indonesia<br><br><img src=\"/public/img-campaign-desc/postertirang.jpg\" width=\"611\" height=\"764\"><br><br>Jika anda ingin mengikuti proses penanaman pada tanggal 14 Mei 2017 , anda dapat Klik tombol gabung aksi. <br><br>Setelah anda selesai klik gabung aksi, panitia akan memberikan informasi teksis proses penanaman (H-2 sebelum acara).', 1, '2017-03-15 07:35:15', 'active', 'GPw1og4BRwZ1tGwYrYgDDAANdYGmLE1SbJalSssnby8grE5xB0OsII33nyx3ldoz4E3sn7H7in6ZJTlpukwNmdoM5mc3gtwWV88TCxycYn3VYI5xU5joj80n6w3kWazwCjZOOa9K4OerUeoJE7TGushkV5BwIK1dGAVJS5pAauuCPhtc4Az8yhS9azQSous8Y0bfaIgy', 3000, 'Pantai Tirang Semarang', '0', 1, 3000, '2017-05-14', '-6.954527311941729', '110.35780791865227', 'https://www.youtube.com/embed/uTdNBHljAms', '', 1.00, 1.00, 1, 0, NULL, NULL, NULL, 1.00, 1, 0, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `mode` enum('on','off') NOT NULL DEFAULT 'on',
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `mode`, `image`) VALUES
(1, 'Penanaman', 'Penanaman', 'on', 'Penanaman-29NQchlkgbHHw5xtXWf0uyZ3RtP7czIe.png'),
(2, 'Hewan', 'Hewan', 'on', 'Hewan-BoQxR6zuIhsMEjyugerVNunNye93069c.png'),
(3, 'Sampah', 'Sampah', 'on', 'Sampah-4cvofY7peOLvGuhvUqHquMhgZWhGVVYc.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'US', 'United States'),
(2, 'CA', 'Canada'),
(3, 'AF', 'Afghanistan'),
(4, 'AL', 'Albania'),
(5, 'DZ', 'Algeria'),
(6, 'DS', 'American Samoa'),
(7, 'AD', 'Andorra'),
(8, 'AO', 'Angola'),
(9, 'AI', 'Anguilla'),
(10, 'AQ', 'Antarctica'),
(11, 'AG', 'Antigua and/or Barbuda'),
(12, 'AR', 'Argentina'),
(13, 'AM', 'Armenia'),
(14, 'AW', 'Aruba'),
(15, 'AU', 'Australia'),
(16, 'AT', 'Austria'),
(17, 'AZ', 'Azerbaijan'),
(18, 'BS', 'Bahamas'),
(19, 'BH', 'Bahrain'),
(20, 'BD', 'Bangladesh'),
(21, 'BB', 'Barbados'),
(22, 'BY', 'Belarus'),
(23, 'BE', 'Belgium'),
(24, 'BZ', 'Belize'),
(25, 'BJ', 'Benin'),
(26, 'BM', 'Bermuda'),
(27, 'BT', 'Bhutan'),
(28, 'BO', 'Bolivia'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British lndian Ocean Territory'),
(34, 'BN', 'Brunei Darussalam'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CV', 'Cape Verde'),
(41, 'KY', 'Cayman Islands'),
(42, 'CF', 'Central African Republic'),
(43, 'TD', 'Chad'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CX', 'Christmas Island'),
(47, 'CC', 'Cocos (Keeling) Islands'),
(48, 'CO', 'Colombia'),
(49, 'KM', 'Comoros'),
(50, 'CG', 'Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'ID', 'Indonesia'),
(101, 'IR', 'Iran (Islamic Republic of)'),
(102, 'IQ', 'Iraq'),
(103, 'IE', 'Ireland'),
(104, 'IL', 'Israel'),
(105, 'IT', 'Italy'),
(106, 'CI', 'Ivory Coast'),
(107, 'JM', 'Jamaica'),
(108, 'JP', 'Japan'),
(109, 'JO', 'Jordan'),
(110, 'KZ', 'Kazakhstan'),
(111, 'KE', 'Kenya'),
(112, 'KI', 'Kiribati'),
(113, 'KP', 'Korea, Democratic People\'s Republic of'),
(114, 'KR', 'Korea, Republic of'),
(115, 'XK', 'Kosovo'),
(116, 'KW', 'Kuwait'),
(117, 'KG', 'Kyrgyzstan'),
(118, 'LA', 'Lao People\'s Democratic Republic'),
(119, 'LV', 'Latvia'),
(120, 'LB', 'Lebanon'),
(121, 'LS', 'Lesotho'),
(122, 'LR', 'Liberia'),
(123, 'LY', 'Libyan Arab Jamahiriya'),
(124, 'LI', 'Liechtenstein'),
(125, 'LT', 'Lithuania'),
(126, 'LU', 'Luxembourg'),
(127, 'MO', 'Macau'),
(128, 'MK', 'Macedonia'),
(129, 'MG', 'Madagascar'),
(130, 'MW', 'Malawi'),
(131, 'MY', 'Malaysia'),
(132, 'MV', 'Maldives'),
(133, 'ML', 'Mali'),
(134, 'MT', 'Malta'),
(135, 'MH', 'Marshall Islands'),
(136, 'MQ', 'Martinique'),
(137, 'MR', 'Mauritania'),
(138, 'MU', 'Mauritius'),
(139, 'TY', 'Mayotte'),
(140, 'MX', 'Mexico'),
(141, 'FM', 'Micronesia, Federated States of'),
(142, 'MD', 'Moldova, Republic of'),
(143, 'MC', 'Monaco'),
(144, 'MN', 'Mongolia'),
(145, 'ME', 'Montenegro'),
(146, 'MS', 'Montserrat'),
(147, 'MA', 'Morocco'),
(148, 'MZ', 'Mozambique'),
(149, 'MM', 'Myanmar'),
(150, 'NA', 'Namibia'),
(151, 'NR', 'Nauru'),
(152, 'NP', 'Nepal'),
(153, 'NL', 'Netherlands'),
(154, 'AN', 'Netherlands Antilles'),
(155, 'NC', 'New Caledonia'),
(156, 'NZ', 'New Zealand'),
(157, 'NI', 'Nicaragua'),
(158, 'NE', 'Niger'),
(159, 'NG', 'Nigeria'),
(160, 'NU', 'Niue'),
(161, 'NF', 'Norfork Island'),
(162, 'MP', 'Northern Mariana Islands'),
(163, 'NO', 'Norway'),
(164, 'OM', 'Oman'),
(165, 'PK', 'Pakistan'),
(166, 'PW', 'Palau'),
(167, 'PA', 'Panama'),
(168, 'PG', 'Papua New Guinea'),
(169, 'PY', 'Paraguay'),
(170, 'PE', 'Peru'),
(171, 'PH', 'Philippines'),
(172, 'PN', 'Pitcairn'),
(173, 'PL', 'Poland'),
(174, 'PT', 'Portugal'),
(175, 'PR', 'Puerto Rico'),
(176, 'QA', 'Qatar'),
(177, 'RE', 'Reunion'),
(178, 'RO', 'Romania'),
(179, 'RU', 'Russian Federation'),
(180, 'RW', 'Rwanda'),
(181, 'KN', 'Saint Kitts and Nevis'),
(182, 'LC', 'Saint Lucia'),
(183, 'VC', 'Saint Vincent and the Grenadines'),
(184, 'WS', 'Samoa'),
(185, 'SM', 'San Marino'),
(186, 'ST', 'Sao Tome and Principe'),
(187, 'SA', 'Saudi Arabia'),
(188, 'SN', 'Senegal'),
(189, 'RS', 'Serbia'),
(190, 'SC', 'Seychelles'),
(191, 'SL', 'Sierra Leone'),
(192, 'SG', 'Singapore'),
(193, 'SK', 'Slovakia'),
(194, 'SI', 'Slovenia'),
(195, 'SB', 'Solomon Islands'),
(196, 'SO', 'Somalia'),
(197, 'ZA', 'South Africa'),
(198, 'GS', 'South Georgia South Sandwich Islands'),
(199, 'ES', 'Spain'),
(200, 'LK', 'Sri Lanka'),
(201, 'SH', 'St. Helena'),
(202, 'PM', 'St. Pierre and Miquelon'),
(203, 'SD', 'Sudan'),
(204, 'SR', 'Suriname'),
(205, 'SJ', 'Svalbarn and Jan Mayen Islands'),
(206, 'SZ', 'Swaziland'),
(207, 'SE', 'Sweden'),
(208, 'CH', 'Switzerland'),
(209, 'SY', 'Syrian Arab Republic'),
(210, 'TW', 'Taiwan'),
(211, 'TJ', 'Tajikistan'),
(212, 'TZ', 'Tanzania, United Republic of'),
(213, 'TH', 'Thailand'),
(214, 'TG', 'Togo'),
(215, 'TK', 'Tokelau'),
(216, 'TO', 'Tonga'),
(217, 'TT', 'Trinidad and Tobago'),
(218, 'TN', 'Tunisia'),
(219, 'TR', 'Turkey'),
(220, 'TM', 'Turkmenistan'),
(221, 'TC', 'Turks and Caicos Islands'),
(222, 'TV', 'Tuvalu'),
(223, 'UG', 'Uganda'),
(224, 'UA', 'Ukraine'),
(225, 'AE', 'United Arab Emirates'),
(226, 'GB', 'United Kingdom'),
(227, 'UM', 'United States minor outlying islands'),
(228, 'UY', 'Uruguay'),
(229, 'UZ', 'Uzbekistan'),
(230, 'VU', 'Vanuatu'),
(231, 'VA', 'Vatican City State'),
(232, 'VE', 'Venezuela'),
(233, 'VN', 'Vietnam'),
(234, 'VG', 'Virgin Islands (British)'),
(235, 'VI', 'Virgin Islands (U.S.)'),
(236, 'WF', 'Wallis and Futuna Islands'),
(237, 'EH', 'Western Sahara'),
(238, 'YE', 'Yemen'),
(239, 'YU', 'Yugoslavia'),
(240, 'ZR', 'Zaire'),
(241, 'ZM', 'Zambia'),
(242, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `donations`
--

CREATE TABLE `donations` (
  `id` int(10) UNSIGNED NOT NULL,
  `campaigns_id` int(11) UNSIGNED NOT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal_code` varchar(100) DEFAULT NULL,
  `donation` int(11) UNSIGNED NOT NULL,
  `payment_gateway` varchar(100) DEFAULT NULL,
  `oauth_uid` varchar(200) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `anonymous` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 No, 1 Yes',
  `transferbank` enum('0','1') DEFAULT '0' COMMENT '0 No, 1 Yes',
  `phone` varchar(15) DEFAULT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `confirmed` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `donations`
--

INSERT INTO `donations` (`id`, `campaigns_id`, `txn_id`, `fullname`, `email`, `country`, `postal_code`, `donation`, `payment_gateway`, `oauth_uid`, `comment`, `date`, `anonymous`, `transferbank`, `phone`, `id_pembayaran`, `confirmed`) VALUES
(22, 36, 'null', 'ibu saya', 'rieskha@gmail.com', 'Indonesia', '62171', 300000, '', '', '', '2016-12-11 18:48:13', '1', '1', NULL, NULL, '1'),
(24, 36, 'null', 'Harwatiningsih SE, MM', 'harwati.ningsih@yahoo.co.id', 'Indonesia', '6429', 300000, '', '', 'Saya mendukung gerakan dan platform ini untuk kelestarian ekosistem hutan Indonesia.', '2016-12-12 02:59:29', '0', '0', NULL, NULL, '1'),
(25, 36, 'null', 'Adi Waluyo, SE', 'adiwaluyo@gmail.com', 'Indonesia', '6429', 150000, '', '', 'Terus Maju !! salam dari PEMKOT KEDIRI JATIM', '2016-12-12 03:02:00', '0', '0', NULL, NULL, '1'),
(26, 36, 'null', 'Bapak Rochim', 'rochim34@gmail.com', 'Indonesia', '6429', 150000, '', '', 'Semoga pohon ini bermanfaat bagi masyarakat Tanjung Mas.', '2016-12-12 03:03:51', '0', '0', NULL, NULL, '1'),
(27, 36, 'null', 'Ir Guntur Gandewa', 'gandewaguntur@gmail.com', 'Indonesia', '6429', 150000, '', '', 'Salam Hijau dari KALBAR ', '2016-12-12 03:05:45', '0', '0', NULL, NULL, '1'),
(28, 36, 'null', 'Ir Candra Mahardika', 'candratw@gmail.co.id', 'Indonesia', '6429', 150000, '', '', 'Saya selalu mendukung pelestarian hutan di Indonesia, salam dari Bandung.', '2016-12-12 03:07:39', '0', '0', NULL, NULL, '1'),
(29, 36, 'null', 'drh Gretania Resi, M.Si', 'gretaniaresi@yahoo.co.id', 'Indonesia', '6429', 150000, '', '', 'Menggabungkan teknologi dalam pelestarian hutan merupakan ide yang briliant', '2016-12-12 03:10:45', '0', '0', NULL, NULL, '1'),
(30, 36, 'null', 'Endro Asmono', 'endroasmono@gmail.com', 'Indonesia', '6429', 150000, '', '', 'Salam Hangat dari Pengadilan Negeri Kota Kediri, Lanjutkan 11', '2016-12-12 03:12:17', '0', '0', NULL, NULL, '1'),
(31, 36, 'null', 'Bapak Mujiono', 'mujiono@gmail.com', 'Indonesia', '6255', 225000, '', '', 'Semoga pohon donasi saya bermanfaat, salam dari JOMBANG', '2016-12-12 03:43:45', '0', '0', NULL, NULL, '1'),
(32, 36, 'null', 'Sriutaminingsih, SST', 'sriutaminingsih@gmail.co.id', 'Indonesia', '64100', 225000, '', '', 'Profesi saya Bidan , tapi sangat tertarik dengan konservasi alam yang dilakukan lindungi hutan.', '2016-12-12 03:46:21', '0', '0', NULL, NULL, '1'),
(33, 36, 'null', 'drh Habib Syaiful M.Si', 'habibtuska@gmail.com', 'Indonesia', '6709', 150000, '', '', 'Maju terus untuk menghijaukan Indonesia ,Lindungi Hutan', '2016-12-12 03:51:11', '0', '0', NULL, NULL, '1'),
(34, 36, 'null', 'Kuspanji Triantoro', 'panji@gmail.com', 'Indonesia', '6429', 150000, '', '', 'Lanjutkan !! semoga bermanfaat', '2016-12-12 08:46:06', '0', '0', NULL, NULL, '1'),
(35, 36, 'null', 'Bu Kartini', 'kartini@gmail.com', 'Indonesia', '6429', 150000, '', '', 'Inovasi menarik dan perlu dikembangkan lagi, Semagat TIM Lindungi Hutan', '2016-12-12 08:48:18', '0', '0', NULL, NULL, '1'),
(36, 36, 'null', 'kholiq budiman', 'budimankholiq@gmail.com', 'Indonesia', '50229', 30000, '', '', '', '2016-12-12 10:39:52', '0', '0', NULL, NULL, '1'),
(38, 36, 'null', 'Yahya Nur Ifriza', 'yahyanurifriza@gmail.com', 'Indonesia', '58152', 150000, '', '', 'semangat mengabdi untuk negeri', '2016-12-12 14:34:51', '0', '0', NULL, NULL, '1'),
(41, 36, 'null', 'Rohmad Bagus Supriyanto', 'rohmadbagus@yahoo.co.id', 'Indonesia', '64155', 300000, '', '', 'Bismillah. Karena menghijaukan (menanam) itu menghidupkan.. ', '2016-12-13 02:56:33', '1', '0', NULL, NULL, '1'),
(42, 36, 'null', 'Rizky Novrian Saputra', 'acc.novrian@gmail.com', 'Indonesia', '1310', 99000, '', '', 'semoga aksi kecil ini dapat membawa kebaikan untuk kita semua', '2016-12-13 04:22:42', '1', '0', NULL, NULL, '1'),
(43, 36, 'null', 'Anomim', 'ferdyaditia@gmail.com', 'Indonesia', '64212', 360000, '', '', '', '2016-12-13 04:24:08', '1', '0', NULL, NULL, '1'),
(45, 36, 'null', 'Andhika Yudhistira Kusuma', 'andhika.yudhistira@live.com', 'Indonesia', '65145', 333000, '', '', '', '2016-12-13 04:44:55', '0', '0', NULL, NULL, '1'),
(46, 36, 'null', 'oiavaio', 'vahn.valentine@gmail.com', 'Indonesia', '13230', 15000, '', '', '', '2016-12-13 06:49:25', '1', '0', NULL, NULL, '1'),
(47, 36, 'null', 'Ardi', 'ardi.pembuatjejak@gmail.com', 'Indonesia', '69102', 48000, '', '', 'Aplikasi bagus, memanfaatkan teknologi untuk perlindungan hutan', '2016-12-13 07:48:39', '0', '0', NULL, NULL, '1'),
(48, 36, 'null', 'Duta Eka Prayudha', 'dutaprayudha@gmail.com', 'Indonesia', '65149', 207000, '', '', 'Semoga bisa mengurangi dampak abrasi dan jadi RTH baru', '2016-12-13 10:30:45', '0', '0', NULL, NULL, '1'),
(49, 36, 'null', 'Farizkha risma', 'rismatem@gmail.com', 'Indonesia', '62833', 15000, '', '', '', '2016-12-13 11:14:49', '0', '0', NULL, NULL, '1'),
(52, 36, 'null', 'Sindi Retnowati', 'sindiretnowati9@gmail.com', 'Indonesia', '6429', 300000, '', '', 'Ikut membantu menghijaukan Indonesia', '2016-12-14 02:11:34', '0', '0', NULL, NULL, '1'),
(53, 36, 'null', 'Lingga ', 'adhatour@gmail.com', 'Indonesia', '6429', 150000, '', '', 'Semoga bermanfaat untuk menyegarkan udara', '2016-12-14 02:38:28', '0', '0', NULL, NULL, '1'),
(54, 36, 'null', 'Dian Rani Yuliati', 'dianraniy@gmail.com', 'Indonesia', '6429', 15000, '', '', 'Ikut membantu menghijaukan Tanjung Mas', '2016-12-14 03:15:52', '0', '0', NULL, NULL, '1'),
(55, 36, 'null', 'Putri Prasetyotami', 'myhepimeputrie@gmail.com', 'Indonesia', '6429', 51000, '', '', 'Membantu menghjaukan Indonesia', '2016-12-14 05:26:26', '0', '0', NULL, NULL, '1'),
(56, 36, 'null', 'Ismelda Iyou', 'ismeldaiyou@gmail.com', 'Indonesia', '6429', 15000, '', '', 'Membantu menghijaukan Indonesia', '2016-12-14 05:33:30', '0', '0', NULL, NULL, '1'),
(57, 36, 'null', 'Linawati', 'asharahmatillah@gmail.com', 'Indonesia', '51024', 30000, '', '', '', '2016-12-14 06:00:52', '0', '0', NULL, NULL, '1'),
(59, 36, 'null', 'Affan Ghaffar Ahmad', 'affan.ghaffar.ahmad@gmail.com', 'Indonesia', '64114', 150000, '', '', 'Tambahkan spot-spot khususnya di daerah lereng gunung untuk dilakukan penghijauan.', '2016-12-14 12:20:47', '0', '0', NULL, NULL, '1'),
(60, 36, 'null', 'Gitta Agnes  Putri', 'gitta.agnes@yahoo.com', 'Indonesia', '6429', 30000, '', '', 'Hijaukan Indonesia', '2016-12-14 13:21:35', '0', '0', NULL, NULL, '1'),
(61, 36, 'null', 'Agung tri noviyanto', 'Agungtrinoviyanto@gmail.com', 'Indonesia', '58163', 30000, '', '', 'Lindungi indonesia', '2016-12-15 00:52:10', '1', '0', NULL, NULL, '1'),
(62, 36, 'null', 'Eka Surya', 'borneyozz@gmail.com', 'Indonesia', '6430', 102000, '', '', 'Menghijaukan Indonesia', '2016-12-15 03:32:43', '0', '0', NULL, NULL, '1'),
(63, 36, 'null', 'Santri Pertiwi', 'santripertiwi2518@gmail.com', 'Indonesia', '6429', 45000, '', '', 'Menghijaukan Indonesia', '2016-12-15 07:18:18', '0', '0', NULL, NULL, '1'),
(64, 36, 'null', 'Redha Rahmi', 'redharahmi2805@gmail.com', 'Indonesia', '6429', 15000, '', '', 'Menghijaukan Indonesia', '2016-12-15 07:21:28', '0', '0', NULL, NULL, '1'),
(65, 36, 'null', 'Cut Juliana', 'cutzulyana@gmail.com', 'Indonesia', '6429', 15000, '', '', 'Menghijaukan Indonesia', '2016-12-15 07:23:53', '0', '0', NULL, NULL, '1'),
(66, 36, 'null', 'Hendri Saputra', 'hendrijamboe@gmail.com', 'Indonesia', '6429', 30000, '', '', 'Menghijaukan Indonesia', '2016-12-15 07:25:35', '0', '0', NULL, NULL, '1'),
(67, 36, 'null', 'Hendra Hadhil Choiri', 'Hendra.H2C.x@gmail.com', 'Indonesia', '6429', 30000, '', '', 'Menghijaukan Indonesia', '2016-12-15 07:27:04', '0', '0', NULL, NULL, '1'),
(68, 36, 'null', 'Inggrid Kumuma Wardhani', 'inggridkardhani@yahoo.com', 'Indonesia', '6429', 15000, '', '', 'Menghijaukan Indonesia', '2016-12-15 07:28:38', '0', '0', NULL, NULL, '1'),
(69, 36, 'null', 'Irfan Sujahri', 'santripertiwi@yahoo.co.id', 'Indonesia', '6429', 15000, '', '', 'Menghijaukan Indonesia', '2016-12-15 07:30:07', '0', '0', NULL, NULL, '1'),
(70, 36, 'null', 'Ranita Ostria', 'mithaostria@gmail.com', 'Indonesia', '6429', 15000, '', '', 'Menghijaukan Indonesia', '2016-12-15 07:31:38', '0', '0', NULL, NULL, '1'),
(71, 36, 'null', 'Freshtanto Sandi Normawan', 'Frestanto@hotmail.co.id', 'Indonesia', '6429', 51000, '', '', 'Semangat !! Menghijaukan Indonesia', '2016-12-15 08:46:23', '0', '0', NULL, NULL, '1'),
(72, 36, 'null', 'setiawan w', 'setiawanlabfor@yahoo.com', 'Indonesia', '52323', 99000, '', '', 'smoga program ini membawa manfaat bagi kita semua', '2016-12-15 10:21:02', '0', '0', NULL, NULL, '1'),
(73, 36, 'null', 'Riza upi', 'riza.upi15@gmail.com', 'Indonesia', '10640', 105000, '', '', '', '2016-12-15 11:23:06', '1', '0', NULL, NULL, '1'),
(74, 36, 'null', 'Noldy Sinsu', 'sinsu.tekno@gmail.com', 'Indonesia', '6429', 51000, '', '', 'Lanjutkan !!', '2016-12-15 11:35:04', '0', '0', NULL, NULL, '1'),
(75, 36, 'null', 'Arnild Augina Mekarisce', 'Arnildauginam@gmail.com', 'Indonesia', '51041', 30000, '', '', 'Semoga hutan di indonesia kembali dilestarikan', '2016-12-16 06:24:46', '0', '0', NULL, NULL, '1'),
(76, 36, 'null', 'anas absori', 'anas.absori@gmail.com', 'Indonesia', '10710', 60000, '', '', '', '2016-12-16 06:43:26', '0', '0', NULL, NULL, '1'),
(77, 36, 'null', 'Muhammad Khoiril Anwar', 'khoirilandwar44@gmail.com', 'Indonesia', '13230', 102000, '', '', 'Semoga bermanfaat..', '2016-12-16 09:03:07', '0', '0', NULL, NULL, '1'),
(78, 36, 'null', 'Gunawan Sani', 'gunawan.sani@gmail.com', 'Indonesia', '13230', 201000, '', '', 'Sya trut bangga pd para pemuda yg peduli dg lingkungan. Smg berlangsung dg  baik & menginspirasi.', '2016-12-16 09:11:23', '0', '0', NULL, NULL, '1'),
(79, 36, 'null', 'Puspito Raharjo', 'puspito25@gmail.com', 'Indonesia', '190292', 30000, '', '', 'semoga aksi\" seperti dapat terus ada untuk melestarikan lingkungan. salam lestari..!!!', '2016-12-16 09:39:42', '0', '0', NULL, NULL, '1'),
(80, 37, 'null', 'S Elita Barbara', 'elita@gmail.com', 'Indonesia', '6429', 1500000, '', '', 'Hijaukan Indonesia', '2016-12-18 16:29:33', '0', '0', NULL, NULL, '1'),
(81, 37, 'null', 'Ima Rismawati', 'rismawati.im@gmail.com', 'Indonesia', '45352', 99000, '', '', '', '2016-12-19 05:44:03', '1', '0', NULL, NULL, '1'),
(82, 37, 'null', 'Alzela Dona Sabilla', 'Alzela.dona@gmail.com', 'Indonesia', '6479', 15000, '', '', 'Semoga bermanfaat !!', '2016-12-20 02:36:53', '0', '0', NULL, NULL, '1'),
(83, 37, 'null', 'Tanhella Zein Vitadiar', 'Tanhellavitadiar@gmail.com', 'Indonesia', '6429', 15000, '', '', 'Menghijaukan Indonesia', '2016-12-20 02:53:40', '0', '0', NULL, NULL, '1'),
(84, 37, 'null', 'Ginanjar Setyo Permadi', 'setyoanjar14@gmail.com', 'Indonesia', '6429', 15000, '', '', 'Menghijaukan Indonesia', '2016-12-20 02:56:29', '0', '0', NULL, NULL, '1'),
(86, 37, 'null', 'roberto satria', 'satriaotrebor@gmail.com', 'Indonesia', '64212', 60000, '', '', 'semoga sukses programnya ', '2016-12-20 06:18:11', '0', '0', NULL, NULL, '1'),
(87, 37, 'null', 'Halimah', 'nurhalimah2603@gmail.com', 'Indonesia', '2603', 21000, '', '', 'Hijaukan bumi pertiwi!', '2016-12-20 13:53:11', '0', '0', NULL, NULL, '1'),
(89, 37, 'null', 'Hemas inggarbono', 'hemasinggarbono@gmail.com', 'Indonesia', '66184', 60000, '', '', '', '2016-12-20 23:35:24', '1', '0', NULL, NULL, '1'),
(91, 37, 'null', 'Bambang Kelik Budiharso', 'anakjamur@gmail.com', 'Indonesia', '50228', 150000, '', '', 'Semoga bermanfaat', '2016-12-21 03:30:32', '0', '0', NULL, NULL, '1'),
(92, 37, 'null', 'Lisa Yasoha', 'Lisa.rolita@yahoo.com', 'Indonesia', '38223', 30000, '', '', 'Semoga bermanfaat.. Ayo tanam 1 pohon untuk masa depan anak cucu kita nanti', '2016-12-21 07:22:40', '1', '0', NULL, NULL, '1'),
(93, 37, 'null', 'deanita sari', 'deanitasari9@gmail.com', 'Indonesia', '85361', 30000, '', '', '', '2016-12-21 08:46:49', '1', '0', NULL, NULL, '1'),
(94, 36, 'null', 'Budiono', 'budiono.tw@gmail.com', 'Indonesia', '6429', 600000, '', '', 'Menghijaukan Indonesia', '2016-12-22 05:21:45', '0', '0', NULL, NULL, '1'),
(95, 37, 'null', 'abdur rahim', 'abdurrahim_19@yahoo.co.id', 'Indonesia', '28662', 30000, '', '', '', '2016-12-22 14:26:00', '0', '0', NULL, NULL, '1'),
(96, 37, 'null', 'Muhammad Amin', 'maminrtg@gmail.com', 'Indonesia', '23343', 30000, '', '', 'Sukses selalu menghijaukan', '2016-12-22 15:53:49', '1', '0', NULL, NULL, '1'),
(97, 37, 'null', 'alex', 'alexdasilvalima2110@gmail.com', 'Brazil', '49071110', 15000, '', '', '', '2016-12-24 02:34:33', '1', '0', NULL, NULL, '1'),
(98, 37, 'null', 'alex', 'alexdasilvalima2110@gmail.com', 'Brazil', '49071110', 15000, '', '', '', '2016-12-24 02:35:13', '1', '0', NULL, NULL, '1'),
(99, 37, 'null', 'Gretania Resi Diwati', 'gretania.tw@gmail.com', 'Indonesia', '6429', 15000, '', '', '', '2016-12-24 07:16:15', '1', '0', NULL, NULL, '1'),
(100, 37, 'null', 'Yully Estiningsih', 'estiningsih@gmail.com', 'Indonesia', '6429', 90000, '', '', '', '2016-12-24 07:18:10', '0', '0', NULL, NULL, '1'),
(103, 40, 'null', 'PALASI', 'harios1si@gmail.com', NULL, NULL, 7500000, NULL, NULL, 'Donasi penuh acara penanaman', '2017-01-31 16:31:10', '0', '0', '085735109593', NULL, '1'),
(105, 41, 'null', 'Rifky Aditama', 'napiesan@gmail.com', NULL, NULL, 75000, NULL, NULL, 'Semangat Menghijaukan Indonesia', '2017-02-03 15:20:20', '0', '0', '081326883493', NULL, '1'),
(106, 41, 'null', 'AMAT BASIYO', 'basiyo71@yahoo.com', NULL, NULL, 150000, NULL, NULL, 'hijau hutanku, lestari alam Indonesia', '2017-02-04 18:08:31', '1', '0', '0818898256', NULL, '1'),
(115, 41, 'null', 'Budiono', 'budiono.tw@gmail.com', NULL, NULL, 150000, NULL, NULL, 'Inovasi yang membanggakan, semoga banyak orang yang melek tentang hal ini', '2017-02-06 01:47:16', '0', '0', '085735109593', NULL, '1'),
(117, 41, 'null', 'farizal', 'farizalrinalditya@gmail.com', NULL, NULL, 75000, NULL, NULL, 'lindungi alam indonesia', '2017-02-07 04:34:22', '1', '0', '085745981393', NULL, '1'),
(127, 41, 'null', 'vicq', 'awangvq@gmail.com', NULL, NULL, 75000, NULL, NULL, '', '2017-02-09 14:11:06', '0', '0', '081391386690', NULL, '1'),
(128, 41, 'null', 'simson', 'simson.tondo@yahoo.com', NULL, NULL, 75000, NULL, NULL, '', '2017-02-09 14:19:33', '0', '0', '081244905680', NULL, '1'),
(133, 41, 'null', 'Irman', 'Irman08.08@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-02-10 02:12:53', '0', '0', '085244278171', NULL, '1'),
(134, 41, 'null', 'Rio09', 'wellikenrio@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-02-10 03:59:01', '0', '0', '081247327276', NULL, '1'),
(139, 41, 'null', 'anas', 'anas.absori@gmail.com', NULL, NULL, 105000, NULL, NULL, '', '2017-02-13 09:14:25', '0', '0', '085649332165', NULL, '1'),
(140, 41, 'null', 'Efra', 'sfraystruggle@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-02-15 01:00:15', '0', '0', '081344443271', NULL, '1'),
(141, 41, 'null', 'lina murti', 'murti.lina@gmail.com', NULL, NULL, 45000, NULL, NULL, '', '2017-02-15 11:06:40', '1', '0', '082129165551', NULL, '1'),
(142, 41, 'null', 'yoiyok', 'omyoiyok@gmail.com', NULL, NULL, 30000, NULL, NULL, 'Tetap semangat', '2017-02-16 02:28:24', '1', '0', '081226591204', NULL, '1'),
(143, 41, 'null', 'Idola', 'idoladiannebore_bio.unipa@yahoo.co.id', NULL, NULL, 30000, NULL, NULL, '', '2017-02-18 21:52:22', '0', '0', '085254770755', NULL, '1'),
(144, 41, 'null', 'Komang Jaka Ferdian', 'Komangjkf@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-02-19 13:15:47', '1', '0', '0819694630', NULL, '1'),
(145, 41, 'null', 'Ian Pasaribu', 'ianpasaribu20@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-02-19 13:20:27', '0', '0', '085206019890', NULL, '1'),
(146, 41, 'null', 'yan', 'yankogoya@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-02-19 16:28:48', '0', '0', '081215632591', NULL, '1'),
(147, 41, 'null', 'Hamba Allah', 'rukaan.adha@gmail.com', NULL, NULL, 45000, NULL, NULL, 'good', '2017-02-22 07:19:16', '0', '0', '085710728254', NULL, '1'),
(148, 42, 'null', 'annisa prawiradilaga', 'orangutan_kayu@yahoo.com', NULL, NULL, 90000, NULL, NULL, '', '2017-03-24 05:14:09', '1', '0', '081310333166', NULL, '1'),
(149, 42, 'null', 'Lina', 'murti.lina@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-03-25 02:20:29', '1', '0', '082129165551', NULL, '1'),
(150, 42, 'null', 'Anissa Wijayati', 'wiwi20.7794@gmail.com', NULL, NULL, 300000, NULL, NULL, '', '2017-03-25 09:43:26', '0', '0', '085215519767', NULL, '0'),
(151, 42, 'null', 'Anissa Wijayati', 'wiwi20.7794@gmail.com', NULL, NULL, 60000, NULL, NULL, '', '2017-03-25 09:44:04', '0', '0', '085215519767', NULL, '0'),
(152, 42, 'null', 'Anissa Wijayati', 'wiwi20.7794@gmail.com', NULL, NULL, 60000, NULL, NULL, '', '2017-03-25 09:53:49', '0', '0', '085215519767', NULL, '1'),
(153, 42, 'null', 'Siska Febrina Fauziah', 'siskafebrinafauziah90@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-03-28 05:49:13', '1', '0', '085294443535', NULL, '1'),
(154, 42, 'null', 'Rio', 'harios1si@gmail.com', NULL, NULL, 30000, NULL, NULL, 'asasa', '2017-03-28 11:29:33', '0', '0', '12121', NULL, '0'),
(155, 42, 'null', 'Bambang Kelik Budiharso', 'anakjamur@gmail.com', NULL, NULL, 300000, NULL, NULL, '', '2017-03-29 15:11:15', '0', '0', '085648395171', NULL, '1'),
(156, 42, 'null', 'Adin Damayanti', 'adindmynt@gmail.com', NULL, NULL, 45000, NULL, NULL, 'semoga bermanfat untuk menyelamatkan bumi', '2017-03-30 12:51:01', '1', '0', '082157995696', NULL, '0'),
(157, 42, 'null', 'Agus Ridwan', 'agusridwanunnes@gmail.com', NULL, NULL, 300000, NULL, NULL, '', '2017-04-01 13:44:57', '0', '0', '085740772486', NULL, '1'),
(158, 42, 'null', 'Rima Febrian', 'febrian0287@gmail.com', NULL, NULL, 150000, NULL, NULL, '', '2017-04-01 15:43:42', '0', '0', '085782557862', NULL, '0'),
(159, 42, 'null', 'debora sarmaulina', 'sarmaulinadebora@gmail.com', NULL, NULL, 90000, NULL, NULL, '', '2017-04-03 01:43:52', '0', '0', '082282723090', NULL, '0'),
(160, 42, 'null', 'Debora Sarmaulina', 'sarmaulinadebora@gmail.com', NULL, NULL, 45000, NULL, NULL, '', '2017-04-03 01:48:55', '0', '0', '082282723090', NULL, '0'),
(161, 42, 'null', 'tes cacip', 'cacip666@gmail.com', NULL, NULL, 45000, NULL, NULL, ',hasdfj bj afj,a, a, ba,f a A AF A A   A   ', '2017-04-03 01:57:49', '0', '0', '085795656662', NULL, '0'),
(162, 42, 'null', 'Liany Suwito', 'lianydsuwito@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-04-03 07:42:18', '0', '0', '08568720717', NULL, '0'),
(163, 42, 'null', 'Liany Suwito', 'lianydsuwito@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-04-03 07:53:33', '0', '0', '08568720717', NULL, '1'),
(164, 42, 'null', 'ben', 'ben@gmail.com', NULL, NULL, 3000, NULL, NULL, 'semangaty', '2017-04-03 10:34:16', '0', '0', '97997', NULL, '0'),
(165, 42, 'null', 'Andri Rizal Fauzian', 'andrisaja350@gmail.com', NULL, NULL, 90000, NULL, NULL, 'Donasi untuk penanaman pohon pantai tirang', '2017-04-03 13:27:30', '1', '0', '085710458693', NULL, '1'),
(166, 42, 'null', 'Iqbal Faruqi', 'iqbal25faruqi@gmail.com', NULL, NULL, 999000, NULL, NULL, '', '2017-04-03 14:11:33', '1', '0', '08111700453', NULL, '1'),
(167, 42, 'null', 'a', 'a@gm', NULL, NULL, 3000, NULL, NULL, '', '2017-04-03 15:07:34', '0', '0', '98', NULL, '0'),
(168, 42, 'null', 'teas', 'cacip@der.com', NULL, NULL, 45000, NULL, NULL, 'ghgfdfb ggbhfff fghyffgh fsfgh', '2017-04-03 15:12:00', '0', '0', '2234563467', NULL, '0'),
(169, 42, 'null', 'Ainur Robiatul Adawiyah', 'ainurrobiatul@gmail.com', NULL, NULL, 30000, NULL, NULL, '', '2017-04-04 04:16:20', '1', '0', '85954590632', NULL, '0'),
(170, 42, 'null', 'Dhani', 'B', NULL, NULL, 30000, NULL, NULL, '', '2017-04-04 05:35:24', '1', '0', '08', NULL, '0'),
(171, 42, 'null', 'Dhani', 'Bas', NULL, NULL, 30000, NULL, NULL, '', '2017-04-04 05:38:32', '0', '0', '08', NULL, '0'),
(172, 42, 'null', 'Hamba Allah', 'Rina.wulan45@gmail.com', NULL, NULL, 45000, NULL, NULL, 'Semoga menjadi manfaat dan menjadi tabungan di akhirat. Aamiin', '2017-04-04 13:00:05', '1', '0', '085868888202 ', NULL, '1'),
(173, 42, 'null', 'Gretania Resi Diwati', 'gretania.resi@yahoo.co.id', NULL, NULL, 150000, NULL, NULL, 'Semangat !!', '2017-04-05 04:50:04', '1', '0', '0871202111', NULL, '1'),
(174, 42, 'null', 'leza restiana', 'lezafidyah6@gmail.com', NULL, NULL, 90000, NULL, NULL, '', '2017-04-05 07:31:13', '1', '0', '085380084036', NULL, '1'),
(175, 42, 'null', 'Nik Jam', 'nikjam131.nj@gmail.com', NULL, NULL, 9000, NULL, NULL, '', '2017-04-06 03:56:37', '1', '0', '08568031143', NULL, '0'),
(176, 42, 'null', 'Nik Jam', 'nikjam131.nj@gmail.com', NULL, NULL, 9000, NULL, NULL, '', '2017-04-06 05:34:39', '1', '0', '08568031143', NULL, '1'),
(177, 42, 'null', 'aris', 'nandargrafika@yahoo.com', NULL, NULL, 15000, NULL, NULL, 'nice', '2017-04-06 12:11:15', '1', '0', '08976545358', NULL, '0'),
(178, 42, 'null', 'A', 'A@', NULL, NULL, 3000, NULL, NULL, 'Iu', '2017-04-07 11:54:28', '0', '0', '123', NULL, '0'),
(179, 42, 'null', 'tes', 'cacip666@tes.com', NULL, NULL, 45000, NULL, NULL, 'wf wf s fasf asf sfd sf sf sf', '2017-04-07 14:45:38', '0', '0', '34131231231', NULL, '0'),
(180, 42, 'null', 'tes', 'cacip666@tes.com', NULL, NULL, 45000, NULL, NULL, 'wf wf s fasf asf sfd sf sf sf', '2017-04-07 14:45:38', '0', '0', '34131231231', NULL, '0'),
(181, 42, 'null', 'bukan siapa siapa', 'farizalrinalditya@gmail.com', NULL, NULL, 75000, NULL, NULL, 'Safe our Earth', '2017-04-07 14:46:27', '1', '0', '085745981393', NULL, '1'),
(183, 42, 'null', 'cacip', 'cacip@gmail.com', NULL, NULL, 150000, NULL, NULL, 'af ff afasd ad a aa', '2017-04-08 04:09:58', '1', '0', '2151331313', NULL, '0'),
(184, 42, 'null', 'cacip', 'cacip@gmail.com', NULL, NULL, 45000, NULL, NULL, 'af ff afasd ad a aa', '2017-04-08 04:57:09', '1', '0', '2151331313', NULL, '0'),
(185, 42, 'null', 'cacip', 'cacip@gmail.com', NULL, NULL, 45000, NULL, NULL, 'af ff afasd ad a aa', '2017-04-08 04:57:10', '1', '0', '2151331313', NULL, '0'),
(186, 42, 'null', 'yuuy', 'huyuy@yahoo.com', NULL, NULL, 1998000, NULL, NULL, 'hghg', '2017-04-08 07:50:27', '1', '0', '7676', NULL, '0'),
(187, 42, 'null', 'arus', 'hghhg', NULL, NULL, 135000, NULL, NULL, '878787', '2017-04-08 08:41:40', '0', '0', '8787', NULL, '0'),
(188, 42, 'null', 'eka andy santoso', 'ekaandy36@gmail.com', NULL, NULL, 300000, NULL, NULL, '', '2017-04-10 03:34:17', '0', '0', '081215021831', NULL, '0'),
(189, 42, 'null', 'EGIDYA MAHARDINI', 'egidyamahardini@gmail.com', NULL, NULL, 90000, NULL, NULL, 'manusia. Sadar bukan hanya sekedar kata, tapi aksi nyata. ', '2017-04-11 06:14:45', '0', '0', '81214205020', NULL, '1'),
(190, 42, 'null', 'Putri Rakhmawati', 'putrirakhma08@gmail.com', NULL, NULL, 60000, NULL, NULL, '', '2017-04-12 08:04:08', '0', '0', '085727196262', NULL, '1'),
(191, 42, 'null', 'Ahamaniyah', 'ahmaniyah@gmail.com', NULL, NULL, 9000, NULL, NULL, 'Semoga Hutan Indonesia Tetap Lestari', '2017-04-12 14:47:42', '0', '0', '081231956342', NULL, '1'),
(192, 42, 'null', 'heru rosadi', 'heru.rosadi@gmail.com', NULL, NULL, 150000, NULL, NULL, 'make Semarang green again', '2017-04-13 05:12:13', '1', '0', '083834522217', NULL, '1'),
(193, 42, 'null', 'Bastaman Omar Dhani', 'bastaman.od@gmail.com', NULL, NULL, 60000, NULL, NULL, 'semoga dunia semakin hijau', '2017-04-13 09:10:34', '0', '0', '+6285842347087', NULL, '1'),
(197, 42, 'null', 'sita kalaswari', 'kalaswarisita@gmail.com', NULL, NULL, 63000, NULL, NULL, 'Write a brief comment (optional)', '2017-04-13 10:18:49', '1', '0', '083850110217', NULL, '0'),
(198, 42, 'null', 'sita kalaswari', 'kalaswarisita@gmail.com', NULL, NULL, 63000, NULL, NULL, '', '2017-04-13 10:20:37', '0', '0', '083850110217', NULL, '0'),
(199, 42, 'null', 'sita kalaswari', 'kalaswarisita@gmail.com', NULL, NULL, 60000, NULL, NULL, '', '2017-04-16 23:35:24', '0', '0', '085707178924', NULL, '1'),
(200, 42, 'null', 'Ratih Hatibie', 'ratihatibie96@gmail.com', NULL, NULL, 9000, NULL, NULL, '', '2017-04-18 08:42:44', '1', '0', '082299602168', NULL, '0'),
(201, 42, 'null', 'Kpa lacak', 'lintasaalamcintalingkungan@gmail.com', NULL, NULL, 30000, NULL, NULL, 'Kami berharap agar kegiatan ini bisa bermanfaat dan sukses', '2017-04-20 06:51:56', '0', '0', '082190068940', NULL, '0'),
(202, 42, 'null', 'Kpa lacak', 'lintasaalamcintalingkungan@gmail.com', NULL, NULL, 30000, NULL, NULL, 'Kami berharap agar kegiatan ini bisa bermanfaat dan sukses', '2017-04-20 06:54:43', '1', '0', '082190068940', NULL, '1'),
(203, 42, 'null', 'Djenar Putri', 'Djenar203@gmail.com', NULL, NULL, 30000, NULL, NULL, 'Semoga bumi kembali dan tetap hijau☺️', '2017-04-21 11:33:04', '1', '0', '081243212329', NULL, '0'),
(204, 42, 'null', 'danar ardhito', 'danarardhito@gmail.com', NULL, NULL, 60000, NULL, NULL, '', '2017-04-22 13:57:30', '0', '0', '08119444348', NULL, '0'),
(205, 42, 'null', 'Melyana', 'melyana_n@yahoo.com', NULL, NULL, 99000, NULL, NULL, 'Lestarikan Hutan Indonesia', '2017-04-22 15:14:20', '0', '0', '08122853514', NULL, '1'),
(206, 42, 'null', 'Adi Purnomo', 'iweks24@gmail.com', NULL, NULL, 90000, NULL, NULL, '', '2017-04-24 04:16:36', '1', '0', '087832252251', NULL, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kupon`
--

CREATE TABLE `kupon` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kupon`
--

INSERT INTO `kupon` (`id`, `image`, `date`, `id_user`) VALUES
(23, '20170104222300_IMG-20170103-WA0000.jpg', '2017-01-04 15:23:00', 31),
(24, '20170104222327_IMG-20170103-WA0001.jpg', '2017-01-04 15:23:27', 31);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_masalah`
--

CREATE TABLE `laporan_masalah` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NULL DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `anonymous` enum('0','1') NOT NULL DEFAULT '0',
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `id_status_laporan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan_masalah`
--

INSERT INTO `laporan_masalah` (`id`, `title`, `description`, `location`, `date`, `date_update`, `image`, `id_user`, `anonymous`, `latitude`, `longitude`, `id_status_laporan`) VALUES
(1, 'a', 'asfdsfsdff asfdsfsdff asfdsfsdff asfdsfsdff asfdsfsdff asfdsfsdff', 'cdddd asfdsfsdffasfdsfsdff asfdsfsdff', '2017-02-04 10:28:27', NULL, '20170204172827_temp.jpg', 31, '0', '-6.8983619', '107.6196362', 1),
(2, 'tes input masalah', 'lkhb gjh jhh jkv jvjvj vj vj v jv jv jvb', 'semarang', '2017-02-22 04:07:25', NULL, '', 88, '0', '-7.011777671844252', '110.37325744257805', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `media`
--

INSERT INTO `media` (`id`, `nama`, `deskripsi`, `gambar`, `link`) VALUES
(9, 'Berita Jawa Tengah', 'beritanya jawa tengah', '-VSabeSxcf2l0h0xdzSmr143orgebKS3H.png', 'http://beritajateng.net/jaga-lingkungan-dengan-tanam-2000-mangrove-dan-launching-platform-lindungi-hutan/'),
(17, 'Tribun Jateng', 'Tribun Jateng', '-3gsqCaZRviGAam3oj0FJKdYNo6tywQ2V.png', 'Tribun Jateng'),
(18, 'Daily Social', 'deskripsi', '-F5ogMeShmiRkFcEY4jLKxzjp7YUCa8Ep.png', 'https://dailysocial.net/wire/startup-peduli-lingkungan-hidup-lahir-dari-peserta-gerakan-nasional-1000-startup-digital-semarang/'),
(14, 'Kompas', 'deskripsi', '-NbL2CL9hMSYLj5wkR81HskOBVYTJvi6Q.png', 'link'),
(16, 'Kampusundip.com', 'deskripsi', '-wYkr5XJGzYZupdRcHJGbcxDtNioWS8HL.jpg', 'http://www.kampusundip.com/2017/04/aplikasi-karya-undip-lindungi-hutan.html'),
(13, 'Anak Undip', 'deskripsi', '-kF3j57gkKJFm0iEqy4AGp41GdwTTKETI.jpeg', 'http://anakundip.com/indonesiaku/platform-lindungi-hutan-inovasi-kece-generasi-muda-bangsa/'),
(19, 'Beritagar.id', 'Beritagar.id', '-c3W7IOAOyD4YbXtsDhGd8svPPsm8DSvb.png', 'https://beritagar.id/index.php/artikel/sains-tekno/merawat-lingkungan-secara-digital-melalui-lindungi-hutan'),
(20, 'Selular.id', 'Selular.id', '-nWMT9m7lOGMYievHaSpryEonpC7lcd2u.png', 'http://selular.id/news/startup/2017/04/peduli-lingkungan-pria-asal-semarang-ini-bangun-startup-lindungi-hutan/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) UNSIGNED NOT NULL,
  `sampah_terkumpul` int(10) NOT NULL,
  `panti_hewan` int(10) NOT NULL,
  `hewan_tertangani` int(10) NOT NULL,
  `laporan_alam` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `sampah_terkumpul`, `panti_hewan`, `hewan_tertangani`, `laporan_alam`) VALUES
(1, 0, 1, 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `olahan_sampah`
--

CREATE TABLE `olahan_sampah` (
  `id` int(11) NOT NULL,
  `small_image` varchar(255) NOT NULL,
  `large_image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(15) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `olahan_sampah`
--

INSERT INTO `olahan_sampah` (`id`, `small_image`, `large_image`, `name`, `price`, `description`, `date`) VALUES
(1, 'bunga_dari_sampah.jpg', 'bunga_dari_sampah.jpg', 'Bunga Dari Sampah', 5000, 'Bunga yang dibuat dari sampah. Sampah yang tidak dipakai dan masih berguna dikumpulkan. Kemudian dibuat menyerupai bunga. Kesimpulannya si pembuat orangnya jorok. Sekian.', '2016-12-02 22:23:34'),
(2, 'rumah_dari_rokok.jpg', 'rumah_dari_rokok.jpg', 'Rumah-rumahan', 20000, 'Bungkus rokok bisa didaur ulang menjadi kerajinan tangan termasuk rumah-rumahan. Bagi yang suka merokok lebih baik bungkusnya jangan dibuang. Buat rumah-rumahan saja.', '2016-12-02 22:23:34'),
(3, 'tas_dari_bungkus.jpg', 'tas_dari_bungkus.jpg', 'Tas', 10000, 'Tas ini sangat berguna jika dipakai untuk bepergian sebagai tempat menyimpan barang-barang yang dibawa atau dibeli di suatu tempat. Jangan malu kalau nanti kelihatan aneh waktu dilihat orang lain.', '2016-12-02 22:27:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(100) NOT NULL,
  `show_navbar` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 No, 1 Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `slug`, `show_navbar`) VALUES
(8, 'Cara Kerja', '<center>\r\n<p><img alt=\"\" src=\"https://3.bp.blogspot.com/-782gwlsWWL8/WEZbcqu9JbI/AAAAAAAAC3U/cF_dUA4stKo34VtADtvgut1ZGJGmKa7fgCLcB/s640/atas-500px.png\" style=\"height:395px; width:517px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://2.bp.blogspot.com/-knxRE6posI8/WEZbhem2amI/AAAAAAAAC3Y/LM91aPxTy0YfrPmB5TzK2gRDM7jF5LxSgCLcB/s640/top.png\" style=\"height:370px; width:740px\" /></p>\r\n</center>', 'how-it-works', '1'),
(9, 'Syarat dan Ketentuan', '<p><strong>Kesepakatan terhadap Ketentuan Pengguna Platform Lindungi Hutan</strong></p>\r\n\r\n<p>Syarat dan Ketentuan Penggunaan ini&nbsp;<strong>(&quot;Ketentuan&quot;)</strong>&nbsp;merupakan perjanjian yang mengikat antara anda selaku pengguna situs www.lindungihutan.org&nbsp;<strong>(&quot;Situs&quot;)</strong>&nbsp;ini beserta kami, &quot;<strong>Perseroan</strong>&quot; atau &quot;<strong>Kami</strong>&quot;&nbsp;selaku pengelola Situs, baik dalam posisi Anda sebagai seorang Donatur, Sahabat Alam&nbsp;(Pengguna) atau sekedar pihak yang melihat-lihat Situs.</p>\r\n\r\n<p>Ketentuan ini berlaku sehubungan dengan penggunaan Anda terhadap Situs ini, serta jasa yang kami berikan melalui Situs ini (&quot;<strong>Jasa</strong>&quot;).</p>\r\n\r\n<p>Dengan Anda mempergunakan Situs ini dengan cara apapun, atau Anda memanfaatkan Jasa dengan cara apapun, maka Anda dianggap :</p>\r\n\r\n<p><strong>(i)</strong> Setuju untuk terikat dan tunduk pada semua syarat dan ketentuan sebagaimana di atur dalam Ketentuan,serta<br />\r\n<strong>(ii)</strong> bersedia bertanggungjawab terhadap setiap kelalaian maupun pelanggaran yang Anda lakukan sehubungan dengan kewajiban atau pernyataan Anda sebagaimana diatur dalam Ketentuan.</p>\r\n\r\n<p>Meski Ketentuan ini berlaku terhadap setiap penggunaan Situs maupun Jasa, Perseroan dapat menetapkan perjanjian atau ketentuan yang terpisah bagi Jasa tertentu yang akan mengikat Anda apabila Anda menggunakan Jasa tersebut.</p>\r\n\r\n<p><strong>Hak dan Kewajiban Anda Sebagai Pengguna</strong></p>\r\n\r\n<p>Dengan menggunakan Situs ini atau memanfaatkan Jasa, Anda menjamin dan menyatakan bahwa Anda cakap secara hukum dan terikat pada Ketentuan ini.</p>\r\n\r\n<p>1. Anda berhak memanfaatkan seluruh fasilitas maupun Jasa yang tersedia di Situs, kecuali bagi fasilitas atau Jasa tertentu yang mengharuskan Anda memiliki akun.</p>\r\n\r\n<p>2. Apabila Anda memilih untuk membuka akun, maka Anda dapat memperoleh fasilitas maupun Jasa tertentu yang mungkin tidak disediakan bagi pengguna Situs pada umumnya.</p>\r\n\r\n<p>3. Anda tidak boleh memanfaatkan Situs maupun Jasa untuk keperluan-keperluan yang bertentangan dengan hukum, melanggar kesusilaan maupun melanggar hak Perseroan maupun hak pihak lainnya (baik hak pihak yang menggunakan Situs atau Jasa maupun hak dari pihak yang tidak menggunakan Situs maupun Jasa). Termasuk dalam hal ini Anda tidak dapat:</p>\r\n\r\n<p>4. Melakukan atau menyuruh pihak lain untuk melakukan, tindakan apapun (termasuk mengunggah atau mendistribusikan piranti lunak, data atau program dalam bentuk apapun), yang dapat merusak, mengganggu atau membatasi kinerja Situs maupun Jasa, atau yang dapat menyebabkan fungsi-fungsi tertentu dalam Situs maupun Jasa menjadi tidak bekerja, atau yang dapat merubah fungsi, data atau program dari Situs maupun Jasa.</p>\r\n\r\n<p>5. Memberikan, atau menyuruh pihak lain untuk memberikan, data atau informasi yang tidak benar atau menyesatkan, atau memalsukan data atau keterangan pihak lain</p>\r\n\r\n<p>6. Melakukan atau menyuruh pihak lain untuk melakukan, tindakan apapun yang dapat menyebabkan pelanggaran terhadap hak milik intelektual Perseroan, Pemilik Kampanye Alam&nbsp;(sebagaimana didefinisikan di bawah ini), pengguna Situs lainnya, maupun pihak-pihak lainnya.</p>\r\n\r\n<p><strong>Perseroan tidak bertanggungjawab terhadap setiap tindakan Anda dalam memanfaatkan Situs ataupun Jasa, dan Anda menyatakan dan menjamin akan membebaskan Perseroan dari segala tuntutan yang muncul sebagai akibat penggunaan Anda terhadap Situs ini.</strong>&nbsp;<br />\r\n<br />\r\nAnda selanjutnya juga bertanggungjawab kepada Perseroan, terhadap setiap pelanggaran atau kelalaian Anda dalam memenuhi kewajiban atau pernyataan Anda berdasarkan Ketentuan ini.</p>\r\n\r\n<p><strong>Hubungan Anda sebagai Pengguna dengan Sahabat Alam&nbsp;yang mempunyai Kampanye Alam ataupun Partner kami.&nbsp;</strong></p>\r\n\r\n<p>Perseroan oleh karenanya tidak menjamin, serta tidak bertanggungjawab terhadap hal-hal berikut:</p>\r\n\r\n<p>1. Pelaksanaan Kampanye Alam&nbsp;maupun terpenuhinya Kampanye Alam&nbsp;sebagaimana dijanjikan oleh Pemilik Kampanye Alam;</p>\r\n\r\n<p>2. Tersedianya maupun terpenuhinya barang, jasa, layanan, fasilitas atau imbal balik apapun dari Pemilik Proyek kepada Anda atas bantuan yang Anda berikan;</p>\r\n\r\n<p>3. Terpenuhinya semua reward atau janji-janji yang diberikan Pemilik Kampanye Alam, baik yang dinyatakan secara langsung maupun yang diberikan melalui Perseroan selaku penerima kuasa Pemilik Proyek.</p>\r\n\r\n<p><strong>Ketentuan Pemanfaatan Fitur Platform Lindungi Hutan</strong><br />\r\n<strong>1. Kampanye Alam</strong><br />\r\na. Sebagai Donatur</p>\r\n\r\n<p>1. Donasi yang anda berikan pada proses kampanye alam sepenuhnya adalah milik Lindungi Hutan dan Partner kami, parner kami bertugas mengelola donasi anda. Donasi anda dipergunakan untuk proses pembelian bibit, penanaman, perawatan dan pengawasan pertumbuhan tanaman.</p>\r\n\r\n<p>2. Anda tidak diperbolehkan meminta pengembalian donasi Anda, sebelum atau setelah proses kampanye alam selesai .</p>\r\n\r\n<p>3. Pohon donasi anda sepenuhnya merupakan milik Taman Nasional ataupun Partner Kami yang bertugas merawat dan mengelola pohon donasi Anda.</p>\r\n\r\n<p>4. Pohon donasi anda mendapat jaminan dari pihak Taman Nasional untuk tidak di perjual belikan (Komersil).</p>\r\n\r\n<p>5. Jika pohon donasi anda menghasilkan buah atau sejenisnya , itu semua merupakan hak dari Taman Nasional ataupun Partner Kami.</p>\r\n\r\n<p>6. Pihak Lindungi Hutan dan Partner kami tidak bertanggung jawab atas matinya pohon donasi anda dalam proses usaha perawatan dan pengelolaan pohon.</p>\r\n\r\n<p>b. Sebagai Sahabat Alam</p>\r\n\r\n<p>1. Anda tidak diperbolehkan melakukan tindakan kriminalitas pada saat proses Kampanye Alam Berlangsung.</p>\r\n\r\n<p>2. Anda tidak diperbolehkan mengatasnamakan Lindungi Hutan dalam hal komersial.</p>\r\n\r\n<p>3. Segala hal yang berhubungan dengan perusakan sistem kami (hacker) akan kami pidanakan sesuai dengan ketentuan Hukum Negara Republik Indonesia.</p>\r\n\r\n<p><strong>Ketentuan ini tunduk pada ketentuan hukum negara Republik Indonesia.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n', 'sadasdasd1212', '0'),
(10, 'Perlindungan  Hutan', '<p><img alt=\"\" src=\"https://1.bp.blogspot.com/-h6CfL-KNmfQ/WEe0jUp-jaI/AAAAAAAAC4U/k1MLSHjaFbc6NZFqrcKy5R0ji_H9qFtpACLcB/s1600/design-layer2%2Bcopy.png\" style=\"height:1500px; width:1000px\" /></p>\r\n', 'Hutan', '0'),
(11, 'Buat Campaign', '<p>Sebelum Anda membuat campaign, pastikan Anda dan Komunitas yang Anda gandeng&nbsp;peduli terhadap kelestarian hutan, punya visi yang kuat untuk penggalangan dana, dan mampu bertanggung jawab untuk kegiatan penanaman sampai perawatan pohon yang ditanam pada campaign yang dibuat.</p>\r\n\r\n<p>Adapun syarat - syarat yang harus dilengkapi adalah sebagai berikut:</p>\r\n\r\n<ul>\r\n	<li>1. Daftar akun di lindungihutan</li>\r\n	<li>2. Foto KTP/SIM/ identitas resmi lainnya</li>\r\n	<li>3. Foto diri Anda sedang memegang kertas bertulis nama Anda&nbsp;</li>\r\n	<li>4. Akun sosial media Facebook / Instagram / Twitter / Googleplus</li>\r\n	<li>5. Data Komunitas yang digandeng (yang telah memiliki ijin penanaman, ijin lahan, dan penyediaan bibit)*</li>\r\n	<li>6. Judul dan tema campaign</li>\r\n	<li>7. Lokasi dan tanggal pelaksanaan campaign&nbsp;</li>\r\n	<li>8. Foto dan video via youtube (opsional)</li>\r\n	<li>9. Deskripsi campaign</li>\r\n	<li>10. Target donasi dan harga per bibit</li>\r\n</ul>\r\n\r\n<p>Syarat-syarat di atas menjadi acuan kami sebagai bukti untuk verifikasi dan menghindari pihak-pihak yang tidak bertanggung jawab.&nbsp;</p>\r\n\r\n<p>*) hal ini untuk menghindari penanaman di area yang ilegal.</p>\r\n\r\n<p>Sistem ini sedang kami persiapkan, jika Anda tertarik bisa email ke lindungihutan23@gmail.com. Kami akan menghubungi Anda segera setelah sistem ini siap.</p>\r\n\r\n<p>Untuk melihat gambaran campaign yang ada di lindungihutan.org, Anda dapat melihat beberapa campaign kami di Halaman Utama.</p>\r\n\r\n<p>Terima Kasih.</p>\r\n', 'Creator', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `panti_hewan`
--

CREATE TABLE `panti_hewan` (
  `id` int(11) NOT NULL,
  `small_image` varchar(255) NOT NULL,
  `large_image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `partner`
--

CREATE TABLE `partner` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `partner`
--

INSERT INTO `partner` (`id`, `nama`, `deskripsi`, `gambar`) VALUES
(28, 'Kabupaten Wonosobo', 'Kabupaten Wonosobo', '-4ixiQHKOq9ADj6PshRnS3cgWbJJon2ML.png'),
(30, 'Pesona Alam Wagir Bawang', 'Pesona Alam Wagir Bawang', '-wlbxf7jsIXFWKWrmr7jxe5Nb1qtXduaK.jpg'),
(15, 'Kelompok Petani Mangrove Lestari Mangkang', 'Kelompok Tani Mangkang', '15-l9unKuAvldq00G73EuzGV3un4SEp27LJ.jpg'),
(26, 'Yayasan AIR Indonesia', 'deskripsi', '-2He1eWMULKLyNSCn5U5RQyqkAGhxVvGd.png'),
(14, 'Kelompok Petani Camar Tanjung Mas Semarang', 'Camar', '14-dRG5lwEJ71S62bsKuoGJrgDJMi80MoV0.jpg'),
(27, 'Kabupaten Temanggung', 'Kabupaten Temanggung', '-y0SPjj6QFfY2pMFyhq5poKaHMWjmiSN4.jpg'),
(19, 'Kelompok Pecinta Alam Gunung Prau', 'Kelompok Pecinta Alam Gunung Prau', '-I9coZfWfPGoYkfq3tcZmGspMHSvDubD5.jpg'),
(31, 'Wisata Alam Desa Wates Temanggung', 'Wisata Alam Desa Wates Temanggung', '-hZAXNEQhd0Sfiutt1zUcOa3oTwno3BPM.jpg'),
(21, 'Pengelola Basecamp Campurejo Gunung Prau', 'Pengelola Basecamp Campurejo Gunung Prau', '-5muvkpiJH7SK7Cc8zbqCQLRkZlQ1sXaf.jpg'),
(22, 'Perhutani', 'Perhutani', '22-ZYCRbQh3SK4BY2YbAgAapNVvWLi8YuvI.png'),
(29, 'Dinas Lingkungan Hidup dan Kehutanan Provinsi Jawa Tengah', 'Dinas Lingkungan Hidup dan Kehutanan Provinsi Jawa Tengah', '-ZInQFtYzwjzkuLbhkTor7WLEUvZT3DNU.png'),
(32, 'ISMARO Tuban', 'ISMARO Tuban', '-LOZPiAQfNHwBehXv9ptRHpsq8VcqcF0C.jpg'),
(36, 'Sampah Muda', 'Sampah Muda', '-ANEj5D8gF672JmdpVWbsk5gqgItJx9DO.png'),
(34, 'Elita Kerudung', 'Elita Kerudung', '-BCK0ZjAi3mGubWe9cYPe6FTc23BjEuLz.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`id`, `token`, `email`, `created_at`) VALUES
(2, '92e870ce9f7a5e8a27dec37161bce7b501bc35bad0360190c7b39674f88a2cdf', 'mike@doe.com', '2016-09-29 07:21:24'),
(7, '3308e00e3115fef24cdbdf74bbd2424d769da3dc9b98dc738eda614debc1285d', 'admin@example.com', '2016-10-04 09:53:20'),
(8, 'c0f6aa89ee1e126c368cc59de4c23d948d1a14d735b7344142e3d88039ad5f1e', 'guna.asch@gmail.com', '2016-11-29 03:43:47'),
(10, '43f8a8f73465c12a4a0bbcf29fd487d101e9b187d794b7d03f0e42b92ace1cb6', 'ngatikotun.khoeriyah@yahoo.co.id', '2016-12-16 17:51:21'),
(55, '56cc7477f20916590be2e63f2c6dea852bed69c1494fb1cfb6e0618790bfdf78', 'chashif_syadzali@outlook.com', '2017-02-02 05:14:21'),
(57, '27b7f2c4f71a32c6eb2de8567cafe355cb58195b88be5ca4ab0832b14e6adf0b', 'cacip666@gmail.com', '2017-02-02 15:46:46'),
(60, '72915f554f7d3bca11c0ec224ffb6a7ae96ff54774c876aa68fdfdbea6161e23', 'puspito25@gmail.com', '2017-02-05 22:33:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `detail` varchar(100) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `cara_bayar` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `nama`, `detail`, `pemilik`, `cara_bayar`) VALUES
(1, 'Bank Mandiri', '1350015070012', 'Hario Laskito Ardi', NULL),
(2, 'Bank BNI', '0497090099', 'Hario Laskito Ardi', NULL),
(3, 'Bank BCA', '1400694075', 'Hario Laskito Ardi', NULL),
(4, 'Bank BRI', '089901019925533', 'Hario Laskito Ardi', NULL),
(5, 'CIMB Clicks atau Rekening Ponsel', '085735109593', 'Hario Laskito Ardi', '1. Pembayaran akan diproses di website CIMB Clicks.\r\n2. Pastikan anda sudah terdaftar sebagai user CIMB Clicks dan sudah mendaftarkan mPIN untuk pengguna CIMB Clicks.\r\n3. Pastikan nomor HP anda telah didaftarkan melalui cabang CIMB terdekat untuk pengguna rekening ponsel.\r\n4. Anda tidak akan dikenakan biaya pelayanan.'),
(6, 'DOKU Wallet', 'harios1si@gmail.com', 'Hario Laskito Ardi', '1. Login ke website DOKU atau mobile app dan klik menu \"Transfer\"\r\n2. Masukkan DOKU ID atau email yang anda tuju.\r\n3. Kemudian isi nominal dan tambahkan pesan jika diperlukan (Email Tujuan akan di informasikan setelah anda menekan tombol “Bayar”).\r\n4. Masukkan 4 digit PIN DOKU anda dan transfer saldo anda pun selesai.\r\n5. Transfer tanpa biaya ke sesama DOKU.'),
(7, 'Paypal', 'harios1si@yahoo.com', 'Hario Laskito Ardi', '1. Login ke akun Paypal anda - lalu pilih menu Kirim Pembayaran - Kirim Pembayaran secara online.\r\n2. Masukkan email Paypal tujuan dan jumlah uang yang ditransfer. Pilih tujuan pembayaran kemudian Lanjutkan.\r\n3. Kemudian scroll ke bawah dan lihat pada \"link\" alamat pengiriman. Pilih opsi Tidak dibutuhkan pengiriman, klik OK, lalu Kirim Pembayaran.\r\n4. Saldo Paypal sudah berhasil terkirim.\r\n5. Informasi akun Paypal kami, akan kami infokan setelah anda klik “Bayar”.'),
(8, 'Penjemputan', '085735109593', 'Hario Laskito Ardi', '1. Batas minimal penjemputan donasi Rp 300.000,00.\r\n2. Petugas Lindungi Hutan akan menghubungi anda.\r\n3. Penjemputan Donasi hanya dilayani di wilayah Kota Semarang.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pohon`
--

CREATE TABLE `pohon` (
  `id_pohon` int(11) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(15) NOT NULL,
  `deskripsi` text,
  `emisi` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pohon`
--

INSERT INTO `pohon` (`id_pohon`, `nama`, `harga`, `deskripsi`, `emisi`) VALUES
(1, 'mangrove', 3000, 'pohon tinggi', 50),
(7, 'Pohon Cemara Gunung', 15000, 'Tanaman khas daerah pegunungan', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reserved`
--

CREATE TABLE `reserved` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `reserved`
--

INSERT INTO `reserved` (`id`, `name`) VALUES
(14, 'account'),
(31, 'api'),
(2, 'app'),
(30, 'bootstrap'),
(37, 'campaigns'),
(34, 'categories'),
(36, 'collections'),
(29, 'comment'),
(42, 'config'),
(25, 'contact'),
(41, 'database'),
(35, 'featured'),
(32, 'freebies'),
(9, 'goods'),
(1, 'gostock1'),
(11, 'jobs'),
(21, 'join'),
(16, 'latest'),
(20, 'login'),
(33, 'logout'),
(27, 'members'),
(13, 'messages'),
(19, 'notifications'),
(15, 'popular'),
(6, 'porn'),
(26, 'programs'),
(12, 'projects'),
(3, 'public'),
(23, 'register'),
(40, 'resources'),
(39, 'routes'),
(17, 'search'),
(7, 'sex'),
(44, 'storage'),
(8, 'tags'),
(38, 'tests'),
(24, 'upgrade'),
(28, 'upload'),
(4, 'vendor'),
(5, 'xxx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reward`
--

CREATE TABLE `reward` (
  `id` int(11) NOT NULL,
  `hadiah` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `tanggal_pengundian` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `pemenang` varchar(255) DEFAULT 'kosong',
  `id_user` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampah_gunung`
--

CREATE TABLE `sampah_gunung` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sampah_gunung`
--

INSERT INTO `sampah_gunung` (`id`, `image`, `date`, `location`, `id_user`) VALUES
(9, '20170117103553_FB_IMG_1454670472179.jpg', '2017-01-17 03:35:53', 'sangihe', 76),
(10, '20170120214625_IMG-20170120-WA0023.jpeg', '2017-01-20 14:46:25', 'hhj', 79),
(11, '20170124182155_images.jpg', '2017-01-24 11:21:55', 'Austria', 79);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_laporan_masalah`
--

CREATE TABLE `status_laporan_masalah` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_laporan_masalah`
--

INSERT INTO `status_laporan_masalah` (`id`, `status`) VALUES
(1, 'belum diverifikasi'),
(2, 'belum ditangani'),
(3, 'sedang ditangani'),
(4, 'sudah ditangani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pembayaran`
--

CREATE TABLE `status_pembayaran` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_pembayaran`
--

INSERT INTO `status_pembayaran` (`id`, `status`) VALUES
(1, 'belum dibayar'),
(2, 'sudah dibayar'),
(3, 'pembayaran diterima'),
(4, 'barang telah dikirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `testimoni` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `updates`
--

CREATE TABLE `updates` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `campaigns_id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token_id` varchar(255) NOT NULL,
  `tinggi` double(10,2) DEFAULT NULL,
  `diameter` double(10,2) DEFAULT NULL,
  `hidup` int(10) DEFAULT NULL,
  `mati` int(10) DEFAULT NULL,
  `perkembangan` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `updates`
--

INSERT INTO `updates` (`id`, `image`, `description`, `campaigns_id`, `date`, `token_id`, `tinggi`, `diameter`, `hidup`, `mati`, `perkembangan`) VALUES
(7, '11482255108duqdqbgflud9tkwguehobptjjdvhraeaxj1szb6d.jpg', 'Update Lokasi Penanaman - 17 Desember 2016', 36, '2016-12-20 10:31:48', 'AkQF4bNcUIQBhiRP8qkGFWEMnjlLfVl66GE3fHkdkodIo1bltncaga3guCWvVFzDrOR5cEy2a6Hjf5u9yeDy8V87dV11aIwk9XjqAVrMhkc5uCFYUGszY9A989jNmbKoZg0plXzkHOD210tv2N5oet1rWWLW3cmRNlR0xKnhFMaZB4drxwAak8NpDnB0RAiU8DxbFzH7', 81.00, 0.50, 2102, 11, 100.00),
(8, '11482255223s9o9fgi6qbrn7pwbiqwglsvgrl2ub16difnyak8s.jpg', 'Update Penanaman 2.113 Pohon Mangrove - 18 Desember 2016', 36, '2016-12-20 10:33:43', 'T1xrXPrbznNxBpmHwCleFwwR6B13V4ian4PIVlywwyLAVS0Viq3d0MyytUGamYMhQtRJYB9nZ8FLQeHZBM78NSQOwM6PKXDGq512ROk3gmUGSqPNY6hMrZ4DyDfHLd1OgBIomdlqSSl8py5cMPQFb15ijPHW6RPe71SMzT6r3tIHiKhsMaVw6DsQ5jN9wrXdodvYiWVe', 81.00, 0.50, 2102, 11, 100.00),
(9, '11482564439jj8iieu3jdokbdx7eakwuavycj40ge3eyv772u4z.jpg', 'Update Penanaman 730 Pohon Mangrove - 24 Desember 2016', 37, '2016-12-24 00:27:19', 'wdTxEJgc1mwn5Hrjcr8JSkqdUfaMv548IgOqf5b9TW0fe9LC8yxU80kQ2UIvVseg6GfzYiT1CUrkQUxSuplZeUGvkeUuQSmiWhNoUDuuUMlL0eiNSTmJaFD2CsM2mjokzB3YkMCaeEkQVSjOI2Y7IK2zMWuligGHd812tMIwJGXTFDVBKQlfn2HGvpqMfyBiW3eVbPP0', 50.00, 0.50, 730, 0, 100.00),
(10, '114859446302tggsk0ezwbgbxnsddqua4rxcbxxlztqgwcqkvyd.png', '#Update 3 Bulan sekali\r\nPenanaman 500 Pohon Cemara Gunung di Bukit Larikan', 40, '2017-02-01 03:23:50', 'GgX8GnFSH37YNoKevPWyoLl5iTDqQPaq9xFwrFuhjb8kYUPQ2TaZ0NoohXFOeXqJVwZW6noCCLFBmYrzIfT6sUPrUqLWLBciHPsUCy5ZpaHkod8vYT9XjxV8UEzKpLj5XrCe9BTRlxp1I6597aiNbo5GB4NGog2YaCPLGlZO5AyXh3361GehiX5mJmCTcfiS4N10DHqm', 40.00, 0.30, 500, 0, 100.00),
(11, '11488182545y7h0mz1czv2gjl3t7j2ug4rji1tkjvo67edinpg9.jpg', 'Penanaman 69 Pohon Non profit #Update 3 Bulan sekali', 41, '2017-02-27 01:02:25', 'MmzurjUrnMj1u6nUzbIFq1ABi5wFloJRBn8R3YzbeVd2C8KRQKUua86Qs9BlYftLkwtEx93bj7Sl9SpFBihltQMOcBzTV8QRZbN3n0flnoFw9NmPxPkhBjLdinq5HYGvUBNDUr18ajuNt8z2vMQZlcjYIIbhtHeA2navPMXfmGJMItXduWLDvybQkyxQjMKlV0MjzUq9', 80.00, 0.40, 69, 0, 100.00),
(12, '114889900512cjo5tqoaq2kftfgnpf4rlswgumluqgryymvipnh.jpg', 'Penanaman pohon oleh Sahabat Alam dari Nyanmar (Ghine)', 41, '2017-03-08 09:20:51', 'wLcOGU4Qk8NArvZ9SFG8YAmcsANAUiYqQdGH3MFRbDWzRERbY90HG1dfUd6B8Vu41d88AhAnG8YeKo1bQJhXwM0TlYaO7zw1AfzFgGFDeoAU0UEc5zTfu9KEWYumio1vEji90laXaYZaH51wAxbO44josabquHU8c9UQtOIk6Y7uRxgdsR3hOuSjMvdXYQJZ74DUi5VC', 80.00, 0.40, 69, 0, 100.00),
(13, '11488990160qqapihwkxhzyewsi78ecjor0hczdhkj4rxx37ayl.jpg', 'Penanaman pohon oleh Sahabat Alam dari Ghana (Samuel)', 41, '2017-03-08 09:22:40', 'wO6GzZ5NWIIrwVM2BccyQtyZDrdWxkMeEg8MvLtmiy7SH2lMTe9SIvfCmHk6JftbfuzKP6rCbh2IcddGCoUQ64ivKWmIOlqNp8k8BgSy6oYuE9lCudjA4oZapaKJjqGDcW58kM2m5RoykEroM9jyigoRXZ64b3lQgGPyMhN5S8Jbr5XxNDIIOI8rROvgozjG74CB72C3', 80.00, 0.40, 69, 0, 100.00),
(14, '11488991108u8psefi5vp4kffo58stf69vgmemfyntxeygivuhx.jpg', '#Penanaman Cemara Gunung #Update perkembangan 3 bulan', 40, '2017-03-08 09:38:28', 'VFoXx5Dt3CCqgXv7SjAIOGSghTGei5GxaA4MDIHOF58sIb2teeRR1GZZl0RiZtOhM7N5HvLu72NDEUJynO6kyuDFcQbaT51eClEnlxZC4264htJZ6VHjxrXKR56HyFgvmiDzaBhS4mtztlOxoqD0bN99dPEgPpeVgD836W29Gat7eCA8jknDRKZhn0VaT4NO0PiYxPRj', 40.00, 0.30, 500, 0, 100.00),
(15, '11490006752hnd5bd7i8wrckee7imnmlcbtqdlbgl8kxomkm8sx.png', 'Update perkembangan pohon mangrove 20 April 2017', 36, '2017-03-20 03:45:52', '1mLrJ5mC2TlVcroo91aafh3j2hpOZbGSmEj5b7tJjzLv6VKMRiexKFFnrbyE8YGp8J3aQeQjNiK3797YnEMtkwrOU4fpN8w4lSdOWfU9CUTxvvT9ZfqldZ0o75K1UjXGX123WfVeTEKcpF64QmOHVtB1tIMWrY6AGpM5fwpIxMjU0aSnbGpzodzi21RiFPoKoxatOWDC', 81.00, 0.50, 2102, 11, 100.00),
(16, '11490006752hnd5bd7i8wrckee7imnmlcbtqdlbgl8kxomkm8sx.png', 'Belum dimulai', 42, '2017-04-29 14:32:14', '123', 1.00, 1.00, 1, 0, 100.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `countries_id` char(25) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(70) NOT NULL,
  `status` enum('pending','active','suspended','delete') NOT NULL DEFAULT 'active',
  `role` enum('normal','admin','creator') NOT NULL DEFAULT 'normal',
  `remember_token` varchar(100) NOT NULL,
  `token` varchar(80) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `paypal_account` varchar(200) NOT NULL,
  `payment_gateway` varchar(50) NOT NULL,
  `bank` text NOT NULL,
  `telpon` varchar(15) DEFAULT NULL,
  `kode_area` varchar(10) DEFAULT NULL,
  `confirmation_code` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `countries_id`, `password`, `email`, `date`, `avatar`, `status`, `role`, `remember_token`, `token`, `updated_at`, `created_at`, `paypal_account`, `payment_gateway`, `bank`, `telpon`, `kode_area`, `confirmation_code`) VALUES
(1, 'Lindungi Hutan', '', '$2y$10$vCZhdRQay/pGeLPPHru3Zu6Cs4YN7kV5tXWluZ1ARIY7sPHPdgEaq', 'admin@example.com', '2016-09-09 11:04:42', '11477711950hs9fkjz59vnu970.jpg', 'active', 'admin', 'LJGmQ97f1GqFaTiRKfhLUHRZ1NzJ7IKcM5YpZtlBbRuAZMV5PJLbE7Mq2YYb', 'Wy4VkAl2dxHb9WHoXjTowSGPXFPnEQHca6RBe2yeqqmRafs0hSbCEobhNkZZAbCDIru60ceLzAAOI3fj', '2017-04-26 20:09:09', '2016-09-09 15:34:42', 'kiranlata.ca@gmail.com', 'Paypal', '', NULL, NULL, NULL),
(27, 'Siti Ngatikotun Khoeriyah', '', '$2y$10$kN8rpL3m79f3.wab53csw.BPu0/hyzSRAaw07tWNWH5t3y/TYp932', 'ngatikotun.khoeriyah@yahoo.co.id', '2016-12-12 10:37:23', 'default.jpg', 'active', 'normal', 'C3Elsjg4WlB4kr2f7BKPrZMpoGEFQB6m82AoVPbesgmkej1QJhA119TLfwtl', 'NMHfiMy4P4VDJMPOg7lVFcWD9fxawVFwDCvObCraf4u8nPr8D1voup9DjVvhF8WgWj6vDkuZ4n8', '2016-12-15 22:56:32', '2016-12-12 03:37:23', '', '', '', NULL, NULL, ''),
(28, 'Anang Safi\'uddin', '', '$2y$10$AmSXzm5z2GtzsHHs12NcsOFvkUKY5Zn7P.XnOL1VlTzkwi5uQ/LoG', 'afi.octavi@gmail.com', '2016-12-12 11:43:34', 'default.jpg', 'active', 'normal', '', 'lDkDGkjkxesHLzyS2LGMw2p3hbu0zB2UybhzuNxGw4OTx2w6P4MtrVS0TF9Vqu0aseKieh5YBGN', '2016-12-12 04:43:34', '2016-12-12 04:43:34', '', '', '', NULL, NULL, ''),
(31, 'Android User', '12', '098f6bcd4621d373cade4e832627b4f6', 'email', '2016-12-12 13:44:04', '20170423164304_31_20170413_113731.jpg', 'active', 'normal', '', '', '2016-12-12 04:43:34', '2016-12-12 04:43:34', '', '', '', '123456', '1234', NULL),
(32, 'anas absori', '', '$2y$10$EI9hU.mlMoQpok/fpmzXs.2tuUo0RUZNu2SD2pHtjgAc1EMJIvEZC', 'anas.absori@gmail.com', '2016-12-12 13:55:37', 'default.jpg', 'active', 'normal', '', 'wZ3GYfkbmqzoFXGPxJ80WmQ2Uwx6umLeO7inHpy9UabD0QiXRopo3solrrZK0DtYwo1KZbV120l', '2016-12-12 06:55:37', '2016-12-12 06:55:37', '', '', '', NULL, NULL, ''),
(33, 'haikal', '', '$2y$10$5jwGXFNs59pSTnCG6OMvkeNoDog9ZyZzZmODJP555XnN7LNxtR5H.', 'jan.ramadhana@gmail.com', '2016-12-12 16:35:40', 'default.jpg', 'active', 'normal', '', 'yEkmKqA8c0lYqqP1Pi9xeveJVdaWHz0i6KYauVi9S7VfiaXB07GFIhrOdQ6QFIIxw1tveYtF1q2', '2016-12-12 09:35:40', '2016-12-12 09:35:40', '', '', '', NULL, NULL, ''),
(34, 'Resiska', '', '$2y$10$wlZJH8hrBUDLrG/EEcYMHuBHNU3KA/KETobHb25l.4nHJawo/1KxW', 'resiskaseptianingrum7@gmail.com', '2016-12-13 02:04:36', 'default.jpg', 'active', 'normal', 'T7lqotRCvCeqZKPcDSKWYO5nlmZyACnoMCpLRhNMGiquEP2PGfxNcUsqjVpJ', 'TfUEUM1o2ET0mr7uk3tTEt391SClBVybWvyMPv7eKpKoqGSF9fYmNS69OC66ifTMkA1DdriSE5K', '2016-12-12 19:08:21', '2016-12-12 19:04:36', '', '', '', NULL, NULL, ''),
(35, 'Hidayatun Nikmah', '', '$2y$10$mWshs308sAEeRNZD1ttTxuunPGYYepa/gUxUjehuS/Ec08E5N201y', 'Hidayahnikmah10@yahoo.co.id', '2016-12-13 04:07:50', 'default.jpg', 'active', 'normal', '', '4UGQW2XTS1sZkjsIGKc4a8IR938cnqvIpEuyQrRA4q7zwnM9zMHeI9yHBckHHbhnYxlH2ItMpl7', '2016-12-12 21:07:50', '2016-12-12 21:07:50', '', '', '', NULL, NULL, ''),
(36, 'Rizky Novrian Saputra', '', '$2y$10$wn.2d.dtN4I.F6ByclkvZOEXKzM0ot0Beuiki09MdsIisjdFqco26', 'acc.novrian@gmail.com', '2016-12-13 04:20:00', '361481627116rkbfmvdyabhnutu.jpg', 'active', 'normal', '', 'TucZMi8D9h0ckkvCnBgEFA0GxincGAnAVzrUKY0HdFYjM4TM30DxBZJr4I6baDkYvgRM8C3AlTM', '2016-12-13 04:05:16', '2016-12-12 21:20:00', '', '', '', NULL, NULL, ''),
(37, 'Andhika Yudhistira Kusuma', '', '$2y$10$WLJuMC2Bv3C0/56lLOHsFO1igM3WWDpm15AKL9HpxDxuBZrOwXVru', 'andhika.yudhistira@live.com', '2016-12-13 04:41:16', 'default.jpg', 'active', 'normal', '', 'z72EG8K7TLGrXuzxoM0dMsHHE7YJDo5QCzoff74UiihkMiF8UyqxfciN05TAJSPU7sxa9fpeWTJ', '2016-12-12 21:41:16', '2016-12-12 21:41:16', '', '', '', NULL, NULL, ''),
(38, 'oiavaio', '', '$2y$10$g20vYvOlPoga.l8o087fgu7kgdZANKfWH7UJ.zbm5jPwwGVnSjv8a', 'vahn.valentine@gmail.com', '2016-12-13 06:39:40', 'default.jpg', 'active', 'normal', '', 'HDL1L4w3ENGQJs3dBDrN7cgtdTrgc68NZCstEfCEPL2cMFboGh1yi8JVFyTQM52oMNwXugRUAR4', '2016-12-12 23:39:40', '2016-12-12 23:39:40', '', '', '', NULL, NULL, ''),
(39, 'Eka Novita Sari', '', '$2y$10$DFWwkLEGdeL5sZK8AMHb.e1J7KBOOGi1PA3faT2bvPw3OUzNLIdtC', 'ekanovitasari0511@gmail.com', '2016-12-13 07:31:50', 'default.jpg', 'active', 'normal', '', '7idFH7riX9tZa7vyqmiFs6Darxbbk39iwCieGq86JaaprVPIS6NUPeLUd33ivIZGdd0QkBJLtcZ', '2016-12-13 00:31:50', '2016-12-13 00:31:50', '', '', '', NULL, NULL, ''),
(40, 'Duta Eka Prayudha', '', '$2y$10$NMxtepcsQ5asyEPi.I0rNOiKR0b4/3am/qQm0kQ3oKvdpfN5GOX8C', 'dutaprayudha@gmail.com', '2016-12-13 10:27:27', '401482108797ynsccntdkvza72t.jpg', 'active', 'normal', 'SmUuhfRoZSZr42P0BXuQjpRsiKSbpHyLCWmkRVvw7kr8578AxkwSSlUIxPvz', '1dVJqDpz4ZTkKjkT6weoBFfXymGsBxD5alGhXiXdU0NExJEA0VDL7YpnuTZLvhh5wwt4XaOuGqe', '2016-12-18 17:53:17', '2016-12-13 03:27:27', '', '', '', '085736757870', NULL, ''),
(41, 'Affan Ghaffar Ahmad', '', '$2y$10$E33C1TLhZI71uaHSIcYFselVJ.xbkzY9qV9dnbIFGfxRVRqXdN.Ty', 'affan.ghaffar.ahmad@gmail.com', '2016-12-14 01:31:36', 'default.jpg', 'active', 'normal', '', 'wc42bxLC9krRmHsQhLtbYXgQW9REnbRMnGFdgvk5MCCRmGFbzXAlW1BBlfDT8dwO01jbH54cD9i', '2016-12-13 18:31:36', '2016-12-13 18:31:36', '', '', '', NULL, NULL, ''),
(42, 'Dian Rani Yuliati', '', '$2y$10$YNchigAdrJ1xMi6Y4EpH4.r7sJDDCksOJQzsuCj3iGEvPwjPQSS4W', 'Dianraniy@gmail.com', '2016-12-14 03:18:45', 'default.jpg', 'active', 'normal', 'msASRW4dL0URboVT9Pxok9vv3iTznf61rgvAGtP4foAEkb9WGANRubVxdr6b', 'zRA3E3lPLPkrvi1pm7clHQLsmQ8rp27LxEF5RcwZo1qduHqo515GzyljRKqQmc5VErdDS1NBTlM', '2016-12-13 20:30:04', '2016-12-13 20:18:45', '', '', '', NULL, NULL, ''),
(43, 'Putri Prasetyotami', '', '$2y$10$mby/Q/WjwM8L/wWvFvYyC.muppsHGMNv1nmW9pTQdX1rOYtfZFS6K', 'myhepimeputrie@gmail.com', '2016-12-14 05:28:32', 'default.jpg', 'active', 'normal', 'U5gYmj3Aek2dLvhoy6CHPDkfnLtMqcEZRe3lOlGDnhPM8qRaPm77iverXmCv', '0dRmGBcIlHc7IhCYD0ye7syzvlwbEiDfXI7SfUmLx63iO7Gpwd5ixLsB9VCYbfJ18Dql4t7Yag1', '2016-12-13 22:28:45', '2016-12-13 22:28:32', '', '', '', NULL, NULL, ''),
(44, 'Ismelda Iyou', '', '$2y$10$F6761z52HDH6cH49HEnySe0rD0TnCwk8AVE9p7FGEkqnGiYWUKh6.', 'ismeldaiyou@gmail.com', '2016-12-14 05:37:34', 'default.jpg', 'active', 'normal', '3GTXYR8Lu57oMrca04GjRgV7ftS3fAy2RSMdSdWaudgErBmwHTZQvlsP3Da2', 'ebaySoXOURUp06zGIIDuJrxrdf0Q3raKMC5anDJTKRC6TnxaaI3Eri8dr4gTCdPcSVlrBT9vskG', '2016-12-13 22:37:51', '2016-12-13 22:37:34', '', '', '', NULL, NULL, ''),
(45, 'Gitta Agnes Putri', '', '$2y$10$mXGWxy3AVekqKxVC4SYfnOesUJAMBYLDng0gtEOadK2PNqwd8zF.i', 'gitta.agnes@yahoo.com', '2016-12-14 08:24:04', 'default.jpg', 'active', 'normal', '', '2YvoU1hH8AjazhYEMMK31FSFFZ4T02afINtpPOFjMqxgo5kfzd8Jb3uYvuAT0pDe7D3ELJ7J3zC', '2016-12-14 01:24:04', '2016-12-14 01:24:04', '', '', '', NULL, NULL, ''),
(46, 'rohmahelyyda', '', '$2y$10$prHqcEWEyCtVwmgs.XTQiOc9a28ceeDsLK/iOeeWu0Yc3PtXgut7G', 'rohmahelyyda@gmail.com', '2016-12-14 14:20:56', 'default.jpg', 'active', 'normal', '', 'Sq7dj59lJdNYDuXAOPHUaKYWwrATKXU9pwcoQWjg3ipoXci2zObjTXkbHUeKjQgPpH5h4Dg413p', '2016-12-14 07:20:56', '2016-12-14 07:20:56', '', '', '', NULL, NULL, ''),
(47, 'aika', '', '$2y$10$.0FHovAZBavaNfAobINC7O2ozj8/Iq2VpbTzmiJpKth8P7P3fZySe', 'ariskapertiwi22@yahoo.co.id', '2016-12-15 05:01:51', 'default.jpg', 'active', 'normal', '', 'GBxwr2xAlltieE4joBbR4DLiZj2mFA09fFla4Wri0Yk1uXsnqJ2QNu7oYwPsqYqMp01CgogNVpz', '2016-12-14 22:01:51', '2016-12-14 22:01:51', '', '', '', NULL, NULL, ''),
(48, 'Ranita Ostria', '', '$2y$10$UXCXKWzkiZalh/b0HJlM2eZIErrhEWgkbG2pJ6.ID1b8.hK9xL3ga', 'mithaostria@gmail.com', '2016-12-15 07:37:20', 'default.jpg', 'active', 'normal', 'HNJPli5xo4TkKB0166Z76SCcVRoqX9crEyh6BkuOs9ZJ52WkrBFGmxfgYQ46', 'c078E4SuFTTcrxdv9LTOGQtoQ15n6BTMqkoz1pz7N5ZfRH3cdUS2ovZIUQCXzPiyIFEALp8rmXA', '2016-12-15 00:37:27', '2016-12-15 00:37:20', '', '', '', NULL, NULL, ''),
(49, 'Irfan Sujahri', '', '$2y$10$Fn13/AObzG.wwZp6UfF4muXhwN9DHPpze8ZUBoA.7dFTr7k8os.tK', 'santripertiwi@yahoo.co.id', '2016-12-15 07:39:09', 'default.jpg', 'active', 'normal', 'dQsHm35mBGmO3vVuanbn2ykZ5NBnImR8WX60bFno1pFXzf2C9veywT48k4Vq', 'a07Z7bYZps9G8PZze06POIVg88svP77PJ8bWQFGARpBXAjh5eMgJ56aXXK1NNYNrQLoeYE3TGIV', '2016-12-15 00:39:17', '2016-12-15 00:39:09', '', '', '', NULL, NULL, ''),
(50, 'Inggid Kusuma Wardhani', '', '$2y$10$7EhqJSTVe7ZkXjLWrq9syeR/tZdvWfd6YA8ouvB2cC2rY6vdWuBLm', 'inggridkwardhani@yahoo.com', '2016-12-15 07:40:52', 'default.jpg', 'active', 'normal', 'I9T9zwsKfLg620sLmtKbvIfklXIxnZ52ftxVKYh2lxscXiegtNt0WVsvI0TP', '3rg7azORarezoqxuS5U1Wf7zALYKjFudqvsMksXeK6ffjh18rlTlpF9wSi3QzTswDSQLlDBIl5D', '2016-12-15 00:41:01', '2016-12-15 00:40:52', '', '', '', NULL, NULL, ''),
(51, 'Hendra Hadhil Choiri', '', '$2y$10$4eaXjkn.vDrHGl6yDyZ0fuXRuKihQbzI9TH8W37jF95OoROsMUno.', 'Hendra.H2C.x@gmail.com', '2016-12-15 07:43:56', 'default.jpg', 'active', 'normal', 'kKK8g1zOmth42gwBnI3twpd29gpAw6BfbbE7kjYGoxPAcSZGjYpwIraOkt6e', 'qbWwd7QFAoI7JxZuItkGrD14LGL1Py7ZjEZLGVPJYs3IX4zPTFrhORjMPoJEZRgJ5tK4uIsammy', '2016-12-18 03:36:34', '2016-12-15 00:43:56', '', '', '', '', NULL, ''),
(52, 'Hendri Saputra', '', '$2y$10$aOOXJph3koFvXnWFTJLvyOAaP8D8IE3llA5ow4u.0MShWChPVopOG', 'hendrijamboe@gmail.com', '2016-12-15 07:45:22', 'default.jpg', 'active', 'normal', 'sXuQPx4olNpU8zKlApiiryoLIGkN2RAxGrleVXJP0hJnJwPD3K9mN8j93MHa', 'RheXRbIG6lUbRROLNDBueX1qnpTaAaNbItRz208wyEM5qssW9Gjv4Yq5Y89Epk5eFIINwr1TyFb', '2016-12-15 00:45:35', '2016-12-15 00:45:22', '', '', '', NULL, NULL, ''),
(53, 'Rendra Rahmi', '', '$2y$10$kV3kZCuSJfK0CPojGj7Pb.xPLMO3xWg.1cuWIjDq5v7mMhTQXQQsq', 'redharahmi2805@gmail.com', '2016-12-15 07:47:08', 'default.jpg', 'active', 'normal', 'YZDGl9UPPhTMW6A7JqQstiaV15rDwdB3fyxiKuNJrICQ9SdBnWfv6r2bqlMH', 'p48tDYVUbJhYVbYWhJNqojISvQha6erVYQJCN2zSJpLIFgFscNmzMXaRXopMhUkoRmU5rW5mQg5', '2016-12-15 00:47:17', '2016-12-15 00:47:08', '', '', '', NULL, NULL, ''),
(54, 'Santri Pertiwi', '', '$2y$10$c.f7Z/uMwBmh2mS8LXLnIe72XcIhqwNLEal0oLpaC6XphhYj7wLRa', 'santripertiwi2518@gmail.com', '2016-12-15 07:48:54', '5414820571278xnl49k7r2zllnj.jpg', 'active', 'normal', 'vr9Og55oTaKwRdESC2bVQTbqD1cvYzhIcxGTeA077JBHW39IvZ8yhhbbGX67', 'yyhpeQGiBngvcfjFQoFlj9NlVv4SPqS2hlXnkZhEkKUB1eAJvfIPn1mtTG2oc1yZ4zOYvUAHEd0', '2016-12-20 05:28:12', '2016-12-15 00:48:54', '', '', '', NULL, NULL, ''),
(55, 'ben', '100', '$2y$10$XzUZMAN.KUwPkpg0xSIDi.GOvyF1JDeciikz.lZJvwgMVzQqKP6uu', 'mrbentm@gmail.com', '2016-12-15 07:56:43', '', 'active', 'normal', '', '', '2016-12-20 05:28:12', '2016-12-20 05:28:12', '', '', '', '085290397750', '50266', NULL),
(56, 'Puspito Raharjo', '', '$2y$10$khC43MS2sFCA.PiTtJSct.2PUaTrmWFLSbhmIzCrcASgArjS0cdFK', 'puspito25@gmail.com', '2016-12-16 09:42:56', 'default.jpg', 'active', 'normal', 'aGEIEGooE92BayAwtdG23F7QoJ3row6c8f35YowTkVT4L1oL4XwC2xTwmBwA', 'gPouudBbHdVPfBG1mRlGknnM0fdWLnCmdGFc6892gKmEqh4iDjHfseVHs2iwUNyTUj2HjWkPvp4', '2017-02-10 00:55:59', '2016-12-16 02:42:56', '', '', '', NULL, NULL, ''),
(57, 'Ginanjar Setyo Permadi', '', '$2y$10$hf8m9MuZkjAPVsQ8GRjvXOmK4R.EQgLEFSeSINtvIv1laDzoPi/Oe', 'Setyoanjar14@gmail.com', '2016-12-17 10:41:12', 'default.jpg', 'active', 'normal', 'eh0hxB1SoLsgFHtCeTyDXpJ4QOJekWiKps4ewUHunrlYih4oyoOxzFRy9Jit', 'B3vnPWIIilZkHdC4QXXYugMWzm2iKwucUOfplNvYLeTHySf8LaL0bXhWT3YdOScvbUScOFbtPEg', '2016-12-17 03:41:25', '2016-12-17 03:41:12', '', '', '', NULL, NULL, ''),
(58, 'Tanhella Zein Vitadiar', '', '$2y$10$RmTvWWklnAQ/amSD5bZbr.uZDP.k3SPUnkd5.rvqtIj2Dy0ItcdSG', 'tanhellavitadiar@gmail.com', '2016-12-17 10:42:48', 'default.jpg', 'active', 'normal', '', 'mH4kXA9uC7zfHJMXdVmAxRKmIzflqOolzkmswq5EL1nvvlCoB9Xr63VoG2ayvQaWuiPltL1PmEM', '2016-12-17 03:42:48', '2016-12-17 03:42:48', '', '', '', NULL, NULL, ''),
(59, 'wining', '100', 'e172dd95f4feb21412a692e73929961e', 'wining1012@gmail.com', '2016-12-18 00:52:44', '', 'active', 'normal', '', '', '2016-12-17 03:42:48', '2016-12-17 03:42:48', '', '', '', '085736465212', '64484', NULL),
(62, 'roberto satria', '', '$2y$10$jkxAaCTjPQS83.g0gjjSc./I1.fAKD39jpf72HeEuh23nlz2Nnl2.', 'satriaotrebor@gmail.com', '2016-12-20 06:15:24', 'default.jpg', 'active', 'normal', '', '5URzoO0NQIZn8GUjcMLOgqkPLgefasUq9sAY2lpKI6kUjO8jnr6Q8xkuMPSbc77PT3vP9iDQkeS', '2016-12-19 23:27:50', '2016-12-19 23:15:24', '', '', '', '085730589756', NULL, ''),
(63, 'hemasinggarbono', '', '$2y$10$q1g.mo7/JC74r4.1NDjKf.jv3mETCttQyRRJgOf61DbQQ8.9IXuKS', 'hemasinggarbono@gmail.com', '2016-12-20 15:06:47', 'default.jpg', 'active', 'normal', '', '0YCJyx0vqBIYThh7UnhNeQEMVgmC4KsNZ1GscSjHznLCRto9EK57YWLQVIUKal4YgzQWHBDvtS5', '2016-12-20 08:06:47', '2016-12-20 08:06:47', '', '', '', '085732558249', NULL, ''),
(64, 'Bambang Kelik Budiharso', '', '$2y$10$i22Z9SqmiZUUyZ9waITtX.ukJ.CGnfDeJlf6qzB8nZA80jZhHk8Qe', 'anakjamur@gmail.com', '2016-12-21 03:23:52', '641491182188nkbq7gk6pr2whmu.jpg', 'active', 'normal', 'cpx4E6tp27G20IHfHnbnLMy6XmvU47yXpRHZY7CFZI4HKJJFmRlNOIglPGOm', '8Jfnf6kMqemK9hHL08PVUVAfPQdmqBJNRzGM2FLJW7getQ99snp0mXMDWvgMPyucTqzdT2vMx66', '2017-04-02 18:20:18', '2016-12-20 20:23:52', '', '', '', '085648395171', NULL, ''),
(65, 'Yuliana Dini Ika P', '', '$2y$10$XlSCrVQ5V8GCn.7gbl70OOfycDmsZdvRpkTaZ/XMm0IljKAKQ39OK', 'dnika3354@gmail.com', '2016-12-21 05:31:46', 'default.jpg', 'active', 'normal', '1tP8h2K1NqRP3Sf5oTHSdZsEvQnicSOLxEfl4iUzaOIhzQdYw9gKmxxrHn6q', 'AT16ifbDPnd6DUa9g3iuL506deWO2m4Iv9Hv9FaFOEcbwieOtfJihVhZu8J4UgYmmqYhlPe5J4t', '2017-04-05 17:33:33', '2016-12-20 22:31:46', '', '', '', '08562703662', NULL, ''),
(66, 'Winda Dwi Astuti', '', '$2y$10$71oOiOyBm6BtehT0jjqJ..Ca.jqwNVZVZw/KNntm5COXxYFOxDwEG', 'windadwiastuti4@gmail.com', '2016-12-22 02:36:29', 'default.jpg', 'active', 'normal', '', 'a385zEptxq4ah7UrtsFU0t4EncSKi2QERWHQKsTqyJUl0yuuiwliKmd8VtT2FX2t2qpqrWPIiBd', '2016-12-21 19:36:29', '2016-12-21 19:36:29', '', '', '', '089654895632', NULL, ''),
(67, 'Eka Tia Saputri', '', '$2y$10$DfdNbCP464WCVW2g.xBUbeSp017uN/pqozdldv9in7Eo7TbsyqttW', 'ekatiastudyaboard@gmail.com', '2016-12-22 03:15:46', 'default.jpg', 'active', 'normal', '', '7Rgg3hxJu4vG4tA5qIJ9kNWi7kiv2du1N842KCl8OzS2eE9nXte1DWbJRdTM8Btb4xVJkbzLdFL', '2016-12-21 20:15:46', '2016-12-21 20:15:46', '', '', '', '+6285741553016', NULL, ''),
(68, 'nurcholis majid', '', '$2y$10$t/Kho7mH10bwCYI4.9WOeOKVmO6eGFVKN82yV2cJIZuDLk4bneJNy', 'majidnurcholis98@gmail.com', '2016-12-24 01:20:25', 'default.jpg', 'active', 'normal', '', 'o6GnnY1RSwiLrXFPqF66zrqdIxSTUw2ZqK7As8wFhHeLhgchWttWXWI1eesDG31qrPFDfALDkzK', '2016-12-23 18:20:25', '2016-12-23 18:20:25', '', '', '', '082326467295', NULL, ''),
(69, 'tes user', '', '$2y$10$lTIOpav4P3ZpXl2O3aWU3u7Tcguw.4dutpzjOTYjbS9rEQRWHRjOC', 'cacipxxx@gmail.com', '2016-12-24 07:44:54', 'default.jpg', 'active', 'normal', 'LAWSKBYvbzvtl4z5R6O3h72zYosexUCJmfyJGNNrpXggJu2IVgEvcT2SyJ5Q', 'Pwjwy1cdvoXmDy6HEIswOROlHceKjtuoJjlwrhcDK0Ebu04WNB0jSrsH53Rc8rJ7Js8uACq1DgI', '2016-12-24 00:46:24', '2016-12-24 00:44:54', '', '', '', '085795656662', NULL, ''),
(70, 'S Elita Barbara', '1', 'baa323bd71d9ee4ba63e519eb57f0a0a', 'elitakerudung@gmail.com', '2016-12-28 11:34:13', '', 'active', 'normal', '', '', '2016-12-24 00:46:24', '2016-12-24 00:46:24', '', '', '', '081252252838', '55281', NULL),
(71, 'nama saya', '', '$2y$10$UgelWasETPJAuYkLYrjRQOaA037mnF2YO429BJYKQ276CViEjkpda', 'rifky2fuady@gmail.com', '2017-01-05 16:55:58', 'default.jpg', 'active', 'normal', '', 'OxK7c54c0hyiC0y47uZTqSlVMKPn5R52lSFCXqYmWSK3pKImrnF5XOjBh8AvEfEI3JYn019XQB2', '2017-01-05 09:55:58', '2017-01-05 09:55:58', '', '', '', '087733554488', NULL, ''),
(73, 'lisa', '', '0fb60610f65d0df248432fabfa312c76', 'ardi.pembuatjejak@gmail.com', '2017-01-12 05:39:05', '20170212190844_Screenshot_2017-02-12-19-07-00.jpeg', 'active', 'normal', '', '', '2017-01-05 09:55:58', '2017-01-05 09:55:58', '', '', '', '0821234566', '33333', NULL),
(74, 'Gravita Eka Purnama', '', '81cd569a11cea2d243c2c325c0339a60', 'eka.gravity@gmail.com', '2017-01-16 08:09:24', '20170222222514_IMG20170218115921.jpg', 'active', 'normal', '', '', '2017-01-05 09:55:58', '2017-01-05 09:55:58', '', '', '', '082138949293', '56266', NULL),
(76, 'Noldy', '', 'e19437744a5cb45f7053bdc353c50c07', 'sinsu.tekno@gmail.com', '2017-01-17 03:33:56', '', 'active', 'normal', '', '', '2017-01-05 09:55:58', '2017-01-05 09:55:58', '', '', '', '082347887227', '98534', NULL),
(77, 'januar febriansyah', '', 'c1271f0770065f467cb4478a43845245', 'noeank@yahoo.co.id', '2017-01-17 05:12:02', '', 'active', 'normal', '', '', '2017-01-05 09:55:58', '2017-01-05 09:55:58', '', '', '', '085691074314', '440140', NULL),
(78, 'Miftachur Robani', '', '0ae062528baca447ade0574798d92f4f', 'aljabungani@gmail.com', '2017-01-18 04:08:47', '', 'active', 'normal', '', '', '2017-01-05 09:55:58', '2017-01-05 09:55:58', '', '', '', '085290397750', '50266', NULL),
(79, 'agus', '', '0fb60610f65d0df248432fabfa312c76', 'adhator@gmail.com', '2017-01-20 14:38:51', '20170121132102_IMG-20170121-WA0026.jpg', 'active', 'normal', '', '', '2017-01-05 09:55:58', '2017-01-05 09:55:58', '', '', '', '085735109593', '8999', NULL),
(80, 'herman', '', 'c99de7f59073775100f6f342ac7bd757', 'herman.sutrisno@yahoo.com', '2017-01-22 11:58:27', '20170122190037_IMG-20170122-WA0020.jpg', 'active', 'normal', '', '', '2017-01-05 09:55:58', '2017-01-05 09:55:58', '', '', '', '081392846413', '6429', NULL),
(82, 'junaidi', '', '$2y$10$Xf4JfloKqWFrd7LT3zwKsuIbgP9WXrI8Nx1yfBitc/zwttFwGJuOa', 'junetoi_jakbar@yahoo.com', '2017-01-26 07:57:28', 'default.jpg', 'active', 'normal', '', 'Jguh2VxRKjtcj5uXZ7ZQSNnUOZEXfwnPc4Kdeetx8zARDxcDUyfmBhXL9vZzTLFhv6GpI59jMkw', '2017-01-26 00:57:28', '2017-01-26 00:57:28', '', '', '', '081288478710', NULL, ''),
(83, 'Gunawan', '', '95408ac6ead034cbf75340e043869b52', 'guna.asch@gmail.com', '2017-01-27 07:24:13', '', 'active', 'normal', '', '', '2017-01-05 09:55:58', '2017-01-05 09:55:58', '', '', '', '0318960201', '61233', NULL),
(84, 'Ismail Agung', '', '$2y$10$N4fbo7wVTDe7Q5jROGmYFujih3pE0ktlqBKA1KnbImMF.6G4pvA26', 'ismailagungs@gmail.com', '2017-01-27 10:44:43', 'default.jpg', 'active', 'normal', '', 'VQhUDmiwACHpIHXEgLv0kbRM8IBwIq5zH5isOa0wfGbiSDleRpzT4O1bCj0MsygVTbH4VnEMrr8', '2017-01-27 03:44:43', '2017-01-27 03:44:43', '', '', '', '085395647863', NULL, ''),
(85, 'ison', '', 'ae1ce77bde70ebe60071a5503c9b6d0c', 'son.adventures@gmail.com', '2017-01-30 18:28:08', '', 'active', 'normal', '', '', '2017-01-27 03:44:43', '2017-01-27 03:44:43', '', '', '', '087808202708', '56266', NULL),
(86, 'Dinda Permata', '', '0cca84fd90e4050de4863ff6215c5dc3', 'dindaprmt27@gmail.com', '2017-01-31 04:12:49', '', 'active', 'normal', '', '', '2017-01-27 03:44:43', '2017-01-27 03:44:43', '', '', '', '085725970371', '55283', NULL),
(87, 'tes cacip', '', '$2y$10$CDZK9CSrOzAkayXjpsNcg.dQKaryAN9GwD6As2VF1JIiwzDVsPyRy', 'chashif_syadzali@outlook.com', '2017-02-01 08:16:30', 'default.jpg', 'active', 'creator', 'feevyAdEwOP23phev2BaIyV6I4CYR1BUVxTuqpRuCsxKiBIWXc3qIoePT017', 'omDLAE1t1ZkhiEaPsgnRgdukcQHgBE4nMH4t0fRZjtFthMgnVSMppruBDkFu5sgnc1otu2UOADw', '2017-04-26 11:02:56', '2017-02-01 01:16:30', '', '', '', '085795656662', NULL, ''),
(88, 'chashif syadzali', '', '$2y$10$PAVBI.y4LpA0xHZg/yrboe6UvCWXVFgXez1yU5vBTOSlaIkWzgLTe', 'cacip666@gmail.com', '2017-02-02 07:42:37', 'default.jpg', 'active', 'normal', 'pndGI59UVW2Ibf4wZLe6o37xZnc7rqSuxXVcFlf2DJ9LNh3jFI0LYJNSTw2v', 'BZlKhpGoP3bkApeDKTMnAXZhYllIumTvs52kvEETpwVaAuYjBs64Cuj64EEfVSABJjxdDSDg3ts', '2017-02-22 04:07:51', '2017-02-02 00:42:37', '', '', '', '085795656662', NULL, ''),
(89, 'arif', '', '91f5d68000dda0da689fb4d35b78d872', 'areefmuhammad04@gmail.com', '2017-02-03 14:55:14', '', 'active', 'normal', '', '', '2017-01-27 03:44:43', '2017-01-27 03:44:43', '', '', '', '085229136931', '57166', NULL),
(90, 'yoiyok', '', '$2y$10$3O85an8lZ1fkK4ISTQdkU.aFtJfSvRTJCLqpMKbuJUqVmfyKBCbMW', 'omyoiyok@gmail.com', '2017-02-04 11:09:17', '901487218435vdofybc3umecceg.png', 'active', 'normal', '2qqmU1A1cTc8ygEJhY9vzaaPu3Yws9xw5rDiAWogGoJr1u7F6WXyO9SJxYAs', '5nqsRkrcijYM5gEOP1Uulo4b9v7QAwRaCjwvP6t9Flzx9s4USyEpg6y8FwbbkVeQMVqGEr3WGQN', '2017-02-15 21:13:55', '2017-02-04 04:09:17', '', '', '', '081226591204', NULL, ''),
(91, 'Dennilia', '', '2dcebc7a5b7462a77aaa6c32f8a568ec', 'n.dennilia@yahoo.co.id', '2017-02-04 11:33:05', '', 'active', 'normal', '', '', '2017-02-15 21:13:55', '2017-02-15 21:13:55', '', '', '', '085708959448', '66111', NULL),
(92, 'aisyah', '', '41d4863c2fb2d790556b8c7c7516f224', 'snad.nafah@gmail.com', '2017-02-04 13:48:06', '', 'active', 'normal', '', '', '2017-02-15 21:13:55', '2017-02-15 21:13:55', '', '', '', '085725883089', '59372', NULL),
(93, 'AMAT BASIYO', '', '$2y$10$jXVlMp8JLNXcPOMNSTlPau0a/h0g/6x0isI494cud.vjojxOSsdN6', 'basiyo71@yahoo.com', '2017-02-04 18:22:14', 'default.jpg', 'active', 'normal', '', 'ZbcTOFheRlplbM5dVYKuaD3iMMFekAfDhhvTMP5ShKt4Hu8lrlN5CxLqd7x9u9aEzXnLo2Sn9Rp', '2017-02-04 11:22:14', '2017-02-04 11:22:14', '', '', '', '0818898256', NULL, ''),
(94, 'nur yanti', '', '616f8a270777e7146e26112d278b9111', 'elyuukaido@gmail.com', '2017-02-05 04:42:31', '', 'active', 'normal', '', '', '2017-02-04 11:22:14', '2017-02-04 11:22:14', '', '', '', '081328120272', '56271', NULL),
(96, 'hasto', '', 'ed942b311b28dc1595c0d05db7ecb83a', 'hastowahyudi@yahoo.com', '2017-02-05 23:43:17', '', 'active', 'normal', '', '', '2017-02-04 11:22:14', '2017-02-04 11:22:14', '', '', '', '081325058787', '14117', NULL),
(97, 'basuki', '', '928efc6e2cb641c5c6516e7e8afa5381', 'hambarabasuku@gmail.com', '2017-02-06 00:12:29', '', 'active', 'normal', '', '', '2017-02-04 11:22:14', '2017-02-04 11:22:14', '', '', '', '081311303779', '12770', NULL),
(98, 'hambara', '', 'e2a92da8fe6c8bf3ba3092e57c47a546', 'bhambara@yahoo.co.id', '2017-02-06 01:15:24', '', 'active', 'normal', '', '', '2017-02-04 11:22:14', '2017-02-04 11:22:14', '', '', '', '081311303779', '12770', NULL),
(99, 'Andreas Tedy', '', '7db5eb95c1025bb5ae80387fe5738f6a', 'antedy@gmail.com', '2017-02-06 05:43:52', '', 'active', 'normal', '', '', '2017-02-04 11:22:14', '2017-02-04 11:22:14', '', '', '', '08112717239', '50148', NULL),
(100, 'Haning', '', '$2y$10$wMGNpayX1Ci1MYTNz.V1/eMVUjEuK4yVVyuza0NkrjBKVL6JlU9zy', 'haningprawirabrata@gmail.com', '2017-02-07 01:53:39', 'default.jpg', 'active', 'normal', '', 'hthpRvLaw0zNkMsjG2cjgvE28LTyK7jqMfuwogYZ7unH1KHFJjYKCKgj81ayeqJNwKBb2J3c3Q9', '2017-02-06 18:53:39', '2017-02-06 18:53:39', '', '', '', '081296336868', NULL, ''),
(101, 'Lindungi Hutan', '', '$2y$10$ohDYv1.L3oFcFiWiHrnk/.mEontnVIhixw6s4yp/OqG1tW2t3ECci', 'lindungihutan23@gmail.com', '2017-02-07 07:05:30', '1011486452222oxga093tc3oiisd.jpg', 'active', 'admin', 'ZqKG3HYk2L8J82LSHaC0UkFd5YfD3e1I2C4lz9DErfGftUjiWvk1R5YZkIjA', 'fBKwdY454s9hiUXqkwVYKInrr8GsjDl4M8eqrYc9WHy737FpEe47Bib3TW0IuXGGczXNmU1wJI5', '2017-02-26 22:58:26', '2017-02-07 00:05:30', '', '', '', '085735109593', NULL, ''),
(102, 'vicq', '', '$2y$10$/5ibumy6d8AmjDxqWyb2Z.Gt6Ecqxk3ZG.QXRDyUVLYC5UW46uNtS', 'awangvq@gmail.com', '2017-02-09 13:41:45', 'default.jpg', 'active', 'normal', 'hh67AuOfKOb9GkPH87GGibBJmLMvpxJGBpM2SAlLWFqn9ZCwpLluMAboBW0K', 'DnZSXkXItTXFI3n7A06SFTJEST6fU7Y08dz7Vd27XseBUAvXZoqrMmnVnPFkUujh7CJwmfSA2hz', '2017-02-09 07:33:37', '2017-02-09 06:41:45', '', '', '', '081391386690', NULL, ''),
(103, 'simson', '', '$2y$10$EEaYXOYqNu0aVeOKjPfi2uPm3mEbseaNkkhZPNF92wMn4Iffmd7mq', 'simson.tondo@yahoo.com', '2017-02-09 14:18:50', 'default.jpg', 'active', 'normal', 'e00qZssreBBolF5FwWo1Ppw8Ilp0XgjQEtrXF2BWITxM91YH7X9BJXCQapJp', 'jC9UsF7ikZ9tAHhCyD0zBoGhM5zttIIOUGcs3Kn7iWkUCcnTQOfj5w3jA5KRSPMRaSbh1ZUGsns', '2017-02-09 07:27:54', '2017-02-09 07:18:50', '', '', '', '081244905680', NULL, ''),
(104, 'Irman', '', '$2y$10$ZJmbobJtRmn/xiJNlmkp2uJQ2mCxN.FmrPsxLsgYixsyk1Qooedf6', 'Irman08.08@gmail.com', '2017-02-10 02:09:53', 'default.jpg', 'active', 'normal', '', 'R8xuoiYZlOgD9CA0MxmkyzFrrHpFU29UnQBpizEfLaoII1RSgX6COYZlZSLcZ2aisXBHMHjfMCk', '2017-02-09 19:09:53', '2017-02-09 19:09:53', '', '', '', '085244278171', NULL, ''),
(105, 'Rio09', '', '$2y$10$NNMQT.YgsaXlFAO5QHMbP.h/vdf7AdOHX7HBMcLTI4Quxpex9uoEe', 'wellikenrio@gmail.com', '2017-02-10 03:55:49', 'default.jpg', 'active', 'normal', '', '1Kz9uRb5Xjqv9iCta4vb3mvnPhPvG7ellDrqQM2ElZsuV7NiYWfH3O56c6QpTjVRKiXRhcvKtjc', '2017-02-09 20:55:49', '2017-02-09 20:55:49', '', '', '', '081247327276', NULL, ''),
(106, 'hahj', '', '0fb60610f65d0df248432fabfa312c76', 'agza@gmail.com', '2017-02-10 09:32:28', '', 'active', 'normal', '', '', '2017-02-09 20:55:49', '2017-02-09 20:55:49', '', '', '', '085665555', 'ghhhh', NULL),
(107, 'Idola Dian Yoku Nebore', '', '$2y$10$xa.bzFHA2Uks4Yw/wmh6zu4f1avV/sBhp3mz4Dtl2ajfyRxzeVD1e', 'idoladiannebore_bio.unipa@yahoo.co.id', '2017-02-11 15:06:40', 'default.jpg', 'active', 'normal', '', 'o1axIOJ9w4NrJ41oJgO5cWOPLKCwGzfzPHFLDdNIyDyZEX0WIAVlvexU1jwAvdSdLfLS5PujdHg', '2017-02-11 08:06:40', '2017-02-11 08:06:40', '', '', '', '085254770755', NULL, ''),
(108, 'andhy', '', '920819d59cf7267c1c72c1e24f9e215e', 'aakurnieawan2396@yahoo.com', '2017-02-12 06:13:04', '', 'active', 'normal', '', '', '2017-02-11 08:06:40', '2017-02-11 08:06:40', '', '', '', '083838037496', '51363', NULL),
(109, 'farid', '', 'd4f3dcc8bed882583812f49cebf8e6e3', 'maxx.stick@gmail.com', '2017-02-14 09:02:17', '', 'active', 'normal', '', '', '2017-02-11 08:06:40', '2017-02-11 08:06:40', '', '', '', '0', '0', NULL),
(110, 'Efra', '', '$2y$10$/UIRnLnMQYk4Mm999HEi5OiOkDCqGlphj73QorSQoRHxZU/O1qVYa', 'sfraystruggle@gmail.com', '2017-02-15 00:59:16', 'default.jpg', 'active', 'normal', 'seH3u9hr9d5vUqsppEpYtvel66d3P52ZM0O2CYMAHdErVA7lfPofdOhx3QxN', 'bceeS6xI8wBIRirWkkBWaraPmmChYbF1vNXoZcyuYTCbzeLGaXn2ZRimky4JtdgC2bhRIUncN71', '2017-02-14 18:02:10', '2017-02-14 17:59:16', '', '', '', '081344443271', NULL, ''),
(111, 'lina', '', '86b002dcf1942d8089e504a96897088b', 'murti.lina@gmail.com', '2017-02-15 11:12:41', '', 'active', 'normal', '', '', '2017-02-11 08:06:40', '2017-02-11 08:06:40', '', '', '', '082129165551', '40561', NULL),
(112, 'Ardityo Hendi Prastowo', '', 'c9ee0932895ded37791e32e7b1121064', 'ardityohp@gmail.com', '2017-02-17 02:23:08', '', 'active', 'normal', '', '', '2017-02-11 08:06:40', '2017-02-11 08:06:40', '', '', '', '082137080454', '55721', NULL),
(113, 'Komang Jaka Ferdian', '', '$2y$10$jZjR4wQIyvLKE9s9n9iGtuzr8SKHE1QgpCcZPwsK8hIjs1eSS2N.q', 'Komangjkf@gmail.com', '2017-02-19 13:14:49', 'default.jpg', 'active', 'normal', 'a12bdoCNEbx8KFWZoHDMrYIJ3VNQqRus2c9FWQ7mGzatZfrsSWFGBIRzDVCs', 'q48lh3oEOfZJhnwAEpEOpexNbF2sIEVAfT0PZPZUfJChjwfykkJiJwJ4NMnj9BNyi10LTqz6GOZ', '2017-02-19 06:27:30', '2017-02-19 06:14:49', '', '', '', '0819694630', NULL, ''),
(114, 'In Pasaribu', '', '$2y$10$R2qWB4XwVV9mqhwPIUIDRuuwuUYtqQ5NZM/UKTUHLBCSWCwxRRxG6', 'ianpasaribu20@gmail.com', '2017-02-19 13:19:22', 'default.jpg', 'active', 'normal', '', 'wBByyP9fRJwGDa9hxqfcJHi9nHT4XNRxwIsb5EWBMHdTDyD5aipZs1fCnGKTe8o50GK4l4M9AcE', '2017-02-19 06:19:22', '2017-02-19 06:19:22', '', '', '', '085206019890', NULL, ''),
(115, 'yan', '', '$2y$10$RsDC6I3zePlw9oNP2DHDe.ayzV2teaaIau8qyr.kp0ph5j3X6ewhW', 'yankogoya@gmail.com', '2017-02-19 16:27:30', 'default.jpg', 'active', 'normal', 'X70sMSXDukvWxoJGS0FmsXnqNbTQqwJFnh3gLYCODrp7oEIuFGC7q0o2rQKx', '6YrpEuUjiAEg2WIhCnhy84aP14Kl9u9WHYCgrrWabNnhST9IRegIAEhd3Bkq9b0E7bT4hBSGs25', '2017-02-19 09:30:48', '2017-02-19 09:27:30', '', '', '', '081215632591', NULL, ''),
(116, 'Asti Awiyatul', '', '$2y$10$7Y/eoYhOotNiQYfoktjU1ehEGtrRndl08NNT91UMVLUeUhERW/32.', 'Astiasti.awiyatul@gmail.com', '2017-02-24 07:20:38', 'default.jpg', 'active', 'normal', '', 'AWR9hGJbRm4DsCXRcahnXgJ1dDltEh5GaVajXXfFmdnMjbvZN73jnw0YKBDqdLRzdO27bcJkgQ0', '2017-02-24 00:20:38', '2017-02-24 00:20:38', '', '', '', '081327207752', NULL, ''),
(117, 'alwi', '', 'a8f3e9dad3e2505f7c77f82ad8f02949', 'muhammad.alwi9@gmail.com', '2017-02-25 02:31:45', '', 'active', 'normal', '', '', '2017-02-24 00:20:38', '2017-02-24 00:20:38', '', '', '', '08562775872', '51192', NULL),
(118, 'JohnnieSeina', '', '$2y$10$MPsldXjHP.d7PUkDBmKDKekiXTT1Eu3xdwfIsm12d5nv.duD/ls9y', 'johnnie53@mail.ru', '2017-02-25 19:09:24', 'default.jpg', 'active', 'normal', '', 'i6mgOvRpEOvFhwLqFJJSTbCy0SndqfgChm2YZCOkbZ7tilRTsfCjot61gKR7a6mhMrQgvmzI8AX', '2017-02-25 12:09:24', '2017-02-25 12:09:24', '', '', '', '86243693512', NULL, ''),
(119, 'Lingga Hardinata', '', '551471210baf519dcfad78281d838d09', 'linggahardinata@gmail.com', '2017-02-26 06:14:02', '', 'active', 'normal', '', '', '2017-02-25 12:09:24', '2017-02-25 12:09:24', '', '', '', '081217632536', '64471', NULL),
(120, 'Michael Raffy Sujono', '', '$2y$10$IxKwnWEOcLEevtlyiQV9yOb69AKDeA3JHodUC2s7tM071Uiv6mZi6', 'raffysujono@gmail.com', '2017-03-04 12:26:39', 'default.jpg', 'active', 'normal', '', '0WTpgcPQr4FHzBYhGRupir4ylSCz9A8uaycrmtZRhPYXmUVQYAeufMRfo2NA3OqvpmcfY8S3HcC', '2017-03-04 05:26:39', '2017-03-04 05:26:39', '', '', '', '089654319101', NULL, ''),
(121, 'surya', '', 'fff36e45666d7a8ff24d23c9b6be20f7', 'surtazzadista@gnail.com', '2017-03-05 08:32:35', '', 'active', 'normal', '', '', '2017-03-04 05:26:39', '2017-03-04 05:26:39', '', '', '', '0895365043680', '53457', NULL),
(122, 'Heru Gunawan', '', '9ea67d1c6556eb6f1079e821ee37ac99', 'herupataba@gmail.com', '2017-03-06 12:15:40', '', 'active', 'normal', '', '', '2017-03-04 05:26:39', '2017-03-04 05:26:39', '', '', '', '081245210099', '94371', NULL),
(123, 'Vina Zahrotun Kamila', '', '$2y$10$QwhnYa4yR1g998OJVQFmUeNo.R6OczziP1hE03tPj0H51/fTWZw1K', 'vinakamila@gmail.com', '2017-03-08 05:05:50', 'default.jpg', 'active', 'normal', '', 'fcCuODngFOF2L51UN3isRlcQPudbpK8616KEFi8avRNeLcvjqusymPfysicooCOPFm5p5qJOcH9', '2017-03-07 22:05:50', '2017-03-07 22:05:50', '', '', '', '085740181270', NULL, ''),
(124, 'umbu', '', '$2y$10$/ab0kM5rs9sB94IcqK5T5.gN16uoLfp80JhPtqdRnix7H6JoMRBB6', 'umbukapu@gmail.com', '2017-03-13 09:43:35', '1241489398283oe7t6sjeg7vjjhm.jpg', 'active', 'normal', 'V4hLqKQ6Ueh4F7CuFPq87whoZgzFjmNkP6CU0q2AVRs9U1PghcuVjI9HABu2', 'WnfHWs5DQCrX0qt6v1szysdLRys73PsJwbD7TUGgPlmvMbZXuDPyYWA4tsvDZG2OXCc8xxxYQ42', '2017-03-13 03:02:39', '2017-03-13 02:43:35', '', '', '', '085333427656', NULL, ''),
(125, 'prince', '', '$2y$10$x7CGJYeam.t/yoEGred09.ucBURSMWQ0pRpWvwozRB5aZOhwRfUPm', 'princepm4all@gmail.com', '2017-03-13 12:37:39', 'default.jpg', 'active', 'normal', '', 'VbRb9LsRFS9ADgiI7GpthvTJvKq9GrmbOsfoao64xoy0g0wPNEtxaW5bDOr5pUZHF0bpGC3nPCh', '2017-03-13 05:37:39', '2017-03-13 05:37:39', '', '', '', '07068982624', NULL, ''),
(126, 'rifqi nugroho', '', '$2y$10$/N77CJkbm2YY3yNPkK2oYOzsXusEmtxe9RqK3LnSiVM8b.hKGCnou', 'rifqinvgroho@gmail.com', '2017-03-15 02:34:20', 'default.jpg', 'active', 'normal', '', 'LCBVc1Qih51EcjVZz47y7jkx3s1nN0yXK03stob6VaPqLfCrn0G8BHaHE0aqdOPOEkJ8Z8T3XlP', '2017-03-14 19:34:20', '2017-03-14 19:34:20', '', '', '', '083838032100', NULL, ''),
(127, 'Monox', '', '$2y$10$ay2TTPUONmoCACRdi2jqJOYI.HlIiMhAfu0vS8LdD0T5VPv12T7tS', 'kirbagbag@gmail.com', '2017-03-16 17:52:59', 'default.jpg', 'active', 'normal', '', '5wBJOgUSn27BeOWmHrXD6DarZa7q7jOHh19m9gh6fenHlh4f5KCiMaXxMQOP7hTtttoKR6ej9rz', '2017-03-16 10:52:59', '2017-03-16 10:52:59', '', '', '', '085742434812', NULL, ''),
(128, 'Handi', '', 'df15fec00436044ab6b15baeb707ee89', 'handirizkywijaya@gmail.com', '2017-03-19 15:38:44', '', 'active', 'normal', '', '', '2017-03-16 10:52:59', '2017-03-16 10:52:59', '', '', '', '081297455595', '10630', NULL),
(129, 'nurdin', '', '18bb6f5184b0762187330ab03bbd51eb', 'nurdinsty2013@gmail.com', '2017-03-20 11:32:11', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '081375461931', '20155', NULL),
(130, 'yandi', '', '4af22bf8a17ff13f1c5a778e2aa1925f', 'yandimalaki@gmail.com', '2017-03-20 14:54:16', '20170320215945_1488790668977.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '082167897004', '23245', NULL),
(131, 'Yosia Adetyawan Prasetya', '', '70fa5b28ab5e5fa63ff4d8f6f4ecdd57', 'yossiblues98@gmail.com', '2017-03-21 07:37:29', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '082292651956', '55221', NULL),
(132, 'Christine Margaretha', '', '$2y$10$Rnig/mCSXyAYGCTu7ulA7uLy7joBqB4a72v/VaBgNX.dZgtwT1M7K', 'christinem036@gmail.com', '2017-03-22 03:31:26', 'default.jpg', 'active', 'normal', '', '4IJVZuryqua9o973XocCIOlIp8O9Pu48QW35fvybutk7lmCx8q0BdXJMUxPZm9AqsaAKhqmbaNc', '2017-03-21 20:31:26', '2017-03-21 20:31:26', '', '', '', '082242942920', NULL, ''),
(133, 'tarmizi', '', 'e152db99f90f58a78da79723ab9413a3', 'tarmiziinfion@gmail.com', '2017-03-22 14:02:50', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085277541128', '23681', NULL),
(134, 'Devita Anggraeni Putri', '', '5ddb23ceef603267bb3d7c3804a9a7f9', 'devitaangraeniputri@gmail.com', '2017-03-22 14:17:05', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '089683481533', '14510', NULL),
(135, 'Tarmizi', '', 'e152db99f90f58a78da79723ab9413a3', 'tarmizimbf@yahoo.com', '2017-03-22 14:50:35', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085277541128', '23681', NULL),
(136, 'Bagus Andrianto', '', '$2y$10$OXlNlylwm.zw6DghsvsVnetU.lW9dU/ToYDIrmGSUkS3TtsIVDNLq', 'bagusandrianto26@icloud.com', '2017-03-22 16:29:48', 'default.jpg', 'active', 'normal', '', 'LDruYKv33sKUp0xQWqskbmwvs6dqfJvFIi8qE5bBwWPAh167rqrNA22zt2Ivqu8wYF8KtLHPZkE', '2017-03-22 09:29:48', '2017-03-22 09:29:48', '', '', '', '081351922795', NULL, ''),
(137, 'rina pangastuti', '', '27f1870c78b0cb95e68cb419f86ea152', 'rinapangastuti57@gmail.com', '2017-03-23 12:10:36', '20170323192624_C360_2016-12-30-10-13-03-772.jpg', 'active', 'normal', '', 'u3TeKgJixZymOjRRl3TPoGmo50xQWNAfaQxlqhjUkm7gsbxlMe7hFJkNApnPc8iU7P4GBz7QE6d', '2017-03-23 05:10:36', '2017-03-23 05:10:36', '', '', '', '085721620989', '40513', ''),
(138, 'Nrangwesthi Widyaningrum', '', '$2y$10$r64OsG6.Oboa5c/2hvvS1O5csj1Nxn5p8Dl8ZPUYpsud3i0q/0fku', 'wnrangwesthi@gmail.com', '2017-03-23 12:28:51', 'default.jpg', 'active', 'normal', '', 'uhQRdWYLGc029jCuzcP9hInVrsCr4tmRvW7uuSYD2coJd4ymiHUtgf5B12cJv0jPzNkJEYSpJuR', '2017-03-23 05:28:51', '2017-03-23 05:28:51', '', '', '', '085741505029', NULL, ''),
(139, 'Agus Romadhon', '', '$2y$10$wR/9kjVIk8ezwGHbks/.xuloUn5ovP4YjicJhiPWwA9Ymoc.6DVhy', 'agusromadhon16879@gmail.com', '2017-03-23 12:30:29', 'default.jpg', 'active', 'normal', '', 'hfTbkpIcWkOJFbUS5TL4uwAwKX0Yf8ZBhus3kGmfMxbCW4qjH27pYUD73MpET1JwcusO3nzRwKz', '2017-03-23 05:30:29', '2017-03-23 05:30:29', '', '', '', '081328419977', NULL, ''),
(140, 'Muhammad Rizky Widodo', '', '$2y$10$8OuIjc/aK/zPxnbzXPGDQu8aN.tZ4MYsycsuCjqscwi7YGDV7E/nu', 'adonara1214@gmail.com', '2017-03-25 06:45:39', 'default.jpg', 'active', 'normal', '', 'LzXtdsdDIPveuEvCA7PUcO2JFCBi1J3fu8hGBbWTSyKWtUHWofXOxcj7ePz1SlHirRRjUR1szEm', '2017-03-24 23:45:39', '2017-03-24 23:45:39', '', '', '', '087788583055', NULL, ''),
(141, 'Anissa Wijayati', '', '$2y$10$wfEWsUq2iUtJiJ5XiTlNNuj4I5R8t.NaikfgeYZcmyI5qbW5s0Cxi', 'wiwi20.7794@gmail.com', '2017-03-25 09:51:43', 'default.jpg', 'active', 'normal', '', '97E0OtGye1C9viRPvRbD8OrkCp42AjTdrVfqiZFkEN8XjORtSwtBHzY2bzdKe5b5Jph6xr7hVlT', '2017-03-25 02:51:43', '2017-03-25 02:51:43', '', '', '', '085215519767', NULL, ''),
(142, 'eka andy santoso', '', '$2y$10$/vZbwvt1V7WGrYFWpNT0G.4N8ZXk8ipsiOtezC.Yi9dotg3Q7Ylf2', 'ekaandy36@gmail.com', '2017-03-25 10:14:37', 'default.jpg', 'active', 'normal', '7T63GG0uBkAoKdY1zeTQc0KbRTUEnwoWAsPbIBoEblWq1Fdl2Q5nWrB9voFa', 'yyESWMaZTH50IMnbv2JX3o35De3gcG8ueQFeOJxSjeFDM4mSqx4KLqt7IY2if8u68hxGME5V2Fb', '2017-04-09 20:30:23', '2017-03-25 03:14:37', '', '', '', '081215021831', NULL, ''),
(143, 'eka andy santoso', '', '$2y$10$VO5McwuBieSmTDScg6GNfOASI1hde1zjrytNFrbndDW0MXD8H8doy', 'epuzzlepuz@gmail.com', '2017-03-25 11:00:31', 'default.jpg', 'active', 'normal', '', 'y2P27hpe5mg4OmIugGYLtPNl2tcKTZZXHOTxx8XWLpljwc6EdtjKwHnMD9RwbSfAoL3nL8TjXbx', '2017-03-25 04:00:31', '2017-03-25 04:00:31', '', '', '', '081215021831', NULL, ''),
(144, 'Andaru', '', '$2y$10$rZxDau./T.fjSBC.YOD8JOdqs1F9KqKZ8Y0KwJ81lzUrfv702.9Va', 'aandaruu@gmail.com', '2017-03-25 16:40:53', 'default.jpg', 'active', 'normal', '', 'RsQrHt3zqeNAlzRwi9c204jWURNJu4BuRWmg61okblDcMSL0X4VnEsPSajrvXY3HtU8S5lP3sEg', '2017-03-25 09:40:53', '2017-03-25 09:40:53', '', '', '', '082230578030', NULL, ''),
(145, 'feizal tawaqal', '', '$2y$10$JH4N78q4ryLGghYKUjMM3ueVFpVp2jp5KXEaAtOQn18RWbLtEGA32', 'feizaltawaqal185@gmail.com', '2017-03-27 04:16:26', 'default.jpg', 'active', 'normal', '', 'hg6huNsF8cHKBHkoLfLdLctzL70hZalIb7DmQbrFf6kVx3Ks5NGWdbGVnYy3IQT1PQk98jwnnXd', '2017-03-26 21:16:26', '2017-03-26 21:16:26', '', '', '', '082117681086', NULL, ''),
(146, 'feizal', '', '28b5bf71b8b6d6adee9e702d23e11c9e', 'feizaltawaqal@yahoo.com', '2017-03-27 04:23:16', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '082117681086', '45464', NULL),
(147, 'hendro wibowo', '', '31f2c1affe0dce60ed3411b4cf64c538', 'hendrobunders@gmail.com', '2017-03-28 03:09:58', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '08179416602', '55581', NULL),
(148, 'Egidya', '', 'd8dd9ba8434310784032a79344964e82', 'egidyamahardini@gmail.com', '2017-03-28 11:29:47', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '081214205020', '14520', NULL),
(149, 'Mohammad Arkham Chadiar Jantra', '', '474f3c5e4e32cc95d291d859ae64ef7b', 'arkham.mohammad@gmail.com', '2017-03-29 01:11:00', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '089615904042', '52451', NULL),
(150, 'Sindi Farhana', '', '$2y$10$MtckBEDr1cYgc9H450U9qetQH/Up.s.5y0qLgg/JQVYtiCS3DwP.S', 'sindifarhana@yahoo.com', '2017-03-29 02:33:34', 'default.jpg', 'active', 'normal', '', 'R39ycaHe4rOK60VDXmF08jvihKce1d7NiUpfCMsN501AfZQPYzN09jieoiCks9LuUyUgJkzBN8E', '2017-03-28 19:33:34', '2017-03-28 19:33:34', '', '', '', '085888482266', NULL, ''),
(151, 'agnesleonardi', '', '$2y$10$V4K7xP3eDesqMX7hoJcTRu9q8QHLVDoZtM1Cvz3j9HtWu0XGMieyy', 'agnesleonardi.01@gmail.com', '2017-03-29 07:03:33', 'default.jpg', 'active', 'normal', '', 'l8hJwbFYDNzMhvKpUXVn6wORThPng4UMauJMZgWiFkZNQTR2fO7djj7v7NQrF025w2TM5jl4aAj', '2017-03-29 00:03:33', '2017-03-29 00:03:33', '', '', '', '082245702830', NULL, ''),
(152, 'Siska Febrina Fauziah', '', '$2y$10$GYJXqO0/6UvXoxufAv.KuOh5BnMBo7gW/hzwuXiI4ocYlmR2yc6N2', 'siskafebrinafauziah90@gmail.com', '2017-03-29 07:18:57', 'default.jpg', 'active', 'normal', 'bSMdnd74fgfI0HjZkq0Ii8vuYmHCYXWzO6kPVJOIHqw5YAY0PT9XEyKLtMWe', 'EltRMBhJbsJ4R2DqjIstgrq8qBG6wnuLuRPciyhoXDN13VaZQyYJgzDGqZBg5aB9FCWRuyPJVQu', '2017-03-29 00:20:02', '2017-03-29 00:18:57', '', '', '', '085294443535', NULL, ''),
(153, 'Elvania Andisa', '', '$2y$10$g9nTDo.6aDQTC7MJi.5wxOAEMl3HM3WBvOGBYAhmJeYIN7c64yvL2', 'eldisa95@gmail.com', '2017-03-29 18:23:08', 'default.jpg', 'active', 'normal', '', 'owbexX8gaZF5ST9GMY9hRfA6jltvVUzZ07v50BWg7qEp0Armq7BEP7BulUmtvndgsXOmkNxbn3b', '2017-03-29 11:23:08', '2017-03-29 11:23:08', '', '', '', '082284813005', NULL, ''),
(154, 'Adin Damayanti', '', '$2y$10$SthDXezqwtNQZNx10tyl2ec90S8/P6XMipXj6SktSrP7ljCvJfS.e', 'adindmynt@gmail.com', '2017-03-30 12:26:40', 'default.jpg', 'active', 'normal', '', 'EMfRLFqJARmAWW8EOyIV4420tIsurmEW7812bhKsco7LLWMvkwsRAwLH7O19vrV0XhocebAoARZ', '2017-03-30 05:26:40', '2017-03-30 05:26:40', '', '', '', '082157995696', NULL, ''),
(155, 'Dara Herdiyati Novianjani', '', '$2y$10$jfs4P3LiVrH/zRcqkwwlE.fWFL/WHp.WXOLXlWkqbjSvvGFTbfD7y', 'daraherdiyati@gmail.com', '2017-03-30 22:49:42', 'default.jpg', 'active', 'normal', '', 'Bb104o9WiN5ScIrnhWysctvuqcdcVfOvMK7dcdYJH0128kM0fdKVeYAso2T98YxSYhHpcC1ZgVy', '2017-03-30 15:49:42', '2017-03-30 15:49:42', '', '', '', '+6285920635180', NULL, ''),
(156, 'Retno Dwi Yuliana', '', '$2y$10$N9yGw30JYXkuT9btaDYHteQWj9I13mVddIv21cG9wlPk4L7UiiU.6', 'retnodwiyuliana.2@gmail.com', '2017-03-31 06:28:23', 'default.jpg', 'active', 'normal', '', 'wD3WbbuJZLesegd53RJLcMOM6cjDNW4i9LEwbBREZ5FuIqMUykfHuYNV1D74NOZAFaW8bAZWvIf', '2017-03-30 23:28:23', '2017-03-30 23:28:23', '', '', '', '087888535593', NULL, ''),
(157, 'andriano adja', '', '$2y$10$MZny4aFGMwEVq/sH73WGGuQKV.qIMA41dRhNnpBwnHJWSofqKdwfO', 'ajaandriano@gmail.com', '2017-03-31 08:32:06', 'default.jpg', 'active', 'normal', '', 'lW1gaWQR49iC5vew5Q51GQou5WuGgYF4BbwbskWmyMvc0p2igOjiuTbW3dTU6bYnQ40hNsqumqt', '2017-03-31 01:32:06', '2017-03-31 01:32:06', '', '', '', '082340263013', NULL, ''),
(158, 'Fatmawati Rahim', '', '$2y$10$QXbo71/w4dtbY.9E9YwbcOngg10/HBUPx2nyu5mMMQNmq7MqAXO6W', 'fatmawrhm9@gmail.com', '2017-04-01 03:34:49', 'default.jpg', 'active', 'normal', '', 'JZzeGKRZ0jBQO8s62kvBCMWMpj59CfkpKqiSvvP4CkkUwDWjM3CvUJX31LpMeRVjMGCBCrIOOBN', '2017-03-31 20:34:49', '2017-03-31 20:34:49', '', '', '', '082298920260', NULL, ''),
(159, 'Stephanie Verawati', '', '$2y$10$pLSBF6/xrKz8X6GCO1qumOUGug5Vz2lbcPlhzkEN9SrmzPlH1/2JK', 'stephanie.verawati@yahoo.com', '2017-04-01 09:16:20', 'default.jpg', 'active', 'normal', '', 'NDLjxlDqlAksgF8H7DPWflH8Zm7qlryBVyAEm9pG44nQ9BIrVf78xR5SzngtQ4jyGIZrSqXk4bu', '2017-04-01 02:16:20', '2017-04-01 02:16:20', '', '', '', '085217417390', NULL, ''),
(160, 'Agus Ridwan', '', '$2y$10$6O6G6ZAofv7bh2IJGchzle5wZWupqLDpdpH/3vrp3Sze66Pq.Sr7W', 'agusridwanunnes@gmail.com', '2017-04-01 13:18:51', 'default.jpg', 'active', 'normal', '', 'sMpqi0pxUH47iwdbMqwndaPaUiZJpfbXOllQ7iCrYRZSuxguHWHUwk6UXA0rChCqM4oNjMtWruO', '2017-04-01 06:18:51', '2017-04-01 06:18:51', '', '', '', '085740772486', NULL, ''),
(161, 'Rima Febrian', '', '$2y$10$SHnbBRZSc2LNROmbzql0z.LqxJL/PfqkapRDsJK9CmXwEksF4tZ5G', 'febrian0287@gmail.com', '2017-04-01 15:34:02', 'default.jpg', 'active', 'normal', '', 'tf2acnpHCypXJ5Chjhn4U8kxYz5FzFSxvlWVlhqutxhdKQCmsz5wAuYsYJORlifyr003xewhow3', '2017-04-01 08:34:02', '2017-04-01 08:34:02', '', '', '', '085782557862', NULL, ''),
(162, 'Ainul Yaqin', '', '$2y$10$tH3B0Hhng7dzmF9X3/1JwuBYwtcwkOv/aSFwLhqD2FDD9.i5sS3ze', 'muhammadainulyaqin54@yahoo.com', '2017-04-01 22:45:45', 'default.jpg', 'active', 'normal', '', 'ux5MqzYkJ2vL0eip0iPkDFh232acGAM33uXRCXa77b4sPIvxndminuGEATASTEz0AHn3OexKfZu', '2017-04-01 15:45:45', '2017-04-01 15:45:45', '', '', '', '085714728557', NULL, ''),
(163, 'Annisa dea', '', '$2y$10$mHgmEF1UuxiPdkZ91ftDfeVlI/Fw7nBYdS07HcViDy7LGgYmUX7Eq', 'Anniaadea19@gmail.com', '2017-04-01 23:44:53', 'default.jpg', 'active', 'normal', '', 'ht4jsIej9V13DD2QsDh2Fg8KVsSb7sVZu8wJOKm7WJQEZVbDLsu93oJHDDHnGBQw9LUaam081R9', '2017-04-01 16:44:53', '2017-04-01 16:44:53', '', '', '', '085715105820', NULL, ''),
(164, 'coba akun', '', '$2y$10$Qv2YUL91.k5nDUz8If.2AeKigrYYOC9hmtrtiAg.UGxHDmIbN9.VO', 'cacip123@example.com', '2017-04-02 08:00:18', '1641491120041b1v2jehgnkozehq.jpg', 'active', 'normal', 'vMKM3WFIhB8rKDfsvRK0boZeUDYUS0reCemImwxGoyiva9lVUYmRqu3hsUAC', '1nQ9haImZ3bSRNHsIJsxYsNtdxrQJlw6lrvFaCrzIRAA7Y7jbdxDJEoV7QauxIeLoFydPofJkie', '2017-04-02 01:13:42', '2017-04-02 01:00:18', '', '', '', '085795656662', NULL, ''),
(165, 'Fajar', '', '$2y$10$8FnSVXq2Dnrs3J1vqaYyIO4o79r7asq1mqb/cxNBVFLIMWw2scWs6', 'toutedzoiec@yahoo.co.id', '2017-04-02 08:45:53', 'default.jpg', 'active', 'normal', 'MLBhUWfMwNyqVG2LyAeiAwueOHV7GwpIY5gtiLFmY9DDbYuvLFhVkFsvgVYD', 'm8sS7h1242UTY3PLbyxvUzEmkhJ990avTo6uA5PLQfz89e5k1r9m08ABVUFqJqXXuDszmDY1T91', '2017-04-02 18:21:28', '2017-04-02 01:45:53', '', '', '', '081228523181', NULL, ''),
(166, 'Desiyanti', '', '$2y$10$cWqSn.cuS7WzTVx8GNizc.JaUxUl6OPQQfayMNLt/N5rS2GwSt0ry', 'desiyanti.desiyanti23@gmail.com', '2017-04-02 11:17:09', 'default.jpg', 'active', 'normal', '', 'drWKtX7eVnRX4bmu6DvVwhytQlLqo6s1IjtjJFYEAuJUKnSWEyXfTdS6WB6Iu5FzjpduuW6EbyW', '2017-04-02 04:17:09', '2017-04-02 04:17:09', '', '', '', '081282857916', NULL, ''),
(167, 'Dinda Khansa AR', '', '6f43bbb7072bca35618ecb294eb71079', 'dindaKhansaar@gmail.com', '2017-04-03 10:15:27', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085311702761', '40377', NULL),
(168, 'Andri Rizal Fauzian', '', '$2y$10$pBU8u9012db3/DFFzdkOzeZUYEmJjud//fetVuDOgFjxtNDmyYHIm', 'andrisaja350@gmail.com', '2017-04-03 13:47:17', 'default.jpg', 'active', 'normal', '', '0nOqR6G6n2jaSYmSnqO3D1VzdoDejkprzgC6F50v8pwnyLHmYuFigLw1D2TgGsUkfWvuFMp3OBY', '2017-04-03 06:47:17', '2017-04-03 06:47:17', '', '', '', '085710458693', NULL, ''),
(169, 'panji satria', '', '$2y$10$hahKgluXNVmkK5osBogvBun/vvGSarCSjov3pDb9ImLT0lmAR9t9m', 'panji.satriap@gmail.com', '2017-04-03 14:20:21', 'default.jpg', 'active', 'normal', '', 'Duds0SEbrQVuWgxw1U8k8xgca3TIZZoO4WUZEDiW4VUIgj13Ch4iMyIgy3YxecHgdOoaPhy31EJ', '2017-04-03 07:20:21', '2017-04-03 07:20:21', '', '', '', '083890009871', NULL, ''),
(170, 'Amalia Isani Achmad', '', '$2y$10$KjXAnmaf65Cd66VU16IF1uBPWmzzQLaNfMbJYpeloe5vsDwlPuia.', 'amaliaiachmad@gmail.com', '2017-04-03 14:22:16', 'default.jpg', 'active', 'normal', '', 'MlZQh9oy42LjSLjMOn0saugvUl0qSD8vle6NaFhXEdKXyyUnUlvGjcNFRiBjoBlZB9JhY1wGU03', '2017-04-03 07:22:16', '2017-04-03 07:22:16', '', '', '', '08119952099', NULL, ''),
(171, 'Cepi Mulyadi', '', '$2y$10$grQvWkBg.Te9dU2h0k6h4OPe1KoAuL5bmBwczQaqWKHKD.z5JU.K2', 'tjepi.moeljadi@gmail.com', '2017-04-03 16:39:35', '1711491237795gro13cpvavgqkjf.jpg', 'active', 'normal', '', 'Xqfb0rDuhR5whAcO0GI5rqqf90PKaIdtJbNZQCg2AwrOWCym39sZ2Lf9HZ9xYer3shphB2INuMf', '2017-04-03 09:43:15', '2017-04-03 09:39:35', '', '', '', '085224949949', NULL, ''),
(172, 'Eva Lailiatus Salma', '', '$2y$10$BJNEsRguJBw2ChMFSprEGe7Uw2SdkJCrbAKYST.00SzgVQZALyT6i', 'Savala_eva11@yahoo.com', '2017-04-04 03:43:40', 'default.jpg', 'active', 'normal', '', 'x132GEuMHyHDmQ4KFcCEwP0FmGFokxXbnc7IUKSWFt2OoeIhJu12x2sj08Sie3RuGCrrKm9nSDI', '2017-04-03 20:43:40', '2017-04-03 20:43:40', '', '', '', '085866380035', NULL, ''),
(173, 'adi ramadhon', '', 'dad29a626bb7fee3f0b341a675a420cb', 'adi.ramadhon19@gmail.com', '2017-04-04 04:22:08', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '082177450201', '36868', NULL),
(174, 'Yusnia Widihastuti', '', '$2y$10$Nlzt4YNWxvlq2TdL.3ar6./eL2vyfunNxKEVbhoxXIGL57wnNphAW', 'yusniadias@gmail.com', '2017-04-05 05:21:29', 'default.jpg', 'active', 'normal', '', 'cQHexeXglCLbf2yg91xvlyZDgWptMftyRg09USiswljSI81KtlUZM7ReqN0sGpe4nv0QC7QKunJ', '2017-04-04 22:21:29', '2017-04-04 22:21:29', '', '', '', '083817381348', NULL, ''),
(176, 'Fetrisia', '', '$2y$10$bEBtmVUvtBmXWmc63tLEiOD6JxSnTq5eNS6vIm7jmrZUOZ2JRVySO', 'fetrixiandini@gmail.com', '2017-04-06 13:26:07', '1761491485354j41i2g9ynwx4lru.jpg', 'active', 'normal', '', 'XNZZ53dthFFzGtTR7JBnaWEUJSwOUxeAaVqhdXQRJwB8wEzy2wnvvTi8xahAGtrxFzEJASzyEZb', '2017-04-06 06:29:14', '2017-04-06 06:26:07', '', '', '', '085642334080', NULL, ''),
(177, 'Binti Afifah', '', '$2y$10$PfV0m6sZJAshO.buXdmoFOGnwBEIaej/YjjtwQe/UWyM3OTtUJKpG', 'afifahasihab@gmail.com', '2017-04-06 23:44:30', 'default.jpg', 'active', 'normal', '', 'wLDu0QVVLfg9HmwK6dSyoPWxcVtC7em1k5KETFnlrrgLCsQz14CmIzOAjH2QZzL7LQ1F9aBrC27', '2017-04-06 16:44:30', '2017-04-06 16:44:30', '', '', '', '085745257173', NULL, ''),
(178, 'Laili Farah', '', '$2y$10$mQ3YBMp4YX796YNCH1dD2u2bDHmsrMNNALmG8Mjr4IdjGhmdhosC6', 'laili.farah21@yahoo.com', '2017-04-07 04:05:51', '1781491538549szbhdd3jrpd945r.jpg', 'active', 'normal', '', 'dqE8ZmfYtbLH2jC2C9OC1e75SB2S5Rj7V70240XcVrh2T5XBuHohji6S2fHbaclkfhWqw4jYYjS', '2017-04-06 21:15:49', '2017-04-06 21:05:51', '', '', '', '085643741809', NULL, ''),
(179, 'farizal', '', '$2y$10$MTN0kjuWqwp2qgGHX/Rq7OxVtaFieog0vhgOOxb72KXUOiBrWC4wy', 'farizalrinalditya@gmail.com', '2017-04-07 14:41:37', 'default.jpg', 'active', 'normal', '', 'Eyz1PPZsYVF3EayLof6H4QTJ5sM84zMPHumkmHrwzrVOq0KUCdm0AW6kZ2UIkBdCMcMKF5szH2s', '2017-04-07 07:41:37', '2017-04-07 07:41:37', '', '', '', '085745981393', NULL, ''),
(180, 'tes', '', '$2y$10$F/z1oRj/YmMwZz4YIld0reGAkcTlK6g5PJpKo0TbC/Pn7HSrdD4Vq', 'tes@xx.com', '2017-04-07 14:47:40', 'default.jpg', 'active', 'normal', '', 'EMiTs77CKnV0C1RFzMtnWeYZ9JjcLrXWgMp5nsGcjRzhlYTVnSiexpm6HNmdXIL9L3vMpWCWG1n', '2017-04-07 07:47:40', '2017-04-07 07:47:40', '', '', '', '12412311', NULL, ''),
(181, 'ade nine suryani', '', '$2y$10$hFMCHhMbulvnSiQmZ.H/qOSGN.A.RdPaKubeFoEaUz8FxI/bymbCi', 'adenine.suryani@yahoo.com', '2017-04-08 04:30:48', 'default.jpg', 'active', 'normal', '', 'bYcfTeyVyrBGkqtkGOIusmi3o7iMdcczqZVpoqsxxy2YK6to7nw0xJJU5z3kXYqZJ1eOfKVTRmN', '2017-04-07 21:30:48', '2017-04-07 21:30:48', '', '', '', '083869989032', NULL, ''),
(182, 'Febri Septia Risnandar', '', '$2y$10$udGmX0wIeQTYO2wbLQCDpO9FtNjW2TdCiwTxebnCI3aMgGT6acCJW', 'febririsnandar98@gmail.com', '2017-04-08 15:54:59', '18214916672794ybda8phap9bk9c.jpg', 'active', 'normal', '', 'WwasysobWyaIvLnmra4jva70atHFMXyVYR7e16lby49GOeIu0TILGEYDZgzBzry4j4qyUsXAsmc', '2017-04-08 09:01:19', '2017-04-08 08:54:59', '', '', '', '085783828897', NULL, ''),
(183, 'Lela', '', '$2y$10$YWTWchkr4YOmGMIbI1tCFuq4pes10Wh9XQ55ASKfKxJYf36A2ofQW', 'andilelapancawardani@yahoo.com', '2017-04-11 06:22:45', 'default.jpg', 'active', 'normal', '1lSaZ8k20ALlfbu1EMSojHdQU2v8VepOxkMdBWTI7LEP9Hkv9nsaP5Exhd1x', 'ZPwdhY4U28L7ThzzZqa69AOisZ4QJrGAdXKkWLfgPyTuvmEn7aRF4d3dLGQ9uZbpIJj4MucmkTA', '2017-04-11 00:42:29', '2017-04-10 23:22:45', '', '', '', '085394689929', NULL, ''),
(184, 'Ghonim Muzaki', '', '$2y$10$WgehreyTaHs4hMoIx/pTVOwF8a90p9vWNR9BQnSANSUAJ1WZ3F006', 'ghonimmuzaki7@gmail.com', '2017-04-11 06:26:32', 'default.jpg', 'active', 'normal', 'qUuYgprhbjFsLK46gZUUd9jyKdoMorUdDdTmK41xKFk0mb5DhO0mRwiRIO2e', '4iGfbUJrU8XhLzrvv9RFpeD4jIN3v4nkKoOHabE5NjWfgHuWzWEANOhkqacd3lQGQq67ICwqSOh', '2017-04-10 23:31:38', '2017-04-10 23:26:32', '', '', '', '085785660747', NULL, ''),
(185, 'coba', '', '$2y$10$WRQRYTbt0If/HTthTJAJh.mJa5K3Upov9gc5c3VLWgtl32sSkKuc.', 'sasa@asa.com', '2017-04-11 06:28:18', 'default.jpg', 'active', 'normal', 'LwXofPt6LxT3gTF2xG8dj2I9StRrsODTbV786jegLLdXjY4gUmiC5pBSUXul', 'Z5fpOtP33YRhk2zsH8RBKhG25A6T6CRZAgxRkiW3J9Msp751mqR2RnvYCHNAFanKliaPpV9EnIb', '2017-04-10 23:28:52', '2017-04-10 23:28:18', '', '', '', '12121212', NULL, ''),
(186, 'Aditya Very Cleverina', '', '$2y$10$JNHXHNZUWd3BKzQ1B1cCl.UJpBFBIbQd7lyrkhaHhb0a8jpJ31CRq', 'Adityacleverina@gmail.com', '2017-04-11 06:37:06', 'default.jpg', 'active', 'normal', '', 'SGS396SSu5h0tsyCTBgqL7c6gPeWHI7o31zltDWy6MBasyTJj4peiotKK31ALlq2dAxBTZx5zDC', '2017-04-10 23:37:06', '2017-04-10 23:37:06', '', '', '', '081806484635', NULL, ''),
(188, 'Egidya Mahardini', '', '$2y$10$NYuAUhosvka4W7FxSS2nM.JQBuU3MvKjEqlzaZ4Jdly6nwCNxLRu6', 'Mahardiniegidya@yahoo.com', '2017-04-11 06:38:49', 'default.jpg', 'active', 'normal', '', 'QLCD2BhGE0u8deVaUzX9zxPjMhwOuFyOqBETFcSfWAxwQQFOLxKWk8QHL6snwK4ir7ALl3biIbd', '2017-04-10 23:38:49', '2017-04-10 23:38:49', '', '', '', '081214205020', NULL, '');
INSERT INTO `users` (`id`, `name`, `countries_id`, `password`, `email`, `date`, `avatar`, `status`, `role`, `remember_token`, `token`, `updated_at`, `created_at`, `paypal_account`, `payment_gateway`, `bank`, `telpon`, `kode_area`, `confirmation_code`) VALUES
(189, 'Fransiskus Dharmawan', '', '$2y$10$oRiw7Jk1mzRYw/UlzM1x9ec33mwFQayERFshpVgWEo8MkehBt./1e', 'fransiskus990@gmail.com', '2017-04-11 06:59:29', 'default.jpg', 'active', 'normal', '', 'aT40NlsNoM6sku57oqedsS6maFWstYxd8uxk2WfufjV86inhfJHVbmNXHTqMJCZvRuyUDT7OzOW', '2017-04-10 23:59:29', '2017-04-10 23:59:29', '', '', '', '085643324718', NULL, ''),
(190, 'Wineyni', '', '$2y$10$IM/AgfvdSG6An27dlUcPkusaSSPJw3JbfUaWuyJA2TeqPF7HXc5ra', 'haryaniwineiny@gmail.com', '2017-04-11 07:01:59', 'default.jpg', 'active', 'normal', '', 'ANlckcaY3aZeyX0HDe3HgyQr1cVtcnn9kjlWIkHmsU2eWIKeAlGDq2bLvMSaRgnlI4ntNySzICA', '2017-04-11 00:01:59', '2017-04-11 00:01:59', '', '', '', '085252878808', NULL, ''),
(191, 'putri', '', '$2y$10$8CGc9XZ82Q.VvGKXoMY/0O0FrxaIxv13izMse32N4NhkNezH/Vm1S', 'putrirakhma08@gmail.com', '2017-04-12 07:57:29', 'default.jpg', 'active', 'normal', '', 'wmb2VrIxS2HwCjHYIW0GxdsngF3VbmELXnWwYgBPzGOmOtilOb9KJqOLMo710ZmtD6029BvfW0K', '2017-04-12 00:57:29', '2017-04-12 00:57:29', '', '', '', '085727196262', NULL, ''),
(192, 'Ahamaniyah', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'ahmaniyah@gmail.com', '2017-04-12 14:47:43', 'default.jpg', 'active', 'normal', 'MKbeHuS33H8L2PhK4vRdyxqfvjenHSUetP8yttE5lsdbY4kMkenITpWJWuze', '', '2017-04-12 08:26:36', '2017-04-12 07:47:43', '', '', '', '081231956342', NULL, NULL),
(193, 'ibu saya', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'rieskha@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(194, 'Harwatiningsih SE, MM', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'harwati.ningsih@yahoo.co.id', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(195, 'Adi Waluyo, SE', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'adiwaluyo@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(196, 'Bapak Rochim', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'rochim34@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(197, 'Ir Guntur Gandewa', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'gandewaguntur@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(198, 'Ir Candra Mahardika', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'candratw@gmail.co.id', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(199, 'drh Gretania Resi, M.Si', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'gretaniaresi@yahoo.co.id', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(200, 'Endro Asmono', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'endroasmono@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(201, 'Bapak Mujiono', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'mujiono@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(202, 'Sriutaminingsih, SST', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'sriutaminingsih@gmail.co.id', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(203, 'drh Habib Syaiful M.Si', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'habibtuska@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(204, 'Kuspanji Triantoro', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'panji@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(205, 'Bu Kartini', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'kartini@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(206, 'kholiq budiman', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'budimankholiq@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(207, 'Yahya Nur Ifriza', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'yahyanurifriza@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(208, 'Rohmad Bagus Supriyanto', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'rohmadbagus@yahoo.co.id', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(209, 'Anomim', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'ferdyaditia@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(210, 'Farizkha risma', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'rismatem@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(211, 'Sindi Retnowati', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'sindiretnowati9@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(212, 'Lingga ', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'adhatour@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(213, 'Linawati', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'asharahmatillah@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(214, 'Agung tri noviyanto', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'Agungtrinoviyanto@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(215, 'Eka Surya', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'borneyozz@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(216, 'Cut Juliana', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'cutzulyana@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(217, 'Inggrid Kumuma Wardhani', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'inggridkardhani@yahoo.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(218, 'Freshtanto Sandi Normawan', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'Frestanto@hotmail.co.id', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(219, 'setiawan w', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'setiawanlabfor@yahoo.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(220, 'Riza upi', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'riza.upi15@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(221, 'Arnild Augina Mekarisce', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'Arnildauginam@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(222, 'Muhammad Khoiril Anwar', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'khoirilandwar44@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(223, 'Gunawan Sani', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'gunawan.sani@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(224, 'S Elita Barbara', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'elita@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(225, 'Ima Rismawati', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'rismawati.im@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(226, 'Alzela Dona Sabilla', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'Alzela.dona@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(227, 'Halimah', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'nurhalimah2603@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(228, 'Lisa Yasoha', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'Lisa.rolita@yahoo.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(229, 'deanita sari', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'deanitasari9@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(230, 'Budiono', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'budiono.tw@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(231, 'abdur rahim', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'abdurrahim_19@yahoo.co.id', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(232, 'Muhammad Amin', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'maminrtg@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(233, 'alex', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'alexdasilvalima2110@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(234, 'Gretania Resi Diwati', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'gretania.tw@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(235, 'Yully Estiningsih', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'estiningsih@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', NULL, NULL, NULL),
(236, 'PALASI', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'harios1si@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085735109593', NULL, NULL),
(237, 'Rifky Aditama', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'napiesan@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '081326883493', NULL, NULL),
(238, 'Hamba Allah', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'rukaan.adha@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085710728254', NULL, NULL),
(239, 'annisa prawiradilaga', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'orangutan_kayu@yahoo.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '081310333166', NULL, NULL),
(240, 'debora sarmaulina', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'sarmaulinadebora@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '082282723090', NULL, NULL),
(241, 'Liany Suwito', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'lianydsuwito@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '08568720717', NULL, NULL),
(242, 'ben', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'ben@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '97997', NULL, NULL),
(243, 'Iqbal Faruqi', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'iqbal25faruqi@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '08111700453', NULL, NULL),
(244, 'a', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'a@gm', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '98', NULL, NULL),
(245, 'teas', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'cacip@der.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '2234563467', NULL, NULL),
(246, 'Ainur Robiatul Adawiyah', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'ainurrobiatul@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '85954590632', NULL, NULL),
(247, 'Dhani', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'B', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '08', NULL, NULL),
(248, 'Dhani', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'Bas', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '08', NULL, NULL),
(249, 'Hamba Allah', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'Rina.wulan45@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085868888202 ', NULL, NULL),
(250, 'Gretania Resi Diwati', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'gretania.resi@yahoo.co.id', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '0871202111', NULL, NULL),
(251, 'leza restiana', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'lezafidyah6@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085380084036', NULL, NULL),
(252, 'Nik Jam', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'nikjam131.nj@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '08568031143', NULL, NULL),
(253, 'aris', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'nandargrafika@yahoo.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '08976545358', NULL, NULL),
(254, 'A', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'A@', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '123', NULL, NULL),
(255, 'tes', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'cacip666@tes.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '34131231231', NULL, NULL),
(256, 'a', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'a', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '0', NULL, NULL),
(257, 'cacip', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'cacip@gmail.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', 'odhgKHgUHyUY0DhRVBBvFkg6jBbwZ9BjNGZArRijKC2GjqAO411Kf0JkHA8l', '', '2017-04-12 08:29:28', '0000-00-00 00:00:00', '', '', '', '2151331313', NULL, NULL),
(258, 'yuuy', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'huyuy@yahoo.com', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '7676', NULL, NULL),
(259, 'arus', '', '$2y$10$3wK8s7ZjsxJPvvIve2KrTOtby3qN9meSNUOSkPSs5bQsBQsB3g7Nm', 'hghhg', '2017-04-12 15:23:52', 'default.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '8787', NULL, NULL),
(320, 'heru rosadi', '', '$2y$10$X5QesRCbOgIf1ooxq3H/P.I5feqZAw7Ge3zOZUOCp8IvWML2iwEiq', 'heru.rosadi@gmail.com', '2017-04-13 02:09:46', 'default.jpg', 'active', 'normal', 'DjDhWSC6y3qG9zANZytT0kPTgKwlqA3Xd9LLTYuMGAqzW6uL5nnXsf1AAA2H', '08mST11ygiFtly3n79u3onRm6kuImPAXT2pnB7qq7CUlOo9NwvCvAbdXUSJipySf494fIwNxElX', '2017-04-12 22:01:44', '2017-04-12 19:09:46', '', '', '', '083834522217', NULL, ''),
(321, 'fathussalaam', '', '$2y$10$CQzBS5LldNKC3cbQCFpzZ.N/kmclUhQF1T0KEjSA/pH.tqqY68CuW', 'uchalsukses@gmail.com', '2017-04-13 03:38:28', 'default.jpg', 'active', 'normal', '', '2XCQ8JukdlgVBWgTebLO1YFOJqARwKCutHxTtevym4zfXn3sKFggdDlSZuxwVgkLXrqD2OBm5Xy', '2017-04-12 20:38:28', '2017-04-12 20:38:28', '', '', '', '082177560797', NULL, ''),
(322, 'hakimah nur yusla', '', '$2y$10$dpHUCz7jMm9DODGpQ38Y5eDkKH7OOe3c26Kz8pyUgu7oZ8wc0EING', 'yusla.hakimah@gmail.com', '2017-04-13 04:13:34', 'default.jpg', 'active', 'normal', '', 'rcCjmWCgneuqMJv296a2TphyewYrlvv9gLfL4I65D3vJnQ6hEjNI52Gs3XV0UtL5L2RX5YKAgCR', '2017-04-12 21:13:34', '2017-04-12 21:13:34', '', '', '', '085853191388', NULL, ''),
(323, 'Bastaman Omar Dhani', '', '$2y$10$CmHE.eHEWp6XkFEz.wcz2ORRyPgto.cZQx.WOAq0tnhzT1kNzHCHm', 'bastaman.od@gmail.com', '2017-04-13 09:10:34', 'default.jpg', 'active', 'normal', '', '', '2017-04-13 02:10:34', '2017-04-13 02:10:34', '', '', '', '+6285842347087', NULL, NULL),
(324, 'sita kalaswari', '', '$2y$10$uEBt54ZDObHae1V4RAGG8.43OwWGHO9GiXIyJ8GMPtj4qAa3WtfwK', 'kalaswarisita@gmail.com', '2017-04-13 10:17:02', 'default.jpg', 'active', 'normal', '', '', '2017-04-13 03:17:02', '2017-04-13 03:17:02', '', '', '', '083850110217', NULL, NULL),
(325, 'Risanti Delphia', '', '$2y$10$WRjS/uY3w28dgP/EDywiPO6Bd7237/40Aeaaye9VwopDjMdTY0YQW', 'risanti.simatupang@gmail.com', '2017-04-13 13:22:55', 'default.jpg', 'active', 'normal', '', 'TKhSEZynvKCeDw7bn2LiR0Ob5NZHjtK80uTObzWsnjk7bXJiWnSBPJUljia9cdFYNnk5Hrzh2IB', '2017-04-13 06:22:55', '2017-04-13 06:22:55', '', '', '', '082131309483', NULL, ''),
(326, 'ferrindo', '', 'e79c7323f62151abde47e29987b38859', 'ferrindomagarwi@gmail.com', '2017-04-18 03:54:20', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085736778270', '56910', NULL),
(327, 'Sahputra Surbakti', '', '6cd2819c34c049aaf25b80eb97f30671', 'sahputrasurbakti26@gmail.com', '2017-04-18 07:28:06', '20170418143336_20170415_093157.jpg', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '082167385374', '20125', NULL),
(328, 'Ratih Hatibie', '', '$2y$10$UskR2w/0JuWIEKP4HcRiZeeOl2GNG.yiOhdmQKXwFhy/QznZTy0JK', 'ratihatibie96@gmail.com', '2017-04-18 08:42:44', 'default.jpg', 'active', 'normal', '', '', '2017-04-18 01:42:44', '2017-04-18 01:42:44', '', '', '', '082299602168', NULL, NULL),
(329, 'sita', '', '91b5bc5dba07481ada82252be257e70a', 'sitaklswr@gmail.com', '2017-04-19 01:06:50', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085707178924', '69471', NULL),
(330, 'Amita Putri damayanti ', '', '$2y$10$d3DdCGBLLNbfZyY.7Akk6.Z7N2DgxqHj1P8aAdGkxLYub7NoASdNu', 'Amitadamayanti92@gmail.com', '2017-04-19 23:24:16', 'default.jpg', 'active', 'normal', '', 'DiLzM1VKhKdBw5HxQaPWMtDYYy6gilLKjP48BqSeggh9XzV0THY0RnbNXC0RW6W4oJwC5kC3bVk', '2017-04-19 16:24:16', '2017-04-19 16:24:16', '', '', '', '08123481078', NULL, ''),
(331, 'Kpa lacak', '', '$2y$10$18qMgFh5vplBkJjfLkcIeePr6zpDCiURkFHgV8OZt9BaofAaCYrE2', 'lintasaalamcintalingkungan@gmail.com', '2017-04-20 06:51:56', 'default.jpg', 'active', 'normal', '', '', '2017-04-19 23:51:56', '2017-04-19 23:51:56', '', '', '', '082190068940', NULL, NULL),
(332, 'Wahyu purnomo', '', '$2y$10$yXDCJ1PfrRgj1Wa69QHoceVqdV74h6maKbNkZlwkJFY22UIeYvIv6', 'wahyupurnomo662@gmail.com', '2017-04-21 04:09:15', 'default.jpg', 'active', 'normal', '', 'AxFQZprhudhVLdnklavSXnqONbGMbMCR8z1ySEahZ8PEDy1TEKGZiklQMZ3qkDWJd6YGDk6rQ2K', '2017-04-20 21:09:15', '2017-04-20 21:09:15', '', '', '', '083865814154', NULL, ''),
(333, 'Djenar Putri', '', '$2y$10$.TYza24Wqha/Fv/mSPdo3ukacTXML2OdcLpGs8Ss2PFlyt0OdcT2C', 'Djenar203@gmail.com', '2017-04-21 11:33:04', 'default.jpg', 'active', 'normal', '', '', '2017-04-21 04:33:04', '2017-04-21 04:33:04', '', '', '', '081243212329', NULL, NULL),
(334, 'Bayu Krishna Rizqi Pratama', '', '$2y$10$dJQTZp.4wa0w.QHScvcMZOYNsECqTOLll1Isi4WuWJqvQyYdwoxbW', 'anakersardani@gmail.com', '2017-04-22 08:53:13', 'default.jpg', 'active', 'normal', '', 'Hoyo8FWXDSRIFZ39u5FiNQdKEONdeK5BQUMGmuKP9Cac1qWSeFv04OQCqC4ota53A1Z9PB6wR0L', '2017-04-22 01:53:13', '2017-04-22 01:53:13', '', '', '', '0895614300793', NULL, ''),
(335, 'danar ardhito', '', '$2y$10$ZbVjabIZs7vKfxzOFY.8ZOUHmq8GpP1jcPUh7t10D3dz0RtNwIx/C', 'danarardhito@gmail.com', '2017-04-22 13:57:30', 'default.jpg', 'active', 'normal', '', '', '2017-04-22 06:57:30', '2017-04-22 06:57:30', '', '', '', '08119444348', NULL, NULL),
(336, 'Melyana', '', '$2y$10$gX8G/G.zzO8d1V3Osmeb0uhKso5wNnVl1L7Ey06iT8aaTJcdiMBuu', 'melyana_n@yahoo.com', '2017-04-22 15:14:20', 'default.jpg', 'active', 'normal', 'wnX8AM5fvlUwfFmi7qTJ0lWN0V6vKHU0nWqhyg3lCsW3RndcwdlqN3jIM0GN', '', '2017-04-22 08:15:13', '2017-04-22 08:14:20', '', '', '', '08122853514', NULL, NULL),
(337, 'Ben', '', '2ef69fdd39b60da39fa5524452adf9e6', 'miftachurrobani@gmail.com', '2017-04-24 02:05:18', '', 'active', 'normal', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '085290397750', '50266', NULL),
(338, 'Adi Purnomo', '', '$2y$10$CA0EWNsD.jzpfhr76AXd8e4dHhiZvMztMPxw2JZOh0jeZTUnrePcu', 'iweks24@gmail.com', '2017-04-24 04:16:36', 'default.jpg', 'active', 'normal', '', '', '2017-04-23 21:16:36', '2017-04-23 21:16:36', '', '', '', '087832252251', NULL, NULL),
(339, 'Tiara Nira Sari', '', '$2y$10$O3/muxMBnxw73vlxthWPDewstVRKNIVawCUOZ.cDg01HzohVkyEJq', 'tiaranirasari.tns@gmail.com', '2017-04-26 02:28:29', 'default.jpg', 'active', 'normal', 'gBbXlsFVO3eSyNtX6hHCSLQsEme1s1tyabXqhwTZE7MP6G60jSAvpAq1bbzl', 'JfBcfJCkV89WD2mo2ndPeAuBx2cjkWuSi119WjtEeREzc0eASzfcGLGmatRtIqCDqzdEkdAMsSr', '2017-04-25 19:30:55', '2017-04-25 19:28:29', '', '', '', '08999382781', NULL, ''),
(340, 'Abdul', '', '$2y$10$DDNkb9/ErE2SwbJ18SEWX.ixiKIXxC..FlJlE49CyD39OhSCqP5Pi', 'hanoemz@gmail.com', '2017-04-26 16:32:47', 'default.jpg', 'active', 'normal', '', 'WEbbTHz2c8SSNiVEMLLYSIEbhT8CxyRiK8RtTepYzAjaqJTAHVI911udjYQRiwSEL7XxS0tCkNR', '2017-04-26 09:32:47', '2017-04-26 09:32:47', '', '', '', '085641643355', NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_campaign`
--

CREATE TABLE `user_campaign` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_campaign` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_campaign`
--

INSERT INTO `user_campaign` (`id`, `id_user`, `id_campaign`) VALUES
(10, 22, 30),
(11, 23, 34),
(12, 23, 27),
(13, 25, 29),
(14, 25, 29),
(15, 25, 28),
(16, 26, 29),
(17, 26, 27),
(18, 26, 27),
(19, 26, 28),
(20, 33, 36),
(21, 33, 36),
(22, 33, 36),
(23, 46, 36),
(24, 32, 36),
(25, 61, 37),
(26, 62, 37),
(27, 64, 37),
(28, 64, 37),
(29, 65, 37),
(30, 66, 37),
(31, 68, 37),
(32, 68, 39),
(33, 31, 37),
(34, 31, 36),
(35, 73, 37),
(36, 95, 41),
(37, 95, 42),
(38, 99, 41),
(40, 102, 41),
(41, 102, 41),
(42, 103, 41),
(43, 103, 41),
(44, 73, 41),
(45, 104, 41),
(46, 104, 41),
(47, 105, 41),
(48, 105, 41),
(49, 56, 41),
(50, 107, 41),
(51, 90, 41),
(52, 107, 41),
(53, 107, 41),
(54, 113, 41),
(55, 114, 41),
(56, 115, 41),
(57, 69, 41),
(58, 78, 41),
(59, 131, 42),
(60, 132, 42),
(61, 141, 42),
(62, 141, 42),
(63, 143, 42),
(64, 64, 42),
(65, 64, 42),
(66, 65, 42),
(67, 153, 42),
(68, 162, 42),
(69, 163, 42),
(70, 165, 42),
(71, 172, 42),
(72, 176, 42),
(73, 177, 42),
(74, 178, 42),
(75, 182, 42),
(76, 142, 42),
(77, 337, 42);

-- --------------------------------------------------------

--
-- Struktur dari tabel `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(10) UNSIGNED NOT NULL,
  `campaigns_id` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `amount` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gateway` varchar(100) NOT NULL,
  `account` text NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `txn_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `campaigns_id`, `status`, `amount`, `date`, `gateway`, `account`, `date_paid`, `txn_id`) VALUES
(1, 36, 'pending', '5936727', '2016-12-22 04:25:55', 'Paypal', 'harios1si@yahoo.com', '0000-00-00 00:00:00', ''),
(2, 40, 'pending', '7024050', '2017-02-05 16:18:08', 'Paypal', 'harios1si@yahoo.com', '0000-00-00 00:00:00', ''),
(3, 37, 'paid', '2051023', '2017-02-05 16:40:46', 'Paypal', 'kiranlata.ca@gmail.com', '2017-02-05 10:11:40', ''),
(4, 41, 'pending', '969319', '2017-02-27 06:09:39', 'Paypal', 'kiranlata.ca@gmail.com', '0000-00-00 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_id` (`token_id`),
  ADD KEY `author_id` (`user_id`,`status`,`token_id`),
  ADD KEY `image` (`small_image`),
  ADD KEY `goal` (`goal`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_id` (`campaigns_id`);

--
-- Indexes for table `kupon`
--
ALTER TABLE `kupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_masalah`
--
ALTER TABLE `laporan_masalah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olahan_sampah`
--
ALTER TABLE `olahan_sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panti_hewan`
--
ALTER TABLE `panti_hewan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hash` (`token`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pohon`
--
ALTER TABLE `pohon`
  ADD PRIMARY KEY (`id_pohon`);

--
-- Indexes for table `reserved`
--
ALTER TABLE `reserved`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`) USING BTREE;

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sampah_gunung`
--
ALTER TABLE `sampah_gunung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_laporan_masalah`
--
ALTER TABLE `status_laporan_masalah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_id` (`token_id`),
  ADD KEY `author_id` (`token_id`),
  ADD KEY `image` (`image`),
  ADD KEY `category_id` (`campaigns_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `username` (`status`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `user_campaign`
--
ALTER TABLE `user_campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaings_id` (`campaigns_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
--
-- AUTO_INCREMENT for table `kupon`
--
ALTER TABLE `kupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `laporan_masalah`
--
ALTER TABLE `laporan_masalah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `olahan_sampah`
--
ALTER TABLE `olahan_sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `panti_hewan`
--
ALTER TABLE `panti_hewan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pohon`
--
ALTER TABLE `pohon`
  MODIFY `id_pohon` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `reserved`
--
ALTER TABLE `reserved`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sampah_gunung`
--
ALTER TABLE `sampah_gunung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `status_laporan_masalah`
--
ALTER TABLE `status_laporan_masalah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;
--
-- AUTO_INCREMENT for table `user_campaign`
--
ALTER TABLE `user_campaign`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
