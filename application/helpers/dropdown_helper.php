<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('dropdown_data'))
{

    /**
     * @param $id
     * @return array
     */
    function dropdown_data($id, $model = null, $data = null)
    {
        switch ($id) {
            case 1:
                return array(
                	""=>lang('select_please_select'),
                    "10"=>10,
                    "20"=>20,
                    "50"=>50,
                    "all"=>lang("all")
                );
                break;
            case 4:
                return array(
                	""=>lang('select_please_select'),
                    "yes"=>lang('yes'),
                    "no"=>lang('no')
                );
                break;
            case 'language':
                $list = $model->get_all();
                $dropdown[''] = lang('select_please_select');
                foreach ($list as $item) {
                    $dropdown[$item->language_code] = $item->language_name;
                }
                return $dropdown;
                break;
            case 'companies':
                $list = $model->get_all();
                $dropdown[''] = lang('select_please_select');
                foreach ($list as $item) {
                    $dropdown[$item->id] = $item->company_name;
                }
                return $dropdown;
                break;
            case 'group':
                $dropdown[''] = lang('select_please_select');
                foreach ($model as $item) {
                    $dropdown[$item->id] = $item->description;
                }
                return $dropdown;
                break;
            case 'structure':
                $list = $model->get_all();
                $dropdown[''] = lang('select_please_select');
                foreach ($list as $item) {
                    $dropdown[$item->id] = $item->title;
                }
                return $dropdown;
                break;
            case 'user':
                $list = $model->get_all();
                $dropdown[''] = lang('select_please_select');
                foreach ($list as $item) {
                    $dropdown[$item->id] = $item->last_name . ' ' . $item->first_name;
                }
                return $dropdown;
                break;
            case 'level':
                return array(
                    '' => lang('select_please_select'),
                    '1' => '1 ' . lang('level'),
                    '2' => '2 ' . lang('level'),
                    '3' => '3 ' . lang('level'),
                    '4' => '4 ' . lang('level'),
                    '5' => '5 ' . lang('level'),
                    '6' => '6 ' . lang('level')
                );
            case 'product_category':
                return array(
                    '' => lang('select_please_select'),
                    'HS' => lang('home_savings'),
                    'ML' => lang('mortgage_loan'),
                    'PL' => lang('personal_loan'),
                    'CA' => lang('current_account')
                );
                break;
            case 'user_status':
                return array(
                    '' => lang('select_please_select'),
                    'A' => lang('active'),
                    'I' => lang('inactive'),
                    'Q' => lang('quit')
                );
                break;
            case 'legal_relation':
                return array(
                    '' => lang('select_please_select'),
                    'E' => lang('employee'),
                    'S' => lang('self_employed'),
                    'O' => lang('owner')
                );
                break;
            case 'education':
                return array(
                    '' => lang('select_please_select'),
                    'S' => lang('specialized'),
                    'M' => lang('mnb_certificate'),
                    'L' => lang('lead_only')
                );
                break;
            case 'superior':
                $dropdown[''] = lang('select_please_select');
                if (($data->structure_id) && ($data->level))
                {
                    $list = $model->get_all("structure_id = ".$data->structure_id." and level >= ".$data->level." and id != ".$data->id);
                    if ($list)
                        foreach ($list as $item)
                            $dropdown[$item->id] = $item->last_name . ' ' .$item->first_name . ' ('.$item->level.')';
                }
                return $dropdown;
                break;
            case 'bank':
                $list = $model->get_all("active = 1");
                $dropdown[''] = lang('select_please_select');
                foreach ($list as $item) {
                    $dropdown[$item->id] = $item->title;
                }
                return $dropdown;
                break;
            case 'building_society':
                $list = $model->get_all("active = 1 and home_savings = 1");
                $dropdown[''] = lang('select_please_select');
                foreach ($list as $item) {
                    $dropdown[$item->id] = $item->title;
                }
                return $dropdown;
                break;
            case 'befizetes_allapota':
                return array(
                    '' => lang('select_please_select'),
                    'FV' => 'Befizetésre vár',
                    'F' => 'Befizetve',
                    'NF' => 'Ügyfél nem fizeti',
                    'NI' => 'Nem indul el'
                );
                break;
            case 'befizetes_modja':
                return array(
                    '' => lang('select_please_select'),
                    'UT' => 'Utalás',
                    'CS' => 'Csekk',
                    'CSB' => 'CSOB',
                    'FIO' => 'Fióki befizetés'

                );
                break;
            case 'szamlanyitasi_dij_kedvezmeny':
                return array(
                    '' => lang('select_please_select'),
                    'EHB' => 'EHB',
                    '0.5' => '0,5%',
                    '1' => '1%'
                );
                break;
            case 'ugyfel_forras':
                return array(
                    '' => lang('select_please_select'),
                    'sajat' => 'Saját',
                    'B360' => 'Bank360'
                );
                break;
            case 'ugyfel_tipus':
                return array(
                    '' => lang('select_please_select'),
                    'TE' => 'Természetes személy',
                    'LT' => 'Lakószövetkezet/Társasház',
                    'NT' => 'Nem természetes személy'
                );
                break;
            case 'okmany_tipus':
                return array(
                    '' => lang('select_please_select'),
                    'SI' => 'Személyi igazolvány',
                    'VE' => 'Vezetői engedély',
                    'RS' => 'Régi típusú személyi igazolvány',
                    'UT' => 'Útlevél'
                );
                break;
            case 'users_document_type':
                return array(
                    '' => lang('select_please_select'),
                    'ES' => 'Értékesítő (megbízott) személyi igazolvány másolat',
                    'EL' => 'Értékesítő (megbízott) lakcímkártya másolat',
                    'EA' => 'Értékesítő (megbízott) adóigazolvány másolat',
                    'MN' => 'MNB Engedély/Diploma másolat',
                    'AS' => 'Alügynöki szerződés',
                    'KS' => 'Kezesi szerződés',
                    'CS' => 'Cég képviselő személyi igazolvány másolat',
                    'CL' => 'Cég képviselő lakcímkártya másolat',
                    'CA' => 'Cég képviselő adóigazolvány másolat',
                    'EG' => 'Egyéb'
                );
                break;
            case 'cases_document_type':
                return array(
                    '' => lang('select_please_select'),
                    'KA' => 'Közvetítői adatlap',
                    'AL' => 'Ajánlólap',
                    'EG' => 'Egyéb'
                );
                break;
            case 'mobile_area_code':
                return array(
                    '' => '',
                    '20' => '20',
                    '30' => '30',
                    '31' => '31',
                    '70' => '70'
                );
                break;
            case 'area_code':
                return array(
                    '' => '',
                    '20' => '20',
                    '30' => '30',
                    '31' => '31',
                    '70' => '70',
                    '1' => '1',
                    '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29',
                    '32' => '32', '33' => '33', '34' => '34', '35' => '35', '36' => '36', '37' => '37',
                    '42' => '42', '44' => '44', '45' => '45', '46' => '46', '47' => '47', '48' => '48', '49' => '49',
                    '52' => '52', '53' => '53', '54' => '54', '56' => '56', '57' => '57', '59' => '59',
                    '62' => '62', '63' => '63', '66' => '66', '68' => '68', '69' => '69',
                    '72' => '72', '73' => '73', '74' => '74', '75' => '75', '76' => '76', '77' => '77', '78' => '78', '79' => '79',
                    '82' => '82', '83' => '83', '84' => '84', '85' => '85', '87' => '87', '88' => '88', '89' => '89',
                    '92' => '92', '93' => '93', '94' => '94', '95' => '95', '96' => '96', '99' => '99'
                );
                break;
            case 'call_time':
                return array(
                    '' => lang('select_please_select'),
                    'RE' => 'reggel',
                    'DE' => 'délelőtt',
                    'DU' => 'délután',
                    'ES' => 'este',
                    'HV' => 'hétvégén'
                );
                break;
            case 'lead_status':
                return array(
                    '' => lang('select_please_select'),
                    'PKK' => 'Telefonhívás – Ki van kapcsolva',
                    'PNV' => 'Telefonhívás – Nem veszi fel',
                    'PUK' => 'Telefonhívás – Máshol újrakötötte a szerződését',
                    'PRA' => 'Telefonhívás – Rossz adat',
                    'INV' => 'Időpont egyeztetés - Nem vette fel',
                    'ISI' => 'Időpont egyeztetés - Sikeres',
                    'IKH' => 'Időpont egyeztetés – Nem aktuális, később hívni',
                    'IVH' => 'Időpont egyeztetés – Majd visszahívom, megbeszéljük',
                    'IVL' => 'Időpont egyeztetés – Már van LTP-je',
                    'ILZ' => 'Időpont egyeztetés – Sokszor nem elérhető - lezárva',
                    'IAN' => 'Időpont egyeztetés – Abszolút nem',
                    'SEM' => 'Személyes találkozó – Elmaradt, ügyfél nem jelzett',
                    'TSK' => 'Tárgyalás kimenetele – Sikeres kötés',
                    'TMG' => 'Tárgyalás kimenetele – Még meggondolja',
                    'SUI' => 'Személyes találkozó – Ügyfél új időpontot kért',
                    'TEU' => 'Tárgyalás kimenetele – Véglegesen elutasított',
                    'TNJ' => 'Tárgyalás kimenetele – Nem javaslom',
                    'TVL' => 'Tárgyalás kimenetele – Már van LTP-je',
                    'FEL' => 'Szerződés felmondva'
                );
                break;
            case 'agent':
                $dropdown[''] = lang('select_please_select');
                foreach ($data as $item) {
                    $dropdown[$item->id] = $item->last_name. ' '.$item->first_name;
                }
                return $dropdown;
                break;
        }
    }
}
