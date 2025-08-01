<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Support\Str;

class RealPartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin user or create one if none exists
        $adminUser = User::where('role', 'admin')->first();
        if (!$adminUser) {
            $adminUser = User::factory()->create(['role' => 'admin']);
        }

        $partners = [
            [
                'name' => 'Yayasan Muslimin',
                'description' => 'Hasrat penubuhan Yayasan Muslimin ialah mengetengahkan semula ruh institusi wakaf, sedekah dan zakat yang dituntut oleh Islam untuk meningkatkan pembangunan di dalam bidang sosio-ekonomi dan pendidikan umat Islam. Kewujudannya dapat membuka peluang yang lebih luas kepada masyarakat memberi sumbangan untuk tujuan amal kepada perkembangan Islam.',
                'url' => 'https://yayasanmuslimin.org/',
                'status' => 'active',
                'featured' => true,
                'display_order' => 1,
                'logo' => 'partners/yayasan-muslimin.png'
            ],
            [
                'name' => 'Yayasan Ikhlas',
                'description' => 'Yayasan Ikhlas adalah sebuah organisasi yang ditubuhkan di bawah Akta Pemegang Amanah (Pemerbadanan) 1952 (Akta 258) pada 5 Mac 2009 yang bertujuan untuk meringankan beban yang dihadapi oleh anak yatim, orang kelainan upaya, faqir dan mereka yang ditimpa bencana selain memberi bantuan atau insentif kepada individu atau kumpulan sama ada untuk pembelajaran atau penyelidikan di Malaysia.',
                'url' => 'http://www.yayasanikhlas.org.my/',
                'status' => 'active',
                'featured' => true,
                'display_order' => 2,
                'logo' => 'partners/yayasan-ikhlas.png'
            ],
            [
                'name' => 'MAB',
                'description' => 'Persatuan Orang Buta Malaysia (MAB) adalah organisasi sukarela terulung di Malaysia yang menyantuni orang kelainan upaya dalam penglihatan. Persatuan ini menyediakan perkhidmatan membantu orang buta dan mencegah tragedi kebutaan yang dapat dielakkan.',
                'url' => 'https://mab.org.my/maborg/default.html',
                'status' => 'active',
                'featured' => true,
                'display_order' => 3,
                'logo' => 'partners/mab.png'
            ],
            [
                'name' => 'NASOM',
                'description' => 'National Autism Society of Malaysia (NASOM) adalah sebuah persatuan yang dibentuk pada tahun 1987 oleh sekumpulan ibu bapa dan profesional dengan tujuan untuk memberikan perkhidmatan jangka hayat kepada golongan yang mempunyai autisme.',
                'url' => 'http://www.nasom.org.my/',
                'status' => 'active',
                'featured' => true,
                'display_order' => 4,
                'logo' => 'partners/nasom.png'
            ],
            [
                'name' => 'PruBSN',
                'description' => 'PruBSN Prihatin adalah sebuah badan amal di bawah Prudential BSN Takaful (PruBSN) yang telah ditubuhkan pada 23 Mac 2015 yang bertujuan untuk menyediakan peluang pendidikan dan kemahiran hidup, kesihatan dan kesejahteraan hidup, dan bantuan bencana bagi keluarga dan masyarakat yang kurang bernasib baik di seluruh Malaysia. Sebagai pengendali takaful yang berlandaskan konsep perlindungan bersama dan kerjasama untuk kebaikan para pesertanya, PruBSN turut meletakkan komitmen yang tinggi dalam memastikan kesejahteraan jangka panjang untuk komuniti di Malaysia.',
                'url' => 'https://www.prubsn.com.my/ms/caring-for-society/',
                'status' => 'active',
                'featured' => true,
                'display_order' => 5,
                'logo' => 'partners/prubsn.png'
            ],
            [
                'name' => 'Yayasan Angkasa',
                'description' => 'Yayasan ANGKASA sebelumnya dikenali sebagai Tabung Pendidikan ANGKASA (TAPAK) dari tahun 2000 hingga kini merupakan yayasan yang ditubuhkan oleh Angkatan Koperasi Kebangsaan Malaysia (ANGKASA) pada tahun 2012. Matlamat utama penubuhan Yayasan ANGKASA adalah membantu melahirkan golongan berpengetahuan dan berkemahiran yang boleh menyumbang kepada gerakan koperasi, masyarakat dan negara amnya. Di samping menyediakan bantuan pembiayaan pendidikan, Yayasan ANGKASA memberi kursus dan program-program tahunan kecemerlangan pelajar yang bertujuan untuk meningkatkan kemahiran dan mengekalkan prestasi pelajar seperti Kursus Motivasi, Kursus Kaunseling, Kursus Persediaan Pekerjaan dan Kursus Keusahawanan serta Kursus Kemasyarakatan.',
                'url' => 'https://www.yayasanangkasa.coop/',
                'status' => 'active',
                'featured' => true,
                'display_order' => 6,
                'logo' => 'partners/yayasan-angkasa.png'
            ]
        ];

        foreach ($partners as $partnerData) {
            Partner::create([
                'name' => $partnerData['name'],
                'slug' => Str::slug($partnerData['name']) . '-' . Str::random(5),
                'description' => $partnerData['description'],
                'url' => $partnerData['url'],
                'status' => $partnerData['status'],
                'featured' => $partnerData['featured'],
                'display_order' => $partnerData['display_order'],
                'logo' => $partnerData['logo'],
                'created_by' => $adminUser->id,
            ]);
        }

        $this->command->info('Real partners from Jariah Fund website have been seeded successfully!');
    }
}
