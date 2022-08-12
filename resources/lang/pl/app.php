<?php

return [
    'actions'   => [
        'login'    => 'Zaloguj',
        'logout'   => 'Wyloguj',

        'execute'   => 'Wykonaj',
        'cancel'    => 'Anuluj',
    ],

    'labels'    => [
        'options'               => 'Opcje',
        'go-to-previous-page'   => 'Wróć do poprzedniej strony',
        'go-to-homepage'        => 'Przejdź do strony głównej',
        'go-to-login'           => 'Przejdź do strony logowania',
    ],

    'placeholder'       => [
        'choose-file'   => 'Wybierz plik ..',
        'choose-files'   => 'Wybierz pliki ..',
    ],

    'errors'    => [
    ],

    'errors'    => [
        201     => [    // Created
            'code'          => 'Status #201',
            'name'          => 'Utworzono Zasób',
            'description'   => 'Utworzono Zasób',
        ],
        204     => [    // No Content
            'code'          => 'Status #204',
            'name'          => 'Brak Treści',
            'description'   => 'Brak Treści',
        ],
        400     => [    // Bad Request
            'code'          => 'Błąd #400',
            'name'          => 'Niepoprawny Request',
            'description'   => 'Niepoprawny Request',
        ],
        401     => [    // Unauthorized
            'code'          => 'Błąd #401',
            'name'          => 'Brak Uwierzytelnienia',
            'description'   => 'Musisz być zalogowany aby uzyskać dostęp do tego zasobu!',
        ],
        402     => [    // Payment Required
            'code'          => 'Błąd #402',
            'name'          => 'Wymagana Płatność',
            'description'   => 'Musisz uiścić opłatę aby uzyskać dostęp do zasobu',
        ],
        403     => [    // Forbidden
            'code'          => 'Błąd #403',
            'name'          => 'Brak Autoryzacji',
            'description'   => 'Nie masz uprawnień aby uzyskać dostęp do tego zasobu',
        ],
        404     => [    // Resource Not Found
            'code'          => 'Błąd #404',
            'name'          => 'Zasób Nieodnaleziony',
            'description'   => 'Niestety nie udało się odnaleźć żądanego zasobu!',
        ],
        405     => [    // Method Not Allowed
            'code'          => 'Błąd #405',
            'name'          => 'Niedozwolona Metoda',
            'description'   => 'Użyto Niedozwolonej Metody!',
        ],
        419     => [    // Page Expired (Laravel Specific)
            'code'          => 'Błąd #419',
            'name'          => 'Strona Wygasła',
            'description'   => 'Niesety Strona Wygasła!',
        ],
        429     => [    // Too Many Requests
            'code'          => 'Błąd #429',
            'name'          => 'Za Dużo Requestów',
            'description'   => 'Za Dużo Requestów!',
        ],
        500     => [    // Internal Server Error
            'code'          => 'Błąd #500',
            'name'          => 'Błąd Serwera',
            'description'   => 'Wewnętrzny Błąd Servera!',
        ],
        501     => [    // Not Implemented
            'code'          => 'Błąd #501',
            'name'          => 'Brak Implementacji',
            'description'   => 'Brak Implementacji!',
        ],
        503     => [    // Service Unavailable
            'code'          => 'Błąd #503',
            'name'          => 'Usługa Niedostępna',
            'description'   => 'Usługa Niedostępna!',
        ],
    ],
];