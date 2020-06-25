<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ' :attribute musí byť akceptovaný.',
    'active_url'           => ' :attribute nemá platnú URL adresu.',
    'after'                => ' :attribute musí byť dátum po :date.',
    'after_or_equal'       => ' :attribute musí byť dátum po, alebo rovný dátumu :date.',
    'alpha'                => ' :attribute smie obsahovať len písmená.',
    'alpha_dash'           => ' :attribute smie obsahovať len písmená, čísla, a pomlčky.',
    'alpha_num'            => ' :attribute smie obsahovať len písmená and čísla.',
    'array'                => ' :attribute musí byť pole.',
    'before'               => ' :attribute musí byť dátum pred :date.',
    'before_or_equal'      => ' :attribute musí byť dátum pred, alebo rovný :date.',
    'between'              => [
        'numeric' => ' :attribute musí byť v rozmedzí :min a :max.',
        'file'    => ' :attribute musí byť v rozmedzí :min a :max kilobajtov.',
        'string'  => ' :attribute musí byť v rozmedzí :min a :max znakov.',
        'array'   => ' :attribute musí mať v rozmedzí :min a :max položiek.',
    ],
    'boolean'              => ':attribute pole musí byť pravdivé, alebo nepravdivé.',
    'confirmed'            => ':attribute potvrdenie sa nezhoduje.',
    'date'                 => ':attribute nie je platný dátum.',
    'date_format'          => ':attribute sa nezhoduje s formátom :format.',
    'different'            => ':attribute a :other sa musia líšiť.',
    'digits'               => ':attribute musia byť :digits číslice.',
    'digits_between'       => ':attribute musí byť medzi číslicami :min a :max.',
    'dimensions'           => ':attribute má neplatné rozmery.',
    'distinct'             => ':attribute obsahuje duplicitné hodnoty.',
    'email'                => ':attribute musí byť platná emailová adresa.',
    'exists'               => 'Označené :attribute je neplatné.',
    'file'                 => ':attribute musí byť súbor.',
    'filled'               => ':attribute pole musí obsahovať hodnotu.',
    'image'                => ':attribute musí byť obrázok.',
    'in'                   => 'Označené :attribute je neplatné.',
    'in_array'             => ':attribute pole v :other  neexistuje.',
    'integer'              => ':attribute musí byť číslom.',
    'ip'                   => ':attribute musí byť platnou IP adresou.',
    'ipv4'                 => ':attribute musí byť platnou IPv4 adresou.',
    'ipv6'                 => ':attribute musí byť platnou IPv6 adresou.',
    'json'                 => ':attribute musí byť platným JSON reťazcom.',
    'max'                  => [
        'numeric' => ':attribute nesmie byť väčší ako :max.',
        'file'    => ':attribute nesmie byť väčší ako :max kilobajtov.',
        'string'  => ':attribute nesmie byť väčší ako :max znakov.',
        'array'   => ':attribute nesmie obsahovať viac ako :max položiek.',
    ],
    'mimes'                => ':attribute musí byť súbor type: :values.',
    'mimetypes'            => ':attribute musí byť súbor type: :values.',
    'min'                  => [
        'numeric' => ':attribute musí mať najmenej :min.',
        'file'    => ':attribute musí mať najmenej :min kilobajtov.',
        'string'  => ':attribute musí mať najmenej :min znakov.',
        'array'   => ':attribute musí mať najmenej :min položiek.',
    ],
    'not_in'               => 'Označené :attribute je neplatné.',
    'numeric'              => ':attribute musí byť číslo.',
    'present'              => ':attribute pole musí byť aktuálne.',
    'regex'                => ':attribute formát je neplatný.',
    'required'             => ':attribute pole je povinné.',
    'required_if'          => ':attribute pole je povinné ak :other je :value.',
    'required_unless'      => ':attribute pole je povinné pokiaľ :other je v :values.',
    'required_with'        => ':attribute pole je povinné ak :values je aktuálna.',
    'required_with_all'    => ':attribute pole je povinné ak :values je aktuálna.',
    'required_without'     => ':attribute pole je povinné ak :values nie je aktuálna.',
    'required_without_all' => ':attribute pole je povinné ak žiadne z :values nie sú aktálne.',
    'same'                 => ':attribute a :other sa musia zhodovať.',
    'size'                 => [
        'numeric' => ':attribute musí mať :size.',
        'file'    => ':attribute musí mať :size kilobajtov.',
        'string'  => ':attribute musí obsahovať :size znakov.',
        'array'   => ':attribute musí obsahovať :size položiek.',
    ],
    'string'               => ':attribute musí byť text.',
    'timezone'             => ':attribute musí byť platné zemepisné pásmo.',
    'unique'               => ':attribute už bol použitý.',
    'uploaded'             => 'Nahratie :attribute zlyhalo.',
    'url'                  => 'Formát :attribute je neplatný.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
