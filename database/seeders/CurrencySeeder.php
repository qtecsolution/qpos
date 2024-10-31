<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            // Global currencies
            ['name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$'],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['name' => 'British Pound', 'code' => 'GBP', 'symbol' => '£'],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'symbol' => '¥'],
            ['name' => 'Australian Dollar', 'code' => 'AUD', 'symbol' => 'A$'],
            ['name' => 'Canadian Dollar', 'code' => 'CAD', 'symbol' => 'C$'],

            // Asian countries
            ['name' => 'Chinese Yuan', 'code' => 'CNY', 'symbol' => '¥'],
            ['name' => 'Indian Rupee', 'code' => 'INR', 'symbol' => '₹'],
            ['name' => 'Indonesian Rupiah', 'code' => 'IDR', 'symbol' => 'Rp'],
            ['name' => 'Pakistani Rupee', 'code' => 'PKR', 'symbol' => '₨'],
            ['name' => 'Bangladeshi Taka', 'code' => 'BDT', 'symbol' => '৳','active'=>true],
            ['name' => 'Vietnamese Dong', 'code' => 'VND', 'symbol' => '₫'],
            ['name' => 'Philippine Peso', 'code' => 'PHP', 'symbol' => '₱'],
            ['name' => 'Thai Baht', 'code' => 'THB', 'symbol' => '฿'],
            ['name' => 'South Korean Won', 'code' => 'KRW', 'symbol' => '₩'],
            ['name' => 'Malaysian Ringgit', 'code' => 'MYR', 'symbol' => 'RM'],
            ['name' => 'Singapore Dollar', 'code' => 'SGD', 'symbol' => 'S$'],
            ['name' => 'Sri Lankan Rupee', 'code' => 'LKR', 'symbol' => '₨'],
            ['name' => 'Nepalese Rupee', 'code' => 'NPR', 'symbol' => '₨'],
            ['name' => 'Afghan Afghani', 'code' => 'AFN', 'symbol' => '؋'],
            ['name' => 'Iraqi Dinar', 'code' => 'IQD', 'symbol' => 'ع.د'],
            ['name' => 'Iranian Rial', 'code' => 'IRR', 'symbol' => '﷼'],
            ['name' => 'Saudi Riyal', 'code' => 'SAR', 'symbol' => '﷼'],
            ['name' => 'Israeli New Shekel', 'code' => 'ILS', 'symbol' => '₪'],
            ['name' => 'Turkish Lira', 'code' => 'TRY', 'symbol' => '₺'],
            ['name' => 'Emirati Dirham', 'code' => 'AED', 'symbol' => 'د.إ'],
            ['name' => 'Qatari Riyal', 'code' => 'QAR', 'symbol' => '﷼'],
            ['name' => 'Omani Rial', 'code' => 'OMR', 'symbol' => '﷼'],
            ['name' => 'Kuwaiti Dinar', 'code' => 'KWD', 'symbol' => 'د.ك'],
            ['name' => 'Jordanian Dinar', 'code' => 'JOD', 'symbol' => 'د.ا'],
            ['name' => 'Lebanese Pound', 'code' => 'LBP', 'symbol' => 'ل.ل'],
            ['name' => 'Syrian Pound', 'code' => 'SYP', 'symbol' => '£'],
            ['name' => 'Yemeni Rial', 'code' => 'YER', 'symbol' => '﷼'],
            ['name' => 'Armenian Dram', 'code' => 'AMD', 'symbol' => '֏'],
            ['name' => 'Azerbaijani Manat', 'code' => 'AZN', 'symbol' => '₼'],
            ['name' => 'Georgian Lari', 'code' => 'GEL', 'symbol' => '₾'],
            ['name' => 'Kazakhstani Tenge', 'code' => 'KZT', 'symbol' => '₸'],
            ['name' => 'Uzbekistani Som', 'code' => 'UZS', 'symbol' => 'лв'],
            ['name' => 'Turkmenistan Manat', 'code' => 'TMT', 'symbol' => 'm'],
            ['name' => 'Tajikistani Somoni', 'code' => 'TJS', 'symbol' => 'ЅМ'],
            ['name' => 'Kyrgyzstani Som', 'code' => 'KGS', 'symbol' => 'лв'],
            ['name' => 'Mongolian Tugrik', 'code' => 'MNT', 'symbol' => '₮'],
            ['name' => 'Bahraini Dinar', 'code' => 'BHD', 'symbol' => '.د.ب'],
            ['name' => 'Maldivian Rufiyaa', 'code' => 'MVR', 'symbol' => 'Rf'],
            ['name' => 'Bhutanese Ngultrum', 'code' => 'BTN', 'symbol' => 'Nu.'],
            ['name' => 'Myanmar Kyat', 'code' => 'MMK', 'symbol' => 'K'],
            ['name' => 'Laotian Kip', 'code' => 'LAK', 'symbol' => '₭'],
            ['name' => 'Cambodian Riel', 'code' => 'KHR', 'symbol' => '៛'],
            ['name' => 'Brunei Dollar', 'code' => 'BND', 'symbol' => 'B$']
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
