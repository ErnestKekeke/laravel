<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Clinic;


class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = [
            [
                'clinic_id' => 'ABCD',
                'clinic_name' => 'Lagos General Hospital',
                'clinic_type' => 'general',
                'reg_no' => 'LGH-2020-001',
                'lic_issue_dt' => '2020-01-15',
                'accred_status' => 'accredited',
                'med_dir' => 'Dr. Adebayo Johnson',
                'email' => 'info@lagosgeneral.com',
                'contact_no' => '+234-801-234-5678',
                'address' => '123 Marina Street, Lagos Island',
                'country' => 'Nigeria',
                'state' => 'Lagos',
                'city' => 'Lagos Island',
                'password' => Hash::make('password123'),
            ],
            [
                'clinic_id' => 'EFGH',
                'clinic_name' => 'Abuja Medical Center',
                'clinic_type' => 'specialty',
                'reg_no' => 'AMC-2019-045',
                'lic_issue_dt' => '2019-06-20',
                'accred_status' => 'accredited',
                'med_dir' => 'Dr. Ngozi Okonkwo',
                'email' => 'admin@abujamedical.org',
                'contact_no' => '+234-802-345-6789',
                'address' => '45 Central Area Boulevard',
                'country' => 'Nigeria',
                'state' => 'Abuja',
                'city' => 'Central Area',
                'password' => Hash::make('password123'),
            ],
            [
                'clinic_id' => 'IJKL',
                'clinic_name' => 'Kano Infectious Disease Clinic',
                'clinic_type' => 'specialty',
                'reg_no' => 'KIDC-2021-012',
                'lic_issue_dt' => '2021-03-10',
                'accred_status' => 'pending',
                'med_dir' => 'Dr. Ibrahim Musa',
                'email' => 'contact@kanoidc.ng',
                'contact_no' => '+234-803-456-7890',
                'address' => '78 Gidan Murtala Road',
                'country' => 'Nigeria',
                'state' => 'Kano',
                'city' => 'Kano Municipal',
                'password' => Hash::make('password123'),
            ],
            [
                'clinic_id' => 'MNOP',
                'clinic_name' => 'Accra Health Clinic',
                'clinic_type' => 'community',
                'reg_no' => 'AHC-2022-089',
                'lic_issue_dt' => '2022-08-05',
                'accred_status' => 'accredited',
                'med_dir' => 'Dr. Kwame Mensah',
                'email' => 'info@accrahealth.gh',
                'contact_no' => '+233-24-567-8901',
                'address' => '12 Independence Avenue',
                'country' => 'Ghana',
                'state' => 'Greater Accra',
                'city' => 'Accra',
                'password' => Hash::make('password123'),
            ],
            [
                'clinic_id' => 'QRST',
                'clinic_name' => 'Nairobi Central Clinic',
                'clinic_type' => 'general',
                'reg_no' => 'NCC-2020-156',
                'lic_issue_dt' => '2020-11-22',
                'accred_status' => 'accredited',
                'med_dir' => 'Dr. James Kamau',
                'email' => 'info@nairobicentral.ke',
                'contact_no' => '+254-722-345-678',
                'address' => '34 Kenyatta Avenue',
                'country' => 'Kenya',
                'state' => 'Nairobi',
                'city' => 'Nairobi',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($clinics as $clinic) {
            Clinic::create($clinic);
        }

        $this->command->info('Clinics seeded successfully!');
    }
}