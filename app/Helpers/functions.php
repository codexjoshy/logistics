<?php
use Illuminate\Http\JsonResponse;
use phpDocumentor\Reflection\DocBlock;

/**
 * Return a successful JSON response
 *
 * @param array $payload
 * @param string $message
 * @param integer $status
 * @return JsonResponse
 */
function respondWithSuccess($payload = [], $message = 'Successful', $status = 200): JsonResponse
{
    return response()->json(['success' => true, 'message' => $message,  'payload' => $payload], $status);
}

/**
 * Return a successful JSON response
 *
 * @param array $payload
 * @param string $message
 * @param integer $status
 * @return JsonResponse
 */
function respondWithError($payload = [], $message = 'An erorr occured', $status = 500): JsonResponse
{
    return response()->json(['success' => false, 'message' => $message,  'payload' => $payload], $status);
}

/**
 * Undocumented function
 *
 * @param float $amount
 * @param integer $dp
 * @return string
 */
function toMoney(float $amount = 0, int $dp = 2): string
{
    return number_format($amount, $dp);
}

/**
 * Undocumented function
 *
 * @param float $amount
 * @param integer $dp
 * @return string
 */
function toNaira(float $amount = 0, int $dp = 2): string
{
    return  $amount < 0 ? '-₦' . toMoney(abs($amount), $dp) : '₦' . toMoney($amount, $dp);
}


/**
 * Generate the URL to a named hrm route
 *
 * @param array|string $route
 * @param mixed $parameters
 * @param bool $absolute
 * @return string
 */
function hrmRoute($route, $parameters = [], bool $absolute = true): string
{
    return route('hrm.' . $route, $parameters, $absolute);
}

/**
 * Undocumented function
 *
 * @param string $view
 * @param \Illuminate\Contracts\Support\Arrayable|array $data
 * @param array $mergeData
 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
 */
function hrmView(string $view, $data = [], array $mergeData = [])
{
    return view('hrm.' . $view, $data, $mergeData);
}




function generateReceiptNo($no, $prefix = 'RE', $chars = 9, $padChar = '000000000', $pad = 'left')
{
    $recieptNo =  str_pad($no, $chars, "$prefix$padChar", STR_PAD_LEFT);
    if (strlen(strval($no)) >= $chars) $recieptNo = "$prefix" . $recieptNo;
    return $recieptNo;
}

function displayPhone($phone){
    $intl_format = substr($phone, 1); //returns 8032537302
    //now add 234 to intl_format
    $intl_format = sprintf("%s%s", "234", $intl_format);
    return intval($intl_format);
}


/**
 * A collection of states in Nigeria
 * @param boolean withCode true ['LAG'=>'Lagos'] false ['Lagos']
 * @return array $states an array of states
 */
function states($withCode = false)
{
    $states = [
        'Abia', 'Abuja', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River',
        'Delta', 'Ebonyi', 'Enugu', 'Edo', 'Ekiti', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina',
        'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau',
        'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'
    ];
    if ($withCode) {
        $states = [
            'ABIA' => 'Abia', 'ABU' => 'Abuja', 'ADA' => 'Adamawa', 'AKW' => 'Akwa Ibom', 'ANA' => 'Anambra', 'BAU' => 'Bauchi',
            'BAY' => 'Bayelsa', 'BEN' => 'Benue', 'BOR' => 'Borno', 'CRO' => 'Cross River', 'DEL' => 'Delta',
            'EBO' => 'Ebonyi', 'ENU' => 'Enugu', 'EDO' => 'Edo', 'EKI' => 'Ekiti', 'GOM' => 'Gombe',
            'IMO' => 'Imo', 'JIG' => 'Jigawa', 'KAD' => 'Kaduna', 'KAN' => 'Kano', 'KAT' => 'Katsina',
            'KEB' => 'Kebbi', 'KOG' => 'Kogi', 'KWA' => 'Kwara', 'LAG' => 'Lagos', 'NAS' => 'Nasarawa',
            'NIG' => 'Niger', 'OGN' => 'Ogun', 'OND' => 'Ondo', 'OSU' => 'Osun', 'OYO' => 'Oyo',
            'PLA' => 'Plateau', 'RIV' => 'Rivers', 'SOK' => 'Sokoto', 'TAR' => 'Taraba', 'YOB' => 'Yobe',
            'ZAM' => 'Zamfara'
        ];
    }
    return $states;
}
/**
 *
 */
function stateLocalGovt()
{
    return [
        "abia" => ["Abia", "Aba North", "Aba South", "Arochukwu", "Bende", "Ikwuano", "Isiala Ngwa North", "Isiala Ngwa South", "Isuikwuato", "Obi Ngwa", "Ohafia", "Osisioma", "Ugwunagbo", "Ukwa East", "Ukwa West", "Umuahia North", "Umuahia South", "Umu Nneochi"],

        "abuja" => ["Abaji", "Abuja Municipal Area Council", "Bwari", "Gwagwalada", "Kuje", "Kwali"],

        "adamawa" => ["Adamawa", "Demsa", "Fufure", "Ganye", "Gayuk", "Gombi", "Grie", "Hong", "Jada", "Lamurde", "Madagali", "Maiha", "Mayo Belwa", "Michika", "Mubi North", "Mubi South", "Numan", "Shelleng", "Song", "Toungo", "Yola North", "Yola South"],

        "akwa ibom" => ["Akwa Ibom", "Abak", "Eastern Obolo", "Eket", "Esit Eket", "Essien Udim", "Etim Ekpo", "Etinan", "Ibeno", "Ibesikpo Asutan", "Ibiono-Ibom", "Ika", "Ikono", "Ikot Abasi", "Ikot Ekpene", "Ini", "Itu", "Mbo", "Mkpat-Enin", "Nsit-Atai", "Nsit-Ibom", "Nsit-Ubium", "Obot Akara", "Okobo", "Onna", "Oron", "Oruk Anam", "Udung-Uko", "Ukanafun", "Uruan", "Urue-Offong Oruko", "Uyo"],

        "anambra" => ["Anambra", "Aguata", "Anambra East", "Anambra West", "Anaocha", "Awka North", "Awka South", "Ayamelum", "Dunukofia", "Ekwusigo", "Idemili North", "Idemili South", "Ihiala", "Njikoka", "Nnewi North", "Nnewi South", "Ogbaru", "Onitsha North", "Onitsha South", "Orumba North", "Orumba South", "Oyi", "Aauchi"],

        "bauchi" => ["Bauchi", "Alkaleri", "Bauchi", "Bogoro", "Damban", "Darazo", "Dass", "Gamawa", "Ganjuwa", "Giade", "Itas Gadau", "Jama'are", "Katagum", "Kirfi", "Misau", "Ningi", "Shira", "Tafawa Balewa", "Toro", "Warji", "Zaki"],

        "bayelsa" => ["Bayelsa", "Brass", "Ekeremor", "Kolokuma Opokuma", "Nembe", "Ogbia", "Sagbama", "Southern Ijaw", "Yenagoa"],

        "benue" => ["Benue", "Agatu", "Apa", "Ado", "Buruku", "Gboko", "Guma", "Gwer East", "Gwer West", "Katsina-Ala", "Konshisha", "Kwande", "Logo", "Makurdi", "Obi", "Ogbadibo", "Ohimini", "Oju", "Okpokwu", "Oturkpo", "Tarka", "Ukum", "Ushongo", "Vandeikya"],

        "borno" => ["Borno", "Abadam", "Askira Uba", "Bama", "Bayo", "Biu", "Chibok", "Damboa", "Dikwa", "Gubio", "Guzamala", "Gwoza", "Hawul", "Jere", "Kaga", "Kala Balge", "Konduga", "Kukawa", "Kwaya Kusar", "Mafa", "Magumeri", "Maiduguri", "Marte", "Mobbar", "Monguno", "Ngala", "Nganzai", "Shani"],

        "cross River" => ["Cross River", "Abi", "Akamkpa", "Akpabuyo", "Bakassi", "Bekwarra", "Biase", "Boki", "Calabar Municipal", "Calabar South", "Etung", "Ikom", "Obanliku", "Obubra", "Obudu", "Odukpani", "Ogoja", "Yakuur", "Yala"],

        "delta" => ["Delta", "Aniocha North", "Aniocha South", "Bomadi", "Burutu", "Ethiope East", "Ethiope West", "Ika North East", "Ika South", "Isoko North", "Isoko South", "Ndokwa East", "Ndokwa West", "Okpe", "Oshimili North", "Oshimili South", "Patani", "Sapele", "Udu", "Ughelli North", "Ughelli South", "Ukwuani", "Uvwie", "Warri North", "Warri South", "Warri South West"],

        "ebonyi" => ["Ebonyi", "Abakaliki", "Afikpo North", "Afikpo South", "Ebonyi", "Ezza North", "Ezza South", "Ikwo", "Ishielu", "Ivo", "Izzi", "Ohaozara", "Ohaukwu", "Onicha"],

        "edo" => ["Edo", "Akoko-Edo", "Egor", "Esan Central", "Esan North-East", "Esan South-East", "Esan West", "Etsako Central", "Etsako East", "Etsako West", "Igueben", "Ikpoba Okha", "Orhionmwon", "Oredo", "Ovia North-East", "Ovia South-West", "Owan East", "Owan West", "Uhunmwonde"],

        "ekiti" => ["Ekiti", "Ado Ekiti", "Efon", "Ekiti East", "Ekiti South-West", "Ekiti West", "Emure", "Gbonyin", "Ido Osi", "Ijero", "Ikere", "Ikole", "Ilejemeje", "Irepodun Ifelodun", "Ise Orun", "Moba", "Oye"],

        "enugu" => ["Enugu", "Aninri", "Awgu", "Enugu East", "Enugu North", "Enugu South", "Ezeagu", "Igbo Etiti", "Igbo Eze North", "Igbo Eze South", "Isi Uzo", "Nkanu East", "Nkanu West", "Nsukka", "Oji River", "Udenu", "Udi", "Uzo Uwani"],

        "fct" => ["FCT", "Abaji", "Bwari", "Gwagwalada", "Kuje", "Kwali", "Municipal Area Council"],

        "gombe" => ["Gombe", "Akko", "Balanga", "Billiri", "Dukku", "Funakaye", "Gombe", "Kaltungo", "Kwami", "Nafada", "Shongom", "Yamaltu Deba"],

        "imo" => ["Imo", "Aboh Mbaise", "Ahiazu Mbaise", "Ehime Mbano", "Ezinihitte", "Ideato North", "Ideato South", "Ihitte Uboma", "Ikeduru", "Isiala Mbano", "Isu", "Mbaitoli", "Ngor Okpala", "Njaba", "Nkwerre", "Nwangele", "Obowo", "Oguta", "Ohaji Egbema", "Okigwe", "Orlu", "Orsu", "Oru East", "Oru West", "Owerri Municipal", "Owerri North", "Owerri West", "Unuimo"],

        "jigawa" => ["Jigawa", "Auyo", "Babura", "Biriniwa", "Birnin Kudu", "Buji", "Dutse", "Gagarawa", "Garki", "Gumel", "Guri", "Gwaram", "Gwiwa", "Hadejia", "Jahun", "Kafin Hausa", "Kazaure", "Kiri Kasama", "Kiyawa", "Kaugama", "Maigatari", "Malam Madori", "Miga", "Ringim", "Roni", "Sule Tankarkar", "Taura", "Yankwashi"],

        "kaduna" => ["Kaduna", "Birnin Gwari", "Chikun", "Giwa", "Igabi", "Ikara", "Jaba", "Jema'a", "Kachia", "Kaduna North", "Kaduna South", "Kagarko", "Kajuru", "Kaura", "Kauru", "Kubau", "Kudan", "Lere", "Makarfi", "Sabon Gari", "Sanga", "Soba", "Zangon Kataf", "Zaria"],

        "kano" => ["Kano", "Ajingi", "Albasu", "Bagwai", "Bebeji", "Bichi", "Bunkure", "Dala", "Dambatta", "Dawakin Kudu", "Dawakin Tofa", "Doguwa", "Fagge", "Gabasawa", "Garko", "Garun Mallam", "Gaya", "Gezawa", "Gwale", "Gwarzo", "Kabo", "Kano Municipal", "Karaye", "Kibiya", "Kiru", "Kumbotso", "Kunchi", "Kura", "Madobi", "Makoda", "Minjibir", "Nasarawa", "Rano", "Rimin Gado", "Rogo", "Shanono", "Sumaila", "Takai", "Tarauni", "Tofa", "Tsanyawa", "Tudun Wada", "Ungogo", "Warawa", "Wudil"],

        "katsina" => ["Katsina", "Bakori", "Batagarawa", "Batsari", "Baure", "Bindawa", "Charanchi", "Dandume", "Danja", "Dan Musa", "Daura", "Dutsi", "Dutsin Ma", "Faskari", "Funtua", "Ingawa", "Jibia", "Kafur", "Kaita", "Kankara", "Kankia", "Katsina", "Kurfi", "Kusada", "Mai'Adua", "Malumfashi", "Mani", "Mashi", "Matazu", "Musawa", "Rimi", "Sabuwa", "Safana", "Sandamu", "Zango"],

        "kebbi" => ["Kebbi", "Aleiro", "Arewa Dandi", "Argungu", "Augie", "Bagudo", "Birnin Kebbi", "Bunza", "Dandi", "Fakai", "Gwandu", "Jega", "Kalgo", "Koko Besse", "Maiyama", "Ngaski", "Sakaba", "Shanga", "Suru", "Wasagu Danko", "Yauri", "Zuru"],

        "Kogi" => ["Kogi", "Adavi", "Ajaokuta", "Ankpa", "Bassa", "Dekina", "Ibaji", "Idah", "Igalamela Odolu", "Ijumu", "Kabba Bunu", "Kogi", "Lokoja", "Mopa Muro", "Ofu", "Ogori Magongo", "Okehi", "Okene", "Olamaboro", "Omala", "Yagba East", "Yagba West"],

        "kwara" => ["Kwara", "Asa", "Baruten", "Edu", "Ekiti", "Ifelodun", "Ilorin East", "Ilorin South", "Ilorin West", "Irepodun", "Isin", "Kaiama", "Moro", "Offa", "Oke Ero", "Oyun", "Pategi"],

        "lagos" => ["Lagos", "Agege", "Ajeromi-Ifelodun", "Alimosho", "Amuwo-Odofin", "Apapa", "Badagry", "Epe", "Eti Osa", "Ibeju-Lekki", "Ifako-Ijaiye", "Ikeja", "Ikorodu", "Kosofe", "Lagos Island", "Lagos Mainland", "Mushin", "Ojo", "Oshodi-Isolo", "Shomolu", "Surulere"],

        "nasarawa" => ["Nasarawa", "Akwanga", "Awe", "Doma", "Karu", "Keana", "Keffi", "Kokona", "Lafia", "Nasarawa", "Nasarawa Egon", "Obi", "Toto", "Wamba"],

        "niger" => ["Niger", "Agaie", "Agwara", "Bida", "Borgu", "Bosso", "Chanchaga", "Edati", "Gbako", "Gurara", "Katcha", "Kontagora", "Lapai", "Lavun", "Magama", "Mariga", "Mashegu", "Mokwa", "Moya", "Paikoro", "Rafi", "Rijau", "Shiroro", "Suleja", "Tafa", "Wushishi"],

        "ogun" => ["Ogun", "Abeokuta North", "Abeokuta South", "Ado-Odo Ota", "Egbado North", "Egbado South", "Ewekoro", "Ifo", "Ijebu East", "Ijebu North", "Ijebu North East", "Ijebu Ode", "Ikenne", "Imeko Afon", "Ipokia", "Obafemi Owode", "Odeda", "Odogbolu", "Ogun Waterside", "Remo North", "Shagamu"],

        "ondo" => ["Ondo", "Akoko North-East", "Akoko North-West", "Akoko South-West", "Akoko South-East", "Akure North", "Akure South", "Ese Odo", "Idanre", "Ifedore", "Ilaje", "Ile Oluji Okeigbo", "Irele", "Odigbo", "Okitipupa", "Ondo East", "Ondo West", "Ose", "Owo"],

        "osun" => ["Osun", "Atakunmosa East", "Atakunmosa West", "Aiyedaade", "Aiyedire", "Boluwaduro", "Boripe", "Ede North", "Ede South", "Ife Central", "Ife East", "Ife North", "Ife South", "Egbedore", "Ejigbo", "Ifedayo", "Ifelodun", "Ila", "Ilesa East", "Ilesa West", "Irepodun", "Irewole", "Isokan", "Iwo", "Obokun", "Odo Otin", "Ola Oluwa", "Olorunda", "Oriade", "Orolu", "Osogbo"],

        "oyo" => ["Oyo", "Afijio", "Akinyele", "Atiba", "Atisbo", "Egbeda", "Ibadan North", "Ibadan North-East", "Ibadan North-West", "Ibadan South-East", "Ibadan South-West", "Ibarapa Central", "Ibarapa East", "Ibarapa North", "Ido", "Irepo", "Iseyin", "Itesiwaju", "Iwajowa", "Kajola", "Lagelu", "Ogbomosho North", "Ogbomosho South", "Ogo Oluwa", "Olorunsogo", "Oluyole", "Ona Ara", "Orelope", "Ori Ire", "Oyo", "Oyo East", "Saki East", "Saki West", "Surulere"],

        "plateau" => ["Plateau", "Bokkos", "Barkin Ladi", "Bassa", "Jos East", "Jos North", "Jos South", "Kanam", "Kanke", "Langtang South", "Langtang North", "Mangu", "Mikang", "Pankshin", "Qua'an Pan", "Riyom", "Shendam", "Wase"],

        "rivers" => ["Rivers", "Abua Odual", "Ahoada East", "Ahoada West", "Akuku-Toru", "Andoni", "Asari-Toru", "Bonny", "Degema", "Eleme", "Emuoha", "Etche", "Gokana", "Ikwerre", "Khana", "Obio Akpor", "Ogba Egbema Ndoni", "Ogu Bolo", "Okrika", "Omuma", "Opobo Nkoro", "Oyigbo", "Port Harcourt", "Tai"],

        "sokoto" => ["Sokoto", "Binji", "Bodinga", "Dange Shuni", "Gada", "Goronyo", "Gudu", "Gwadabawa", "Illela", "Isa", "Kebbe", "Kware", "Rabah", "Sabon Birni", "Shagari", "Silame", "Sokoto North", "Sokoto South", "Tambuwal", "Tangaza", "Tureta", "Wamako", "Wurno", "Yabo"],

        "taraba" => ["Taraba", "Ardo Kola", "Bali", "Donga", "Gashaka", "Gassol", "Ibi", "Jalingo", "Karim Lamido", "Kumi", "Lau", "Sardauna", "Takum", "Ussa", "Wukari", "Yorro", "Zing"],

        "yobe" => ["Yobe", "Bade", "Bursari", "Damaturu", "Fika", "Fune", "Geidam", "Gujba", "Gulani", "Jakusko", "Karasuwa", "Machina", "Nangere", "Nguru", "Potiskum", "Tarmuwa", "Yunusari", "Yusufari"],

        "zamfara" => ["Zamfara", "Anka", "Bakura", "Birnin Magaji Kiyaw", "Bukkuyum", "Bungudu", "Gummi", "Gusau", "Kaura Namoda", "Maradun", "Maru", "Shinkafi", "Talata Mafara", "Chafe", "Zurmi"]
    ];
}
