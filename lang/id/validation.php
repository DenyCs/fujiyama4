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

    'accepted'        => ':attribute harus diterima.',
    'accepted_if'     => ':attribute harus diterima ketika :other berisi :value.',
    'active_url'      => ':attribute bukan URL yang valid.',
    'after'           => ':attribute harus berupa tanggal setelah :date.',
    'after_or_equal'  => ':attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha'           => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'      => ':attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num'       => ':attribute hanya boleh berisi huruf dan angka.',
    'array'           => ':attribute harus berupa array.',
    'ascii'           => ':attribute hanya boleh berisi karakter alfanumerik satu byte dan simbol.',
    'before'          => ':attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between'         => [
        'array'   => ':attribute harus memiliki antara :min dan :max item.',
        'file'    => ':attribute harus berukuran antara :min dan :max kilobyte.',
        'numeric' => ':attribute harus bernilai antara :min dan :max.',
        'string'  => ':attribute harus berisi antara :min dan :max karakter.',
    ],
    'boolean'           => ':attribute harus berupa true atau false.',
    'can'               => ':attribute berisi nilai yang tidak diizinkan.',
    'confirmed'         => 'Konfirmasi :attribute tidak cocok.',
    'contains'          => ':attribute tidak memiliki nilai yang diperlukan.',
    'current_password'  => 'Kata sandi salah.',
    'date'              => ':attribute bukan tanggal yang valid.',
    'date_equals'       => ':attribute harus berupa tanggal yang sama dengan :date.',
    'date_format'       => ':attribute tidak cocok dengan format :format.',
    'decimal'           => ':attribute harus memiliki :decimal tempat desimal.',
    'declined'          => ':attribute harus ditolak.',
    'declined_if'       => ':attribute harus ditolak ketika :other berisi :value.',
    'different'         => ':attribute dan :other harus berbeda.',
    'digits'            => ':attribute harus terdiri dari :digits angka.',
    'digits_between'    => ':attribute harus terdiri dari :min sampai :max angka.',
    'dimensions'        => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct'          => ':attribute memiliki nilai duplikat.',
    'doesnt_end_with'   => ':attribute tidak boleh diakhiri dengan salah satu dari berikut: :values.',
    'doesnt_start_with' => ':attribute tidak boleh dimulai dengan salah satu dari berikut: :values.',
    'email'             => ':attribute harus berupa alamat email yang valid.',
    'ends_with'         => ':attribute harus diakhiri dengan salah satu dari berikut: :values.',
    'enum'              => ':attribute yang dipilih tidak valid.',
    'exists'            => ':attribute yang dipilih tidak valid.',
    'extensions'        => ':attribute harus memiliki salah satu ekstensi berikut: :values.',
    'file'              => ':attribute harus berupa file.',
    'filled'            => ':attribute harus diisi.',
    'gt'                => [
        'array'   => ':attribute harus memiliki lebih dari :value item.',
        'file'    => ':attribute harus berukuran lebih besar dari :value kilobyte.',
        'numeric' => ':attribute harus bernilai lebih besar dari :value.',
        'string'  => ':attribute harus berisi lebih dari :value karakter.',
    ],
    'gte' => [
        'array'   => ':attribute harus memiliki :value item atau lebih.',
        'file'    => ':attribute harus berukuran lebih besar dari atau sama dengan :value kilobyte.',
        'numeric' => ':attribute harus bernilai lebih besar dari atau sama dengan :value.',
        'string'  => ':attribute harus berisi lebih dari atau sama dengan :value karakter.',
    ],
    'hex_color' => ':attribute harus berupa warna heksadesimal yang valid.',
    'image'     => ':attribute harus berupa gambar.',
    'in'        => ':attribute yang dipilih tidak valid.',
    'in_array'  => ':attribute tidak ada di dalam :other.',
    'integer'   => ':attribute harus berupa bilangan bulat.',
    'ip'        => ':attribute harus berupa alamat IP yang valid.',
    'ipv4'      => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'      => ':attribute harus berupa alamat IPv6 yang valid.',
    'json'      => ':attribute harus berupa string JSON yang valid.',
    'list'      => ':attribute harus berupa daftar.',
    'lowercase' => ':attribute harus berupa huruf kecil.',
    'lt'        => [
        'array'   => ':attribute harus memiliki kurang dari :value item.',
        'file'    => ':attribute harus berukuran kurang dari :value kilobyte.',
        'numeric' => ':attribute harus bernilai kurang dari :value.',
        'string'  => ':attribute harus berisi kurang dari :value karakter.',
    ],
    'lte' => [
        'array'   => ':attribute harus memiliki :value item atau kurang.',
        'file'    => ':attribute harus berukuran kurang dari atau sama dengan :value kilobyte.',
        'numeric' => ':attribute harus bernilai kurang dari atau sama dengan :value.',
        'string'  => ':attribute harus berisi kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address' => ':attribute harus berupa alamat MAC yang valid.',
    'max'         => [
        'array'   => ':attribute tidak boleh memiliki lebih dari :max item.',
        'file'    => 'Ukuran :attribute tidak boleh lebih besar dari :max kilobyte.',
        'numeric' => ':attribute tidak boleh lebih besar dari :max.',
        'string'  => ':attribute tidak boleh lebih dari :max karakter.',
    ],
    'max_digits' => ':attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes'      => ':attribute harus berupa file dengan tipe: :values.',
    'mimetypes'  => ':attribute harus berupa file dengan tipe: :values.',
    'min'        => [
        'array'   => ':attribute harus memiliki setidaknya :min item.',
        'file'    => ':attribute harus berukuran setidaknya :min kilobyte.',
        'numeric' => ':attribute minimal harus bernilai :min.',
        'string'  => ':attribute minimal harus :min karakter.',
    ],
    'min_digits'       => ':attribute harus memiliki setidaknya :min digit.',
    'missing'          => ':attribute harus tidak ada.',
    'missing_if'       => ':attribute harus tidak ada ketika :other berisi :value.',
    'missing_unless'   => ':attribute harus tidak ada kecuali :other berisi :value.',
    'missing_with'     => ':attribute harus tidak ada ketika :values ada.',
    'missing_with_all' => ':attribute harus tidak ada ketika :values ada.',
    'multiple_of'      => ':attribute harus merupakan kelipatan :value.',
    'not_in'           => ':attribute yang dipilih tidak valid.',
    'not_regex'        => 'Format :attribute tidak valid.',
    'numeric'          => ':attribute harus berupa angka.',
    'password'         => [
        'letters'       => ':attribute harus mengandung setidaknya satu huruf.',
        'mixed'         => ':attribute harus mengandung setidaknya satu huruf besar dan satu huruf kecil.',
        'numbers'       => ':attribute harus mengandung setidaknya satu angka.',
        'symbols'       => ':attribute harus mengandung setidaknya satu simbol.',
        'uncompromised' => ':attribute yang diberikan telah muncul di kebocoran data. Silakan pilih :attribute yang berbeda.',
    ],
    'present'              => ':attribute harus ada.',
    'present_if'           => ':attribute harus ada ketika :other berisi :value.',
    'present_unless'       => ':attribute harus ada kecuali :other berisi :value.',
    'present_with'         => ':attribute harus ada ketika :values ada.',
    'present_with_all'     => ':attribute harus ada ketika :values ada.',
    'prohibited'           => ':attribute dilarang.',
    'prohibited_if'        => ':attribute dilarang ketika :other berisi :value.',
    'prohibited_unless'    => ':attribute dilarang kecuali :other berisi :values.',
    'prohibits'            => ':attribute melarang :other untuk hadir.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => ':attribute wajib diisi.',
    'required_array_keys'  => ':attribute wajib berisi entri untuk: :values.',
    'required_if'          => ':attribute wajib diisi ketika :other berisi :value.',
    'required_if_accepted' => ':attribute wajib diisi ketika :other diterima.',
    'required_if_declined' => ':attribute wajib diisi ketika :other ditolak.',
    'required_unless'      => ':attribute wajib diisi kecuali :other berisi :values.',
    'required_with'        => ':attribute wajib diisi ketika :values ada.',
    'required_with_all'    => ':attribute wajib diisi ketika :values ada.',
    'required_without'     => ':attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => ':attribute wajib diisi ketika tidak ada satu pun :values yang ada.',
    'same'                 => ':attribute dan :other harus cocok.',
    'size'                 => [
        'array'   => ':attribute harus berisi :size item.',
        'file'    => ':attribute harus berukuran :size kilobyte.',
        'numeric' => ':attribute harus berukuran :size.',
        'string'  => ':attribute harus berukuran :size karakter.',
    ],
    'starts_with' => ':attribute harus dimulai dengan salah satu dari berikut: :values.',
    'string'      => ':attribute harus berupa string.',
    'timezone'    => ':attribute harus berupa zona waktu yang valid.',
    'unique'      => ':attribute sudah digunakan.',
    'uploaded'    => ':attribute gagal diunggah.',
    'uppercase'   => ':attribute harus berupa huruf besar.',
    'url'         => ':attribute harus berupa URL yang valid.',
    'ulid'        => ':attribute harus berupa ULID yang valid.',
    'uuid'        => ':attribute harus berupa UUID yang valid.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name'                  => 'nama',
        'username'              => 'nama pengguna',
        'email'                 => 'email',
        'first_name'            => 'nama depan',
        'last_name'             => 'nama belakang',
        'password'              => 'kata sandi',
        'password_confirmation' => 'konfirmasi kata sandi',
        'current_password'      => 'kata sandi saat ini',
        'city'                  => 'kota',
        'country'               => 'negara',
        'address'               => 'alamat',
        'phone'                 => 'telepon',
        'mobile'                => 'ponsel',
        'age'                   => 'usia',
        'sex'                   => 'jenis kelamin',
        'gender'                => 'jenis kelamin',
        'day'                   => 'hari',
        'month'                 => 'bulan',
        'year'                  => 'tahun',
        'hour'                  => 'jam',
        'minute'                => 'menit',
        'second'                => 'detik',
        'title'                 => 'judul',
        'content'               => 'konten',
        'description'           => 'deskripsi',
        'excerpt'               => 'ringkasan',
        'date'                  => 'tanggal',
        'time'                  => 'waktu',
        'available'             => 'tersedia',
        'size'                  => 'ukuran',
        'price'                 => 'harga',
        'category'              => 'kategori',
        'image'                 => 'gambar',
        'photo'                 => 'foto',
        'file'                  => 'file',
        'logo_dark'             => 'logo mode gelap',
        'logo_light'            => 'logo mode terang',
        'favicon_image'         => 'favicon',
        'banner_image'          => 'gambar banner',
        'banner'                => 'banner',
        'menu_image'            => 'gambar menu',
        'event_image'           => 'gambar event',
        'gallery_image'         => 'gambar galeri',
        'testimonial_image'     => 'foto testimoni',
        'avatar'                => 'avatar',
        'photo_primary'         => 'foto utama',
        'photo_secondary'       => 'foto sekunder',
        'discount_percent'      => 'persentase diskon',
        'qty'                   => 'jumlah',
        'quantity'              => 'jumlah',
        'duration'              => 'durasi',
    ],

];