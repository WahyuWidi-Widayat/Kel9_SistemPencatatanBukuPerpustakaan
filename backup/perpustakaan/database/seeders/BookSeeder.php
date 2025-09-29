<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB; // <-- Tambahkan ini

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus atau komentari factory jika tidak ingin data acak
        // Book::factory(20)->create();

        // Masukkan data spesifik
        DB::table('books')->insert([
            [
                'title' => 'Pewaris Naga Terakhir',
                'author' => 'Aria Wibisana',
                'genre' => 'Fantasi',
                'synopsis' => 'Di dunia yang sihirnya mulai pudar, seorang pemuda menemukan bahwa ia adalah keturunan terakhir dari para penunggang naga legendaris. Ia harus membangkitkan kembali kekuatan kuno untuk menyelamatkan negerinya dari kegelapan abadi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jurnal Bintang 2049',
                'author' => 'Dr. Elara Vance',
                'genre' => 'Sains Fiksi',
                'synopsis' => 'Sebuah catatan harian dari astronot yang terdampar di sebuah planet asing. Ia harus menggunakan seluruh ilmu pengetahuan dan akalnya untuk bertahan hidup sambil mencari cara mengirim sinyal kembali ke Bumi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Senja di Pelabuhan Tua',
                'author' => 'Baskoro Adi',
                'genre' => 'Misteri',
                'synopsis' => 'Seorang detektif veteran menyelidiki kasus hilangnya seorang saudagar kaya di pelabuhan tua Jakarta. Semakin dalam ia menggali, semakin banyak rahasia kelam dari masa lalu yang terungkap.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Gema Nusantara',
                'author' => 'Prof. Haryo Mahendra',
                'genre' => 'Sejarah',
                'synopsis' => 'Mengupas tuntas sejarah kerajaan-kerajaan besar di kepulauan Nusantara, dari Sriwijaya hingga Majapahit, dan pengaruhnya yang mendalam terhadap peradaban modern Indonesia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Filosofi Teras',
                'author' => 'Henry Manampiring',
                'genre' => 'Pengembangan Diri',
                'synopsis' => 'Sebuah pengantar filsafat Stoisisme kuno yang disajikan secara relevan untuk mengatasi emosi negatif dan hidup dengan lebih tenang di tengah hiruk pikuk zaman modern.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mesin Waktu Kakek',
                'author' => 'Andini Putri',
                'genre' => 'Anak-Anak',
                'synopsis' => 'Rian dan adiknya, Sasa, tidak sengaja menemukan mesin waktu tua di gudang kakeknya. Mereka berpetualang ke masa lalu dan belajar tentang sejarah dengan cara yang menyenangkan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}