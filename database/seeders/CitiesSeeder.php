<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
  */
  public function run() {

    \DB::table('cities')->truncate();

    $cities = [
        [
          'country_id' => '1',
          'city_name' => 'New York',
          'city_image' => 'New York.svg',
          'lat' => '40.712776',
          'lng' => '-74.005974',
        ],
        [
          'country_id' => '1',
          'city_name' => 'Miami',
          'city_image' => 'miami.svg',
          'lat' => '25.761681',
          'lng' => '-80.191788',
          
        ],
        [
          'country_id' => '1',
          'city_name' => 'Los Angeles',
          'city_image' => 'los angeles.svg',
          'lat' => '34.052235',
          'lng' => '-118.243683',
          
        ],
        [
          'country_id' => '1',
          'city_name' => 'Las Vegas',
          'city_image' => 'Las Vegas.svg',
          'lat' => '36.169941',
          'lng' => '-115.139832',
          
        ],
        [
          'country_id' => '1',
          'city_name' => 'Orlando',
          'city_image' => 'Orlando.svg',
          'lat' => '28.538336',
          'lng' => '-81.379234',
          
        ],
        [
          'country_id' => '1',
          'city_name' => 'San Francisco',
          'city_image' => 'San Francisco.svg',
          'lat' => '37.774929',
          'lng' => '-122.419418',
          
        ],
        [
          'country_id' => '1',
          'city_name' => 'Hawaii',
          'city_image' => 'Hawaii.svg',
          'lat' => '19.896767',
          'lng' => '-155.582779',
          
        ],
        [
          'country_id' => '1',
          'city_name' => 'Washington DC',
          'city_image' => 'Washington DC.svg',
          'lat' => '38.907192',
          'lng' => '-77.036873',
          
        ],
        [
          'country_id' => '1',
          'city_name' => 'Grand Canyon',
          'city_image' => 'Grand  Canyon.svg',
          'lat' => '36.106964',
          'lng' => '-112.112999',
          
        ],
        [
          'country_id' => '2',
          'city_name' => 'Mexico City',
          'city_image' => 'Mexico City.svg',
          'lat' => '19.432608',
          'lng' => '-99.133209',
          
        ],
        [
          'country_id' => '2',
          'city_name' => 'Cancun',
          'city_image' => 'cancun.svg',
          'lat' => '21.161907',
          'lng' => '-86.851524',
          
        ],
        [
          'country_id' => '2',
          'city_name' => 'Tulum',
          'city_image' => 'tulum.svg',
          'lat' => '20.211418',
          'lng' => '-87.465347',
          
        ],
        [
          'country_id' => '2',
          'city_name' => 'Cabo San Lucas',
          'city_image' => 'Cabo San Lucas.svg',
          'lat' => '22.895340',
          'lng' => '-109.909813',
          
        ],
        [
          'country_id' => '2',
          'city_name' => 'Oaxaca',
          'city_image' => 'Oaxaca.svg',
          'lat' => '17.054230',
          'lng' => '-96.713226',
          
        ],
        [
          'country_id' => '3',
          'city_name' => 'Toronto',
          'city_image' => 'Toronto.svg',
          'lat' => '43.653225',
          'lng' => '-79.383186',
          
        ],
        [
          'country_id' => '3',
          'city_name' => 'Vancouver',
          'city_image' => 'Vancouver.svg',
          'lat' => '49.282730',
          'lng' => '-123.120735',
          
        ],
        [
          'country_id' => '3',
          'city_name' => 'Montreal',
          'city_image' => 'Montreal.svg',
          'lat' => '45.501690',
          'lng' => '-73.567253',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Rio de Janeiro',
          'city_image' => 'Rio de Janeiro.svg',
          'lat' => '-22.906847',
          'lng' => '-43.172897',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Sao Paulo',
          'city_image' => 'Sao Paulo.svg',
          'lat' => '-23.550520',
          'lng' => '-46.633308',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Florianopolis',
          'city_image' => 'Florianopolis.svg',
          'lat' => '-27.594870',
          'lng' => '-48.548222',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Salvador',
          'city_image' => 'Salvador.svg',
          'lat' => '-12.977749',
          'lng' => '-38.501629',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Pantanal',
          'city_image' => 'Pantanal.svg',
          'lat' => '41.186958',
          'lng' => '-73.198235',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Amazon',
          'city_image' => 'Amazon.svg',
          'lat' => '37.104599',
          'lng' => '-95.585854',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Lençóis Maranhenses',
          'city_image' => 'Lençóis  Maranhenses.svg',
          'lat' => '-12.562930',
          'lng' => '-41.390630',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Jericoacoara',
          'city_image' => 'Jericoacoara.svg',
          'lat' => '-2.897440',
          'lng' => '-40.451141',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Recife',
          'city_image' => 'Recife.svg',
          'lat' => '-8.052240',
          'lng' => '-34.928612',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Chapada Diamantina',
          'city_image' => 'Chapada Diamantina.svg',
          'lat' => '-23.543310',
          'lng' => '-46.406010',
          
        ],
        [
          'country_id' => '4',
          'city_name' => 'Foz do Iguacu',
          'city_image' => 'Foz do Iguacu.svg',
          'lat' => '-25.546900',
          'lng' => '-54.588169',
          
        ],
        [
          'country_id' => '5',
          'city_name' => 'Buenos Aires',
          'city_image' => 'Buenos Aires.svg',
          'lat' => '-34.603683',
          'lng' => '-58.381557',
          
        ],
        [
          'country_id' => '5',
          'city_name' => 'Bariloche',
          'city_image' => 'Bariloche.svg',
          'lat' => '-41.133472',
          'lng' => '-71.310280',
          
        ],
        [
          'country_id' => '5',
          'city_name' => 'Mendonza',
          'city_image' => 'Mendonza.svg',
          'lat' => '-23.415770',
          'lng' => '-51.909779',
          
        ],
        [
          'country_id' => '5',
          'city_name' => 'Patagonia',
          'city_image' => 'Patagonia.svg',
          'lat' => '39.603622',
          'lng' => '-106.517052',
          
        ],
        [
          'country_id' => '5',
          'city_name' => 'Ushuaia',
          'city_image' => 'Ushuaia.svg',
          'lat' => '-54.801910',
          'lng' => '-68.302948',
          
        ],
        [
          'country_id' => '6',
          'city_name' => 'Paris',
          'city_image' => 'paris.svg',
          'lat' => '48.856613',
          'lng' => '2.352222',
          
        ],
        [
          'country_id' => '6',
          'city_name' => 'Nice Lyon',
          'city_image' => 'Nice Lyon.svg',
          'lat' => '45.732920',
          'lng' => '4.860130',
          
        ],
        [
          'country_id' => '6',
          'city_name' => 'Strasbourg',
          'city_image' => 'Strasbourg.svg',
          'lat' => '48.573406',
          'lng' => '7.752111',
          
        ],
        [
          'country_id' => '7',
          'city_name' => 'Rome',
          'city_image' => 'rome.svg',
          'lat' => '41.902782',
          'lng' => '12.496365',
          
        ],
        [
          'country_id' => '7',
          'city_name' => 'Milan',
          'city_image' => 'milan.svg',
          'lat' => '45.464203',
          'lng' => '9.189982',
          
        ],
        [
          'country_id' => '7',
          'city_name' => 'Venice',
          'city_image' => 'Venice.svg',
          'lat' => '45.440845',
          'lng' => '12.315515',
          
        ],
        [
          'country_id' => '7',
          'city_name' => 'Florence',
          'city_image' => 'Florence.svg',
          'lat' => '43.769562',
          'lng' => '11.255814',
          
        ],
        [
          'country_id' => '7',
          'city_name' => 'Lake Como',
          'city_image' => 'Lake como.svg',
          'lat' => '40.170761',
          'lng' => '-74.027443',
          
        ],
        [
          'country_id' => '7',
          'city_name' => 'Amalfi Coast',
          'city_image' => 'Amalfi Coast.svg',
          'lat' => '26.390650',
          'lng' => '-81.782600',
          
        ],
        [
          'country_id' => '7',
          'city_name' => 'Naples',
          'city_image' => 'naples.svg',
          'lat' => '40.851799',
          'lng' => '14.268120',
          
        ],
        [
          'country_id' => '8',
          'city_name' => 'Barcelona',
          'city_image' => 'Barcelona.svg',
          'lat' => '41.385063',
          'lng' => '2.173404',
          
        ],
        [
          'country_id' => '8',
          'city_name' => 'Madrid',
          'city_image' => 'madrid.svg',
          'lat' => '40.416775',
          'lng' => '-3.703790',
          
        ],
        [
          'country_id' => '8',
          'city_name' => 'Seville',
          'city_image' => 'Seville.svg',
          'lat' => '37.389091',
          'lng' => '-5.984459',
          
        ],
        [
          'country_id' => '8',
          'city_name' => 'Palma de Mallorca',
          'city_image' => 'Palma de Mallorca.svg',
          'lat' => '38.924549',
          'lng' => '-0.220690',
          
        ],
        [
          'country_id' => '9',
          'city_name' => 'Berlin',
          'city_image' => 'berlin.svg',
          'lat' => '52.520008',
          'lng' => '13.404954',
          
        ],
        [
          'country_id' => '9',
          'city_name' => 'Munich',
          'city_image' => 'munich.svg',
          'lat' => '48.135124',
          'lng' => '11.581981',
          
        ],
        [
          'country_id' => '9',
          'city_name' => 'Hamburg',
          'city_image' => 'hamburg.svg',
          'lat' => '53.551086',
          'lng' => '9.993682',
          
        ],
        [
          'country_id' => '9',
          'city_name' => 'Frankfurt',
          'city_image' => 'Frankfurt.svg',
          'lat' => '50.110924',
          'lng' => '8.682127',
          
        ],
        [
          'country_id' => '10',
          'city_name' => 'London',
          'city_image' => 'london.svg',
          'lat' => '51.507351',
          'lng' => '-0.127758',
          
        ],
        [
          'country_id' => '10',
          'city_name' => 'Manchester',
          'city_image' => 'manchester.svg',
          'lat' => '53.480759',
          'lng' => '-2.242631',
          
        ],
        [
          'country_id' => '10',
          'city_name' => 'Cambridge',
          'city_image' => 'cambridge.svg',
          'lat' => '52.205338',
          'lng' => '0.121817',
          
        ],
        [
          'country_id' => '11',
          'city_name' => 'Moscow',
          'city_image' => 'moscow.svg',
          'lat' => '55.755825',
          'lng' => '37.617298',
          
        ],
        [
          'country_id' => '11',
          'city_name' => 'St Petersburg',
          'city_image' => 'St petersburg.svg',
          'lat' => '59.934280',
          'lng' => '30.335098',
          
        ],
        [
          'country_id' => '11',
          'city_name' => 'Trans-Siberia',
          'city_image' => 'trans siberia.svg',
          'lat' => '51.356070',
          'lng' => '80.179150',
          
        ],
        [
          'country_id' => '12',
          'city_name' => 'Agra',
          'city_image' => 'agra.svg',
          'lat' => '27.176670',
          'lng' => '78.008072',
          
        ],
        [
          'country_id' => '12',
          'city_name' => 'Goa',
          'city_image' => 'goa.svg',
          'lat' => '15.299326',
          'lng' => '74.123993',
          
        ],
        [
          'country_id' => '12',
          'city_name' => 'Manali',
          'city_image' => 'manali.svg',
          'lat' => '32.239632',
          'lng' => '77.188713',
          
        ],
        [
          'country_id' => '12',
          'city_name' => 'Mumbai',
          'city_image' => 'mumbai.svg',
          'lat' => '19.075983',
          'lng' => '72.877655',
          
        ],
        [
          'country_id' => '12',
          'city_name' => 'New Delhi',
          'city_image' => 'delhi.svg',
          'lat' => '28.613939',
          'lng' => '77.209023',
          
        ],
        [
          'country_id' => '12',
          'city_name' => 'Jaipur',
          'city_image' => 'jaipur.svg',
          'lat' => '26.912434',
          'lng' => '75.787270',
          
        ],
        [
          'country_id' => '12',
          'city_name' => 'Kerala',
          'city_image' => 'kerala.svg',
          'lat' => '10.850516',
          'lng' => '76.271080',
          
        ],
    ];

    \DB::table('cities')->insert($cities);
  }
}
